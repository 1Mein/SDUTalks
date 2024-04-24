<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function __invoke()
    {
        $postsQuery = auth()->user()->posts();


        $data = [
            'likes' => $postsQuery->withCount('likes')->get()->sum('likes_count'),
            'dislikes' => $postsQuery->withCount('dislikes')->get()->sum('dislikes_count')
        ];

        $posts = $postsQuery->get();

        return view('profile.index',compact(['posts','data']));
    }
}
