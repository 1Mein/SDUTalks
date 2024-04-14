<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribes extends Model
{
    use HasFactory;

    protected $table = 'subscribes';

    protected $guarded = false;

    public static function deleteSubscribe($from_user_id, $to_user_id)
    {
        return Subscribes::where('from_user_id', $from_user_id)
            ->where('to_user_id', $to_user_id)
            ->delete();
    }
}
