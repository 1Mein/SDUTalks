<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreRequest;
use App\Models\Comment;
use App\Models\Notify;
use App\Models\Post;
use App\Models\UserNotify;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        if (isset($data['is_anonymous']) && $data['is_anonymous'] === 'on') {
            $data['user_id'] = 55; //anon account
            unset($data['is_anonymous']);
        } else {
            $data['user_id'] = auth()->id();
        }
        $data['post_id'] = $request->post;


        $comment = Comment::create($data);

        if (isset($data['on_comment'])){
            $repliedComment = Comment::find($data['on_comment']);

            Notify::createNotify($repliedComment->user_id,'replied-comment', '', $data['user_id'],$data['post_id'],$comment->id);
        }

        Notify::createNotify(Post::find($request->post)->user_id,'commented-post','',$data['user_id'], $data['post_id'], $comment->id);


        return redirect()->route('posts.show',$request->post);
    }
}
