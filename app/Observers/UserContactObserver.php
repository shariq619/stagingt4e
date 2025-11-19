<?php

namespace App\Observers;

use App\Models\UserContact;
use App\Observers\Concerns\CreatesAuditLog;

class UserContactObserver
{
    use CreatesAuditLog;

    public function created(UserContact $contact): void
    {
        if ($contact->user) {
            $new = $this->labeledValues($contact, $contact->getAttributes());
            $this->writeAudit($contact->user, 'created', null, $new);
        }
    }

    public function updated(UserContact $contact): void
    {
        if ($contact->user) {
            [$old, $new] = $this->changedPairs($contact);
            $old = $this->labeledValues($contact, $old);
            $new = $this->labeledValues($contact, $new);
            if (!empty($new)) {
                $this->writeAudit($contact->user, 'updated', $old, $new);
            }
        }
    }

    public function deleted(UserContact $contact): void
    {
        if ($contact->user) {
            $old = $this->labeledValues($contact, $contact->getOriginal());
            $this->writeAudit($contact->user, 'deleted', $old, null);
        }
    }

    public function restored(UserContact $contact): void
    {
        if ($contact->user) {
            $new = $this->labeledValues($contact, $contact->getAttributes());
            $this->writeAudit($contact->user, 'restored', null, $new);
        }
    }

    public function forceDeleted(UserContact $contact): void
    {
        if ($contact->user) {
            $old = $this->labeledValues($contact, $contact->getOriginal());
            $this->writeAudit($contact->user, 'forceDeleted', $old, null);
        }
    }

    protected function labeledValues(UserContact $contact, ?array $values): ?array
    {
        if ($values === null) {
            return null;
        }

        $identifier = $contact->direct_email
            ?: $contact->mobile
                ?: $contact->name
                    ?: ('#' . $contact->id);

        $suffix = ' (' . $identifier . ')';

        $out = [];
        foreach ($values as $key => $val) {
            if (in_array($key, ['id', 'user_id', 'created_at', 'updated_at', 'deleted_at'], true)) {
                continue;
            }
            $out[$key . $suffix] = $val;
        }

        return $out;
    }
}
