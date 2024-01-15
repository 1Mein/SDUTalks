<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;

class ShowController extends Controller
{
    public function __invoke(Comment $comment)
    {
//        dd($comment);
        return view('comment.show', compact('comment'));
    }
}
