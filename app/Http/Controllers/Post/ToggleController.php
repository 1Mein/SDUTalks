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
        unset($post->time);
        $post->save();


        return response()->json(['success' => true,'is_published' => $post->is_published]);
    }
}
