<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DestroyImageController extends Controller
{
    public function __invoke(Post $post)
    {
        try {
            DB::beginTransaction();
            if ($post->image) {
                Storage::delete('public/images/' . $post->image);
                $post->image = null;
                if (!$post->content) {
                    $post->content = 'empty';
                }
                unset($post->time);
                $post->save();
            }

            DB::commit();
            return response()->json(['id' => $post->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            abort(400);
        }
    }
}
