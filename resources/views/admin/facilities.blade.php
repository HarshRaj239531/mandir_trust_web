<x-admin.layout title="Temple Facilities (मंदिर सुविधाएं)" subtitle="Dharmashala Stays, Annakshetra Prasadam & Gaushala Management (MySQL Dynamic)">
    
    <!-- Top Stats -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        <div class="bg-white rounded-2xl p-5 border border-[#E5DCD0] shadow-2xs">
            <span class="text-xs font-bold uppercase tracking-wider text-[#A16207] font-cinzel block mb-1">Total Facilities</span>
            <div class="font-cinzel text-3xl font-black text-[#912003]">{{ $facilities->count() }} Centers</div>
            <span class="text-[11px] text-[#6C1802] font-sans">MySQL Catalog Live</span>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-[#E5DCD0] shadow-2xs">
            <span class="text-xs font-bold uppercase tracking-wider text-[#A16207] font-cinzel block mb-1">Daily Mahaprasadam</span>
            <div class="font-cinzel text-3xl font-black text-[#1C120C]">5,000+</div>
            <span class="text-[11px] text-emerald-800 font-sans font-bold">Devotees Served Daily</span>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-[#E5DCD0] shadow-2xs">
            <span class="text-xs font-bold uppercase tracking-wider text-[#A16207] font-cinzel block mb-1">Kamdhenu Gaushala</span>
            <div class="font-cinzel text-3xl font-black text-[#CA8A04]">125 Cows</div>
            <span class="text-[11px] text-[#6C1802] font-sans">Desi Gir & Sahiwal breeds</span>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-[#E5DCD0] shadow-2xs">
            <span class="text-xs font-bold uppercase tracking-wider text-[#A16207] font-cinzel block mb-1">Facility Status</span>
            <div class="font-cinzel text-lg font-bold text-emerald-800 mt-2">All Operational</div>
            <span class="text-[11px] text-[#6C1802] font-sans">Trust Infrastructure</span>
        </div>
    </div>

    <!-- Facilities Roster Table -->
    <div class="bg-white rounded-3xl border border-[#E5DCD0] shadow-[0_2px_16px_rgba(44,29,20,0.03)] overflow-hidden">
        <div class="p-5 sm:p-6 border-b border-[#E5DCD0] flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-[#FAF7F2]/60">
            <div>
                <h3 class="font-cinzel text-lg font-black text-[#1C120C] flex items-center gap-2">
                    <span>🏛️</span> <span>Mandir Trust Facilities & Infrastructure Core</span>
                </h3>
                <p class="text-xs text-[#6C1802] font-sans mt-0.5">
                    Operations, supervisor in-charge, and capacity management for guest devotees.
                </p>
            </div>
            
            <div class="flex items-center gap-3">
                <button onclick="document.getElementById('add-facility-modal').classList.remove('hidden')" class="px-4 py-2 rounded-xl bg-gradient-to-r from-[#912003] to-[#B93815] hover:from-[#6C1802] text-white text-xs font-cinzel font-bold shadow-md cursor-pointer transition-all">
                    ➕ Add Facility / Stay
                </button>
                <a href="{{ route('facilities') }}" target="_blank" class="px-4 py-2 rounded-xl bg-[#FAF7F2] hover:bg-[#E5DCD0] border border-[#DEC7A2] text-xs font-cinzel font-bold text-[#912003] transition-all">
                    🌐 Public Facilities Page ↗
                </a>
            </div>
        </div>

        <div class="overflow-x-auto admin-scroll">
            <table class="w-full text-left text-xs">
                <thead class="bg-[#FAF7F2] text-[#422B1E] uppercase font-cinzel tracking-wider border-b border-[#E5DCD0] text-[11px]">
                    <tr>
                        <th class="py-3.5 px-4">Facility Wing</th>
                        <th class="py-3.5 px-4">Service Type</th>
                        <th class="py-3.5 px-4">Total Capacity</th>
                        <th class="py-3.5 px-4">Current Occupancy / Load</th>
                        <th class="py-3.5 px-4">Supervisor In-charge</th>
                        <th class="py-3.5 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E5DCD0]/60 font-sans">
                    @forelse ($facilities as $f)
                        <tr class="hover:bg-[#FAF7F2]/60 transition-colors">
                            <td class="py-3.5 px-4">
                                <span class="font-cinzel font-bold text-sm text-[#1C120C] block">{{ $f->name }}</span>
                                <span class="text-[10px] text-[#A16207]">Trust Managed Infrastructure</span>
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <span class="px-2.5 py-0.5 rounded-md bg-[#FAF7F2] border border-[#DEC7A2] text-[11px] font-semibold text-[#6C1802]">
                                    {{ $f->type }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 font-medium text-[#1C120C] whitespace-nowrap">
                                {{ $f->capacity }}
                            </td>
                            <td class="py-3.5 px-4 font-semibold text-emerald-800 whitespace-nowrap">
                                {{ $f->occupancy }}
                            </td>
                            <td class="py-3.5 px-4 text-[#1C120C] whitespace-nowrap">
                                {{ $f->incharge }}
                            </td>
                            <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                <form action="{{ route('admin.facilities.delete', $f->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this facility?');" class="inline-block">
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
                            <td colspan="6" class="py-6 text-center text-gray-500">No facilities registered. Click "Add Facility" to create one.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Facility Modal -->
    <div id="add-facility-modal" class="hidden fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="bg-white max-w-lg w-full rounded-3xl border-2 border-[#CA8A04] shadow-2xl p-6 relative max-h-[90vh] overflow-y-auto admin-scroll">
            <div class="flex items-center justify-between pb-3 border-b border-[#E5DCD0]">
                <h3 class="font-cinzel text-lg font-bold text-[#1C120C]">🏛️ Add New Facility (Save to MySQL)</h3>
                <button onclick="document.getElementById('add-facility-modal').classList.add('hidden')" class="text-gray-400 hover:text-black font-bold text-xl cursor-pointer">✕</button>
            </div>

            <form action="{{ route('admin.facilities.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 pt-4 text-xs font-sans">
                @csrf
                <div>
                    <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">Facility Name *</label>
                    <input type="text" name="name" required placeholder="e.g. Shri Shivkrupa Dharmashala & Guest House" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#1C120C] focus:outline-none focus:border-[#912003]">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">Service Type *</label>
                        <input type="text" name="type" required placeholder="Devotee Stay & Rooms / Annakshetra" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#1C120C]">
                    </div>
                    <div>
                        <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">Status *</label>
                        <select name="status" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#1C120C]">
                            <option value="Operational">Operational</option>
                            <option value="Under Renovation">Under Renovation</option>
                            <option value="Upcoming">Upcoming</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">Total Capacity *</label>
                        <input type="text" name="capacity" required placeholder="60 Rooms (Family & Dormitory)" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#1C120C]">
                    </div>
                    <div>
                        <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">Current Occupancy / Load *</label>
                        <input type="text" name="occupancy" required placeholder="48 Rooms Occupied (80%)" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#1C120C]">
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">Supervisor / In-charge *</label>
                    <input type="text" name="incharge" required placeholder="Shri Balmukund Ji (Dharmashala Manager)" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#1C120C]">
                </div>

                <div>
                    <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">Facility Description</label>
                    <textarea name="description" rows="2" placeholder="Amenities, room types, hot water, booking rules..." class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2 text-xs text-[#1C120C]"></textarea>
                </div>

                <div>
                    <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">Photo Upload (Optional)</label>
                    <input type="file" name="image" accept="image/*" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3 py-2 text-xs text-[#1C120C]">
                </div>

                <div class="pt-2 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('add-facility-modal').classList.add('hidden')" class="px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-xs font-semibold cursor-pointer">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-[#912003] hover:bg-[#6C1802] text-white text-xs font-cinzel font-bold shadow-md cursor-pointer">
                        Save Facility ✓
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-admin.layout>

