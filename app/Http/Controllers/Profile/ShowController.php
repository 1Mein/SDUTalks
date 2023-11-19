<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;

class ShowController extends Controller
{
    public function __invoke(User $user)
    {
//        $posts = $user->posts()->where('is_published',1)->orderBy('created_at', 'desc')->paginate(5);
        $posts = $user
            ->posts()
            ->where('is_published',1)
            ->orderBy('created_at', 'desc');
        $data = [
            'count' => $posts->count(),
            'likes' => 0,
            'dislikes' => 0
        ];
        foreach ($posts->get() as $post){
            $data['likes']+=$post->likes->count();
            $data['dislikes']+=$post->dislikes->count();
        }
        $posts = $posts->paginate(5);
        return view('profile.show',compact(['user','data','posts']));
    }
}
