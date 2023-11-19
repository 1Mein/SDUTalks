<div class="d-block my-3 card shadow-sm p-0">
    @if($post->image)
        <img src="{{$post->image}}" class="card-img-top" alt="...">
    @endif
    <div class="card-header d-flex justify-content-between ">
        <div class="d-flex justify-content-start">
            <img src="{{asset('storage/avatars/'.$post->user->avatar)}}" role="button" data-bs-toggle="modal"
                 data-bs-target="{{'#post'.$post->id}}" alt="" width="40" height="40" class="rounded-circle me-2">
            <div class="modal fade" id="{{'post'.$post->id}}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <img src="{{ asset('storage/avatars/'.$post->user->avatar)}}" alt="" class="p-3">
                    </div>
                </div>
            </div>

            <a class="m-0 text-white text-break my-auto" href="{{route('show.profile',$post->user)}}"
               style="text-decoration: none">{{$post->user->name}}</a>
        </div>
        <p class="m-0 my-auto">{{$post->created_at}}</p></div>
    <div class="card-body text-center">
        <a href="{{route('posts.show',$post->id)}}" class="h5 text-break"
           style="text-decoration:none">{{$post->title}}</a>
        <p class="m-0">{{$post->content}}</p>
    </div>
    <div class="card-footer d-flex justify-content-start">
        @auth
            <button type="button" id="forlike{{$post->id}}" style="width: 20px;height: 20px"
                    data-post-id="{{ $post->id }}"
                    class="like-btn btn @if($post->liked(auth()->user())) btn-success @else btn-outline-secondary @endif p-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-caret-up mb-1">
                    <path
                        d="M3.204 11h9.592L8 5.519 3.204 11zm-.753-.659 4.796-5.48a1 1 0 0 1 1.506 0l4.796 5.48c.566.647.106 1.659-.753 1.659H3.204a1 1 0 0 1-.753-1.659z"></path>
                </svg>
                <span class="visually-hidden">Button</span>
            </button>
        @endauth

        <p class="p-0 m-0 px-1 likes-count{{$post->id}} @if($post->likes()->count() - $post->dislikes()->count()>0) text-success-emphasis @elseif($post->likes()->count() - $post->dislikes()->count()<0) text-danger-emphasis
        @endif">{{$post->likes()->count() - $post->dislikes()->count()}}</p>

        @auth
            <button type="button" id="fordislike{{$post->id}}" style="width: 20px;height: 20px"
                    data-post-id="{{ $post->id }}"
                    class="dislike-btn btn @if($post->disliked(auth()->user())) btn-danger @else btn-outline-secondary @endif p-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-caret-down mb-1">
                    <path
                        d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"></path>
                </svg>
                <span class="visually-hidden">Button</span>
            </button>
        @endauth
    </div>
</div>
<!-- Пример с использованием jQuery -->

