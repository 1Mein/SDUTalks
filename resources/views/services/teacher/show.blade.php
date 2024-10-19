@extends('layouts.main')
@section('default')
    <p class="h1 text-center mb-5 text-info mt-5"> Teacher </p>
    <div class="row justify-content-center mb-5">
        <div class="col-md-5 mb-2">
            <div class="card p-5">
                <p class="text-info fs-1 text-center"><b>Image</b></p>

                <img src="{{asset('storage/avatars/'.$teacher->image)}}" alt="" class="img-fluid"
                     style="max-width: 375px">

                <div class="mt-5"></div>

            </div>

        </div>
        <div class="col-md-5 fs-3 ">
            <div class="card p-5 pb-0">
                <p class="text-info fs-1 text-center"><b>Information</b></p>
                <div class="d-flex justify-content-between">
                    <p>Name:</p>
                    <div>

                        <p class="text-break">{{$teacher->name}}</p>
                        <p class="text-break">{{$teacher->name_kz}}</p>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <p>Lessons:</p>
                    <p class="text-break">{{count($lessons)}}</p>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <p>Degree:</p>
                    <p class="text-break">{{$teacher->degree??'None'}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="">
        <p class="h1 text-center mb-2 text-info mt-5"> Schedule </p>

    <table class="table table-bordered mx-auto">
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

                                    {{ $lesson['course_code'] }}<br>
                                    {{ $lesson['name'] }}<br>
                                    {{$lesson['type']}}<br>
                                    {{ $lesson['cabinet'] }}
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
