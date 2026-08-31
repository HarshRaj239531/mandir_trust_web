<x-layout title="Pavitra Daan & Seva Sankalpa | 80G Tax Exempt | Shri Mandir Trust">
    <x-navbar />

    <!-- Page Header (Ancient Scroll Inscription) -->
    <section class="relative pt-8 sm:pt-12 pb-12 sm:pb-16 overflow-hidden">
        <div class="container mx-auto px-6 relative z-10 text-center max-w-4xl reveal-fade-up">
            <div class="parchment-scroll p-8 sm:p-12 rounded-3xl antique-border shadow-xl hover-lift relative overflow-hidden group">
                <!-- User Provided Vintage Floral Corner Ornaments -->
                <x-vintage-corner position="top-right" size="w-20 h-20 sm:w-28 sm:h-28" />
                <x-vintage-corner position="top-left" size="w-20 h-20 sm:w-28 sm:h-28" />

                <div class="text-xs uppercase tracking-[0.3em] font-marcellus text-[#912003] font-bold mb-2 animate-float-gentle relative z-10">
                    ॥ गुप्त दान • महापुण्य • ८०जी कर मुक्ति ॥
                </div>
                <h1 class="font-cinzel text-3xl sm:text-5xl font-bold text-[#1C120C] mb-4 relative z-10">
                    Pavitra Seva & <br><span class="gold-leaf-text">Daan Sankalpa Patra</span>
                </h1>
                <div class="sacred-divider relative z-10">
                    <span class="animate-flame">🪷 ॐ 🪷</span>
                </div>
                <p class="font-marcellus text-base sm:text-lg text-[#782606] italic max-w-2xl mx-auto relative z-10">
                    "दानेन भूतानि वशीभवन्ति दानेन वैराण्यपि यान्ति नाशम् ।" <br>
                    <span class="text-xs font-sans text-[#422B1E] not-italic block mt-1">Through selfless giving, all beings are uplifted and divine peace is attained.</span>
                </p>
            </div>
        </div>
    </section>

    <!-- Main Donation Interactive Engine (Parchment Charter) -->
    <section class="py-16 bg-[#FAF6EC] border-y border-[#DEC7A2]/60">
        <div class="container mx-auto px-6 md:px-12 max-w-5xl">
            
            <div class="parchment-scroll p-6 sm:p-10 md:p-12 rounded-3xl antique-border shadow-2xl grid grid-cols-1 lg:grid-cols-12 gap-10 hover-lift reveal-scale-in">
                
                <!-- Left: Cause Selection & Seva Vow (5 cols) -->
                <div class="lg:col-span-5 space-y-6 reveal-fade-left">
                    <div>
                        <span class="text-xs uppercase font-marcellus tracking-widest text-[#912003] font-bold block mb-1">प्रथम चरण</span>
                        <h3 class="font-cinzel text-2xl font-bold text-[#1C120C]">Choose Sacred Seva</h3>
                    </div>

                    <div class="space-y-3 text-xs sm:text-sm">
                        <label onclick="updateImpact('Feeds 5,000+ daily pilgrims with fresh, hot sattvic Mahaprasadam.')" class="seva-option flex items-start gap-3 p-3.5 rounded-2xl border border-[#912003] bg-[#FAF6EC] cursor-pointer transition-all hover:scale-[1.02]">
                            <input type="radio" name="seva_cause" value="Annadanam" checked class="mt-1 text-[#912003] focus:ring-[#912003]">
                            <div>
                                <h4 class="font-cinzel font-bold text-[#1C120C]">Maha Annadanam</h4>
                                <p class="text-xs text-[#5C3C2A] mt-0.5 font-normal">Sponsor daily free food for devotees.</p>
                            </div>
                        </label>

                        <label onclick="updateImpact('Provides green fodder, jaggery, and veterinary care to 500+ Gir cows.')" class="seva-option flex items-start gap-3 p-3.5 rounded-2xl border border-[#DEC7A2] hover:border-[#912003] bg-[#FFFDF9] cursor-pointer transition-all hover:scale-[1.02]">
                            <input type="radio" name="seva_cause" value="Gau Seva" class="mt-1 text-[#912003] focus:ring-[#912003]">
                            <div>
                                <h4 class="font-cinzel font-bold text-[#1C120C]">Surabhi Gau Seva</h4>
                                <p class="text-xs text-[#5C3C2A] mt-0.5 font-normal">Fodder & healthcare for sacred indigenous cows.</p>
                            </div>
                        </label>

                        <label onclick="updateImpact('Funds Sanskrit scriptures, boarding, and books for young Vedic students.')" class="seva-option flex items-start gap-3 p-3.5 rounded-2xl border border-[#DEC7A2] hover:border-[#912003] bg-[#FFFDF9] cursor-pointer transition-all hover:scale-[1.02]">
                            <input type="radio" name="seva_cause" value="Vidyadaan" class="mt-1 text-[#912003] focus:ring-[#912003]">
                            <div>
                                <h4 class="font-cinzel font-bold text-[#1C120C]">Veda Vidyapeeth & Gurukula</h4>
                                <p class="text-xs text-[#5C3C2A] mt-0.5 font-normal">Sponsor traditional Sanskrit Vedic schooling.</p>
                            </div>
                        </label>

                        <label onclick="updateImpact('Maintains temple Akhand Diya pure ghee supply and heritage sandstone upkeep.')" class="seva-option flex items-start gap-3 p-3.5 rounded-2xl border border-[#DEC7A2] hover:border-[#912003] bg-[#FFFDF9] cursor-pointer transition-all hover:scale-[1.02]">
                            <input type="radio" name="seva_cause" value="Nirman" class="mt-1 text-[#912003] focus:ring-[#912003]">
                            <div>
                                <h4 class="font-cinzel font-bold text-[#1C120C]">Akhand Jyoti & Mandir Preservation</h4>
                                <p class="text-xs text-[#5C3C2A] mt-0.5 font-normal">Pure cow ghee for perpetual lamp & stone care.</p>
                            </div>
                        </label>
                    </div>

                    <div class="bg-[#FAF6EC] p-4 rounded-2xl border border-[#DEC7A2] transition-all hover:border-[#912003]">
                        <span class="text-[10px] uppercase tracking-widest text-[#912003] font-bold block mb-1">Divine Impact:</span>
                        <p id="impact-description" class="text-xs text-[#422B1E] font-medium leading-relaxed transition-all duration-300">
                            Feeds 5,000+ daily pilgrims with fresh, hot sattvic Mahaprasadam.
                        </p>
                    </div>

                    <div class="text-[11px] text-[#5C3C2A] space-y-1">
                        <p class="font-bold text-[#912003]">📜 80G Tax Exemption Certificate emailed immediately.</p>
                        <p>🔒 100% Encrypted & Govt Compliant Charitable Account.</p>
                    </div>
                </div>

                <!-- Right: Offering Amount & Donor Details (7 cols) -->
                <div class="lg:col-span-7 space-y-6 reveal-fade-right">
                    <div>
                        <span class="text-xs uppercase font-marcellus tracking-widest text-[#912003] font-bold block mb-1">द्वितीय चरण</span>
                        <h3 class="font-cinzel text-2xl font-bold text-[#1C120C]">Select Daan Offering</h3>
                    </div>

                    <!-- Preset Amount Grid -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5">
                        <button type="button" onclick="selectPresetAmt(501)" class="amt-btn py-3 rounded-xl border border-[#DEC7A2] bg-[#FAF6EC] hover:bg-[#912003] text-[#422B1E] hover:text-white font-cinzel font-bold text-sm transition-all hover:scale-105 cursor-pointer">
                            ₹ 501
                        </button>
                        <button type="button" onclick="selectPresetAmt(1100)" class="amt-btn py-3 rounded-xl border border-[#912003] bg-[#912003] text-white font-cinzel font-bold text-sm transition-all scale-105 cursor-pointer shadow-sm">
                            ₹ 1,100
                        </button>
                        <button type="button" onclick="selectPresetAmt(2100)" class="amt-btn py-3 rounded-xl border border-[#DEC7A2] bg-[#FAF6EC] hover:bg-[#912003] text-[#422B1E] hover:text-white font-cinzel font-bold text-sm transition-all hover:scale-105 cursor-pointer">
                            ₹ 2,100
                        </button>
                        <button type="button" onclick="selectPresetAmt(5100)" class="amt-btn py-3 rounded-xl border border-[#DEC7A2] bg-[#FAF6EC] hover:bg-[#912003] text-[#422B1E] hover:text-white font-cinzel font-bold text-sm transition-all hover:scale-105 cursor-pointer">
                            ₹ 5,100
                        </button>
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-wider font-bold text-[#422B1E] mb-1">Or Enter Custom Amount (₹)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-[#912003] font-cinzel font-bold text-lg">₹</span>
                            <input id="custom-amt-input" type="number" value="1100" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl pl-10 pr-4 py-3 text-lg font-cinzel font-bold text-[#912003] focus:outline-none focus:border-[#912003] transition-colors">
                        </div>
                    </div>

                    @if (session('donation_success'))
                        <div class="p-4 rounded-2xl bg-emerald-50 border-2 border-emerald-500 text-emerald-900 text-xs font-sans space-y-1 mb-3">
                            <div class="font-cinzel font-bold text-sm text-emerald-800 flex items-center gap-2">
                                <span>🎉</span> <span>॥ Daan Sankalpa Consecrated ॥</span>
                            </div>
                            <div>Receipt Number: <strong class="font-mono text-emerald-950">{{ session('donation_success')['receipt'] }}</strong></div>
                            <div>Donor Devotee: <strong>{{ session('donation_success')['name'] }}</strong></div>
                            <div>Contribution: <strong class="text-emerald-950 font-bold">₹ {{ number_format(session('donation_success')['amount'], 2) }}</strong></div>
                            <div class="text-[11px] text-emerald-700 pt-1 border-t border-emerald-200">
                                80G tax exemption details have been permanently recorded in the Mandir Trust MySQL register.
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('donate.process') }}" method="POST" class="space-y-4 pt-2">
                        @csrf
                        <input type="hidden" name="seva_cause" id="form-seva-cause" value="Maha Annadanam">
                        <input type="hidden" name="amount" id="form-final-amount" value="1100">

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                            <div>
                                <label class="block text-[11px] uppercase tracking-wider font-bold text-[#422B1E] mb-1">Donor Full Name *</label>
                                <input type="text" name="donor_name" required placeholder="Name on PAN Card" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#2C1D14] focus:outline-none focus:border-[#912003] transition-colors">
                            </div>
                            <div>
                                <label class="block text-[11px] uppercase tracking-wider font-bold text-[#422B1E] mb-1">PAN Card (For 80G)</label>
                                <input type="text" name="pan_number" placeholder="ABCDE1234F" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#2C1D14] uppercase focus:outline-none focus:border-[#912003] transition-colors">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                            <div>
                                <label class="block text-[11px] uppercase tracking-wider font-bold text-[#422B1E] mb-1">Email for Receipt *</label>
                                <input type="email" name="email" required placeholder="devotee@gmail.com" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#2C1D14] focus:outline-none focus:border-[#912003] transition-colors">
                            </div>
                            <div>
                                <label class="block text-[11px] uppercase tracking-wider font-bold text-[#422B1E] mb-1">Mobile / WhatsApp *</label>
                                <input type="tel" name="mobile_number" required placeholder="9876543210" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#2C1D14] focus:outline-none focus:border-[#912003] transition-colors">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[11px] uppercase tracking-wider font-bold text-[#422B1E] mb-1">Preferred Offering Mode</label>
                            <select name="payment_mode" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#2C1D14]">
                                <option value="UPI / Online QR">Instant UPI / QR Code</option>
                                <option value="Net Banking">Net Banking</option>
                                <option value="Debit/Credit Card">Debit / Credit Card</option>
                            </select>
                        </div>

                        <button type="submit" class="shimmer-btn w-full py-4 bg-gradient-to-r from-[#912003] via-[#B93815] to-[#912003] hover:from-[#6C1802] text-[#FFFDF9] font-cinzel font-bold text-xs uppercase tracking-widest rounded-xl shadow-md transition-all duration-300 hover:scale-[1.02] cursor-pointer">
                            Proceed to Divine Offering & Save Receipt 💳
                        </button>
                    </form>
                </div>

            </div>

        </div>
    </section>

    <!-- Bank Details & UPI (Parchment Box) -->
    <section class="py-16 bg-[#F8F3E8]">
        <div class="container mx-auto px-6 max-w-4xl reveal-fade-up">
            <div class="parchment-scroll p-6 sm:p-8 rounded-3xl antique-border shadow-lg grid grid-cols-1 sm:grid-cols-2 gap-8 items-center hover-lift">
                <div class="space-y-2 text-xs text-[#2C1D14] font-mono">
                    <h4 class="font-cinzel text-lg font-bold text-[#912003] font-sans">🏛️ Official Bank Account</h4>
                    <p><strong class="font-sans">Trust Name:</strong> Shri Mandir Trust</p>
                    <p><strong class="font-sans">Bank:</strong> State Bank of India</p>
                    <p><strong class="font-sans">Account No:</strong> 3982001928374</p>
                    <p><strong class="font-sans">IFSC Code:</strong> SBIN0001234</p>
                </div>

                <div class="text-center sm:text-right space-y-2">
                    <h4 class="font-cinzel text-lg font-bold text-[#912003]">Instant UPI Scan</h4>
                    <span class="inline-block font-mono font-bold text-xs bg-[#FAF6EC] px-3 py-1.5 rounded-lg border border-[#DEC7A2] text-[#912003] hover:border-[#912003] transition-colors">
                        mandirtrust@sbi
                    </span>
                    <p class="text-[11px] text-[#5C3C2A]">Email transfer screenshot to <a href="mailto:seva@mandirtrust.org" class="text-[#912003] underline font-bold">seva@mandirtrust.org</a> for 80G receipt.</p>
                </div>
            </div>
        </div>
    </section>

    <x-footer />

    <script>
        function selectPresetAmt(amt) {
            document.getElementById('custom-amt-input').value = amt;
            document.getElementById('form-final-amount').value = amt;
            document.querySelectorAll('.amt-btn').forEach(btn => {
                btn.classList.remove('bg-[#912003]', 'text-white', 'border-[#912003]', 'scale-105', 'shadow-sm');
                btn.classList.add('bg-[#FAF6EC]', 'text-[#422B1E]', 'border-[#DEC7A2]');
            });
            event.target.classList.remove('bg-[#FAF6EC]', 'text-[#422B1E]', 'border-[#DEC7A2]');
            event.target.classList.add('bg-[#912003]', 'text-white', 'border-[#912003]', 'scale-105', 'shadow-sm');
        }

        document.getElementById('custom-amt-input')?.addEventListener('input', function(e) {
            document.getElementById('form-final-amount').value = e.target.value;
        });

        document.querySelectorAll('input[name="seva_cause"]').forEach(radio => {
            radio.addEventListener('change', function(e) {
                document.getElementById('form-seva-cause').value = e.target.value;
            });
        });

        function updateImpact(text) {
            const desc = document.getElementById('impact-description');
            if (desc) {
                desc.style.opacity = '0';
                desc.style.transform = 'translateY(5px)';
                setTimeout(() => {
                    desc.innerText = text;
                    desc.style.opacity = '1';
                    desc.style.transform = 'translateY(0)';
                }, 150);
            }
        }
    </script>
</x-layout>
