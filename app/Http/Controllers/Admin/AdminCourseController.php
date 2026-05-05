<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminCourseController extends Controller
{
    public function index(): View
    {
        $courses = Course::query()
            ->withCount('lessons')
            ->orderBy('sort_order')
            ->orderBy('title')
            ->paginate(20);

        return view('admin.courses.index', compact('courses'));
    }

    public function create(): View
    {
        return view('admin.courses.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateCourse($request);
        $validated['is_published'] = $request->boolean('is_published');

        $slug = $this->uniqueSlug($validated['slug'] ?? Str::slug($validated['title']));

        Course::create([
            ...collect($validated)->except('slug')->all(),
            'slug' => $slug,
        ]);

        return redirect()->route('admin.courses.index')->with('status', __('Course created.'));
    }

    public function edit(Course $course): View
    {
        $course->load(['lessons' => fn ($q) => $q->orderBy('sort_order')]);

        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course): RedirectResponse
    {
        $validated = $this->validateCourse($request, $course->id);
        $validated['is_published'] = $request->boolean('is_published');

        $slugInput = $validated['slug'] ?? null;
        $slug = $slugInput !== null && $slugInput !== ''
            ? $this->uniqueSlug(Str::slug($slugInput), $course->id)
            : $this->uniqueSlug(Str::slug($validated['title']), $course->id);

        $course->update([
            ...collect($validated)->except('slug')->all(),
            'slug' => $slug,
        ]);

        return redirect()->route('admin.courses.edit', $course)->with('status', __('Course updated.'));
    }

    public function destroy(Course $course): RedirectResponse
    {
        $course->delete();

        return redirect()->route('admin.courses.index')->with('status', __('Course deleted.'));
    }

    private function validateCourse(Request $request, ?int $courseId = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('courses', 'slug')->ignore($courseId)],
            'platform_label' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:10000'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:999999'],
        ]);
    }

    private function uniqueSlug(string $base, ?int $ignoreCourseId = null): string
    {
        $slug = $base !== '' ? $base : Str::random(8);
        $original = $slug;
        $i = 1;

        while (Course::where('slug', $slug)
            ->when($ignoreCourseId, fn ($q) => $q->where('id', '!=', $ignoreCourseId))
            ->exists()) {
            $slug = $original.'-'.$i++;
        }

        return $slug;
    }
}
