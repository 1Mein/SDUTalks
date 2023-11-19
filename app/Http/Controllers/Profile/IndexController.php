<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
class IndexController extends Controller
{
    public function __invoke()
    {
        $posts = auth()->user()->posts;
        $data = [
            'likes' => 0,
            'dislikes' => 0
        ];
        foreach ($posts as $post){
            $data['likes']+=$post->likes->count();
            $data['dislikes']+=$post->dislikes->count();
        }
        return view('profile.index',compact(['posts','data']));
    }
}
