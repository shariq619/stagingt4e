<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Lab404\Impersonate\Services\ImpersonateManager;

class ImpersonateController extends Controller
{
    public function __construct(ImpersonateManager $impersonate)
    {
        $this->impersonate = $impersonate;
    }

    public function take($id)
    {
        $userToImpersonate = User::findOrFail($id);
        $this->impersonate->take(Auth::user(), $userToImpersonate);

        if ($userToImpersonate->hasRole('Trainer')) {
            return redirect()->route('backend.trainer.dashboard');
        } elseif ($userToImpersonate->hasRole('Corporate Client')) {
            return redirect()->route('backend.client.dashboard');
        } elseif ($userToImpersonate->hasRole('Learner')) {
            return redirect()->route('backend.learner.dashboard');
        }

        return redirect()->route('backend.users.index'); // default
    }

    public function leave()
    {
        $this->impersonate->leave();

        return redirect()->route('backend.users.index'); // back to original user
    }
}
