<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\StoreRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(StoreRequest $request)
    {

        $data = $request->validated();
        $user = auth()->user();

        $filename = $user->name . '_' . time() . '_' . uniqid() .'.'.$request->file('avatar')->getClientOriginalExtension();

        $request->file('avatar')->storeAs('public/'.$user->avatars_path.'/',$filename);
        if($user->avatar!=='default.png'){
            Storage::delete('public/'.$user->avatars_path.'/'.$user->avatar);
        }
        $user -> update([
            'avatar' => $filename
        ]);
        return redirect()->route('index.profile');
    }
}
