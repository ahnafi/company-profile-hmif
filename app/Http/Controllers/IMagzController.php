<?php

namespace App\Http\Controllers;

use App\Models\Magazine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IMagzController extends Controller
{
    public function index(Request $request)
    {
        $magazines = Magazine::orderBy('created_at', 'desc')->get();

        return inertia('i-magz', [
            'magazines' => $magazines
        ]);
    }

    public function show(Magazine $magazine)
    {
        return response()->file(storage_path('app/public/' . $magazine->file));
    }

    public function download(Magazine $magazine)
    {
        return response()->download(storage_path('app/public/' . $magazine->file), $magazine->title . '.pdf');
    }
}