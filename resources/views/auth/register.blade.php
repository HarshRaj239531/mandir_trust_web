<x-layout title="Devotee Registration | भक्त पंजीकरण | Shringi Rishi Mandir Trust">
    <x-navbar />

    <div class="min-h-[85vh] py-8 sm:py-14 px-3 sm:px-6 relative flex items-center justify-center">
        
        <!-- Sacred Vedic Parchment Container -->
        <div class="max-w-3xl w-full parchment-scroll royal-gold-frame rounded-3xl p-6 sm:p-10 md:p-12 shadow-[0_20px_60px_rgba(44,29,20,0.18)] border-2 border-[#CA8A04] relative">
            <x-gold-corners size="w-8 h-8 sm:w-10 sm:h-10" />

            <!-- Header Section -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-br from-[#FFFDF9] to-[#FAF6EC] border-2 border-[#CA8A04] shadow-md mb-3 text-[#912003]">
                    <span class="font-cinzel text-3xl font-black">ॐ</span>
                </div>
                <h1 class="font-cinzel text-2xl sm:text-3xl md:text-4xl font-bold text-[#1C120C] tracking-wide">
                    भक्त पंजीकरण
                </h1>
                <p class="font-marcellus text-xs sm:text-sm text-[#912003] uppercase tracking-widest mt-1">
                    Devotee Sacred Enrollment Patrika
                </p>
                <div class="w-32 h-[2px] bg-gradient-to-r from-transparent via-[#CA8A04] to-transparent mx-auto mt-3"></div>
            </div>

            <!-- Validation Errors Alert -->
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-2xl bg-[#912003]/10 border border-[#912003]/30 text-[#912003]">
                    <div class="flex items-center gap-2 font-bold font-cinzel text-sm mb-1">
                        <span>⚠️</span> <span>Please correct the following fields:</span>
                    </div>
                    <ul class="list-disc list-inside text-xs sm:text-sm space-y-0.5 ml-2 font-sans">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- ================= SECTION 1: IDENTITY & NAMES ================= -->
                <div class="bg-[#FAF6EC]/80 border border-[#DEC7A2] rounded-2xl p-4 sm:p-6 relative">
                    <div class="flex items-center justify-between border-b border-[#DEC7A2]/60 pb-2.5 mb-4">
                        <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-[#912003] text-white flex items-center justify-center text-xs font-bold font-mono">1</span>
                            <h2 class="font-cinzel text-sm sm:text-base font-bold text-[#1C120C]">Sacred Identity & Names</h2>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                        <!-- 1. Real / Legal Name -->
                        <div>
                            <label for="name" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                                1. Full Name  <span class="text-[#912003]">*</span>
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                placeholder="e.g. Ramesh Chandra Sharma"
                                class="w-full bg-[#FFFDF9] border border-[#DEC7A2] rounded-xl px-4 py-2.5 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003] focus:ring-1 focus:ring-[#912003] transition-all">
                        </div>

                        <!-- 2. Nick Name (Public Screen Name) -->
                        <div>
                            <label for="nickname" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                                2. Nick Name (Display Name) <span class="text-[#912003]">*</span>
                            </label>
                            <input type="text" id="nickname" name="nickname" value="{{ old('nickname') }}" required
                                placeholder="e.g. ShivBhakt_Ramesh"
                                class="w-full bg-[#FFFDF9] border border-[#DEC7A2] rounded-xl px-4 py-2.5 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003] focus:ring-1 focus:ring-[#912003] transition-all">
                        </div>
                    </div>
                </div>

                <!-- ================= SECTION 2: SACRED FAMILY & PERSONAL RECORDS ================= -->
                <div class="bg-[#FAF6EC]/80 border border-[#DEC7A2] rounded-2xl p-4 sm:p-6 relative">
                    <div class="flex items-center justify-between border-b border-[#DEC7A2]/60 pb-2.5 mb-4">
                        <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-[#912003] text-white flex items-center justify-center text-xs font-bold font-mono">2</span>
                            <h2 class="font-cinzel text-sm sm:text-base font-bold text-[#1C120C]">Personal & Sacred Records</h2>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                        <!-- 3. Mother's Name -->
                        <div class="sm:col-span-2">
                            <label for="mother_name" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                                3. Mother's Name <span class="text-[#912003]">*</span>
                            </label>
                            <input type="text" id="mother_name" name="mother_name" value="{{ old('mother_name') }}" required
                                placeholder="e.g. Smt. Shanti Devi"
                                class="w-full bg-[#FFFDF9] border border-[#DEC7A2] rounded-xl px-4 py-2.5 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003] focus:ring-1 focus:ring-[#912003] transition-all">
                        </div>

                        <!-- 4. Gender -->
                        <div>
                            <label for="gender" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                                4. Gender <span class="text-[#912003]">*</span>
                            </label>
                            <select id="gender" name="gender" required
                                class="w-full bg-[#FFFDF9] border border-[#DEC7A2] rounded-xl px-3 py-2.5 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003] transition-all">
                                <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select...</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male </option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female </option>
                                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <!-- 5. D.O.B -->
                        <div>
                            <label for="dob" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                                5. D.O.B <span class="text-[#912003]">*</span>
                            </label>
                            <input type="date" id="dob" name="dob" value="{{ old('dob') }}" required max="{{ date('Y-m-d') }}"
                                class="w-full bg-[#FFFDF9] border border-[#DEC7A2] rounded-xl px-3 py-2.5 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003] transition-all">
                        </div>

                        <!-- 6. Gmail / Email -->
                        <div class="sm:col-span-2 md:col-span-4">
                            <label for="email" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                                6. Gmail / Email Address <span class="text-[#912003]">*</span>
                            </label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                placeholder="e.g. yourname@gmail.com"
                                class="w-full bg-[#FFFDF9] border border-[#DEC7A2] rounded-xl px-4 py-2.5 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003] transition-all">
                        </div>
                    </div>
                </div>

                <!-- ================= SECTION 3: CONTACT & LOCATION ================= -->
                <div class="bg-[#FAF6EC]/80 border border-[#DEC7A2] rounded-2xl p-4 sm:p-6 relative">
                    <div class="flex items-center justify-between border-b border-[#DEC7A2]/60 pb-2.5 mb-4">
                        <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-[#912003] text-white flex items-center justify-center text-xs font-bold font-mono">3</span>
                            <h2 class="font-cinzel text-sm sm:text-base font-bold text-[#1C120C]">Contact & Location</h2>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <!-- 7. Mobile Number -->
                        <div>
                            <label for="mobile_number" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                                7. Mobile Number <span class="text-[#912003]">*</span>
                            </label>
                            <input type="tel" id="mobile_number" name="mobile_number" value="{{ old('mobile_number') }}" required
                                placeholder="10-digit Mobile Number" pattern="[0-9]{10,15}"
                                class="w-full bg-[#FFFDF9] border border-[#DEC7A2] rounded-xl px-4 py-2.5 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003] transition-all">
                        </div>

                        <!-- 8. WhatsApp Number -->
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <label for="whatsapp_number" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14]">
                                    8. WhatsApp Number
                                </label>
                                    <!-- <button type="button" onclick="copyMobileToWhatsapp()" class="text-[10px] text-[#912003] hover:underline cursor-pointer font-semibold">
                                        Same as Mobile
                                    </button> -->
                            </div>
                            <input type="tel" id="whatsapp_number" name="whatsapp_number" value="{{ old('whatsapp_number') }}"
                                placeholder="WhatsApp Number" pattern="[0-9]{10,15}"
                                class="w-full bg-[#FFFDF9] border border-[#DEC7A2] rounded-xl px-4 py-2.5 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003] transition-all">
                        </div>

                        <!-- 9. Pincode -->
                        <div>
                            <label for="pincode" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                                9. Pincode <span class="text-[#912003]">*</span>
                            </label>
                            <input type="text" id="pincode" name="pincode" value="{{ old('pincode') }}" required
                                placeholder="6-digit Pincode" maxlength="6" pattern="[0-9]{6}"
                                class="w-full bg-[#FFFDF9] border border-[#DEC7A2] rounded-xl px-4 py-2.5 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003] transition-all">
                        </div>
                    </div>
                </div>

                <!-- ================= SECTION 4: PROFILE PHOTO & SECURITY ================= -->
                <div class="bg-[#FAF6EC]/80 border border-[#DEC7A2] rounded-2xl p-4 sm:p-6 relative">
                    <div class="flex items-center justify-between border-b border-[#DEC7A2]/60 pb-2.5 mb-4">
                        <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-[#912003] text-white flex items-center justify-center text-xs font-bold font-mono">4</span>
                            <h2 class="font-cinzel text-sm sm:text-base font-bold text-[#1C120C]">Profile / Picture & Password</h2>
                        </div>
                    </div>

                    <!-- 10. Selfie / Profile Photo -->
                    <div class="mb-6">
                        <label class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-2">
                            10. Profile / File Picture
                        </label>
                        
                        <div class="flex flex-col sm:flex-row items-center gap-4 sm:gap-6 bg-[#FFFDF9] border border-dashed border-[#DEC7A2] rounded-2xl p-4">
                            <!-- Preview Box -->
                            <div class="relative w-24 h-24 rounded-2xl bg-[#FAF6EC] border-2 border-[#CA8A04] flex items-center justify-center overflow-hidden shrink-0 shadow-inner group">
                                <img id="photo-preview" src="https://ui-avatars.com/api/?name=Bhakt&background=FAF6EC&color=912003&size=150" alt="Selfie Preview" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/40 text-white opacity-0 group-hover:opacity-100 flex items-center justify-center text-[10px] transition-opacity">
                                    Preview
                                </div>
                            </div>

                            <div class="flex-grow text-center sm:text-left">
                                <input type="file" id="profile_photo" name="profile_photo" accept="image/*" onchange="previewImage(event)" class="hidden">
                                <input type="hidden" name="profile_photo_base64" id="profile_photo_base64">
                                <label for="profile_photo" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-[#912003] hover:bg-[#6C1802] text-[#FFFDF9] font-cinzel font-semibold text-xs cursor-pointer shadow-sm transition-all hover:scale-105">
                                    <span>📷</span>
                                    <span>Upload Profile / Photo</span>
                                </label>
                                <span id="file-name" class="block text-xs text-[#6C1802] mt-1.5 font-medium">JPG, PNG, WEBP (Max 5MB)</span>
                            </div>
                        </div>
                    </div>

                    <!-- Password & Confirmation -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="password" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                                Create Password <span class="text-[#912003]">*</span>
                            </label>
                            <input type="password" id="password" name="password" required minlength="6"
                                placeholder="Minimum 6 characters"
                                class="w-full bg-[#FFFDF9] border border-[#DEC7A2] rounded-xl px-4 py-2.5 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003] transition-all">
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                                Confirm Password <span class="text-[#912003]">*</span>
                            </label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required minlength="6"
                                placeholder="Re-enter password"
                                class="w-full bg-[#FFFDF9] border border-[#DEC7A2] rounded-xl px-4 py-2.5 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003] transition-all">
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center pt-2">
                    <button type="submit" class="shimmer-btn hover-lift w-full sm:w-auto px-10 py-3.5 rounded-full bg-gradient-to-r from-[#912003] via-[#B93815] to-[#912003] hover:from-[#6C1802] text-[#FFFDF9] font-cinzel font-bold text-sm sm:text-base uppercase tracking-widest shadow-[0_10px_25px_rgba(108,24,2,0.3)] border border-[#DEC7A2]/60 transition-all duration-300 hover:scale-105 cursor-pointer">
                        <span>॥ Submit Devotee Registration ॥</span>
                    </button>
                    
                    <p class="text-xs text-[#6C1802] font-marcellus mt-4">
                        Already registered with Shringi Rishi Mandir? 
                        <a href="{{ route('login') }}" class="text-[#912003] font-bold underline hover:text-black">
                            Devotee Login
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <!-- Client-side Helper Script -->
    <script>
        function previewImage(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const file = input.files[0];
                
                // 1. Instant preview via FileReader
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('photo-preview').src = e.target.result;
                };
                reader.readAsDataURL(file);

                // 2. High-speed Canvas compression to Base64 (immunizes against all PHP file upload size limits)
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
                    const base64Input = document.getElementById('profile_photo_base64');
                    if (base64Input) {
                        base64Input.value = base64Data;
                    }

                    const sizeKb = Math.round((base64Data.length * 0.75) / 1024);
                    document.getElementById('file-name').innerText = 'Selected: ' + file.name + ' (~' + sizeKb + ' KB ✓ Ready)';
                };
                img.onerror = function() {
                    document.getElementById('file-name').innerText = 'Selected: ' + file.name;
                };
            }
        }

        function copyMobileToWhatsapp() {
            const mobile = document.getElementById('mobile_number').value;
            if (mobile) {
                document.getElementById('whatsapp_number').value = mobile;
            } else {
                alert('Please enter your mobile number first.');
            }
        }
    </script>
</x-layout>
