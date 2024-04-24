<?php

namespace App\Http\Controllers\Post;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\Post;

class IndexController extends Controller
{

    public function __invoke()
    {

        $posts = Post::where('is_published', 1)->orderBy('created_at', 'desc')->paginate(10);
        foreach ($posts as $post) {
            $post->bestComment = $post->bestCommentFunc();
        }


        return view('post.index', compact(['posts']));
    }
}
