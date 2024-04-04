<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPostOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $post = $request->route('post');
        if ($post->user_id === auth()->id() || 1 === auth()->id() ) {
            return $next($request);
        }
        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
