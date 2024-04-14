<div class="bg-dark-subtle p-3 rounded-4 my-2 notification-main">
    <div class="d-flex justify-content-between">
        <div class="d-flex align-items-center">
            @if(!$notify->is_viewed)
                <div tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="New"
                     data-bs-placement="left"
                     class="px-2 rounded-5 bg-primary my-auto py-0 me-2" style="font-size: 12px">!
                </div>
            @endif

            @if($notify->type === 'text')
                <div>
                    {{$notify->text}}
                </div>
            @elseif($notify->type === 'post-like')
                <div>
                    <a href="{{route('show.profile',$notify->from_user)}}" class="text-decoration-none">
                        {{$notify->getUsername($notify->from_user)}}
                    </a>
                    <span> liked your post: </span>
                    <a href="{{route('posts.show',$notify->on_post)}}"
                       class="text-decoration-none">{{$notify->getText($notify->on_post)}}</a>
                </div>
            @elseif($notify->type === 'post-dislike')
                <div>
                    <a href="{{route('show.profile',$notify->from_user)}}" class="text-decoration-none">
                        {{$notify->getUsername($notify->from_user)}}
                    </a>
                    {{' disliked your post: '}}
                    <a href="{{route('posts.show',$notify->on_post)}}"
                       class="text-decoration-none">{{$notify->getText($notify->on_post)}}</a>
                </div>
            @elseif($notify->type === 'commented-post')
                <div>
                    <a href="{{route('show.profile',$notify->from_user)}}" class="text-decoration-none">
                        {{$notify->getUsername($notify->from_user)}}
                    </a>
                    {{' commented your post: '}}
                    <a href="{{route('posts.show',$notify->on_post)}}"
                       class="text-decoration-none">{{$notify->getText($notify->on_post)}}</a>
                </div>
            @elseif($notify->type === 'replied-comment')
                <div>
                    <a href="{{route('show.profile',$notify->from_user)}}" class="text-decoration-none">
                        {{$notify->getUsername($notify->from_user)}}
                    </a>
                    {{' responded to your comment: '}}
                    <a href="{{route('comment.show',$notify->on_comment)}}"
                       class="text-decoration-none">{{$notify->getTextComment($notify->on_comment)}}</a>
                </div>
            @elseif($notify->type === 'comment-like')
                <div>
                    <a href="{{route('show.profile',$notify->from_user)}}" class="text-decoration-none">
                        {{$notify->getUsername($notify->from_user)}}
                    </a>
                    {{' liked your comment: '}}
                    <a href="{{route('comment.show',$notify->on_comment)}}"
                       class="text-decoration-none">{{$notify->getTextComment($notify->on_comment)}}</a>
                </div>
            @elseif($notify->type === 'comment-dislike')
                <div>
                    <a href="{{route('show.profile',$notify->from_user)}}" class="text-decoration-none">
                        {{$notify->getUsername($notify->from_user)}}
                    </a>
                    {{' disliked your comment: '}}
                    <a href="{{route('comment.show',$notify->on_comment)}}"
                       class="text-decoration-none">{{$notify->getTextComment($notify->on_comment)}}</a>
                </div>
            @elseif($notify->type === 'new-post')
                <div>
                    <a href="{{route('show.profile',$notify->from_user)}}" class="text-decoration-none">
                        {{$notify->getUsername($notify->from_user)}}
                    </a>
                    {{' posted a new post: '}}
                    <a href="{{route('posts.show',$notify->on_post)}}"
                       class="text-decoration-none">{{$notify->getText($notify->on_post)}}</a>
                </div>
            @endif
        </div>
        <div class="my-auto d-flex">
            <div>
                <a class="delete-notification text-white me-2 cursor-pointer" data-notification-id="{{$notify->id}}">
                    <i class="bi bi-trash fs-5"></i>
                </a>
            </div>
            <div>
                {{$notify->time}}
            </div>
        </div>
    </div>
</div>
