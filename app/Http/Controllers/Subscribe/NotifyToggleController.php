<?php

namespace App\Http\Controllers\Subscribe;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Subscribes;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class NotifyToggleController extends Controller
{
    public function __invoke(User $user)
    {
        $authUser = auth()->user();

        Subscribes::where('from_user_id', $authUser->id)
            ->where('to_user_id', $user->id)
            ->update(['is_notify' => DB::raw('NOT is_notify')]);

        return response()->json(['id' => $user->id]);
    }
}
