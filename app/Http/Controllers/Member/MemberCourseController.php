<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\View\View;

class MemberCourseController extends Controller
{
    public function index(): View
    {
        $courses = Course::query()
            ->where('is_published', true)
            ->with(['lessons' => fn ($q) => $q->select('id', 'course_id')])
            ->orderBy('sort_order')
            ->orderBy('title')
            ->withCount('lessons')
            ->get();

        $progressPercents = Course::batchProgressPercentsForUser(auth()->user(), $courses);

        return view('member.courses.index', compact('courses', 'progressPercents'));
    }

    public function show(string $slug): View
    {
        $course = Course::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $course->load(['lessons' => fn ($q) => $q->orderBy('sort_order')]);

        $messages = $course->chatMessages()
            ->with('user:id,name')
            ->latest()
            ->take(100)
            ->get()
            ->sortBy('created_at');

        $percent = $course->progressPercentFor(auth()->user());

        return view('member.courses.show', compact('course', 'messages', 'percent'));
    }
}
