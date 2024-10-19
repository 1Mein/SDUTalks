<?php

namespace App\Http\Controllers\Services\Cabinet;

use App\Models\Instructor;
use App\Models\Lesson;
use Illuminate\Http\Request;

class ShowController
{
    public function __invoke($cabinet)
    {
        $lessons = Lesson::where('cabinet', 'LIKE', '%' . $cabinet . '%')->get();

        return view('services.cabinet.show', compact(['lessons','cabinet']));
    }
}
