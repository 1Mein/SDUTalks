<?php

namespace App\Http\Controllers\Services\Teacher;

use App\Models\Instructor;

class IndexController
{
    public function __invoke()
    {
        $teachers = Instructor::limit(500)->get();

        return view('services.teacher.index', compact(['teachers']));
    }
}
