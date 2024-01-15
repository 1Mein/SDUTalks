<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use function Laravel\Prompts\error;

class ShowController extends Controller
{
    public function __invoke(Post $post)
    {
        $comments = Comment::where('post_id',$post->id)->orderBy('created_at', 'desc')->paginate(20);;
        return view('post.show', compact(['post','comments']));
    }
}
