<?php

namespace App\Http\Controllers\Post;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\Post;

class IndexController extends Controller
{
    public function __constuct(){
        $this->middleware('auth');
    }

    public function __invoke()
    {


        $posts = Post::where('is_published', 1)->orderBy('created_at', 'desc')->paginate(5);
//        foreach ($posts as $post){
//            $post['author'] =  $post->user->name;
//        }
        return view('post.index',compact(['posts']));
    }
}
