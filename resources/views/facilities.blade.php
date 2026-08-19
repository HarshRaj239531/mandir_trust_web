<x-layout title="Pilgrim Facilities & Ashram Lodging | Shri Mandir Trust">
    <x-navbar />

    <!-- Page Header (Ancient Scroll Inscription) -->
    <section class="relative pt-8 sm:pt-12 pb-12 sm:pb-16 overflow-hidden">
        <div class="container mx-auto px-6 relative z-10 text-center max-w-4xl reveal-fade-up">
            <div class="parchment-scroll p-8 sm:p-12 rounded-3xl antique-border shadow-xl hover-lift relative overflow-hidden group">
                <!-- User Provided Vintage Floral Corner Ornaments -->
                <x-vintage-corner position="top-right" size="w-20 h-20 sm:w-28 sm:h-28" />
                <x-vintage-corner position="top-left" size="w-20 h-20 sm:w-28 sm:h-28" />

                <div class="text-xs uppercase tracking-[0.3em] font-marcellus text-[#912003] font-bold mb-2 animate-float-gentle relative z-10">
                    ॥ अतिथि देवो भव • यात्री निवास एवं सेवा ॥
                </div>
                <h1 class="font-cinzel text-3xl sm:text-5xl font-bold text-[#1C120C] mb-4 relative z-10">
                    Pilgrim Amenities & <br><span class="gold-leaf-text">Ashram Seva Margika</span>
                </h1>
                <div class="sacred-divider relative z-10">
                    <span class="animate-flame">🏛️ ॐ 🏛️</span>
                </div>
                <p class="font-marcellus text-base sm:text-lg text-[#782606] italic max-w-2xl mx-auto relative z-10">
                    Spotlessly clean, peaceful lodging and pure sattvic Annadanam for all visiting devotees.
                </p>
            </div>
        </div>
    </section>

    <!-- 1. Yatri Niwas (Accommodation Parchment List) -->
    <section class="py-16 bg-[#FAF6EC] border-y border-[#DEC7A2]/60">
        <div class="container mx-auto px-6 md:px-12 max-w-5xl space-y-12">
            
            <div class="text-center max-w-2xl mx-auto reveal-fade-up">
                <span class="text-xs uppercase font-marcellus tracking-widest text-[#912003] font-bold">आश्रम आवास</span>
                <h2 class="font-cinzel text-3xl sm:text-4xl font-bold text-[#1C120C] mt-1">Shri Hari Yatri Niwas</h2>
                <div class="sacred-divider"><span class="animate-flame">🪔</span></div>
            </div>

            <div class="parchment-scroll p-6 sm:p-10 rounded-3xl antique-border shadow-xl space-y-8 stagger-parent hover-lift">
                
                <!-- Room 1 -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 pb-8 border-b border-[#DEC7A2] group hover:bg-[#FFFDF9]/80 p-3 rounded-2xl transition-all">
                    <div class="space-y-2 max-w-xl">
                        <div class="flex items-center gap-3">
                            <span class="text-[10px] uppercase font-marcellus tracking-widest text-[#912003] font-bold bg-[#FAF6EC] px-2.5 py-0.5 rounded border border-[#DEC7A2]">Standard Non-AC</span>
                            <h3 class="font-cinzel text-xl font-bold text-[#1C120C] group-hover:text-[#912003] transition-colors">Vedic Double Room</h3>
                        </div>
                        <p class="text-xs sm:text-sm text-[#422B1E] font-normal leading-relaxed">
                            Simple, peaceful room overlooking the ashram gardens. Attached clean bathroom with 24-hour hot water and morning herbal tea.
                        </p>
                        <p class="text-xs text-[#782606] font-medium">✓ 2 Beds • Attached Bath • Clean Linens</p>
                    </div>

                    <div class="shrink-0 text-left md:text-right w-full md:w-auto">
                        <span class="font-cinzel text-2xl font-bold text-[#912003] block mb-2 group-hover:scale-105 transition-transform">₹ 800 <span class="text-xs font-sans text-[#5C3C2A] font-normal">/ Night</span></span>
                        <button onclick="handleModalSubmit(event, 'Yatri Niwas availability request received!')" class="shimmer-btn hover-lift px-5 py-2 rounded-full bg-[#912003] hover:bg-[#6C1802] text-[#FFFDF9] font-cinzel font-bold text-xs uppercase tracking-wider shadow-sm transition-all cursor-pointer">
                            Book Room
                        </button>
                    </div>
                </div>

                <!-- Room 2 -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 pb-8 border-b border-[#DEC7A2] group hover:bg-[#FFFDF9]/80 p-3 rounded-2xl transition-all">
                    <div class="space-y-2 max-w-xl">
                        <div class="flex items-center gap-3">
                            <span class="text-[10px] uppercase font-marcellus tracking-widest text-[#912003] font-bold bg-[#FAF6EC] px-2.5 py-0.5 rounded border border-[#DEC7A2]">Deluxe AC Suite</span>
                            <h3 class="font-cinzel text-xl font-bold text-[#1C120C] group-hover:text-[#912003] transition-colors">Devotee Family Suite (4 Bed)</h3>
                        </div>
                        <p class="text-xs sm:text-sm text-[#422B1E] font-normal leading-relaxed">
                            Spacious air-conditioned room accommodating family of 4 with direct view of the temple shikhar and priority darshan pass.
                        </p>
                        <p class="text-xs text-[#782606] font-medium">✓ 1 King + 2 Beds • AC • Hot Water • Priority Darshan</p>
                    </div>

                    <div class="shrink-0 text-left md:text-right w-full md:w-auto">
                        <span class="font-cinzel text-2xl font-bold text-[#912003] block mb-2 group-hover:scale-105 transition-transform">₹ 1,500 <span class="text-xs font-sans text-[#5C3C2A] font-normal">/ Night</span></span>
                        <button onclick="handleModalSubmit(event, 'Yatri Niwas availability request received!')" class="shimmer-btn hover-lift px-5 py-2 rounded-full bg-[#912003] hover:bg-[#6C1802] text-[#FFFDF9] font-cinzel font-bold text-xs uppercase tracking-wider shadow-sm transition-all cursor-pointer">
                            Book Suite 🙏
                        </button>
                    </div>
                </div>

                <!-- Room 3 -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 group hover:bg-[#FFFDF9]/80 p-3 rounded-2xl transition-all">
                    <div class="space-y-2 max-w-xl">
                        <div class="flex items-center gap-3">
                            <span class="text-[10px] uppercase font-marcellus tracking-widest text-[#912003] font-bold bg-[#FAF6EC] px-2.5 py-0.5 rounded border border-[#DEC7A2]">Dormitory</span>
                            <h3 class="font-cinzel text-xl font-bold text-[#1C120C] group-hover:text-[#912003] transition-colors">Sadhu & Pilgrim Hall</h3>
                        </div>
                        <p class="text-xs sm:text-sm text-[#422B1E] font-normal leading-relaxed">
                            Clean communal hall with individual lockers and hygienic washrooms. Provided completely free of cost for traveling sadhus.
                        </p>
                        <p class="text-xs text-[#782606] font-medium">✓ Clean Bedding • Locker • Free for Sadhus</p>
                    </div>

                    <div class="shrink-0 text-left md:text-right w-full md:w-auto">
                        <span class="font-cinzel text-2xl font-bold text-[#912003] block mb-2 group-hover:scale-105 transition-transform">₹ 200 <span class="text-xs font-sans text-[#5C3C2A] font-normal">/ Bed</span></span>
                        <button onclick="handleModalSubmit(event, 'Yatri Niwas availability request received!')" class="shimmer-btn hover-lift px-5 py-2 rounded-full bg-[#912003] hover:bg-[#6C1802] text-[#FFFDF9] font-cinzel font-bold text-xs uppercase tracking-wider shadow-sm transition-all cursor-pointer">
                            Book Bed
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 2. Maha Annapurna Hall & Goshala Narrative -->
    <section class="py-16 bg-[#F8F3E8]">
        <div class="container mx-auto px-6 md:px-12 max-w-5xl space-y-16">
            
            <!-- Annapurna -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
                <div class="md:col-span-6 parchment-scroll p-3 rounded-2xl antique-border shadow-lg reveal-fade-left hover-lift group overflow-hidden">
                    <img src="{{ asset('images/mandir-aarti.jpg') }}" alt="Annapurna Hall" class="w-full h-auto rounded-xl object-cover group-hover:scale-105 transition-transform duration-700">
                </div>
                <div class="md:col-span-6 space-y-4 reveal-fade-right">
                    <span class="text-xs uppercase font-marcellus tracking-widest text-[#912003] font-bold">महाप्रसाद सेवा</span>
                    <h3 class="font-cinzel text-2xl font-bold text-[#1C120C]">Maha Annapurna Bhojanalaya</h3>
                    <p class="text-xs sm:text-sm text-[#422B1E] font-normal leading-relaxed">
                        Hygienic kitchen preparing unlimited sattvic food for 5,000+ devotees daily without discrimination.
                    </p>
                    <div class="bg-[#FAF6EC] p-3 rounded-xl border border-[#DEC7A2] text-xs font-marcellus text-[#2C1D14] space-y-1 hover:border-[#912003] transition-colors">
                        <div><strong>Lunch Mahaprasad:</strong> 11:30 AM – 03:00 PM</div>
                        <div><strong>Dinner Mahaprasad:</strong> 07:30 PM – 09:30 PM</div>
                    </div>
                </div>
            </div>

            <!-- Goshala -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
                <div class="md:col-span-6 space-y-4 md:order-1 order-2 reveal-fade-left">
                    <span class="text-xs uppercase font-marcellus tracking-widest text-[#912003] font-bold">कामधेनु सुरभि सेवा</span>
                    <h3 class="font-cinzel text-2xl font-bold text-[#1C120C]">Surabhi Goshala Ashram</h3>
                    <p class="text-xs sm:text-sm text-[#422B1E] font-normal leading-relaxed">
                        15-acre sanctuary sheltering 500+ sacred Gir cows. Devotees can feed fresh grass & jaggery daily from 07:00 AM to 06:00 PM.
                    </p>
                    <a href="{{ route('donate') }}" class="shimmer-btn hover-lift inline-block px-6 py-2.5 rounded-full bg-[#912003] hover:bg-[#6C1802] text-[#FFFDF9] font-cinzel font-bold text-xs uppercase tracking-wider shadow-md">
                        Sponsor Cow Seva 🙏
                    </a>
                </div>
                <div class="md:col-span-6 parchment-scroll p-3 rounded-2xl antique-border shadow-lg md:order-2 order-1 reveal-fade-right hover-lift group overflow-hidden">
                    <img src="{{ asset('images/mandir-goshala.jpg') }}" alt="Goshala" class="w-full h-auto rounded-xl object-cover group-hover:scale-105 transition-transform duration-700">
                </div>
            </div>

        </div>
    </section>

    <x-footer />
</x-layout>
