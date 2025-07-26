<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LecturerController extends Controller
{
    public function index()
    {
        $lecturers = Cache::remember('lecturers', 86400, fn() => Lecturer::all());

        return response()->json($lecturers);
    }
}
