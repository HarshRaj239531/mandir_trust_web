<x-admin.layout title="Registered Users (पंजीकृत भक्त)" subtitle="Full Devotee Records & Management">
    
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

    <!-- Error Alert -->
    @if (session('error'))
        <div class="p-4 rounded-2xl bg-red-50 border border-red-200 text-red-900 text-sm font-medium flex items-center justify-between gap-3 shadow-2xs">
            <div class="flex items-center gap-2.5">
                <span class="text-base">⚠️</span>
                <span>{{ session('error') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-black font-bold">✕</button>
        </div>
    @endif

    <!-- ================= 1. SEARCH & FILTER BAR ================= -->
    <div class="bg-white rounded-2xl p-4 sm:p-5 border border-[#E5DCD0] shadow-2xs">
        <form action="{{ route('admin.devotees.index') }}" method="GET" class="flex flex-col md:flex-row gap-3 items-stretch md:items-end">
            
            <div class="flex-grow">
                <label for="search" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1 font-cinzel">
                    Search Devotees (खोजें)
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-sm text-[#A16207]">🔍</span>
                    <input type="text" id="search" name="search" value="{{ request('search') }}"
                        placeholder="Search by Real Name, Nickname, Email, Mobile, Mother, Pincode..."
                        class="w-full bg-[#FAF7F2] border border-[#E5DCD0] rounded-xl pl-10 pr-4 py-2 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003] transition-all">
                </div>
            </div>

            <div class="w-full md:w-44">
                <label for="gender" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1 font-cinzel">Gender</label>
                <select id="gender" name="gender" class="w-full bg-[#FAF7F2] border border-[#E5DCD0] rounded-xl px-3 py-2 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003]">
                    <option value="">All Genders</option>
                    <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male (पुरुष)</option>
                    <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female (महिला)</option>
                    <option value="other" {{ request('gender') == 'other' ? 'selected' : '' }}>Other (अन्य)</option>
                </select>
            </div>

            <div class="w-full md:w-36">
                <label for="status" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1 font-cinzel">Status</label>
                <select id="status" name="status" class="w-full bg-[#FAF7F2] border border-[#E5DCD0] rounded-xl px-3 py-2 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003]">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div class="flex items-center gap-2 shrink-0">
                <button type="submit" class="px-5 py-2 rounded-xl bg-[#912003] hover:bg-[#6C1802] text-[#FFFDF9] font-cinzel text-xs font-bold uppercase tracking-wider transition-all shadow-2xs cursor-pointer">
                    Filter
                </button>
                <a href="{{ route('admin.devotees.index') }}" class="px-4 py-2 rounded-xl bg-[#FAF7F2] hover:bg-[#E5DCD0] border border-[#E5DCD0] text-[#6C1802] font-cinzel text-xs font-bold transition-all">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- ================= 2. DEVOTEES DATA ROSTER TABLE ================= -->
    <div class="bg-white rounded-2xl border border-[#E5DCD0] shadow-[0_2px_16px_rgba(44,29,20,0.04)] overflow-hidden">
        
        <!-- Table Header Banner -->
        <div class="p-5 border-b border-[#E5DCD0] flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-[#FAF7F2]/60">
            <div>
                <h3 class="font-cinzel text-base sm:text-lg font-black text-[#1C120C] flex items-center gap-2">
                    <span>📜</span> <span>Devotee Records (पंजीकृत भक्त विवरण)</span>
                </h3>
                <p class="text-xs text-[#6C1802] font-marcellus mt-0.5">
                    Showing all 10 registration fields. Click "Edit" to modify locked fields.
                </p>
            </div>
            
            <div class="flex items-center gap-2">
                <span class="text-xs font-mono font-bold bg-white px-3 py-1 rounded-full border border-[#E5DCD0] text-[#912003]">
                    Total: {{ $devotees->total() }}
                </span>
            </div>
        </div>

        <!-- Clean Responsive Table Wrapper -->
        <div class="overflow-x-auto admin-scroll">
            <table class="w-full text-left text-xs text-[#2C1D14]">
                <thead class="bg-[#FAF7F2] text-[#422B1E] uppercase font-cinzel tracking-wider border-b border-[#E5DCD0] text-[11px]">
                    <tr>
                        <th class="py-3.5 px-4">Selfie</th>
                        <th class="py-3.5 px-4">Member ID</th>
                        <th class="py-3.5 px-4">Sponsor</th>
                        <th class="py-3.5 px-4">1. Full Name (Legal)</th>
                        <th class="py-3.5 px-4">2. Nick Name (Public)</th>
                        <th class="py-3.5 px-4">3. Mother's Name</th>
                        <th class="py-3.5 px-4">4. Gender</th>
                        <th class="py-3.5 px-4">5. D.O.B</th>
                        <th class="py-3.5 px-4">6. Gmail</th>
                        <th class="py-3.5 px-4">7. Mobile / 8. WhatsApp</th>
                        <th class="py-3.5 px-4">9. Pincode</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E5DCD0]/60 font-sans">
                    @forelse ($devotees as $devotee)
                        <tr class="hover:bg-[#FAF7F2]/60 transition-colors">
                            <!-- 10. Photo / Selfie -->
                            <td class="py-3 px-4">
                                <div class="w-10 h-10 rounded-xl border border-[#DEC7A2] overflow-hidden shadow-2xs shrink-0 cursor-pointer bg-[#FAF7F2] hover:scale-105 transition-transform" onclick="viewPhotoModal('{{ $devotee->profile_photo_url }}', '{{ $devotee->nickname }}', '{{ $devotee->name }}')">
                                    <img src="{{ $devotee->profile_photo_url }}" alt="{{ $devotee->nickname }}" class="w-full h-full object-cover">
                                </div>
                            </td>

                            <!-- Member ID -->
                            <td class="py-3 px-4 font-mono font-bold text-[#912003] whitespace-nowrap">
                                <div class="flex items-center gap-1.5">
                                    <span>{{ $devotee->member_id ?? 'N/A' }}</span>
                                    @if ($devotee->member_id)
                                        <button type="button" onclick="navigator.clipboard.writeText('{{ $devotee->member_id }}'); alert('Member ID copied: {{ $devotee->member_id }}');" class="text-xs text-[#A16207] hover:text-black cursor-pointer" title="Copy ID">📋</button>
                                    @endif
                                </div>
                            </td>

                            <!-- Sponsor -->
                            <td class="py-3 px-4 whitespace-nowrap">
                                @if ($devotee->sponsor)
                                    <span class="font-semibold text-[#1C120C] block">{{ $devotee->sponsor->name }}</span>
                                    <span class="font-mono text-[10px] text-[#A16207] block">{{ $devotee->sponsor->member_id }}</span>
                                @else
                                    <span class="text-[10px] text-gray-500 italic">Root / Master</span>
                                @endif
                            </td>

                            <!-- 1. Real / Legal Name -->
                            <td class="py-3 px-4 font-semibold text-[#1C120C] whitespace-nowrap">
                                <div class="flex items-center gap-1.5">
                                    <span>{{ $devotee->name }}</span>
                                    @if ($devotee->is_admin)
                                        <span class="text-[9px] bg-[#CA8A04] text-black px-1.5 py-0.2 rounded font-bold">Admin</span>
                                    @endif
                                </div>
                                <span class="text-[10px] text-[#A16207] font-mono block mt-0.5">🔒 Private</span>
                            </td>

                            <!-- 2. Nick Name (Public Screen Name) -->
                            <td class="py-3 px-4 whitespace-nowrap">
                                <span class="font-cinzel font-bold text-[#912003] bg-[#912003]/10 px-2 py-0.5 rounded-lg border border-[#912003]/20">
                                    {{ $devotee->nickname }}
                                </span>
                            </td>

                            <!-- 3. Mother's Name -->
                            <td class="py-3 px-4 text-[#422B1E] whitespace-nowrap">
                                {{ $devotee->mother_name }}
                            </td>

                            <!-- 4. Gender -->
                            <td class="py-3 px-4 capitalize whitespace-nowrap">
                                @if ($devotee->gender === 'male')
                                    <span class="text-blue-800">Male</span>
                                @elseif ($devotee->gender === 'female')
                                    <span class="text-rose-800">Female</span>
                                @else
                                    <span class="text-amber-800">Other</span>
                                @endif
                            </td>

                            <!-- 5. D.O.B -->
                            <td class="py-3 px-4 whitespace-nowrap font-mono">
                                {{ $devotee->dob ? $devotee->dob->format('d/m/Y') : 'N/A' }}
                            </td>

                            <!-- 6. Gmail -->
                            <td class="py-3 px-4 font-mono text-[11px] whitespace-nowrap">
                                <a href="mailto:{{ $devotee->email }}" class="text-[#6C1802] hover:underline">
                                    {{ $devotee->email }}
                                </a>
                            </td>

                            <!-- 7 & 8. Mobile & WhatsApp -->
                            <td class="py-3 px-4 whitespace-nowrap">
                                <div class="font-mono">📞 {{ $devotee->mobile_number }}</div>
                                @if ($devotee->whatsapp_number)
                                    <div class="text-[10px] text-emerald-800 font-mono">💬 {{ $devotee->whatsapp_number }}</div>
                                @endif
                            </td>

                            <!-- 9. Pincode -->
                            <td class="py-3 px-4 font-mono font-semibold">
                                {{ $devotee->pincode }}
                            </td>

                            <!-- Status -->
                            <td class="py-3 px-4 whitespace-nowrap">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $devotee->status === 'active' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">
                                    ● {{ $devotee->status }}
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="py-3 px-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1.5">
                                    
                                    <!-- Edit Button (Full Admin Privilege) -->
                                    <a href="{{ route('admin.devotee.edit', $devotee->id) }}" class="px-2.5 py-1 rounded-lg bg-[#912003] hover:bg-[#6C1802] text-[#FFFDF9] font-cinzel text-[11px] font-bold shadow-2xs transition-all flex items-center gap-1 hover:scale-105" title="Edit Records">
                                        <span>✏️</span> <span>Edit</span>
                                    </a>

                                    <!-- Status Toggle -->
                                    <form action="{{ route('admin.devotee.toggle-status', $devotee->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-2 py-1 rounded-lg bg-[#FAF7F2] hover:bg-[#E5DCD0] border border-[#E5DCD0] text-[#6C1802] text-[11px] font-semibold transition-colors" title="Toggle Status">
                                            {{ $devotee->status === 'active' ? 'Disable' : 'Enable' }}
                                        </button>
                                    </form>

                                    @if (!$devotee->is_admin)
                                        <!-- Delete Button -->
                                        <form action="{{ route('admin.devotee.delete', $devotee->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to remove devotee {{ $devotee->nickname }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-7 h-7 rounded-lg bg-red-50 hover:bg-red-100 text-red-800 text-xs font-bold flex items-center justify-center transition-colors" title="Delete">
                                                🗑️
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="py-10 text-center text-[#6C1802] font-marcellus">
                                No registered devotees found matching your search.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Footer -->
        @if ($devotees->hasPages())
            <div class="p-4 bg-[#FAF7F2] border-t border-[#E5DCD0]">
                {{ $devotees->links() }}
            </div>
        @endif
    </div>

</x-admin.layout>
