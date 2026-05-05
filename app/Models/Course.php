<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
}
