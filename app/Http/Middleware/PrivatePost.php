<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PrivatePost
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $post = $request->route('post');

        if (!$post instanceof Post) {
            $post = Post::find($post);
        }

        if(!$post->is_published && $post->user_id!==auth()->user()->id){
            abort(403,'Private post');
        }
        return $next($request);
    }
}
