<section id="hero-section" class="relative -mt-16 sm:-mt-20 min-h-screen flex flex-col justify-between pt-20 sm:pt-24 pb-0 overflow-hidden">
    
    <!-- 1. Background Mandir Sanctuary (100% Unobstructed, Crisp & High Definition) -->
    <div class="absolute inset-0 w-full h-full -z-10 overflow-hidden">
        <img id="hero-mandir-bg" src="{{ \App\Models\SiteSetting::getImageUrl('hero_mandir_image', 'images/hero-mandir.jpg') }}" alt="Grand Mandir Sanctuary" class="w-full h-full object-cover object-center ken-burns will-change-transform filter brightness-100 contrast-105">
        
        <!-- Subtle atmospheric lighting for contrast -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/55 via-transparent to-black/65 pointer-events-none"></div>
        <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-[#FAF6EC] via-transparent to-transparent pointer-events-none"></div>
    </div>

    <!-- 2. Minimalist Grand Content (Kam se Kam, Clean & Elegant) -->
    <div class="container mx-auto px-4 sm:px-8 lg:px-12 my-auto relative z-10 text-center max-w-5xl">
        
        <!-- Small Sacred Badge -->
        <div class="mb-3 reveal-fade-up">
            <span class="inline-flex items-center gap-2 px-4 py-1 rounded-full bg-black/45 backdrop-blur-md border border-[#FDE047]/70 text-[#FDE047] text-xs font-marcellus font-bold tracking-[0.25em] uppercase shadow-lg">
                <span class="text-[#FDE047] animate-flame">🪔</span>
                ॥ श्री मन्दिर शताब्दी महोत्सव • १९२४ - २०२४ ॥
                <span class="text-[#FDE047] animate-flame">🪔</span>
            </span>
        </div>

        <!-- Main Title (Grand, Crisp & High Impact) -->
        <div class="space-y-2 mb-6 reveal-fade-up">
            <h1 class="font-cinzel text-4xl sm:text-6xl md:text-7xl font-extrabold text-white tracking-tight leading-[1.15] [text-shadow:_0_4px_16px_rgba(0,0,0,0.95),_0_2px_4px_rgba(0,0,0,1)]">
                सनातन धर्म का <span class="text-[#FDE047] [text-shadow:_0_0_25px_rgba(253,224,71,0.8),_0_4px_16px_rgba(0,0,0,0.95)]">दिव्य धाम</span>
            </h1>
            <p class="font-marcellus text-lg sm:text-2xl md:text-3xl text-[#FFFDF9] font-normal tracking-wide [text-shadow:_0_2px_10px_rgba(0,0,0,0.95)]">
                A Century of <span class="text-[#FDE047] font-semibold italic">Sacred Vedic Grace</span> & Seva
            </p>
        </div>

        <!-- Minimal Action Buttons -->
        <div class="flex flex-wrap items-center justify-center gap-4 reveal-fade-up">
            <button onclick="openBookingModal()" class="shimmer-btn hover-lift px-8 py-3.5 rounded-full bg-gradient-to-r from-[#912003] via-[#B93815] to-[#912003] hover:from-[#6C1802] text-[#FFFDF9] font-cinzel font-bold text-xs sm:text-sm uppercase tracking-widest shadow-[0_4px_25px_rgba(145,32,3,0.8)] transition-all duration-300 hover:scale-105 cursor-pointer border border-[#FDE047]/60">
                🕉️ Book Sankalpam
            </button>
            <a href="{{ route('facilities') }}" class="hover-lift px-8 py-3.5 rounded-full bg-black/45 hover:bg-black/65 text-[#FFFDF9] hover:text-[#FDE047] font-cinzel font-bold text-xs sm:text-sm uppercase tracking-widest border border-white/50 backdrop-blur-md transition-all duration-300 hover:scale-105 shadow-xl">
                Ashram Lodging
            </a>
            <button onclick="playTempleBell()" title="Ring Sacred Temple Bell" class="hover-lift w-12 h-12 rounded-full bg-black/45 hover:bg-[#912003] border-2 border-[#FDE047] text-[#FDE047] hover:text-white flex items-center justify-center text-xl backdrop-blur-md shadow-xl transition-all duration-300 hover:scale-110 cursor-pointer">
                🔔
            </button>
        </div>

    </div>

    <!-- 3. Bottom Sacred Sanskrit Marquee Ticker -->
    <div class="w-full relative z-10 mt-auto">
        <div class="relative w-full overflow-hidden py-3 border-t border-[#DEC7A2]/60 bg-[#FAF6EC]/95 backdrop-blur-md shadow-md">
            <div class="animate-marquee whitespace-nowrap flex gap-12 text-xs sm:text-sm font-marcellus text-[#6C1802] tracking-widest uppercase font-bold">
                <span>ॐ नमः शिवाय</span>
                <span class="text-[#CA8A04]">•</span>
                <span>हरे राम हरे राम राम राम हरे हरे । हरे कृष्ण हरे कृष्ण कृष्ण कृष्ण हरे हरे</span>
                <span class="text-[#CA8A04]">•</span>
                <span>ॐ भूर्भुवः स्वः तत्सवितुर्वरेण्यं भर्गो देवस्य धीमहि धियो यो नः प्रचोदयात्</span>
                <span class="text-[#CA8A04]">•</span>
                <span>ॐ त्र्यम्बकं यजामहे सुगन्धिं पुष्टिवर्धनम् उर्वारुकमिव बन्धनान् मृत्योर्मुक्षीय मामृतात्</span>
                <span class="text-[#CA8A04]">•</span>
                <span>लोकाः समस्ताः सुखिनो भवन्तु</span>
                <span class="text-[#CA8A04]">•</span>
                <span>ॐ नमः शिवाय</span>
                <span class="text-[#CA8A04]">•</span>
                <span>हरे राम हरे राम राम राम हरे हरे । हरे कृष्ण हरे कृष्ण कृष्ण कृष्ण हरे हरे</span>
                <span class="text-[#CA8A04]">•</span>
            </div>
        </div>
    </div>

</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const heroSection = document.getElementById('hero-section');
        if (heroSection && typeof gsap !== 'undefined') {
            gsap.to("#hero-mandir-bg", {
                yPercent: 10,
                ease: "none",
                scrollTrigger: {
                    trigger: "#hero-section",
                    start: "top top",
                    end: "bottom top",
                    scrub: 0.5
                }
            });
        }
    });
</script>
