<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class LecturerController extends Controller
{
    public function index()
    {
        $lecturers = Cache::remember('lecturers', 86400, fn() => Lecturer::all());

        return inertia('lecturers', [
            'lecturers' => $lecturers,
        ]);
    }
}
