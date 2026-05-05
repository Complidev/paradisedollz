<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ isset($title) ? $title.' — '.config('app.name') : config('app.name') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-boss-dark min-h-screen flex bg-[#F5F5F3]" x-data="{ sidebarOpen: false }">
        <aside
            class="fixed inset-y-0 left-0 z-40 w-60 flex flex-col transition-transform duration-300 lg:translate-x-0 lg:static lg:inset-auto bg-boss-dark"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        >
            <div class="px-6 py-7 border-b border-white/[0.08]">
                <p class="text-boss-gold tracking-[0.35em] uppercase font-display text-[0.7rem]">✦ {{ config('app.name') }} ✦</p>
                <p class="text-white/30 mt-1 text-[0.65rem]">{{ __('Admin Portal') }}</p>
            </div>
            <nav class="flex-1 px-3 py-5 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-sm transition-all duration-200 text-[0.8rem] tracking-[0.03em] {{ request()->routeIs('admin.dashboard') ? 'bg-boss-gold text-white' : 'text-white/45 hover:text-white hover:bg-white/5' }}">{{ __('Overview') }}</a>
                <a href="{{ route('admin.applications.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-sm transition-all duration-200 text-[0.8rem] tracking-[0.03em] {{ request()->routeIs('admin.applications.*') ? 'bg-boss-gold text-white' : 'text-white/45 hover:text-white hover:bg-white/5' }}">{{ __('Applications') }}</a>
                <a href="{{ route('admin.models.progress') }}" class="flex items-center gap-3 px-4 py-3 rounded-sm transition-all duration-200 text-[0.8rem] tracking-[0.03em] {{ request()->routeIs('admin.models.progress') ? 'bg-boss-gold text-white' : 'text-white/45 hover:text-white hover:bg-white/5' }}">{{ __('Members') }}</a>
                <a href="{{ route('admin.courses.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-sm transition-all duration-200 text-[0.8rem] tracking-[0.03em] {{ request()->routeIs('admin.courses.*') ? 'bg-boss-gold text-white' : 'text-white/45 hover:text-white hover:bg-white/5' }}">{{ __('Courses') }}</a>
            </nav>
            <div class="px-3 pb-3 space-y-1 border-t border-white/[0.08] pt-3">
                <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 text-white/30 hover:text-white/60 transition-colors rounded-sm text-[0.75rem]">{{ __('← View Site') }}</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 px-4 py-3 text-white/30 hover:text-red-400 transition-colors w-full text-left rounded-sm text-[0.75rem]">{{ __('Sign Out') }}</button>
                </form>
            </div>
        </aside>

        <div x-show="sidebarOpen" x-cloak class="fixed inset-0 bg-black/60 z-30 lg:hidden" @click="sidebarOpen = false"></div>

        <div class="flex-1 flex flex-col min-w-0">
            <header class="bg-white border-b border-gray-100 px-4 lg:px-8 py-4 flex items-center gap-4 sticky top-0 z-20">
                <button type="button" class="lg:hidden p-2 text-boss-dark/40 hover:text-boss-gold" @click="sidebarOpen = true" aria-label="{{ __('Menu') }}">
                    <div class="space-y-1">
                        <div class="w-5 h-px bg-current"></div>
                        <div class="w-5 h-px bg-current"></div>
                        <div class="w-5 h-px bg-current"></div>
                    </div>
                </button>
                <div class="flex-1">
                    <p class="text-boss-dark/35 text-[0.75rem] tracking-[0.05em]">{{ __('Admin Dashboard') }}</p>
                </div>
                <div class="flex items-center gap-2 pl-3 border-l border-gray-100">
                    <div class="w-8 h-8 rounded-full bg-boss-dark flex items-center justify-center">
                        <span class="text-boss-gold font-display text-[0.75rem]">A</span>
                    </div>
                    <span class="hidden sm:block text-boss-dark/60 text-[0.78rem]">{{ auth()->user()->name }}</span>
                </div>
            </header>
            <main class="flex-1 p-4 lg:p-8 overflow-auto">
                @isset($header)
                    <div class="mb-8">{{ $header }}</div>
                @endisset
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
