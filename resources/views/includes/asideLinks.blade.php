<li>
    <a href="{{route('posts.index')}}" class="nav-link p-2 text-white @yield('posts.index')" aria-current="page">
        Home
    </a>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle p-2 text-white @yield('services')"  data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Services</a>
    <div class="dropdown-menu p-2">
        <a class="dropdown-item nav-link p-2 text-white @yield('services.teacher.index') " href="{{route('services.teacher.index')}}">Teacher's schedule</a>
        <a class="dropdown-item nav-link p-2 text-white @yield('services.cabinet.index') " href="{{route('services.cabinet.index')}}">Cabinet's schedule</a>
        <a class="dropdown-item nav-link p-2 text-white" href="#">secret</a>
{{--        <div class="dropdown-divider"></div>--}}
{{--        <a class="dropdown-item" href="#">Separated link</a>--}}
    </div>
</li>
<li>
    <a href="{{route('posts.create')}}" class="nav-link p-2 text-white @yield('posts.create')">
        Create post
    </a>
</li>
<li>
    <a href="{{route('index.profile.search')}}" class="nav-link p-2 text-white @yield('search.index')">
        Search user
    </a>
</li>
@auth
    <hr>
    <li>
        <a href="{{route('index.subscribe')}}" class="nav-link p-2 text-white @yield('index.subscribe') d-flex justify-content-between">
            Subscribes
        </a>
    </li>
    <li>
        <a href="{{route('notifies.index')}}" class="nav-link p-2 text-white @yield('index.notification') d-flex justify-content-between">
            Notifications
            @php
                $notificationCount = \App\Models\UserNotify::countNotifications(auth()->id());
            @endphp
            @if($notificationCount > 0)
                <div class="bg-danger rounded-5 px-2" style="font-size: 15px">
                    {{ $notificationCount > 9 ? '9+' : $notificationCount }}
                </div>
            @endif
        </a>
    </li>
    <li>
        <a href="{{route('posts.profile')}}" class="nav-link p-2 text-white @yield('posts.profile')">
            My posts
        </a>
    </li>
    <li>
        <a href="{{route('index.profile')}}" class="nav-link p-2 text-white @yield('index.profile')">
            Your profile
        </a>
    </li>
@endauth

<hr>
<div class="user-info d-flex justify-content-between">
    @auth
        <div>
            <img src="{{ asset('storage/avatars/' . auth()->user()->avatar) }}" role="button"
                 data-bs-toggle="modal" data-bs-target="#avatar" alt="" width="32" height="32"
                 class="rounded-circle me-2 avatar">
            <div class="modal fade" id="avatar" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <img src="{{ asset('storage/avatars/' . auth()->user()->avatar) }}" alt=""
                             class="p-3">
                    </div>
                </div>
            </div>
            <a href="{{route('index.profile')}}" class="text-white fs-6" style="text-decoration: none">
                <strong>{{auth()->user()->name}}</strong>
            </a>
        </div>
        <form action="{{route('logout')}}" method="post">
            @csrf
            <button type="submit" class="btn btn-danger m-0 pt-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-open-fill" viewBox="0 0 16 16">
                    <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15zM11 2h.5a.5.5 0 0 1 .5.5V15h-1zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1"/>
                </svg>
            </button>
        </form>
    @else
        <div class="text-center">
            <a class="btn btn-primary" href="{{route('login.create')}}" role="button">Log in</a>
            <a class="btn btn-primary ms-2" href="{{route('reg.create')}}" role="button">Register</a>
        </div>
    @endif
</div>


<style>
    .nav-pills .show>.nav-link {
        color: var(--bs-nav-pills-link-active-color);
        background-color: transparent;
    }

    .nav-pills .nav-link.active {
        color: var(--bs-nav-pills-link-active-color);
        background-color: var(--bs-nav-pills-link-active-bg);
    }
</style>
