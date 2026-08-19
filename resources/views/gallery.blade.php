<x-layout title="Divine Darshan & Photo Gallery | Shri Mandir Trust">
    <x-navbar />

    <!-- Page Header (Ancient Scroll Inscription) -->
    <section class="relative pt-44 pb-20 overflow-hidden">
        <div class="container mx-auto px-6 relative z-10 text-center max-w-4xl reveal-fade-up">
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
        <div class="container mx-auto px-6 md:px-12 max-w-6xl">
            
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
                
                <div class="gal-item aarti parchment-scroll p-3 rounded-2xl antique-border shadow-md break-inside-avoid cursor-pointer group hover-lift overflow-hidden" onclick="openLightbox('{{ asset('images/mandir-aarti.jpg') }}', 'Daily Sandhya Deepam Aarti with 108 tiered brass lamps')">
                    <img src="{{ asset('images/mandir-aarti.jpg') }}" alt="Maha Deepam Aarti" class="w-full h-auto rounded-xl object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="pt-3 px-1 text-center">
                        <span class="text-[10px] uppercase font-marcellus tracking-widest text-[#912003] font-bold">Maha Aarti</span>
                        <h4 class="font-cinzel text-base font-bold text-[#1C120C] group-hover:text-[#912003] transition-colors">Daily Sandhya Deepam Aarti</h4>
                    </div>
                </div>

                <div class="gal-item sanctum parchment-scroll p-3 rounded-2xl antique-border shadow-md break-inside-avoid cursor-pointer group hover-lift overflow-hidden" onclick="openLightbox('{{ asset('images/hero-mandir.jpg') }}', 'Sunrise over the 100-year-old temple sanctum')">
                    <img src="{{ asset('images/hero-mandir.jpg') }}" alt="Temple Sunrise" class="w-full h-auto rounded-xl object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="pt-3 px-1 text-center">
                        <span class="text-[10px] uppercase font-marcellus tracking-widest text-[#912003] font-bold">Architecture</span>
                        <h4 class="font-cinzel text-base font-bold text-[#1C120C] group-hover:text-[#912003] transition-colors">Sunrise over Garbhagriha</h4>
                    </div>
                </div>

                <div class="gal-item goshala parchment-scroll p-3 rounded-2xl antique-border shadow-md break-inside-avoid cursor-pointer group hover-lift overflow-hidden" onclick="openLightbox('{{ asset('images/mandir-goshala.jpg') }}', 'Sacred Indigenous Gir cows in the ashram sanctuary')">
                    <img src="{{ asset('images/mandir-goshala.jpg') }}" alt="Surabhi Cows" class="w-full h-auto rounded-xl object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="pt-3 px-1 text-center">
                        <span class="text-[10px] uppercase font-marcellus tracking-widest text-[#912003] font-bold">Gau Seva</span>
                        <h4 class="font-cinzel text-base font-bold text-[#1C120C] group-hover:text-[#912003] transition-colors">Surabhi Cow Sanctuary</h4>
                    </div>
                </div>

                <div class="gal-item aarti parchment-scroll p-3 rounded-2xl antique-border shadow-md break-inside-avoid cursor-pointer group hover-lift overflow-hidden" onclick="openLightbox('{{ asset('images/mandir-aarti.jpg') }}', 'Devotees chanting in unison during twilight Aarti')">
                    <img src="{{ asset('images/mandir-aarti.jpg') }}" alt="Aarti Ceremony" class="w-full h-auto rounded-xl object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="pt-3 px-1 text-center">
                        <span class="text-[10px] uppercase font-marcellus tracking-widest text-[#912003] font-bold">Vedic Rituals</span>
                        <h4 class="font-cinzel text-base font-bold text-[#1C120C] group-hover:text-[#912003] transition-colors">Devotee Congregation</h4>
                    </div>
                </div>

                <div class="gal-item sanctum parchment-scroll p-3 rounded-2xl antique-border shadow-md break-inside-avoid cursor-pointer group hover-lift overflow-hidden" onclick="openLightbox('{{ asset('images/hero-mandir.jpg') }}', 'Ancient sandstone spires reflecting sacred geometry')">
                    <img src="{{ asset('images/hero-mandir.jpg') }}" alt="Shikhar" class="w-full h-auto rounded-xl object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="pt-3 px-1 text-center">
                        <span class="text-[10px] uppercase font-marcellus tracking-widest text-[#912003] font-bold">Sanctum</span>
                        <h4 class="font-cinzel text-base font-bold text-[#1C120C] group-hover:text-[#912003] transition-colors">Shikhar & Water Courtyard</h4>
                    </div>
                </div>

                <div class="gal-item goshala parchment-scroll p-3 rounded-2xl antique-border shadow-md break-inside-avoid cursor-pointer group hover-lift overflow-hidden" onclick="openLightbox('{{ asset('images/mandir-goshala.jpg') }}', 'Morning green grass feeding in peaceful ashram grounds')">
                    <img src="{{ asset('images/mandir-goshala.jpg') }}" alt="Goshala Morning" class="w-full h-auto rounded-xl object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="pt-3 px-1 text-center">
                        <span class="text-[10px] uppercase font-marcellus tracking-widest text-[#912003] font-bold">Ashram Peace</span>
                        <h4 class="font-cinzel text-base font-bold text-[#1C120C] group-hover:text-[#912003] transition-colors">Morning Grass Feeding</h4>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Lightbox Modal -->
    <div id="lightbox-modal" class="fixed inset-0 z-50 bg-black/90 backdrop-blur-md hidden flex items-center justify-center p-4 transition-all">
        <button onclick="closeLightbox()" class="absolute top-6 right-6 text-white text-3xl font-bold w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center cursor-pointer transition-transform hover:rotate-90">✕</button>
        <div class="max-w-5xl w-full text-center space-y-4 modal-unfold">
            <img id="lightbox-img" src="" alt="Fullscreen Darshan" class="max-h-[80vh] mx-auto rounded-2xl shadow-2xl border-2 border-[#A16207]/40 object-contain">
            <h4 id="lightbox-caption" class="font-cinzel text-xl font-bold text-[#F4EBD9]"></h4>
        </div>
    </div>

    <x-footer />
</x-layout>
