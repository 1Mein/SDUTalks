@extends('layouts.main')
@section('index.subscribe')
    active
@endsection
@section('default')
    <p class="h1 text-center mb-5 text-info mt-5"> My subscriptions </p>
    <div class="mx-auto row justify-content-center mb-5 w-75">
        @foreach($users as $user)
            @include('includes.subscribedUserBlock')
        @endforeach
    </div>
@endsection
