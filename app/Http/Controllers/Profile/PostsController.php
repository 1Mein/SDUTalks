<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class PostsController extends Controller
{
    public function __invoke()
    {
        $currentPage = Request::query('page',1);
//        dd($currentPage);
        $user = auth()->user();
        $posts = Post::where('user_id',$user->id)->orderBy('created_at', 'desc')->paginate(5);
        foreach ($posts as $post) {
            $post['author'] = $user->name;
        }
        return view('profile.posts', compact('posts'))->with('page', $currentPage);
    }
}
