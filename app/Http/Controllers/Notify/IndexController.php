<?php

namespace App\Http\Controllers\Notify;

use App\Models\Notify;
use App\Models\User;
use App\Models\UserNotify;
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
                $notify->time = 'Edited ' . Carbon::parse($notify->updated_at)->diffForHumans();
            } else {
                $notify->time = Carbon::parse($notify->created_at)->diffForHumans();
            }


            $userNotify = UserNotify::where('user_id', $user->id)->where('notify_id', $notify->id)->first();

            $notify->is_viewed = $userNotify->is_viewed;

            if(!$userNotify->is_viewed){
                $userNotify->update(['is_viewed' => true]);
            }

        }

        return view('notification.index', compact(['notifies']));
    }
}
