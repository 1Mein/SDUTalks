<?php

namespace App\Http\Controllers\Services\Teacher;

use App\Models\Instructor;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController
{
    public function __invoke(Request $request)
    {
        $query = $request->input('name') ?? '';

        $teachers_en = Instructor::where('name', 'LIKE', '%' . $query . '%')->limit(500)->get();

        $teachers_kz = Instructor::where('name_kz', 'LIKE', '%' . $query . '%')->limit(500)->get();

        $teachers = $teachers_en->merge($teachers_kz);
        return view('partials.teachersList', compact('teachers'));
    }
}
