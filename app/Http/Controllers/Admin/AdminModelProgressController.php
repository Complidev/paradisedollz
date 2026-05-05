<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\View\View;

class AdminModelProgressController extends Controller
{
    public function index(): View
    {
        $models = User::query()
            ->where('role', 'model')
            ->orderBy('name')
            ->get();

        $courses = Course::query()
            ->withCount('lessons')
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        $matrix = [];
        foreach ($models as $model) {
            foreach ($courses as $course) {
                $matrix[$model->id][$course->id] = $course->progressPercentFor($model);
            }
        }

        return view('admin.models-progress', compact('models', 'courses', 'matrix'));
    }
}
