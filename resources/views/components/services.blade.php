<section id="services" class="py-20 md:py-24 bg-[#FAF6EC] relative overflow-hidden border-b border-[#DEC7A2]/60">
    <div class="container mx-auto px-4 sm:px-8 lg:px-12 xl:px-16 relative z-10 max-w-[1380px]">
        
        <!-- Sacred Chapter Header -->
        <div class="text-center max-w-4xl mx-auto mb-14 md:mb-16 reveal-fade-up relative">
            <!-- Rising Floral Vine Flourishes on Left and Right -->
            <div class="hidden md:block absolute -left-12 -top-6">
                <x-vertical-vine position="left" size="w-16 h-36" opacity="opacity-60" />
            </div>
            <div class="hidden md:block absolute -right-12 -top-6">
                <x-vertical-vine position="right" size="w-16 h-36" opacity="opacity-60" />
            </div>

            <div class="text-xs uppercase tracking-[0.3em] font-marcellus text-[#912003] font-bold mb-2">
                ॥ द्वितीयः अध्यायः • वैदिक पूजा विधान ॥
            </div>
            <h2 class="font-cinzel text-3xl md:text-5xl font-bold text-[#1C120C]">
                Sacred Vedic Poojas & <span class="gold-leaf-text">Sankalpam Patrika</span>
            </h2>
            <div class="sacred-divider">
                <span class="animate-flame">🪷</span>
            </div>
            <p class="text-[#422B1E] text-base font-normal">
                Authentic Agamic rituals performed in the Garbhagriha with personalized Gotra and family Sankalpa.
            </p>
        </div>

        <!-- Ancient Pooja Patrika Scroll List with Stagger Entrance -->
        <div class="parchment-scroll p-6 sm:p-10 rounded-3xl antique-border shadow-xl space-y-8 stagger-parent hover-lift">
            
            @php
                $displayPoojas = isset($poojas) && $poojas->isNotEmpty() ? $poojas : \App\Models\Pooja::where('is_active', true)->take(3)->get();
            @endphp

            @forelse ($displayPoojas as $p)
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 pb-8 {{ !$loop->last ? 'border-b border-[#DEC7A2]' : '' }} group hover:bg-[#FFFDF9]/80 p-3 rounded-2xl transition-all">
                    <div class="space-y-2 max-w-2xl">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl text-[#912003] group-hover:scale-125 transition-transform duration-300">🔱</span>
                            <div>
                                <span class="text-[10px] uppercase font-marcellus tracking-widest text-[#912003] font-bold">{{ $p->category }} • {{ $p->deity }}</span>
                                <h3 class="font-cinzel text-2xl font-bold text-[#1C120C] group-hover:text-[#912003] transition-colors">{{ $p->title }}</h3>
                            </div>
                        </div>
                        <p class="text-sm text-[#422B1E] font-normal leading-relaxed">
                            {{ $p->description }}
                        </p>
                        @if ($p->inclusions)
                            <div class="text-xs text-[#6C1802] font-medium flex flex-wrap gap-4 pt-1">
                                <span>✓ {{ $p->inclusions }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="shrink-0 text-left md:text-right w-full md:w-auto">
                        <span class="text-[11px] uppercase tracking-wider text-[#5C3C2A] block font-semibold">Dakshina</span>
                        <span class="font-cinzel text-2xl font-bold text-[#912003] block mb-2 group-hover:scale-105 transition-transform">₹ {{ number_format($p->dakshina, 0) }}</span>
                        <a href="{{ route('poojas') }}" class="shimmer-btn hover-lift inline-block px-6 py-2.5 rounded-full bg-[#912003] hover:bg-[#6C1802] text-[#FFFDF9] font-cinzel font-bold text-xs uppercase tracking-wider shadow-sm transition-all cursor-pointer">
                            Book Sankalp 🙏
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center py-6 text-gray-500">No active pooja rituals currently scheduled.</div>
            @endforelse

        </div>

        <div class="text-center mt-12 reveal-fade-up">
            <a href="{{ route('poojas') }}" class="hover-lift inline-flex items-center gap-2 px-8 py-3.5 rounded-full bg-[#FAF6EC] hover:bg-[#EADBC0] text-[#422B1E] font-cinzel font-bold text-xs uppercase tracking-widest border border-[#DEC7A2] shadow-sm transition-all">
                View All 21+ Sacred Samskaras & Havan Patrika →
            </a>
        </div>

    </div>
</section>
