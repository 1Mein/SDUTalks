@extends('layouts.auth')
@section('default')
    <a class="btn btn-primary fs-4 px-4" href="{{route('reg.create')}}" role="button">Registration</a>
    </div>
    <div class="">
        <p class="h2 text-center">Log in</p>
        <div class="d-flex justify-content-center mt-5">
            <form action="{{route('login.store')}}" method="post" class="card shadow-lg p-5">
                @csrf
                <p class="fs-1 text-center p-0 m-0 mb-3 text-info">Welcome back!</p>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" style="width:330px" id="username" value="{{old('name')}}" name="name" placeholder="Miko">
                    @error('name')<p class="text-danger-emphasis m-0 p-0">{{$message}}</p>@enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" style="width:330px" id="password" name="password" placeholder="Your password">
                    @error('password')<p class="text-danger-emphasis m-0 p-0">{{$message}}</p>@enderror
                </div>

                <div class="form-check mb-3 d-flex justify-content-between">
                    <div>
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            Remember me
                        </label></div>
                    <button type="submit" class="btn btn-primary">Log in!</button>
                </div>
            </form>
        </div>

@endsection
