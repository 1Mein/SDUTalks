@extends('layouts.main')
@section('default')

    <div class="">

        <p class="h1 text-center mb-1 text-info mt-5"> Schedule </p>
        <p class="h3 text-center mb-2 text-white mt-1"> Room: {{$cabinet}} </p>
    <table class="table table-bordered mx-auto border-white border-opacity-50">
        <thead>
        <tr>
            <th class="px-1">Time</th>
            <th class="px-1">Monday</th>
            <th class="px-1">Tuesday</th>
            <th class="px-1">Wednesday</th>
            <th class="px-1">Thursday</th>
            <th class="px-1">Friday</th>
            <th class="px-1">Saturday</th>
        </tr>
        </thead>
        <tbody>
        @php
            $start = new DateTime('08:30');
            $end = new DateTime('22:30');
            $interval = new DateInterval('PT50M');
            $interval_break = new DateInterval('PT10M');
        @endphp

        @while ($start < $end)
            <tr>
                <td class="px-1">{{ $start->format('H:i') }}<br>{{ $start->add($interval)->format('H:i') }}</td>

                @for ($day = 1; $day <= 6; $day++)
                    {{-- 1 = Monday, 6 = Saturday --}}
                    <td>
                        @foreach ($lessons as $lesson)
                            @php
                                $start_time = (clone $start)->modify('-50 minutes');
                                $end_time = (clone $start);
                            @endphp

                            @if ($lesson['day'] == jddayofweek($day - 1, 1) && $lesson['time'] == $start_time->format('H:i') . '-' . $end_time->format('H:i'))
                                <hr class="m-1">
                                <div class="">
                                    <span class="p-1 m-0 fw-semibold bg-primary bg-opacity-25 mx-auto rounded-3">

                                    {{ $lesson['course_code'] }}<br>
                                    </span>
                                    {{ $lesson['name'] }}<br>
                                    <a href="{{route('services.teacher.show', $lesson->instructor)}}" class="text-white">{{ $lesson->instructor->name }}</a><br>
                                    <span class="gr-type">
                                        {{$lesson['group']}}-{{$lesson['type']}}<br>
                                    </span>
                                </div>
                                <hr class="m-1">
                            @endif


                        @endforeach
                    </td>
                @endfor
            </tr>
            @php
                $start->add($interval_break)
            @endphp
        @endwhile
        </tbody>
    </table>

    </div>

    <style>
        table th:first-child, table td:first-child {
            width: 1%;
        }

        table th, table td {
            width: 16.5%;
            text-align: center;
            vertical-align: middle;
        }

        @media (max-width: 768px) {
            table {
                font-size: 2.2vw;
            }
        }

        table {
            max-width: 1200px;
        }
    </style>
@endsection
