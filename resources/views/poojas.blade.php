<x-layout title="Vedic Poojas & Sankalpam Patrika | Shri Mandir Trust">
    <x-navbar />

    <!-- Page Header (Ancient Scroll Inscription) -->
    <section class="relative pt-44 pb-20 overflow-hidden">
        <div class="container mx-auto px-6 relative z-10 text-center max-w-4xl reveal-fade-up">
            <div class="parchment-scroll p-8 sm:p-12 rounded-3xl antique-border shadow-xl hover-lift relative overflow-hidden group">
                <!-- User Provided Vintage Floral Corner Ornaments -->
                <x-vintage-corner position="top-right" size="w-20 h-20 sm:w-28 sm:h-28" />
                <x-vintage-corner position="top-left" size="w-20 h-20 sm:w-28 sm:h-28" />

                <div class="text-xs uppercase tracking-[0.3em] font-marcellus text-[#912003] font-bold mb-2 animate-float-gentle relative z-10">
                    ॥ वैदिक संस्कार एवं अर्चन विधानम् ॥
                </div>
                <h1 class="font-cinzel text-3xl sm:text-5xl font-bold text-[#1C120C] mb-4 relative z-10">
                    Sacred Poojas & <br><span class="gold-leaf-text">Divine Sankalpam Patrika</span>
                </h1>
                <div class="sacred-divider relative z-10">
                    <span class="animate-flame">🔱 ॐ 🔱</span>
                </div>
                <p class="font-marcellus text-base sm:text-lg text-[#782606] italic max-w-2xl mx-auto relative z-10">
                    Conducted strictly in accordance with Agama Shastras. Consecrated Bhasma and sacred Raksha Sutra shipped to your residence.
                </p>
            </div>
        </div>
    </section>

    <!-- Pooja Patrika List & Sticky Booking Leaf -->
    <section class="py-16 bg-[#FAF6EC] border-y border-[#DEC7A2]/60">
        <div class="container mx-auto px-6 md:px-12 max-w-7xl">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                
                <!-- Left: Flowing Pooja Patrika Scroll (8 cols) -->
                <div class="lg:col-span-8 reveal-fade-left">
                    <div class="parchment-scroll p-6 sm:p-10 rounded-3xl antique-border shadow-xl space-y-8 stagger-parent hover-lift">
                        
                        @php
                            $poojasList = [
                                [
                                    'icon' => '🔱',
                                    'title' => 'Maha Rudrabhishek (Panchamrit & Rudram)',
                                    'category' => 'शैव पूजा विधान',
                                    'desc' => 'Ceremonial sacred bath of the Shiva Lingam using 11 auspicious ingredients with continuous chanting of Namakam & Chamakam Vedic hymns. Removes planetary doshas and invokes inner peace.',
                                    'inclusions' => 'Includes pure samagri, 3 acharyas, individual Gotra Sankalpa, consecrated Silver Coin & Vibhuti delivery.',
                                    'price' => '₹ 2,100',
                                    'duration' => '1.5 Hours'
                                ],
                                [
                                    'icon' => '🪷',
                                    'title' => 'Sri Satyanarayan Maha Vrat Katha',
                                    'category' => 'वैष्णव पूजा विधान',
                                    'desc' => 'Veneration of Lord Vishnu for domestic harmony, business growth, and family well-being. Recitation of 5-chapter Skanda Purana katha on Purnima or auspicious dates.',
                                    'inclusions' => 'Full Panchamrit & Desi Ghee Sheera Prasad, live video stream link for remote family.',
                                    'price' => '₹ 1,100',
                                    'duration' => '2 Hours'
                                ],
                                [
                                    'icon' => '🪐',
                                    'title' => 'Navagraha Shanti & Planetary Havan',
                                    'category' => 'ग्रह शान्ति विधान',
                                    'desc' => 'Vedic fire oblation invoking all nine celestial planets with 108 ahutis per planet to pacify malefic planetary periods (Sade Sati, Rahu/Ketu Dasha).',
                                    'inclusions' => '9-Planet Sacred Wood (Samidha) & Yantra, energized Navadhanya & Raksha Sutra delivery.',
                                    'price' => '₹ 3,500',
                                    'duration' => '2.5 Hours'
                                ],
                                [
                                    'icon' => '🕉️',
                                    'title' => 'Maha Mrityunjaya Akhand Jaap & Havan',
                                    'category' => 'आरोग्य एवं दीर्घायु',
                                    'desc' => 'Continuous recitation of the supreme life-protecting Maha Mrityunjaya mantra for recovery from ailments, protection from accidents, and longevity.',
                                    'inclusions' => '1,100 Chants with Ghee Ahutis in Yajna Kund, blessed Mrityunjaya Kavach delivery.',
                                    'price' => '₹ 5,100',
                                    'duration' => '3 Hours'
                                ],
                                [
                                    'icon' => '💰',
                                    'title' => 'Sri Suktam & Kanakadhara Lakshmi Pooja',
                                    'category' => 'श्री एवं समृद्धि',
                                    'desc' => 'Ritual worship of Goddess Mahalakshmi using 108 fresh Lotus flowers and Sri Suktam stotras to invoke unhindered prosperity and debt clearance.',
                                    'inclusions' => 'Kumkum Archana & Sri Yantra Abhishekam, energized Kuber Lakshmi Coin sent via speed post.',
                                    'price' => '₹ 2,500',
                                    'duration' => '1.5 Hours'
                                ],
                            ];
                        @endphp

                        @foreach($poojasList as $index => $p)
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 pb-8 {{ $index < count($poojasList) - 1 ? 'border-b border-[#DEC7A2]' : '' }} group hover:bg-[#FFFDF9]/80 p-3 rounded-2xl transition-all">
                            <div class="space-y-2 max-w-xl">
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl text-[#912003] group-hover:scale-125 transition-transform duration-300">{{ $p['icon'] }}</span>
                                    <div>
                                        <span class="text-[10px] uppercase font-marcellus tracking-widest text-[#912003] font-bold">{{ $p['category'] }}</span>
                                        <h3 class="font-cinzel text-xl font-bold text-[#1C120C] group-hover:text-[#912003] transition-colors">{{ $p['title'] }}</h3>
                                    </div>
                                </div>
                                <p class="text-xs sm:text-sm text-[#422B1E] font-normal leading-relaxed">
                                    {{ $p['desc'] }}
                                </p>
                                <p class="text-xs text-[#782606] font-medium pt-1">
                                    ✓ {{ $p['inclusions'] }}
                                </p>
                            </div>

                            <div class="shrink-0 text-left md:text-right w-full md:w-auto">
                                <span class="text-[10px] uppercase tracking-wider text-[#5C3C2A] block font-semibold">Dakshina</span>
                                <span class="font-cinzel text-2xl font-bold text-[#912003] block mb-2 group-hover:scale-105 transition-transform">{{ $p['price'] }}</span>
                                <button onclick="openBookingModal()" class="shimmer-btn hover-lift px-5 py-2.5 rounded-full bg-[#912003] hover:bg-[#6C1802] text-[#FFFDF9] font-cinzel font-bold text-xs uppercase tracking-wider shadow-sm transition-all cursor-pointer">
                                    Book Sankalp 🙏
                                </button>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>

                <!-- Right: Sticky Sankalpa Form Leaf (4 cols) -->
                <div class="lg:col-span-4 reveal-fade-right">
                    <div class="parchment-scroll p-6 sm:p-8 rounded-3xl antique-border shadow-xl sticky top-28 space-y-6 hover-lift">
                        <div class="text-center">
                            <span class="text-2xl text-[#912003] animate-flame">🪔</span>
                            <h3 class="font-cinzel text-xl font-bold text-[#1C120C] mt-1">Direct Sankalpa Request</h3>
                            <p class="text-xs text-[#6C1802] font-marcellus italic mt-0.5">Pandit Ji will contact you on WhatsApp with confirmation.</p>
                        </div>

                        <form onsubmit="handleModalSubmit(event, 'Your Pooja Booking has been received with Vedic blessings.')" class="space-y-3.5">
                            <div>
                                <label class="block text-[11px] uppercase tracking-wider font-bold text-[#422B1E] mb-1">Select Pooja</label>
                                <select class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#2C1D14] focus:outline-none focus:border-[#912003] transition-colors">
                                    <option>Maha Rudrabhishek (₹2,100)</option>
                                    <option>Sri Satyanarayan Vrat Katha (₹1,100)</option>
                                    <option>Navagraha Shanti Havan (₹3,500)</option>
                                    <option>Maha Mrityunjaya Jaap (₹5,100)</option>
                                    <option>Sri Suktam Lakshmi Pooja (₹2,500)</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-[11px] uppercase tracking-wider font-bold text-[#422B1E] mb-1">Devotee Name</label>
                                <input type="text" required placeholder="Name for Sankalp" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#2C1D14] focus:outline-none focus:border-[#912003] transition-colors">
                            </div>

                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <label class="block text-[11px] uppercase tracking-wider font-bold text-[#422B1E] mb-1">Gotra</label>
                                    <input type="text" placeholder="Gotra" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3 py-2 text-xs text-[#2C1D14] focus:outline-none focus:border-[#912003] transition-colors">
                                </div>
                                <div>
                                    <label class="block text-[11px] uppercase tracking-wider font-bold text-[#422B1E] mb-1">Nakshatra</label>
                                    <input type="text" placeholder="Birth Star" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3 py-2 text-xs text-[#2C1D14] focus:outline-none focus:border-[#912003] transition-colors">
                                </div>
                            </div>

                            <div>
                                <label class="block text-[11px] uppercase tracking-wider font-bold text-[#422B1E] mb-1">Preferred Tithi / Date</label>
                                <input type="date" required class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#2C1D14] focus:outline-none focus:border-[#912003] transition-colors">
                            </div>

                            <div>
                                <label class="block text-[11px] uppercase tracking-wider font-bold text-[#422B1E] mb-1">WhatsApp Mobile</label>
                                <input type="tel" required placeholder="+91 98765 43210" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#2C1D14] focus:outline-none focus:border-[#912003] transition-colors">
                            </div>

                            <button type="submit" class="shimmer-btn w-full py-3.5 bg-gradient-to-r from-[#912003] via-[#B93815] to-[#912003] hover:from-[#6C1802] text-[#FFFDF9] font-cinzel font-bold text-xs uppercase tracking-widest rounded-xl shadow-md transition-all duration-300 hover:scale-[1.02] cursor-pointer">
                                Confirm Pooja Booking 🙏
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <x-footer />
</x-layout>
