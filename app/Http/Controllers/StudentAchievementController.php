<?php

namespace App\Http\Controllers;

use App\Http\Requests\AchievementFilterRequest;
use App\Http\Requests\AchievementFormRequest;
use Illuminate\Http\Request;
use App\Models\Achievement;
use App\Models\Student;
use App\Models\AchievementCategory;
use App\Models\AchievementLevel;
use App\Models\AchievementType;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

        public function form()
        {
            $types = AchievementType::select('id', 'name')->get();
            $categories = AchievementCategory::select('id', 'name')->get();
            $levels = AchievementLevel::select('id', 'name')->get();

            return view('achievements.form', [
                'types'       => $types,
                'categories'  => $categories,
                'levels'      => $levels,
            ]);
        }

    public function create(AchievementFormRequest $request)
    {
        $validated = $request->validated();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . Str::slug($validated['name']) . '_' . uniqid() . '.' .
                $request->file('image')->extension();
            $stored = $request->file('image')->storeAs('achievement_images', $imageName, 'public');
            $imagePath = $stored;
        }

        $proofPath = null;
        if ($request->hasFile('proof')) {
            $proofName = time() . '_' . Str::slug($validated['name']) . '_' . uniqid() . '.' .
                $request->file('proof')->extension();
            $stored = $request->file('proof')->storeAs('achievement_proofs', $proofName, 'public');
            $proofPath = $stored;
        }

        DB::beginTransaction();

        try {
            $achievement = Achievement::create([
                'achievement_type_id'     => $validated['type_id'],
                'achievement_category_id' => $validated['category_id'],
                'achievement_level_id'    => $validated['level_id'],
                'name'                    => $validated['name'],
                'description'             => $validated['description'],
                'awarded_at'              => $validated['awarded_at'],
                'image'                   => $imagePath,
                'proof'                   => $proofPath,
                'approval'                => false,
            ]);

            $studentIds = Student::whereIn('nim', $validated['nim'])->pluck('id')->all();
            if (!empty($studentIds)) {
                $achievement->students()->syncWithoutDetaching($studentIds);
            }

            DB::commit();

            return redirect()
                ->route('student.achievements.index')
                ->with('success', 'Prestasi berhasil ditambahkan dan menunggu persetujuan.');

        } catch (\Throwable $e) {
            DB::rollBack();
            if ($imagePath) {
                Storage::delete('public/' . $imagePath);
            }
            if ($proofPath) {
                Storage::delete('public/' . $proofPath);
            }

            report($e);

            return back()
                ->withInput()
                ->withErrors(['general' => 'Terjadi kesalahan saat menyimpan prestasi. Silakan coba lagi.']);
        }
    }
}
