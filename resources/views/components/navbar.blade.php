@php
    $currentRoute = Route::currentRouteName();
@endphp

<!-- Royal Vedic Parchment Scroll Header -->
<header id="navbar-header" class="relative z-40 w-full pt-1 sm:pt-1.5 px-3 sm:px-6 md:px-8">
    <div class="max-w-7xl mx-auto relative flex items-center justify-center">
        
        <!-- Central Opened Parchment Scroll Banner (विस्तृत राजसी पट्टिका) -->
        <div class="w-full parchment-scroll royal-gold-frame rounded-2xl md:rounded-3xl px-4 sm:px-8 py-2 sm:py-2.5 border-2 border-[#CA8A04] shadow-[0_10px_35px_rgba(44,29,20,0.18)] flex items-center justify-between relative overflow-hidden backdrop-blur-md">
            <x-gold-corners size="w-7 h-7 sm:w-9 sm:h-9" />
            
            <!-- Subtle Antique Manuscript Watermark & Trim Lines -->
            <div class="absolute inset-x-4 top-1.5 h-[1px] bg-gradient-to-r from-transparent via-[#CA8A04]/60 to-transparent pointer-events-none"></div>
            <div class="absolute inset-x-4 bottom-1.5 h-[1px] bg-gradient-to-r from-transparent via-[#CA8A04]/60 to-transparent pointer-events-none"></div>
            
            <!-- Left: Temple Sanctum Seal & Brand -->
            <a href="{{ route('home') }}" class="flex items-center gap-3.5 group shrink-0 relative z-10">
                <div class="relative flex items-center justify-center w-11 h-11 rounded-full bg-gradient-to-br from-[#FFFDF9] to-[#FAF6EC] border-2 border-[#CA8A04] shadow-md transition-all duration-500 group-hover:scale-110 group-hover:border-[#912003]">
                    <span class="font-cinzel text-2xl text-[#912003] font-black group-hover:rotate-180 transition-transform duration-700">ॐ</span>
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
            <nav class="hidden lg:flex items-center gap-1 xl:gap-2 text-xs font-bold uppercase tracking-wider font-cinzel relative z-10">
                <a href="{{ route('home') }}" class="px-3 py-2 rounded-xl transition-all duration-300 relative group hover:scale-105 {{ request()->routeIs('home') ? 'bg-[#912003] text-[#FFFDF9] shadow-sm' : 'text-[#422B1E] hover:text-[#912003] hover:bg-[#FAF6EC]' }}">
                    <span>Home</span>
                </a>

                <a href="{{ route('about') }}" class="px-3 py-2 rounded-xl transition-all duration-300 relative group hover:scale-105 {{ request()->routeIs('about') ? 'bg-[#912003] text-[#FFFDF9] shadow-sm' : 'text-[#422B1E] hover:text-[#912003] hover:bg-[#FAF6EC]' }}">
                    <span>Heritage</span>
                </a>

                <a href="{{ route('poojas') }}" class="px-3 py-2 rounded-xl transition-all duration-300 relative group hover:scale-105 {{ request()->routeIs('poojas') ? 'bg-[#912003] text-[#FFFDF9] shadow-sm' : 'text-[#422B1E] hover:text-[#912003] hover:bg-[#FAF6EC]' }}">
                    <span>Poojas</span>
                </a>

                <a href="{{ route('events') }}" class="px-3 py-2 rounded-xl transition-all duration-300 relative group hover:scale-105 {{ request()->routeIs('events') ? 'bg-[#912003] text-[#FFFDF9] shadow-sm' : 'text-[#422B1E] hover:text-[#912003] hover:bg-[#FAF6EC]' }}">
                    <span>Festivals</span>
                </a>

                <a href="{{ route('facilities') }}" class="px-3 py-2 rounded-xl transition-all duration-300 relative group hover:scale-105 {{ request()->routeIs('facilities') ? 'bg-[#912003] text-[#FFFDF9] shadow-sm' : 'text-[#422B1E] hover:text-[#912003] hover:bg-[#FAF6EC]' }}">
                    <span>Ashram</span>
                </a>

                <a href="{{ route('gallery') }}" class="px-3 py-2 rounded-xl transition-all duration-300 relative group hover:scale-105 {{ request()->routeIs('gallery') ? 'bg-[#912003] text-[#FFFDF9] shadow-sm' : 'text-[#422B1E] hover:text-[#912003] hover:bg-[#FAF6EC]' }}">
                    <span>Gallery</span>
                </a>

                <!-- Devotee Registration Link -->
                @guest
                    <a href="{{ route('register') }}" class="px-3 py-2 rounded-xl transition-all duration-300 relative group hover:scale-105 text-[#912003] hover:bg-[#912003]/10 font-bold border border-[#912003]/30">
                        <span>भक्त पंजीकरण</span>
                    </a>
                @endguest
            </nav>

            <!-- Right: Devotee Account & Quick Actions -->
            <div class="hidden sm:flex items-center gap-2.5 relative z-10">
                <button onclick="playTempleBell()" title="Sound Temple Bell" class="w-9 h-9 rounded-full bg-[#FAF6EC] hover:bg-[#EADBC0] border border-[#DEC7A2] flex items-center justify-center text-[#912003] hover:scale-110 transition-all cursor-pointer shadow-xs group">
                    <span class="group-hover:rotate-12 transition-transform text-sm inline-block">🔔</span>
                </button>

                @auth
                    <!-- Devotee My Account Dropdown / Button -->
                    <a href="{{ route('devotee.profile') }}" class="flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#FAF6EC] hover:bg-[#F4EBD9] border border-[#CA8A04] shadow-xs text-xs font-cinzel font-bold text-[#1C120C] hover:scale-105 transition-all">
                        <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->nickname }}" class="w-6 h-6 rounded-full object-cover border border-[#912003]">
                        <span class="max-w-[90px] truncate text-[#912003]">{{ auth()->user()->nickname }}</span>
                    </a>
                @else
                    <!-- Login / Register Modal Trigger -->
                    <a href="{{ route('login') }}" class="text-xs uppercase tracking-wider font-bold text-[#6C1802] hover:text-[#912003] px-3 py-2 rounded-full border border-[#DEC7A2] hover:bg-[#FAF6EC] transition-all cursor-pointer font-cinzel">
                        Login
                    </a>
                @endauth

                <a href="{{ route('donate') }}" class="shimmer-btn hover-lift px-4 py-2 rounded-full bg-gradient-to-r from-[#912003] via-[#B93815] to-[#912003] hover:from-[#6C1802] text-[#FFFDF9] font-cinzel font-bold text-xs uppercase tracking-widest shadow-md transition-all flex items-center gap-1.5">
                    <span>🙏</span> <span>Pavitra Daan</span>
                </a>
            </div>

            <!-- Mobile Hamburger Button -->
            <button id="mobile-toggle" onclick="toggleMobileMenu()" class="lg:hidden w-10 h-10 rounded-xl bg-[#FAF6EC] border border-[#DEC7A2] flex items-center justify-center text-[#6C1802] focus:outline-none shadow-xs transition-transform active:scale-95 relative z-10" aria-label="Toggle Menu">
                <svg id="menu-icon-bars" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                <svg id="menu-icon-close" class="w-5 h-5 hidden transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
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
            
            <div class="pt-3 border-t border-[#DEC7A2] flex flex-col gap-2">
                @auth
                    <a href="{{ route('devotee.profile') }}" class="p-3 rounded-xl bg-[#FAF6EC] border border-[#CA8A04] text-[#912003] font-bold text-xs uppercase tracking-wider flex items-center justify-between">
                        <span>👤 Mera Khata ({{ auth()->user()->nickname }})</span>
                        <span>→</span>
                    </a>
                @else
                    <div class="grid grid-cols-2 gap-2">
                        <a href="{{ route('register') }}" class="py-2.5 px-3 rounded-xl bg-[#912003] text-[#FFFDF9] text-center font-bold text-xs uppercase tracking-wider">
                            भक्त पंजीकरण
                        </a>
                        <a href="{{ route('login') }}" class="py-2.5 px-3 rounded-xl bg-[#FAF6EC] border border-[#DEC7A2] text-[#422B1E] text-center font-bold text-xs uppercase tracking-wider">
                            भक्त लॉगिन
                        </a>
                    </div>
                @endauth

                <button onclick="openBookingModal()" class="w-full py-3 rounded-xl bg-[#FAF6EC] border border-[#DEC7A2] text-[#6C1802] font-bold text-xs uppercase tracking-wider transition-all hover:bg-[#DEC7A2]/40 mt-1">
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
</script>
