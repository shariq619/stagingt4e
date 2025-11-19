<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Request;
use Lab404\Impersonate\Services\ImpersonateManager;
use Illuminate\Contracts\Auth\Authenticatable as Model;

class CustomImpersonateManager extends ImpersonateManager
{
    /**
     * Override the take method
     *
     * @param Model $currentUser
     * @param Model $targetUser
     * @param string|null $guardName
     * @return bool
     */
    public function take($from, $to, $guardName = null)
    {
        // Customize logic before impersonating
        if ($to->hasRole('Super Admin')) {
            // Block impersonation of Super Admin
            abort(403, 'You cannot impersonate a Super Admin.');
        }

        if ($to->hasRole('Trainer')) {
            return redirect()->route('backend.learner.dashboard');
        }

        // Call parent take method to handle impersonation
        return parent::take($from, $to, $guardName);
    }


}
