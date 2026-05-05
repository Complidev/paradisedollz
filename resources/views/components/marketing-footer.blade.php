@php
    $explore = [
        ['route' => 'our-story', 'label' => __('Our Story')],
        ['route' => 'work-from-home', 'label' => __('Work From Home')],
        ['route' => 'work-from-paradise', 'label' => __('Work From Paradise')],
        ['route' => 'perks', 'label' => __('Perks')],
        ['route' => 'multistreaming', 'label' => __('Multistreaming')],
    ];
@endphp

<footer class="bg-boss-dark text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
            <div class="md:col-span-2">
                <p class="text-boss-gold tracking-[0.35em] uppercase mb-4 font-display text-[0.85rem]">
                    ✦ {{ config('app.name') }} ✦
                </p>
                <p class="text-white/50 leading-relaxed max-w-sm text-[0.875rem]">
                    {{ __('Building empires, one boss doll at a time. Model, travel, and create the life you deserve.') }}
                </p>
                <div class="flex gap-5 mt-6">
                    <span class="text-white/30 hover:text-boss-gold transition-colors cursor-default" title="Instagram">&#9675;</span>
                    <span class="text-white/30 hover:text-boss-gold transition-colors cursor-default" title="YouTube">&#9675;</span>
                </div>
            </div>

            <div>
                <p class="text-white/30 tracking-[0.2em] uppercase mb-5 text-[0.65rem]">{{ __('Explore') }}</p>
                <ul class="space-y-3">
                    @foreach ($explore as $item)
                        <li>
                            <a href="{{ route($item['route']) }}" class="text-white/50 hover:text-boss-gold transition-colors text-[0.8rem]">
                                {{ $item['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <p class="text-white/30 tracking-[0.2em] uppercase mb-5 text-[0.65rem]">{{ __('Members') }}</p>
                <ul class="space-y-3">
                    @auth
                        <li>
                            <a href="{{ route('member.dashboard') }}" class="text-white/50 hover:text-boss-gold transition-colors text-[0.8rem]">{{ __('Dashboard') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('member.courses.index') }}" class="text-white/50 hover:text-boss-gold transition-colors text-[0.8rem]">{{ __('Academy') }}</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('login') }}" class="text-white/50 hover:text-boss-gold transition-colors text-[0.8rem]">{{ __('Log in') }}</a>
                        </li>
                    @endauth
                    <li>
                        <a href="{{ route('home') }}#apply" class="text-boss-gold hover:text-white transition-colors text-[0.8rem]">{{ __('Apply Now') }} →</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-white/25 text-[0.75rem]">© {{ date('Y') }} {{ config('app.name') }}. {{ __('All rights reserved.') }}</p>
            <div class="flex items-center gap-6">
                <p class="text-white/25 text-[0.75rem]">{{ __('Made with care for members worldwide') }}</p>
                @auth
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="text-white/10 hover:text-white/25 transition-colors text-[0.65rem] tracking-[0.1em]">{{ __('Admin') }}</a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</footer>
