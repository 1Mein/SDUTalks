<?php

namespace App\Http\Controllers\Services\Cabinet;

use App\Models\Instructor;
use App\Models\Lesson;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController
{
    public function __invoke(Request $request)
    {
        $query = $request->input('name') ?? '';

        $freeCabinet = filter_var($request->input('freeCabinet'), FILTER_VALIDATE_BOOLEAN);
        $selectedTime = $request->input('selectedTime') ?? '';
        $selectedDay = $request->input('selectedDay') ?? '';

        if ($freeCabinet) {
            $availableCabinets = [];
            $occupiedCabinets = [];
            $currentDay = $selectedDay;
            $cabinets = DB::table('lessons')
                ->select('cabinet', 'time', 'day')
                ->where('day', $currentDay)
                ->get();


            foreach ($cabinets as $cabinet) {
                list($startTime, $endTime) = explode('-', $cabinet->time);

                if ($selectedTime >= $startTime && $selectedTime <= $endTime) {
                    $cleanCabinetName = explode('(', $cabinet->cabinet)[0];
                    $occupiedCabinets[] = trim($cleanCabinetName);
                }
            }

            $allCabinets = DB::table('lessons')
                ->select('cabinet')
                ->where('cabinet', 'LIKE', '%' . $query . '%')
                ->distinct()
                ->get();

            foreach ($allCabinets as $cabinet) {
                $cleanCabinetName = explode('(', $cabinet->cabinet)[0]; // Убираем часть после '('

                // Если кабинет не в списке занятых, добавляем его в доступные
                if (!in_array(trim($cleanCabinetName), $occupiedCabinets)) {
                    $availableCabinets[] = trim($cleanCabinetName);
                }
            }

            $cabinets = collect();

            foreach ($availableCabinets as $availableCabinet) {
                $cabinets->push((object)['cabinet' => $availableCabinet]);
            }

            $cabinets = $cabinets->reject(function ($cabinet) {
                return str_starts_with($cabinet->cabinet, 'VR');
            });

            $cabinets = $cabinets->unique('cabinet');
            $cabinets = $cabinets->sortBy('cabinet')->values();
        } else {

        $cabinets = DB::table('lessons')
            ->select(DB::raw('DISTINCT TRIM(SUBSTRING_INDEX(cabinet, "(", 1)) AS cabinet'))
            ->orderBy('cabinet')
            ->where('cabinet', 'LIKE', '%' . $query . '%')
            ->get();
        }




        return view('partials.cabinetsList', compact(['cabinets']));
    }
}
