@extends('layouts.main')
@section('search.index')
    active
@endsection
@section('default')
    <p class="h1 text-center mb-5 text-info mt-5"> Users </p>

    <div class="w-50 m-auto" id="post-container">
        <label for="searchBar">Search user</label>
        <input id="searchBar" type="text" class="form-control" placeholder="username">
    </div>

    <div class="mx-auto my-5 w-75" id="post-container">
        <div id="usersList">
            <span>Max 30 users. Found: {{sizeof($users)}}</span>
    @foreach($users as $user)
            <div class="bg-dark-subtle p-3 rounded-4 my-2 comment-main">
                <div style="white-space: nowrap" class="d-flex justify-content-between">
                    <div class="d-flex align-items-center" style="max-width: 40%;">
                        <img src="{{asset('storage/avatars/'.$user->avatar)}}" role="button" data-bs-toggle="modal"
                             data-bs-target="{{'#post'.$user->id}}" alt="" width="40" height="40"
                             class="rounded-circle me-2">
                        <div class="modal fade" id="{{'post'.$user->id}}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <img src="{{ asset('storage/avatars/'.$user->avatar)}}" alt="" class="p-3">
                                </div>
                            </div>
                        </div>
                        <a class="truncate text-white text-break my-auto me-2 comment-author" href="{{route('show.profile',$user)}}">
                            {{$user->name}}
                        </a>
                    </div>
                </div>
            </div>

        @endforeach
        </div>
    </div>

    <script type="module">
        $(document).ready(function(){
            let timeout = null;

            $('#searchBar').on('input', function() {
                clearTimeout(timeout);

                // Show the loading indicator
                // $('#loading').show();
                $('#usersList').empty();
                $('#usersList').html('<div class="text-center"><h2>Loading...</h2></div>');

                timeout = setTimeout(function() {
                    let csrfToken = $('meta[name="csrf-token"]').attr('content');
                    let query = $('#searchBar').val();

                    if(query.length >= 0) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            url: '{{route('index.profile.find')}}',
                            method: 'POST',
                            data: { username: query },
                            success: function(response) {
                                $('#usersList').html(response);
                            },
                            error: function(error) {
                                $('#usersList').html('<div class="text-center"><h2>An error occurred</h2></div>');
                            }
                        });
                    }
                }, 500);
            });
        });
    </script>
@endsection
