<?php

namespace App\Http\Controllers\Comment;


use App\Models\Comment;

class LikeController extends BaseController
{
    public function like(Comment $comment)
    {
        $user = auth()->user();
        $userId = $user->id;
        $commentId = $comment->id;

        $action = $this->service->setLike($comment,$user,$commentId,$userId);



        return response()->json(['action' => $action, 'likes' => $comment->likes()->count(), 'dislikes' => $comment->dislikes()->count(), 'id' => $commentId]);
    }


    public function dislike(Comment $comment)
    {
        $user = auth()->user();
        $userId = $user->id;
        $commentId = $comment->id;

        $action = $this->service->setDislike($comment,$user,$commentId,$userId);

        return response()->json(['action' => $action, 'likes' => $comment->likes()->count(), 'dislikes' => $comment->dislikes()->count(), 'id' => $commentId]);
    }
}
