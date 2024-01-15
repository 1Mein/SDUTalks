<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function create(Request $request)
    {
        $message = $request->query('message', '');

        return view('auth.regPage',compact(['message']));
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required|string|unique:users|max:30',
            'password'=>'required|string|min:8|confirmed'
        ]);


        $user = User::create([
            'name'=>$request->name,
            'password' => $request->password
        ]);

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
