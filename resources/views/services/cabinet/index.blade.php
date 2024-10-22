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
        <input id="searchBar" type="text" class="form-control" placeholder="cabinet name">
        <div class="mt-1 d-flex flex-column flex-sm-row justify-content-between align-items-center">
            <div class="mb-2 mb-sm-0">
                <input class="form-check-input me-2" type="checkbox" value="" id="chbox">
                <label class="form-check-label" for="chbox" >
                    Show only free cabinets
                </label>
            </div>

            <div id="timeWrap" style="display: none">

            <div class="d-flex" >
                <label for="selectTime" class="me-1 my-auto" style="white-space: nowrap">Choose time</label>
{{--                <span class="text-white-50 me-1 my-auto">{{ \Carbon\Carbon::now('GMT+5')->format('l') }}</span>--}}
                <select id="selectDay" class="form-select form-select-sm me-1" aria-label=".form-select-sm example">
                    @php
                        use Carbon\Carbon;
                        $currentDay = Carbon::now('GMT+5')->format('l');
                        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                    @endphp
                    <option value="{{ $currentDay}}" id="currentDay" selected>Today ({{ $currentDay}})</option>


                    @foreach($daysOfWeek as $dayOfWeek)
                        @if($dayOfWeek === $currentDay)
                            @continue
                        @endif
                        <option value="{{ $dayOfWeek }}">{{ $dayOfWeek }}</option>
                    @endforeach
                </select>

                <select id="selectTime" class="form-select form-select-sm" aria-label=".form-select-sm example">

                    <option value="{{ \Carbon\Carbon::now('GMT+5')->format('H:i') }}" id="currentTime" selected >Current({{ \Carbon\Carbon::now('GMT+5')->format('H:i') }})</option>
                    @php
                        $startTime = Carbon::createFromTime(8, 30);
                        $endTime = Carbon::createFromTime(19, 30);
                    @endphp


                    @while ($startTime->lte($endTime))
                        <option value="{{ $startTime->format('H:i') }}">
                            {{ $startTime->format('H:i') }}
                        </option>
                        @php
                            $startTime->addHour();
                        @endphp
                    @endwhile

                </select>

            </div>
            </div>
        </div>

    </div>

    <div class="mx-auto my-5 w-75" id="post-container">
        <div id="cabinetsList">
            <span>Found: {{sizeof($cabinets)}}</span>

            @foreach($cabinets as $cabinet)
                @if($loop->iteration % 2 == 1)
                    <div class="row justify-content-between gap-2">
                        @endif
                        <div class="col bg-dark-subtle p-3 rounded-4 my-2 comment-main">
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
            let ctSel = $('#currentTime');

            function updateCurrentTime() {
                let now = new Date();
                let hours = now.getHours().toString().padStart(2, '0');
                let minutes = now.getMinutes().toString().padStart(2, '0');
                let currentTime = `Current(${hours}:${minutes})`;

                ctSel.val(`${hours}:${minutes}`);
                ctSel.text(currentTime);
            }

            updateCurrentTime();

            setInterval(updateCurrentTime, 60000);


            $('#chbox').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#timeWrap').show(); // Показываем элемент
                } else {
                    $('#timeWrap').hide(); // Скрываем элемент
                }
            });













            let timeout = null;

            $('#searchBar, #chbox, #selectTime, #selectDay').on('input', function () {
                clearTimeout(timeout);

                let freeCabinet = false
                let selectedTime = null
                let selectedDay = null

                if ($('#chbox').is(':checked')){
                    freeCabinet = true
                    selectedTime = $('#selectTime').val()
                    selectedDay = $('#selectDay').val()
                } else {
                    freeCabinet = false
                    selectedTime = null
                    selectedDay = null
                }

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
                            data: {
                                name: query,
                                freeCabinet: freeCabinet,
                                selectedTime: selectedTime,
                                selectedDay: selectedDay
                            },
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
