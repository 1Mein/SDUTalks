@extends('layouts.main')
@section('default')
    <p class="h1 text-center mb-5 text-info mt-5"> Profile </p>
    <div class="row justify-content-center mb-5">
        <div class="col-5 card p-5">
            <p class="text-info fs-1 text-center"><b>Image</b></p>
            <img src="{{asset('storage/avatars/'.$user->avatar)}}" alt="" class="">
            <div class="mt-5"></div>
            <div class="ms-auto mt-auto">
                @if($user->subscribedTo())
                    @include('includes.unsubscribeButton')

                    @if($user->notificationEnabled())
                        @include('includes.enabledNotify')
                    @else
                        @include('includes.disabledNotify')
                    @endif
                @else
                    @include('includes.subscribeButton')
                @endif
            </div>

        </div>
        <div class="col-5 card fs-3 p-5 pb-0">
            <p class="text-info fs-1 text-center"><b>Information</b></p>
            <div class="d-flex justify-content-between">
                <p>Username:</p>
                <p class="text-break">{{$user->name}}</p>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <p>Posts:</p>
                <p class="text-break">{{$data['count']}}</p>
            </div>
            <hr>
            <div class="d-flex justify-content-between ">
                <p>Likes:</p>
                <p class="text-break  @if($data['likes'] != 0) text-success-emphasis @endif">{{$data['likes']}}</p>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <p>Dislikes:</p>
                <p class="text-break  @if($data['dislikes'] != 0) text-danger-emphasis @endif">{{$data['dislikes']}}</p>
            </div>


            <div class="text-muted fs-5 ms-auto mt-5">
                <p>User created at: {{$user->created_at}}</p>
            </div>
        </div>
    </div>

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
