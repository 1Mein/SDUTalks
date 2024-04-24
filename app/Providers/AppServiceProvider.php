<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\UserNotify;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();

        Post::retrieved(function ($post) {
            if ($post->updated_at != $post->created_at) {
                $post->time = 'Edited '.Carbon::parse($post->updated_at)->diffForHumans();
            } else {
                $post->time = Carbon::parse($post->created_at)->diffForHumans();
            }
        });

        Comment::retrieved(function ($comment) {
            if ($comment->updated_at != $comment->created_at) {
                $comment->time = 'Edited '.Carbon::parse($comment->updated_at)->diffForHumans();
            } else {
                $comment->time = Carbon::parse($comment->created_at)->diffForHumans();
            }
        });
    }
}
