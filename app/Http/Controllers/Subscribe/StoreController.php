<?php

namespace App\Http\Controllers\Subscribe;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\StoreRequest;
use App\Models\Subscribes;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(User $user)
    {

        $authUser = auth()->user();

        Subscribes::create(['from_user_id' => $authUser->id,
                            'to_user_id' => $user->id]);

        return response()->json(['id' => $user->id]);
    }
}
