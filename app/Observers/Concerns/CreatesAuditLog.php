<?php

namespace App\Observers\Concerns;

use Illuminate\Database\Eloquent\Model;

trait CreatesAuditLog
{
    protected function writeAudit(Model $model, string $event, array $old = null, array $new = null): void
    {
        $model->logs()->create([
            'event'      => $event,
            'old_values' => $old,
            'new_values' => $new,
            'user_id'    => auth()->id(),
            'ip'         => request()->ip() ?? null,
            'user_agent' => request()->userAgent() ?? null,
        ]);
    }

    protected function changedPairs(Model $model): array
    {
        $changes = $model->getChanges();
        $old = [];
        $new = [];
        foreach ($changes as $key => $val) {
            if (method_exists($model, 'getUpdatedAtColumn') && $key === $model->getUpdatedAtColumn()) {
                continue;
            }
            $old[$key] = $model->getOriginal($key);
            $new[$key] = $val;
        }
        return [$old, $new];
    }
}
