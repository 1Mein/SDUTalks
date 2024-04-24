<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class PostsController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        $posts = $user->posts()->orderBy('created_at', 'desc')->paginate(10);

        return view('profile.posts', compact('posts'));
    }
}
