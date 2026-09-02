<x-admin.layout title="Pavitra Daan Setup & Sevas" subtitle="Manage Sacred Seva Causes, Divine Impacts, Offering Amounts & Step Configuration (MySQL Dynamic)">
    
    <!-- Top Stats Banner -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5 mb-6">
        <div class="bg-white rounded-2xl p-5 border border-[#E5DCD0] shadow-2xs">
            <span class="text-xs font-bold uppercase tracking-wider text-[#A16207] font-cinzel block mb-1">Active Seva Causes</span>
            <div class="font-cinzel text-3xl font-black text-[#912003]">
                {{ $sevas->where('is_active', true)->count() }} / {{ $sevas->count() }}
            </div>
            <span class="text-[11px] text-emerald-700 font-sans font-bold">Available to Devotees</span>
        </div>
        
        <div class="bg-white rounded-2xl p-5 border border-[#E5DCD0] shadow-2xs">
            <span class="text-xs font-bold uppercase tracking-wider text-[#A16207] font-cinzel block mb-1">Default Pre-Selected Seva</span>
            <div class="font-cinzel text-lg font-black text-[#CA8A04] truncate">
                {{ $sevas->firstWhere('is_default', true)->title ?? 'Maha Annadanam' }}
            </div>
            <span class="text-[11px] text-[#6C1802] font-sans">Auto-selected on load</span>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-[#E5DCD0] shadow-2xs">
            <span class="text-xs font-bold uppercase tracking-wider text-[#A16207] font-cinzel block mb-1">Default Daan Amount</span>
            <div class="font-cinzel text-3xl font-black text-[#1C120C]">
                ₹ {{ number_format($settings['daan_default_amount']->value ?? 1100, 0) }}
            </div>
            <span class="text-[11px] text-[#6C1802] font-sans">Active Preset Pills</span>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-[#E5DCD0] shadow-2xs">
            <span class="text-xs font-bold uppercase tracking-wider text-[#A16207] font-cinzel block mb-1">Total Offerings Received</span>
            <div class="font-cinzel text-3xl font-black text-emerald-800">
                ₹ {{ number_format($totalDonations, 0) }}
            </div>
            <span class="text-[11px] text-[#6C1802] font-sans">{{ $totalDonorsCount }} Devotee Receipts</span>
        </div>
    </div>

    <!-- Alert Messages -->
    @if (session('success'))
        <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-300 text-emerald-900 text-xs sm:text-sm font-sans flex items-center gap-2 shadow-2xs">
            <span>✓</span> <span>{{ session('success') }}</span>
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 p-4 rounded-2xl bg-red-50 border border-red-300 text-red-900 text-xs sm:text-sm font-sans space-y-1 shadow-2xs">
            <div class="font-bold flex items-center gap-1.5">
                <span>⚠️</span> <span>Please correct the errors below:</span>
            </div>
            <ul class="list-disc list-inside ml-2">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        <!-- ================= LEFT: SACRED SEVA CAUSES (7 cols) ================= -->
        <div class="lg:col-span-7 space-y-6">
            <div class="bg-white rounded-3xl border border-[#E5DCD0] shadow-[0_2px_16px_rgba(44,29,20,0.03)] overflow-hidden">
                
                <div class="p-5 sm:p-6 border-b border-[#E5DCD0] flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-[#FAF7F2]/60">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs uppercase font-marcellus tracking-widest text-[#912003] font-bold">प्रथम चरण</span>
                            <span class="text-[10px] bg-[#912003]/10 text-[#912003] px-2 py-0.5 rounded-full font-bold">Dynamic Seva List</span>
                        </div>
                        <h3 class="font-cinzel text-lg font-black text-[#1C120C] mt-0.5">
                            Sacred Seva Causes (पवित्र सेवा सूची)
                        </h3>
                        <p class="text-xs text-[#6C1802] font-sans mt-0.5">
                            Devotees choose from these sevas. Each seva shows its custom Divine Impact note.
                        </p>
                    </div>

                    <button onclick="openAddSevaModal()" class="px-4 py-2 rounded-xl bg-gradient-to-r from-[#912003] to-[#B93815] hover:from-[#6C1802] text-white text-xs font-cinzel font-bold shadow-md hover:scale-105 transition-all cursor-pointer shrink-0">
                        ➕ Add New Sacred Seva
                    </button>
                </div>

                <!-- Sevas List Cards -->
                <div class="p-5 sm:p-6 space-y-4">
                    @forelse ($sevas as $seva)
                        <div class="rounded-2xl border {{ $seva->is_active ? ($seva->is_default ? 'border-[#912003] bg-[#FAF6EC]/80 ring-1 ring-[#912003]' : 'border-[#E5DCD0] bg-white') : 'border-gray-200 bg-gray-50 opacity-75' }} p-4 sm:p-5 transition-all hover:shadow-md relative">
                            
                            <div class="flex items-start justify-between gap-3">
                                <div class="flex items-start gap-3.5">
                                    <div class="w-10 h-10 rounded-xl bg-[#FFFDF9] border border-[#DEC7A2] flex items-center justify-center text-xl shrink-0 shadow-2xs">
                                        {{ $seva->icon ?: '🕉️' }}
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <h4 class="font-cinzel font-bold text-base text-[#1C120C]">
                                                {{ $seva->title }}
                                            </h4>
                                            @if ($seva->is_default)
                                                <span class="text-[10px] bg-[#912003] text-white font-bold px-2 py-0.5 rounded-full">
                                                    ★ Default Selected
                                                </span>
                                            @endif
                                            @if ($seva->is_active)
                                                <span class="text-[10px] bg-emerald-100 text-emerald-800 font-bold px-2 py-0.5 rounded-full border border-emerald-200">
                                                    Active
                                                </span>
                                            @else
                                                <span class="text-[10px] bg-gray-200 text-gray-700 font-bold px-2 py-0.5 rounded-full">
                                                    Hidden / Inactive
                                                </span>
                                            @endif
                                            <span class="text-[10px] font-mono text-[#A16207] bg-[#FAF7F2] px-1.5 py-0.5 rounded border border-[#DEC7A2]">
                                                Order: #{{ $seva->sort_order }}
                                            </span>
                                        </div>
                                        <p class="text-xs text-[#5C3C2A] mt-1 font-sans">
                                            {{ $seva->tagline }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex items-center gap-1.5 shrink-0">
                                    <button onclick="openEditSevaModal({{ json_encode($seva) }})" title="Edit Seva Details" class="p-2 rounded-lg bg-[#FAF7F2] hover:bg-[#E5DCD0] text-[#6C1802] border border-[#DEC7A2] transition-colors cursor-pointer text-xs font-bold">
                                        ✏️ Edit
                                    </button>

                                    <form action="{{ route('admin.pavitra-daan.sevas.toggle-status', $seva->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" title="{{ $seva->is_active ? 'Hide from public form' : 'Make visible on public form' }}" class="p-2 rounded-lg {{ $seva->is_active ? 'bg-amber-50 text-amber-800 border-amber-200 hover:bg-amber-100' : 'bg-emerald-50 text-emerald-800 border-emerald-200 hover:bg-emerald-100' }} border transition-colors cursor-pointer text-xs font-bold">
                                            {{ $seva->is_active ? 'Disable' : 'Enable' }}
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.pavitra-daan.sevas.delete', $seva->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete Sacred Seva \'{{ $seva->title }}\'? Devotee offerings made to this cause will remain preserved.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Delete Seva" class="p-2 rounded-lg bg-red-50 hover:bg-red-100 text-red-700 border border-red-200 transition-colors cursor-pointer text-xs font-bold">
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Divine Impact Box Preview -->
                            <div class="mt-3 pt-3 border-t border-[#DEC7A2]/40 flex items-start gap-2 bg-[#FFFDF9]/60 p-2.5 rounded-xl text-xs font-sans text-[#422B1E]">
                                <span class="text-[#912003] font-bold uppercase tracking-wider text-[10px] shrink-0 mt-0.5">Divine Impact:</span>
                                <span class="italic text-[#5C3C2A]">"{{ $seva->impact_description }}"</span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10 bg-[#FAF7F2] rounded-2xl border border-dashed border-[#DEC7A2]">
                            <p class="font-cinzel text-sm font-bold text-[#6C1802]">No Sacred Sevas found.</p>
                            <p class="text-xs text-[#5C3C2A] mt-1">Click "Add New Sacred Seva" to create your first offering option.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- ================= RIGHT: DAAN OFFERING SETTINGS (5 cols) ================= -->
        <div class="lg:col-span-5 space-y-6">
            <div class="bg-white rounded-3xl border border-[#E5DCD0] shadow-[0_2px_16px_rgba(44,29,20,0.03)] overflow-hidden">
                
                <div class="p-5 sm:p-6 border-b border-[#E5DCD0] bg-[#FAF7F2]/60">
                    <div class="flex items-center gap-2">
                        <span class="text-xs uppercase font-marcellus tracking-widest text-[#912003] font-bold">द्वितीय चरण</span>
                        <span class="text-[10px] bg-[#CA8A04]/20 text-[#A16207] px-2 py-0.5 rounded-full font-bold">Amount & Notes</span>
                    </div>
                    <h3 class="font-cinzel text-lg font-black text-[#1C120C] mt-0.5">
                        Select Daan Offering Settings
                    </h3>
                    <p class="text-xs text-[#6C1802] font-sans mt-0.5">
                        Configure preset amount buttons, step headings, 80G tax notes, and submit actions.
                    </p>
                </div>

                <form action="{{ route('admin.pavitra-daan.settings.update') }}" method="POST" enctype="multipart/form-data" class="p-5 sm:p-6 space-y-5">
                    @csrf

                    <!-- 1. Preset Amounts Pills -->
                    <div>
                        <label for="daan_preset_amounts" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                            1. Preset Amount Buttons (₹ Comma-Separated) <span class="text-[#912003]">*</span>
                        </label>
                        <input type="text" id="daan_preset_amounts" name="daan_preset_amounts" required
                            value="{{ old('daan_preset_amounts', $settings['daan_preset_amounts']->value ?? '501, 1100, 2100, 5100') }}"
                            placeholder="e.g. 501, 1100, 2100, 5100"
                            class="w-full bg-[#FAF7F2] border border-[#DEC7A2] rounded-xl px-4 py-2.5 text-sm font-cinzel font-bold text-[#912003] focus:outline-none focus:border-[#912003]">
                        <p class="text-[11px] text-[#6C1802] mt-1 font-sans">
                            These appear as clickable offering buttons for devotees.
                        </p>
                    </div>

                    <!-- 2. Default Selected Amount -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="daan_default_amount" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                                2. Default Selected Amount (₹) <span class="text-[#912003]">*</span>
                            </label>
                            <input type="number" id="daan_default_amount" name="daan_default_amount" required min="1"
                                value="{{ old('daan_default_amount', $settings['daan_default_amount']->value ?? '1100') }}"
                                class="w-full bg-[#FAF7F2] border border-[#DEC7A2] rounded-xl px-4 py-2.5 text-sm font-cinzel font-bold text-[#1C120C] focus:outline-none focus:border-[#912003]">
                        </div>

                        <div>
                            <label for="daan_custom_amount_label" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                                Custom Amount Label
                            </label>
                            <input type="text" id="daan_custom_amount_label" name="daan_custom_amount_label" required
                                value="{{ old('daan_custom_amount_label', $settings['daan_custom_amount_label']->value ?? 'Or Enter Custom Amount (₹)') }}"
                                class="w-full bg-[#FAF7F2] border border-[#DEC7A2] rounded-xl px-4 py-2.5 text-xs text-[#1C120C] focus:outline-none focus:border-[#912003]">
                        </div>
                    </div>

                    <!-- Step 1 & Step 2 Titles -->
                    <div class="p-4 bg-[#FAF7F2] rounded-2xl border border-[#DEC7A2]/60 space-y-3">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-[#A16207] font-cinzel block">
                            Form Step Headings & Badges
                        </span>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label for="daan_step1_badge" class="block text-[10px] uppercase font-bold text-[#422B1E] mb-1">Step 1 Badge</label>
                                <input type="text" id="daan_step1_badge" name="daan_step1_badge" required
                                    value="{{ old('daan_step1_badge', $settings['daan_step1_badge']->value ?? 'प्रथम चरण') }}"
                                    class="w-full bg-white border border-[#DEC7A2] rounded-xl px-3 py-2 text-xs">
                            </div>
                            <div>
                                <label for="daan_step1_title" class="block text-[10px] uppercase font-bold text-[#422B1E] mb-1">Step 1 Title</label>
                                <input type="text" id="daan_step1_title" name="daan_step1_title" required
                                    value="{{ old('daan_step1_title', $settings['daan_step1_title']->value ?? 'Choose Sacred Seva') }}"
                                    class="w-full bg-white border border-[#DEC7A2] rounded-xl px-3 py-2 text-xs">
                            </div>

                            <div>
                                <label for="daan_step2_badge" class="block text-[10px] uppercase font-bold text-[#422B1E] mb-1">Step 2 Badge</label>
                                <input type="text" id="daan_step2_badge" name="daan_step2_badge" required
                                    value="{{ old('daan_step2_badge', $settings['daan_step2_badge']->value ?? 'द्वितीय चरण') }}"
                                    class="w-full bg-white border border-[#DEC7A2] rounded-xl px-3 py-2 text-xs">
                            </div>
                            <div>
                                <label for="daan_step2_title" class="block text-[10px] uppercase font-bold text-[#422B1E] mb-1">Step 2 Title</label>
                                <input type="text" id="daan_step2_title" name="daan_step2_title" required
                                    value="{{ old('daan_step2_title', $settings['daan_step2_title']->value ?? 'Select Daan Offering') }}"
                                    class="w-full bg-white border border-[#DEC7A2] rounded-xl px-3 py-2 text-xs">
                            </div>
                        </div>
                    </div>

                    <!-- Trust Notes & Badges -->
                    <div class="space-y-3">
                        <div>
                            <label for="daan_80g_note" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                                80G Tax Exemption Note
                            </label>
                            <input type="text" id="daan_80g_note" name="daan_80g_note" required
                                value="{{ old('daan_80g_note', $settings['daan_80g_note']->value ?? '📜 80G Tax Exemption Certificate emailed immediately.') }}"
                                class="w-full bg-[#FAF7F2] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#1C120C]">
                        </div>

                        <div>
                            <label for="daan_security_note" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                                Security / Trust Note
                            </label>
                            <input type="text" id="daan_security_note" name="daan_security_note" required
                                value="{{ old('daan_security_note', $settings['daan_security_note']->value ?? '🔒 100% Encrypted & Govt Compliant Charitable Account.') }}"
                                class="w-full bg-[#FAF7F2] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#1C120C]">
                        </div>

                        <div>
                            <label for="daan_button_text" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                                Submit Button Text
                            </label>
                            <input type="text" id="daan_button_text" name="daan_button_text" required
                                value="{{ old('daan_button_text', $settings['daan_button_text']->value ?? 'Proceed to Divine Offering & Save Receipt 💳') }}"
                                class="w-full bg-[#FAF7F2] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs text-[#1C120C]">
                        </div>

                        <div>
                            <label for="daan_upi_id" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                                Mandir Trust UPI ID (Optional)
                            </label>
                            <input type="text" id="daan_upi_id" name="daan_upi_id"
                                value="{{ old('daan_upi_id', $settings['daan_upi_id']->value ?? 'shringirishi.trust@sbi') }}"
                                placeholder="e.g. shringirishi.trust@sbi"
                                class="w-full bg-[#FAF7F2] border border-[#DEC7A2] rounded-xl px-3.5 py-2.5 text-xs font-mono text-[#1C120C]">
                        </div>
                    </div>

                    <button type="submit" class="w-full py-3.5 rounded-xl bg-gradient-to-r from-[#912003] via-[#B93815] to-[#912003] hover:from-[#6C1802] text-white font-cinzel font-bold text-xs uppercase tracking-widest shadow-md hover:scale-[1.02] transition-all cursor-pointer">
                        💾 Save Pavitra Daan Settings
                    </button>
                </form>
            </div>
            
            <div class="text-center">
                <a href="{{ route('donate') }}" target="_blank" class="inline-flex items-center gap-2 text-xs font-cinzel font-bold text-[#912003] hover:underline">
                    <span>🌐 View Public Pavitra Daan Page</span> <span>↗</span>
                </a>
            </div>
        </div>

    </div>

    <!-- ================= MODAL: ADD NEW SACRED SEVA ================= -->
    <div id="add-seva-modal" class="hidden fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4 overflow-y-auto">
        <div class="bg-white rounded-3xl border border-[#DEC7A2] shadow-2xl max-w-lg w-full p-6 sm:p-8 space-y-5 animate-scale-in">
            <div class="flex items-center justify-between border-b border-[#E5DCD0] pb-3">
                <div class="flex items-center gap-2">
                    <span class="text-xl">➕</span>
                    <h3 class="font-cinzel text-lg font-bold text-[#1C120C]">Add Sacred Seva Cause</h3>
                </div>
                <button onclick="closeAddSevaModal()" class="w-8 h-8 rounded-full bg-[#FAF7F2] hover:bg-red-50 text-gray-500 hover:text-red-700 flex items-center justify-center font-bold">✕</button>
            </div>

            <form action="{{ route('admin.pavitra-daan.sevas.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs uppercase font-bold text-[#2C1D14] mb-1">Seva Title (नाम) <span class="text-[#912003]">*</span></label>
                    <input type="text" name="title" required placeholder="e.g. Maha Annadanam, Gau Grass Seva" class="w-full bg-[#FAF7F2] border border-[#DEC7A2] rounded-xl px-4 py-2.5 text-sm text-[#1C120C]">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div class="sm:col-span-2">
                        <label class="block text-xs uppercase font-bold text-[#2C1D14] mb-1">Tagline / Subtitle <span class="text-[#912003]">*</span></label>
                        <input type="text" name="tagline" required placeholder="e.g. Sponsor daily free food for devotees." class="w-full bg-[#FAF7F2] border border-[#DEC7A2] rounded-xl px-4 py-2.5 text-sm text-[#1C120C]">
                    </div>
                    <div>
                        <label class="block text-xs uppercase font-bold text-[#2C1D14] mb-1">Icon / Emoji</label>
                        <input type="text" name="icon" value="🕉️" placeholder="🍲, 🐄, 🪔" class="w-full bg-[#FAF7F2] border border-[#DEC7A2] rounded-xl px-3 py-2.5 text-sm text-center">
                    </div>
                </div>

                <div>
                    <label class="block text-xs uppercase font-bold text-[#2C1D14] mb-1">Divine Impact Note (प्रभाव विवरण) <span class="text-[#912003]">*</span></label>
                    <textarea name="impact_description" required rows="3" placeholder="e.g. Feeds 5,000+ daily pilgrims with fresh, hot sattvic Mahaprasadam." class="w-full bg-[#FAF7F2] border border-[#DEC7A2] rounded-xl p-3 text-xs text-[#1C120C]"></textarea>
                    <p class="text-[10px] text-[#6C1802] mt-0.5">This text dynamically replaces the 'Divine Impact' box when the devotee selects this seva.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
                    <div>
                        <label class="block text-xs uppercase font-bold text-[#2C1D14] mb-1">Display Sort Order</label>
                        <input type="number" name="sort_order" value="{{ $sevas->count() + 1 }}" class="w-full bg-[#FAF7F2] border border-[#DEC7A2] rounded-xl px-3 py-2 text-xs">
                    </div>
                    <div class="flex items-center pt-6">
                        <label class="flex items-center gap-2 text-xs font-semibold cursor-pointer">
                            <input type="checkbox" name="is_default" value="1" class="rounded text-[#912003]">
                            <span>Set as Default Selected Seva</span>
                        </label>
                    </div>
                </div>

                <div class="pt-3 border-t border-[#E5DCD0] flex justify-end gap-3">
                    <button type="button" onclick="closeAddSevaModal()" class="px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-xs font-bold font-cinzel text-gray-700">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#912003] hover:bg-[#6C1802] text-white font-cinzel font-bold text-xs uppercase tracking-wider shadow-md">Publish Sacred Seva</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ================= MODAL: EDIT SACRED SEVA ================= -->
    <div id="edit-seva-modal" class="hidden fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4 overflow-y-auto">
        <div class="bg-white rounded-3xl border border-[#DEC7A2] shadow-2xl max-w-lg w-full p-6 sm:p-8 space-y-5 animate-scale-in">
            <div class="flex items-center justify-between border-b border-[#E5DCD0] pb-3">
                <div class="flex items-center gap-2">
                    <span class="text-xl">✏️</span>
                    <h3 class="font-cinzel text-lg font-bold text-[#1C120C]">Edit Sacred Seva Cause</h3>
                </div>
                <button onclick="closeEditSevaModal()" class="w-8 h-8 rounded-full bg-[#FAF7F2] hover:bg-red-50 text-gray-500 hover:text-red-700 flex items-center justify-center font-bold">✕</button>
            </div>

            <form id="edit-seva-form" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs uppercase font-bold text-[#2C1D14] mb-1">Seva Title (नाम) <span class="text-[#912003]">*</span></label>
                    <input type="text" id="edit_title" name="title" required class="w-full bg-[#FAF7F2] border border-[#DEC7A2] rounded-xl px-4 py-2.5 text-sm text-[#1C120C]">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div class="sm:col-span-2">
                        <label class="block text-xs uppercase font-bold text-[#2C1D14] mb-1">Tagline / Subtitle <span class="text-[#912003]">*</span></label>
                        <input type="text" id="edit_tagline" name="tagline" required class="w-full bg-[#FAF7F2] border border-[#DEC7A2] rounded-xl px-4 py-2.5 text-sm text-[#1C120C]">
                    </div>
                    <div>
                        <label class="block text-xs uppercase font-bold text-[#2C1D14] mb-1">Icon / Emoji</label>
                        <input type="text" id="edit_icon" name="icon" class="w-full bg-[#FAF7F2] border border-[#DEC7A2] rounded-xl px-3 py-2.5 text-sm text-center">
                    </div>
                </div>

                <div>
                    <label class="block text-xs uppercase font-bold text-[#2C1D14] mb-1">Divine Impact Note (प्रभाव विवरण) <span class="text-[#912003]">*</span></label>
                    <textarea id="edit_impact_description" name="impact_description" required rows="3" class="w-full bg-[#FAF7F2] border border-[#DEC7A2] rounded-xl p-3 text-xs text-[#1C120C]"></textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
                    <div>
                        <label class="block text-xs uppercase font-bold text-[#2C1D14] mb-1">Display Sort Order</label>
                        <input type="number" id="edit_sort_order" name="sort_order" class="w-full bg-[#FAF7F2] border border-[#DEC7A2] rounded-xl px-3 py-2 text-xs">
                    </div>
                    <div class="flex items-center pt-6">
                        <label class="flex items-center gap-2 text-xs font-semibold cursor-pointer">
                            <input type="checkbox" id="edit_is_default" name="is_default" value="1" class="rounded text-[#912003]">
                            <span>Set as Default Selected Seva</span>
                        </label>
                    </div>
                </div>

                <div class="pt-3 border-t border-[#E5DCD0] flex justify-end gap-3">
                    <button type="button" onclick="closeEditSevaModal()" class="px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-xs font-bold font-cinzel text-gray-700">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#912003] hover:bg-[#6C1802] text-white font-cinzel font-bold text-xs uppercase tracking-wider shadow-md">Update Sacred Seva</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script for Modals -->
    <script>
        function openAddSevaModal() {
            document.getElementById('add-seva-modal').classList.remove('hidden');
        }

        function closeAddSevaModal() {
            document.getElementById('add-seva-modal').classList.add('hidden');
        }

        function openEditSevaModal(seva) {
            document.getElementById('edit-seva-form').action = '/mandiradmin/pavitra-daan/sevas/' + seva.id;
            document.getElementById('edit_title').value = seva.title || '';
            document.getElementById('edit_tagline').value = seva.tagline || '';
            document.getElementById('edit_icon').value = seva.icon || '🕉️';
            document.getElementById('edit_impact_description').value = seva.impact_description || '';
            document.getElementById('edit_sort_order').value = seva.sort_order || 1;
            document.getElementById('edit_is_default').checked = seva.is_default ? true : false;
            document.getElementById('edit-seva-modal').classList.remove('hidden');
        }

        function closeEditSevaModal() {
            document.getElementById('edit-seva-modal').classList.add('hidden');
        }
    </script>
</x-admin.layout>
