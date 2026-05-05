@php
    $links = [
        ['route' => 'our-story', 'label' => __('Our Story')],
        ['route' => 'work-from-home', 'label' => __('Work From Home')],
        ['route' => 'work-from-paradise', 'label' => __('Work From Paradise')],
        ['route' => 'perks', 'label' => __('Perks')],
        ['route' => 'multistreaming', 'label' => __('Multistreaming')],
        ['route' => 'member.dashboard', 'label' => __('Members'), 'auth' => true],
    ];
@endphp

<nav
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-500"
    x-bind:class="transparent && !scrolled && !navOpen ? 'bg-transparent' : 'bg-white/[0.97] backdrop-blur-md border-b border-boss-pink shadow-sm'"
    {{ $attributes }}
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 md:h-20">
            <a
                href="{{ route('home') }}"
                class="tracking-[0.35em] uppercase transition-colors duration-300 font-display text-[0.8rem]"
                x-bind:class="transparent && !scrolled && !navOpen ? 'text-white' : 'text-boss-gold'"
            >
                ✦ {{ config('app.name') }} ✦
            </a>

            <div class="hidden lg:flex items-center gap-7">
                @foreach ($links as $link)
                    @if (($link['auth'] ?? false) && ! auth()->check())
                        @continue
                    @endif
                    <a
                        href="{{ route($link['route']) }}"
                        class="transition-colors duration-200 hover:text-boss-gold text-[0.65rem] tracking-[0.15em] uppercase"
                        x-bind:class="transparent && !scrolled && !navOpen ? 'text-white/90' : 'text-boss-dark'"
                    >
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>

            <div class="flex items-center gap-4">
                <a
                    href="{{ route('home') }}#apply"
                    class="hidden md:inline-block bg-boss-gold hover:bg-boss-gold-hover text-white px-6 py-2.5 transition-all duration-300 text-[0.65rem] tracking-[0.15em] uppercase"
                >
                    {{ __('Apply Now') }}
                </a>
                <button
                    type="button"
                    class="lg:hidden p-2 rounded-sm"
                    @click="navOpen = !navOpen"
                    aria-label="{{ __('Menu') }}"
                >
                    <svg x-show="!navOpen" class="w-5 h-5" x-bind:class="transparent && !scrolled ? 'text-white' : 'text-boss-dark'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg x-cloak x-show="navOpen" class="w-5 h-5 text-boss-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>

        <div x-cloak x-show="navOpen" x-transition class="lg:hidden bg-white border-t border-boss-pink py-4">
            @foreach ($links as $link)
                @if (($link['auth'] ?? false) && ! auth()->check())
                    @continue
                @endif
                <a
                    href="{{ route($link['route']) }}"
                    class="block px-4 py-3 hover:text-boss-gold hover:bg-boss-cream transition-colors text-boss-dark text-[0.7rem] tracking-[0.15em] uppercase"
                    @click="navOpen = false"
                >
                    {{ $link['label'] }}
                </a>
            @endforeach
            <div class="px-4 pt-4">
                <a
                    href="{{ route('home') }}#apply"
                    class="block w-full bg-boss-gold text-white py-3 text-center transition-colors text-[0.7rem] tracking-[0.15em] uppercase"
                    @click="navOpen = false"
                >
                    {{ __('Apply Now') }}
                </a>
            </div>
        </div>
    </div>
</nav>
