<?php

namespace App\Http\Service\Post;

use App\Models\Post;
use App\Models\User;

class Service
{
    public function store($data){
        $data['user_id'] = auth()->user()->id;
        Post::create($data);
    }
}
