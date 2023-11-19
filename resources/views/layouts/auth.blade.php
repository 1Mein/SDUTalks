@extends('layouts.header')
@section('main')
<body>
<main class="m-0">
    <div class="text-bg-dark p-4 d-flex justify-content-between">
        <a href="{{route('posts.index')}}" class="d-block ms-3 text-decoration-none">
            <span class="fs-2 text-info">SduTalks!</span>
        </a>
        @yield('default')
    </div>
</main>
@if($message)
<div class="alert alert-danger fixed-bottom w-25 p-2 ms-auto me-3" role="alert">
    {{$message}}
</div>
@endif
</body>
@endsection
