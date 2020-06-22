<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Exceptions\AuthenticateWithFlashException;

class AuthenticateWithFlash extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('home');
        }
    }

    protected function unauthenticated($request, array $guards)
    {
        throw new AuthenticateWithFlashException(
            'Unauthenticated.',
            $guards,
            $this->redirectTo($request)
        );
    }
}
