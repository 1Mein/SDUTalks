<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;

class LikeController extends Controller
{
    public function like(Post $post)
    {
        $user = auth()->user();
        $userid = $user->id;
        $postid = $post->id;
        $action = '';


        if ($post->liked($user)) {
            $rel = Like::where('post_id', $postid)->where('user_id', $userid);
            $rel->delete();
            $action = 'unlike';
        } else if ($post->disliked($user)) {
            //undislike
            $rel = Like::where('post_id', $postid)->where('user_id', $userid);
            $rel->update(['is_like' => true]);
            $action = 'undislike like';
        } else {
            $action = $action . 'like';
            $like = new Like([
                'user_id' => $userid,
                'post_id' => $postid,
                'is_like' => true,
            ]);
            $like->save();
        }
        return response()->json(['action' => $action, 'likes' => $post->likes->count(), 'dislikes' => $post->dislikes->count(), 'id' => $postid]);
    }


    public function dislike(Post $post)
    {
        $user = auth()->user();
        $userid = $user->id;
        $postid = $post->id;


        if ($post->disliked($user)) {
            $rel = Like::where('post_id', $postid)->where('user_id', $userid);
            $rel->delete();
            $action = 'undislike';
        } else if ($post->liked($user)) {
            //unlike
            $rel = Like::where('post_id', $postid)->where('user_id', $userid);
            $rel->update(['is_like' => false]);
            $action = 'unlike dislike';
        } else {
            $dislike = new Like([
                'user_id' => $userid,
                'post_id' => $postid,
                'is_like' => false,
            ]);
            $dislike->save();
            $action = 'dislike';
        }
        return response()->json(['action' => $action, 'likes' => $post->likes->count(), 'dislikes' => $post->dislikes->count(), 'id' => $post->id]);
    }
}
