<?php

namespace App\Services\Email;

use App\Models\EmailMapping;
use App\Models\EmailTrigger;

class MappingResolver
{
    public function resolve(EmailTrigger $trigger, array $payload)
    {
        $locale = isset($payload['locale']) ? $payload['locale'] : 'en';
        $course = isset($payload['course']) ? $payload['course'] : null;

        $mappings = EmailMapping::with('conditions')
            ->where('trigger_id', $trigger->id)
            ->where('enabled', 1)
            ->orderBy('priority', 'asc')
            ->get();

        $candidates = [];
        foreach ($mappings as $m) {
            if (!$this->scopeMatches($m, $course)) continue;
            if (!$this->conditionsMatch($m, $payload, $locale)) continue;
            $candidates[] = $m;
        }

        usort($candidates, function ($a, $b) {
            if ($a->priority !== $b->priority) return $a->priority < $b->priority ? -1 : 1;
            $rank = ['course' => 0, 'category' => 1, 'global' => 2];
            $ra = isset($rank[$a->scope]) ? $rank[$a->scope] : 3;
            $rb = isset($rank[$b->scope]) ? $rank[$b->scope] : 3;
            return $ra < $rb ? -1 : ($ra > $rb ? 1 : 0);
        });

        return count($candidates) ? $candidates[0] : null;
    }

    protected function scopeMatches(EmailMapping $m, $course)
    {
        if ($m->scope === 'global') return true;
        if ($m->scope === 'category') {
            if (!$course) return false;
            return isset($course['category']) && $course['category'] === $m->course_category;
        }
        if ($m->scope === 'course') {
            if (!$course) return false;
            return isset($course['id']) && (int)$course['id'] === (int)$m->course_id;
        }
        return false;
    }

    protected function conditionsMatch(EmailMapping $m, array $payload, $locale)
    {
        foreach ($m->conditions as $c) {
            $value = $this->readContextValue($c->key, $payload, $locale);
            $expected = $this->parseValue($c->value);
            if (!$this->compare($value, $expected, $c->operator)) return false;
        }
        return true;
    }

    protected function readContextValue($key, array $payload, $locale)
    {
        if ($key === 'locale') return $locale;
        $parts = explode('.', $key);
        $current = $payload;
        foreach ($parts as $p) {
            if (is_array($current) && array_key_exists($p, $current)) {
                $current = $current[$p];
            } else {
                return null;
            }
        }
        return $current;
    }

    protected function parseValue($raw)
    {
        $decoded = json_decode($raw, true);
        return (json_last_error() === JSON_ERROR_NONE) ? $decoded : $raw;
    }

    protected function compare($actual, $expected, $op)
    {
        switch ($op) {
            case 'eq':
                return $actual == $expected;
            case 'ne':
                return $actual != $expected;
            case 'in':
                return is_array($expected) ? in_array($actual, $expected) : false;
            case 'nin':
                return is_array($expected) ? !in_array($actual, $expected) : true;
            case 'gte':
                return $actual >= $expected;
            case 'lte':
                return $actual <= $expected;
            case 'between':
                return is_array($expected) && count($expected) === 2 ? ($actual >= $expected[0] && $actual <= $expected[1]) : false;
            case 'contains':
                return is_array($actual) ? in_array($expected, $actual)
                    : (is_string($actual) && is_string($expected) ? (strpos($actual, $expected) !== false) : false);
            default:
                return false;
        }
    }
}
