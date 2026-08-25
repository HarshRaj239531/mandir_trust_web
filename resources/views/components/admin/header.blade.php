@props(['title' => 'Dashboard', 'subtitle' => 'Overview & Devotee Management'])

<!-- Light Clean Admin Header Bar -->
<header class="bg-white border-b border-[#E5DCD0] sticky top-0 z-30 px-4 sm:px-8 h-16 flex items-center justify-between shadow-2xs">
    <div class="flex items-center gap-3.5">
        <!-- Mobile Sidebar Toggle Button -->
        <button onclick="toggleAdminSidebar()" class="lg:hidden w-10 h-10 rounded-xl bg-[#FAF7F2] border border-[#E5DCD0] flex items-center justify-center text-[#912003] hover:bg-[#E5DCD0]/40 transition-all cursor-pointer">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>

        <div>
            <div class="flex items-center gap-2 text-[11px] font-marcellus text-[#A16207]">
                <span>Admin Sanctum</span>
                <span>/</span>
                <span class="text-[#1C120C] font-semibold">{{ $title }}</span>
            </div>
            <h1 class="font-cinzel text-base sm:text-lg font-black text-[#1C120C] leading-none mt-0.5">
                {{ $title }}
            </h1>
        </div>
    </div>

    <!-- Right Controls -->
    <div class="flex items-center gap-2.5 sm:gap-3">
        <a href="{{ route('register') }}" target="_blank" class="shimmer-btn inline-flex items-center gap-1.5 px-3.5 sm:px-4 py-2 rounded-xl bg-[#912003] hover:bg-[#6C1802] text-[#FFFDF9] font-cinzel font-bold text-xs uppercase tracking-wider shadow-xs transition-all hover:scale-105">
            <span>➕</span> <span class="hidden sm:inline">Register Devotee</span>
        </a>

        <button onclick="window.print()" title="Print" class="w-9 h-9 rounded-xl bg-[#FAF7F2] hover:bg-[#E5DCD0] border border-[#E5DCD0] flex items-center justify-center text-[#6C1802] transition-all cursor-pointer shadow-2xs text-xs font-bold">
            🖨️
        </button>
    </div>
</header>
