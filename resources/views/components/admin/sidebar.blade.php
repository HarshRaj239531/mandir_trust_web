<!-- Yoga-Inspired Deep Royal Obsidian Admin Sidebar -->
<aside id="admin-sidebar" 
    class="fixed inset-y-0 left-0 z-50 bg-[#160F0A] border-r border-[#2C1D14] flex flex-col justify-between -translate-x-full lg:translate-x-0 shadow-[8px_0_32px_rgba(0,0,0,0.35)] select-none">
    
    <!-- Top Branding & Navigation Items -->
    <div class="flex flex-col h-full overflow-hidden">
        <!-- Brand Header -->
        <div class="h-20 px-5 border-b border-white/10 flex items-center justify-between bg-[#110B07] shrink-0">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group overflow-hidden">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-[#B93815] to-[#6C1802] border border-[#CA8A04]/40 flex items-center justify-center text-[#FFFDF9] font-cinzel font-black text-xl shadow-lg shadow-[#912003]/30 shrink-0 group-hover:scale-105 transition-transform">
                    ॐ
                </div>
                <div class="overflow-hidden transition-all duration-300 sidebar-text">
                    <span class="font-cinzel text-sm font-black tracking-widest text-[#FFFDF9] block leading-none whitespace-nowrap">
                        Shringi Rishi Mandir
                    </span>
                    <span class="text-[10px] tracking-widest text-[#DEC7A2] font-bold uppercase mt-1 block font-sans whitespace-nowrap">
                        Admin Sanctum
                    </span>
                </div>
            </a>

            <!-- Mobile Close Button -->
            <button onclick="toggleAdminSidebar()" class="lg:hidden w-8 h-8 rounded-xl bg-white/10 hover:bg-white/20 text-[#FFFDF9] flex items-center justify-center text-sm border border-white/10 transition-colors">
                ✕
            </button>
        </div>

        <!-- Navigation Scrollable Area -->
        <div class="flex-1 overflow-y-auto admin-scroll p-3.5 space-y-5">
            <!-- Section 1: Core Operations -->
            <div>
                <span class="px-3 text-[10px] font-bold uppercase tracking-wider text-[#CA8A04] font-cinzel block mb-2 transition-all duration-200 sidebar-text whitespace-nowrap">
                    Core Modules
                </span>
                
                <nav class="space-y-1.5 font-sans text-xs font-semibold">
                    <!-- 1. Dashboard -->
                    <a href="{{ route('admin.dashboard') }}" 
                       title="Dashboard"
                       class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-[#912003] to-[#B93815] text-[#FFFDF9] shadow-lg shadow-[#912003]/25 font-bold border border-[#DEC7A2]/30' : 'text-[#E5DCD0] hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 text-[#DEC7A2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        <span class="truncate sidebar-text">Dashboard Overview</span>
                    </a>

                    <!-- 2. Devotees / Users -->
                    <a href="{{ route('admin.devotees.index') }}" 
                       title="Devotee Records"
                       class="flex items-center justify-between px-3.5 py-3 rounded-xl transition-all {{ request()->routeIs('admin.devotees.*') || request()->routeIs('admin.devotee.*') ? 'bg-gradient-to-r from-[#912003] to-[#B93815] text-[#FFFDF9] shadow-lg shadow-[#912003]/25 font-bold border border-[#DEC7A2]/30' : 'text-[#E5DCD0] hover:bg-white/5 hover:text-white' }}">
                        <div class="flex items-center gap-3 overflow-hidden">
                            <svg class="w-5 h-5 shrink-0 text-[#DEC7A2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span class="truncate sidebar-text">Devotees (भक्तगण)</span>
                        </div>
                        <span class="text-[10px] bg-white/10 px-2 py-0.5 rounded-full font-mono text-[#DEC7A2] sidebar-expanded-only">Records</span>
                    </a>

                    <!-- 3. Poojas & Sevas -->
                    <a href="{{ route('admin.poojas.index') }}" 
                       title="Pooja Bookings"
                       class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition-all {{ request()->routeIs('admin.poojas.*') ? 'bg-gradient-to-r from-[#912003] to-[#B93815] text-[#FFFDF9] shadow-lg shadow-[#912003]/25 font-bold border border-[#DEC7A2]/30' : 'text-[#E5DCD0] hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 text-[#DEC7A2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                        <span class="truncate sidebar-text">Pooja & Sevas</span>
                    </a>

                    <!-- 4. Daan & Donations -->
                    <a href="{{ route('admin.donations.index') }}" 
                       title="Donations & Daan"
                       class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition-all {{ request()->routeIs('admin.donations.*') ? 'bg-gradient-to-r from-[#912003] to-[#B93815] text-[#FFFDF9] shadow-lg shadow-[#912003]/25 font-bold border border-[#DEC7A2]/30' : 'text-[#E5DCD0] hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 text-[#DEC7A2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="truncate sidebar-text">Daan & Donations</span>
                    </a>
                </nav>
            </div>

            <!-- Section 2: Temple Sanctum Management -->
            <div>
                <span class="px-3 text-[10px] font-bold uppercase tracking-wider text-[#CA8A04] font-cinzel block mb-2 transition-all duration-200 sidebar-text whitespace-nowrap">
                    Temple Administration
                </span>
                
                <nav class="space-y-1.5 font-sans text-xs font-semibold">
                    <!-- 5. Events & Utsavs -->
                    <a href="{{ route('admin.events.index') }}" 
                       title="Events & Festivals"
                       class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition-all {{ request()->routeIs('admin.events.*') ? 'bg-gradient-to-r from-[#912003] to-[#B93815] text-[#FFFDF9] shadow-lg shadow-[#912003]/25 font-bold border border-[#DEC7A2]/30' : 'text-[#E5DCD0] hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 text-[#DEC7A2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="truncate sidebar-text">Events & Utsavs</span>
                    </a>

                    <!-- 6. Facilities & Dharamshala -->
                    <a href="{{ route('admin.facilities.index') }}" 
                       title="Temple Facilities"
                       class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition-all {{ request()->routeIs('admin.facilities.*') ? 'bg-gradient-to-r from-[#912003] to-[#B93815] text-[#FFFDF9] shadow-lg shadow-[#912003]/25 font-bold border border-[#DEC7A2]/30' : 'text-[#E5DCD0] hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 text-[#DEC7A2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <span class="truncate sidebar-text">Facilities & Stays</span>
                    </a>

                    <!-- 7. Media Gallery -->
                    <a href="{{ route('admin.gallery.index') }}" 
                       title="Media Gallery"
                       class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition-all {{ request()->routeIs('admin.gallery.*') ? 'bg-gradient-to-r from-[#912003] to-[#B93815] text-[#FFFDF9] shadow-lg shadow-[#912003]/25 font-bold border border-[#DEC7A2]/30' : 'text-[#E5DCD0] hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 text-[#DEC7A2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="truncate sidebar-text">Gallery & Media</span>
                    </a>

                    <!-- 8. Account & Media Settings (Yoga-Style) -->
                    <a href="{{ route('admin.settings') }}" 
                       title="Account, Security & Home Media Settings"
                       class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition-all {{ request()->routeIs('admin.settings*') ? 'bg-gradient-to-r from-[#912003] to-[#B93815] text-[#FFFDF9] shadow-lg shadow-[#912003]/25 font-bold border border-[#DEC7A2]/30' : 'text-[#E5DCD0] hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 text-[#DEC7A2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="truncate sidebar-text">Settings & Media</span>
                    </a>
                </nav>
            </div>

            <!-- Public Portal Link -->
            <div class="pt-3 border-t border-white/10">
                <a href="{{ route('home') }}" target="_blank" 
                   title="Visit Public Website"
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold text-[#DEC7A2] hover:bg-white/5 hover:text-white transition-all">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-[#CA8A04]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        <span class="truncate sidebar-text">Public Temple Site</span>
                    </div>
                    <span class="text-xs sidebar-expanded-only">↗</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Sidebar Bottom: Admin Profile Card & Logout -->
    <div class="p-3 border-t border-white/10 bg-[#110B07] shrink-0">
        <div class="flex items-center justify-between gap-2 p-2 rounded-2xl bg-white/5 border border-white/5">
            <div class="flex items-center gap-2.5 overflow-hidden">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-[#CA8A04] to-[#A16207] flex items-center justify-center text-[#1C120C] font-cinzel font-black text-sm shrink-0 shadow-md">
                    {{ strtoupper(substr(auth()->user()->nickname ?: auth()->user()->name, 0, 1)) }}
                </div>
                <div class="overflow-hidden sidebar-text">
                    <span class="text-xs font-bold text-[#FFFDF9] block truncate font-cinzel whitespace-nowrap">
                        {{ auth()->user()->nickname ?: auth()->user()->name }}
                    </span>
                    <span class="text-[10px] text-[#CA8A04] block truncate font-medium whitespace-nowrap">
                        Head Administrator
                    </span>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST" class="sidebar-expanded-only">
                @csrf
                <button type="submit" title="Logout" class="w-8 h-8 rounded-xl bg-white/10 hover:bg-[#912003] text-[#DEC7A2] hover:text-white flex items-center justify-center transition-all cursor-pointer border border-white/10">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </button>
            </form>
        </div>
    </div>
</aside>

<!-- Sidebar Backdrop for Mobile Screens -->
<div id="sidebar-backdrop" onclick="toggleAdminSidebar()" class="fixed inset-0 bg-black/60 z-40 hidden lg:hidden backdrop-blur-xs transition-opacity"></div>

