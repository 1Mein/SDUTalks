<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use function Laravel\Prompts\error;

class ShowController extends Controller
{
    public function __invoke(Post $post)
    {
        $comments = Comment::where('post_id',$post->id)->orderBy('created_at', 'desc')->paginate(15);;
        $post->time = '';
        if ($post->updated_at != $post->created_at) {
            $post->time .= 'Edited ';
            $time = Carbon::parse($post->updated_at);
        } else {
            $time = Carbon::parse($post->created_at);
        }


        $post->time .= $time->diffForHumans();
        $post->bestComment = $post->bestComment();
        return view('post.show', compact(['post','comments']));
    }
}
