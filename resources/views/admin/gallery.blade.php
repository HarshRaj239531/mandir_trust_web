<x-admin.layout title="Gallery & Media (छायाचित्र दीर्घा)" subtitle="Sacred Darshan Photos, Aartis & Festival Media Library (MySQL Dynamic)">
    
    <!-- Top Stats -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        <div class="bg-white rounded-2xl p-5 border border-[#E5DCD0] shadow-2xs">
            <span class="text-xs font-bold uppercase tracking-wider text-[#A16207] font-cinzel block mb-1">Total Photos Stored</span>
            <div class="font-cinzel text-3xl font-black text-[#912003]">{{ $galleries->count() }} Photos</div>
            <span class="text-[11px] text-[#6C1802] font-sans">MySQL Media Library</span>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-[#E5DCD0] shadow-2xs">
            <span class="text-xs font-bold uppercase tracking-wider text-[#A16207] font-cinzel block mb-1">Sanctum Darshan</span>
            <div class="font-cinzel text-3xl font-black text-[#1C120C]">Daily Live</div>
            <span class="text-[11px] text-emerald-800 font-sans font-bold">Updated by Priests</span>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-[#E5DCD0] shadow-2xs">
            <span class="text-xs font-bold uppercase tracking-wider text-[#A16207] font-cinzel block mb-1">Storage Type</span>
            <div class="font-cinzel text-lg font-bold text-[#CA8A04] mt-2">Local Storage + DB</div>
            <span class="text-[11px] text-[#6C1802] font-sans">storage/app/public</span>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-[#E5DCD0] shadow-2xs">
            <span class="text-xs font-bold uppercase tracking-wider text-[#A16207] font-cinzel block mb-1">Public Gallery</span>
            <div class="font-cinzel text-lg font-bold text-emerald-800 mt-2">Active & Published</div>
            <span class="text-[11px] text-[#6C1802] font-sans">Visible to all devotees</span>
        </div>
    </div>

    <!-- Gallery Albums Grid (Yoga-Style Media Cards) -->
    <div class="bg-white rounded-3xl p-6 sm:p-7 border border-[#E5DCD0] shadow-[0_2px_16px_rgba(44,29,20,0.03)] space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-[#E5DCD0] pb-4">
            <div>
                <h3 class="font-cinzel text-lg font-black text-[#1C120C] flex items-center gap-2">
                    <span>🖼️</span> <span>Mandir Sanctum Darshan & Photo Collections</span>
                </h3>
                <p class="text-xs text-[#6C1802] font-sans mt-0.5">
                    Devotee darshan media albums visible on the public temple website.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <button onclick="document.getElementById('upload-photo-modal').classList.remove('hidden')" class="px-4 py-2 rounded-xl bg-gradient-to-r from-[#912003] to-[#B93815] hover:from-[#6C1802] text-white text-xs font-cinzel font-bold shadow-md cursor-pointer transition-all">
                    📷 Upload New Photo
                </button>
                <a href="{{ route('gallery') }}" target="_blank" class="px-4 py-2 rounded-xl bg-[#FAF7F2] hover:bg-[#E5DCD0] border border-[#DEC7A2] text-xs font-cinzel font-bold text-[#912003] transition-all">
                    🌐 Public Gallery ↗
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @forelse ($galleries as $g)
                @php
                    $imgUrl = $g->image_url;
                @endphp
                <div class="bg-[#FAF7F2] rounded-2xl overflow-hidden border border-[#DEC7A2]/60 shadow-sm hover:shadow-md transition-all group">
                    <div class="h-44 overflow-hidden relative bg-[#1C120C]">
                        <img src="{{ $imgUrl }}" alt="{{ $g->title }}" onerror="this.src='{{ asset('images/mandir-aarti.jpg') }}'" class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                        <span class="absolute bottom-2 left-3 text-[10px] uppercase tracking-wider font-bold bg-[#912003] text-white px-2 py-0.5 rounded-full font-cinzel">
                            {{ $g->category }}
                        </span>
                        <div class="absolute top-2 right-2 flex items-center gap-1.5">
                            <button type="button" 
                                onclick="openEditGalleryModal({{ $g->id }}, '{{ addslashes($g->title) }}', '{{ addslashes($g->category) }}', '{{ addslashes($g->caption ?: '') }}', '{{ $imgUrl }}')"
                                title="Edit Photo Details"
                                class="bg-amber-600 hover:bg-amber-700 text-white text-xs rounded-md px-2 py-1 shadow cursor-pointer transition-colors">
                                ✏️ Edit
                            </button>
                            <form action="{{ route('admin.gallery.delete', $g->id) }}" method="POST" onsubmit="return confirm('Delete this image from database?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Delete Photo" class="bg-red-600 hover:bg-red-700 text-white text-xs rounded-md px-2 py-1 shadow cursor-pointer transition-colors">
                                    🗑️
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="p-4 space-y-2">
                        <h4 class="font-cinzel font-bold text-sm text-[#1C120C] group-hover:text-[#912003] transition-colors leading-tight">
                            {{ $g->title }}
                        </h4>
                        @if ($g->caption)
                            <p class="text-[11px] text-[#6C1802] line-clamp-2">{{ $g->caption }}</p>
                        @endif
                        <div class="flex items-center justify-between text-[10px] text-gray-500 pt-2 border-t border-[#E5DCD0]">
                            <span>{{ $g->created_at->format('d M Y') }}</span>
                            <button type="button" onclick="openEditGalleryModal({{ $g->id }}, '{{ addslashes($g->title) }}', '{{ addslashes($g->category) }}', '{{ addslashes($g->caption ?: '') }}', '{{ $imgUrl }}')" class="text-[#912003] font-bold hover:underline cursor-pointer">
                                ✏️ Edit Info
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-4 py-8 text-center text-gray-500">No photos in gallery yet. Click "Upload New Photo" to add one!</div>
            @endforelse
        </div>
    </div>

    <!-- Upload Photo Modal -->
    <div id="upload-photo-modal" class="hidden fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="bg-white max-w-lg w-full rounded-3xl border-2 border-[#CA8A04] shadow-2xl p-6 relative max-h-[90vh] overflow-y-auto admin-scroll">
            <div class="flex items-center justify-between pb-3 border-b border-[#E5DCD0]">
                <h3 class="font-cinzel text-lg font-bold text-[#1C120C]">📷 Upload Darshan Photo (Save to MySQL)</h3>
                <button onclick="document.getElementById('upload-photo-modal').classList.add('hidden')" class="text-gray-400 hover:text-black font-bold text-xl cursor-pointer">✕</button>
            </div>

            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 pt-4 text-xs font-sans">
                @csrf
                <div>
                    <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">Photo Title *</label>
                    <input type="text" name="title" required placeholder="e.g. Sanctum Shringar Darshan on Somwar" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#1C120C] focus:outline-none focus:border-[#912003]">
                </div>

                <div>
                    <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">Category *</label>
                    <select name="category" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#1C120C]">
                        <option value="Sanctum Darshan">Sanctum Darshan (गर्भगृह दर्शन)</option>
                        <option value="Daily Aartis">Daily Aartis (दैनिक आरती)</option>
                        <option value="Heritage">Heritage & Shikhara (प्राचीन शिखर)</option>
                        <option value="Festivals">Festivals & Bhandara (उत्सव एवं भण्डारा)</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">Select Image File *</label>
                    <input type="file" name="photo" required accept="image/*" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3 py-2 text-xs text-[#1C120C]">
                </div>

                <div>
                    <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">Caption / Details</label>
                    <textarea name="caption" rows="2" placeholder="Describe the sacred moment or deity decoration..." class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2 text-xs text-[#1C120C]"></textarea>
                </div>

                <div class="pt-2 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('upload-photo-modal').classList.add('hidden')" class="px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-xs font-semibold cursor-pointer">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-[#912003] hover:bg-[#6C1802] text-white text-xs font-cinzel font-bold shadow-md cursor-pointer">
                        Upload to MySQL Database ✓
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Photo Modal (Dynamic MySQL Edit) -->
    <div id="edit-photo-modal" class="hidden fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="bg-white max-w-lg w-full rounded-3xl border-2 border-[#CA8A04] shadow-2xl p-6 relative max-h-[90vh] overflow-y-auto admin-scroll">
            <div class="flex items-center justify-between pb-3 border-b border-[#E5DCD0]">
                <h3 class="font-cinzel text-lg font-bold text-[#1C120C]">✏️ Edit Gallery Photo Details</h3>
                <button onclick="document.getElementById('edit-photo-modal').classList.add('hidden')" class="text-gray-400 hover:text-black font-bold text-xl cursor-pointer">✕</button>
            </div>

            <form id="edit-gallery-form" action="" method="POST" enctype="multipart/form-data" class="space-y-4 pt-4 text-xs font-sans">
                @csrf
                @method('PUT')

                <!-- Current Image Preview -->
                <div class="flex items-center gap-4 p-3 bg-[#FAF7F2] rounded-2xl border border-[#DEC7A2]">
                    <img id="edit-image-preview" src="" alt="Current photo" class="w-16 h-16 object-cover rounded-xl border border-[#DEC7A2] shadow-xs">
                    <div>
                        <span class="text-[11px] font-bold text-[#912003] block font-cinzel">Current Active Image</span>
                        <span class="text-[10px] text-gray-500 block">Upload new image below only if you want to replace it.</span>
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">Photo Title *</label>
                    <input type="text" id="edit-title" name="title" required class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#1C120C] focus:outline-none focus:border-[#912003]">
                </div>

                <div>
                    <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">Category *</label>
                    <select id="edit-category" name="category" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#1C120C]">
                        <option value="Sanctum Darshan">Sanctum Darshan (गर्भगृह दर्शन)</option>
                        <option value="Daily Aartis">Daily Aartis (दैनिक आरती)</option>
                        <option value="Heritage">Heritage & Shikhara (प्राचीन शिखर)</option>
                        <option value="Festivals">Festivals & Bhandara (उत्सव एवं भण्डारा)</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">Replace Image File (Optional)</label>
                    <input type="file" name="photo" accept="image/*" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3 py-2 text-xs text-[#1C120C]">
                    <span class="text-[10px] text-gray-500 italic mt-0.5 block">Leave empty to keep the existing photo.</span>
                </div>

                <div>
                    <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">Caption / Details</label>
                    <textarea id="edit-caption" name="caption" rows="2" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2 text-xs text-[#1C120C]"></textarea>
                </div>

                <div class="pt-2 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('edit-photo-modal').classList.add('hidden')" class="px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-xs font-semibold cursor-pointer">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-[#912003] hover:bg-[#6C1802] text-white text-xs font-cinzel font-bold shadow-md cursor-pointer">
                        Update & Save Changes ✓
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditGalleryModal(id, title, category, caption, imageUrl) {
            const form = document.getElementById('edit-gallery-form');
            const urlTemplate = "{{ route('admin.gallery.update', ['id' => ':id']) }}";
            form.action = urlTemplate.replace(':id', id);
            document.getElementById('edit-title').value = title;
            document.getElementById('edit-category').value = category;
            document.getElementById('edit-caption').value = caption;
            document.getElementById('edit-image-preview').src = imageUrl;
            document.getElementById('edit-photo-modal').classList.remove('hidden');
        }
    </script>

</x-admin.layout>

