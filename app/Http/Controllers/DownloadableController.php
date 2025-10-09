<?php

namespace App\Http\Controllers;

use App\Models\Download;

class DownloadableController extends Controller
{
    public function index()
    {
        $downloads = Download::all();

        return inertia('download', compact('downloads'));
    }
}
