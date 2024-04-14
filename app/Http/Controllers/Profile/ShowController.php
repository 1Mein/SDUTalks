<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;

class ShowController extends Controller
{
    public function __invoke(User $user)
    {
        if($user->id === auth()->id()){
            return redirect()->route('index.profile');
        }



        $posts = $user
            ->posts()
            ->where('is_published',1)
            ->orderBy('created_at', 'desc');
        foreach ($posts as $post){
            $post->time = '';
            if ($post->updated_at != $post->created_at) {
                $post->time .= 'Edited ';
                $time = Carbon::parse($post->updated_at);
            } else {
                $time = Carbon::parse($post->created_at);
            }

            $post->time .= $time->diffForHumans();
        }
        $data = [
            'count' => $posts->count(),
            'likes' => 0,
            'dislikes' => 0
        ];
        foreach ($posts->get() as $post){
            $data['likes']+=$post->likes->count();
            $data['dislikes']+=$post->dislikes->count();
        }
        $posts = $posts->paginate(10);

        foreach ($posts as $post){
             $post->bestComment = null;
        }

        return view('profile.show',compact(['user','data','posts']));
    }
}
