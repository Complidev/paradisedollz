<x-layouts.marketing :title="__('Perks')">
    <section class="pt-28 pb-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <p class="text-boss-gold tracking-[0.3em] uppercase mb-4 text-[0.7rem]">{{ __('Member perks') }}</p>
            <h1 class="font-display text-[clamp(2.2rem,5vw,3.5rem)] text-boss-dark">{{ __('Perks that scale with you') }}</h1>
        </div>
    </section>
    <section class="pb-24 bg-boss-muted">
        <div class="max-w-5xl mx-auto px-4 grid sm:grid-cols-2 gap-6">
            @foreach ([
                __('Priority mentorship slots'),
                __('Campaign & promo collaborations'),
                __('Creative direction consults'),
                __('Community events & retreats (where available)'),
                __('Gear & upgrade stipends for top performers'),
                __('Health & wellness resources'),
            ] as $perk)
                <div class="bg-white border border-boss-pink/30 p-6 flex gap-4 items-start">
                    <span class="text-boss-gold text-sm tracking-[0.15em]">OK</span>
                    <p class="text-boss-dark/80">{{ $perk }}</p>
                </div>
            @endforeach
        </div>
    </section>
</x-layouts.marketing>
