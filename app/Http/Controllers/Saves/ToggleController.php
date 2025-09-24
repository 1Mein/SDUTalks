<?php

namespace App\Http\Controllers\Saves;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Request;


class ToggleController extends Controller
{
    public function __invoke(Post $post)
    {
        $user = auth()->user();
        $result = $user->saves()->toggle($post);

        $isSaved = !empty($result['attached']);

        return response()->json(['success' => true,'post_id' => $post->id, 'is_saved' => $isSaved]);
    }
}
