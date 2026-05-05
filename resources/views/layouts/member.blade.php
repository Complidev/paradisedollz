<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ isset($title) ? $title.' — '.config('app.name') : config('app.name') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-boss-muted text-boss-dark min-h-screen flex" x-data="{ sidebarOpen: false }">
        <aside
            class="fixed inset-y-0 left-0 z-40 w-64 flex flex-col transition-transform duration-300 lg:translate-x-0 lg:static lg:inset-auto bg-boss-dark"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        >
            <div class="px-6 py-8 border-b border-white/10">
                <p class="text-boss-gold tracking-[0.35em] uppercase font-display text-[0.75rem]">✦ {{ config('app.name') }} ✦</p>
                <p class="text-white/40 mt-2 text-[0.7rem]">{{ __('Members Area') }}</p>
            </div>
            <div class="px-6 py-5 border-b border-white/10">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-boss-pink flex items-center justify-center text-boss-gold font-display text-[1rem]">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-white text-[0.85rem]">{{ auth()->user()->name }}</p>
                        <p class="text-boss-gold text-[0.65rem] tracking-[0.1em]">{{ __('Member') }}</p>
                    </div>
                </div>
            </div>
            <nav class="flex-1 px-4 py-6 space-y-1">
                <a href="{{ route('member.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-sm transition-all duration-200 text-[0.85rem] {{ request()->routeIs('member.dashboard') ? 'bg-boss-gold text-white' : 'text-white/50 hover:text-white hover:bg-white/5' }}">{{ __('Dashboard') }}</a>
                <a href="{{ route('member.courses.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-sm transition-all duration-200 text-[0.85rem] {{ request()->routeIs('member.courses.*') ? 'bg-boss-gold text-white' : 'text-white/50 hover:text-white hover:bg-white/5' }}">{{ __('Academy') }}</a>
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-sm transition-all duration-200 text-[0.85rem] {{ request()->routeIs('profile.*') ? 'bg-boss-gold text-white' : 'text-white/50 hover:text-white hover:bg-white/5' }}">{{ __('Profile') }}</a>
            </nav>
            <div class="px-4 py-6 border-t border-white/10 space-y-2">
                <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 text-white/40 hover:text-white/70 transition-colors rounded-sm text-[0.75rem]">{{ __('← Back to Site') }}</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 px-4 py-3 text-white/40 hover:text-red-400 transition-colors w-full text-left rounded-sm text-[0.75rem]">{{ __('Sign Out') }}</button>
                </form>
            </div>
        </aside>

        <div x-show="sidebarOpen" x-cloak class="fixed inset-0 bg-black/50 z-30 lg:hidden" @click="sidebarOpen = false"></div>

        <div class="flex-1 flex flex-col min-w-0">
            <header class="bg-white border-b border-boss-pink px-4 lg:px-8 py-4 flex items-center gap-4 sticky top-0 z-20">
                <button type="button" class="lg:hidden p-2 text-boss-dark/50 hover:text-boss-gold" @click="sidebarOpen = true" aria-label="{{ __('Menu') }}">
                    <div class="space-y-1">
                        <div class="w-5 h-px bg-current"></div>
                        <div class="w-5 h-px bg-current"></div>
                        <div class="w-5 h-px bg-current"></div>
                    </div>
                </button>
                <div class="flex-1">
                    <p class="text-boss-dark/40 text-[0.75rem] tracking-[0.1em]">
                        {{ __('Welcome back,') }}
                        <span class="text-boss-gold font-display">{{ auth()->user()->name }}</span>
                    </p>
                </div>
                <a href="{{ route('home') }}#apply" class="hidden sm:inline-block bg-boss-pink text-boss-gold hover:bg-boss-gold hover:text-white px-4 py-2 transition-all duration-300 text-[0.65rem] tracking-[0.15em] uppercase">{{ __('Refer a Friend') }}</a>
            </header>
            <main class="flex-1 p-4 lg:p-8">
                @isset($header)
                    <div class="mb-8">{{ $header }}</div>
                @endisset
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
