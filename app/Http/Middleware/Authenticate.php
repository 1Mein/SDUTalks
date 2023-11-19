<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        $redirectRoute = $request->expectsJson() ? null : route('login.create');

        // Добавим параметр 'message' с информацией для редиректа
        return $redirectRoute . '?message=You need to be logged in to perform this action.';
    }
}
