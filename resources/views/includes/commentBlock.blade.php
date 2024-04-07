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
    <a href="{{route('comment.show', $comment)}}" class="text-white" style="text-decoration: none">
        <div class="m-0" style="white-space: pre-wrap;">{{$comment->comment}}</div>
    </a>
</div>
