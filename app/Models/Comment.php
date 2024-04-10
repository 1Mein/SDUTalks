<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $guarded = False;

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

//    public static function repliedComment($commentId){
//        Comment
//        return $comment;
//    }

    //likes
    public function likes()
    {
        return $this->hasMany(CommentLikes::class)->where('is_like',true);
    }

    public function dislikes(){
        return $this->hasMany(CommentLikes::class)->where('is_like',false);
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
}
