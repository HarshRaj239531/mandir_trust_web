<!-- Light & Royal Modern Admin Sidebar -->
<aside id="admin-sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-[#FFFDF9] border-r border-[#E5DCD0] flex flex-col justify-between transition-transform duration-300 -translate-x-full lg:translate-x-0 shadow-[4px_0_24px_rgba(44,29,20,0.04)]">
    
    <div>
        <!-- Brand Header -->
        <div class="h-16 px-6 border-b border-[#E5DCD0] flex items-center justify-between bg-[#FAF7F2]">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-xl bg-[#FAF6EC] border border-[#CA8A04] flex items-center justify-center text-[#912003] font-cinzel font-black text-lg shadow-xs group-hover:scale-105 transition-transform">
                    ॐ
                </div>
                <div>
                    <span class="font-cinzel text-sm font-black tracking-wider text-[#1C120C] block leading-none">
                        SHRI MANDIR
                    </span>
                    <span class="text-[10px] tracking-wider text-[#912003] font-bold uppercase mt-1 block">
                        Admin Portal
                    </span>
                </div>
            </a>

            <!-- Mobile Close Button -->
            <button onclick="toggleAdminSidebar()" class="lg:hidden w-8 h-8 rounded-lg bg-[#FAF6EC] text-[#6C1802] hover:text-black flex items-center justify-center text-sm border border-[#DEC7A2]">
                ✕
            </button>
        </div>

        <!-- Navigation Section -->
        <div class="p-4 space-y-6">
            <div>
                <span class="px-3 text-[10px] font-bold uppercase tracking-wider text-[#A16207] font-cinzel block mb-2">
                    Main Navigation
                </span>
                
                <nav class="space-y-1.5 font-cinzel text-xs font-bold">
                    <!-- 1. Dashboard -->
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-[#912003] text-[#FFFDF9] shadow-sm' : 'text-[#422B1E] hover:bg-[#FAF7F2] hover:text-[#912003]' }}">
                        <div class="flex items-center gap-3">
                            <span class="text-base">📊</span>
                            <span>Dashboard</span>
                        </div>
                    </a>

                    <!-- 2. Registered Users -->
                    <a href="{{ route('admin.devotees.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.devotees.*') || request()->routeIs('admin.devotee.*') ? 'bg-[#912003] text-[#FFFDF9] shadow-sm' : 'text-[#422B1E] hover:bg-[#FAF7F2] hover:text-[#912003]' }}">
                        <div class="flex items-center gap-3">
                            <span class="text-base">👥</span>
                            <span>Registered Users</span>
                        </div>
                        @if (!request()->routeIs('admin.devotees.*') && !request()->routeIs('admin.devotee.*'))
                            <span class="text-[10px] bg-[#912003]/10 text-[#912003] px-2 py-0.5 rounded-full font-mono">List</span>
                        @endif
                    </a>
                </nav>
            </div>

            <!-- Public Site Link -->
            <div class="pt-3 border-t border-[#E5DCD0]">
                <a href="{{ route('home') }}" target="_blank" class="flex items-center justify-between px-3.5 py-2 rounded-xl text-xs font-semibold text-[#6C1802] hover:bg-[#FAF7F2] hover:text-[#912003] transition-all">
                    <div class="flex items-center gap-2.5">
                        <span>🌐</span>
                        <span>View Public Website</span>
                    </div>
                    <span class="text-[10px]">↗</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Sidebar Bottom: Admin Profile Card & Logout -->
    <div class="p-4 border-t border-[#E5DCD0] bg-[#FAF7F2]">
        <div class="flex items-center justify-between gap-2 p-2 rounded-2xl bg-white border border-[#E5DCD0] shadow-2xs">
            <div class="flex items-center gap-2.5 overflow-hidden">
                <div class="w-9 h-9 rounded-xl bg-[#FAF6EC] border border-[#CA8A04] flex items-center justify-center text-[#912003] font-cinzel font-bold text-sm shrink-0">
                    {{ strtoupper(substr(auth()->user()->nickname ?: auth()->user()->name, 0, 1)) }}
                </div>
                <div class="overflow-hidden">
                    <span class="text-xs font-bold text-[#1C120C] block truncate font-cinzel">
                        {{ auth()->user()->nickname ?: auth()->user()->name }}
                    </span>
                    <span class="text-[10px] text-[#A16207] block truncate">
                        Administrator
                    </span>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" title="Logout" class="w-8 h-8 rounded-xl bg-[#FAF6EC] hover:bg-[#912003] text-[#6C1802] hover:text-white flex items-center justify-center transition-all cursor-pointer border border-[#DEC7A2]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </button>
            </form>
        </div>
    </div>
</aside>

<!-- Sidebar Backdrop for Mobile Screens -->
<div id="sidebar-backdrop" onclick="toggleAdminSidebar()" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden backdrop-blur-xs transition-opacity"></div>
