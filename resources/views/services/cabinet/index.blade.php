@extends('layouts.main')
@section('services')
    active
@endsection
@section('services.cabinet.index')
    active
@endsection
@section('default')
    <p class="h1 text-center mb-5 text-info mt-5"> Cabinet schedule </p>

    <div class="w-50 m-auto" id="post-container">
        <label for="searchBar">Search cabinet</label>
        <input id="searchBar" type="text" class="form-control" placeholder="name">
    </div>

    <div class="mx-auto my-5 w-75" id="post-container">
        <div id="cabinetsList">
            <span>Found: {{sizeof($cabinets)}}</span>
            @foreach($cabinets as $cabinet)
                @if($loop->iteration % 2 == 1)
                    <div class="row justify-content-between gap-2">
                        @endif
                        <div class="col bg-dark-subtle p-3 rounded-4 my-2 comment-main" >
                            <div style="white-space: nowrap" class="d-flex justify-content-between">
                                <div class="d-flex align-items-center" style="max-width: 40%;">
                                    <a class="truncate text-white text-break my-auto me-2 comment-author"
                                       href="{{ route('services.cabinet.show', $cabinet->cabinet) }}">
                                        {{ $cabinet->cabinet }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        @if($loop->iteration % 2 == 0)
                    </div>
                @endif

            @endforeach

        </div>
    </div>

    <script type="module">
        $(document).ready(function () {
            let timeout = null;

            $('#searchBar').on('input', function () {
                clearTimeout(timeout);

                // Show the loading indicator
                // $('#loading').show();
                $('#cabinetsList').empty();
                $('#cabinetsList').html('<div class="text-center"><h2>Loading...</h2></div>');

                timeout = setTimeout(function () {
                    let csrfToken = $('meta[name="csrf-token"]').attr('content');
                    let query = $('#searchBar').val();

                    if (query.length >= 0) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            url: '{{route('services.cabinet.search')}}',
                            method: 'POST',
                            data: {name: query},
                            success: function (response) {
                                $('#cabinetsList').html(response);
                            },
                            error: function (error) {
                                $('#cabinetsList').html('<div class="text-center"><h2>An error occurred</h2></div>');
                            }
                        });
                    }
                }, 500);
            });
        });
    </script>
@endsection
