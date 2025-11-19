<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentAuditLog extends Model
{
    protected $fillable = [
        'auditable_type', 'auditable_id',
        'event', 'old_values', 'new_values',
        'user_id', 'ip', 'user_agent'
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];

    public function auditable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getIsReassignmentAttribute(): bool
    {
        if ($this->auditable_type !== ProductInvoice::class) return false;
        if ($this->event !== 'updated') return false;

        $old = $this->old_values ?? [];
        $new = $this->new_values ?? [];

        if (!array_key_exists('cohort_id', $old) && !array_key_exists('cohort_id', $new)) {
            return false;
        }

        $oldId = $old['cohort_id'] ?? null;
        $newId = $new['cohort_id'] ?? null;
        return $oldId !== $newId && $newId !== null;
    }
}
