<x-admin.layout title="Edit Devotee Records" subtitle="Modify Devotee Information">
    
    <div class="max-w-4xl mx-auto space-y-6">
        
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-cinzel text-xl sm:text-2xl font-black text-[#1C120C]">
                    भक्त विवरण संशोधन (Edit Devotee)
                </h2>
                <p class="font-marcellus text-xs text-[#912003] mt-0.5">
                    Modify locked fields (1, 3, 4, 5, 6) and all devotee records.
                </p>
            </div>
            <a href="{{ route('admin.devotees.index') }}" class="px-4 py-2 rounded-xl bg-white hover:bg-[#FAF7F2] border border-[#E5DCD0] text-xs font-bold font-cinzel text-[#6C1802] transition-colors">
                ← Back to Devotees Roster
            </a>
        </div>

        <!-- Errors Alert -->
        @if ($errors->any())
            <div class="p-4 rounded-2xl bg-red-50 border border-red-200 text-red-900 text-xs sm:text-sm shadow-2xs">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Devotee Identity Summary Card -->
        <div class="bg-white rounded-2xl p-5 border border-[#E5DCD0] shadow-2xs flex items-center gap-4">
            <div class="w-14 h-14 rounded-xl border border-[#DEC7A2] overflow-hidden shrink-0 shadow-2xs bg-[#FAF7F2]">
                <img src="{{ $devotee->profile_photo_url }}" alt="{{ $devotee->nickname }}" class="w-full h-full object-cover">
            </div>
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-[#A16207] bg-[#FAF7F2] px-2.5 py-0.5 rounded-full border border-[#E5DCD0]">
                    Member ID #{{ $devotee->id }}
                </span>
                <h3 class="font-cinzel text-lg font-black text-[#1C120C] mt-0.5">
                    {{ $devotee->nickname }}
                </h3>
                <p class="text-xs text-[#6C1802] font-marcellus">
                    Full Legal Name: <strong class="text-[#1C120C]">{{ $devotee->name }}</strong> • Enrolled on {{ $devotee->created_at->format('d M, Y') }}
                </p>
            </div>
        </div>

        <!-- Edit Form Card -->
        <div class="bg-white rounded-2xl p-6 sm:p-8 border border-[#E5DCD0] shadow-[0_2px_16px_rgba(44,29,20,0.04)]">
            <form action="{{ route('admin.devotee.update', $devotee->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- 10. Photo / Selfie Upload & Preview -->
                <div class="bg-[#FAF7F2] border border-[#E5DCD0] rounded-xl p-4">
                    <label class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-2 font-cinzel">
                        10. Selfie / Profile Photo (फोटो बदलें)
                    </label>
                    <div class="flex flex-col sm:flex-row items-center gap-4">
                        <div class="w-16 h-16 rounded-xl bg-white border border-[#DEC7A2] overflow-hidden shrink-0 shadow-2xs">
                            <img id="admin-photo-preview" src="{{ $devotee->profile_photo_url }}" alt="{{ $devotee->nickname }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <input type="file" id="profile_photo" name="profile_photo" accept="image/*" onchange="previewAdminPhoto(event)" class="text-xs text-[#2C1D14]">
                        </div>
                    </div>
                </div>

                <!-- 10 Fields Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5">
                    <!-- 1. Real Name -->
                    <div>
                        <label for="name" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                            1. Full Name (वास्तविक नाम) <span class="text-[#912003]">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name', $devotee->name) }}" required
                            class="w-full bg-[#FAF7F2] border border-[#E5DCD0] rounded-xl px-4 py-2.5 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003]">
                    </div>

                    <!-- 2. Nick Name (Public Screen Name) -->
                    <div>
                        <label for="nickname" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                            2. Nick Name (भक्त नाम / Public Screen Name) <span class="text-[#912003]">*</span>
                        </label>
                        <input type="text" id="nickname" name="nickname" value="{{ old('nickname', $devotee->nickname) }}" required
                            class="w-full bg-[#FAF7F2] border border-[#E5DCD0] rounded-xl px-4 py-2.5 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003]">
                    </div>

                    <!-- 3. Mother's Name -->
                    <div>
                        <label for="mother_name" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                            3. Mother's Name (माता का नाम) <span class="text-[#912003]">*</span>
                        </label>
                        <input type="text" id="mother_name" name="mother_name" value="{{ old('mother_name', $devotee->mother_name) }}" required
                            class="w-full bg-[#FAF7F2] border border-[#E5DCD0] rounded-xl px-4 py-2.5 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003]">
                    </div>

                    <!-- 4. Gender -->
                    <div>
                        <label for="gender" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                            4. Gender (लिंग) <span class="text-[#912003]">*</span>
                        </label>
                        <select id="gender" name="gender" required class="w-full bg-[#FAF7F2] border border-[#E5DCD0] rounded-xl px-3 py-2.5 text-sm text-[#1C120C]">
                            <option value="male" {{ old('gender', $devotee->gender) === 'male' ? 'selected' : '' }}>Male (पुरुष)</option>
                            <option value="female" {{ old('gender', $devotee->gender) === 'female' ? 'selected' : '' }}>Female (महिला)</option>
                            <option value="other" {{ old('gender', $devotee->gender) === 'other' ? 'selected' : '' }}>Other (अन्य)</option>
                        </select>
                    </div>

                    <!-- 5. D.O.B -->
                    <div>
                        <label for="dob" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                            5. D.O.B (जन्मतिथि) <span class="text-[#912003]">*</span>
                        </label>
                        <input type="date" id="dob" name="dob" value="{{ old('dob', $devotee->dob ? $devotee->dob->format('Y-m-d') : '') }}" required max="{{ date('Y-m-d') }}"
                            class="w-full bg-[#FAF7F2] border border-[#E5DCD0] rounded-xl px-3 py-2.5 text-sm text-[#1C120C]">
                    </div>

                    <!-- 6. Gmail / Email -->
                    <div>
                        <label for="email" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                            6. Gmail / Email <span class="text-[#912003]">*</span>
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email', $devotee->email) }}" required
                            class="w-full bg-[#FAF7F2] border border-[#E5DCD0] rounded-xl px-4 py-2.5 text-sm text-[#1C120C]">
                    </div>

                    <!-- 7. Mobile Number -->
                    <div>
                        <label for="mobile_number" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                            7. Mobile Number <span class="text-[#912003]">*</span>
                        </label>
                        <input type="tel" id="mobile_number" name="mobile_number" value="{{ old('mobile_number', $devotee->mobile_number) }}" required
                            class="w-full bg-[#FAF7F2] border border-[#E5DCD0] rounded-xl px-4 py-2.5 text-sm text-[#1C120C]">
                    </div>

                    <!-- 8. WhatsApp Number -->
                    <div>
                        <label for="whatsapp_number" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                            8. WhatsApp Number
                        </label>
                        <input type="tel" id="whatsapp_number" name="whatsapp_number" value="{{ old('whatsapp_number', $devotee->whatsapp_number) }}"
                            class="w-full bg-[#FAF7F2] border border-[#E5DCD0] rounded-xl px-4 py-2.5 text-sm text-[#1C120C]">
                    </div>

                    <!-- 9. Pincode -->
                    <div>
                        <label for="pincode" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                            9. Pincode (पिन कोड) <span class="text-[#912003]">*</span>
                        </label>
                        <input type="text" id="pincode" name="pincode" value="{{ old('pincode', $devotee->pincode) }}" required maxlength="6"
                            class="w-full bg-[#FAF7F2] border border-[#E5DCD0] rounded-xl px-4 py-2.5 text-sm text-[#1C120C]">
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                            Account Status
                        </label>
                        <select id="status" name="status" class="w-full bg-[#FAF7F2] border border-[#E5DCD0] rounded-xl px-3 py-2.5 text-sm text-[#1C120C]">
                            <option value="active" {{ old('status', $devotee->status) === 'active' ? 'selected' : '' }}>Active (सक्रिय)</option>
                            <option value="inactive" {{ old('status', $devotee->status) === 'inactive' ? 'selected' : '' }}>Inactive (निष्क्रिय)</option>
                        </select>
                    </div>
                </div>

                <!-- Administrative Controls -->
                <div class="bg-[#FAF7F2] border border-[#E5DCD0] rounded-xl p-4 sm:p-5 space-y-4">
                    <h4 class="font-cinzel text-xs font-bold uppercase tracking-wider text-[#1C120C]">Administrative Overrides</h4>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="new_password" class="block text-[11px] font-bold text-[#2C1D14] mb-1">Reset Password (Leave blank to keep unchanged)</label>
                            <input type="password" id="new_password" name="new_password" placeholder="Enter new password" minlength="6"
                                class="w-full bg-white border border-[#E5DCD0] rounded-xl px-3 py-2 text-xs">
                        </div>

                        <div class="flex items-center pt-5">
                            <label class="flex items-center gap-2 text-xs text-[#2C1D14] font-semibold cursor-pointer">
                                <input type="checkbox" name="is_admin" value="1" {{ old('is_admin', $devotee->is_admin) ? 'checked' : '' }} class="rounded text-[#912003] border-[#DEC7A2]">
                                <span>Grant Mandir Administrator Access</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Submit Action -->
                <div class="pt-2 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.dashboard') }}" class="px-6 py-2.5 rounded-xl bg-[#FAF7F2] border border-[#E5DCD0] text-[#422B1E] font-cinzel text-xs font-bold hover:bg-[#E5DCD0]/50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" class="shimmer-btn hover-lift px-8 py-2.5 rounded-xl bg-[#912003] hover:bg-[#6C1802] text-[#FFFDF9] font-cinzel font-bold text-xs uppercase tracking-widest shadow-sm cursor-pointer">
                        <span>Save Devotee Records</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewAdminPhoto(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('admin-photo-preview').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-admin.layout>
