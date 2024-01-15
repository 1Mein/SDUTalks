@extends('layouts.main')
@section('default')
    <p class="h1 text-center mb-5 text-info mt-5"> Comment </p>
    <div class="w-75 m-auto">
        <a class="btn btn-primary" href="{{route('posts.show',$comment->post_id)}}">Back to the post</a>
        @include('includes.commentBlock')
    </div>
@endsection
