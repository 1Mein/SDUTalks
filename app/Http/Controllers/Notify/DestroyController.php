<?php

namespace App\Http\Controllers\Notify;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Notify;
use App\Models\UserNotify;

class DestroyController extends Controller
{
    public function __invoke(Notify $notify)
    {
        UserNotify::whereHas('user', function ($query) {
            $query->where('id', auth()->id());
        })->where('notify_id', $notify->id)->delete();
        return response()->json(['id' => $notify->id]);
    }
}
