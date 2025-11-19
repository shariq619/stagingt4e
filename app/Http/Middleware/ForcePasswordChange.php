<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForcePasswordChange
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        // Log::info('Middleware check', [
        //     'user' => $user,
        //     'hasRole' => $user ? $user->hasRole('Learner') : null,
        //     'password_check' => $user ? $user->password_check : null
        // ]);

        if ($user && $user->hasRole('Learner') && $user->password_check == 0) {
            return redirect()->route('backend.user.changePassword');
        }

        return $next($request);
    }
}
