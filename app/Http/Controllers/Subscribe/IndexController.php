<?php

namespace App\Http\Controllers\Subscribe;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();

        $users = $user->subscribesUsers();

        return view('subscribes.index', compact(['users']));
    }
}
