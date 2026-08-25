<footer class="bg-[#2C1D14] text-[#EADBC0] pt-20 pb-12 border-t-4 border-[#912003] relative overflow-hidden">
    <div class="container mx-auto px-6 md:px-12 relative z-10">
        
        <!-- Top Row: Trust Identity & Daily Blessings Signup -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 pb-16 border-b border-[#A16207]/40 items-center reveal-fade-up">
            <div class="lg:col-span-6 space-y-4">
                <a href="{{ route('home') }}" class="flex items-center gap-3.5 group">
                    <div class="w-12 h-12 rounded-full bg-[#1C120C] border-2 border-[#CA8A04] flex items-center justify-center text-[#CA8A04] font-cinzel text-2xl font-bold shadow-md group-hover:scale-110 transition-transform duration-500">
                        <span class="group-hover:rotate-180 transition-transform duration-700">ॐ</span>
                    </div>
                    <div>
                        <span class="font-cinzel text-2xl font-bold text-[#FFFDF9] block group-hover:text-[#CA8A04] transition-colors">SHRI MANDIR TRUST</span>
                        <span class="text-xs uppercase tracking-[0.25em] text-[#CA8A04] font-bold">Sanatan Dharma Religious & Charitable Trust</span>
                    </div>
                </a>
                <p class="text-sm text-[#DEC7A2] font-normal max-w-lg leading-relaxed">
                    A non-profit ancient spiritual sanctuary dedicated to Agamic preservation, daily Annadanam, Gau Seva, and spreading universal peace through Sanatan values.
                </p>
                <div class="flex flex-wrap gap-3 pt-1 text-[11px] uppercase tracking-wider font-bold text-[#CA8A04]">
                    <span class="px-3 py-1 rounded-full bg-[#1C120C] border border-[#A16207]/60 hover:border-[#CA8A04] transition-colors">✓ 80G Tax Exempt</span>
                    <span class="px-3 py-1 rounded-full bg-[#1C120C] border border-[#A16207]/60 hover:border-[#CA8A04] transition-colors">✓ 12A Certified</span>
                    <span class="px-3 py-1 rounded-full bg-[#1C120C] border border-[#A16207]/60 hover:border-[#CA8A04] transition-colors">✓ Govt Reg. #TR/1924/09</span>
                </div>
            </div>

            <!-- WhatsApp Blessings Subscription -->
            <div class="lg:col-span-6 bg-[#1C120C] p-6 md:p-8 rounded-3xl border border-[#A16207]/50 shadow-xl hover-lift">
                <h4 class="font-cinzel text-lg font-bold text-[#FFFDF9] mb-1">Receive Daily Morning Blessings & Panchang</h4>
                <p class="text-xs text-[#DEC7A2] font-normal mb-4">Join 25,000+ devotees receiving sacred shlokas, tithi timings, and festive updates directly on WhatsApp.</p>
                <form onsubmit="handleModalSubmit(event, 'Namaste! You are now subscribed to Daily WhatsApp Blessings.')" class="flex flex-col sm:flex-row gap-2">
                    <input type="tel" required placeholder="Enter WhatsApp Number (+91...)" class="flex-grow bg-[#2C1D14] border border-[#A16207]/60 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#CA8A04] transition-colors">
                    <button type="submit" class="shimmer-btn px-6 py-3 bg-[#912003] hover:bg-[#B93815] text-[#FFFDF9] font-cinzel font-bold text-xs uppercase tracking-wider rounded-xl shadow-md transition-all duration-300 hover:scale-105 cursor-pointer shrink-0">
                        Subscribe Free 🙏
                    </button>
                </form>
            </div>
        </div>

        <!-- Middle Row: Navigation, Darshan Timings & Bank Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 py-16 border-b border-[#A16207]/40 text-sm stagger-parent">
            
            <!-- Quick Links -->
            <div class="reveal-fade-up">
                <h4 class="font-cinzel font-bold text-[#FFFDF9] text-base mb-5 tracking-wider uppercase flex items-center gap-2">
                    <span class="text-[#CA8A04] animate-flame">🪔</span> Sacred Portals
                </h4>
                <ul class="space-y-2.5 text-[#DEC7A2] font-medium text-xs sm:text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-[#CA8A04] transition-all hover:translate-x-1 inline-block">Temple Home</a></li>
                    <li><a href="{{ route('register') }}" class="text-[#CA8A04] font-bold hover:text-white transition-all hover:translate-x-1 inline-block">🪔 भक्त पंजीकरण (Devotee Registration)</a></li>
                    @auth
                        <li><a href="{{ route('devotee.profile') }}" class="text-white font-bold hover:text-[#CA8A04] transition-all hover:translate-x-1 inline-block">👤 Mera Khata ({{ auth()->user()->nickname }})</a></li>
                    @else
                        <li><a href="{{ route('login') }}" class="hover:text-[#CA8A04] transition-all hover:translate-x-1 inline-block">🔑 भक्त लॉगिन (Devotee Login)</a></li>
                    @endauth
                    <li><a href="{{ route('about') }}" class="hover:text-[#CA8A04] transition-all hover:translate-x-1 inline-block">Centenary Heritage & Trustees</a></li>
                    <li><a href="{{ route('poojas') }}" class="hover:text-[#CA8A04] transition-all hover:translate-x-1 inline-block">Book Online Pooja & Sankalp</a></li>
                    <li><a href="{{ route('events') }}" class="hover:text-[#CA8A04] transition-all hover:translate-x-1 inline-block">Upcoming Festivals Calendar</a></li>
                    <li><a href="{{ route('donate') }}" class="hover:text-[#CA8A04] transition-all hover:translate-x-1 inline-block">Online Seva & Daan Portal</a></li>
                    <li><a href="{{ url('/mandiradmin') }}" class="text-[#A16207] hover:text-[#CA8A04] text-xs font-cinzel transition-all hover:translate-x-1 inline-block">🛡️ Mandir Admin Portal</a></li>
                </ul>
            </div>

            <!-- Daily Aarti & Darshan Timings -->
            <div class="reveal-fade-up">
                <h4 class="font-cinzel font-bold text-[#FFFDF9] text-base mb-5 tracking-wider uppercase flex items-center gap-2">
                    <span class="text-[#CA8A04] animate-spin-slow">⏰</span> Darshan Timetable
                </h4>
                <ul class="space-y-3 text-xs text-[#DEC7A2] font-marcellus">
                    <li class="flex justify-between border-b border-[#A16207]/30 pb-2">
                        <span>Mangala Aarti</span>
                        <span class="font-bold text-[#CA8A04]">05:30 AM</span>
                    </li>
                    <li class="flex justify-between border-b border-[#A16207]/30 pb-2">
                        <span>Morning Darshan</span>
                        <span class="text-white font-bold">06:00 AM - 12:30 PM</span>
                    </li>
                    <li class="flex justify-between border-b border-[#A16207]/30 pb-2">
                        <span>Rajbhog Aarti</span>
                        <span class="font-bold text-[#CA8A04]">12:00 PM</span>
                    </li>
                    <li class="flex justify-between border-b border-[#A16207]/30 pb-2">
                        <span>Evening Darshan</span>
                        <span class="text-white font-bold">04:30 PM - 09:00 PM</span>
                    </li>
                    <li class="flex justify-between border-b border-[#A16207]/30 pb-2">
                        <span>Sandhya Maha Aarti</span>
                        <span class="font-bold text-[#CA8A04] animate-pulse">07:00 PM</span>
                    </li>
                    <li class="flex justify-between">
                        <span>Shayan Aarti</span>
                        <span class="font-bold text-[#CA8A04]">08:45 PM</span>
                    </li>
                </ul>
            </div>

            <!-- Direct Bank Donation Info -->
            <div class="reveal-fade-up">
                <h4 class="font-cinzel font-bold text-[#FFFDF9] text-base mb-5 tracking-wider uppercase flex items-center gap-2">
                    <span class="text-[#CA8A04]">🏦</span> Direct Bank Transfer
                </h4>
                <div class="bg-[#1C120C] p-4 rounded-2xl border border-[#A16207]/50 shadow-sm text-xs space-y-2 text-[#DEC7A2] font-mono hover-lift">
                    <p><strong class="text-white font-sans">Account:</strong> Shri Mandir Trust</p>
                    <p><strong class="text-white font-sans">Bank:</strong> State Bank of India</p>
                    <p><strong class="text-white font-sans">A/C No:</strong> 3982001928374</p>
                    <p><strong class="text-white font-sans">IFSC Code:</strong> SBIN0001234</p>
                    <p><strong class="text-white font-sans">UPI ID:</strong> <span class="text-[#CA8A04] font-bold">mandirtrust@sbi</span></p>
                </div>
            </div>

            <!-- Contact & Directions -->
            <div class="reveal-fade-up">
                <h4 class="font-cinzel font-bold text-[#FFFDF9] text-base mb-5 tracking-wider uppercase flex items-center gap-2">
                    <span class="text-[#CA8A04] animate-float-gentle">📍</span> Contact & Visit
                </h4>
                <div class="space-y-3 text-xs text-[#DEC7A2]">
                    <p class="flex items-start gap-2.5">
                        <span class="text-[#CA8A04] text-sm">🏛️</span>
                        <span>Shri Mandir Complex, Divine Parikrama Marg, Vedic Dham, Pin - 281121</span>
                    </p>
                    <p class="flex items-center gap-2.5">
                        <span class="text-[#CA8A04] text-sm">📞</span>
                        <a href="tel:+919876543210" class="hover:text-[#CA8A04] font-bold text-white transition-colors">+91 98765 43210 / 11</a>
                    </p>
                    <p class="flex items-center gap-2.5">
                        <span class="text-[#CA8A04] text-sm">✉️</span>
                        <a href="mailto:seva@mandirtrust.org" class="hover:text-[#CA8A04] font-bold text-white transition-colors">seva@mandirtrust.org</a>
                    </p>
                    <div class="pt-2">
                        <a href="https://maps.google.com" target="_blank" class="inline-flex items-center gap-1.5 text-xs text-[#CA8A04] hover:text-white font-bold underline underline-offset-4 transition-colors">
                            <span>Get GPS Directions on Map</span> ↗
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Bottom Copyright & Shlokas -->
        <div class="pt-10 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-[#DEC7A2]/70">
            <p>© {{ date('Y') }} Shri Mandir Trust. All rights reserved. Registered under Public Charitable Trusts Act.</p>
            <div class="flex items-center gap-6">
                <span class="font-marcellus text-[#CA8A04] text-sm italic font-bold animate-pulse">ॐ शान्तिः शान्तिः शान्तिः</span>
                <a href="{{ route('about') }}" class="hover:text-white transition-colors">Privacy & Seva Policy</a>
                <a href="{{ route('donate') }}" class="hover:text-white transition-colors">Terms of Daan</a>
            </div>
        </div>

    </div>
</footer>
