<?php

namespace App\Observers;

use App\Models\User;
use App\Observers\Concerns\CreatesAuditLog;

class UserObserver
{
    use CreatesAuditLog;

    public function created(User $user): void
    {
        $this->writeAudit($user, 'created', null, $user->getAttributes());
    }

    public function updated(User $user): void
    {
        [$old, $new] = $this->changedPairs($user);
        if (!empty($new)) {
            $this->writeAudit($user, 'updated', $old, $new);
        }
    }

    public function deleted(User $user): void
    {
        $this->writeAudit($user, 'deleted', $user->getOriginal(), null);
    }

    public function restored(User $user): void
    {
        $this->writeAudit($user, 'restored', null, $user->getAttributes());
    }

    public function forceDeleted(User $user): void
    {
        $this->writeAudit($user, 'forceDeleted', $user->getOriginal(), null);
    }
}
