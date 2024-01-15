@extends('layouts.main')
@section('posts.profile')
    active
@endsection
@section('default')
    <p class="h1 text-center mb-5 text-info mt-5"> My posts </p>
    <div class="w-75 mx-auto">
        <div class="d-flex justify-content-center">
{{--            {{dd($page)}}--}}
            {{$posts->appends(['page' => '2'])->links()}}
        </div>

        @foreach($posts as $post)
            @include('includes.postCard')
        @endforeach

        <div class="d-flex justify-content-center">
            {{$posts->links()}}
        </div>
    </div>
@endsection
