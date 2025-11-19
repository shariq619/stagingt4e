<?php

namespace App\Services\Email\Context;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ModelIntrospector
{
    public function getColumnsForModel(Model $model): array
    {
        $table = $model->getTable();

        $cols = Schema::getColumnListing($table);

        $filtered = [];
        foreach ($cols as $col) {

            if ($this->isBlacklisted($col)) {
                continue;
            }

            $filtered[$col] = $this->prettify($col);
        }

        return $filtered;
    }

    protected function isBlacklisted(string $column): bool
    {
        $deny = [
            'password',
            'remember_token',
            'api_token',
            'two_factor_secret',
            'two_factor_recovery_codes',
            'created_at',
            'updated_at',
            'deleted_at',
        ];

        return in_array($column, $deny, true);
    }


    protected function prettify(string $snake): string
    {
        return (string) Str::of($snake)
            ->replace('_', ' ')
            ->ucfirst();
    }
}
