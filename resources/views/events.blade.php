<x-layout title="Sanatan Panchang & Sacred Festivals | Shri Mandir Trust">
    <x-navbar />

    <!-- Page Header (Ancient Scroll Inscription) -->
    <section class="relative pt-8 sm:pt-12 pb-12 sm:pb-16 overflow-hidden">
        <div class="container mx-auto px-6 relative z-10 text-center max-w-4xl reveal-fade-up">
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
        <div class="container mx-auto px-6 md:px-12 max-w-5xl space-y-12 stagger-parent">
            
            <!-- Festival 1: Maha Shivaratri -->
            <div class="parchment-scroll p-6 sm:p-10 rounded-3xl antique-border shadow-xl space-y-6 hover-lift group">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 pb-4 border-b border-[#DEC7A2]">
                    <div>
                        <span class="text-[10px] uppercase font-marcellus tracking-widest text-[#912003] font-bold">फाल्गुन कृष्ण चतुर्दशी • All Night Vigil</span>
                        <h3 class="font-cinzel text-2xl sm:text-3xl font-bold text-[#1C120C] mt-1 group-hover:text-[#912003] transition-colors">Maha Shivaratri Akhand Mahotsav</h3>
                    </div>
                    <span class="px-3.5 py-1 rounded-full bg-[#912003] text-[#FFFDF9] font-cinzel text-xs font-bold uppercase tracking-wider shadow-sm animate-pulse">
                        Grand Mahotsav
                    </span>
                </div>

                <p class="text-sm text-[#422B1E] leading-relaxed font-normal">
                    The supreme night of Lord Shiva. Continuous 4-Prahar Abhishekam with milk, bilva leaves, sugarcane juice, and holy bhasma, accompanied by non-stop Vedic chanting by 108 priests.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 bg-[#FAF6EC] p-4 rounded-2xl border border-[#DEC7A2] text-xs text-[#2C1D14] font-marcellus">
                    <div><strong class="text-[#912003]">04:00 AM:</strong> Mangala Snanam & Aarti</div>
                    <div><strong class="text-[#912003]">11:00 AM:</strong> 1,008 Rudrabhishek</div>
                    <div><strong class="text-[#912003]">07:00 PM:</strong> 1st Prahar Sandhya Aarti</div>
                    <div><strong class="text-[#912003]">12:00 AM:</strong> Midnight Lingodbhava Pooja</div>
                </div>

                <div class="flex items-center justify-between pt-2">
                    <span class="text-xs text-[#5C3C2A] italic">Free Mahaprasad served to all pilgrims.</span>
                    <button onclick="openBookingModal()" class="shimmer-btn hover-lift px-5 py-2 rounded-full bg-[#912003] hover:bg-[#6C1802] text-[#FFFDF9] font-cinzel font-bold text-xs uppercase tracking-wider shadow-sm transition-all cursor-pointer">
                        RSVP / Book Sankalp 🙏
                    </button>
                </div>
            </div>

            <!-- Festival 2: Sri Ram Navami -->
            <div class="parchment-scroll p-6 sm:p-10 rounded-3xl antique-border shadow-xl space-y-6 hover-lift group">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 pb-4 border-b border-[#DEC7A2]">
                    <div>
                        <span class="text-[10px] uppercase font-marcellus tracking-widest text-[#912003] font-bold">चैत्र शुक्ल नवमी • 12:00 PM Noon Janmotsav</span>
                        <h3 class="font-cinzel text-2xl sm:text-3xl font-bold text-[#1C120C] mt-1 group-hover:text-[#912003] transition-colors">Sri Ram Navami & Chhappan Bhog</h3>
                    </div>
                    <span class="px-3.5 py-1 rounded-full bg-[#912003] text-[#FFFDF9] font-cinzel text-xs font-bold uppercase tracking-wider shadow-sm">
                        Janmotsav
                    </span>
                </div>

                <p class="text-sm text-[#422B1E] leading-relaxed font-normal">
                    Appearance of Lord Rama. Concluding 9 days of Chaitra Navratri with flower shower over the Garbhagriha, Ramcharitmanas recitation samapti, and grand royal palanquin procession.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 bg-[#FAF6EC] p-4 rounded-2xl border border-[#DEC7A2] text-xs text-[#2C1D14] font-marcellus">
                    <div><strong class="text-[#912003]">09:00 AM:</strong> Valmiki Ramayana Samapti</div>
                    <div><strong class="text-[#912003]">12:00 PM:</strong> Ram Janmotsav Aarti & Flowers</div>
                    <div><strong class="text-[#912003]">01:00 PM:</strong> 56-Bhog Mahaprasadam</div>
                    <div><strong class="text-[#912003]">05:30 PM:</strong> Shobha Yatra Procession</div>
                </div>

                <div class="flex items-center justify-between pt-2">
                    <span class="text-xs text-[#5C3C2A] italic">Akhand kirtan by traditional bhajan mandalis.</span>
                    <button onclick="openBookingModal()" class="shimmer-btn hover-lift px-5 py-2 rounded-full bg-[#912003] hover:bg-[#6C1802] text-[#FFFDF9] font-cinzel font-bold text-xs uppercase tracking-wider shadow-sm transition-all cursor-pointer">
                        Sponsor 56-Bhog 🙏
                    </button>
                </div>
            </div>

            <!-- Festival 3: Gopashtami -->
            <div class="parchment-scroll p-6 sm:p-10 rounded-3xl antique-border shadow-xl space-y-6 hover-lift group">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 pb-4 border-b border-[#DEC7A2]">
                    <div>
                        <span class="text-[10px] uppercase font-marcellus tracking-widest text-[#912003] font-bold">कार्तिक शुक्ल अष्टमी • Goshala Mahotsav</span>
                        <h3 class="font-cinzel text-2xl sm:text-3xl font-bold text-[#1C120C] mt-1 group-hover:text-[#912003] transition-colors">Gopashtami Surabhi Veneration</h3>
                    </div>
                    <span class="px-3.5 py-1 rounded-full bg-[#912003] text-[#FFFDF9] font-cinzel text-xs font-bold uppercase tracking-wider shadow-sm">
                        Gau Seva Day
                    </span>
                </div>

                <p class="text-sm text-[#422B1E] leading-relaxed font-normal">
                    Ceremonial bathing, marigold decoration, and mass sweet jaggery feeding of all 500+ indigenous Gir cows in the ashram sanctuary.
                </p>

                <div class="flex items-center justify-between pt-2">
                    <span class="text-xs text-[#5C3C2A] italic">Devotees are invited to feed cows with family.</span>
                    <a href="{{ route('donate') }}" class="shimmer-btn hover-lift px-5 py-2 rounded-full bg-[#912003] hover:bg-[#6C1802] text-[#FFFDF9] font-cinzel font-bold text-xs uppercase tracking-wider shadow-sm transition-all text-center">
                        Sponsor Cow Grass 🙏
                    </a>
                </div>
            </div>

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
