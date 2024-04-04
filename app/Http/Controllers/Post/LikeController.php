<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;

class LikeController extends BaseController
{
    public function like(Post $post)
    {
        $user = auth()->user();
        $userId = $user->id;
        $postId = $post->id;

        $action = $this->service->setLike($post,$user,$postId,$userId);



        return response()->json(['action' => $action, 'likes' => $post->likes()->count(), 'dislikes' => $post->dislikes()->count(), 'id' => $postId]);
    }


    public function dislike(Post $post)
    {
        $user = auth()->user();
        $userId = $user->id;
        $postId = $post->id;

        $action = $this->service->setDislike($post,$user,$postId,$userId);

        return response()->json(['action' => $action, 'likes' => $post->likes()->count(), 'dislikes' => $post->dislikes()->count(), 'id' => $postId]);
    }
}
