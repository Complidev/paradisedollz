<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Member progress') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="overflow-x-auto rounded-lg border border-gray-200 bg-white shadow-sm">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <tr>
                            <th class="sticky left-0 z-10 bg-gray-50 px-6 py-3">{{ __('Member') }}</th>
                            @foreach ($courses as $course)
                                <th class="px-6 py-3 min-w-[140px]">
                                    <div>{{ $course->title }}</div>
                                    @if ($course->platform_label)
                                        <div class="mt-1 font-normal normal-case text-gray-400">{{ $course->platform_label }}</div>
                                    @endif
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($models as $model)
                            <tr>
                                <td class="sticky left-0 z-10 bg-white px-6 py-4 font-medium text-gray-900">
                                    <div>{{ $model->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $model->email }}</div>
                                </td>
                                @foreach ($courses as $course)
                                    @php($pct = $matrix[$model->id][$course->id] ?? 0)
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <span class="font-semibold text-gray-900">{{ $pct }}%</span>
                                            @if ($course->lessons_count === 0)
                                                <span class="text-xs text-gray-400">{{ __('No lessons') }}</span>
                                            @endif
                                        </div>
                                        <div class="mt-2 h-2 w-full rounded-full bg-gray-100">
                                            <div class="h-2 rounded-full bg-indigo-600" style="width: {{ $pct }}%"></div>
                                        </div>
                                    </td>
                                @endforeach
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $courses->count() + 1 }}" class="px-6 py-8 text-center text-gray-500">
                                    {{ __('No member accounts yet.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
