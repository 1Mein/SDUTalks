<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{
    protected $table = 'notifies';
    protected $guarded = False;

    use HasFactory;

    public function users(){
        return $this->BelongsToMany(User::class, 'user_notifies', 'notify_id', 'user_id');
    }

    public function getUsername($userId)
    {
        return User::find($userId)->name;
    }

    public function getText($post)
    {
        $post = Post::find($post);

        $text = $post->title??$post->content;
        $suffix ='';

        if(strlen($text)>=15){
            $suffix = '...';
        }

        return substr($text,0,15).$suffix;
    }

}
