<x-admin.layout title="Poojas & Sacred Sevas" subtitle="Daily Offerings, Rituals & Devotee Booking Roster (MySQL Dynamic)">
    
    <!-- Top Stats Banner -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        <div class="bg-white rounded-2xl p-5 border border-[#E5DCD0] shadow-2xs">
            <span class="text-xs font-bold uppercase tracking-wider text-[#A16207] font-cinzel block mb-1">Active Sevas</span>
            <div class="font-cinzel text-3xl font-black text-[#912003]">{{ $activePoojasCount }} Sevas</div>
            <span class="text-[11px] text-[#6C1802] font-sans">MySQL Catalog Live</span>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-[#E5DCD0] shadow-2xs">
            <span class="text-xs font-bold uppercase tracking-wider text-[#A16207] font-cinzel block mb-1">Total Bookings</span>
            <div class="font-cinzel text-3xl font-black text-[#1C120C]">{{ $totalBookings }}</div>
            <span class="text-[11px] text-emerald-700 font-sans font-bold">From Devotees</span>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-[#E5DCD0] shadow-2xs">
            <span class="text-xs font-bold uppercase tracking-wider text-[#A16207] font-cinzel block mb-1">Head Priest</span>
            <div class="font-cinzel text-lg font-bold text-[#1C120C] mt-2">Pt. Vidyadhar Shastri</div>
            <span class="text-[11px] text-[#6C1802] font-sans">Sanctum Acharya</span>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-[#E5DCD0] shadow-2xs">
            <span class="text-xs font-bold uppercase tracking-wider text-[#A16207] font-cinzel block mb-1">Database Sync</span>
            <div class="font-cinzel text-lg font-bold text-emerald-800 mt-2">✓ 100% Dynamic</div>
            <span class="text-[11px] text-emerald-800 font-sans font-bold">Stored in MySQL DB</span>
        </div>
    </div>

    <!-- Poojas Catalog & Management Table (Yoga-Style) -->
    <div class="bg-white rounded-3xl border border-[#E5DCD0] shadow-[0_2px_16px_rgba(44,29,20,0.03)] overflow-hidden">
        <div class="p-5 sm:p-6 border-b border-[#E5DCD0] flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-[#FAF7F2]/60">
            <div>
                <h3 class="font-cinzel text-lg font-black text-[#1C120C] flex items-center gap-2">
                    <span>🪔</span> <span>Sanctum Pooja Offerings Directory</span>
                </h3>
                <p class="text-xs text-[#6C1802] font-sans mt-0.5">
                    Devotees can request these sacred rituals with customized sankalpa directly on the website.
                </p>
            </div>
            
            <div class="flex items-center gap-3">
                <button onclick="document.getElementById('add-pooja-modal').classList.remove('hidden')" class="px-4 py-2 rounded-xl bg-gradient-to-r from-[#912003] to-[#B93815] hover:from-[#6C1802] text-white text-xs font-cinzel font-bold shadow-md cursor-pointer transition-all">
                    ➕ Add New Pooja
                </button>
                <a href="{{ route('poojas') }}" target="_blank" class="px-4 py-2 rounded-xl bg-[#FAF7F2] hover:bg-[#E5DCD0] border border-[#DEC7A2] text-xs font-cinzel font-bold text-[#912003] transition-all">
                    🌐 View Public Page ↗
                </a>
            </div>
        </div>

        <div class="overflow-x-auto admin-scroll">
            <table class="w-full text-left text-xs">
                <thead class="bg-[#FAF7F2] text-[#422B1E] uppercase font-cinzel tracking-wider border-b border-[#E5DCD0] text-[11px]">
                    <tr>
                        <th class="py-3.5 px-4">Pooja / Seva Name</th>
                        <th class="py-3.5 px-4">Presiding Deity</th>
                        <th class="py-3.5 px-4">Duration & Timing</th>
                        <th class="py-3.5 px-4">Assigned Priest</th>
                        <th class="py-3.5 px-4">Dakshina</th>
                        <th class="py-3.5 px-4">Bookings</th>
                        <th class="py-3.5 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E5DCD0]/60 font-sans">
                    @forelse ($poojas as $p)
                        <tr class="hover:bg-[#FAF7F2]/60 transition-colors">
                            <td class="py-3.5 px-4">
                                <span class="font-cinzel font-bold text-sm text-[#1C120C] block">{{ $p->title }}</span>
                                <span class="text-[10px] text-[#A16207]">{{ $p->category }}</span>
                            </td>
                            <td class="py-3.5 px-4 font-semibold text-[#912003] font-cinzel whitespace-nowrap">
                                {{ $p->deity }}
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <div class="font-medium text-[#1C120C]">{{ $p->timing }}</div>
                                <div class="text-[10px] text-[#6C1802] font-mono">⏱ {{ $p->duration }}</div>
                            </td>
                            <td class="py-3.5 px-4 text-[#1C120C] whitespace-nowrap">
                                {{ $p->priest }}
                            </td>
                            <td class="py-3.5 px-4 font-mono font-bold text-emerald-800 text-sm whitespace-nowrap">
                                ₹ {{ number_format($p->dakshina, 0) }}
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <span class="px-2.5 py-1 rounded-full bg-[#FAF7F2] border border-[#DEC7A2] font-mono text-xs font-bold text-[#912003]">
                                    {{ $p->bookings_count }} Bhakts
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                <form action="{{ route('admin.poojas.delete', $p->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this Pooja from database?');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2.5 py-1 text-xs rounded-lg bg-red-50 text-red-700 hover:bg-red-100 font-semibold cursor-pointer">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-6 text-center text-gray-500">No poojas found in database. Click "Add New Pooja" to create one.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Devotee Pooja Bookings Live from MySQL -->
    <div class="bg-white rounded-3xl border border-[#E5DCD0] shadow-[0_2px_16px_rgba(44,29,20,0.03)] overflow-hidden">
        <div class="p-5 border-b border-[#E5DCD0] bg-[#FAF7F2]/60">
            <h3 class="font-cinzel text-base font-bold text-[#1C120C]">📋 Recent Devotee Sankalpa Bookings (Live From Database)</h3>
        </div>
        <div class="overflow-x-auto admin-scroll">
            <table class="w-full text-left text-xs">
                <thead class="bg-[#FAF7F2] text-[#422B1E] uppercase font-cinzel tracking-wider border-b border-[#E5DCD0] text-[10px]">
                    <tr>
                        <th class="py-3 px-4">Booking ID</th>
                        <th class="py-3 px-4">Devotee Name</th>
                        <th class="py-3 px-4">Pooja Requested</th>
                        <th class="py-3 px-4">Gotra & Nakshatra</th>
                        <th class="py-3 px-4">Preferred Tithi</th>
                        <th class="py-3 px-4">Contact</th>
                        <th class="py-3 px-4 text-right">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E5DCD0]/60 font-sans">
                    @forelse ($recentBookings as $b)
                        <tr class="hover:bg-[#FAF7F2]/60">
                            <td class="py-3 px-4 font-mono font-bold text-[#912003]">#PB-{{ $b->id }}</td>
                            <td class="py-3 px-4 font-semibold text-[#1C120C]">{{ $b->devotee_name }}</td>
                            <td class="py-3 px-4 text-[#912003] font-cinzel font-medium">{{ $b->pooja_name }}</td>
                            <td class="py-3 px-4 text-[#422B1E] font-mono">{{ $b->gotra ?: '—' }} / {{ $b->nakshatra ?: '—' }}</td>
                            <td class="py-3 px-4 text-[#1C120C] whitespace-nowrap">{{ $b->preferred_date ? $b->preferred_date->format('d M Y') : '—' }}</td>
                            <td class="py-3 px-4 font-mono">{{ $b->mobile_number }}</td>
                            <td class="py-3 px-4 text-right whitespace-nowrap">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase bg-emerald-100 text-emerald-800">
                                    {{ $b->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-4 text-center text-gray-500">No pooja bookings received yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Pooja Modal -->
    <div id="add-pooja-modal" class="hidden fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="bg-white max-w-xl w-full rounded-3xl border-2 border-[#CA8A04] shadow-2xl p-6 relative max-h-[90vh] overflow-y-auto admin-scroll">
            <div class="flex items-center justify-between pb-3 border-b border-[#E5DCD0]">
                <h3 class="font-cinzel text-lg font-bold text-[#1C120C]">🪔 Add New Pooja Offering (Save to MySQL)</h3>
                <button onclick="document.getElementById('add-pooja-modal').classList.add('hidden')" class="text-gray-400 hover:text-black font-bold text-xl cursor-pointer">✕</button>
            </div>

            <form action="{{ route('admin.poojas.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 pt-4 text-xs font-sans">
                @csrf
                <div>
                    <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">Pooja / Seva Title *</label>
                    <input type="text" name="title" required placeholder="e.g., Maha Mrityunjaya Jaap & Havan" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#1C120C] focus:outline-none focus:border-[#912003]">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">Presiding Deity *</label>
                        <input type="text" name="deity" required placeholder="e.g., Lord Shiva / Maa Durga" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#1C120C]">
                    </div>
                    <div>
                        <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">Category *</label>
                        <select name="category" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#1C120C]">
                            <option value="शैव पूजा विधान">शैव पूजा विधान</option>
                            <option value="वैष्णव पूजा विधान">वैष्णव पूजा विधान</option>
                            <option value="शाक्त पूजा विधान">शाक्त पूजा विधान</option>
                            <option value="वैदिक शांति विधान">वैदिक शांति विधान</option>
                            <option value="संकट मोचन विधान">संकट मोचन विधान</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div>
                        <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">Dakshina (₹) *</label>
                        <input type="number" name="dakshina" required min="1" placeholder="2100" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#1C120C]">
                    </div>
                    <div>
                        <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">Duration *</label>
                        <input type="text" name="duration" required placeholder="1.5 Hours" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#1C120C]">
                    </div>
                    <div>
                        <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">Timing *</label>
                        <input type="text" name="timing" required placeholder="Daily 08:00 AM" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#1C120C]">
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">Assigned Priest / Acharya *</label>
                    <input type="text" name="priest" required placeholder="Pt. Vidyadhar Shastri" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#1C120C]">
                </div>

                <div>
                    <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">Pooja Description</label>
                    <textarea name="description" rows="2" placeholder="Vedic details, significance, and procedure..." class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2 text-xs text-[#1C120C]"></textarea>
                </div>

                <div>
                    <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">Optional Photo Upload</label>
                    <input type="file" name="image" accept="image/*" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3 py-2 text-xs text-[#1C120C]">
                </div>

                <div class="pt-2 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('add-pooja-modal').classList.add('hidden')" class="px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-xs font-semibold cursor-pointer">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-[#912003] hover:bg-[#6C1802] text-white text-xs font-cinzel font-bold shadow-md cursor-pointer">
                        Save to MySQL Database ✓
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-admin.layout>

