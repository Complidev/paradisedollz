<x-member-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $course->title }}
                </h2>
                @if ($course->platform_label)
                    <p class="text-sm text-gray-500">{{ $course->platform_label }}</p>
                @endif
            </div>
            <div class="text-sm font-medium text-gray-600">{{ __('Progress: :p%', ['p' => $percent]) }}</div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            @if (session('status'))
                <div class="rounded-md bg-green-50 p-4 text-sm text-green-800">{{ session('status') }}</div>
            @endif

            @if ($course->description)
                <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                    <p class="text-gray-700 whitespace-pre-line">{{ $course->description }}</p>
                </div>
            @endif

            <div class="rounded-lg border border-gray-200 bg-white shadow-sm">
                <div class="border-b border-gray-100 px-6 py-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ __('Lessons') }}</h3>
                </div>
                <ul class="divide-y divide-gray-100">
                    @foreach ($course->lessons as $lesson)
                        @php($done = $lesson->isCompletedBy(auth()->user()))
                        <li class="px-6 py-5 space-y-3">
                            <div class="flex flex-wrap items-start justify-between gap-4">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $lesson->title }}</p>
                                    @if ($lesson->body)
                                        <div class="mt-2 text-sm text-gray-600 whitespace-pre-line">{{ $lesson->body }}</div>
                                    @endif
                                </div>
                                <div class="flex shrink-0 gap-2">
                                    @if ($done)
                                        <form method="POST" action="{{ route('member.lessons.progress', $lesson) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" name="completed" value="0" class="rounded-md border border-gray-300 bg-white px-3 py-1 text-xs font-semibold text-gray-700 hover:bg-gray-50">
                                                {{ __('Mark incomplete') }}
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('member.lessons.progress', $lesson) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" name="completed" value="1" class="rounded-md bg-indigo-600 px-3 py-1 text-xs font-semibold text-white hover:bg-indigo-500">
                                                {{ __('Mark complete') }}
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>

                            @if ($lesson->video_url)
                                <div class="aspect-video w-full overflow-hidden rounded-md bg-black">
                                    <iframe class="h-full w-full" src="{{ $lesson->video_url }}" title="{{ $lesson->title }}" allowfullscreen loading="lazy"></iframe>
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>

            <div id="course-chat" class="rounded-lg border border-gray-200 bg-white shadow-sm">
                <div class="border-b border-gray-100 px-6 py-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ __('Course chat') }}</h3>
                    <p class="text-sm text-gray-500">{{ __('Discussion visible to all members in this course.') }}</p>
                </div>
                <div class="max-h-96 overflow-y-auto px-6 py-4 space-y-4">
                    @forelse ($messages as $message)
                        <div class="text-sm">
                            <div class="flex flex-wrap items-baseline gap-2">
                                <span class="font-semibold text-gray-900">{{ $message->user->name }}</span>
                                <span class="text-xs text-gray-400">{{ $message->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="mt-1 text-gray-700 whitespace-pre-line">{{ $message->body }}</p>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">{{ __('No messages yet. Start the conversation below.') }}</p>
                    @endforelse
                </div>
                <div class="border-t border-gray-100 px-6 py-4">
                    <form method="POST" action="{{ route('member.courses.chat.store', $course->slug) }}" class="space-y-3">
                        @csrf
                        <div>
                            <x-input-label for="body" :value="__('Your message')" />
                            <textarea id="body" name="body" rows="3" required
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('body') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('body')" />
                        </div>
                        <x-primary-button>{{ __('Post message') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-member-layout>
