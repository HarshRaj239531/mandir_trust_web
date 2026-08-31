<section id="about" class="py-24 bg-[#F8F3E8] relative overflow-hidden border-b border-[#DEC7A2]/60">
    <div class="container mx-auto px-6 md:px-12 relative z-10 max-w-6xl">
        
        <!-- Sacred Chapter Header -->
        <div class="text-center max-w-3xl mx-auto mb-16 reveal-fade-up relative">
            <!-- Rising Floral Vine Flourishes on Left and Right -->
            <div class="hidden md:block absolute -left-12 -top-6">
                <x-vertical-vine position="left" size="w-16 h-36" opacity="opacity-60" />
            </div>
            <div class="hidden md:block absolute -right-12 -top-6">
                <x-vertical-vine position="right" size="w-16 h-36" opacity="opacity-60" />
            </div>

            <div class="text-xs uppercase tracking-[0.3em] font-marcellus text-[#912003] font-bold mb-2">
                ॥ प्रथमः अध्यायः • मन्दिर इतिहास ॥
            </div>
            <h2 class="font-cinzel text-3xl md:text-5xl font-bold text-[#1C120C]">
                Living Heritage of Ancient <span class="gold-leaf-text">Sanatan Devotion</span>
            </h2>
            <div class="sacred-divider">
                <span class="animate-flame">🪔</span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left: Ancient Inscription Visual (5 cols) -->
            <div class="lg:col-span-5 relative reveal-fade-left">
                <div class="parchment-scroll p-3 rounded-3xl antique-border shadow-xl aspect-[4/3] group overflow-hidden hover-lift">
                    <img src="{{ \App\Models\SiteSetting::getImageUrl('about_history_image', 'images/mandir-aarti.jpg') }}" alt="Maha Aarti Ceremony" class="w-full h-full object-cover rounded-2xl transition-transform duration-1000 group-hover:scale-105">
                </div>
                <div class="text-center mt-3 text-xs font-marcellus text-[#6C1802] italic">
                    ॥ नित्य संध्या महाआरती • अखण्ड दीप दर्शन ॥
                </div>
            </div>

            <!-- Right: Flowing Ancient Manuscript Narrative with Drop Cap (7 cols - NO generic cards) -->
            <div class="lg:col-span-7 space-y-6 reveal-fade-right">
                <p class="drop-cap text-base sm:text-lg text-[#2C1D14] leading-relaxed font-normal">
                    ounded in the holy year 1924, Shri Mandir Trust has stood through a century of devotion as an unshakeable pillar of Sanatan Dharma. The temple was hand-carved according to the sacred *Agama Shastras*, creating a cosmic alignment where the divine vibrations of daily Vedic chants bring profound stillness to the seeking mind.
                </p>
                
                <p class="text-base text-[#422B1E] leading-relaxed font-normal">
                    Guided by the timeless Vedic precept of *Vasudhaiva Kutumbakam*, the Trust seamlessly blends rigorous ritual purity with selfless public seva: feeding thousands of pilgrims daily through Maha Annadanam, sheltering sacred cows, and educating young scholars in Sanskrit scriptures.
                </p>

                <!-- Ancient 4 Vows / Pillars in Manuscript List style with Stagger Entrance -->
                <div class="pt-4 border-t border-[#DEC7A2] space-y-3 font-marcellus text-sm text-[#2C1D14] stagger-parent">
                    <div class="flex items-center gap-3 p-2 rounded-xl transition-all hover:bg-[#FAF6EC] hover:translate-x-1">
                        <span class="text-[#912003] font-bold text-lg animate-flame">🪔</span>
                        <span><strong>नित्य आराधना (Nitya Aradhana):</strong> Five daily Agamic pujas strictly performed without pause since 1924.</span>
                    </div>
                    <div class="flex items-center gap-3 p-2 rounded-xl transition-all hover:bg-[#FAF6EC] hover:translate-x-1">
                        <span class="text-[#912003] font-bold text-lg">🍲</span>
                        <span><strong>महा अन्नदानम् (Maha Annadanam):</strong> Unrestricted free sattvic food served to 5,000+ daily pilgrims.</span>
                    </div>
                    <div class="flex items-center gap-3 p-2 rounded-xl transition-all hover:bg-[#FAF6EC] hover:translate-x-1">
                        <span class="text-[#912003] font-bold text-lg">🐄</span>
                        <span><strong>सुरभि गोसेवा (Surabhi Gau Seva):</strong> Lifelong Vedic protection and green fodder for 500+ Gir cows.</span>
                    </div>
                </div>

                <div class="pt-4 flex flex-wrap items-center gap-4">
                    <a href="{{ route('about') }}" class="shimmer-btn hover-lift px-7 py-3.5 rounded-full bg-[#912003] hover:bg-[#6C1802] text-[#FFFDF9] font-cinzel font-bold text-xs uppercase tracking-widest transition-all shadow-md">
                        Read Complete Centenary Granth →
                    </a>
                    <button onclick="playTempleBell()" class="hover-lift px-6 py-3.5 rounded-full bg-[#FAF6EC] hover:bg-[#EADBC0] text-[#6C1802] font-cinzel font-bold text-xs uppercase tracking-widest border border-[#DEC7A2] transition-all cursor-pointer">
                        🔔 Sound Temple Bell
                    </button>
                </div>
            </div>

        </div>
    </div>
</section>
