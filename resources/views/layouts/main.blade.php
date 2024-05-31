@extends('layouts.header')

@section('main')
    <body>
    <main class="row m-0">
        <div class="col-md-2 text-bg-dark p-4 d-none d-md-block">
            <a href="{{route('posts.index')}}" class="d-block text-center mb-3 text-decoration-none logotype">
                <img class="w-75" src="{{ asset('images/logo.png') }}" alt="">
            </a>
            <hr>
            <ul class="navbar-nav justify-content-end nav-pills flex-column">
                @include('includes.asideLinks')
            </ul>
        </div>

        <div class="col-12 d-md-none">
            <nav class="navbar navbar-dark bg-dark">
                <div class="container-fluid">
                    <a href="{{route('posts.index')}}" class="navbar-brand">SDU Talks</a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="offcanvas offcanvas-end w-75" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <a href="{{route('posts.index')}}" class="offcanvas-title navbar-brand mx-auto" id="offcanvasNavbarLabel">
                            <img src="{{ asset('images/logo.png') }}" alt="" class="d-inline-block align-text-top" width="90" height="90">
                        </a>
                        <hr class="mx-3">
                        <div class="offcanvas-body">
                            <ul class="navbar-nav justify-content-end nav-pills flex-column">
                                @include('includes.asideLinks')
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <div class="col-md-10">
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



            $('.com-like-btn').on('click', function () {
                var commentId = $(this).data('comment-id');
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'POST',
                    url: '/comment/' + commentId + '/like',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function (response) {
                        // Обновляем отображение лайков на странице
                        var dif = response.likes - response.dislikes;
                        var count = document.querySelector('.comlikes-count' + response.id);
                        var likeButton = document.querySelector('#comforlike' + response.id);
                        var dislikeButton = document.querySelector('#comfordislike' + response.id);


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

            $('.com-dislike-btn').on('click', function () {
                var commentId = $(this).data('comment-id');
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'POST',
                    url: '/comment/' + commentId + '/dislike',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function (response) {
                        // Обновляем отображение дизлайков на странице
                        var dif = response.likes - response.dislikes;
                        var count = document.querySelector('.comlikes-count' + response.id);
                        var likeButton = document.querySelector('#comforlike' + response.id);
                        var dislikeButton = document.querySelector('#comfordislike' + response.id);


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
                    if (response.success) {
                        var togglePost = document.querySelector('.tgp-' + postId);
                        console.log(postId);
                        togglePost.innerHTML = '';

                        if (response.is_published) {
                            togglePost.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#5cb85c" class="bi bi-toggle-on" viewBox="0 0 16 16"><path d="M5 3a5 5 0 0 0 0 10h6a5 5 0 0 0 0-10zm6 9a4 4 0 1 1 0-8 4 4 0 0 1 0 8"/></svg>';
                        } else {
                            togglePost.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#d9534f" class="bi bi-toggle-off" viewBox="0 0 16 16"><path d="M11 4a4 4 0 0 1 0 8H8a4.992 4.992 0 0 0 2-4 4.992 4.992 0 0 0-2-4zm-6 8a4 4 0 1 1 0-8 4 4 0 0 1 0 8M0 8a5 5 0 0 0 5 5h6a5 5 0 0 0 0-10H5a5 5 0 0 0-5 5"/></svg>';
                        }
                    }
                }
            })
        });

        $('.delete-comment').on('click', function () {
            var commentId = $(this).data('comment-id');
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var $commentMain = $(this).closest('.comment-main');

            $.ajax({
                type: 'DELETE',
                url: '/comment/' + commentId,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (response) {
                    if(typeof response.error !== 'undefined'){
                        console.log(response.error);
                        return;
                    }

                    $commentMain.remove();
                },
                error: function(error){
                    console.log(error);
                }
            });
        });

        $('.delete-notification').on('click', function () {
            var notificationId = $(this).data('notification-id');
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var $notificationMain = $(this).closest('.notification-main');

            $.ajax({
                type: 'DELETE',
                url: '/notifies/' + notificationId,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (response) {
                    if(typeof response.error !== 'undefined'){
                        console.log(response.error);
                        return;
                    }

                    $notificationMain.remove();
                },
                error: function(error){
                    console.log(error);
                }
            });
        });

        $('.delete-image').on('click', function () {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var postId = $(this).data('post-id');
            var $imageMain = $(this).closest('.image-main');

            $.ajax({
                type: 'DELETE',
                url: '/posts/' + postId + '/image',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (response) {
                    if(typeof response.error !== 'undefined'){
                        console.log(response.error);
                        return;
                    }

                    $imageMain.remove();
                },
                error: function(error){
                    console.log(error);
                }
            });
        });


        $('.reply-comment').on('click', function () {
            let commentId = $(this).data('comment-id');
            let csrfToken = $('meta[name="csrf-token"]').attr('content');
            let commentMain = $(this).closest('.comment-main');
            let commentAuthor = commentMain.find('.comment-author')
            let commentText = commentMain.find('.comment-text')

            let wrapper = $('.reply-wrapper')

            let text = '<div class="my-1 p-2 bg-dark-subtle rounded-3">' +
                '<div>' +
                '<span>Reply to: ' + commentAuthor.text() + '</span>' +
                '<a href="" class="text-white-50" onclick="cancelReply(event)" type="button">' +
                '<i class="ms-3 me-1 bi bi-x-circle"></i>' +
                'Cancel' +
                '</a>' +
                '</div>' +
                '<span style="word-wrap: break-word;">' + commentText.text() + '</span>' +
                '</div>' +
                '<input type="hidden" name="on_comment" value="' + commentId + '">';


            @if(isset($comment))
                if (!window.location.href.endsWith('/posts/{{$comment->post_id}}')){
                    localStorage.setItem('comment-reply', 'true');
                    localStorage.setItem('replied-comment', text);

                    window.location.replace('/posts/{{$comment->post_id}}')
                }
            @endif

            wrapper.html(text);
        })


        $('form').on('submit', function (e) {
            var submitButton = $(this).find('button[type="submit"]');

            submitButton.prop('disabled', true);
            submitButton.html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span role="status"> Loading...</span>');
        });

        if (localStorage.getItem('comment-reply') === 'true'){
            let wrapper = $('.reply-wrapper')
            wrapper.html(localStorage.getItem('replied-comment'));
            localStorage.removeItem('comment-reply');
            localStorage.removeItem('replied-comment');
        }

        $(document).on('click','.unsubscribe', function(){
            let userId = $(this).data('user-id');
            let csrfToken = $('meta[name="csrf-token"]').attr('content');
            let button = $(this);
            let container = button.parent();

            button.addClass('disable');
            $.ajax({
                type: 'DELETE',
                url: '/subscribe/' + userId,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (response) {
                    if(typeof response.error !== 'undefined'){
                        console.log(response.error);
                        return;
                    }

                    container.find('.notify').remove();

                    button.toggleClass('btn-secondary btn-primary');
                    button.toggleClass('unsubscribe subscribe');
                    button.text('Subscribe');
                },
                error: function(error){
                    console.log(error);
                },
                complete: function() {
                    button.removeClass('disable');
                }
            });
        })

        $(document).on('click','.subscribe', function(){
            let userId = $(this).data('user-id');
            let csrfToken = $('meta[name="csrf-token"]').attr('content');
            let button = $(this);
            let container = button.parent();

            button.addClass('disable');
            $.ajax({
                type: 'POST',
                url: '/subscribe/' + userId,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (response) {
                    if(typeof response.error !== 'undefined'){
                        console.log(response.error);
                        return;
                    }

                    container.append('<button class="btn btn-warning notify notify-on" data-user-id="'+response.id+'">' +
                    '<i class="bi bi-bell"></i> ' +
                    '</button>')
                    button.toggleClass('btn-secondary btn-primary');
                    button.toggleClass('unsubscribe subscribe');
                    button.text('You are subscribed');
                },
                error: function(error){
                    console.log(error);
                },
                complete: function() {
                    button.removeClass('disable');
                }
            });
        })

        $(document).on('click','.notify-on', function(){
            let userId = $(this).data('user-id');
            let csrfToken = $('meta[name="csrf-token"]').attr('content');
            let button = $(this);

            button.addClass('disable');
            $.ajax({
                type: 'POST',
                url: '/subscribe/' + userId + '/notify',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (response) {
                    if(typeof response.error !== 'undefined'){
                        console.log(response.error);
                        return;
                    }

                    button.toggleClass('notify-off notify-on');
                    button.find('i').toggleClass('bi-bell bi-bell-slash')

                    button.attr('title', 'Turn off notifications');
                },
                error: function(error){
                    console.log(error);
                },
                complete: function() {
                    button.removeClass('disable');
                }
            });
        })

        $(document).on('click','.notify-off', function(){
            let userId = $(this).data('user-id');
            let csrfToken = $('meta[name="csrf-token"]').attr('content');
            let button = $(this);

            button.addClass('disable');
            $.ajax({
                type: 'POST',
                url: '/subscribe/' + userId + '/notify',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (response) {
                    if(typeof response.error !== 'undefined'){
                        console.log(response.error);
                        return;
                    }

                    button.toggleClass('notify-off notify-on');
                    button.find('i').toggleClass('bi-bell bi-bell-slash')

                    button.attr('title', 'Turn on notifications');
                },
                error: function(error){
                    console.log(error);
                },
                complete: function() {
                    button.removeClass('disable');
                }
            });
        })

        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
    </script>

    <script>
        cancelReply = function (event) {
            event.preventDefault();
            let wrapper = $('.reply-wrapper');
            wrapper.html('');
        }
    </script>
    </body>
@endsection
