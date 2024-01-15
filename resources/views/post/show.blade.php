@extends('layouts.main')
@section('default')
    <p class="h1 text-center mb-5 text-info mt-5"> Post </p>
    <div class="w-75 m-auto">
        @include('includes.postCard')


        @auth()
            <hr>

            <form action="{{route('comment.store',$post)}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="comment" class="form-label fs-5 d-flex justify-content-between text-white">Comment this post! ^-^
                        <p class="text-muted p-0 m-0">Max 80.000 characters</p>
                    </label>
                    <textarea name="comment" class="form-control text-white" id="comment" rows="3"
                              placeholder="It's such a good opinion.">@if(old("comment")){{ old("content")}}@endif</textarea>
                    @error('comment')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary d-block ms-auto" >Send :3</button>
            </form>
        @endauth
        <hr>

        <p class="h1 text-center">Comments</p>
        @foreach($comments as $comment)
            @include('includes.commentBlock')
        @endforeach
        <div class="d-flex justify-content-center">
            {{$comments->links()}}
        </div>
    </div>
@endsection
