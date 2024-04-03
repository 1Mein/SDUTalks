<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreRequest;
use App\Models\Comment;
use App\Providers\RouteServiceProvider;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        if (isset($data['is_anonymous']) && $data['is_anonymous'] === 'on') {
            $data['user_id'] = 5; //anon account
            unset($data['is_anonymous']);
        } else {
            $data['user_id'] = auth()->user()->id;
        }
        $data['post_id'] = $request->post;
        Comment::create($data);
        return redirect()->route('posts.show',$request->post);
    }
}
