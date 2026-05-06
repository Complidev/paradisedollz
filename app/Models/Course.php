<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Course extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'platform_label',
        'description',
        'is_published',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Course $course): void {
            if (empty($course->slug)) {
                $course->slug = Str::slug($course->title);
            }
        });
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class)->orderBy('sort_order');
    }

    public function chatMessages(): HasMany
    {
        return $this->hasMany(CourseChatMessage::class)->orderBy('created_at');
    }

    public function progressPercentFor(User $user): int
    {
        $total = $this->lessons()->count();
        if ($total === 0) {
            return 0;
        }

        $completed = LessonProgress::query()
            ->where('user_id', $user->id)
            ->whereIn('lesson_id', $this->lessons()->pluck('id'))
            ->whereNotNull('completed_at')
            ->count();

        return (int) round(($completed / $total) * 100);
    }

    /**
     * Batch completion percents for one member across many courses (avoids N+1 queries).
     *
     * @param  iterable<int, Course>  $courses  Published courses with lessons eager-loaded (`lessons:id,course_id`) and `lessons_count`.
     * @return array<int, int> course id => 0–100
     */
    public static function batchProgressPercentsForUser(User $user, iterable $courses): array
    {
        $coursesCollection = Collection::make($courses);
        if ($coursesCollection->isEmpty()) {
            return [];
        }

        $lessonToCourse = [];
        $allLessonIds = [];
        foreach ($coursesCollection as $course) {
            foreach ($course->lessons as $lesson) {
                $lessonToCourse[$lesson->id] = $course->id;
                $allLessonIds[$lesson->id] = true;
            }
        }
        $allLessonIds = array_keys($allLessonIds);

        $result = [];
        foreach ($coursesCollection as $course) {
            $result[$course->id] = 0;
        }

        if ($allLessonIds === []) {
            return $result;
        }

        $completedLessonIds = LessonProgress::query()
            ->where('user_id', $user->id)
            ->whereIn('lesson_id', $allLessonIds)
            ->whereNotNull('completed_at')
            ->pluck('lesson_id');

        $completedCountByCourse = [];
        foreach ($completedLessonIds as $lessonId) {
            $courseId = $lessonToCourse[$lessonId] ?? null;
            if ($courseId !== null) {
                $completedCountByCourse[$courseId] = ($completedCountByCourse[$courseId] ?? 0) + 1;
            }
        }

        foreach ($coursesCollection as $course) {
            $total = (int) $course->lessons_count;
            $completed = $completedCountByCourse[$course->id] ?? 0;
            $result[$course->id] = $total === 0 ? 0 : (int) round(($completed / $total) * 100);
        }

        return $result;
    }
}
