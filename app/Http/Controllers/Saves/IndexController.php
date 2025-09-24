<?php

namespace App\Http\Controllers\Saves;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();

        $posts = $user->saves()->where('is_published', 1)->orderBy('created_at', 'desc')->paginate(10);

        return view('saves.index', compact(['posts']));
    }
}
