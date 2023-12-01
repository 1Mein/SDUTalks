<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use function Laravel\Prompts\error;

class ShowController extends Controller
{
    public function __invoke(Post $post)
    {
//        if(!$post->is_published) abort(403,'Private post');
        return view('post.show', compact(['post']));
    }
}
