<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Shringi Rishi Mandir Trust - Divine Sanatan Temple & Spiritual Sanctuary. Experience Daily Aarti, Sacred Poojas, Gau Seva, and Annadanam.">
        
        <title>{{ $title ?? 'Shringi Rishi Mandir Trust | Ancient Sanatan Heritage & Sacred Sanctuary' }}</title>

        <!-- Preconnect & Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@700;900&family=Cinzel:wght@400;600;700;800;900&family=Marcellus&family=Outfit:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- GSAP & ScrollTrigger -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            [x-cloak] { display: none !important; }
            .font-cinzel { font-family: 'Cinzel', serif; }
            .font-decorative { font-family: 'Cinzel Decorative', serif; }
            .font-marcellus { font-family: 'Marcellus', serif; }
            .font-body { font-family: 'Outfit', sans-serif; }
            .fade-up, .reveal-fade-up { will-change: transform, opacity; }
        </style>
    </head>
    <body class="antialiased selection:bg-[#912003] selection:text-white relative bg-[#F8F3E8] overflow-x-hidden">
        
        <!-- Top Sacred Reading Progress Bar -->
        <div id="reading-progress-bar"></div>

        <!-- Ambient Floating Divine Golden Sparks Background Canvas -->
        <canvas id="divine-particles-canvas"></canvas>

        <div class="overflow-x-clip min-h-screen flex flex-col justify-between relative z-10">
            
            <!-- Ancient Manuscript Top Ribbon (Clean, Single-Line, Responsive) -->
            <div class="bg-[#2C1D14] text-[#EADBC0] text-[11px] sm:text-xs py-1.5 px-3 sm:px-4 border-b border-[#A16207]/40 shadow-sm relative z-50">
                <div class="container mx-auto flex justify-between items-center gap-2">
                    <div class="flex items-center gap-2">
                        <span class="text-[#CA8A04] text-xs animate-flame">🪔</span>
                        <span class="font-marcellus tracking-wider">
                            <strong class="text-[#F4EBD9] uppercase hidden xs:inline">Sandhya Aarti:</strong>
                            <span class="text-[#F4EBD9] uppercase xs:hidden">Aarti:</span>
                            <span id="aarti-timer" class="font-mono font-bold text-[#FFFDF9] bg-[#1C120C] px-1.5 py-0.5 rounded border border-[#A16207]/50 text-[10px] sm:text-xs ml-1">01h : 42m : 18s</span>
                        </span>
                    </div>

                    <div class="flex items-center gap-2 sm:gap-4 text-[10px] sm:text-[11px] uppercase tracking-wider font-semibold">
                        <span class="hidden lg:inline-flex items-center gap-2 text-[#EADBC0] font-marcellus">
                            <span class="text-[#CA8A04]">ॐ</span> ॐ असतो मा सद्गमय । तमसो मा ज्योतिर्गमय । <span class="text-[#CA8A04]">ॐ</span>
                        </span>
                        <button onclick="playTempleBell()" class="inline-flex items-center gap-1 bg-[#422B1E] hover:bg-[#5C3C2A] text-[#F4EBD9] px-2 py-0.5 rounded-full border border-[#A16207]/60 transition-all cursor-pointer shadow-xs">
                            <span class="text-[#CA8A04]">🔔</span>
                            <span class="font-cinzel text-[9px] sm:text-[10px]">Bell</span>
                        </button>
                        
                        @auth
                            <a href="{{ route('devotee.profile') }}" class="text-[#CA8A04] hover:text-[#FFFDF9] font-cinzel font-bold flex items-center gap-1">
                                <span>👤</span> <span>{{ auth()->user()->nickname }}</span>
                            </a>
                            @if (auth()->user()->is_admin)
                                <a href="{{ route('admin.dashboard') }}" class="text-[#DEC7A2] hover:text-white bg-[#422B1E] px-2 py-0.5 rounded text-[9px] border border-[#CA8A04]/40">
                                    Admin
                                </a>
                            @endif
                        @else
                            <a href="{{ route('register') }}" class="text-[#CA8A04] hover:text-[#FFFDF9] underline decoration-[#CA8A04]/50 underline-offset-2 transition-colors">
                                भक्त पंजीकरण
                            </a>
                            <a href="{{ route('login') }}" class="text-[#EADBC0] hover:text-white transition-colors">
                                लॉगिन
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <main class="flex-grow">
                {{ $slot }}
            </main>

            <!-- Global Floating Action Buttons (Hidden on small mobile to avoid covering screen, visible on tablet/desktop) -->
            <div class="hidden md:flex fixed bottom-6 right-6 z-40 flex-col gap-3">
                <button onclick="openBookingModal()" class="shimmer-btn hover-lift group relative flex items-center gap-3 bg-gradient-to-r from-[#912003] via-[#B93815] to-[#912003] hover:from-[#6C1802] hover:to-[#912003] text-[#FFFDF9] font-medium text-sm py-3 px-5 rounded-full shadow-[0_10px_25px_rgba(108,24,2,0.35)] border border-[#DEC7A2]/50 transition-all duration-300 hover:scale-105 cursor-pointer">
                    <span class="text-base animate-flame">🪔</span>
                    <span class="font-cinzel tracking-wider font-semibold">Book Sankalpam</span>
                </button>
                
                <button onclick="openDonateModal()" class="shimmer-btn hover-lift group relative flex items-center gap-3 bg-[#FFFDF9] hover:bg-[#FAF6EC] text-[#6C1802] font-medium text-sm py-3 px-5 rounded-full shadow-[0_10px_25px_rgba(66,43,30,0.12)] border border-[#DEC7A2] transition-all duration-300 hover:scale-105 cursor-pointer">
                    <span class="text-base">🙏</span>
                    <span class="font-cinzel tracking-wider font-semibold">Pavitra Daan</span>
                </button>
            </div>

            <!-- Global Pooja Booking Modal (Ancient Parchment Style) -->
            <div id="pooja-modal" class="fixed inset-0 z-50 bg-black/70 backdrop-blur-sm hidden flex items-center justify-center p-4 transition-all duration-300">
                <div class="parchment-scroll rounded-3xl max-w-xl w-full p-8 md:p-10 relative shadow-[0_20px_60px_rgba(44,29,20,0.4)] max-h-[90vh] overflow-y-auto">
                    <button onclick="closeBookingModal()" class="absolute top-5 right-5 text-[#6C1802] hover:text-black w-8 h-8 rounded-full bg-[#EADBC0]/40 flex items-center justify-center text-lg transition-all hover:rotate-90">✕</button>
                    
                    <div class="text-center mb-6">
                        <span class="font-cinzel text-3xl text-[#912003] inline-block animate-spin-slow">ॐ</span>
                        <h3 class="font-cinzel text-2xl font-bold text-[#2C1D14] mt-1">Sacred Sankalpa Patrika</h3>
                        <p class="text-xs text-[#6C1802] font-marcellus italic mt-0.5">Enter your Gotra & Nakshatra for Vedic Pooja Consecration</p>
                    </div>

                    <form onsubmit="handleModalSubmit(event, 'Pooja Sankalpam received with ancient blessings!')" class="space-y-4">
                        <div>
                            <label class="block text-xs uppercase tracking-wider font-bold text-[#422B1E] mb-1">Select Sacred Pooja</label>
                            <select class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-4 py-3 text-sm text-[#2C1D14] focus:outline-none focus:border-[#912003] transition-colors">
                                <option>Maha Rudrabhishek (Lord Shiva) - ₹2,100</option>
                                <option>Sri Satyanarayan Maha Pooja - ₹1,100</option>
                                <option>Navagraha Shanti & Havan - ₹3,500</option>
                                <option>Maha Mrityunjaya Jaap (108 Chants) - ₹5,100</option>
                                <option>Special Birthday / Anniversary Archana - ₹501</option>
                            </select>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs uppercase tracking-wider font-bold text-[#422B1E] mb-1">Devotee Full Name</label>
                                <input type="text" required placeholder="e.g. Rameshwar Sharma" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-4 py-3 text-sm text-[#2C1D14] focus:outline-none focus:border-[#912003] transition-colors">
                            </div>
                            <div>
                                <label class="block text-xs uppercase tracking-wider font-bold text-[#422B1E] mb-1">Gotra (Optional)</label>
                                <input type="text" placeholder="e.g. Kashyap, Bhardwaj" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-4 py-3 text-sm text-[#2C1D14] focus:outline-none focus:border-[#912003] transition-colors">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs uppercase tracking-wider font-bold text-[#422B1E] mb-1">Preferred Tithi / Date</label>
                                <input type="date" required class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-4 py-3 text-sm text-[#2C1D14] focus:outline-none focus:border-[#912003] transition-colors">
                            </div>
                            <div>
                                <label class="block text-xs uppercase tracking-wider font-bold text-[#422B1E] mb-1">WhatsApp Number</label>
                                <input type="tel" required placeholder="+91 98765 43210" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-4 py-3 text-sm text-[#2C1D14] focus:outline-none focus:border-[#912003] transition-colors">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs uppercase tracking-wider font-bold text-[#422B1E] mb-1">Address for Prasad Home Delivery</label>
                            <textarea rows="2" placeholder="Postal address for sacred Bhasma, Raksha Sutra, and dry fruit Prasad" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-4 py-2 text-sm text-[#2C1D14] focus:outline-none focus:border-[#912003] transition-colors"></textarea>
                        </div>

                        <button type="submit" class="shimmer-btn w-full py-3.5 bg-gradient-to-r from-[#912003] via-[#B93815] to-[#912003] hover:from-[#6C1802] text-[#FFFDF9] font-cinzel font-bold text-sm tracking-wider uppercase rounded-xl shadow-md transition-all duration-300 hover:scale-[1.02] cursor-pointer">
                            Confirm Sacred Sankalpam 🙏
                        </button>
                    </form>
                </div>
            </div>

            <!-- Global Daan Modal (Ancient Parchment Style) -->
            <div id="donate-modal" class="fixed inset-0 z-50 bg-black/70 backdrop-blur-sm hidden flex items-center justify-center p-4 transition-all duration-300">
                <div class="parchment-scroll rounded-3xl max-w-lg w-full p-8 md:p-10 relative shadow-[0_20px_60px_rgba(44,29,20,0.4)] max-h-[90vh] overflow-y-auto">
                    <button onclick="closeDonateModal()" class="absolute top-5 right-5 text-[#6C1802] hover:text-black w-8 h-8 rounded-full bg-[#EADBC0]/40 flex items-center justify-center text-lg transition-all hover:rotate-90">✕</button>
                    
                    <div class="text-center mb-6">
                        <span class="font-cinzel text-3xl text-[#912003] inline-block animate-float-gentle">🪷</span>
                        <h3 class="font-cinzel text-2xl font-bold text-[#2C1D14] mt-1">Pavitra Daan Sankalpa</h3>
                        <p class="text-xs text-[#6C1802] font-marcellus italic mt-0.5">All offerings are strictly utilized for Mandir Seva & 80G Tax Exempt.</p>
                    </div>

                    <form onsubmit="handleModalSubmit(event, 'Thank you for your generous sacred offering! May Lord bless your family with peace and prosperity.')" class="space-y-4">
                        <div>
                            <label class="block text-xs uppercase tracking-wider font-bold text-[#422B1E] mb-1">Select Seva Cause</label>
                            <select class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-4 py-3 text-sm text-[#2C1D14] focus:outline-none focus:border-[#912003] transition-colors">
                                <option>Daily Annadanam (Feeds 100+ Pilgrims)</option>
                                <option>Gau Seva (Grass & Medical Care for 500+ Cows)</option>
                                <option>Nitya Deepam & Temple Akhand Jyoti</option>
                                <option>Veda Pathshala & Brahmin Vidyadaan</option>
                                <option>Mandir Shikhar & Sanctum Preservation</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs uppercase tracking-wider font-bold text-[#422B1E] mb-2">Select Offering Amount</label>
                            <div class="grid grid-cols-3 gap-2 mb-3">
                                <button type="button" onclick="setDonateAmt(501)" class="py-2.5 rounded-lg border border-[#DEC7A2] bg-[#FAF6EC] hover:bg-[#912003] text-[#422B1E] hover:text-white font-cinzel font-bold text-sm transition-all hover:scale-105 cursor-pointer">₹ 501</button>
                                <button type="button" onclick="setDonateAmt(1100)" class="py-2.5 rounded-lg border border-[#912003] bg-[#912003] text-white font-cinzel font-bold text-sm transition-all scale-105 cursor-pointer">₹ 1,100</button>
                                <button type="button" onclick="setDonateAmt(5100)" class="py-2.5 rounded-lg border border-[#DEC7A2] bg-[#FAF6EC] hover:bg-[#912003] text-[#422B1E] hover:text-white font-cinzel font-bold text-sm transition-all hover:scale-105 cursor-pointer">₹ 5,100</button>
                            </div>
                            <input id="modal-donate-input" type="number" value="1100" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-4 py-3 text-base text-[#912003] font-cinzel font-bold focus:outline-none focus:border-[#912003] transition-colors" placeholder="Custom Amount (₹)">
                        </div>

                        <div>
                            <label class="block text-xs uppercase tracking-wider font-bold text-[#422B1E] mb-1">Donor Name (For 80G Receipt)</label>
                            <input type="text" required placeholder="Full Name on PAN Card" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-4 py-3 text-sm text-[#2C1D14] focus:outline-none focus:border-[#912003] transition-colors">
                        </div>

                        <div>
                            <label class="block text-xs uppercase tracking-wider font-bold text-[#422B1E] mb-1">PAN Card Number (Optional)</label>
                            <input type="text" placeholder="ABCDE1234F" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-4 py-3 text-sm text-[#2C1D14] uppercase focus:outline-none focus:border-[#912003] transition-colors">
                        </div>

                        <button type="submit" class="shimmer-btn w-full py-3.5 bg-gradient-to-r from-[#912003] via-[#B93815] to-[#912003] hover:from-[#6C1802] text-[#FFFDF9] font-cinzel font-bold text-sm tracking-wider uppercase rounded-xl shadow-md transition-all duration-300 hover:scale-[1.02] cursor-pointer">
                            Proceed to Pavitra Daan Gateway 💳
                        </button>
                    </form>
                </div>
            </div>

            <!-- Global Notification Toast with Divine Glow -->
            <div id="toast-notify" class="fixed top-20 right-6 z-50 bg-[#FAF6EC] border-2 border-[#912003] text-[#2C1D14] px-6 py-4 rounded-2xl shadow-2xl transition-all duration-500 transform translate-x-[150%] flex items-center gap-3">
                <span class="text-2xl text-[#912003] animate-spin-slow">ॐ</span>
                <div>
                    <h5 class="font-cinzel font-bold text-sm text-[#912003]" id="toast-title">Shubham Bhavatu</h5>
                    <p class="text-xs text-[#422B1E]" id="toast-message">Your request has been received.</p>
                </div>
            </div>

        </div>

        <script>
            // Live countdown timer for Aarti
            setInterval(() => {
                const now = new Date();
                const target = new Date();
                target.setHours(19, 0, 0, 0);
                if(now > target) target.setDate(target.getDate() + 1);
                
                const diff = target - now;
                const hours = String(Math.floor(diff / (1000 * 60 * 60))).padStart(2, '0');
                const mins = String(Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
                const secs = String(Math.floor((diff % (1000 * 60)) / 1000)).padStart(2, '0');
                
                const timerEl = document.getElementById('aarti-timer');
                if(timerEl) timerEl.innerText = `${hours}h : ${mins}m : ${secs}s`;
            }, 1000);
        </script>
    </body>
</html>
