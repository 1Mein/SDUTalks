@extends('layouts.main')
@section('index.profile')
    active
@endsection
@section('default')
    <p class="h1 text-center mb-5 text-info mt-5"> My profile </p>
    <div class="row justify-content-center mb-5">
        <div class="col-5 card p-5 me-1">
            <p class="text-info fs-1 text-center"><b>Image</b></p>
            <img src="{{asset('storage/avatars/'.auth()->user()->avatar)}}" alt="" class="">
            <p class="m-0 mt-3 fs-3">Change your image</p>
            <form action="{{route('update.profile')}}" method="post" class="" enctype="multipart/form-data">
                @csrf
                <input type="file" name="avatar" enctype="multipart/form-data" class="form-control">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary mt-2 px-5 fs-5" type="submit">Save</button>
                </div>
                @error('avatar'){{$message}}@enderror
            </form>
        </div>
        <div class="col-5 card fs-3 p-5 pb-0 ms-1">
            <p class="text-info fs-1 text-center"><b>Information</b></p>
            <div class="d-flex justify-content-between">
                <p>Username:</p>
                <p class="text-break">{{auth()->user()->name}}</p>
            </div>
            <hr>
            <div class="d-flex justify-content-between ">
                <p>Posts:</p>
                <p class="text-break">{{$posts->count()}}</p>
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
            <hr>
            <div class="d-flex justify-content-between">
                <p>Subscribers:</p>
                <p class="text-break">{{auth()->user()->subscribers()->count()}}</p>
            </div>



            <div class="text-muted fs-5 ms-auto mt-5">
                <p>User created at: {{auth()->user()->created_at}}</p>
            </div>
        </div>
    </div>
@endsection
