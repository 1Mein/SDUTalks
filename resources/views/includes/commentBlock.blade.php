<div class="bg-dark-subtle p-3 pt-1 pe-4 rounded-4 my-2 comment-main">
    <div class="d-block">
        <div class="pt-2 mt-2 d-flex justify-content-between">
            <div>
                <img src="{{asset('storage/avatars/'.$comment->user->avatar)}}" role="button" data-bs-toggle="modal"
                     data-bs-target="{{'#post'.$comment->id}}" alt="" width="40" height="40"
                     class="rounded-circle me-2">
                <div class="modal fade" id="{{'post'.$comment->id}}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <img src="{{ asset('storage/avatars/'.$comment->user->avatar)}}" alt="" class="p-3">
                        </div>
                    </div>
                </div>
                <a class="m-0 text-white text-break my-auto me-2 comment-author" href="{{route('show.profile',$comment->user)}}"
                   style="text-decoration: none">{{$comment->user->name}}</a>
            </div>
            <div class="d-flex justify-content-between">
                <div class="my-auto d-flex">
                    @auth()
{{--                        @if(Str::contains(request()->url(), '/posts/'))--}}
                            <a class="reply-comment text-white me-2 cursor-pointer" data-comment-id="{{$comment->id}}">
                                <span>Reply</span>
                            </a>
{{--                        @endif--}}

                        @if(auth()->id() === $comment->user_id  || 1 === auth()->id())
                            <a class="delete-comment text-white me-2 cursor-pointer" data-comment-id="{{$comment->id}}">
                                <i class="bi bi-trash fs-5"></i>
                            </a>
                        @endif
                    @endauth
                    <p class="m-0 ">{{$comment->time}}</p>
                </div>
            </div>

        </div>
    </div>
    <hr>
    @if($comment->on_comment)
        @php $repliedComment = \App\Models\Comment::find($comment->on_comment) @endphp
        <div class="bg-black bg-opacity-25 rounded-3 p-2 mb-1">
            <span> Replied: {{$repliedComment->user->name}}</span><br>
            <span style="word-wrap: break-word;"> {{$repliedComment->comment}}</span>
        </div>
    @endif
    <a href="{{route('comment.show', $comment)}}" class="text-white" style="text-decoration: none">
        <div class="m-0 comment-text" style="white-space: pre-wrap; word-wrap: break-word;">{{$comment->comment}}</div>
    </a>

    <div class="d-flex justify-content-start align-items-center mt-2">
        @auth
            <button type="button" id="comforlike{{$comment->id}}" style="width: 20px;height: 20px"
                    data-comment-id="{{ $comment->id }}"
                    class="com-like-btn btn @if($comment->liked(auth()->user())) btn-success @else btn-outline-secondary @endif p-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-caret-up mb-2">
                    <path
                        d="M3.204 11h9.592L8 5.519 3.204 11zm-.753-.659 4.796-5.48a1 1 0 0 1 1.506 0l4.796 5.48c.566.647.106 1.659-.753 1.659H3.204a1 1 0 0 1-.753-1.659z"></path>
                </svg>
                <span class="visually-hidden">Button</span>
            </button>
        @endauth
        <p tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Likes: {{$post->likes()->count()}} | Dislikes: {{$post->dislikes()->count()}}" data-bs-placement="top"
           class="ms-1 me-1 border-2 rounded p-0 m-0 px-1 comlikes-count{{$comment->id}} @if($comment->likes()->count() - $comment->dislikes()->count()>0) text-success-emphasis @elseif($comment->likes()->count() - $comment->dislikes()->count()<0) text-danger-emphasis
        @endif">{{$comment->likes()->count() - $comment->dislikes()->count()}}</p>

        @auth
            <button type="button" id="comfordislike{{$comment->id}}" style="width: 20px;height: 20px"
                    data-comment-id="{{ $comment->id }}"
                    class="com-dislike-btn btn @if($comment->disliked(auth()->user())) btn-danger @else btn-outline-secondary @endif p-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-caret-down mb-2">
                    <path
                        d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"></path>
                </svg>
                <span class="visually-hidden">Button</span>
            </button>
        @endauth
    </div>
</div>
