<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Service\Post\Service;
use App\Models\Post;
use Illuminate\Session\Store;

class UpdateController extends BaseController
{
    public function __invoke(StoreRequest $request,Post $post)
    {
        $data = $request->validated();
        $post->update($data);
        return redirect()->route('posts.profile');
    }
}
