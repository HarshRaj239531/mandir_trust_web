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
                    Register
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

            <form id="devotee-register-form" action="{{ route('register') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- Hidden Input for Verified Sponsor Member ID -->
                <input type="hidden" name="sponsor_member_id" id="sponsor_member_id" value="{{ old('sponsor_member_id', $referralCode ?? '') }}">

                <!-- ================= STEP 0: MANDATORY SPONSOR VERIFICATION ================= -->
                <div class="bg-gradient-to-br from-[#FFFDF9] to-[#FAF6EC] border-2 border-[#CA8A04] rounded-2xl p-5 sm:p-6 shadow-sm relative overflow-hidden">
                    <div class="flex items-center justify-between border-b border-[#DEC7A2] pb-3 mb-4">
                        <div class="flex items-center gap-2">
                            <span class="w-7 h-7 rounded-full bg-[#912003] text-white flex items-center justify-center text-xs font-bold font-mono">0</span>
                            <h2 class="font-cinzel text-sm sm:text-base font-bold text-[#1C120C]">
                                स्पॉन्सर सत्यापन (Mandatory Sponsor Confirmation) <span class="text-[#912003]">*</span>
                            </h2>
                        </div>
                        <span class="text-[10px] bg-[#912003]/10 text-[#912003] font-bold px-2.5 py-0.5 rounded-full border border-[#912003]/20 uppercase">
                            Required First
                        </span>
                    </div>

                    <p class="text-xs text-[#6C1802] font-marcellus mb-4">
                        User will enter only the Sponsor ID. As soon as a valid Sponsor ID is entered, the Sponsor Name will automatically appear. Confirm your sponsor to unlock registration.
                    </p>

                    <!-- Sponsor Input & Search Control -->
                    <div id="sponsor-input-container" class="space-y-3">
                        <div class="flex flex-col sm:flex-row gap-3 items-stretch sm:items-center">
                            <div class="relative flex-grow">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-xs text-[#A16207] font-mono font-bold">
                                    ID
                                </span>
                                <input type="text" id="sponsor_id_input" 
                                    value="{{ old('sponsor_member_id', $referralCode ?? '') }}"
                                    placeholder="Enter Sponsor ID"
                                    class="w-full uppercase font-mono tracking-wider bg-white border border-[#DEC7A2] rounded-xl pl-10 pr-4 py-2.5 text-sm text-[#1C120C] font-semibold focus:outline-none focus:border-[#912003] focus:ring-1 focus:ring-[#912003] transition-all">
                            </div>
                            <button type="button" id="btn-verify-sponsor" onclick="verifySponsorId()" class="px-6 py-2.5 rounded-xl bg-[#912003] hover:bg-[#6C1802] text-[#FFFDF9] font-cinzel text-xs font-bold uppercase tracking-wider transition-all shadow-sm cursor-pointer shrink-0">
                                <span>Verify Sponsor</span>
                            </button>
                        </div>

                        <!-- Sample / Master Sponsor Quick Fill (For convenience) -->
                        <!-- <div class="flex flex-wrap items-center gap-1.5 pt-1 text-[11px] text-[#6C1802]">
                            <span class="font-semibold text-[#A16207]">Sample Master Sponsors:</span>
                            <button type="button" onclick="setQuickSponsor('DS101010101010')" class="px-2 py-0.5 rounded bg-white hover:bg-[#FAF6EC] border border-[#DEC7A2] font-mono text-[10px] text-[#912003] font-bold cursor-pointer">
                                DS101010101010
                            </button>
                            <button type="button" onclick="setQuickSponsor('DS100100100100')" class="px-2 py-0.5 rounded bg-white hover:bg-[#FAF6EC] border border-[#DEC7A2] font-mono text-[10px] text-[#912003] font-bold cursor-pointer">
                                DS100100100100
                            </button>
                            <button type="button" onclick="setQuickSponsor('DS100010001000')" class="px-2 py-0.5 rounded bg-white hover:bg-[#FAF6EC] border border-[#DEC7A2] font-mono text-[10px] text-[#912003] font-bold cursor-pointer">
                                DS100010001000
                            </button>
                        </div> -->
                    </div>

                    <!-- Sponsor Checking Spinner -->
                    <div id="sponsor-loading" class="hidden my-3 p-3 bg-white/80 rounded-xl border border-[#DEC7A2] text-xs text-[#912003] font-medium flex items-center gap-2">
                        <span class="animate-spin text-base">⏳</span>
                        <span>Verifying Sponsor ID with Mandir Trust database...</span>
                    </div>

                    <!-- Sponsor Error Message -->
                    <div id="sponsor-error" class="hidden my-3 p-3 rounded-xl bg-red-50 border border-red-200 text-red-800 text-xs font-medium flex items-center justify-between">
                        <span id="sponsor-error-text">Sponsor ID not found. Please recheck.</span>
                        <button type="button" onclick="document.getElementById('sponsor-error').classList.add('hidden')" class="text-red-700 font-bold ml-2">✕</button>
                    </div>

                    <!-- Sponsor Found & Awaiting Confirmation Card -->
                    <div id="sponsor-found-card" class="hidden my-4 p-4 rounded-2xl bg-gradient-to-r from-[#FAF6EC] via-white to-[#FAF6EC] border-2 border-[#CA8A04] shadow-md">
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div class="flex items-center gap-3.5">
                                <div class="w-14 h-14 rounded-full border-2 border-[#912003] overflow-hidden shrink-0 bg-white p-0.5 shadow-xs">
                                    <img id="sponsor-photo" src="https://ui-avatars.com/api/?name=Sponsor&background=912003&color=FFFDF9" alt="Sponsor" class="w-full h-full object-cover rounded-full">
                                </div>
                                <div>
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-[#A16207] bg-white px-2 py-0.5 rounded-full border border-[#DEC7A2]">
                                        Sponsor Found
                                    </span>
                                    <h4 id="sponsor-name" class="font-cinzel text-base sm:text-lg font-black text-[#912003] mt-0.5">
                                        DS SWAMI JEE
                                    </h4>
                                    <p class="text-xs text-[#422B1E] font-mono">
                                        Sponsor ID: <span id="sponsor-id-display" class="font-bold text-[#1C120C]">DS101010101010</span>
                                    </p>
                                </div>
                            </div>

                            <button type="button" onclick="confirmSponsor()" class="w-full sm:w-auto px-6 py-3 rounded-xl font-cinzel font-bold text-xs sm:text-sm uppercase tracking-wider shadow-md hover:shadow-lg transition-all hover:scale-105 cursor-pointer flex items-center justify-center gap-2 border border-emerald-800" style="background: linear-gradient(135deg, #15803d 0%, #166534 100%) !important; color: #ffffff !important;">
                                <span style="color: #ffffff !important;">✓ Confirm Sponsor &amp; Proceed</span>
                            </button>
                        </div>
                    </div>

                    <!-- Sponsor Confirmed Badge -->
                    <div id="sponsor-confirmed-badge" class="hidden my-3 p-3.5 rounded-xl bg-emerald-50 border border-emerald-300 text-emerald-900 text-xs flex flex-col sm:flex-row sm:items-center justify-between gap-2 shadow-xs">
                        <div class="flex items-center gap-2">
                            <span class="text-base">✅</span>
                            <div>
                                <span class="font-bold">Sponsor Confirmed:</span>
                                <strong id="confirmed-sponsor-name" class="text-emerald-950 font-cinzel">DS SWAMI JEE</strong>
                                <span class="font-mono text-emerald-800 ml-1">(<span id="confirmed-sponsor-id">DS101010101010</span>)</span>
                            </div>
                        </div>
                        <button type="button" onclick="resetSponsor()" class="text-xs text-[#912003] hover:underline font-semibold cursor-pointer shrink-0">
                            Change Sponsor
                        </button>
                    </div>
                </div>

                <!-- ================= REGISTRATION FORM WRAPPER (UNLOCKED AFTER SPONSOR CONFIRMATION) ================= -->
                <div id="form-sections-wrapper" class="space-y-8 opacity-40 pointer-events-none transition-opacity duration-300">
                    
                    <div id="sponsor-lock-notice" class="p-3.5 rounded-xl bg-[#FAF6EC] border border-[#CA8A04]/60 text-xs text-[#912003] font-medium text-center font-marcellus">
                        🔒 कृपया पहले ऊपर अपना Sponsor ID दर्ज करके <strong>"Confirm Sponsor & Proceed"</strong> पर क्लिक करें। उसके बाद ही पंजीकरण फॉर्म सक्रिय होगा।
                    </div>

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
                                    1. Full Name (Legal Name) <span class="text-[#912003]">*</span>
                                </label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                    placeholder="e.g. Harsh Raj Kumar"
                                    class="w-full bg-[#FFFDF9] border border-[#DEC7A2] rounded-xl px-4 py-2.5 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003] focus:ring-1 focus:ring-[#912003] transition-all">
                                <span class="text-[10px] text-[#6C1802] mt-0.5 block">Official name. Visible to Admin & account. Cannot be changed by user later.</span>
                            </div>

                            <!-- 2. Nick Name (Public Screen Name) -->
                            <div>
                                <label for="nickname" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                                    2. Nick Name (Display Name) <span class="text-[#912003]">*</span>
                                </label>
                                <input type="text" id="nickname" name="nickname" value="{{ old('nickname') }}" required
                                    placeholder="e.g. Harry"
                                    class="w-full bg-[#FFFDF9] border border-[#DEC7A2] rounded-xl px-4 py-2.5 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003] focus:ring-1 focus:ring-[#912003] transition-all">
                                <span class="text-[10px] text-[#6C1802] mt-0.5 block">Visible to other users on mobile. User can update from time to time.</span>
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
                                    class="w-full bg-[#FFFDF9] border border-[#DEC7A2] rounded-xl px-4 py-2.5 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003] transition-all">
                            </div>

                            <!-- 4. Gender -->
                            <div>
                                <label for="gender" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                                    4. Gender <span class="text-[#912003]">*</span>
                                </label>
                                <select id="gender" name="gender" required
                                    class="w-full bg-[#FFFDF9] border border-[#DEC7A2] rounded-xl px-3 py-2.5 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003] transition-all">
                                    <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select...</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male (पुरुष)</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female (महिला)</option>
                                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other (अन्य)</option>
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
                                <h2 class="font-cinzel text-sm sm:text-base font-bold text-[#1C120C]">Profile Picture & Password</h2>
                            </div>
                        </div>

                        <!-- 10. Selfie / Profile Photo -->
                        <div class="mb-6">
                            <label class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-2">
                                10. Selfie / Profile Picture (Updatable by User)
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
                                        <span>Upload Selfie / Photo</span>
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
                        <button type="submit" id="btn-submit-register" class="shimmer-btn hover-lift w-full sm:w-auto px-10 py-3.5 rounded-full font-cinzel font-bold text-sm sm:text-base uppercase tracking-widest shadow-[0_10px_25px_rgba(108,24,2,0.3)] border border-[#DEC7A2]/60 transition-all duration-300 hover:scale-105 cursor-pointer" style="background: linear-gradient(135deg, #912003 0%, #B93815 50%, #912003 100%) !important; color: #FFFDF9 !important;">
                            <span style="color: #FFFDF9 !important;">॥ Submit Devotee Registration ॥</span>
                        </button>
                        
                        <p class="text-xs text-[#6C1802] font-marcellus mt-4">
                            Already registered with Shringi Rishi Mandir? 
                            <a href="{{ route('login') }}" class="text-[#912003] font-bold underline hover:text-black">
                                Devotee Login
                            </a>
                        </p>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <!-- Client-side Sponsor Verification & Photo Helper Script -->
    <script>
        let currentVerifiedSponsor = null;

        // Quick button to set master sponsor
        function setQuickSponsor(id) {
            const input = document.getElementById('sponsor_id_input');
            if (input) {
                input.value = id;
                verifySponsorId();
            }
        }

        // Live verify Sponsor ID
        async function verifySponsorId() {
            const input = document.getElementById('sponsor_id_input');
            const sponsorId = (input.value || '').trim().toUpperCase();

            const loading = document.getElementById('sponsor-loading');
            const errorBox = document.getElementById('sponsor-error');
            const errorText = document.getElementById('sponsor-error-text');
            const foundCard = document.getElementById('sponsor-found-card');
            const confirmedBadge = document.getElementById('sponsor-confirmed-badge');

            errorBox.classList.add('hidden');
            foundCard.classList.add('hidden');
            confirmedBadge.classList.add('hidden');

            if (!sponsorId) {
                errorText.innerText = 'Please enter a Sponsor ID (e.g. DS101010101010).';
                errorBox.classList.remove('hidden');
                return;
            }

            loading.classList.remove('hidden');

            try {
                const response = await fetch(`/verify-sponsor?sponsor_id=${encodeURIComponent(sponsorId)}`, {
                    headers: { 'Accept': 'application/json' }
                });
                const data = await response.json();

                loading.classList.add('hidden');

                if (response.ok && data.success) {
                    currentVerifiedSponsor = data.sponsor;
                    document.getElementById('sponsor-name').innerText = data.sponsor.name;
                    document.getElementById('sponsor-id-display').innerText = data.sponsor.member_id;
                    if (data.sponsor.profile_photo_url) {
                        document.getElementById('sponsor-photo').src = data.sponsor.profile_photo_url;
                    }
                    foundCard.classList.remove('hidden');
                } else {
                    currentVerifiedSponsor = null;
                    errorText.innerText = data.message || 'Sponsor ID not found or inactive.';
                    errorBox.classList.remove('hidden');
                }
            } catch (err) {
                loading.classList.add('hidden');
                errorText.innerText = 'Network error while verifying sponsor. Please try again.';
                errorBox.classList.remove('hidden');
            }
        }

        // Confirm Sponsor & Unlock Registration Form
        function confirmSponsor() {
            if (!currentVerifiedSponsor) return;

            document.getElementById('sponsor_member_id').value = currentVerifiedSponsor.member_id;
            document.getElementById('confirmed-sponsor-name').innerText = currentVerifiedSponsor.name;
            document.getElementById('confirmed-sponsor-id').innerText = currentVerifiedSponsor.member_id;

            // Hide found card, show confirmed badge
            document.getElementById('sponsor-found-card').classList.add('hidden');
            document.getElementById('sponsor-confirmed-badge').classList.remove('hidden');
            document.getElementById('sponsor-input-container').classList.add('hidden');

            // Unlock the form wrapper
            const formWrapper = document.getElementById('form-sections-wrapper');
            formWrapper.classList.remove('opacity-40', 'pointer-events-none');
            const lockNotice = document.getElementById('sponsor-lock-notice');
            if (lockNotice) {
                lockNotice.classList.add('hidden');
            }
        }

        // Reset Sponsor Selection
        function resetSponsor() {
            currentVerifiedSponsor = null;
            document.getElementById('sponsor_member_id').value = '';
            document.getElementById('sponsor-confirmed-badge').classList.add('hidden');
            document.getElementById('sponsor-found-card').classList.add('hidden');
            document.getElementById('sponsor-input-container').classList.remove('hidden');

            // Re-lock the form wrapper
            const formWrapper = document.getElementById('form-sections-wrapper');
            formWrapper.classList.add('opacity-40', 'pointer-events-none');
            const lockNotice = document.getElementById('sponsor-lock-notice');
            if (lockNotice) {
                lockNotice.classList.remove('hidden');
            }
        }

        // Auto verify on page load if sponsor ID was provided via ref parameter or old()
        document.addEventListener('DOMContentLoaded', function() {
            const initialId = document.getElementById('sponsor_id_input').value.trim();
            if (initialId) {
                verifySponsorId().then(() => {
                    if (currentVerifiedSponsor) {
                        confirmSponsor();
                    }
                });
            }
        });

        // Photo Upload & Preview
        function previewImage(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const file = input.files[0];
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('photo-preview').src = e.target.result;
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
    </script>
</x-layout>
