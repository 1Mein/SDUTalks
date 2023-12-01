<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $guarded = false;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class)->where('is_like',true);
    }

    public function dislikes(){
        return $this->hasMany(Like::class)->where('is_like',false);
    }

    public function liked(Post $post) : bool
    {
        return (bool)$this
            ->hasMany(Like::class)
            ->where('is_like',true)
            ->where('post_id',$post->id)
            ->count();
    }

    public function disliked(Post $post) : bool
    {
        return (bool)$this
            ->hasMany(Like::class)
            ->where('is_like',false)
            ->where('post_id',$post->id)
            ->count();
    }
}
