@extends('layouts.main')
@section('index.subscribe')
    active
@endsection
@section('default')
    <p class="h1 text-center mb-5 text-info mt-5"> My subscriptions </p>
    <div class="mx-auto row justify-content-center mb-5 w-75">
        @if(!count($users))
            <h5 class="text-center mt-5">Subscribe to someone :(</h5>
        @else
            @foreach($users as $user)
                @include('includes.subscribedUserBlock')
            @endforeach
        @endif
    </div>
@endsection
