@extends('layouts.main')
@section('posts.create')
    active
@endsection
@section('default')
    <p class="h1 text-center mb-5 mt-5 text-info"> Create your own post </p>
    <form action="{{route('posts.store')}}" method="post" class="w-50 m-auto text-white p-0" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label fs-5 d-flex justify-content-between">Title<p
                    class="form-text p-0 m-0">Max 80 characters</p></label>
            <input type="text" name="title" class="form-control text-white" id="title"
                   placeholder="Minecraft!(This field is not required)" value="{{old("title")}}">
            @error('title')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="content" class="form-label fs-5 d-flex justify-content-between">Content<p
                    class="form-text p-0 m-0">Max 80.000 characters</p></label>
            <textarea name="content" class="form-control text-white" id="content" rows="5"
                      placeholder="I love this version of minecraft.">{{old("content")}}</textarea>
            @error('content')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label fs-5 d-flex justify-content-between">Image/Video/Audio<p
                    class="form-text p-0 m-0">Max 25 MB</p></label>
            <input class="form-control" type="file" id="image" name="image" value="{{old("image")}}">
            @error('image')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="d-flex justify-content-between">
            <div class="form-check">
                <input name="is_anonymous" class="form-check-input" type="checkbox" id="anonymous">
                <label class="form-check-label" for="anonymous">
                    Anonymous
                </label>
            </div>
            <div class="">
                <button class="btn btn-primary" type="submit">Upload (>o<)</button>
            </div>
        </div>

        <p class="mt-5 text-white-50">Память 2 гб на хосте, поэтому пока макс 25 МБ но вы не наглейте там, экономьте память. Сделайте качество похуже и все.</p>
        <p class="text-white-50">Если что аноним реально работает. Там в бд автором будешь не ты, а аккаунт который
            я создал и дал имя аноним. Пруфы есть если что, и код открытый. В гитхабе есть.</p>

    </form>

@endsection
