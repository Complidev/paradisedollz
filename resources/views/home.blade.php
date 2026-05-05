<x-layouts.marketing :transparentNav="true" :title="__('Home')">
    {{-- Hero --}}
    @php
        $heroImg = 'https://images.unsplash.com/photo-1771513957554-44ef928d3fd8?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1920';
        $offerImg = 'https://images.unsplash.com/photo-1579101098056-6bf296535b8e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=800';
        $lifeImg = 'https://images.unsplash.com/photo-1759417006128-d0317a0097f2?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1920';
        $streamImg = 'https://images.unsplash.com/photo-1764664035133-0d2ca12016dd?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=800';
    @endphp

    <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center scale-105" style="background-image: url('{{ $heroImg }}'); filter: blur(2px);"></div>
        <div class="absolute inset-0 bg-black/35"></div>

        <div class="relative z-10 text-center text-white px-4 max-w-4xl mx-auto pt-20">
            <p class="text-boss-gold tracking-[0.5em] uppercase mb-8 text-[0.75rem]">✦ {{ config('app.name') }} ✦</p>
            <h1 class="text-white mb-6 font-display text-[clamp(2.8rem,7vw,6rem)] leading-[1.05]">
                {{ __('Unlock a world of') }}<br><em>{{ __('opportunities') }}</em>
            </h1>
            <p class="text-white/80 mb-10 max-w-lg mx-auto text-[1.1rem] leading-relaxed">{{ __('Model and travel whilst building your own empire') }}</p>
            <a href="#apply" class="inline-block bg-boss-gold hover:bg-boss-gold-hover text-white px-12 py-4 transition-all duration-300 hover:shadow-lg tracking-[0.2em] uppercase text-[0.75rem]">{{ __('Apply Now') }}</a>
        </div>

        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-white/40">
            <span class="text-[0.65rem] tracking-[0.2em] uppercase">{{ __('Scroll') }}</span>
            <div class="w-px h-10 bg-gradient-to-b from-white/30 to-transparent"></div>
        </div>
    </section>

    {{-- Core offer --}}
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <p class="text-boss-gold tracking-[0.3em] uppercase mb-4 text-[0.7rem]">{{ __('What Awaits You') }}</p>
                    <h2 class="mb-8 font-display text-[clamp(2rem,4vw,3rem)] text-boss-dark leading-tight">{{ __('What You Get') }}</h2>
                    <ul class="space-y-5">
                        @foreach ([
                            __('Full training from industry experts'),
                            __('Boss Doll Blueprint — your personalised roadmap'),
                            __('1:1 mentoring sessions tailored to your goals'),
                            __('VIP photoshoots to build your portfolio'),
                            __('Access to our exclusive global network'),
                            __('Complete multistreaming setup & strategy'),
                        ] as $item)
                            <li class="flex items-start gap-4">
                                <svg class="w-5 h-5 text-boss-gold shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="text-boss-dark/70 text-[0.95rem] leading-relaxed">{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="#apply" class="mt-10 border border-boss-gold text-boss-gold hover:bg-boss-gold hover:text-white px-8 py-3 transition-all duration-300 inline-flex items-center gap-3 tracking-[0.15em] uppercase text-[0.7rem]">
                        {{ __('Start Your Journey') }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
                <div class="relative">
                    <div class="aspect-[4/5] overflow-hidden">
                        <img src="{{ $offerImg }}" alt="" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
                    </div>
                    <div class="absolute -bottom-6 -left-6 bg-boss-pink px-8 py-6 z-10">
                        <p class="font-display text-[2rem] text-boss-dark">500+</p>
                        <p class="text-boss-dark/60 mt-1 text-[0.65rem] tracking-[0.2em] uppercase">{{ __('Women Empowered') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Benefits --}}
    <section class="py-24 bg-boss-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <p class="text-boss-gold tracking-[0.3em] uppercase mb-4 text-[0.7rem]">{{ __('Why :name', ['name' => config('app.name')]) }}</p>
                <h2 class="font-display text-[clamp(2rem,4vw,3rem)] text-boss-dark">{{ __('Built for Your Success') }}</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ([
                    ['icon' => '✨', 'title' => __('No Experience Needed'), 'desc' => __('We train you from the ground up. All you need is the ambition to succeed.')],
                    ['icon' => '📈', 'title' => __('High Earning Potential'), 'desc' => __('Multiple income streams designed to maximise your earnings from day one.')],
                    ['icon' => '🛡', 'title' => __('Safety & Security'), 'desc' => __('Your wellbeing is our priority. A safe, professional environment always.')],
                    ['icon' => '♔', 'title' => __('Build Your Brand'), 'desc' => __('Become a recognised name. We give you the tools to own your identity.')],
                ] as $benefit)
                    <div class="bg-white p-8 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="w-14 h-14 rounded-full bg-boss-pink flex items-center justify-center mx-auto mb-6 text-xl">{{ $benefit['icon'] }}</div>
                        <h3 class="mb-3 font-display text-boss-dark text-[1.05rem]">{{ $benefit['title'] }}</h3>
                        <p class="text-boss-dark/55 leading-relaxed text-[0.85rem]">{{ $benefit['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Lifestyle --}}
    <section class="relative h-[70vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $lifeImg }}');"></div>
        <div class="absolute inset-0 bg-black/45"></div>
        <div class="relative z-10 text-center text-white px-4">
            <p class="text-boss-gold tracking-[0.4em] uppercase mb-6 text-[0.7rem]">{{ __('The Lifestyle') }}</p>
            <h2 class="font-display text-[clamp(2rem,5vw,4rem)] text-white leading-tight mb-8 max-w-2xl mx-auto">
                {{ __('Work from anywhere.') }}<br><em>{{ __('Live differently.') }}</em>
            </h2>
            <a href="{{ route('work-from-paradise') }}" class="border border-white text-white hover:bg-white hover:text-boss-dark px-10 py-3.5 transition-all duration-300 inline-block tracking-[0.2em] uppercase text-[0.7rem]">{{ __('See Lifestyle') }}</a>
        </div>
    </section>

    {{-- Multistreaming teaser --}}
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <p class="text-boss-gold tracking-[0.3em] uppercase mb-4 text-[0.7rem]">{{ __('The System') }}</p>
                    <h2 class="mb-6 font-display text-[clamp(2rem,4vw,3rem)] text-boss-dark leading-tight">
                        {{ __('One Stream.') }}<br><em>{{ __('Multiple Incomes.') }}</em>
                    </h2>
                    <p class="text-boss-dark/60 mb-8 leading-relaxed text-[0.95rem]">
                        {{ __('Our proprietary multistreaming technology lets you broadcast live to multiple platforms simultaneously — multiplying your reach and income from a single session. Work smarter, not harder.') }}
                    </p>
                    <a href="{{ route('multistreaming') }}" class="bg-boss-gold hover:bg-boss-gold-hover text-white px-8 py-3 transition-all duration-300 inline-flex items-center gap-3 tracking-[0.15em] uppercase text-[0.7rem]">
                        {{ __('How It Works') }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
                <div class="relative group cursor-pointer">
                    <div class="aspect-video overflow-hidden rounded-sm">
                        <img src="{{ $streamImg }}" alt="" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    </div>
                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                        <div class="w-16 h-16 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center border border-white/40">
                            <svg class="w-6 h-6 text-white ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                    <div class="absolute bottom-4 left-4 right-4 flex gap-3">
                        @foreach ([['5x', __('More Reach')], ['3x', __('Income')], ['10+', __('Platforms')]] as $stat)
                            <div class="bg-black/60 backdrop-blur-sm px-4 py-2 text-white flex-1 text-center">
                                <p class="font-display text-[1.2rem]">{{ $stat[0] }}</p>
                                <p class="text-[0.6rem] tracking-[0.15em] uppercase opacity-70">{{ $stat[1] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA strip --}}
    <section class="py-20 bg-boss-pink">
        <div class="max-w-3xl mx-auto px-4 text-center">
            <p class="text-boss-gold tracking-[0.3em] uppercase mb-4 text-[0.7rem]">{{ __('Ready?') }}</p>
            <h2 class="mb-6 font-display text-[clamp(2rem,4vw,3rem)] text-boss-dark leading-tight">{{ __('Start Your Journey Today') }}</h2>
            <ul class="flex flex-col sm:flex-row justify-center gap-4 sm:gap-10 mb-10">
                @foreach ([__('Free to apply'), __('No experience required'), __('Response within 48 hours')] as $li)
                    <li class="flex items-center gap-2 text-boss-dark/70 text-[0.85rem]">
                        <svg class="w-4 h-4 text-boss-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ $li }}
                    </li>
                @endforeach
            </ul>
            <a href="#apply" class="inline-block bg-boss-gold hover:bg-boss-gold-hover text-white px-12 py-4 transition-all duration-300 tracking-[0.2em] uppercase text-[0.75rem]">{{ __('Apply Now') }}</a>
        </div>
    </section>

    {{-- Application --}}
    <section id="apply" class="py-24 bg-white scroll-mt-24">
        <div class="max-w-xl mx-auto px-4">
            <div class="text-center mb-12">
                <p class="text-boss-gold tracking-[0.3em] uppercase mb-4 text-[0.7rem]">{{ __('Application') }}</p>
                <h2 class="font-display text-[clamp(1.8rem,3vw,2.5rem)] text-boss-dark">{{ __('Join the :name Family', ['name' => config('app.name')]) }}</h2>
            </div>

            @if (session('application_sent'))
                <div class="text-center py-16">
                    <div class="w-20 h-20 rounded-full bg-boss-pink flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-boss-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="font-display text-[2rem] text-boss-dark mb-4">{{ __('Application Received!') }}</h3>
                    <p class="text-boss-dark/60 leading-relaxed text-[0.95rem]">{{ __('Thank you for applying. Our team will review your application and be in touch within 48 hours.') }}</p>
                </div>
            @else
                <form method="POST" action="{{ route('apply.store') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-boss-dark/70 mb-2 text-[0.7rem] tracking-[0.15em] uppercase">{{ __('Full Name') }} *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="{{ __('Your full name') }}" class="w-full border border-boss-pink bg-boss-muted px-4 py-3.5 focus:outline-none focus:border-boss-gold transition-colors text-[0.9rem]">
                        <x-input-error class="mt-1.5" :messages="$errors->get('name')" />
                    </div>
                    <div>
                        <label class="block text-boss-dark/70 mb-2 text-[0.7rem] tracking-[0.15em] uppercase">{{ __('Email Address') }} *</label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="your@email.com" class="w-full border border-boss-pink bg-boss-muted px-4 py-3.5 focus:outline-none focus:border-boss-gold transition-colors text-[0.9rem]">
                        <x-input-error class="mt-1.5" :messages="$errors->get('email')" />
                    </div>
                    <div>
                        <label class="block text-boss-dark/70 mb-2 text-[0.7rem] tracking-[0.15em] uppercase">{{ __('Experience Level') }} *</label>
                        <select name="experience_level" required class="w-full border border-boss-pink bg-boss-muted px-4 py-3.5 focus:outline-none focus:border-boss-gold transition-colors text-[0.9rem] appearance-none">
                            <option value="">{{ __('Select your experience level') }}</option>
                            <option value="none" {{ old('experience_level') === 'none' ? 'selected' : '' }}>{{ __('No Experience') }}</option>
                            <option value="1-2" {{ old('experience_level') === '1-2' ? 'selected' : '' }}>{{ __('1–2 Years') }}</option>
                            <option value="3+" {{ old('experience_level') === '3+' ? 'selected' : '' }}>{{ __('3+ Years') }}</option>
                            <option value="professional" {{ old('experience_level') === 'professional' ? 'selected' : '' }}>{{ __('Professional') }}</option>
                        </select>
                        <x-input-error class="mt-1.5" :messages="$errors->get('experience_level')" />
                    </div>
                    <div>
                        <label class="block text-boss-dark/70 mb-2 text-[0.7rem] tracking-[0.15em] uppercase">{{ __('Instagram / TikTok Handle') }} <span class="text-boss-dark/30">({{ __('optional') }})</span></label>
                        <input type="text" name="social_handle" value="{{ old('social_handle') }}" placeholder="@yourhandle" class="w-full border border-boss-pink bg-boss-muted px-4 py-3.5 focus:outline-none focus:border-boss-gold transition-colors text-[0.9rem]">
                        <x-input-error class="mt-1.5" :messages="$errors->get('social_handle')" />
                    </div>
                    <div class="flex items-start gap-3 p-4 bg-boss-cream">
                        <input type="checkbox" name="age_confirmed" id="age-check" value="1" class="mt-1 w-4 h-4 accent-boss-gold shrink-0" @checked(old('age_confirmed'))>
                        <label for="age-check" class="text-boss-dark/70 leading-relaxed text-[0.8rem]">{{ __('I confirm that I am 18 years of age or older and agree to be contacted regarding my application.') }}</label>
                    </div>
                    <x-input-error class="-mt-2" :messages="$errors->get('age_confirmed')" />
                    <button type="submit" class="w-full bg-boss-gold hover:bg-boss-gold-hover text-white py-4 transition-all duration-300 tracking-[0.2em] uppercase text-[0.75rem]">{{ __('Submit Application') }}</button>
                    <p class="text-center text-boss-dark/40 text-[0.75rem]">{{ __('We respond to all applications within 48 hours.') }}</p>
                </form>
            @endif
        </div>
    </section>
</x-layouts.marketing>
