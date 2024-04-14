<?php

namespace App\Http\Controllers\Post;

use App\Http\Requests\Post\StoreRequest;
use App\Models\Notify;
use App\Models\Subscribes;
use App\Models\User;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $post = $this->service->store($data,$request);

        $subscribedUsers = User::find(auth()->id())->subscribersNotifiedUsers();

        foreach ($subscribedUsers as $subscribedUser){
            Notify::createNotify($subscribedUser->id, 'new-post', '',auth()->id(), $post->id);
        }

        return redirect()->route('posts.index');
    }
}
