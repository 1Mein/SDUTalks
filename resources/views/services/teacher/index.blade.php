@extends('layouts.main')
@section('services.teacher.index')
    active
@endsection
@section('default')
    <p class="h1 text-center mb-5 text-info mt-5"> Teachers </p>

    <div class="w-50 m-auto" id="post-container">
        <label for="searchBar">Search teacher</label>
        <input id="searchBar" type="text" class="form-control" placeholder="name">
    </div>

    <div class="mx-auto my-5 w-75" id="post-container">
        <div id="teachersList">
            <span>Found: {{sizeof($teachers)}}</span>
            @foreach($teachers as $teacher)
                <div class="bg-dark-subtle p-3 rounded-4 my-2 comment-main">
                    <div style="white-space: nowrap" class="d-flex justify-content-between">
                        <div class="d-flex align-items-center" style="max-width: 40%;">
                            <img src="{{asset('storage/avatars/'.$teacher->image)}}" role="button" data-bs-toggle="modal"
                                 data-bs-target="{{'#post'.$teacher->id}}" alt="" width="40" height="40"
                                 class="rounded-circle me-2">
                            <div class="modal fade" id="{{'post'.$teacher->id}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <img src="{{ asset('storage/avatars/'.$teacher->image)}}" alt="" class="p-3">
                                    </div>
                                </div>
                            </div>
                            <a class="truncate text-white text-break my-auto me-2 comment-author" href="{{route('services.teacher.show',$teacher)}}">
                                {{$teacher->name}}
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
                $('#teachersList').empty();
                $('#teachersList').html('<div class="text-center"><h2>Loading...</h2></div>');

                timeout = setTimeout(function() {
                    let csrfToken = $('meta[name="csrf-token"]').attr('content');
                    let query = $('#searchBar').val();

                    if(query.length >= 0) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            url: '{{route('services.teacher.search')}}',
                            method: 'POST',
                            data: { name: query },
                            success: function(response) {
                                $('#teachersList').html(response);
                            },
                            error: function(error) {
                                $('#teachersList').html('<div class="text-center"><h2>An error occurred</h2></div>');
                            }
                        });
                    }
                }, 500);
            });
        });
    </script>
@endsection
