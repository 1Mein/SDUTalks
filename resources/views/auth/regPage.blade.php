@extends('layouts.auth')
@section('default')
    <a class="btn btn-primary fs-4 px-4" href="{{route('login.create')}}" role="button">Log in</a>
    </div>
    <div class="">
    <p class="h2 text-center">Registration</p>
    <div class="d-flex justify-content-center mt-5">
        <form action="{{route('reg.store')}}" method="post" class="card shadow-lg p-5">
            @csrf
            <p class="fs-1 text-center p-0 m-0 mb-3 text-info">Join us!</p>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" style="width:330px" id="username" value="{{old('name')}}" name="name" placeholder="Miko">
                @error('name')<p class="text-danger-emphasis m-0 p-0">{{$message}}</p>@enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" style="width:330px" id="password" name="password" placeholder="Minimum 8 characters">
                @error('password')<p class="text-danger-emphasis m-0 p-0">{{$message}}</p>@enderror
            </div>
            <div class="mb-3">
                <label for="conPass" class="form-label">Confirm password</label>
                <input type="password" class="form-control" style="width:330px" id="conPass" name="password_confirmation" placeholder="Minimum 8 characters">
                @error('password_confirmation')<p class="text-danger m-0 p-0">{{$message}}</p>@enderror
            </div>

            <div class="form-check mb-3 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
    </div>

@endsection
