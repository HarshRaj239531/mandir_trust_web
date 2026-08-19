@php
    $currentRoute = Route::currentRouteName();
@endphp

<!-- Royal Vedic Parchment Scroll Header -->
<header id="navbar-header" class="fixed top-6 left-0 w-full z-40 transition-all duration-500 ease-in-out px-4 sm:px-6 md:px-8 translate-y-0">
    <div class="max-w-7xl mx-auto relative flex items-center justify-center">
        
        <!-- Left Wooden Scroll Finial / Cylinder Knob (अलंकृत काष्ठ दण्ड) -->
        <div class="hidden md:flex items-center -mr-2 z-20 select-none pointer-events-none">
            <!-- Finial Top Knob -->
            <div class="flex flex-col items-center">
                <div class="w-2.5 h-3 bg-gradient-to-t from-[#782606] to-[#CA8A04] rounded-t-full border border-[#422B1E]"></div>
                <div class="w-5 h-16 bg-gradient-to-r from-[#2C1D14] via-[#782606] via-[#A16207] to-[#2C1D14] rounded-l-md border-y border-l border-[#422B1E] shadow-xl flex flex-col justify-between py-2">
                    <div class="w-full h-1 bg-[#CA8A04]/60"></div>
                    <div class="w-full h-1 bg-[#CA8A04]/60"></div>
                </div>
                <div class="w-2.5 h-3 bg-gradient-to-b from-[#782606] to-[#CA8A04] rounded-b-full border border-[#422B1E]"></div>
            </div>
        </div>

        <!-- Central Opened Parchment Scroll Banner (विस्तृत भोजपत्र पट्टिका) -->
        <div class="w-full parchment-scroll rounded-2xl md:rounded-3xl px-5 sm:px-8 py-3 border-y-2 border-[#A16207] border-x border-[#DEC7A2] shadow-[0_15px_45px_rgba(44,29,20,0.18)] flex items-center justify-between relative overflow-hidden backdrop-blur-md">
            
            <!-- Subtle Antique Manuscript Watermark & Trim Lines -->
            <div class="absolute inset-x-4 top-1.5 h-[1px] bg-gradient-to-r from-transparent via-[#A16207]/40 to-transparent pointer-events-none"></div>
            <div class="absolute inset-x-4 bottom-1.5 h-[1px] bg-gradient-to-r from-transparent via-[#A16207]/40 to-transparent pointer-events-none"></div>
            
            <!-- Left: Temple Sanctum Seal & Brand -->
            <a href="{{ route('home') }}" class="flex items-center gap-3.5 group shrink-0">
                <div class="relative flex items-center justify-center w-11 h-11 rounded-full bg-gradient-to-br from-[#FFFDF9] to-[#FAF6EC] border-2 border-[#A16207] shadow-md transition-all duration-500 group-hover:scale-110 group-hover:border-[#912003]">
                    <span class="font-cinzel text-2xl text-[#912003] font-black group-hover:rotate-180 transition-transform duration-700">ॐ</span>
                    <span class="absolute -top-1 -right-1 flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#CA8A04] opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-[#912003] border border-white"></span>
                    </span>
                </div>
                <div>
                    <span class="font-cinzel text-base sm:text-lg font-black tracking-wider text-[#1C120C] block leading-none transition-colors group-hover:text-[#912003]">
                        SHRI MANDIR
                    </span>
                    <span class="text-[9px] sm:text-[10px] tracking-[0.25em] text-[#912003] uppercase font-bold flex items-center gap-1 mt-0.5">
                        <span>॥</span> Sanatan Trust <span>॥</span>
                    </span>
                </div>
            </a>

            <!-- Center: Elegant Parchment Nav Links -->
            <nav class="hidden lg:flex items-center gap-1 xl:gap-2 text-xs font-bold uppercase tracking-wider font-cinzel">
                <a href="{{ route('home') }}" class="px-3.5 py-2 rounded-xl transition-all duration-300 relative group hover:scale-105 {{ request()->routeIs('home') ? 'bg-[#912003] text-[#FFFDF9] shadow-sm' : 'text-[#422B1E] hover:text-[#912003] hover:bg-[#FAF6EC]' }}">
                    <span>Home</span>
                    @if(request()->routeIs('home'))
                        <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-[#CA8A04] rounded-full animate-ping"></span>
                        <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-[#CA8A04] rounded-full"></span>
                    @endif
                </a>

                <a href="{{ route('about') }}" class="px-3.5 py-2 rounded-xl transition-all duration-300 relative group hover:scale-105 {{ request()->routeIs('about') ? 'bg-[#912003] text-[#FFFDF9] shadow-sm' : 'text-[#422B1E] hover:text-[#912003] hover:bg-[#FAF6EC]' }}">
                    <span>Heritage</span>
                    @if(request()->routeIs('about'))
                        <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-[#CA8A04] rounded-full animate-ping"></span>
                        <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-[#CA8A04] rounded-full"></span>
                    @endif
                </a>

                <a href="{{ route('poojas') }}" class="px-3.5 py-2 rounded-xl transition-all duration-300 relative group hover:scale-105 {{ request()->routeIs('poojas') ? 'bg-[#912003] text-[#FFFDF9] shadow-sm' : 'text-[#422B1E] hover:text-[#912003] hover:bg-[#FAF6EC]' }}">
                    <span>Poojas</span>
                    @if(request()->routeIs('poojas'))
                        <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-[#CA8A04] rounded-full animate-ping"></span>
                        <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-[#CA8A04] rounded-full"></span>
                    @endif
                </a>

                <a href="{{ route('events') }}" class="px-3.5 py-2 rounded-xl transition-all duration-300 relative group hover:scale-105 {{ request()->routeIs('events') ? 'bg-[#912003] text-[#FFFDF9] shadow-sm' : 'text-[#422B1E] hover:text-[#912003] hover:bg-[#FAF6EC]' }}">
                    <span>Festivals</span>
                    @if(request()->routeIs('events'))
                        <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-[#CA8A04] rounded-full animate-ping"></span>
                        <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-[#CA8A04] rounded-full"></span>
                    @endif
                </a>

                <a href="{{ route('facilities') }}" class="px-3.5 py-2 rounded-xl transition-all duration-300 relative group hover:scale-105 {{ request()->routeIs('facilities') ? 'bg-[#912003] text-[#FFFDF9] shadow-sm' : 'text-[#422B1E] hover:text-[#912003] hover:bg-[#FAF6EC]' }}">
                    <span>Yatri Niwas</span>
                    @if(request()->routeIs('facilities'))
                        <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-[#CA8A04] rounded-full animate-ping"></span>
                        <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-[#CA8A04] rounded-full"></span>
                    @endif
                </a>

                <a href="{{ route('gallery') }}" class="px-3.5 py-2 rounded-xl transition-all duration-300 relative group hover:scale-105 {{ request()->routeIs('gallery') ? 'bg-[#912003] text-[#FFFDF9] shadow-sm' : 'text-[#422B1E] hover:text-[#912003] hover:bg-[#FAF6EC]' }}">
                    <span>Gallery</span>
                    @if(request()->routeIs('gallery'))
                        <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-[#CA8A04] rounded-full animate-ping"></span>
                        <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-[#CA8A04] rounded-full"></span>
                    @endif
                </a>
            </nav>

            <!-- Right: Quick Actions (Temple Bell & Pavitra Daan) -->
            <div class="hidden sm:flex items-center gap-3">
                <button onclick="playTempleBell()" title="Sound Temple Bell" class="w-9 h-9 rounded-full bg-[#FAF6EC] hover:bg-[#EADBC0] border border-[#DEC7A2] flex items-center justify-center text-[#912003] hover:scale-110 transition-all cursor-pointer shadow-xs group">
                    <span class="group-hover:rotate-12 transition-transform text-sm inline-block">🔔</span>
                </button>

                <button onclick="openBookingModal()" class="hover-lift text-xs uppercase tracking-wider font-bold text-[#6C1802] hover:text-black px-4 py-2 rounded-full border border-[#DEC7A2] hover:bg-[#FAF6EC] transition-all cursor-pointer font-cinzel">
                    Book Pooja
                </button>

                <a href="{{ route('donate') }}" class="shimmer-btn hover-lift px-5 py-2 rounded-full bg-gradient-to-r from-[#912003] via-[#B93815] to-[#912003] hover:from-[#6C1802] text-[#FFFDF9] font-cinzel font-bold text-xs uppercase tracking-widest shadow-md transition-all flex items-center gap-1.5">
                    <span>🙏</span> <span>Pavitra Daan</span>
                </a>
            </div>

            <!-- Mobile Hamburger Button -->
            <button id="mobile-toggle" onclick="toggleMobileMenu()" class="lg:hidden w-10 h-10 rounded-xl bg-[#FAF6EC] border border-[#DEC7A2] flex items-center justify-center text-[#6C1802] focus:outline-none shadow-xs transition-transform active:scale-95" aria-label="Toggle Menu">
                <svg id="menu-icon-bars" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                <svg id="menu-icon-close" class="w-5 h-5 hidden transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- Right Wooden Scroll Finial / Cylinder Knob (अलंकृत काष्ठ दण्ड) -->
        <div class="hidden md:flex items-center -ml-2 z-20 select-none pointer-events-none">
            <div class="flex flex-col items-center">
                <div class="w-2.5 h-3 bg-gradient-to-t from-[#782606] to-[#CA8A04] rounded-t-full border border-[#422B1E]"></div>
                <div class="w-5 h-16 bg-gradient-to-r from-[#2C1D14] via-[#A16207] via-[#782606] to-[#2C1D14] rounded-r-md border-y border-r border-[#422B1E] shadow-xl flex flex-col justify-between py-2">
                    <div class="w-full h-1 bg-[#CA8A04]/60"></div>
                    <div class="w-full h-1 bg-[#CA8A04]/60"></div>
                </div>
                <div class="w-2.5 h-3 bg-gradient-to-b from-[#782606] to-[#CA8A04] rounded-b-full border border-[#422B1E]"></div>
            </div>
        </div>

    </div>

    <!-- Mobile Drawer Overlay (Parchment Patrika Style) -->
    <div id="mobile-drawer" class="lg:hidden hidden mt-3 max-w-lg mx-auto rounded-3xl parchment-scroll border-2 border-[#A16207] p-6 shadow-2xl transition-all modal-unfold">
        <div class="flex flex-col gap-2 font-cinzel">
            <a href="{{ route('home') }}" class="p-3 rounded-xl font-bold text-xs uppercase tracking-wider flex items-center justify-between transition-all hover:translate-x-1 {{ request()->routeIs('home') ? 'bg-[#912003] text-white' : 'text-[#422B1E] hover:bg-[#FAF6EC]' }}">
                <span>🏠 Home</span>
                <span>॥</span>
            </a>
            <a href="{{ route('about') }}" class="p-3 rounded-xl font-bold text-xs uppercase tracking-wider flex items-center justify-between transition-all hover:translate-x-1 {{ request()->routeIs('about') ? 'bg-[#912003] text-white' : 'text-[#422B1E] hover:bg-[#FAF6EC]' }}">
                <span>🪔 Sacred Heritage</span>
                <span>॥</span>
            </a>
            <a href="{{ route('poojas') }}" class="p-3 rounded-xl font-bold text-xs uppercase tracking-wider flex items-center justify-between transition-all hover:translate-x-1 {{ request()->routeIs('poojas') ? 'bg-[#912003] text-white' : 'text-[#422B1E] hover:bg-[#FAF6EC]' }}">
                <span>🕉️ Poojas & Rituals</span>
                <span>॥</span>
            </a>
            <a href="{{ route('events') }}" class="p-3 rounded-xl font-bold text-xs uppercase tracking-wider flex items-center justify-between transition-all hover:translate-x-1 {{ request()->routeIs('events') ? 'bg-[#912003] text-white' : 'text-[#422B1E] hover:bg-[#FAF6EC]' }}">
                <span>🪷 Festivals & Events</span>
                <span>॥</span>
            </a>
            <a href="{{ route('facilities') }}" class="p-3 rounded-xl font-bold text-xs uppercase tracking-wider flex items-center justify-between transition-all hover:translate-x-1 {{ request()->routeIs('facilities') ? 'bg-[#912003] text-white' : 'text-[#422B1E] hover:bg-[#FAF6EC]' }}">
                <span>🐄 Yatri Niwas & Goshala</span>
                <span>॥</span>
            </a>
            <a href="{{ route('gallery') }}" class="p-3 rounded-xl font-bold text-xs uppercase tracking-wider flex items-center justify-between transition-all hover:translate-x-1 {{ request()->routeIs('gallery') ? 'bg-[#912003] text-white' : 'text-[#422B1E] hover:bg-[#FAF6EC]' }}">
                <span>📸 Divine Gallery</span>
                <span>॥</span>
            </a>
            
            <div class="pt-4 border-t border-[#DEC7A2] flex flex-col gap-2.5">
                <button onclick="openBookingModal()" class="w-full py-3 rounded-xl bg-[#FAF6EC] border border-[#DEC7A2] text-[#6C1802] font-bold text-xs uppercase tracking-wider transition-all hover:bg-[#DEC7A2]/40">
                    Book Sacred Pooja
                </button>
                <a href="{{ route('donate') }}" class="shimmer-btn w-full text-center py-3.5 rounded-xl bg-gradient-to-r from-[#912003] to-[#B93815] text-[#FFFDF9] font-cinzel font-bold text-xs uppercase tracking-widest shadow-md transition-all hover:scale-[1.02]">
                    🙏 Pavitra Daan Offering
                </a>
            </div>
        </div>
    </div>
</header>

<script>
    function toggleMobileMenu() {
        const drawer = document.getElementById('mobile-drawer');
        const bars = document.getElementById('menu-icon-bars');
        const close = document.getElementById('menu-icon-close');
        drawer.classList.toggle('hidden');
        bars.classList.toggle('hidden');
        close.classList.toggle('hidden');
    }

    // High Performance Smart Scroll Engine
    (function() {
        let lastScrollY = window.pageYOffset || document.documentElement.scrollTop;
        const navbar = document.getElementById('navbar-header');
        let ticking = false;

        window.addEventListener('scroll', function() {
            if (!ticking) {
                window.requestAnimationFrame(function() {
                    const currentScrollY = window.pageYOffset || document.documentElement.scrollTop;

                    // Near page top -> always pin navbar
                    if (currentScrollY <= 20) {
                        navbar.style.transform = 'translateY(0)';
                    }
                    // Scrolling down (delta > 5px) -> slide navbar out of view
                    else if (currentScrollY > lastScrollY && currentScrollY > 60) {
                        navbar.style.transform = 'translateY(-160%)';
                    }
                    // Scrolling up -> reveal navbar smoothly
                    else if (currentScrollY < lastScrollY) {
                        navbar.style.transform = 'translateY(0)';
                    }

                    lastScrollY = Math.max(0, currentScrollY);
                    ticking = false;
                });
                ticking = true;
            }
        }, { passive: true });
    })();
</script>
