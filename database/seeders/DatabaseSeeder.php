<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@agency.test'],
            [
                'name' => 'Agency Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        $demo = Course::query()->firstOrCreate(
            ['slug' => 'demo-platform-basics'],
            [
                'title' => 'Demo platform basics',
                'platform_label' => 'Example platform',
                'platform_color' => '#C9A96E',
                'description' => 'Sample course so you can click through lessons and chat after publishing.',
                'is_published' => true,
                'sort_order' => 1,
            ]
        );

        if ($demo->lessons()->count() === 0) {
            $demo->lessons()->createMany([
                [
                    'title' => 'Getting started',
                    'body' => 'Overview of account setup and safety basics. Add your hosted tutorial video embed URL in the admin panel.',
                    'video_url' => null,
                    'duration' => '08:00',
                    'has_pdf' => true,
                    'sort_order' => 1,
                ],
                [
                    'title' => 'Navigation walkthrough',
                    'body' => 'Where to find earnings, settings, and stream controls.',
                    'video_url' => null,
                    'duration' => '12:00',
                    'has_pdf' => false,
                    'sort_order' => 2,
                ],
            ]);
        }
    }
}
