<?php

namespace App\Http\Controllers\Services\Cabinet;

use App\Models\Instructor;
use Illuminate\Support\Facades\DB;

class IndexController
{
    public function __invoke()
    {
        $cabinets = DB::table('lessons')
            ->select(DB::raw('DISTINCT TRIM(SUBSTRING_INDEX(cabinet, "(", 1)) AS cabinet'))
            ->orderBy('cabinet')
            ->get();

        return view('services.cabinet.index', compact(['cabinets']));
    }
}
