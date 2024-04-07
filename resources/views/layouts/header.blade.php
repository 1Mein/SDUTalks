<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
{{--    <link rel="shortcut icon" href="../css/logo.png" type="image/x-icon">--}}

    <!-- Bootstrap CSS via CDN -->
{{--    @vite(['resources/css/app.css'])--}}
{{--    @vite(['resources/js/app.js'])--}}
{{--    @vite(['resources/sass/app.scss'])--}}
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <title>SDU Talks!</title>
</head>
<style>
    body {
        background: #212529;
    }
    .delete-comment:hover{
        cursor: pointer;
    }
    .delete-notification:hover{
        cursor: pointer;
    }
    .delete-image:hover{
        cursor: pointer;
    }
    .nav-link:hover {
        border: #007bff 1px solid;
        margin: 2px 0;
        transform: scale(1.05);
    }

    .nav-link {
        border: rgb(0,0,0,0) 1px solid;
        margin: 2px 0;
    }

    .logotype{
        transition: 0.7s;
    }

    .logotype:hover{
        transform: scale(1.05);
    }
</style>


@yield('main')


</html>
