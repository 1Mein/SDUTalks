<?php

namespace App\Http\Controllers\Saves;

use App\Http\Controllers\Controller;
use App\Models\Post;

class StoreController extends Controller
{
    public function __invoke(Post $post)
    {

        $user = auth()->user();

        $save = $user->saves()->attach($post->id);

        return response()->json(['id' => $save->id]);
    }
}
