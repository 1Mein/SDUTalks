<?php

namespace App\Http\Controllers\Post;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\Post;

class IndexController extends Controller
{
    public function __constuct()
    {
        $this->middleware('auth');
    }

    public function __invoke()
    {

        $posts = Post::where('is_published', 1)->orderBy('created_at', 'desc')->paginate(5);
        foreach ($posts as $post) {
            $post->time = '';
            if ($post->updated_at != $post->created_at) {
                $post->time .= 'Edited ';
                $time = Carbon::parse($post->updated_at);
            } else {
                $time = Carbon::parse($post->created_at);
            }


            $post->time .= $time->diffForHumans();
            $post->bestComment = $post->bestComment();
        }

        return view('post.index', compact(['posts']));
    }
}
