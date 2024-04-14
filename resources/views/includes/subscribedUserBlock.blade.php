<div class="bg-dark-subtle p-3 rounded-4 my-2 comment-main">
    <div class="d-flex justify-content-between">

        <div>
        <img src="{{asset('storage/avatars/'.$user->avatar)}}" role="button" data-bs-toggle="modal"
             data-bs-target="{{'#post'.$user->id}}" alt="" width="40" height="40"
             class="rounded-circle me-2">
        <div class="modal fade" id="{{'post'.$user->id}}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <img src="{{ asset('storage/avatars/'.$user->avatar)}}" alt="" class="p-3">
                </div>
            </div>
        </div>
        <a class="m-0 text-white text-break my-auto me-2 comment-author" href="{{route('show.profile',$user)}}"
           style="text-decoration: none">{{$user->name}}</a>

        </div>
        <div class="my-auto me-2">
            @include('includes.unsubscribeButton')
            @if($user->notificationEnabled())
                @include('includes.enabledNotify')
            @else
                @include('includes.disabledNotify')
            @endif
        </div>
    </div>
</div>
