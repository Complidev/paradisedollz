<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Edit course') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-10">
            @if (session('status'))
                <div class="rounded-md bg-green-50 p-4 text-sm text-green-800">{{ session('status') }}</div>
            @endif

            <div class="rounded-lg border border-gray-200 bg-white p-8 shadow-sm">
                <form method="POST" action="{{ route('admin.courses.update', $course) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $course->title)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    <div>
                        <x-input-label for="slug" :value="__('URL slug')" />
                        <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full" :value="old('slug', $course->slug)" />
                        <x-input-error class="mt-2" :messages="$errors->get('slug')" />
                    </div>

                    <div>
                        <x-input-label for="platform_label" :value="__('Platform label')" />
                        <x-text-input id="platform_label" name="platform_label" type="text" class="mt-1 block w-full" :value="old('platform_label', $course->platform_label)" />
                        <x-input-error class="mt-2" :messages="$errors->get('platform_label')" />
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $course->description) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="flex items-center gap-2">
                        <input id="is_published" name="is_published" type="checkbox" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" @checked(old('is_published', $course->is_published))>
                        <x-input-label for="is_published" :value="__('Published')" />
                    </div>

                    <div>
                        <x-input-label for="sort_order" :value="__('Sort order')" />
                        <x-text-input id="sort_order" name="sort_order" type="number" class="mt-1 block w-full" :value="old('sort_order', $course->sort_order)" />
                        <x-input-error class="mt-2" :messages="$errors->get('sort_order')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Update course') }}</x-primary-button>
                        <a href="{{ route('admin.courses.index') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900">{{ __('Back') }}</a>
                    </div>
                </form>
            </div>

            <div class="rounded-lg border border-gray-200 bg-white shadow-sm">
                <div class="border-b border-gray-100 px-6 py-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ __('Lessons') }}</h3>
                    <p class="text-sm text-gray-500">{{ __('Paste embed URLs from your video host (YouTube embed, Vimeo player link, etc.).') }}</p>
                </div>

                <div class="divide-y divide-gray-100">
                    @foreach ($course->lessons as $lesson)
                        <div class="px-6 py-6 space-y-4">
                            <div class="flex flex-wrap items-center justify-between gap-3">
                                <h4 class="font-semibold text-gray-900">{{ __('Lesson #:id', ['id' => $lesson->id]) }}</h4>
                                <form method="POST" action="{{ route('admin.courses.lessons.destroy', [$course, $lesson]) }}" onsubmit="return confirm('{{ __('Remove this lesson?') }}');">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button type="submit">{{ __('Remove') }}</x-danger-button>
                                </form>
                            </div>

                            <form method="POST" action="{{ route('admin.courses.lessons.update', [$course, $lesson]) }}" class="space-y-4">
                                @csrf
                                @method('PUT')

                                <div>
                                    <x-input-label :for="'title_'.$lesson->id" :value="__('Title')" />
                                    <x-text-input :id="'title_'.$lesson->id" name="title" type="text" class="mt-1 block w-full" :value="old('title', $lesson->title)" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('title')" />
                                </div>

                                <div>
                                    <x-input-label :for="'body_'.$lesson->id" :value="__('Body / notes')" />
                                    <textarea :id="'body_'.$lesson->id" name="body" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('body', $lesson->body) }}</textarea>
                                </div>

                                <div>
                                    <x-input-label :for="'video_'.$lesson->id" :value="__('Video embed URL')" />
                                    <x-text-input :id="'video_'.$lesson->id" name="video_url" type="text" class="mt-1 block w-full" :value="old('video_url', $lesson->video_url)" />
                                </div>

                                <div>
                                    <x-input-label :for="'sort_'.$lesson->id" :value="__('Sort order')" />
                                    <x-text-input :id="'sort_'.$lesson->id" name="sort_order" type="number" class="mt-1 block w-full" :value="old('sort_order', $lesson->sort_order)" />
                                </div>

                                <x-secondary-button type="submit">{{ __('Save lesson') }}</x-secondary-button>
                            </form>
                        </div>
                    @endforeach
                </div>

                <div class="border-t border-gray-100 px-6 py-6">
                    <h4 class="font-semibold text-gray-900">{{ __('Add lesson') }}</h4>
                    <form method="POST" action="{{ route('admin.courses.lessons.store', $course) }}" class="mt-4 space-y-4">
                        @csrf

                        <div>
                            <x-input-label for="new_title" :value="__('Title')" />
                            <x-text-input id="new_title" name="title" type="text" class="mt-1 block w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="new_body" :value="__('Body / notes')" />
                            <textarea id="new_body" name="body" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                        </div>

                        <div>
                            <x-input-label for="new_video_url" :value="__('Video embed URL')" />
                            <x-text-input id="new_video_url" name="video_url" type="url" class="mt-1 block w-full" />
                        </div>

                        <div>
                            <x-input-label for="new_sort_order" :value="__('Sort order')" />
                            <x-text-input id="new_sort_order" name="sort_order" type="number" class="mt-1 block w-full" />
                        </div>

                        <x-primary-button>{{ __('Add lesson') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
