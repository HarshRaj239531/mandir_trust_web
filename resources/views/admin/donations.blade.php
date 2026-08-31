<x-admin.layout title="Daan & Donations (दान एवं सहयोग)" subtitle="Temple Trust Contributions, Online Receipts & Verification (MySQL Dynamic)">
    
    <!-- Top Stats Banner -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        <div class="bg-white rounded-2xl p-5 border border-[#E5DCD0] shadow-2xs">
            <span class="text-xs font-bold uppercase tracking-wider text-[#A16207] font-cinzel block mb-1">Total Daan Amount</span>
            <div class="font-cinzel text-3xl font-black text-[#912003]">₹ {{ number_format($totalDonationAmount, 0) }}</div>
            <span class="text-[11px] text-emerald-700 font-sans font-bold">Total Offerings Recorded</span>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-[#E5DCD0] shadow-2xs">
            <span class="text-xs font-bold uppercase tracking-wider text-[#A16207] font-cinzel block mb-1">Annakshetra Bhandara</span>
            <div class="font-cinzel text-3xl font-black text-[#CA8A04]">₹ {{ number_format($annakshetraDonations, 0) }}</div>
            <span class="text-[11px] text-[#6C1802] font-sans">Free Meals fund</span>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-[#E5DCD0] shadow-2xs">
            <span class="text-xs font-bold uppercase tracking-wider text-[#A16207] font-cinzel block mb-1">Gaushala Seva Daan</span>
            <div class="font-cinzel text-3xl font-black text-[#1C120C]">₹ {{ number_format($gaushalaDonations, 0) }}</div>
            <span class="text-[11px] text-[#6C1802] font-sans">Cow fodder & medical</span>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-[#E5DCD0] shadow-2xs">
            <span class="text-xs font-bold uppercase tracking-wider text-[#A16207] font-cinzel block mb-1">Total Receipts</span>
            <div class="font-cinzel text-3xl font-black text-emerald-800">{{ $totalDonationsCount }}</div>
            <span class="text-[11px] text-[#6C1802] font-sans">100% Stored in MySQL</span>
        </div>
    </div>

    <!-- Donations Table (Yoga-Style) -->
    <div class="bg-white rounded-3xl border border-[#E5DCD0] shadow-[0_2px_16px_rgba(44,29,20,0.03)] overflow-hidden">
        <div class="p-5 sm:p-6 border-b border-[#E5DCD0] flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-[#FAF7F2]/60">
            <div>
                <h3 class="font-cinzel text-lg font-black text-[#1C120C] flex items-center gap-2">
                    <span>💰</span> <span>Donation Receipts & Transaction Register</span>
                </h3>
                <p class="text-xs text-[#6C1802] font-sans mt-0.5">
                    Real-time log of sacred contributions received for Temple Trust activities.
                </p>
            </div>
            
            <div class="flex items-center gap-3">
                <button onclick="document.getElementById('add-donation-modal').classList.remove('hidden')" class="px-4 py-2 rounded-xl bg-gradient-to-r from-[#912003] to-[#B93815] hover:from-[#6C1802] text-white text-xs font-cinzel font-bold shadow-md cursor-pointer transition-all">
                    ➕ Record Manual Daan
                </button>
                <a href="{{ route('donate') }}" target="_blank" class="px-4 py-2 rounded-xl bg-[#FAF7F2] hover:bg-[#E5DCD0] border border-[#DEC7A2] text-xs font-cinzel font-bold text-[#912003] transition-all">
                    🌐 Public Donation Page ↗
                </a>
            </div>
        </div>

        <div class="overflow-x-auto admin-scroll">
            <table class="w-full text-left text-xs">
                <thead class="bg-[#FAF7F2] text-[#422B1E] uppercase font-cinzel tracking-wider border-b border-[#E5DCD0] text-[11px]">
                    <tr>
                        <th class="py-3.5 px-4">Receipt No</th>
                        <th class="py-3.5 px-4">Donor Devotee</th>
                        <th class="py-3.5 px-4">PAN / Mobile</th>
                        <th class="py-3.5 px-4">Sanctum Cause</th>
                        <th class="py-3.5 px-4">Amount</th>
                        <th class="py-3.5 px-4">Payment Mode</th>
                        <th class="py-3.5 px-4">Date / Time</th>
                        <th class="py-3.5 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E5DCD0]/60 font-sans">
                    @forelse ($donations as $d)
                        <tr class="hover:bg-[#FAF7F2]/60 transition-colors">
                            <td class="py-3.5 px-4 font-mono font-bold text-[#912003] whitespace-nowrap">
                                {{ $d->receipt_number }}
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="font-cinzel font-bold text-sm text-[#1C120C] block">{{ $d->donor_name }}</span>
                                <span class="text-[10px] text-[#6C1802] font-mono">{{ $d->email }}</span>
                            </td>
                            <td class="py-3.5 px-4 font-mono text-[11px] whitespace-nowrap">
                                <div>{{ $d->mobile_number }}</div>
                                <div class="text-[10px] text-gray-500">PAN: {{ $d->pan_number ?: 'N/A' }}</div>
                            </td>
                            <td class="py-3.5 px-4 font-medium text-[#1C120C]">
                                {{ $d->seva_cause }}
                            </td>
                            <td class="py-3.5 px-4 font-mono font-black text-emerald-800 text-sm whitespace-nowrap">
                                ₹ {{ number_format($d->amount, 2) }}
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <span class="px-2.5 py-1 rounded-lg bg-[#FAF7F2] border border-[#DEC7A2] text-xs font-semibold text-[#1C120C]">
                                    {{ $d->payment_mode }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-[#6C1802] font-sans whitespace-nowrap">
                                {{ $d->created_at->format('d M Y, h:i A') }}
                            </td>
                            <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                <form action="{{ route('admin.donations.delete', $d->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this donation record?');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2.5 py-1 text-xs rounded-lg bg-red-50 text-red-700 hover:bg-red-100 font-semibold cursor-pointer">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-6 text-center text-gray-500">No donations recorded yet in database.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($donations->hasPages())
            <div class="p-4 border-t border-[#E5DCD0] bg-[#FAF7F2]">
                {{ $donations->links() }}
            </div>
        @endif
    </div>

    <!-- Record Manual Daan Modal -->
    <div id="add-donation-modal" class="hidden fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="bg-white max-w-lg w-full rounded-3xl border-2 border-[#CA8A04] shadow-2xl p-6 relative max-h-[90vh] overflow-y-auto admin-scroll">
            <div class="flex items-center justify-between pb-3 border-b border-[#E5DCD0]">
                <h3 class="font-cinzel text-lg font-bold text-[#1C120C]">💰 Record Devotee Daan (Direct to MySQL)</h3>
                <button onclick="document.getElementById('add-donation-modal').classList.add('hidden')" class="text-gray-400 hover:text-black font-bold text-xl cursor-pointer">✕</button>
            </div>

            <form action="{{ route('admin.donations.store') }}" method="POST" class="space-y-4 pt-4 text-xs font-sans">
                @csrf
                <div>
                    <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">Donor Devotee Name *</label>
                    <input type="text" name="donor_name" required placeholder="Full Name as on PAN card" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#1C120C] focus:outline-none focus:border-[#912003]">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">Email *</label>
                        <input type="email" name="email" required placeholder="devotee@gmail.com" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#1C120C]">
                    </div>
                    <div>
                        <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">Mobile / WhatsApp *</label>
                        <input type="text" name="mobile_number" required placeholder="9876543210" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#1C120C]">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">PAN Card (For 80G)</label>
                        <input type="text" name="pan_number" placeholder="ABCDE1234F" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs uppercase text-[#1C120C]">
                    </div>
                    <div>
                        <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">Daan Amount (₹) *</label>
                        <input type="number" name="amount" required min="1" placeholder="5100" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#1C120C]">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">Seva Cause *</label>
                        <select name="seva_cause" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#1C120C]">
                            <option value="Maha Annadanam">Maha Annadanam (Free Meals)</option>
                            <option value="Surabhi Gau Seva">Surabhi Gau Seva (Cows)</option>
                            <option value="Veda Vidyapeeth & Gurukula">Veda Vidyapeeth & Gurukula</option>
                            <option value="Akhand Jyoti & Mandir Preservation">Akhand Jyoti & Mandir Preservation</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">Payment Mode *</label>
                        <select name="payment_mode" class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#1C120C]">
                            <option value="UPI / Online">UPI / QR Code</option>
                            <option value="Cash Offering">Cash at Temple Hundi</option>
                            <option value="Bank Transfer">NEFT / RTGS</option>
                            <option value="Cheque">Cheque</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-[#422B1E] uppercase text-[10px] mb-1">Sankalpa / Notes</label>
                    <textarea name="notes" rows="2" placeholder="e.g. Birthday Sankalp, Family Remembrance..." class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-3.5 py-2 text-xs text-[#1C120C]"></textarea>
                </div>

                <div class="pt-2 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('add-donation-modal').classList.add('hidden')" class="px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-xs font-semibold cursor-pointer">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-[#912003] hover:bg-[#6C1802] text-white text-xs font-cinzel font-bold shadow-md cursor-pointer">
                        Save Daan Receipt ✓
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-admin.layout>

