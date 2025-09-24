<?php

namespace App\Http\Controllers\Saves;

use App\Http\Controllers\Controller;
use App\Models\Notify;
use App\Models\Post;
use App\Models\Saves;
use App\Models\Subscribes;
use App\Models\User;
use Carbon\Carbon;

class DestroyController extends Controller
{
    public function __invoke(Post $post)
    {
        $user = auth()->user();

        $user->saves()->detach($post->id);

        return response()->json(['success' => true]);
    }
}
