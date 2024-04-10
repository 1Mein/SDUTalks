<?php

namespace App\Http\Service\Comment;

use App\Models\Comment;
use App\Models\CommentLikes;
use App\Models\Notify;

class Service
{
    public function setLike(Comment $comment, $user, int $commentId, int $userId): string
    {
        $action = '';
        if ($comment->liked($user)) {
            $rel = CommentLikes::where('comment_id', $commentId)->where('user_id', $userId);
            $rel->delete();
            $action = 'unlike';
        } else if ($comment->disliked($user)) {
            //undislike
            $rel = CommentLikes::where('comment_id', $commentId)->where('user_id', $userId);
            $rel->update(['is_like' => true]);
            $action = 'undislike like';
        } else {
            $action = 'like';
            $like = new CommentLikes([
                'user_id' => $userId,
                'comment_id' => $commentId,
                'is_like' => true,
            ]);
            $like->save();
        }

        if ($comment->user()->value('id') === $userId){
            return $action;
        }


        if ($action === 'like') {
            Notify::createNotify($comment->user()->value('id'), 'comment-like', '', $userId, null, $commentId);
        } elseif ($action === 'undislike like') {
            Notify::removeNotify('comment-dislike', $userId,null , $commentId);
            Notify::createNotify($comment->user()->value('id'), 'comment-like', '', $userId, null, $commentId);
        } else {
            Notify::removeNotify('comment-like', $userId, null, $commentId);
        }

        return $action;
    }

    public function setDislike(Comment $comment, $user, int $commentId, int $userId): string
    {
        $action = '';
        if ($comment->disliked($user)) {
            $rel = CommentLikes::where('comment_id', $commentId)->where('user_id', $userId);
            $rel->delete();
            $action = 'undislike';
        } else if ($comment->liked($user)) {
            //unlike
            $rel = CommentLikes::where('comment_id', $commentId)->where('user_id', $userId);
            $rel->update(['is_like' => false]);
            $action = 'unlike dislike';
        } else {
            $action = $action . 'dislike';
            $dislike = new CommentLikes([
                'user_id' => $userId,
                'comment_id' => $commentId,
                'is_like' => false,
            ]);
            $dislike->save();
        }

        if ($comment->user()->value('id') === $userId){
            return $action;
        }

        if ($action === 'dislike') {
            Notify::createNotify($comment->user()->value('id'), 'comment-dislike', '', $userId, null, $commentId);
        } elseif ($action === 'unlike dislike') {
            Notify::removeNotify('comment-like', $userId, null, $commentId);
            Notify::createNotify($comment->user()->value('id'), 'comment-dislike', '', $userId, null, $commentId);
        } else {
            Notify::removeNotify('comment-dislike', $userId, null, $commentId);
        }

        return $action;
    }
}
