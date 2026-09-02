<x-layout title="My Account | भक्त विवरण | Shringi Rishi Mandir Trust">
    <x-navbar />

    <div class="min-h-[85vh] py-8 sm:py-12 px-4 sm:px-8 relative">
        <div class="max-w-[1380px] mx-auto space-y-8">
            
            <!-- Welcome Devotee Banner -->
            <div class="parchment-scroll royal-gold-frame rounded-3xl p-6 sm:p-8 border-2 border-[#CA8A04] shadow-md relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-6">
                <x-gold-corners size="w-7 h-7 sm:w-8 sm:h-8" />
                
                <div class="flex items-center gap-4 sm:gap-6 text-center sm:text-left flex-col sm:flex-row">
                    <div class="relative w-20 h-20 sm:w-24 sm:h-24 rounded-full border-3 border-[#CA8A04] overflow-hidden shadow-md shrink-0 bg-[#FAF6EC]">
                        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->nickname }}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <span class="inline-block text-[11px] uppercase tracking-widest text-[#912003] font-bold bg-[#912003]/10 px-2.5 py-0.5 rounded-full mb-1">
                            ॥ Certified Devotee ॥
                        </span>
                        <h1 class="font-cinzel text-2xl sm:text-3xl font-black text-[#1C120C]">
                            {{ $user->nickname }}
                        </h1>
                        <p class="font-marcellus text-xs text-[#6C1802] mt-0.5">
                            Real Account Name: <span class="font-semibold text-[#1C120C]">{{ $user->name }}</span> • Member since {{ $user->created_at->format('M Y') }}
                        </p>
                    </div>
                </div>

                <!-- Action Controls -->
                <div class="flex items-center gap-3">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="hover-lift px-5 py-2 rounded-full bg-[#422B1E] hover:bg-[#2C1D14] text-[#FFFDF9] font-cinzel text-xs font-bold tracking-wider shadow-sm transition-all cursor-pointer">
                            Logout (प्रस्थान)
                        </button>
                    </form>
                </div>
            </div>

            <!-- Flash Success Message -->
            @if (session('success'))
                <div class="p-4 rounded-2xl bg-emerald-800/10 border border-emerald-800/30 text-emerald-900 text-sm font-medium flex items-center gap-2">
                    <span class="text-base">✅</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Errors Alert -->
            @if ($errors->any())
                <div class="p-4 rounded-2xl bg-[#912003]/10 border border-[#912003]/30 text-[#912003] text-xs sm:text-sm font-medium">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Left Column: Mobile Public Preview Card (How other mobiles see this devotee) -->
                <div class="lg:col-span-1 space-y-6">
                    <div class="parchment-scroll royal-gold-frame rounded-3xl p-6 border border-[#CA8A04] shadow-md relative">
                        <div class="text-center pb-3 border-b border-[#DEC7A2]">
                            <span class="text-[10px] uppercase font-bold tracking-wider text-[#A16207] bg-[#FAF6EC] px-2 py-0.5 rounded-full border border-[#DEC7A2]">
                                📱 Mobile Public View
                            </span>
                            <h2 class="font-cinzel text-base font-bold text-[#1C120C] mt-2">
                                Other Mobile Screen Preview
                            </h2>
                            <p class="text-[11px] text-[#6C1802] font-marcellus">
                                Dusre bhakton ke mobile me aapki yahi profile show hogi
                            </p>
                        </div>

                        <!-- Simulated Mobile Devotee Card -->
                        <div class="mt-5 p-4 rounded-2xl bg-gradient-to-b from-[#FAF6EC] to-[#F4EBD9] border-2 border-[#CA8A04] shadow-inner text-center relative overflow-hidden">
                            <div class="absolute top-2 right-2 text-xs opacity-40 font-cinzel">ॐ</div>
                            
                            <div class="w-20 h-20 mx-auto rounded-full border-2 border-[#912003] p-0.5 bg-white shadow-sm overflow-hidden mb-3">
                                <img src="{{ $user->profile_photo_url }}" alt="{{ $user->nickname }}" class="w-full h-full object-cover rounded-full">
                            </div>

                            <span class="inline-block text-[10px] bg-[#912003] text-white px-2 py-0.5 rounded-full font-bold uppercase tracking-wider mb-1">
                                Bhakt
                            </span>

                            <h4 class="font-cinzel text-lg font-black text-[#912003]">
                                {{ $user->nickname }}
                            </h4>

                            <p class="text-[11px] text-[#6C1802] mt-0.5">
                                📍 Pincode: <strong>{{ $user->pincode }}</strong>
                            </p>

                            <div class="mt-3 pt-2.5 border-t border-[#DEC7A2] flex items-center justify-center gap-1.5 text-[10px] text-[#A16207] font-semibold">
                                <span>🪔 Shringi Rishi Mandir Devotee</span>
                            </div>
                        </div>

                        <div class="mt-4 p-3 rounded-xl bg-[#FAF6EC] border border-[#DEC7A2] text-[11px] text-[#422B1E] space-y-1">
                            <p class="font-bold text-[#912003] flex items-center gap-1">
                                <span>🛡️</span> Privacy Guarantee:
                            </p>
                            <p>Aapka Real Name sirf aapke account aur Mandir Admin Panel me hi surakshit rehta hai.</p>
                        </div>
                    </div>

                    <!-- Quick Temple Links -->
                    <div class="parchment-scroll rounded-3xl p-5 border border-[#DEC7A2] text-center space-y-3">
                        <h4 class="font-cinzel text-xs font-bold uppercase tracking-wider text-[#1C120C]">Sacred Seva</h4>
                        <a href="{{ route('poojas') }}" class="block w-full py-2 rounded-xl bg-[#FAF6EC] hover:bg-[#F4EBD9] border border-[#DEC7A2] font-cinzel text-xs text-[#912003] font-bold transition-all">
                            Book Vedic Pooja
                        </a>
                        <a href="{{ route('donate') }}" class="block w-full py-2 rounded-xl bg-gradient-to-r from-[#912003] to-[#B93815] text-[#FFFDF9] font-cinzel text-xs font-bold transition-all shadow-sm">
                            Make Pavitra Daan
                        </a>
                    </div>
                </div>

                <!-- Right Column: Account Information & Editable Form -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- ================= 1. LOCKED FIELDS (ADMIN CONTROLLED) ================= -->
                    <div class="parchment-scroll rounded-3xl p-6 sm:p-8 border border-[#DEC7A2] shadow-sm relative">
                        <div class="flex items-center justify-between border-b border-[#DEC7A2] pb-3 mb-6">
                            <div class="flex items-center gap-2">
                                <span class="text-base text-[#912003]">🔒</span>
                                <h3 class="font-cinzel text-base sm:text-lg font-bold text-[#1C120C]">
                                    Sanctum Locked Records (केवल एडमिन द्वारा परिवर्तनीय)
                                </h3>
                            </div>
                            <span class="text-[10px] bg-[#912003]/10 text-[#912003] font-bold px-2.5 py-1 rounded-full border border-[#912003]/20">
                                🔒 Admin Editable Only
                            </span>
                        </div>

                        <div class="bg-[#FAF6EC] border border-[#DEC7A2]/70 rounded-2xl p-4 mb-6 text-xs text-[#6C1802] flex items-start gap-2.5">
                            <span class="text-base leading-none">ℹ️</span>
                            <p>
                                <strong>Mandir Trust Privacy Policy:</strong> Field 1 (Real Name), 3 (Mother's Name), 4 (Gender), 5 (DOB) aur 6 (Gmail) registration ke baad lock ho jate hain. Inme kisi bhi sanshodhan ke liye Mandir Admin se sampark karein.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- 1. Real Name (Locked) -->
                            <div class="bg-[#FFFDF9] p-3.5 rounded-xl border border-[#DEC7A2]/60">
                                <span class="block text-[10px] font-bold uppercase tracking-wider text-[#A16207]">1. Real / Legal Name</span>
                                <span class="font-semibold text-sm text-[#1C120C] block mt-0.5">{{ $user->name }}</span>
                                <span class="text-[9px] text-[#6C1802] font-mono">🔒 Locked</span>
                            </div>

                            <!-- 3. Mother's Name (Locked) -->
                            <div class="bg-[#FFFDF9] p-3.5 rounded-xl border border-[#DEC7A2]/60">
                                <span class="block text-[10px] font-bold uppercase tracking-wider text-[#A16207]">3. Mother's Name</span>
                                <span class="font-semibold text-sm text-[#1C120C] block mt-0.5">{{ $user->mother_name }}</span>
                                <span class="text-[9px] text-[#6C1802] font-mono">🔒 Locked</span>
                            </div>

                            <!-- 4. Gender (Locked) -->
                            <div class="bg-[#FFFDF9] p-3.5 rounded-xl border border-[#DEC7A2]/60">
                                <span class="block text-[10px] font-bold uppercase tracking-wider text-[#A16207]">4. Gender (लिंग)</span>
                                <span class="font-semibold text-sm text-[#1C120C] block mt-0.5 capitalize">{{ $user->gender }}</span>
                                <span class="text-[9px] text-[#6C1802] font-mono">🔒 Locked</span>
                            </div>

                            <!-- 5. DOB (Locked) -->
                            <div class="bg-[#FFFDF9] p-3.5 rounded-xl border border-[#DEC7A2]/60">
                                <span class="block text-[10px] font-bold uppercase tracking-wider text-[#A16207]">5. Date of Birth (जन्मतिथि)</span>
                                <span class="font-semibold text-sm text-[#1C120C] block mt-0.5">{{ $user->dob ? $user->dob->format('d M, Y') : 'N/A' }}</span>
                                <span class="text-[9px] text-[#6C1802] font-mono">🔒 Locked</span>
                            </div>

                            <!-- 6. Gmail / Email (Locked) -->
                            <div class="sm:col-span-2 bg-[#FFFDF9] p-3.5 rounded-xl border border-[#DEC7A2]/60">
                                <span class="block text-[10px] font-bold uppercase tracking-wider text-[#A16207]">6. Registered Gmail / Email</span>
                                <span class="font-semibold text-sm text-[#1C120C] block mt-0.5 font-mono">{{ $user->email }}</span>
                                <span class="text-[9px] text-[#6C1802] font-mono">🔒 Locked</span>
                            </div>
                        </div>
                    </div>


                    <!-- ================= 2. EDITABLE PROFILE FORM ================= -->
                    <div class="parchment-scroll royal-gold-frame rounded-3xl p-6 sm:p-8 border-2 border-[#CA8A04] shadow-md relative">
                        <x-gold-corners size="w-7 h-7" />
                        
                        <div class="flex items-center justify-between border-b border-[#DEC7A2] pb-3 mb-6">
                            <div class="flex items-center gap-2">
                                <span class="text-base text-[#912003]">✏️</span>
                                <h3 class="font-cinzel text-base sm:text-lg font-bold text-[#1C120C]">
                                    Update Devotee Profile (प्रोफाइल अपडेट)
                                </h3>
                            </div>
                            <span class="text-[10px] bg-[#CA8A04]/20 text-[#6C1802] font-bold px-2.5 py-1 rounded-full border border-[#CA8A04]/40">
                                Devotee Updatable
                            </span>
                        </div>

                        <form action="{{ route('devotee.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf

                            <!-- 10. Update Selfie / Profile Photo -->
                            <div class="bg-[#FAF6EC] p-4 rounded-2xl border border-[#DEC7A2]">
                                <label class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-2">
                                    10. Update Selfie / Profile Picture (फोटो बदलें)
                                </label>
                                
                                <div class="flex flex-col sm:flex-row items-center gap-4">
                                    <div class="relative w-20 h-20 rounded-2xl bg-white border-2 border-[#CA8A04] overflow-hidden shrink-0 shadow-inner">
                                        <img id="update-photo-preview" src="{{ $user->profile_photo_url }}" alt="Preview" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-grow text-center sm:text-left">
                                        <input type="file" id="update_profile_photo" name="profile_photo" accept="image/*" onchange="previewUpdateImage(event)" class="hidden">
                                        <input type="hidden" name="profile_photo_base64" id="update_profile_photo_base64">
                                        <label for="update_profile_photo" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-[#912003] hover:bg-[#6C1802] text-[#FFFDF9] font-cinzel font-semibold text-xs cursor-pointer shadow-xs transition-all">
                                            <span>📷</span>
                                            <span>Choose New Selfie</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <!-- 2. Nick Name -->
                                <div class="sm:col-span-2">
                                    <label for="nickname" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                                        2. Nick Name (भक्त नाम / Public Screen Name) <span class="text-[#912003]">*</span>
                                    </label>
                                    <input type="text" id="nickname" name="nickname" value="{{ old('nickname', $user->nickname) }}" required
                                        class="w-full bg-[#FFFDF9] border border-[#DEC7A2] rounded-xl px-4 py-2.5 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003] transition-all">
                                </div>

                                <!-- 7. Mobile Number -->
                                <div>
                                    <label for="mobile_number" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                                        7. Mobile Number <span class="text-[#912003]">*</span>
                                    </label>
                                    <input type="tel" id="mobile_number" name="mobile_number" value="{{ old('mobile_number', $user->mobile_number) }}" required
                                        class="w-full bg-[#FFFDF9] border border-[#DEC7A2] rounded-xl px-4 py-2.5 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003] transition-all">
                                </div>

                                <!-- 8. WhatsApp Number -->
                                <div>
                                    <label for="whatsapp_number" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                                        8. WhatsApp Number
                                    </label>
                                    <input type="tel" id="whatsapp_number" name="whatsapp_number" value="{{ old('whatsapp_number', $user->whatsapp_number) }}"
                                        class="w-full bg-[#FFFDF9] border border-[#DEC7A2] rounded-xl px-4 py-2.5 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003] transition-all">
                                </div>

                                <!-- 9. Pincode -->
                                <div class="sm:col-span-2">
                                    <label for="pincode" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                                        9. Pincode (पिन कोड) <span class="text-[#912003]">*</span>
                                    </label>
                                    <input type="text" id="pincode" name="pincode" value="{{ old('pincode', $user->pincode) }}" required maxlength="6"
                                        class="w-full bg-[#FFFDF9] border border-[#DEC7A2] rounded-xl px-4 py-2.5 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003] transition-all">
                                </div>
                            </div>

                            <!-- Optional Change Password Accordion / Details -->
                            <details class="group bg-[#FAF6EC] border border-[#DEC7A2] rounded-2xl p-4 transition-all">
                                <summary class="font-cinzel text-xs font-bold text-[#1C120C] cursor-pointer flex items-center justify-between">
                                    <span>🔑 Change Password (पासवर्ड बदलें - Optional)</span>
                                    <span class="group-open:rotate-180 transition-transform">▼</span>
                                </summary>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4 pt-3 border-t border-[#DEC7A2]/60">
                                    <div class="sm:col-span-2">
                                        <label for="current_password" class="block text-[11px] font-bold text-[#2C1D14] mb-1">Current Password</label>
                                        <input type="password" id="current_password" name="current_password" class="w-full bg-[#FFFDF9] border border-[#DEC7A2] rounded-xl px-3 py-2 text-xs">
                                    </div>
                                    <div>
                                        <label for="new_password" class="block text-[11px] font-bold text-[#2C1D14] mb-1">New Password</label>
                                        <input type="password" id="new_password" name="new_password" minlength="6" class="w-full bg-[#FFFDF9] border border-[#DEC7A2] rounded-xl px-3 py-2 text-xs">
                                    </div>
                                    <div>
                                        <label for="new_password_confirmation" class="block text-[11px] font-bold text-[#2C1D14] mb-1">Confirm New Password</label>
                                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" minlength="6" class="w-full bg-[#FFFDF9] border border-[#DEC7A2] rounded-xl px-3 py-2 text-xs">
                                    </div>
                                </div>
                            </details>

                            <div class="pt-2 text-right">
                                <button type="submit" class="shimmer-btn hover-lift px-8 py-3 rounded-full bg-gradient-to-r from-[#912003] via-[#B93815] to-[#912003] hover:from-[#6C1802] text-[#FFFDF9] font-cinzel font-bold text-xs sm:text-sm uppercase tracking-widest shadow-md transition-all cursor-pointer">
                                    <span>Save Profile Changes</span>
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script>
        function previewUpdateImage(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const file = input.files[0];
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('update-photo-preview').src = e.target.result;
                };
                reader.readAsDataURL(file);

                const img = new Image();
                img.src = URL.createObjectURL(file);
                img.onload = function() {
                    URL.revokeObjectURL(img.src);
                    const canvas = document.createElement('canvas');
                    let width = img.width;
                    let height = img.height;
                    const maxDim = 1200;
                    if (width > maxDim || height > maxDim) {
                        if (width > height) {
                            height = Math.round((height * maxDim) / width);
                            width = maxDim;
                        } else {
                            width = Math.round((width * maxDim) / height);
                            height = maxDim;
                        }
                    }
                    canvas.width = width;
                    canvas.height = height;
                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, width, height);

                    const base64Data = canvas.toDataURL('image/jpeg', 0.82);
                    const base64Input = document.getElementById('update_profile_photo_base64');
                    if (base64Input) {
                        base64Input.value = base64Data;
                    }
                };
            }
        }
    </script>
</x-layout>
