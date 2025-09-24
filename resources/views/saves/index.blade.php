@extends('layouts.main')
@section('index.saves')
    active
@endsection
@section('default')
    <p class="h1 text-center mb-5 text-info mt-5"> Saved posts </p>
    <div class="w-75 mx-auto" id="post-container">
        <div class="d-flex justify-content-center">
            {{$posts->onEachSide(0)->links()}}
        </div>

        @foreach($posts as $post)
            @include('includes.postCard')
            @php $comment = $post->bestComment @endphp
            @if($comment)
                <div class="bg-dark-subtle p-3 pt-1 pe-4 rounded-4 comment-main">
                    <div class="d-block">
                        <div class="pt-2 mt-2 d-flex justify-content-between">
                            <div>
                                <a class="m-0 text-white text-break my-auto me-2 comment-author"
                                   href="{{route('show.profile',$comment->user)}}"
                                   style="text-decoration: none">{{$comment->user->name.': '}}</a>
                            </div>

                            <div>
                                <span>Best comment</span>
                            </div>
                        </div>
                    </div>
                    @if($comment->on_comment)
                        @php $repliedComment = \App\Models\Comment::find($comment->on_comment) @endphp
                        <div class="bg-black bg-opacity-25 rounded-3 p-2 mb-1">
                            <span> Replied: {{$repliedComment->user->name}}</span><br>
                            <span style="word-wrap: break-word;"> {{$repliedComment->comment}}</span>
                        </div>
                    @endif
                    <a href="{{route('comment.show', $comment)}}" class="text-white" style="text-decoration: none">
                        <div class="m-0 comment-text"
                             style="white-space: pre-wrap; word-wrap: break-word;">{{$comment->comment}}</div>
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
                        <p tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"
                           data-bs-content="Likes: {{$post->likes()->count()}} | Dislikes: {{$post->dislikes()->count()}}"
                           data-bs-placement="top"
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

            @endif
        @endforeach

        <div class="d-flex justify-content-center">
            {{$posts->onEachSide(0)->links()}}
        </div>
    </div>
@endsection
