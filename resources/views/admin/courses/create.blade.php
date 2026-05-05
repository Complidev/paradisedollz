<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('New course') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-lg border border-gray-200 bg-white p-8 shadow-sm">
                <form method="POST" action="{{ route('admin.courses.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    <div>
                        <x-input-label for="slug" :value="__('URL slug (optional)')" />
                        <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full" :value="old('slug')" />
                        <x-input-error class="mt-2" :messages="$errors->get('slug')" />
                    </div>

                    <div>
                        <x-input-label for="platform_label" :value="__('Platform label (e.g. Chaturbate)')" />
                        <x-text-input id="platform_label" name="platform_label" type="text" class="mt-1 block w-full" :value="old('platform_label')" />
                        <x-input-error class="mt-2" :messages="$errors->get('platform_label')" />
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="flex items-center gap-2">
                        <input id="is_published" name="is_published" type="checkbox" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('is_published') ? 'checked' : '' }}>
                        <x-input-label for="is_published" :value="__('Published (visible to members)')" />
                    </div>

                    <div>
                        <x-input-label for="sort_order" :value="__('Sort order')" />
                        <x-text-input id="sort_order" name="sort_order" type="number" class="mt-1 block w-full" :value="old('sort_order', 0)" />
                        <x-input-error class="mt-2" :messages="$errors->get('sort_order')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save course') }}</x-primary-button>
                        <a href="{{ route('admin.courses.index') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900">{{ __('Cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
