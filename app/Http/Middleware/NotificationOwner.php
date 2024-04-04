<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NotificationOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $notification = $request->route('notify');
        $users = User::join('user_notifies', 'users.id', '=', 'user_notifies.user_id')
            ->where('user_notifies.notify_id', $notification->id)
            ->pluck('users.id')
            ->toArray();

        if (in_array(auth()->user()->id, $users)) {
            return $next($request);
        }
        return response()->json(['error' => '405']);

    }
}
