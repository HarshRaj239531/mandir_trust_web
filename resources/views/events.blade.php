<x-layout title="Sanatan Panchang & Sacred Festivals | Shringi Rishi Mandir Trust">
    <x-navbar />

    <!-- Page Header (Ancient Scroll Inscription) -->
    <section class="relative pt-8 sm:pt-12 pb-12 sm:pb-16 overflow-hidden">
        <div class="container mx-auto px-4 sm:px-8 relative z-10 text-center max-w-5xl reveal-fade-up">
            <div class="parchment-scroll p-8 sm:p-12 rounded-3xl antique-border shadow-xl hover-lift relative overflow-hidden group">
                <!-- User Provided Vintage Floral Corner Ornaments -->
                <x-vintage-corner position="top-right" size="w-20 h-20 sm:w-28 sm:h-28" />
                <x-vintage-corner position="top-left" size="w-20 h-20 sm:w-28 sm:h-28" />

                <div class="text-xs uppercase tracking-[0.3em] font-marcellus text-[#912003] font-bold mb-2 animate-float-gentle relative z-10">
                    ॥ वार्षिक उत्सव एवं पञ्चाङ्ग पत्रिका ॥
                </div>
                <h1 class="font-cinzel text-3xl sm:text-5xl font-bold text-[#1C120C] mb-4 relative z-10">
                    Sacred Festivals & <br><span class="gold-leaf-text">Divine Mahotsav Patrika</span>
                </h1>
                <div class="sacred-divider relative z-10">
                    <span class="animate-flame">🪔 ॐ 🪔</span>
                </div>
                <p class="font-marcellus text-base sm:text-lg text-[#782606] italic max-w-2xl mx-auto relative z-10">
                    Celebrate holy tithis with grand processions, akhand kirtan, 56-bhog feasts, and Vedic yajnas.
                </p>
            </div>
        </div>
    </section>

    <!-- Flowing Festivals Timeline (Granth Format) with Staggered Entrance -->
    <section class="py-16 bg-[#FAF6EC] border-y border-[#DEC7A2]/60">
        <div class="container mx-auto px-4 sm:px-8 lg:px-12 xl:px-16 max-w-[1380px] space-y-12 stagger-parent">
            
            @forelse ($events as $e)
                @php
                    $eventImg = $e->image ? (str_starts_with($e->image, 'http') ? $e->image : asset('storage/' . $e->image)) : null;
                @endphp
                <div class="parchment-scroll p-6 sm:p-10 rounded-3xl antique-border shadow-xl space-y-6 hover-lift group">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 pb-4 border-b border-[#DEC7A2]">
                        <div>
                            <span class="text-[10px] uppercase font-marcellus tracking-widest text-[#912003] font-bold">{{ $e->category }} • {{ $e->event_date }}</span>
                            <h3 class="font-cinzel text-2xl sm:text-3xl font-bold text-[#1C120C] mt-1 group-hover:text-[#912003] transition-colors">{{ $e->title }}</h3>
                        </div>
                        <span class="px-3.5 py-1 rounded-full bg-[#912003] text-[#FFFDF9] font-cinzel text-xs font-bold uppercase tracking-wider shadow-sm">
                            {{ $e->status }}
                        </span>
                    </div>

                    @if ($eventImg)
                        <div class="h-56 sm:h-72 rounded-2xl overflow-hidden shadow-inner border border-[#DEC7A2]">
                            <img src="{{ $eventImg }}" alt="{{ $e->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        </div>
                    @endif

                    <p class="text-sm text-[#422B1E] leading-relaxed font-normal">
                        {{ $e->description }}
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 bg-[#FAF6EC] p-4 rounded-2xl border border-[#DEC7A2] text-xs text-[#2C1D14] font-marcellus">
                        <div><strong class="text-[#912003]">Timings:</strong> {{ $e->timings ?: 'Daily Aarti & Darshan Timings' }}</div>
                        <div><strong class="text-[#912003]">Expected Crowd:</strong> {{ $e->expected_crowd }}</div>
                        <div class="sm:col-span-2"><strong class="text-[#912003]">Coordinator:</strong> {{ $e->coordinator }}</div>
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <span class="text-xs text-[#5C3C2A] italic">Free Mahaprasad served to all visiting pilgrims.</span>
                        <a href="{{ route('donate') }}" class="shimmer-btn hover-lift px-5 py-2 rounded-full bg-[#912003] hover:bg-[#6C1802] text-[#FFFDF9] font-cinzel font-bold text-xs uppercase tracking-wider shadow-sm transition-all cursor-pointer">
                            Sponsor Seva / Daan 🙏
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center py-12 text-gray-500 parchment-scroll rounded-3xl p-8">No upcoming events scheduled right now in the temple database.</div>
            @endforelse

        </div>
    </section>

    <!-- Volunteer Section -->
    <section class="py-16 bg-[#F8F3E8] text-center">
        <div class="container mx-auto px-6 max-w-2xl reveal-fade-up">
            <h3 class="font-cinzel text-2xl font-bold text-[#1C120C] mb-2">Serve as a Temple Volunteer (Shramdaan)</h3>
            <p class="text-xs sm:text-sm text-[#422B1E] mb-6">Join our seva volunteers for crowd facilitation, Annadanam service, and festival coordination.</p>
            <button onclick="handleModalSubmit(event, 'Volunteer registration noted! Seva team will reach out.')" class="shimmer-btn hover-lift px-8 py-3.5 rounded-full bg-[#912003] hover:bg-[#6C1802] text-[#FFFDF9] font-cinzel font-bold text-xs uppercase tracking-widest shadow-md cursor-pointer transition-all">
                Register for Shramdaan Seva 🙏
            </button>
        </div>
    </section>

    <x-footer />
</x-layout>
