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

    //posts
    public function posts(){
        return $this->hasMany(Post::class);
    }

    //likes
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
            ->likes()
            ->where('post_id',$post->id)
            ->exists();
    }

    public function disliked(Post $post) : bool
    {
        return (bool)$this
            ->dislikes()
            ->where('post_id',$post->id)
            ->exists();
    }

    //comments
    public function comments()
    {
        return $this->hasMany(Comment::class)->get();
    }


    public function notifies(){
        return $this->BelongsToMany(Notify::class, 'user_notifies', 'user_id', 'notify_id');
    }


    public function subscribes(){
        return $this->hasMany(Subscribes::class,'from_user_id');
    }

    public function subscribers(){
        return $this->hasMany(Subscribes::class,'to_user_id');
    }

    public function subscribesUsers(){
        $subscribes = $this->subscribes()->pluck('to_user_id')->toArray();
        $users = User::whereIn('id', $subscribes)->get();
        return $users;
    }

    public function subscribersNotifiedUsers(){
        $subscribers = $this->subscribers()->where('is_notify',true)->pluck('from_user_id')->toArray();
        $users = User::whereIn('id', $subscribers)->get();
        return $users;
    }


    public function subscribedTo():bool
    {
        return (bool)Subscribes::where('from_user_id', auth()->id())->where('to_user_id',$this->id)->count();
    }

    public function notificationEnabled():bool
    {
        return (bool)Subscribes::where('from_user_id', auth()->id())
            ->where('to_user_id',$this->id)
            ->where('is_notify',true)
            ->count();
    }
}
