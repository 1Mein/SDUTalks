<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Notify;

class DestroyController extends Controller
{
    public function __invoke(Comment $comment)
    {
        $comment->delete();
        Notify::removeNotify('commented-post',$comment->user_id, $comment->post_id);
        return response()->json(['id' => $comment->id]);
    }
}
