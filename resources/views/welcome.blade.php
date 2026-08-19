<x-layout title="Shri Mandir Trust | Ancient Sanatan Sanctuary & Centenary Heritage">
    <x-navbar />
    
    <!-- Hero Section (Ancient Opened Sacred Scroll) -->
    <x-hero />
    
    <!-- Chapter 1: Sacred Heritage & History (Granth Chapter) -->
    <x-about />
    
    <!-- Chapter 2: Pooja & Samskara Patrika (Vedic Patrika Scroll) -->
    <x-services />

    <!-- Chapter 3: Live Darshan & Daily Aarti (Garbhagriha Broadcast) -->
    <section class="py-24 bg-[#F8F3E8] relative overflow-hidden border-b border-[#DEC7A2]/60">
        <div class="container mx-auto px-6 md:px-12 relative z-10 max-w-6xl">
            
            <div class="text-center max-w-3xl mx-auto mb-16 reveal-fade-up relative">
                <!-- Rising Floral Vine Flourishes on Left and Right -->
                <div class="hidden md:block absolute -left-12 -top-6">
                    <x-vertical-vine position="left" size="w-16 h-36" opacity="opacity-60" />
                </div>
                <div class="hidden md:block absolute -right-12 -top-6">
                    <x-vertical-vine position="right" size="w-16 h-36" opacity="opacity-60" />
                </div>

                <div class="text-xs uppercase tracking-[0.3em] font-marcellus text-[#912003] font-bold mb-2">
                    ॥ तृतीयः अध्यायः • प्रत्यक्ष दर्शनम् ॥
                </div>
                <h2 class="font-cinzel text-3xl md:text-5xl font-bold text-[#1C120C]">
                    24/7 Akhand Garbhagriha <span class="gold-leaf-text">Live Darshan</span>
                </h2>
                <div class="sacred-divider">
                    <span class="animate-flame">🔱</span>
                </div>
            </div>

            <!-- Parchment Live Broadcast Frame -->
            <div class="parchment-scroll p-4 sm:p-8 rounded-3xl antique-border shadow-2xl grid grid-cols-1 lg:grid-cols-12 gap-8 items-center hover-lift reveal-scale-in">
                
                <!-- Live Stream Video Window (7 cols) -->
                <div class="lg:col-span-7 relative bg-black rounded-2xl overflow-hidden aspect-video shadow-md group reveal-fade-left">
                    <img src="{{ asset('images/mandir-aarti.jpg') }}" alt="Live Aarti Broadcast" class="w-full h-full object-cover opacity-85 group-hover:scale-105 transition-transform duration-1000">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>
                    
                    <div class="absolute top-4 left-4 flex items-center gap-2 px-3 py-1 rounded-full bg-[#912003] text-white font-bold text-xs uppercase tracking-widest shadow animate-live-glow">
                        <span class="w-2 h-2 rounded-full bg-white animate-ping"></span>
                        <span>Live Aarti Broadcast</span>
                    </div>

                    <button onclick="playTempleBell()" class="shimmer-btn absolute inset-0 m-auto w-16 h-16 rounded-full bg-[#912003] hover:bg-[#6C1802] text-white flex items-center justify-center text-2xl shadow-[0_0_30px_rgba(145,32,3,0.8)] transition-transform hover:scale-110 cursor-pointer">
                        <span class="ml-1">▶</span>
                    </button>
                    
                    <div class="absolute bottom-4 left-4 right-4 flex justify-between text-xs text-[#F4EBD9] font-marcellus">
                        <span>Sanctum Sanctorum (Garbhagriha)</span>
                        <span class="bg-black/60 px-2.5 py-0.5 rounded border border-[#A16207]/40 flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></span>
                            <span data-counter-target="1420" data-counter-suffix=" Devotees Present">1,420 Devotees Present</span>
                        </span>
                    </div>
                </div>

                <!-- Darshan Details (5 cols) -->
                <div class="lg:col-span-5 space-y-6 reveal-fade-right">
                    <div>
                        <span class="text-xs uppercase font-marcellus tracking-widest text-[#912003] font-bold block mb-1">Akhand Jyoti & Daily Chants</span>
                        <h3 class="font-cinzel text-2xl font-bold text-[#1C120C]">
                            Receive Divine Vibrations at Home
                        </h3>
                        <p class="text-[#422B1E] text-sm leading-relaxed mt-2 font-normal">
                            Devotees across the world participate in the morning Mangala, midday Rajbhog, and twilight Sandhya Aarti directly from the sacred altar.
                        </p>
                    </div>

                    <div class="space-y-2.5 bg-[#FAF6EC] p-4 rounded-2xl border border-[#DEC7A2] text-xs text-[#2C1D14] font-marcellus hover:border-[#912003] transition-colors">
                        <div class="flex justify-between border-b border-[#DEC7A2]/50 pb-2">
                            <span>Next Aarti:</span>
                            <strong class="text-[#912003] animate-pulse">Sandhya Deepam Aarti (07:00 PM)</strong>
                        </div>
                        <div class="flex justify-between border-b border-[#DEC7A2]/50 pb-2">
                            <span>Mukhya Acharya:</span>
                            <strong>Acharya Vidyadhar Shukla</strong>
                        </div>
                        <div class="flex justify-between">
                            <span>Chants:</span>
                            <span class="text-[#782606]">Shri Rudram & Hanuman Chalisa</span>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <button onclick="openBookingModal()" class="shimmer-btn hover-lift flex-1 py-3.5 rounded-full bg-[#912003] hover:bg-[#6C1802] text-[#FFFDF9] font-cinzel font-bold text-xs uppercase tracking-wider text-center shadow-sm transition-all cursor-pointer">
                            Submit Remote Sankalp 🙏
                        </button>
                        <a href="{{ route('gallery') }}" class="hover-lift flex-1 py-3.5 rounded-full bg-[#FAF6EC] hover:bg-[#EADBC0] text-[#422B1E] font-cinzel font-bold text-xs uppercase tracking-wider text-center border border-[#DEC7A2] transition-all">
                            Darshan Gallery
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Chapter 4: Surabhi Goshala Seva -->
    <section class="py-24 bg-[#FAF6EC] relative overflow-hidden border-b border-[#DEC7A2]/60">
        <div class="container mx-auto px-6 md:px-12 relative z-10 max-w-6xl">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <div class="lg:col-span-6 space-y-6 reveal-fade-left">
                    <div class="text-xs uppercase tracking-[0.3em] font-marcellus text-[#912003] font-bold">
                        ॥ चतुर्थः अध्यायः • कामधेनु सुरभि सेवा ॥
                    </div>
                    <h2 class="font-cinzel text-3xl md:text-5xl font-bold text-[#1C120C] leading-tight">
                        Serving 500+ Sacred <br><span class="gold-leaf-text">Indigenous Gir Cows</span>
                    </h2>
                    <div class="w-20 h-1 bg-[#912003] rounded-full"></div>
                    <p class="text-[#422B1E] text-base leading-relaxed font-normal">
                        According to Sanatan scriptures, all deities reside within Gomata. Our ashram sanctuary provides green grass, fresh water, and veterinary rehabilitation to over 500 indigenous cattle.
                    </p>
                    
                    <div class="parchment-scroll p-4 rounded-2xl border border-[#DEC7A2] space-y-2 text-xs font-marcellus text-[#2C1D14] hover-lift">
                        <div class="flex justify-between items-center">
                            <span>🌿 <strong>Grass & Fodder Sponsor:</strong> ₹ 1,100 (Feeds 10 cows)</span>
                            <a href="{{ route('donate') }}" class="text-[#912003] font-bold underline hover:text-[#6C1802] transition-colors">Sponsor</a>
                        </div>
                        <div class="flex justify-between items-center border-t border-[#DEC7A2]/50 pt-2">
                            <span>🐄 <strong>Monthly Cow Adoption:</strong> ₹ 5,100 (Full Seva)</span>
                            <a href="{{ route('donate') }}" class="text-[#912003] font-bold underline hover:text-[#6C1802] transition-colors">Adopt</a>
                        </div>
                    </div>

                    <div class="pt-2">
                        <a href="{{ route('donate') }}" class="shimmer-btn hover-lift inline-flex items-center gap-3 px-8 py-3.5 rounded-full bg-[#912003] hover:bg-[#6C1802] text-[#FFFDF9] font-cinzel font-bold text-xs uppercase tracking-widest shadow-md transition-all">
                            🙏 Sponsor Gau Grass & Medical Seva
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-6 relative reveal-fade-right">
                    <div class="parchment-scroll p-3 rounded-3xl antique-border shadow-xl aspect-[4/3] group overflow-hidden hover-lift">
                        <img src="{{ asset('images/mandir-goshala.jpg') }}" alt="Temple Goshala" class="w-full h-full object-cover rounded-2xl transition-transform duration-1000 group-hover:scale-105">
                    </div>
                    <div class="text-center mt-3 text-xs font-marcellus text-[#6C1802] italic">
                        ॥ सुरभि गोशाला आश्रम • नित्य गोपूजन ॥
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Chapter 5: Sanatan Panchang & Upcoming Festivals -->
    <section class="py-24 bg-[#F8F3E8] relative overflow-hidden">
        <div class="container mx-auto px-6 md:px-12 relative z-10 max-w-5xl">
            
            <div class="text-center max-w-3xl mx-auto mb-16 reveal-fade-up relative">
                <!-- Rising Floral Vine Flourishes on Left and Right -->
                <div class="hidden md:block absolute -left-12 -top-6">
                    <x-vertical-vine position="left" size="w-16 h-36" opacity="opacity-60" />
                </div>
                <div class="hidden md:block absolute -right-12 -top-6">
                    <x-vertical-vine position="right" size="w-16 h-36" opacity="opacity-60" />
                </div>

                <div class="text-xs uppercase tracking-[0.3em] font-marcellus text-[#912003] font-bold mb-2">
                    ॥ पञ्चमः अध्यायः • सनातन तिथि पञ्चाङ्गम् ॥
                </div>
                <h2 class="font-cinzel text-3xl md:text-5xl font-bold text-[#1C120C]">
                    Upcoming <span class="gold-leaf-text">Sacred Mahotsavs</span>
                </h2>
                <div class="sacred-divider">
                    <span class="animate-flame">🪔</span>
                </div>
            </div>

            <!-- Flowing Festival Patrika List with Staggered Entrance -->
            <div class="parchment-scroll p-6 sm:p-10 rounded-3xl antique-border shadow-xl space-y-6 stagger-parent hover-lift">
                
                <!-- Festival 1 -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-6 border-b border-[#DEC7A2] group transition-all hover:bg-[#FAF6EC]/50 p-2 rounded-xl">
                    <div>
                        <span class="text-[10px] uppercase font-marcellus tracking-widest text-[#912003] font-bold">फाल्गुन कृष्ण चतुर्दशी • All-Night Vigil</span>
                        <h3 class="font-cinzel text-2xl font-bold text-[#1C120C] mt-0.5 group-hover:text-[#912003] transition-colors">Maha Shivaratri Akhand Mahotsav</h3>
                        <p class="text-xs text-[#422B1E] mt-1 font-normal">24-hour non-stop Akhand Rudrabhishek, 4-Prahar Maha Aarti, and mass feast.</p>
                    </div>
                    <a href="{{ route('events') }}" class="hover-lift px-5 py-2 rounded-full bg-[#FAF6EC] hover:bg-[#EADBC0] text-[#6C1802] border border-[#DEC7A2] font-cinzel font-bold text-xs uppercase tracking-wider shrink-0">
                        View Schedule →
                    </a>
                </div>

                <!-- Festival 2 -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-6 border-b border-[#DEC7A2] group transition-all hover:bg-[#FAF6EC]/50 p-2 rounded-xl">
                    <div>
                        <span class="text-[10px] uppercase font-marcellus tracking-widest text-[#912003] font-bold">चैत्र शुक्ल नवमी • 12:00 PM Noon Janmotsav</span>
                        <h3 class="font-cinzel text-2xl font-bold text-[#1C120C] mt-0.5 group-hover:text-[#912003] transition-colors">Sri Ram Navami & Chhappan Bhog</h3>
                        <p class="text-xs text-[#422B1E] mt-1 font-normal">Grand floral decoration of the Garbhagriha, Ramcharitmanas Samapti, and royal palanquin.</p>
                    </div>
                    <a href="{{ route('events') }}" class="hover-lift px-5 py-2 rounded-full bg-[#FAF6EC] hover:bg-[#EADBC0] text-[#6C1802] border border-[#DEC7A2] font-cinzel font-bold text-xs uppercase tracking-wider shrink-0">
                        View Schedule →
                    </a>
                </div>

                <!-- Festival 3 -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 group transition-all hover:bg-[#FAF6EC]/50 p-2 rounded-xl">
                    <div>
                        <span class="text-[10px] uppercase font-marcellus tracking-widest text-[#912003] font-bold">भाद्रपद अष्टमी • Midnight 12:00 AM</span>
                        <h3 class="font-cinzel text-2xl font-bold text-[#1C120C] mt-0.5 group-hover:text-[#912003] transition-colors">Sri Krishna Janmashtami Mahotsav</h3>
                        <p class="text-xs text-[#422B1E] mt-1 font-normal">Midnight Abhishek with holy waters from 7 sacred rivers and Matki Phod festivities.</p>
                    </div>
                    <a href="{{ route('events') }}" class="hover-lift px-5 py-2 rounded-full bg-[#FAF6EC] hover:bg-[#EADBC0] text-[#6C1802] border border-[#DEC7A2] font-cinzel font-bold text-xs uppercase tracking-wider shrink-0">
                        View Schedule →
                    </a>
                </div>

            </div>

            <div class="text-center mt-10 reveal-fade-up">
                <a href="{{ route('events') }}" class="hover-lift inline-flex items-center gap-2 px-8 py-3 rounded-full bg-[#FAF6EC] hover:bg-[#EADBC0] text-[#422B1E] font-cinzel font-bold text-xs uppercase tracking-widest border border-[#DEC7A2] shadow-sm">
                    Open Full Annual Sanatan Panchang →
                </a>
            </div>
        </div>
    </section>

    <x-footer />
</x-layout>
