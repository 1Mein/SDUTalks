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
                <a class="m-0 text-white text-break my-auto me-2" href="{{route('show.profile',$comment->user)}}"
                   style="text-decoration: none">{{$comment->user->name}}</a>
            </div>
            <div class="d-flex justify-content-between">
                <div class="my-auto d-flex">
                    @auth()
                        @if(auth()->id() === $comment->user_id  || 1 === auth()->id())
                            <a class="delete-comment text-white me-2" data-comment-id="{{$comment->id}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                </svg>
                            </a>
                        @endif
                    @endauth
                    <p class="m-0 ">{{$comment->time}}</p>
                </div>
            </div>

        </div>
    </div>
    <hr>
    <a href="{{route('comment.show', $comment)}}" class="text-white" style="text-decoration: none">
        <div class="m-0" style="white-space: pre-wrap;">{{$comment->comment}}</div>
    </a>
</div>
