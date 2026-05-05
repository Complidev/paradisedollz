<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\ModelApplication;
use App\Models\User;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function __invoke(): View
    {
        $pendingApplications = ModelApplication::where('status', ModelApplication::STATUS_PENDING)->count();
        $coursesCount = Course::count();
        $modelsCount = User::where('role', 'model')->count();

        return view('admin.dashboard', compact('pendingApplications', 'coursesCount', 'modelsCount'));
    }
}
