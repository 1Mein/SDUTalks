<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;

class ShowController extends Controller
{
    public function __invoke(Comment $comment)
    {

        if ($comment->updated_at != $comment->created_at) {
            $comment->time = 'Edited '.Carbon::parse($comment->updated_at)->diffForHumans();
        } else {
            $comment->time = Carbon::parse($comment->created_at)->diffForHumans();
        }


        return view('comment.show', compact('comment'));
    }
}
