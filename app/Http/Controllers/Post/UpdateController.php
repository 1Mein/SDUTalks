<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Comment\BaseController;
use App\Http\Requests\Post\UpdateRequest;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request,Post $post)
    {

        $data = $request->validated();
        try{
            DB::beginTransaction();
            if (isset($data['image'])){
                Storage::delete('public/images/'.$post->image);


                $filename = preg_replace("/[^a-zA-Z0-9-_\.]/", "", $request->file('image')->getClientOriginalName());

                $filename = time() . '_' . $filename;
                $request->file('image')->storeAs('public/images/', $filename);

                $data['image'] = $filename;
            }
            else if (isset($post->image)){
                $data['image'] = $post->image;
            }
            else if(!isset($data['content'])){
                $data['content'] = 'empty';
            }
            unset($post->time);
            $post->update($data);
            DB::commit();
            return redirect()->route('posts.profile');
        } catch (\Exception $e){
            DB::rollBack();
            dd($e);
            abort(400);
        }

    }
}
