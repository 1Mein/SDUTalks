<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function __invoke()
    {
        $posts = auth()->user()->posts;
        foreach ($posts as $post){
            $post->time = '';
            if ($post->updated_at != $post->created_at) {
                $post->time .= 'Edited ';
                $time = Carbon::parse($post->updated_at);
            } else {
                $time = Carbon::parse($post->created_at);
            }


            $post->time .= $time->diffForHumans();
            $post->bestComment = null;
        }
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
