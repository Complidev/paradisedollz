<?php

namespace App\Http\Controllers;

use App\Models\ModelApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ApplyController extends Controller
{
    public function create(): RedirectResponse
    {
        return redirect()->route('home')->fragment('apply');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'message' => ['nullable', 'string', 'max:5000'],
            'experience_level' => ['required', 'string', 'max:64'],
            'social_handle' => ['nullable', 'string', 'max:255'],
            'age_confirmed' => ['accepted'],
        ]);

        ModelApplication::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'message' => $validated['message'] ?? null,
            'experience_level' => $validated['experience_level'],
            'social_handle' => $validated['social_handle'] ?? null,
            'age_confirmed' => true,
            'status' => ModelApplication::STATUS_PENDING,
        ]);

        return redirect()->route('home')->fragment('apply')->with('application_sent', true);
    }
}
