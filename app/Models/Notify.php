<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

        if(strlen($text)>=16){
            $suffix = '...';
        }

        return mb_substr($text,0,16,'UTF-8').$suffix;
    }


    public static function createNotify($destUser, $type, $text = '', $fromUser = null, $onPost = null, $onComment = null)
    {
        try {
            DB::beginTransaction();

            $data = [
                'type' => $type,
                'from_user' => $fromUser,
                'on_post' => $onPost,
                'on_comment' => $onComment,
                'text' => $text,
            ];

            $notify = Notify::firstOrCreate($data);

            $data = [
                'user_id' => $destUser,
                'notify_id' => $notify->id,
                'is_viewed' => 0,
            ];

            $userNotify = UserNotify::firstOrCreate($data);
            DB::commit();
        }
        catch (\Exception $exception){
            DB::rollBack();
            abort(500);
        }
    }

    public static function removeNotify($type, $fromUser, $onPost = null, $onComment = null)
    {
        try {
            DB::beginTransaction();

            $data = [
                'type' => $type,
                'from_user' => $fromUser,
                'on_post' => $onPost,
                'on_comment' => $onComment,
            ];

            $notify = Notify::where($data)->delete();
            DB::commit();
        }
        catch (\Exception $exception){
            DB::rollBack();
            abort(500);
        }
    }
}
