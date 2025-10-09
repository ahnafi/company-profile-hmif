<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Support\Carbon;

class CompanyProfileController extends Controller
{
    public function index()
    {
        $forms = Form::where('is_active', true)
            ->where('end_date', '>', Carbon::now())
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return inertia('welcome', [
            'forms' => $forms
        ]);
    }
}
