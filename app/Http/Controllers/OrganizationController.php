<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\WorkProgram;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function workPrograms(Request $request)
    {
        $workPrograms = WorkProgram::with(['division', 'workProgramAdministrators.administrator'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        $divisions = Division::orderBy('name')->get();

        return inertia('work-program/index', [
            'workPrograms' => $workPrograms,
            'divisions' => $divisions
        ]);
    }

    public function detailWorkProgram(WorkProgram $workProgram)
    {
        $workProgram->load(['division', 'workProgramAdministrators.administrator']);

        return inertia('work-program/show', [
            'workProgram' => $workProgram
        ]);
    }
}
