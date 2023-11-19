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
                                <img src="{{ asset('storage/avatars/' . auth()->user()->avatar) }}" alt="" class="p-3">
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
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
                        var dif = response.likes - response.dislikes
                        var count = document.querySelector('.likes-count' + response.id)
                        if (dif > 0) {
                            count.classList.add('text-success-emphasis')
                            count.classList.remove('text-danger-emphasis')
                        } else if (dif < 0) {
                            count.classList.add('text-danger-emphasis')
                            count.classList.remove('text-success-emphasis')
                        } else {
                            count.classList.remove('text-success-emphasis')
                            count.classList.remove('text-danger-emphasis')
                        }
                        $('.likes-count' + response.id).text(dif);

                        var likeButton = document.querySelector('#forlike' + response.id)
                        if (response.action === 'like') {
                            likeButton.classList.add('btn-success')
                            likeButton.classList.remove('btn-outline-secondary')
                        }
                        else if(response.action === 'unlike'){
                            likeButton.classList.remove('btn-success')
                            likeButton.classList.add('btn-outline-secondary')
                        }
                        else{
                            var dislikeButton = document.querySelector('#fordislike' + response.id)
                            likeButton.classList.add('btn-success')
                            likeButton.classList.remove('btn-outline-secondary')
                            dislikeButton.classList.remove('btn-danger')
                            dislikeButton.classList.add('btn-outline-secondary')
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
                        var dif = response.likes - response.dislikes
                        var count = document.querySelector('.likes-count' + response.id)
                        if (dif > 0) {
                            count.classList.add('text-success-emphasis')
                            count.classList.remove('text-danger-emphasis')
                        } else if (dif < 0) {
                            count.classList.add('text-danger-emphasis')
                            count.classList.remove('text-success-emphasis')
                        } else {
                            count.classList.remove('text-success-emphasis')
                            count.classList.remove('text-danger-emphasis')
                        }
                        $('.likes-count' + response.id).text(dif);

                        var dislikeButton = document.querySelector('#fordislike' + response.id)
                        if (response.action === 'dislike') {
                            dislikeButton.classList.add('btn-danger')
                            dislikeButton.classList.remove('btn-outline-secondary')
                        }
                        else if(response.action === 'undislike'){
                            dislikeButton.classList.remove('btn-danger')
                            dislikeButton.classList.add('btn-outline-secondary')
                        }
                        else{
                            var likeButton = document.querySelector('#forlike' + response.id)
                            dislikeButton.classList.add('btn-danger')
                            dislikeButton.classList.remove('btn-outline-secondary')
                            likeButton.classList.remove('btn-success')
                            likeButton.classList.add('btn-outline-secondary')
                        }
                    }
                });
            });
        });
    </script>
    </body>
@endsection
