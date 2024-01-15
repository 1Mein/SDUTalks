<div class="bg-dark-subtle p-3 pt-1 pe-4 rounded-4 my-2">
    <div class="d-flex justify-content-between">
        <div class="py-2 my-2">
            <img src="{{asset('storage/avatars/'.$comment->user->avatar)}}" role="button" data-bs-toggle="modal"
                 data-bs-target="{{'#post'.$comment->id}}" alt="" width="40" height="40" class="rounded-circle me-2">
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
        <p class="m-0 my-auto">{{$comment->created_at}}</p>
    </div>
    <span>
        {{$comment->comment}}
    </span>
</div>
