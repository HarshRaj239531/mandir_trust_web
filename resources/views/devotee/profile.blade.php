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
                        <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2 mb-1">
                            <span class="inline-block text-[11px] uppercase tracking-widest text-[#912003] font-bold bg-[#912003]/10 px-2.5 py-0.5 rounded-full">
                                ॥ Certified Devotee ॥
                            </span>
                            
                            <!-- Member ID Badge -->
                            <div class="inline-flex items-center gap-1.5 bg-[#FAF6EC] border border-[#CA8A04] px-2.5 py-0.5 rounded-full font-mono text-xs font-bold text-[#1C120C]">
                                <span class="text-[#A16207]">ID:</span>
                                <span>{{ $user->member_id ?? 'DS101010101010' }}</span>
                                <button type="button" onclick="copyText('{{ $user->member_id }}', 'Member ID copied!')" class="text-[10px] text-[#912003] hover:text-black font-sans cursor-pointer ml-1" title="Copy Member ID">
                                    📋
                                </button>
                            </div>
                        </div>

                        <h1 class="font-cinzel text-2xl sm:text-3xl font-black text-[#1C120C]">
                            {{ $user->nickname }}
                        </h1>
                        <p class="font-marcellus text-xs text-[#6C1802] mt-0.5">
                            Real Legal Name: <span class="font-semibold text-[#1C120C]">{{ $user->name }}</span>
                            @if ($user->sponsor)
                                • Introduced by Sponsor: <span class="font-bold text-[#912003]">{{ $user->sponsor->name }} ({{ $user->sponsor->member_id }})</span>
                            @endif
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

            <!-- ================= MLM 3-SHARE PARIVAR & REFERRAL HUB ================= -->
            <div class="parchment-scroll royal-gold-frame rounded-3xl p-6 sm:p-8 border-2 border-[#CA8A04] shadow-md relative overflow-hidden space-y-6">
                <x-gold-corners size="w-7 h-7 sm:w-8 sm:h-8" />

                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-[#DEC7A2] pb-4">
                    <div>
                        <span class="text-[10px] uppercase font-bold tracking-wider text-[#A16207] bg-[#FAF6EC] px-2.5 py-0.5 rounded-full border border-[#DEC7A2]">
                            🌿 Sacred Network • 3-Share MLM Process
                        </span>
                        <h2 class="font-cinzel text-xl sm:text-2xl font-black text-[#1C120C] mt-1">
                            भक्त परिवार नेटवर्क (Devotee 3-Share Tree)
                        </h2>
                        <p class="text-xs text-[#6C1802] font-marcellus mt-0.5">
                            Share with 3 devotees. When each shares with 3 more, the sacred spiritual network expands (1 ➔ 3 ➔ 9 ➔ 27).
                        </p>
                    </div>

                    <!-- 3-Share Goal Badge -->
                    <div class="flex items-center gap-3 bg-[#FAF6EC] border border-[#DEC7A2] rounded-2xl p-3 px-4 shrink-0">
                        <div class="w-12 h-12 rounded-xl bg-[#912003] text-white flex flex-col items-center justify-center font-bold">
                            <span class="text-lg leading-none font-cinzel">{{ $directReferralsCount }}</span>
                            <span class="text-[8px] uppercase tracking-wider text-amber-200">/ 3 Goal</span>
                        </div>
                        <div>
                            <span class="block text-xs font-bold font-cinzel text-[#1C120C]">Direct Referrals</span>
                            <span class="text-[11px] text-[#6C1802]">
                                @if ($directReferralsCount >= 3)
                                    <span class="text-emerald-700 font-bold">🎉 3-Share Goal Achieved!</span>
                                @else
                                    <span>Refer {{ 3 - $directReferralsCount }} more devotees to complete</span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Referral Sharing Hub -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 bg-[#FAF6EC]/70 rounded-2xl p-5 border border-[#DEC7A2]">
                    <div class="lg:col-span-2 space-y-2">
                        <label class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] font-cinzel">
                            Your Sacred Referral Link (आपकी स्पॉन्सर लिंक)
                        </label>
                        <div class="flex items-center gap-2">
                            <input type="text" id="referral-link" readonly 
                                value="{{ route('register', ['ref' => $user->member_id]) }}"
                                class="w-full bg-white border border-[#DEC7A2] rounded-xl px-4 py-2.5 text-xs sm:text-sm font-mono text-[#1C120C] focus:outline-none select-all">
                            <button type="button" onclick="copyReferralLink()" class="px-5 py-2.5 rounded-xl bg-[#912003] hover:bg-[#6C1802] text-white font-cinzel text-xs font-bold uppercase tracking-wider shrink-0 shadow-sm transition-all hover:scale-105 cursor-pointer">
                                <span id="copy-btn-text">Copy Link</span>
                            </button>
                        </div>
                        <p class="text-[11px] text-[#6C1802]">
                            Devotees who open this link will automatically have your Sponsor ID (<strong>{{ $user->member_id }}</strong>) verified and confirmed.
                        </p>
                    </div>

                    <!-- WhatsApp Share Button -->
                    <div class="flex flex-col justify-center space-y-2 border-t lg:border-t-0 lg:border-l border-[#DEC7A2]/80 lg:pl-6 pt-4 lg:pt-0">
                        <label class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] font-cinzel">
                            Direct WhatsApp Share
                        </label>
                        @php
                            $waMessage = urlencode("॥ ॐ नमः शिवाय ॥\nShringi Rishi Mandir Trust se judein aur Pavitra Seva me sammilithon.\nMera Sponsor ID: {$user->member_id} ({$user->nickname})\nDirect Register Link: " . route('register', ['ref' => $user->member_id]));
                        @endphp
                        <a href="https://api.whatsapp.com/send?text={{ $waMessage }}" target="_blank" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-cinzel text-xs font-bold uppercase tracking-wider shadow-sm transition-all hover:scale-105">
                            <span>💬</span>
                            <span>Share with 3 Friends on WhatsApp</span>
                        </a>
                    </div>
                </div>

                <!-- MLM Tree / Downline Roster Tabs -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between border-b border-[#DEC7A2] pb-2">
                        <h3 class="font-cinzel text-base font-bold text-[#1C120C] flex items-center gap-2">
                            <span>🌳</span> <span>Downline Devotee Network</span>
                        </h3>
                        <span class="text-xs font-mono font-bold text-[#912003] bg-white px-3 py-1 rounded-full border border-[#DEC7A2]">
                            Total Network: {{ $totalTeamCount }} Devotees
                        </span>
                    </div>

                    <!-- Level 1: Direct 3 Shares -->
                    <div>
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-5 h-5 rounded-full bg-[#912003] text-white flex items-center justify-center text-[10px] font-bold">1</span>
                            <h4 class="font-cinzel text-xs sm:text-sm font-bold text-[#1C120C]">
                                Level 1: Direct Referrals (Your 3 Shares) • ({{ count($genealogyTree[1] ?? []) }} Members)
                            </h4>
                        </div>

                        @if (isset($genealogyTree[1]) && count($genealogyTree[1]) > 0)
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach ($genealogyTree[1] as $subUser)
                                    <div class="p-4 rounded-2xl bg-white border border-[#DEC7A2] shadow-2xs flex items-center gap-3.5 hover:border-[#CA8A04] transition-all">
                                        <div class="w-12 h-12 rounded-xl border border-[#DEC7A2] overflow-hidden shrink-0 bg-[#FAF6EC]">
                                            <img src="{{ $subUser->profile_photo_url }}" alt="{{ $subUser->nickname }}" class="w-full h-full object-cover">
                                        </div>
                                        <div class="flex-grow min-w-0">
                                            <div class="flex items-center justify-between gap-1">
                                                <h5 class="font-cinzel text-sm font-bold text-[#912003] truncate">
                                                    {{ $subUser->nickname }}
                                                </h5>
                                                <span class="text-[9px] bg-emerald-100 text-emerald-800 font-bold px-1.5 py-0.2 rounded">Active</span>
                                            </div>
                                            <p class="font-mono text-[11px] text-[#1C120C] font-semibold">
                                                {{ $subUser->member_id }}
                                            </p>
                                            <p class="text-[10px] text-[#6C1802] mt-0.5">
                                                Joined {{ $subUser->created_at->format('d M, Y') }} • Referrals: {{ $subUser->referrals()->count() }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-6 rounded-2xl bg-[#FAF6EC] border border-dashed border-[#DEC7A2] text-center space-y-2">
                                <p class="text-xs text-[#6C1802] font-marcellus">
                                    Aapne abhi tak kisi bhakt ko refer nahi kiya hai. Upar diye gaye <strong>Referral Link</strong> ko apne 3 mitron ke sath share karein!
                                </p>
                            </div>
                        @endif
                    </div>

                    <!-- Level 2: Downline from Level 1 (Target 9) -->
                    @if (isset($genealogyTree[2]) && count($genealogyTree[2]) > 0)
                        <div class="pt-2">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="w-5 h-5 rounded-full bg-[#CA8A04] text-white flex items-center justify-center text-[10px] font-bold">2</span>
                                <h4 class="font-cinzel text-xs sm:text-sm font-bold text-[#1C120C]">
                                    Level 2: Downline Referrals (Target 9) • ({{ count($genealogyTree[2]) }} Members)
                                </h4>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                                @foreach ($genealogyTree[2] as $lvl2User)
                                    <div class="p-3 rounded-xl bg-[#FAF6EC]/80 border border-[#DEC7A2] flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-lg overflow-hidden shrink-0 border border-[#DEC7A2]">
                                            <img src="{{ $lvl2User->profile_photo_url }}" alt="{{ $lvl2User->nickname }}" class="w-full h-full object-cover">
                                        </div>
                                        <div class="min-w-0">
                                            <h6 class="font-cinzel text-xs font-bold text-[#1C120C] truncate">{{ $lvl2User->nickname }}</h6>
                                            <span class="font-mono text-[10px] text-[#912003] block">{{ $lvl2User->member_id }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- ================= DEVOTEE PROFILE DETAILS & EDITABLE FORM ================= -->
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
                                Dusre bhakton ke mobile me aapka Display Name aur Photo show hogi
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

                            <p class="font-mono text-xs font-bold text-[#1C120C] mt-0.5">
                                {{ $user->member_id }}
                            </p>

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
                            <p>Aapka Real Legal Name sirf aapke account aur Mandir Admin Panel me hi surakshit rehta hai.</p>
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

                <!-- Right Column: Locked Fields & Devotee Editable Form -->
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
                                <strong>Mandir Trust Privacy & Security Policy:</strong> Real Name (1), Mother's Name (3), Gender (4), DOB (5), Gmail (6), Mobile (7), WhatsApp (8), aur Pincode (9) registration ke baad devotee dwara change nahi kiye ja sakte. Inme kisi sanshodhan ke liye Mandir Admin se sampark karein.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- 1. Real Name (Locked) -->
                            <div class="bg-[#FFFDF9] p-3.5 rounded-xl border border-[#DEC7A2]/60">
                                <span class="block text-[10px] font-bold uppercase tracking-wider text-[#A16207]">1. Real / Legal Name</span>
                                <span class="font-semibold text-sm text-[#1C120C] block mt-0.5">{{ $user->name }}</span>
                                <span class="text-[9px] text-[#6C1802] font-mono">🔒 Admin Only</span>
                            </div>

                            <!-- 3. Mother's Name (Locked) -->
                            <div class="bg-[#FFFDF9] p-3.5 rounded-xl border border-[#DEC7A2]/60">
                                <span class="block text-[10px] font-bold uppercase tracking-wider text-[#A16207]">3. Mother's Name</span>
                                <span class="font-semibold text-sm text-[#1C120C] block mt-0.5">{{ $user->mother_name }}</span>
                                <span class="text-[9px] text-[#6C1802] font-mono">🔒 Admin Only</span>
                            </div>

                            <!-- 4. Gender (Locked) -->
                            <div class="bg-[#FFFDF9] p-3.5 rounded-xl border border-[#DEC7A2]/60">
                                <span class="block text-[10px] font-bold uppercase tracking-wider text-[#A16207]">4. Gender (लिंग)</span>
                                <span class="font-semibold text-sm text-[#1C120C] block mt-0.5 capitalize">{{ $user->gender }}</span>
                                <span class="text-[9px] text-[#6C1802] font-mono">🔒 Admin Only</span>
                            </div>

                            <!-- 5. DOB (Locked) -->
                            <div class="bg-[#FFFDF9] p-3.5 rounded-xl border border-[#DEC7A2]/60">
                                <span class="block text-[10px] font-bold uppercase tracking-wider text-[#A16207]">5. Date of Birth (जन्मतिथि)</span>
                                <span class="font-semibold text-sm text-[#1C120C] block mt-0.5">{{ $user->dob ? $user->dob->format('d M, Y') : 'N/A' }}</span>
                                <span class="text-[9px] text-[#6C1802] font-mono">🔒 Admin Only</span>
                            </div>

                            <!-- 6. Gmail / Email (Locked) -->
                            <div class="sm:col-span-2 bg-[#FFFDF9] p-3.5 rounded-xl border border-[#DEC7A2]/60">
                                <span class="block text-[10px] font-bold uppercase tracking-wider text-[#A16207]">6. Registered Gmail / Email</span>
                                <span class="font-semibold text-sm text-[#1C120C] block mt-0.5 font-mono">{{ $user->email ?: 'Not Provided (ऐच्छिक / खाली)' }}</span>
                                <span class="text-[9px] text-[#6C1802] font-mono">🔒 Admin Only</span>
                            </div>

                            <!-- 7. Mobile Number (Locked) -->
                            <div class="bg-[#FFFDF9] p-3.5 rounded-xl border border-[#DEC7A2]/60">
                                <span class="block text-[10px] font-bold uppercase tracking-wider text-[#A16207]">7. Mobile Number</span>
                                <span class="font-semibold text-sm text-[#1C120C] block mt-0.5 font-mono">📞 {{ $user->mobile_number }}</span>
                                <span class="text-[9px] text-[#6C1802] font-mono">🔒 Admin Only</span>
                            </div>

                            <!-- 8. WhatsApp Number (Locked) -->
                            <div class="bg-[#FFFDF9] p-3.5 rounded-xl border border-[#DEC7A2]/60">
                                <span class="block text-[10px] font-bold uppercase tracking-wider text-[#A16207]">8. WhatsApp Number</span>
                                <span class="font-semibold text-sm text-[#1C120C] block mt-0.5 font-mono">💬 {{ $user->whatsapp_number ?? $user->mobile_number }}</span>
                                <span class="text-[9px] text-[#6C1802] font-mono">🔒 Admin Only</span>
                            </div>

                            <!-- 9. Pincode (Locked) -->
                            <div class="sm:col-span-2 bg-[#FFFDF9] p-3.5 rounded-xl border border-[#DEC7A2]/60">
                                <span class="block text-[10px] font-bold uppercase tracking-wider text-[#A16207]">9. Area Pincode</span>
                                <span class="font-semibold text-sm text-[#1C120C] block mt-0.5 font-mono">📍 {{ $user->pincode }}</span>
                                <span class="text-[9px] text-[#6C1802] font-mono">🔒 Admin Only</span>
                            </div>
                        </div>
                    </div>


                    <!-- ================= 2. EDITABLE PROFILE FORM (NICKNAME & SELFIE ONLY) ================= -->
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
                                Nickname & Photo Updatable
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
                                        <span class="block text-[11px] text-[#6C1802] mt-1">Devotee can update picture from time to time</span>
                                    </div>
                                </div>
                            </div>

                            <!-- 2. Nick Name (Devotee choice) -->
                            <div>
                                <label for="nickname" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                                    2. Nick Name (भक्त नाम / Public Screen Name) <span class="text-[#912003]">*</span>
                                </label>
                                <input type="text" id="nickname" name="nickname" value="{{ old('nickname', $user->nickname) }}" required
                                    class="w-full bg-[#FFFDF9] border border-[#DEC7A2] rounded-xl px-4 py-2.5 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003] transition-all">
                                <span class="text-[11px] text-[#6C1802] mt-0.5 block">This is your public handle seen by other devotees on mobile screens.</span>
                            </div>

                            <!-- Optional Change Password Accordion -->
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

    <!-- Quick Copy Helper & Photo Preview Script -->
    <script>
        function copyReferralLink() {
            const linkInput = document.getElementById('referral-link');
            linkInput.select();
            linkInput.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(linkInput.value).then(() => {
                const btnText = document.getElementById('copy-btn-text');
                btnText.innerText = 'Copied! ✓';
                setTimeout(() => {
                    btnText.innerText = 'Copy Link';
                }, 2500);
            });
        }

        function copyText(text, alertMsg) {
            navigator.clipboard.writeText(text).then(() => {
                alert(alertMsg || 'Copied to clipboard!');
            });
        }

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
