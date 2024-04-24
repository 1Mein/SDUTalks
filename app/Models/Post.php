<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

//use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
//    use SoftDeletes;

    protected $table = 'posts';
    protected $guarded = false;


    //user
    public function user(){
        return $this->belongsTo(User::class);
    }

    //likes
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
            ->likes()
            ->where('user_id',$user->id)
            ->exists();
    }

    public function disliked(User $user) : bool
    {
        return (bool)$this
            ->dislikes()
            ->where('user_id',$user->id)
            ->exists();
    }

    //comments
    public function comments(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->hasMany(Comment::class)->get();
    }

    public function commentsQuery(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function bestCommentFunc(): Comment|HasMany|null
    {
        $bestComment = $this->commentsQuery()
            ->withCount(['likes', 'dislikes'])
            ->orderByRaw('(likes_count - dislikes_count) DESC') // Сортировка по рейтингу (лайкам минус дизлайки) в убывающем порядке
            ->first();

        if ($bestComment){
            if($bestComment->likes_count - $bestComment->dislikes_count > 0){
                return $bestComment;
            }
        }

        return null;
    }

    public function userNotifies()
    {
        $notifiesIds = $this->hasMany(Notify::class, 'on_post', 'id')->pluck('id');

        return UserNotify::whereIn('notify_id', $notifiesIds)->get();
    }


    protected static function booted()
    {
        static::deleting(function ($post) {
            $post->userNotifies()->each(function ($notify) {
                $notify->delete();
            });
        });
    }
}
