<?php

namespace App\Http\Service\Post;

use App\Models\Like;
use App\Models\Notify;
use App\Models\Post;
use App\Models\User;
use App\Models\UserNotify;
use Illuminate\Support\Facades\DB;

class Service
{
    public function store($data)
    {
        if (isset($data['is_anonymous']) && $data['is_anonymous'] === 'on') {
            $data['user_id'] = 55; //anon account
            unset($data['is_anonymous']);
        } else {
            $data['user_id'] = auth()->user()->id;
        }
        Post::create($data);
    }

    public function setLike(Post $post, $user, int $postId, int $userId): string
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

        if ($action ==='like'){
            $this->createNotify($post->user()->value('id'), 'post-like','',$userId,$postId);
        }
        elseif ($action === 'undislike like'){
            $this->removeNotify('post-dislike',$userId, $postId);
            $this->createNotify($post->user()->value('id'), 'post-like','',$userId,$postId);
        }
        else{
            $this->removeNotify('post-like',$userId, $postId);
        }

        return $action;
    }

    public function setDislike(Post $post, $user, int $postId, int $userId): string
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

        if ($action === 'dislike'){
            $this->createNotify($post->user()->value('id'), 'post-dislike','',$userId,$postId);
        }
        elseif ($action === 'unlike dislike'){
            $this->removeNotify('post-like',$userId, $postId);
            $this->createNotify($post->user()->value('id'), 'post-dislike','',$userId,$postId);
        }
        else{
            $this->removeNotify('post-dislike',$userId, $postId);
        }

        return $action;
    }

    public function createNotify($destUser, $type, $text = '', $fromUser = null, $onPost = null, $onComment = null)
    {
        try {
            DB::beginTransaction();

            $data = [
                'type' => $type,
                'from_user' => $fromUser,
                'on_post' => $onPost,
                'on_comment' => $onComment,
                'text' => $text,
            ];

            $notify = Notify::firstOrCreate($data);

            $data = [
                'user_id' => $destUser,
                'notify_id' => $notify->id,
                'is_viewed' => 0,
            ];

            $userNotify = UserNotify::firstOrCreate($data);
            DB::commit();
        }
        catch (\Exception $exception){
            DB::rollBack();
            abort(500);
        }
    }

    public function removeNotify($type, $fromUser, $onPost = null, $onComment = null)
    {
        try {
            DB::beginTransaction();

            $data = [
                'type' => $type,
                'from_user' => $fromUser,
                'on_post' => $onPost,
                'on_comment' => $onComment,
            ];

            $notify = Notify::where($data)->delete();
            DB::commit();
        }
        catch (\Exception $exception){
            DB::rollBack();
            abort(500);
        }
    }

}
