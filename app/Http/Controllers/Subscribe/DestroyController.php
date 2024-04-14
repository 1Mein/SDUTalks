<?php

namespace App\Http\Controllers\Subscribe;

use App\Http\Controllers\Controller;
use App\Models\Notify;
use App\Models\Post;
use App\Models\Subscribes;
use App\Models\User;
use Carbon\Carbon;

class DestroyController extends Controller
{
    public function __invoke(User $user)
    {
        Subscribes::deleteSubscribe(auth()->id(), $user->id);

        return response()->json(['id' => $user->id]);
    }
}
