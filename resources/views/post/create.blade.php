@extends('layouts.main')
@section('posts.create')
    active
@endsection
@section('default')
    <p class="h1 text-center mb-5 mt-5 text-info"> Create your own post </p>
    <form action="{{route('posts.store')}}" method="post" class="w-50 m-auto">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label fs-5 d-flex justify-content-between">Title<p class="text-muted p-0 m-0">Max 80 characters</p></label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Minecraft!" value="{{old("title")}}">
            @error('title')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="content" class="form-label fs-5 d-flex justify-content-between">Content<p class="text-muted p-0 m-0">Max 80.000 characters</p></label>
            <textarea name="content" class="form-control" id="content" rows="3"
                      placeholder="I love this version of minecraft.">{{old("content")}}</textarea>
            @error('content')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="text-end">
            <button class="btn btn-primary" type="submit">Upload (>o<)</button>
        </div>
    </form>
@endsection
