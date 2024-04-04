@extends('layouts.main')
@section('index.notification')
    active
@endsection
@section('default')

    <p class="h1 text-center mb-5 text-info mt-5">Notifications</p>
    <div class="w-75 mx-auto text-white">
        @foreach($notifies as $notify)
            @include('includes.notificationBlock')
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{$notifies->onEachSide(0)->links()}}
    </div>
@endsection

