<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        // Handle Spatie UnauthorizedException
        if ($exception instanceof UnauthorizedException) {
            return redirect('/home')->with('error', 'You do not have permission to access this page.');
        }

        // Optional: Handle Laravel's default AuthorizationException too
        if ($exception instanceof AuthorizationException) {
            return redirect('/home')->with('error', 'Unauthorized access.');
        }

        return parent::render($request, $exception);
    }
}
