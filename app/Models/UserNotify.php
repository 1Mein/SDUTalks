<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNotify extends Model
{
    use HasFactory;

    protected $table = 'user_notifies';
    protected $guarded = false;


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function countNotifications($userId){
        return count(UserNotify::where('user_id',$userId)->where('is_viewed',false)->get());
    }
}
