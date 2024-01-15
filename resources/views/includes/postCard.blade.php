<div class="d-block my-3 card shadow-sm p-0">
    @if($post->image)
        <img src="{{$post->image}}" class="card-img-top" alt="...">
    @endif
    <div class="card-header d-flex justify-content-between ps-2">
        <div>
            <img src="{{asset('storage/avatars/'.$post->user->avatar)}}" role="button" data-bs-toggle="modal"
                 data-bs-target="{{'#post'.$post->id}}" alt="" width="40" height="40" class="rounded-circle me-2">
            <div class="modal fade" id="{{'post'.$post->id}}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <img src="{{asset('storage/avatars/'.$post->user->avatar)}}" alt="" class="p-3">
                    </div>
                </div>
            </div>

            <a class="m-0 text-white text-break my-auto me-2" href="{{route('show.profile',$post->user)}}"
               style="text-decoration: none">{{$post->user->name}}</a>
        </div>
        @auth()
            {{--manage start--}}
            @if($post->user_id === auth()->user()->id)
                <div class="d-flex justify-content-center">
                    <a href="{{route('posts.edit',$post->id)}}" class="my-auto text-warning ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-pencil-square"
                             viewBox="0 0 16 16">
                            <path
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd"
                                  d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </a>
                    <form action="{{route('posts.destroy',$post)}}" method="post" class="m-0 p-0 d-flex">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn p-1 ms-1 my-auto text-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-trash" viewBox="0 0 16 16">
                                <path
                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                <path
                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                            </svg>
                        </button>
                    </form>
                    <div class="d-flex align-items-center pt-1">
                        <div class="toggle-post tgp-{{$post->id}}" data-post-id="{{ $post->id }}">
                            @if($post->is_published)
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#5cb85c"
                                     class="bi bi-toggle-on" viewBox="0 0 16 16">
                                    <path d="M5 3a5 5 0 0 0 0 10h6a5 5 0 0 0 0-10zm6 9a4 4 0 1 1 0-8 4 4 0 0 1 0 8"/>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#d9534f"
                                     class="bi bi-toggle-off" viewBox="0 0 16 16">
                                    <path
                                        d="M11 4a4 4 0 0 1 0 8H8a4.992 4.992 0 0 0 2-4 4.992 4.992 0 0 0-2-4zm-6 8a4 4 0 1 1 0-8 4 4 0 0 1 0 8M0 8a5 5 0 0 0 5 5h6a5 5 0 0 0 0-10H5a5 5 0 0 0-5 5"/>
                                </svg>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
            {{--manage end--}}
        @endauth
        <p class="m-0 my-auto">{{$post->created_at}}</p>
    </div>

    <div class="card-body text-white"> {{--text-center--}}
        <a href="{{route('posts.show',$post->id)}}" class="h5 text-break"
           style="text-decoration:none"><b>{{$post->title}}</b></a>
        <p class="m-0">{{$post->content}}</p>
    </div>

    <div class="card-footer d-flex justify-content-between">
        <div class="d-flex justify-content-start align-items-center">
            @auth
                <button type="button" id="forlike{{$post->id}}" style="width: 20px;height: 20px"
                        data-post-id="{{ $post->id }}"
                        class="like-btn btn @if($post->liked(auth()->user())) btn-success @else btn-outline-secondary @endif p-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-caret-up mb-2">
                        <path
                            d="M3.204 11h9.592L8 5.519 3.204 11zm-.753-.659 4.796-5.48a1 1 0 0 1 1.506 0l4.796 5.48c.566.647.106 1.659-.753 1.659H3.204a1 1 0 0 1-.753-1.659z"></path>
                    </svg>
                    <span class="visually-hidden">Button</span>
                </button>
            @endauth

            <p class="border border-dark-subtle ms-1 me-1 border-2 rounded p-0 m-0 px-1 likes-count{{$post->id}} @if($post->likes()->count() - $post->dislikes()->count()>0) text-success-emphasis @elseif($post->likes()->count() - $post->dislikes()->count()<0) text-danger-emphasis
        @endif">{{$post->likes()->count() - $post->dislikes()->count()}}</p>

            @auth
                <button type="button" id="fordislike{{$post->id}}" style="width: 20px;height: 20px"
                        data-post-id="{{ $post->id }}"
                        class="dislike-btn btn @if($post->disliked(auth()->user())) btn-danger @else btn-outline-secondary @endif p-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-caret-down mb-2">
                        <path
                            d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"></path>
                    </svg>
                    <span class="visually-hidden">Button</span>
                </button>
            @endauth
        </div>
        <div>
            <a href="{{route('posts.show',$post->id)}}" style="text-decoration: none;" class="p-1 text-white">
                <span>
                    {{$post->comments()->count()}}
                </span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-chat-right-dots" viewBox="0 0 16 16">
                    <path
                        d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                    <path
                        d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                </svg>
            </a>
        </div>
    </div>
</div>
