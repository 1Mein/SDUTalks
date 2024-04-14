<?php

namespace App\Http\Controllers\Post;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\Post;

class SubscribedController extends Controller
{

    public function __invoke()
    {
        $posts = Post::whereHas('user', function ($query) {
            $query->whereIn('id', auth()->user()->subscribesUsers()->pluck('id'));
        })
            ->where('is_published', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(10);



        foreach ($posts as $post) {
            if ($post->updated_at != $post->created_at) {
                $post->time = 'Edited '.Carbon::parse($post->updated_at)->diffForHumans();
            } else {
                $post->time = Carbon::parse($post->created_at)->diffForHumans();
            }

            $post->bestComment = $post->bestComment();
        }


        return view('post.subscribed', compact(['posts']));
    }
}
