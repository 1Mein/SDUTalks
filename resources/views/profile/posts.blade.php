@extends('layouts.main')
@section('posts.profile')
    active
@endsection
@section('default')


    <p class="h1 text-center mb-5 text-info mt-5"> My posts </p>
    <div class="w-75 mx-auto" id="post-container">
        <div class="d-flex justify-content-center">
            {{$posts->onEachSide(0)->links()}}
        </div>

        @foreach($posts as $post)
            @include('includes.postCard')
        @endforeach

        <div class="d-flex justify-content-center">
            {{$posts->onEachSide(0)->links()}}
        </div>
    </div>
@endsection
