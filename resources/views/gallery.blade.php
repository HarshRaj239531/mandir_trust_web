<x-layout title="Divine Darshan & Photo Gallery | Shringi Rishi Mandir Trust">
    <x-navbar />

    <!-- Page Header (Ancient Scroll Inscription) -->
    <section class="relative pt-8 sm:pt-12 pb-12 sm:pb-16 overflow-hidden">
        <div class="container mx-auto px-4 sm:px-8 relative z-10 text-center max-w-5xl reveal-fade-up">
            <div class="parchment-scroll p-8 sm:p-12 rounded-3xl antique-border shadow-xl hover-lift relative overflow-hidden group">
                <!-- User Provided Vintage Floral Corner Ornaments -->
                <x-vintage-corner position="top-right" size="w-20 h-20 sm:w-28 sm:h-28" />
                <x-vintage-corner position="top-left" size="w-20 h-20 sm:w-28 sm:h-28" />

                <div class="text-xs uppercase tracking-[0.3em] font-marcellus text-[#912003] font-bold mb-2 animate-float-gentle relative z-10">
                    ॥ दिव्य दर्शन एवं मन्दिर छायाचित्र ॥
                </div>
                <h1 class="font-cinzel text-3xl sm:text-5xl font-bold text-[#1C120C] mb-4 relative z-10">
                    Divine Photo & <br><span class="gold-leaf-text">Darshan Chitrashala</span>
                </h1>
                <div class="sacred-divider relative z-10">
                    <span class="animate-flame">📸 ॐ 📸</span>
                </div>
                <p class="font-marcellus text-base sm:text-lg text-[#782606] italic max-w-2xl mx-auto relative z-10">
                    Experience the timeless spiritual grandeur, Maha Aarti ceremonies, and ashram life.
                </p>
            </div>
        </div>
    </section>

    <!-- Gallery Section (Masonry Parchment Grid) -->
    <section class="py-16 bg-[#FAF6EC] border-y border-[#DEC7A2]/60 min-h-screen">
        <div class="container mx-auto px-4 sm:px-8 lg:px-12 xl:px-16 max-w-[1380px]">
            
            <!-- Category Filter Tabs with Active Indicators -->
            <div class="flex flex-wrap items-center justify-center gap-2.5 mb-12 reveal-fade-up">
                <button onclick="filterGallery('all')" class="gal-tab px-5 py-2 rounded-full bg-[#912003] text-[#FFFDF9] font-cinzel font-bold text-xs uppercase tracking-wider transition-all shadow-sm hover:scale-105 cursor-pointer">
                    All Darshan
                </button>
                <button onclick="filterGallery('aarti')" class="gal-tab px-5 py-2 rounded-full bg-[#FAF6EC] hover:bg-[#EADBC0] text-[#422B1E] font-cinzel font-bold text-xs uppercase tracking-wider border border-[#DEC7A2] transition-all hover:scale-105 cursor-pointer">
                    Maha Aarti
                </button>
                <button onclick="filterGallery('sanctum')" class="gal-tab px-5 py-2 rounded-full bg-[#FAF6EC] hover:bg-[#EADBC0] text-[#422B1E] font-cinzel font-bold text-xs uppercase tracking-wider border border-[#DEC7A2] transition-all hover:scale-105 cursor-pointer">
                    Sanctum & Shikhar
                </button>
                <button onclick="filterGallery('goshala')" class="gal-tab px-5 py-2 rounded-full bg-[#FAF6EC] hover:bg-[#EADBC0] text-[#422B1E] font-cinzel font-bold text-xs uppercase tracking-wider border border-[#DEC7A2] transition-all hover:scale-105 cursor-pointer">
                    Surabhi Goshala
                </button>
            </div>

            <!-- Gallery Grid with Staggered Entrance & Masonry -->
            <div class="columns-1 sm:columns-2 lg:columns-3 gap-6 space-y-6 stagger-parent">
                @forelse ($galleries as $g)
                    @php
                        $gImg = $g->image_url;
                    @endphp
                    <div class="gal-item {{ Str::slug($g->category) }} parchment-scroll p-3 rounded-2xl antique-border shadow-md break-inside-avoid cursor-pointer group hover-lift overflow-hidden" onclick="openLightbox('{{ $gImg }}', '{{ addslashes($g->caption ?: $g->title) }}')">
                        <div class="overflow-hidden rounded-xl bg-[#1C120C]">
                            <img src="{{ $gImg }}" alt="{{ $g->title }}" onerror="this.src='{{ asset('images/mandir-aarti.jpg') }}'" class="w-full h-auto max-h-[500px] rounded-xl object-cover object-top group-hover:scale-105 transition-transform duration-700">
                        </div>
                        <div class="pt-3 px-1 text-center">
                            <span class="text-[10px] uppercase font-marcellus tracking-widest text-[#912003] font-bold">{{ $g->category }}</span>
                            <h4 class="font-cinzel text-base font-bold text-[#1C120C] group-hover:text-[#912003] transition-colors">{{ $g->title }}</h4>
                            @if ($g->caption)
                                <p class="text-xs text-[#6C1802] mt-1 font-sans">{{ $g->caption }}</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 text-gray-500 parchment-scroll rounded-3xl p-8">No photos published in gallery yet.</div>
                @endforelse
            </div>

        </div>
    </section>

    <!-- Lightbox Modal with Parchment Border -->
    <div id="lightbox-modal" class="hidden fixed inset-0 z-50 bg-black/85 backdrop-blur-sm flex items-center justify-center p-4" onclick="closeLightbox(event)">
        <div class="parchment-scroll p-4 rounded-3xl antique-border max-w-3xl w-full shadow-2xl relative" onclick="event.stopPropagation()">
            <button onclick="closeLightbox()" class="absolute top-4 right-4 w-8 h-8 rounded-full bg-[#912003] text-white flex items-center justify-center text-sm font-bold shadow hover:bg-[#6C1802] transition-colors cursor-pointer z-10">✕</button>
            <img id="lightbox-img" src="" alt="Darshan Full View" class="w-full max-h-[70vh] object-contain rounded-2xl mb-3">
            <p id="lightbox-caption" class="font-cinzel text-sm text-center text-[#1C120C] font-bold"></p>
        </div>
    </div>

    <x-footer />

    <script>
        function filterGallery(category) {
            document.querySelectorAll('.gal-tab').forEach(tab => {
                tab.classList.remove('bg-[#912003]', 'text-[#FFFDF9]');
                tab.classList.add('bg-[#FAF6EC]', 'text-[#422B1E]');
            });
            event.target.classList.remove('bg-[#FAF6EC]', 'text-[#422B1E]');
            event.target.classList.add('bg-[#912003]', 'text-[#FFFDF9]');

            document.querySelectorAll('.gal-item').forEach(item => {
                if (category === 'all' || item.classList.contains(category)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        function openLightbox(src, caption) {
            document.getElementById('lightbox-img').src = src;
            document.getElementById('lightbox-caption').innerText = caption;
            document.getElementById('lightbox-modal').classList.remove('hidden');
        }

        function closeLightbox() {
            document.getElementById('lightbox-modal').classList.add('hidden');
        }
    </script>
</x-layout>
