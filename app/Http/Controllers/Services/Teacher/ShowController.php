<?php

namespace App\Http\Controllers\Services\Teacher;

use App\Models\Instructor;

class ShowController
{
    public function __invoke(Instructor $instructor)
    {
        $teacher = $instructor;
        $lessons = $instructor->lessons;

        return view('services.teacher.show', compact(['teacher','lessons']));
    }
}
