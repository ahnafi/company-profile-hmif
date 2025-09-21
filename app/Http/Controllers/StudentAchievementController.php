<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\AchievementCategory;
use App\Models\AchievementLevel;
use App\Models\AchievementType;
use Illuminate\Http\Request;

class StudentAchievementController extends Controller
{
    public function index(Request $request)
    {
        $query = Achievement::with([
            'achievementType', 
            'achievementCategory', 
            'achievementLevel', 
            'students'
        ])->where('approval', true);

        // Filter by search term
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhereHas('students', function($studentQuery) use ($search) {
                      $studentQuery->where('name', 'LIKE', "%{$search}%");
                  });
            });
        }

        // Filter by type
        if ($request->filled('type') && $request->get('type') !== 'all') {
            $query->where('achievement_type_id', $request->get('type'));
        }

        // Filter by category
        if ($request->filled('category') && $request->get('category') !== 'all') {
            $query->where('achievement_category_id', $request->get('category'));
        }

        // Filter by level
        if ($request->filled('level') && $request->get('level') !== 'all') {
            $query->where('achievement_level_id', $request->get('level'));
        }

        // Filter by year
        if ($request->filled('year') && $request->get('year') !== 'all') {
            $query->whereYear('awarded_at', $request->get('year'));
        }

        $achievements = $query->orderBy('awarded_at', 'desc')
                             ->paginate(9)
                             ->withQueryString();

        $types = AchievementType::orderBy('name')->get();
        $categories = AchievementCategory::orderBy('name')->get();
        $levels = AchievementLevel::orderBy('name')->get();
        
        // Get available years
        $years = Achievement::selectRaw('YEAR(awarded_at) as year')
                           ->where('approval', true)
                           ->distinct()
                           ->orderBy('year', 'desc')
                           ->pluck('year');

        return inertia('if-bangga', [
            'achievements' => $achievements,
            'types' => $types,
            'categories' => $categories,
            'levels' => $levels,
            'years' => $years,
            'filters' => [
                'search' => $request->get('search'),
                'type' => $request->get('type', 'all'),
                'category' => $request->get('category', 'all'),
                'level' => $request->get('level', 'all'),
                'year' => $request->get('year', 'all'),
            ]
        ]);
    }

    public function form()
    {
        $types = AchievementType::orderBy('name')->get();
        $categories = AchievementCategory::orderBy('name')->get();
        $levels = AchievementLevel::orderBy('name')->get();

        return inertia('if-bangga/form', [
            'types' => $types,
            'categories' => $categories,
            'levels' => $levels,
        ]);
    }

    public function create(Request $request)
    {
        // Implementation for creating achievement
        // This would handle form submission
    }
}