<x-member-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <div class="rounded-md bg-green-50 p-4 text-sm text-green-800">{{ session('status') }}</div>
            @endif

            <div class="grid gap-6 md:grid-cols-2">
                @forelse ($courses as $course)
                    @php($pct = $progressPercents[$course->id] ?? 0)
                    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
                        <div class="border-b border-gray-100 px-6 py-4">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $course->title }}</h3>
                                    @if ($course->platform_label)
                                        <p class="mt-1 text-sm text-gray-500">{{ $course->platform_label }}</p>
                                    @endif
                                </div>
                                <span class="text-sm font-medium text-gray-600">{{ $pct }}%</span>
                            </div>
                            <div class="mt-3 h-2 w-full rounded-full bg-gray-100">
                                <div class="h-2 rounded-full bg-indigo-600 transition-all" style="width: {{ $pct }}%"></div>
                            </div>
                        </div>
                        <div class="px-6 py-4 flex items-center justify-between text-sm text-gray-600">
                            <span>{{ trans_choice(':count lesson|:count lessons', $course->lessons_count, ['count' => $course->lessons_count]) }}</span>
                            <a href="{{ route('member.courses.show', $course->slug) }}" class="font-semibold text-indigo-600 hover:text-indigo-500">{{ __('Open') }}</a>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600">{{ __('No published courses yet. Check back soon.') }}</p>
                @endforelse
            </div>
        </div>
    </div>
</x-member-layout>
