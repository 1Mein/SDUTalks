<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saves extends Model
{
    use HasFactory;

    protected $table = 'save_users';

    protected $guarded = false;


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
