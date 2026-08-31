<x-admin.layout title="Dashboard Overview" subtitle="Sanctum Analytics & Quick Operations">
    
    <!-- Success Alert -->
    @if (session('success'))
        <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-sm font-medium flex items-center justify-between gap-3 shadow-2xs">
            <div class="flex items-center gap-2.5">
                <span class="text-base">✅</span>
                <span>{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-black font-bold">✕</button>
        </div>
    @endif

    <!-- ================= 1. WELCOME BANNER ================= -->
    <div class="bg-gradient-to-r from-white via-[#FAF7F2] to-white rounded-3xl p-6 sm:p-8 border border-[#E5DCD0] shadow-[0_2px_14px_rgba(44,29,20,0.03)] flex flex-col md:flex-row items-center justify-between gap-6 relative overflow-hidden">
        <div class="space-y-1 text-center md:text-left">
            <span class="inline-flex items-center gap-1.5 text-[11px] font-bold uppercase tracking-wider text-[#912003] bg-[#912003]/10 px-3 py-1 rounded-full font-cinzel">
                <span>ॐ</span> <span>Shri Mandir Trust Sanctum</span>
            </span>
            <h2 class="font-cinzel text-2xl sm:text-3xl font-black text-[#1C120C]">
                Welcome back, {{ auth()->user()->nickname ?: auth()->user()->name }}!
            </h2>
            <p class="font-marcellus text-xs sm:text-sm text-[#6C1802]">
                Here is the latest live overview of devotees enrolled and temple records for {{ date('l, d F Y') }}.
            </p>
        </div>

        <div class="flex items-center gap-3 shrink-0">
            <a href="{{ route('admin.devotees.index') }}" class="px-5 py-2.5 rounded-2xl bg-white hover:bg-[#FAF7F2] border border-[#DEC7A2] text-[#912003] font-cinzel font-bold text-xs shadow-2xs transition-all hover:scale-105">
                👥 View All Users
            </a>
            <a href="{{ route('register') }}" target="_blank" class="shimmer-btn px-5 py-2.5 rounded-2xl bg-[#912003] hover:bg-[#6C1802] text-[#FFFDF9] font-cinzel font-bold text-xs uppercase tracking-wider shadow-sm transition-all hover:scale-105">
                ➕ New Devotee
            </a>
        </div>
    </div>

    <!-- ================= YOGA-STYLE QUICK ACTIONS ================= -->
    <div>
        <div class="flex items-center justify-between mb-2.5">
            <h3 class="text-xs font-bold uppercase tracking-wider text-[#A16207] font-cinzel">Quick Management Portals</h3>
            <span class="text-[11px] text-[#6C1802] font-sans">Direct Module Shortcuts</span>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3.5">
            <!-- Devotees -->
            <a href="{{ route('admin.devotees.index') }}" class="bg-white rounded-2xl p-4 border border-[#E5DCD0] hover:border-[#CA8A04] hover:shadow-md transition-all group flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-orange-50 text-[#912003] flex items-center justify-center text-lg group-hover:scale-110 transition-transform shrink-0 border border-orange-100">
                    👥
                </div>
                <div class="overflow-hidden">
                    <span class="text-xs font-bold text-[#1C120C] font-cinzel block truncate">Devotees</span>
                    <span class="text-[10px] text-[#6C1802] truncate block">10-Field Records</span>
                </div>
            </a>

            <!-- Poojas -->
            <a href="{{ route('admin.poojas.index') }}" class="bg-white rounded-2xl p-4 border border-[#E5DCD0] hover:border-[#CA8A04] hover:shadow-md transition-all group flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center text-lg group-hover:scale-110 transition-transform shrink-0 border border-amber-100">
                    🪔
                </div>
                <div class="overflow-hidden">
                    <span class="text-xs font-bold text-[#1C120C] font-cinzel block truncate">Poojas & Sevas</span>
                    <span class="text-[10px] text-[#6C1802] truncate block">Offerings & Rituals</span>
                </div>
            </a>

            <!-- Daan -->
            <a href="{{ route('admin.donations.index') }}" class="bg-white rounded-2xl p-4 border border-[#E5DCD0] hover:border-[#CA8A04] hover:shadow-md transition-all group flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-lg group-hover:scale-110 transition-transform shrink-0 border border-emerald-100">
                    💰
                </div>
                <div class="overflow-hidden">
                    <span class="text-xs font-bold text-[#1C120C] font-cinzel block truncate">Donations</span>
                    <span class="text-[10px] text-[#6C1802] truncate block">Receipts & Daan</span>
                </div>
            </a>

            <!-- Settings -->
            <a href="{{ route('admin.settings') }}" class="bg-white rounded-2xl p-4 border border-[#E5DCD0] hover:border-[#CA8A04] hover:shadow-md transition-all group flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-stone-100 text-stone-700 flex items-center justify-center text-lg group-hover:scale-110 transition-transform shrink-0 border border-stone-200">
                    ⚙️
                </div>
                <div class="overflow-hidden">
                    <span class="text-xs font-bold text-[#1C120C] font-cinzel block truncate">Settings</span>
                    <span class="text-[10px] text-[#6C1802] truncate block">Password & Security</span>
                </div>
            </a>
        </div>
    </div>

    <!-- ================= 2. KPI METRICS OVERVIEW ================= -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        
        <!-- Total Registered Devotees -->
        <a href="{{ route('admin.devotees.index') }}" class="bg-white rounded-2xl p-5 border border-[#E5DCD0] shadow-[0_2px_12px_rgba(44,29,20,0.03)] hover:border-[#CA8A04] hover:shadow-md transition-all group block">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs font-bold uppercase tracking-wider text-[#A16207] font-cinzel">Total Devotees</span>
                <span class="w-8 h-8 rounded-xl bg-[#FAF6EC] border border-[#DEC7A2] flex items-center justify-center text-sm group-hover:scale-110 transition-transform">👥</span>
            </div>
            <div class="font-cinzel text-3xl font-black text-[#912003]">
                {{ $totalDevotees }}
            </div>
            <span class="text-[11px] text-[#6C1802] font-marcellus block mt-1 flex items-center justify-between">
                <span>Certified Members</span>
                <span class="text-[#912003] font-bold group-hover:translate-x-0.5 transition-transform">View →</span>
            </span>
        </a>

        <!-- Male Devotees -->
        <div class="bg-white rounded-2xl p-5 border border-[#E5DCD0] shadow-[0_2px_12px_rgba(44,29,20,0.03)] transition-all">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs font-bold uppercase tracking-wider text-[#A16207] font-cinzel">Male Bhakts</span>
                <span class="w-8 h-8 rounded-xl bg-[#FAF6EC] border border-[#DEC7A2] flex items-center justify-center text-sm">🕉️</span>
            </div>
            <div class="font-cinzel text-3xl font-black text-[#1C120C]">
                {{ $maleDevotees }}
            </div>
            <span class="text-[11px] text-[#6C1802] font-marcellus block mt-1">
                Purush ({{ $totalDevotees > 0 ? round(($maleDevotees / $totalDevotees) * 100) : 0 }}%)
            </span>
        </div>

        <!-- Female Devotees -->
        <div class="bg-white rounded-2xl p-5 border border-[#E5DCD0] shadow-[0_2px_12px_rgba(44,29,20,0.03)] transition-all">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs font-bold uppercase tracking-wider text-[#A16207] font-cinzel">Female Bhakts</span>
                <span class="w-8 h-8 rounded-xl bg-[#FAF6EC] border border-[#DEC7A2] flex items-center justify-center text-sm">🌸</span>
            </div>
            <div class="font-cinzel text-3xl font-black text-[#1C120C]">
                {{ $femaleDevotees }}
            </div>
            <span class="text-[11px] text-[#6C1802] font-marcellus block mt-1">
                Mahila ({{ $totalDevotees > 0 ? round(($femaleDevotees / $totalDevotees) * 100) : 0 }}%)
            </span>
        </div>

        <!-- New This Week -->
        <div class="bg-white rounded-2xl p-5 border border-[#E5DCD0] shadow-[0_2px_12px_rgba(44,29,20,0.03)] transition-all">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs font-bold uppercase tracking-wider text-[#A16207] font-cinzel">New This Week</span>
                <span class="w-8 h-8 rounded-xl bg-[#FAF6EC] border border-[#DEC7A2] flex items-center justify-center text-sm">🪔</span>
            </div>
            <div class="font-cinzel text-3xl font-black text-[#CA8A04]">
                +{{ $recentDevoteesCount }}
            </div>
            <span class="text-[11px] text-emerald-800 font-bold block mt-1">Active 7-day enrollments</span>
        </div>
    </div>

    <!-- ================= 3. TWO-COLUMN DASHBOARD ANALYTICS & RECENT STREAM ================= -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Left 2 Cols: Recent Registrations Stream -->
        <div class="lg:col-span-2 bg-white rounded-3xl p-6 border border-[#E5DCD0] shadow-[0_2px_16px_rgba(44,29,20,0.03)] space-y-4">
            <div class="flex items-center justify-between border-b border-[#E5DCD0] pb-4">
                <div>
                    <h3 class="font-cinzel text-base sm:text-lg font-black text-[#1C120C] flex items-center gap-2">
                        <span>📜</span> <span>Recent Devotee Enrollments (नवीन पंजीकरण)</span>
                    </h3>
                    <p class="text-xs text-[#6C1802] font-marcellus">Latest devotees registered in the sanctum</p>
                </div>
                
                <a href="{{ route('admin.devotees.index') }}" class="text-xs font-cinzel font-bold text-[#912003] hover:underline flex items-center gap-1">
                    <span>View All ({{ $totalDevotees }})</span> <span>→</span>
                </a>
            </div>

            <!-- Recent Stream Table -->
            <div class="overflow-x-auto admin-scroll">
                <table class="w-full text-left text-xs">
                    <thead class="bg-[#FAF7F2] text-[#422B1E] uppercase font-cinzel tracking-wider text-[10px] rounded-xl">
                        <tr>
                            <th class="py-2.5 px-3 rounded-l-xl">Devotee</th>
                            <th class="py-2.5 px-3">Public Nickname</th>
                            <th class="py-2.5 px-3">Mobile & Email</th>
                            <th class="py-2.5 px-3">Enrolled</th>
                            <th class="py-2.5 px-3 text-right rounded-r-xl">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#E5DCD0]/60">
                        @forelse ($recentDevotees as $devotee)
                            <tr class="hover:bg-[#FAF7F2]/60 transition-colors">
                                <td class="py-3 px-3">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-xl border border-[#DEC7A2] overflow-hidden shrink-0 bg-[#FAF7F2]">
                                            <img src="{{ $devotee->profile_photo_url }}" alt="{{ $devotee->nickname }}" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <span class="font-semibold text-[#1C120C] block">{{ $devotee->name }}</span>
                                            <span class="text-[10px] text-[#A16207]">Pincode: {{ $devotee->pincode }}</span>
                                        </div>
                                    </div>
                                </td>

                                <td class="py-3 px-3">
                                    <span class="font-cinzel font-bold text-[#912003] bg-[#912003]/10 px-2 py-0.5 rounded-md">
                                        {{ $devotee->nickname }}
                                    </span>
                                </td>

                                <td class="py-3 px-3 font-mono text-[11px]">
                                    <div>{{ $devotee->mobile_number }}</div>
                                    <div class="text-[10px] text-[#6C1802]">{{ $devotee->email }}</div>
                                </td>

                                <td class="py-3 px-3 text-[#6C1802] font-marcellus whitespace-nowrap">
                                    {{ $devotee->created_at->diffForHumans() }}
                                </td>

                                <td class="py-3 px-3 text-right whitespace-nowrap">
                                    <a href="{{ route('admin.devotee.edit', $devotee->id) }}" class="px-2.5 py-1 rounded-lg bg-[#FAF7F2] hover:bg-[#912003] text-[#6C1802] hover:text-white border border-[#E5DCD0] font-cinzel text-[11px] font-bold transition-all">
                                        ✏️ Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-[#6C1802] font-marcellus">
                                    No devotees enrolled yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pt-2 text-center">
                <a href="{{ route('admin.devotees.index') }}" class="inline-flex items-center gap-2 px-6 py-2 rounded-xl bg-[#FAF7F2] hover:bg-[#FAF6EC] border border-[#DEC7A2] text-xs font-cinzel font-bold text-[#912003] transition-all">
                    <span>👥 Open Full Registered Users Management Patrika</span>
                    <span>→</span>
                </a>
            </div>
        </div>

        <!-- Right 1 Col: Demographics & System Quick Status -->
        <div class="space-y-6">
            
            <!-- Gender Demographics Breakdown -->
            <div class="bg-white rounded-3xl p-6 border border-[#E5DCD0] shadow-[0_2px_16px_rgba(44,29,20,0.03)] space-y-4">
                <h4 class="font-cinzel text-sm font-black uppercase tracking-wider text-[#1C120C] flex items-center justify-between">
                    <span>Devotee Demographics</span>
                    <span class="text-base">📊</span>
                </h4>

                <div class="space-y-3 font-sans text-xs">
                    <!-- Male Bar -->
                    <div>
                        <div class="flex justify-between mb-1 text-[#2C1D14] font-medium">
                            <span>Male Devotees (पुरुष)</span>
                            <span class="font-bold">{{ $maleDevotees }}</span>
                        </div>
                        <div class="w-full h-2 bg-[#FAF7F2] rounded-full overflow-hidden border border-[#E5DCD0]">
                            <div class="h-full bg-blue-700 rounded-full" style="width: {{ $totalDevotees > 0 ? ($maleDevotees / $totalDevotees) * 100 : 0 }}%"></div>
                        </div>
                    </div>

                    <!-- Female Bar -->
                    <div>
                        <div class="flex justify-between mb-1 text-[#2C1D14] font-medium">
                            <span>Female Devotees (महिला)</span>
                            <span class="font-bold">{{ $femaleDevotees }}</span>
                        </div>
                        <div class="w-full h-2 bg-[#FAF7F2] rounded-full overflow-hidden border border-[#E5DCD0]">
                            <div class="h-full bg-rose-600 rounded-full" style="width: {{ $totalDevotees > 0 ? ($femaleDevotees / $totalDevotees) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>

                <div class="pt-2 border-t border-[#E5DCD0] flex justify-between text-[11px] text-[#6C1802] font-marcellus">
                    <span>Active Account Rate:</span>
                    <strong class="text-emerald-800 font-bold">100% Verified</strong>
                </div>
            </div>

            <!-- Quick Access Portals -->
            <div class="bg-white rounded-3xl p-6 border border-[#E5DCD0] shadow-[0_2px_16px_rgba(44,29,20,0.03)] space-y-3">
                <h4 class="font-cinzel text-xs font-bold uppercase tracking-wider text-[#A16207]">Quick Operations</h4>
                
                <a href="{{ route('admin.devotees.index') }}" class="flex items-center justify-between p-3 rounded-xl bg-[#FAF7F2] hover:bg-[#FAF6EC] border border-[#E5DCD0] text-xs font-cinzel font-bold text-[#1C120C] transition-all">
                    <span class="flex items-center gap-2">
                        <span>👥</span> <span>All Registered Devotees</span>
                    </span>
                    <span>→</span>
                </a>

                <a href="{{ route('register') }}" target="_blank" class="flex items-center justify-between p-3 rounded-xl bg-[#FAF7F2] hover:bg-[#FAF6EC] border border-[#E5DCD0] text-xs font-cinzel font-bold text-[#912003] transition-all">
                    <span class="flex items-center gap-2">
                        <span>➕</span> <span>Register New Devotee</span>
                    </span>
                    <span>↗</span>
                </a>
            </div>

        </div>

    </div>

</x-admin.layout>
