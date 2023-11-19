<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'posts';
    protected $guarded = false;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class)->where('is_like',true);
    }

    public function dislikes(){
        return $this->hasMany(Like::class)->where('is_like',false);
    }

    public function liked(User $user) : bool
    {
        return (bool)$this
            ->hasMany(Like::class)
            ->where('is_like',true)
            ->where('user_id',$user->id)
            ->count();
    }

    public function disliked(User $user) : bool
    {
        return (bool)$this
            ->hasMany(Like::class)
            ->where('is_like',false)
            ->where('user_id',$user->id)
            ->count();
    }
}
