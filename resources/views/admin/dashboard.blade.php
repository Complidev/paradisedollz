<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Admin dashboard') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <div class="rounded-md bg-green-50 p-4 text-sm text-green-800">{{ session('status') }}</div>
            @endif

            <div class="grid gap-6 md:grid-cols-3">
                <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                    <p class="text-sm text-gray-500">{{ __('Pending applications') }}</p>
                    <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $pendingApplications }}</p>
                    <a href="{{ route('admin.applications.index') }}" class="mt-4 inline-block text-sm font-semibold text-indigo-600 hover:text-indigo-500">{{ __('Review') }}</a>
                </div>
                <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                    <p class="text-sm text-gray-500">{{ __('Courses') }}</p>
                    <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $coursesCount }}</p>
                    <a href="{{ route('admin.courses.index') }}" class="mt-4 inline-block text-sm font-semibold text-indigo-600 hover:text-indigo-500">{{ __('Manage') }}</a>
                </div>
                <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                    <p class="text-sm text-gray-500">{{ __('Members') }}</p>
                    <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $modelsCount }}</p>
                    <a href="{{ route('admin.models.progress') }}" class="mt-4 inline-block text-sm font-semibold text-indigo-600 hover:text-indigo-500">{{ __('Progress report') }}</a>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
