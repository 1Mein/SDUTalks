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

        $postsQuery = $user
            ->posts()
            ->where('is_published',1)
            ->orderBy('created_at', 'desc');

        $count = $postsQuery->count();

        $likes = $postsQuery->withCount('likes')->get()->sum('likes_count');
        $dislikes = $postsQuery->withCount('dislikes')->get()->sum('dislikes_count');

        $posts = $postsQuery->paginate(10);

        $data = [
            'count' => $count,
            'likes' => $likes,
            'dislikes' => $dislikes
        ];


        return view('profile.show',compact(['user','data','posts']));
    }
}
