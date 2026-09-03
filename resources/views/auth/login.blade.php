<x-layout title="Devotee Login | भक्त लॉगिन | Shringi Rishi Mandir Trust">
    <x-navbar />

    <div class="min-h-[80vh] py-10 sm:py-16 px-3 sm:px-6 relative flex items-center justify-center">
        
        <!-- Sacred Vedic Parchment Box -->
        <div class="max-w-md w-full parchment-scroll royal-gold-frame rounded-3xl p-6 sm:p-10 shadow-[0_20px_60px_rgba(44,29,20,0.2)] border-2 border-[#CA8A04] relative">
            <x-gold-corners size="w-8 h-8 sm:w-9 sm:h-9" />

            <!-- Header -->
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-br from-[#FFFDF9] to-[#FAF6EC] border-2 border-[#CA8A04] shadow-md mb-3 text-[#912003]">
                    <span class="font-cinzel text-3xl font-black">ॐ</span>
                </div>
                <h1 class="font-cinzel text-2xl sm:text-3xl font-bold text-[#1C120C]">
                    भक्त लॉगिन
                </h1>
                <p class="font-marcellus text-xs text-[#912003] uppercase tracking-widest mt-1">
                    Devotee Sacred Portal Login
                </p>
                <div class="w-24 h-[2px] bg-gradient-to-r from-transparent via-[#CA8A04] to-transparent mx-auto mt-2.5"></div>
            </div>

            <!-- Flash Success Message -->
            @if (session('success'))
                <div class="mb-4 p-3 rounded-xl bg-emerald-800/10 border border-emerald-800/30 text-emerald-900 text-xs text-center font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Errors Alert -->
            @if ($errors->any())
                <div class="mb-4 p-3 rounded-xl bg-[#912003]/10 border border-[#912003]/30 text-[#912003] text-xs text-center font-medium">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Devotee Member ID (DS...) -->
                <div>
                    <label for="login" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1">
                        Member ID <span class="text-[#912003]">*</span>
                    </label>
                    <input type="text" id="login" name="login" value="{{ old('login') }}" required autofocus
                        placeholder="e.g. DS826730159463"
                        class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-4 py-2.5 text-sm text-[#1C120C] font-mono tracking-wide focus:outline-none focus:border-[#912003] focus:ring-1 focus:ring-[#912003] transition-all">
                    <span class="text-[11px] text-[#6C1802] mt-1 block">Enter your 12-digit Member ID received after registration (e.g., DS826730159463).</span>
                </div>

                <!-- Password -->
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label for="password" class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14]">
                            Password
                        </label>
                    </div>
                    <input type="password" id="password" name="password" required
                        placeholder="Enter your password"
                        class="w-full bg-[#FAF6EC] border border-[#DEC7A2] rounded-xl px-4 py-2.5 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003] focus:ring-1 focus:ring-[#912003] transition-all">
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between text-xs text-[#422B1E]">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-[#DEC7A2] text-[#912003] focus:ring-[#912003]">
                        <span>Remember Me</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" class="shimmer-btn hover-lift w-full py-3 rounded-full font-cinzel font-bold text-sm uppercase tracking-widest shadow-md border border-[#DEC7A2]/60 transition-all duration-300 hover:scale-105 cursor-pointer" style="background: linear-gradient(135deg, #912003 0%, #B93815 50%, #912003 100%) !important; color: #FFFDF9 !important;">
                        <span style="color: #FFFDF9 !important;">॥ Devotee Sign In ॥</span>
                    </button>
                </div>
            </form>

            <div class="mt-6 pt-4 border-t border-[#DEC7A2]/60 text-center space-y-3">
                <p class="text-xs text-[#6C1802] font-marcellus">
                    New Devotee? 
                    <a href="{{ route('register') }}" class="text-[#912003] font-bold underline hover:text-black ml-1">
                        Register Here
                    </a>
                </p>

                <!-- Admin Access Note -->
                <!-- <div class="p-3 rounded-2xl bg-[#FAF6EC] border border-[#DEC7A2] text-left text-xs font-sans">
                    <div class="flex items-center justify-between text-[#912003] font-cinzel font-bold mb-1">
                        <span>🛡️ Mandir Trust Admin Portal (प्रशासनिक संकुल):</span>
                        <span class="text-[10px] bg-[#912003]/10 px-2 py-0.5 rounded-full">Administrator</span>
                    </div>
                    <div class="text-[#422B1E] space-y-0.5 font-mono text-[11px]">
                        <div>ID: <strong class="text-[#1C120C]">mandiradmin@gmail.com</strong></div>
                        <div>Password: <strong class="text-[#1C120C]">Admin@12345</strong></div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</x-layout>
