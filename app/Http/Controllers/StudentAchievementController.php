<?php

namespace App\Http\Controllers;

use App\Http\Requests\AchievementFilterRequest;
use Illuminate\Http\Request;
use App\Models\Achievement;
use App\Models\Student;
use App\Models\AchievementCategory;
use App\Models\AchievementLevel;
use App\Models\AchievementType;

class StudentAchievementController extends Controller
{
        public function index(AchievementFilterRequest $request)
        {
            // Filtered Achievements
            $achievements = Achievement::with([
                'students',
                'achievementType:id,name',
                'achievementCategory:id,name',
                'achievementLevel:id,name'
            ])
                ->when($request->type_id, fn($q) => $q->where('achievement_type_id', $request->type_id))
                ->when($request->category_id, fn($q) => $q->where('achievement_category_id', $request->category_id))
                ->when($request->level_id, fn($q) => $q->where('achievement_level_id', $request->level_id))
                ->when($request->study_program, fn($q) =>
                    $q->whereHas('students', fn($sq) =>
                    $sq->where('study_program', $request->study_program)
                )
                )
                ->when($request->batch_year, fn($q) =>
                    $q->whereHas('students', fn($sq) =>
                    $sq->where('batch_year', $request->batch_year)
                )
                )
                ->when($request->student_name, fn($q) =>
                    $q->whereHas('students', fn($sq) =>
                    $sq->where('name', 'like', '%' . $request->student_name . '%')
                )
                )
                ->when($request->nim, fn($q) =>
                    $q->whereHas('students', fn($sq) =>
                    $sq->where('nim', 'like', '%' . $request->nim . '%')
                )
                )
                ->orderBy('awarded_at', 'desc')
                ->get()
                ->map(fn($achievement) => [
                    'id'            => $achievement->id,
                    'name'          => $achievement->name,
                    'description'   => $achievement->description,
                    'image'         => $achievement->image,
                    'awarded_at'    => $achievement->awarded_at,
                    'type_name'     => $achievement->achievementType->name,
                    'category_name' => $achievement->achievementCategory->name,
                    'level_name'    => $achievement->achievementLevel->name,
                    'students'      => $achievement->students->map(fn($student) => [
                        'student_id'    => $student->id,
                        'student_name'  => $student->name,
                        'nim'           => $student->nim,
                        'study_program' => $student->study_program,
                        'batch_year'    => $student->batch_year,
                    ])
                ]);

            $types = AchievementType::select('id', 'name')->get();
            $categories = AchievementCategory::select('id', 'name')->get();
            $levels = AchievementLevel::select('id', 'name')->get();
            $studyPrograms = Student::select('study_program')->distinct()->pluck('study_program');
            $batchYears = Student::select('batch_year')->distinct()->pluck('batch_year');

            // Leaderboard of Students with Achievements
            $leaderboard = Student::withCount('achievements')
                ->orderByDesc('achievements_count')
                ->take(10)
                ->get(['id', 'name', 'nim', 'study_program', 'batch_year', 'achievements_count']);

            return view('achievements.index', [
                'filters' => [
                    'types'         => $types,
                    'categories'    => $categories,
                    'levels'        => $levels,
                    'studyPrograms' => $studyPrograms,
                    'batchYears'    => $batchYears
                ],
                'achievements' => $achievements,
                'leaderboard'  => $leaderboard
            ]);
        }

        public function achievementForm()
        {
        }

        public function storeAchievement(Request $request)
        {
        }
}
