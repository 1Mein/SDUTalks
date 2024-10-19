<?php

namespace App\Http\Controllers\Services\Cabinet;

use App\Models\Instructor;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController
{
    public function __invoke(Request $request)
    {
        $query = $request->input('name') ?? '';

        $cabinets = DB::table('lessons')
            ->select(DB::raw('DISTINCT TRIM(SUBSTRING_INDEX(cabinet, "(", 1)) AS cabinet'))
            ->orderBy('cabinet')
            ->where('cabinet', 'LIKE', '%' . $query . '%')
            ->get();

        return view('partials.cabinetsList', compact(['cabinets']));
    }
}
