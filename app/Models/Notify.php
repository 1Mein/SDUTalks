<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{
    protected $table = 'notifies';
    protected $guarded = False;

    use HasFactory;

    public function getUsername($userId)
    {
        return User::find($userId)->name;
    }

    public function users(){
        return $this->BelongsToMany(User::class, 'user_notifies', 'notify_id', 'user_id');
    }
}
