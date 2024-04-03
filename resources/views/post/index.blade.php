@extends('layouts.main')
@section('posts.index')
    active
@endsection
@section('default')
    <p class="h1 text-center mb-5 text-info mt-5"> Posts </p>
    <div class="w-75 mx-auto">
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
