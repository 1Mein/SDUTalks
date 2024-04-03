@extends('layouts.header')
@section('main')
    <body>
    <main class="row m-0">
        <div class="col-2 text-bg-dark p-4">
            <a href="{{route('posts.index')}}" class="d-block text-center mb-3 text-decoration-none">
                <span class="fs-2 text-info">SduTalks!</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column">
                <li>
                    <a href="{{route('posts.index')}}" class="nav-link text-white @yield('posts.index')"
                       aria-current="page">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{route('posts.create')}}" class="nav-link text-white @yield('posts.create')">
                        Create post
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white">
                        Search user
                    </a>
                </li>
                @auth
                    <li>
                        <a href="{{route('posts.profile')}}" class="nav-link text-white @yield('posts.profile')">
                            Manage your posts
                        </a>
                    </li>
                    <li>
                        <a href="{{route('index.profile')}}" class="nav-link text-white @yield('index.profile')">
                            Your profile
                        </a>
                    </li>
                @endauth
            </ul>
            <hr>
            <div class="user-info">
                @auth

                    <img src="{{ asset('storage/avatars/' . auth()->user()->avatar) }}" role="button"
                         data-bs-toggle="modal" data-bs-target="#avatar" alt="" width="32" height="32"
                         class="rounded-circle me-2 avatar">


                    <div class="modal fade" id="avatar" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <img src="{{ asset('storage/avatars/' . auth()->user()->avatar) }}" alt="" class="p-3">
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{route('index.profile')}}" class="text-white fs-6"
                       style="text-decoration: none"><strong>{{auth()->user()->name}}</strong></a>

                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger mt-3">Log out</button>
                    </form>
                @else
                    <a class="btn btn-primary" href="{{route('login.create')}}" role="button">Log in</a>
                    <a class="btn btn-primary ms-2" href="{{route('reg.create')}}" role="button">Register</a>
                @endif</div>
        </div>
        <div class="col-10">
            @yield('default')
        </div>
    </main>
{{--    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>--}}
    <script type="module">
        $(document).ready(function () {
            $('.like-btn').on('click', function () {
                var postId = $(this).data('post-id');
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'POST',
                    url: '/posts/' + postId + '/like',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function (response) {
                        // Обновляем отображение лайков на странице
                        var dif = response.likes - response.dislikes;
                        var count = document.querySelector('.likes-count' + response.id);
                        var likeButton = document.querySelector('#forlike' + response.id);
                        var dislikeButton = document.querySelector('#fordislike' + response.id);


                        count.classList.toggle('text-success-emphasis', dif > 0);
                        count.classList.toggle('text-danger-emphasis', dif < 0);
                        count.innerHTML = dif;

                        likeButton.classList.toggle('btn-success');
                        likeButton.classList.toggle('btn-outline-secondary');

                        if (response.action === 'undislike like') {
                            dislikeButton.classList.toggle('btn-danger');
                            dislikeButton.classList.toggle('btn-outline-secondary');
                        }
                    }
                });
            });

            $('.dislike-btn').on('click', function () {
                var postId = $(this).data('post-id');
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'POST',
                    url: '/posts/' + postId + '/dislike',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function (response) {
                        // Обновляем отображение дизлайков на странице
                        var dif = response.likes - response.dislikes;
                        var count = document.querySelector('.likes-count' + response.id);
                        var likeButton = document.querySelector('#forlike' + response.id);
                        var dislikeButton = document.querySelector('#fordislike' + response.id);


                        count.classList.toggle('text-success-emphasis', dif > 0);
                        count.classList.toggle('text-danger-emphasis', dif < 0);
                        count.innerHTML = dif;

                        dislikeButton.classList.toggle('btn-danger');
                        dislikeButton.classList.toggle('btn-outline-secondary');

                        if (response.action === 'unlike dislike') {
                            likeButton.classList.toggle('btn-success');
                            likeButton.classList.toggle('btn-outline-secondary');
                        }
                    }
                });
            });
        });
        $('.toggle-post').on('click', function () {
            var postId = $(this).data('post-id');
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: 'PATCH',
                url: '/posts/' + postId + '/toggle',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (response) {
                    if(response.success){
                        var togglePost = document.querySelector('.tgp-' + postId);
                        console.log(postId);
                        togglePost.innerHTML = '';

                        if (response.is_published) {
                            togglePost.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#5cb85c" class="bi bi-toggle-on" viewBox="0 0 16 16"><path d="M5 3a5 5 0 0 0 0 10h6a5 5 0 0 0 0-10zm6 9a4 4 0 1 1 0-8 4 4 0 0 1 0 8"/></svg>';
                        }
                        else{
                            togglePost.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#d9534f" class="bi bi-toggle-off" viewBox="0 0 16 16"><path d="M11 4a4 4 0 0 1 0 8H8a4.992 4.992 0 0 0 2-4 4.992 4.992 0 0 0-2-4zm-6 8a4 4 0 1 1 0-8 4 4 0 0 1 0 8M0 8a5 5 0 0 0 5 5h6a5 5 0 0 0 0-10H5a5 5 0 0 0-5 5"/></svg>';
                        }
                    }
                }
            })
        });

        $('form').on('submit', function(e){
            var submitButton = $(this).find('button[type="submit"]');

            submitButton.prop('disabled', true);
            submitButton.html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span role="status"> Loading...</span>');
        });


        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
    </script>
    </body>
@endsection
