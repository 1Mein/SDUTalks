@extends('layouts.main')
{{--@section('posts.create')--}}
{{--    active--}}
{{--@endsection--}}
@section('default')
    <p class="h1 text-center mb-5 mt-5 text-info"> Edit your post </p>
    <form action="{{route('posts.update',$post->id)}}" method="post" class="w-50 m-auto text-white"
          enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="mb-3">
            <label for="title" class="form-label fs-5 d-flex justify-content-between">Title<p
                    class="text-muted p-0 m-0">Max 80 characters</p></label>
            <input type="text" name="title" class="form-control text-white" id="title"
                   placeholder="Minecraft!(This field is not required)"
                   value="@if(old("title")){{ old("title")}}@else{{$post->title}}@endif">
            @error('title')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">

            <label for="content" class="form-label fs-5 d-flex justify-content-between">Content<p
                    class="text-muted p-0 m-0">Max 80.000 characters</p></label>
            <textarea name="content" class="form-control text-white" id="content" rows="3"
                      placeholder="I love this version of minecraft.">@if(old("content"))
                    {{ old("content")}}
                @else{{$post->content}}@endif</textarea>
            @error('content')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label fs-5 d-flex justify-content-between">Image or Video<p
                    class="form-text p-0 m-0">Max 25 MB</p></label>
            <input class="form-control" type="file" id="image" name="image" value="{{old("image")}}">
            @error('image')
            <p class="text-danger">{{$message}}</p>
            @enderror
            @if($post->image)
                <div class="image-main d-flex align-items-center">
                    <span>Current:</span>
                    @php
                        $extension = pathinfo($post->image, PATHINFO_EXTENSION);
                    @endphp

                    @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'svg']))
                        <img src="{{asset('storage/images/'.$post->image)}}" class="img-fluid img-thumbnail mx-2 w-50 h-75 mt-1" alt="">

                    @elseif (in_array($extension, ['mp4', 'avi', 'mov', 'wmv']))
                        <video class="mt-1 mx-2 img-thumbnail w-50" controls>
                            <source src="{{asset('storage/images/'.$post->image)}}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @elseif (in_array($extension, ['mp3','wav','ogg']))
                        <audio class="mt-1 mx-2 w-50" controls>
                            <source src="{{asset('storage/images/'.$post->image)}}" type="audio/mp3">
                            Your browser does not support the audio tag.
                        </audio>
                    @endif
                    <a type="submit" class="delete-image text-white" data-post-id="{{$post->id}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                             class="bi bi-trash" viewBox="0 0 16 16">
                            <path
                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                            <path
                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                        </svg>
                    </a>
                </div>
            @endif
        </div>
        <div class="text-end">
            <button class="btn btn-primary" type="submit">Upload (>o<)</button>
        </div>
    </form>
@endsection
