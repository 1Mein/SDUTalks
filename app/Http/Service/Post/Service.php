<?php

namespace App\Http\Service\Post;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;

class Service
{
    public function store($data){
        $data['user_id'] = auth()->user()->id;
        Post::create($data);
    }

    public function setLike(Post $post,$user,int $postId, int $userId): string
    {
        $action = '';
        if ($post->liked($user)) {
            $rel = Like::where('post_id', $postId)->where('user_id', $userId);
            $rel->delete();
            $action = 'unlike';
        } else if ($post->disliked($user)) {
            //undislike
            $rel = Like::where('post_id', $postId)->where('user_id', $userId);
            $rel->update(['is_like' => true]);
            $action = 'undislike like';
        } else {
            $action = $action . 'like';
            $like = new Like([
                'user_id' => $userId,
                'post_id' => $postId,
                'is_like' => true,
            ]);
            $like->save();
        }
        return $action;
    }

    public function setDislike(Post $post,$user,int $postId, int $userId): string
    {
        $action = '';
        if ($post->disliked($user)) {
            $rel = Like::where('post_id', $postId)->where('user_id', $userId);
            $rel->delete();
            $action = 'undislike';
        } else if ($post->liked($user)) {
            //unlike
            $rel = Like::where('post_id', $postId)->where('user_id', $userId);
            $rel->update(['is_like' => false]);
            $action = 'unlike dislike';
        } else {
            $action = $action . 'dislike';
            $dislike = new Like([
                'user_id' => $userId,
                'post_id' => $postId,
                'is_like' => false,
            ]);
            $dislike->save();
        }
        return $action;
    }
}
