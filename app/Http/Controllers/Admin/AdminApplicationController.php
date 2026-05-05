<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ModelApplication;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminApplicationController extends Controller
{
    public function index(): View
    {
        $applications = ModelApplication::query()
            ->latest()
            ->with('reviewer:id,name')
            ->paginate(20);

        return view('admin.applications.index', compact('applications'));
    }

    public function approve(ModelApplication $application): RedirectResponse
    {
        if ($application->status !== ModelApplication::STATUS_PENDING) {
            return redirect()->back()->withErrors(['status' => __('This application was already processed.')]);
        }

        if (User::where('email', $application->email)->exists()) {
            return redirect()->back()->withErrors(['email' => __('A member account with this email already exists.')]);
        }

        DB::transaction(function () use ($application): void {
            $user = User::create([
                'name' => $application->name,
                'email' => $application->email,
                'password' => Hash::make(Str::random(40)),
                'role' => 'model',
                'email_verified_at' => now(),
            ]);

            $application->forceFill([
                'status' => ModelApplication::STATUS_APPROVED,
                'reviewed_by' => auth()->id(),
                'reviewed_at' => now(),
                'user_id' => $user->id,
            ])->save();
        });

        Password::broker()->sendResetLink(['email' => $application->email]);

        return redirect()->back()->with('status', __('Application approved. The applicant will receive an email to set their password.'));
    }

    public function reject(ModelApplication $application): RedirectResponse
    {
        if ($application->status !== ModelApplication::STATUS_PENDING) {
            return redirect()->back()->withErrors(['status' => __('This application was already processed.')]);
        }

        $application->forceFill([
            'status' => ModelApplication::STATUS_REJECTED,
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ])->save();

        return redirect()->back()->with('status', __('Application rejected.'));
    }
}
