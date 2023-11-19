<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Request;


class ToggleController extends Controller
{
    public function __invoke(Post $post)
    {
        $post->is_published = !$post->is_published;
        $post->save();

        $currentPage = Request::query('page',1);
//        dd($currentPage);
        return redirect()->route('posts.profile')->with('page', $currentPage);
    }
}
