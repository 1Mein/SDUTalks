<div class="bg-dark-subtle p-3 pt-1 pe-4 rounded-4 my-2 notification-main">
    <div class="d-flex justify-content-between pt-2">
        @if($notify->type === 'text')
            <div>
                {{$notify->text}}
            </div>
        @elseif($notify->type === 'post-like')
            <div>
                <a href="{{route('show.profile',$notify->from_user)}}"
                   style="text-decoration: none">{{$notify->getUsername($notify->from_user)}}</a>
                {{' liked your '}}
                <a href="{{route('posts.show',$notify->on_post)}}" style="text-decoration: none">post</a>
            </div>
        @elseif($notify->type === 'post-dislike')
            <div>
                <a href="{{route('show.profile',$notify->from_user)}}"
                   style="text-decoration: none">{{$notify->getUsername($notify->from_user)}}</a>
                {{' disliked your '}}
                <a href="{{route('posts.show',$notify->on_post)}}" style="text-decoration: none">post</a>
            </div>
        @endif

        <div class="my-auto d-flex">
            <div>
                <a class="delete-notification text-white me-2" data-notification-id="{{$notify->id}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-trash" viewBox="0 0 16 16">
                        <path
                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                        <path
                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                    </svg>
                </a>
            </div>
            <div>
                {{$notify->time}}
            </div>
        </div>
    </div>
</div>
