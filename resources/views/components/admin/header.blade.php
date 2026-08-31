@props(['title' => 'Dashboard', 'subtitle' => 'Overview & Devotee Management'])

<!-- Modern Admin Topbar Bar (Yoga-Style Inspired) -->
<header class="bg-white/95 backdrop-blur-md border-b border-[#E5DCD0] sticky top-0 z-30 px-4 sm:px-6 lg:px-8 h-18 flex items-center justify-between shadow-[0_2px_12px_rgba(44,29,20,0.03)]">
    <div class="flex items-center gap-3.5">
        <!-- Desktop Sidebar Toggle Button -->
        <button onclick="toggleDesktopSidebar()" 
            class="hidden lg:flex w-10 h-10 rounded-xl bg-[#FAF7F2] hover:bg-[#FAF6EC] border border-[#DEC7A2] text-[#912003] items-center justify-center transition-all cursor-pointer shadow-2xs hover:scale-105"
            title="Toggle Sidebar">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
            </svg>
        </button>

        <!-- Mobile Sidebar Toggle Button -->
        <button onclick="toggleAdminSidebar()" class="lg:hidden w-10 h-10 rounded-xl bg-[#FAF7F2] border border-[#DEC7A2] flex items-center justify-center text-[#912003] hover:bg-[#FAF6EC] transition-all cursor-pointer">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>

        <div>
            <div class="flex items-center gap-2 text-[11px] font-sans text-[#A16207]">
                <span>Sanctum Core</span>
                <span>/</span>
                <span class="text-[#1C120C] font-semibold font-cinzel">{{ $title }}</span>
            </div>
            <h1 class="font-cinzel text-base sm:text-xl font-black text-[#1C120C] leading-none mt-1">
                {{ $title }}
            </h1>
        </div>
    </div>

    <!-- Right Controls -->
    <div class="flex items-center gap-3 sm:gap-4">
        <!-- Sacred Greeting Pill (hidden on very small screens) -->
        <div class="hidden xl:flex items-center gap-2 px-3 py-1.5 rounded-full bg-[#FAF7F2] border border-[#DEC7A2]/60 text-xs text-[#912003] font-cinzel font-bold">
            <span class="text-sm">🕉️</span>
            <span>॥ हर हर महादेव ॥</span>
        </div>

        <!-- Quick Devotee Registration Button -->
        <a href="{{ route('register') }}" target="_blank" class="shimmer-btn inline-flex items-center gap-1.5 px-3.5 sm:px-4 py-2 rounded-xl bg-gradient-to-r from-[#912003] to-[#B93815] hover:from-[#6C1802] hover:to-[#912003] text-[#FFFDF9] font-cinzel font-bold text-xs uppercase tracking-wider shadow-sm transition-all hover:scale-105">
            <span>➕</span> <span class="hidden sm:inline">Add Devotee</span>
        </a>

        <!-- Admin Profile Pill -->
        <a href="{{ route('admin.settings') }}" class="flex items-center gap-2.5 pl-2 sm:pl-3 border-l border-[#E5DCD0] hover:opacity-80 transition-opacity">
            <div class="hidden md:flex flex-col text-right">
                <span class="text-xs font-bold text-[#1C120C] font-cinzel leading-none">
                    {{ auth()->user()->nickname ?: auth()->user()->name }}
                </span>
                <span class="text-[10px] text-[#A16207] uppercase tracking-wider font-semibold mt-0.5">
                    Administrator
                </span>
            </div>
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-[#CA8A04] to-[#A16207] flex items-center justify-center text-[#1C120C] font-cinzel font-black text-sm shadow-xs">
                {{ strtoupper(substr(auth()->user()->nickname ?: auth()->user()->name, 0, 1)) }}
            </div>
        </a>
    </div>
</header>

