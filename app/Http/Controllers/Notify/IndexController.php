<?php

namespace App\Http\Controllers\Notify;

use App\Models\Notify;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\Post;

class IndexController extends Controller
{
    public function __constuct()
    {
        $this->middleware('auth');
    }

    public function __invoke()
    {
        $user = \auth()->user();
        $notifies = $user->notifies()->orderBy('created_at', 'desc')->paginate(20);

        foreach ($notifies as $notify) {
            if ($notify->updated_at != $notify->created_at) {
                $notify->time = 'Edited '.Carbon::parse($notify->updated_at)->diffForHumans();
            } else {
                $notify->time = Carbon::parse($notify->created_at)->diffForHumans();
            }
        }

        return view('notification.index', compact(['notifies']));
    }
}
