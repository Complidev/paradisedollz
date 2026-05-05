<x-admin-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Courses') }}</h2>
            <a href="{{ route('admin.courses.create') }}" class="inline-flex items-center rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-800">{{ __('New course') }}</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <div class="rounded-md bg-green-50 p-4 text-sm text-green-800">{{ session('status') }}</div>
            @endif

            <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <tr>
                            <th class="px-6 py-3">{{ __('Title') }}</th>
                            <th class="px-6 py-3">{{ __('Platform') }}</th>
                            <th class="px-6 py-3">{{ __('Lessons') }}</th>
                            <th class="px-6 py-3">{{ __('Published') }}</th>
                            <th class="px-6 py-3 text-right">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($courses as $course)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900">{{ $course->title }}</div>
                                    <div class="text-xs text-gray-400">{{ $course->slug }}</div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">{{ $course->platform_label ?? '—' }}</td>
                                <td class="px-6 py-4">{{ $course->lessons_count }}</td>
                                <td class="px-6 py-4">{{ $course->is_published ? __('Yes') : __('No') }}</td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('admin.courses.edit', $course) }}" class="font-semibold text-indigo-600 hover:text-indigo-500">{{ __('Edit') }}</a>
                                    <form method="POST" action="{{ route('admin.courses.destroy', $course) }}" class="inline" onsubmit="return confirm('{{ __('Delete this course?') }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-semibold text-red-600 hover:text-red-500">{{ __('Delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="px-2">{{ $courses->links() }}</div>
        </div>
    </div>
</x-admin-layout>
