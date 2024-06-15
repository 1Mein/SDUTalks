<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {

        $users = User::limit(30)->get();

        return view('search.index', compact(['users']));
    }

    public function search(Request $request)
    {
        $query = $request->input('username') ?? '';

        $users = User::where('name', 'LIKE', $query . '%')->limit(30)->get();

        return view('partials.usersList', compact('users'));
    }
}
