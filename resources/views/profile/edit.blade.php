<x-dynamic-component :component="auth()->user()->isAdmin() ? 'admin-layout' : 'member-layout'">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-boss-dark leading-tight font-display">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-4 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow border border-boss-pink/30 sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow border border-boss-pink/30 sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow border border-boss-pink/30 sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-dynamic-component>
