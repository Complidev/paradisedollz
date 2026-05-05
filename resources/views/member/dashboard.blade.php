<x-member-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Member home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <div class="rounded-md bg-green-50 p-4 text-sm text-green-800">{{ session('status') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-2">
                    <p>{{ __('Welcome back, :name.', ['name' => auth()->user()->name]) }}</p>
                    <p class="text-sm text-gray-600">{{ __('Open a course to watch lessons, track completion, and chat with others in that course.') }}</p>
                    <div class="pt-4">
                        <a href="{{ route('member.courses.index') }}" class="inline-flex items-center rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-800">
                            {{ __('Browse courses') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-member-layout>
