<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::DASHBOARD;

    protected function redirectTo()
    {
        $user = Auth::user();
        if (!$user) {
            return url('/'); // fallback
        }

        if ($user->hasRole('Super Admin') || $user->hasRole('Admin') || $user->hasRole('SEO')) {
            return route('backend.dashboard.index');
        } elseif ($user->hasRole('Learner')) {
            return route('backend.learner.dashboard');
        } elseif ($user->hasRole('Trainer')) {
            return route('backend.trainer.dashboard');
        } elseif ($user->hasRole('Corporate Client')) {
            return route('backend.client.dashboard');
        }

        return url('/'); // default fallback
    }
}
