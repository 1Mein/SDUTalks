<?php

namespace App\Http\Service\Post;

use App\Http\Requests\Post\StoreRequest;
use App\Models\Like;
use App\Models\Notify;
use App\Models\Post;
use App\Models\User;
use App\Models\UserNotify;
use Illuminate\Support\Facades\DB;

class Service
{
    public function store($data, StoreRequest $request)
    {
        try {
            DB::beginTransaction();
            if (isset($data['is_anonymous']) && $data['is_anonymous'] === 'on') {
                $data['user_id'] = 55; //anon account
                unset($data['is_anonymous']);
            } else {
                $data['user_id'] = auth()->user()->id;
            }

            if (isset($data['image'])) {
                $filename = preg_replace("/[^a-zA-Z0-9-_\.]/", "", $request->file('image')->getClientOriginalName());

                $filename = time() . '_' . $filename;
                $request->file('image')->storeAs('public/images/', $filename);

                $data['image'] = $filename;
            }
            Post::create($data);
            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();
            abort(400);
        }
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

        if ($post->user()->value('id') === $user->id){
            return $action;
        }


        if ($action === 'like') {
            Notify::createNotify($post->user()->value('id'), 'post-like', '', $userId, $postId);
        } elseif ($action === 'undislike like') {
            Notify::removeNotify('post-dislike', $userId, $postId);
            Notify::createNotify($post->user()->value('id'), 'post-like', '', $userId, $postId);
        } else {
            Notify::removeNotify('post-like', $userId, $postId);
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

        if ($post->user()->value('id') === $user->id){
            return $action;
        }

        if ($action === 'dislike') {
            Notify::createNotify($post->user()->value('id'), 'post-dislike', '', $userId, $postId);
        } elseif ($action === 'unlike dislike') {
            Notify::removeNotify('post-like', $userId, $postId);
            Notify::createNotify($post->user()->value('id'), 'post-dislike', '', $userId, $postId);
        } else {
            Notify::removeNotify('post-dislike', $userId, $postId);
        }

        return $action;
    }
}
