<x-admin.layout title="Account & Security Settings" subtitle="Administrative Credentials & Profile Control">
    
    <!-- Success Alert -->
    @if (session('success'))
        <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-sm font-medium flex items-center justify-between gap-3 shadow-2xs">
            <div class="flex items-center gap-2.5">
                <span class="text-base">✅</span>
                <span>{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-black font-bold cursor-pointer">✕</button>
        </div>
    @endif

    <!-- Errors Alert -->
    @if ($errors->any())
        <div class="p-4 rounded-2xl bg-red-50 border border-red-200 text-red-900 text-xs sm:text-sm shadow-2xs">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Header info banner -->
    <div class="bg-white rounded-3xl p-6 border border-[#E5DCD0] shadow-[0_2px_14px_rgba(44,29,20,0.03)] flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#CA8A04] to-[#A16207] flex items-center justify-center text-[#1C120C] font-cinzel font-black text-2xl shadow-md shrink-0">
                {{ strtoupper(substr($admin->nickname ?: $admin->name, 0, 1)) }}
            </div>
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-[#A16207] font-cinzel bg-[#FAF7F2] px-2.5 py-0.5 rounded-full border border-[#E5DCD0]">
                    Trust Administrator Account
                </span>
                <h3 class="font-cinzel text-xl font-black text-[#1C120C] mt-1">
                    {{ $admin->nickname ?: $admin->name }}
                </h3>
                <p class="text-xs text-[#6C1802] font-sans">
                    {{ $admin->email }} • Primary Mobile: {{ $admin->mobile_number }}
                </p>
            </div>
        </div>

        <div class="flex items-center gap-2">
            <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold font-mono">
                ● Status: Active
            </span>
        </div>
    </div>

    <!-- 2 Column Settings Form (Yoga-Project Style) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- 1. Change Password Card (Yoga-Style) -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 border border-[#E5DCD0] shadow-[0_2px_16px_rgba(44,29,20,0.03)] space-y-5">
            <div class="flex items-center gap-3 pb-4 border-b border-[#E5DCD0]">
                <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center text-amber-700 font-bold text-lg border border-amber-200">
                    🔒
                </div>
                <div>
                    <h3 class="font-cinzel text-sm font-bold text-[#1C120C] uppercase tracking-wider">
                        Update Password (पासवर्ड बदलें)
                    </h3>
                    <p class="text-[11px] text-[#6C1802] font-sans">
                        Update your administrator credentials for secure access
                    </p>
                </div>
            </div>

            <form action="{{ route('admin.settings.password') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Current Password -->
                <div>
                    <label class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1 font-cinzel">
                        Current Password (वर्तमान पासवर्ड) <span class="text-red-600">*</span>
                    </label>
                    <input type="password" name="current_password" required
                        placeholder="Enter current password..."
                        class="w-full bg-[#FAF7F2] border border-[#E5DCD0] rounded-xl px-4 py-2.5 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003]">
                </div>

                <!-- New Password -->
                <div>
                    <label class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1 font-cinzel">
                        New Password (नया पासवर्ड) <span class="text-red-600">*</span>
                    </label>
                    <input type="password" name="new_password" required minlength="6"
                        placeholder="Minimum 6 characters..."
                        class="w-full bg-[#FAF7F2] border border-[#E5DCD0] rounded-xl px-4 py-2.5 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003]">
                </div>

                <!-- Confirm New Password -->
                <div>
                    <label class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1 font-cinzel">
                        Confirm New Password (पासवर्ड पुनः दर्ज करें) <span class="text-red-600">*</span>
                    </label>
                    <input type="password" name="new_password_confirmation" required minlength="6"
                        placeholder="Re-type new password..."
                        class="w-full bg-[#FAF7F2] border border-[#E5DCD0] rounded-xl px-4 py-2.5 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003]">
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-3 rounded-xl bg-gradient-to-r from-[#912003] to-[#B93815] hover:from-[#6C1802] hover:to-[#912003] text-[#FFFDF9] font-cinzel font-bold text-xs uppercase tracking-wider shadow-sm transition-all hover:scale-101 cursor-pointer">
                        🔒 Save New Password
                    </button>
                </div>
            </form>
        </div>

        <!-- 2. Admin Profile Details Card -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 border border-[#E5DCD0] shadow-[0_2px_16px_rgba(44,29,20,0.03)] space-y-5">
            <div class="flex items-center gap-3 pb-4 border-b border-[#E5DCD0]">
                <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center text-[#912003] font-bold text-lg border border-orange-200">
                    👤
                </div>
                <div>
                    <h3 class="font-cinzel text-sm font-bold text-[#1C120C] uppercase tracking-wider">
                        Admin Contact Info (प्रोफ़ाइल विवरण)
                    </h3>
                    <p class="text-[11px] text-[#6C1802] font-sans">
                        Update admin display name, contact phone & official email
                    </p>
                </div>
            </div>

            <form action="{{ route('admin.settings.profile') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Real Name -->
                <div>
                    <label class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1 font-cinzel">
                        Full Legal Name <span class="text-red-600">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name', $admin->name) }}" required
                        class="w-full bg-[#FAF7F2] border border-[#E5DCD0] rounded-xl px-4 py-2.5 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003]">
                </div>

                <!-- Nickname -->
                <div>
                    <label class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1 font-cinzel">
                        Display Title / Nickname <span class="text-red-600">*</span>
                    </label>
                    <input type="text" name="nickname" value="{{ old('nickname', $admin->nickname) }}" required
                        class="w-full bg-[#FAF7F2] border border-[#E5DCD0] rounded-xl px-4 py-2.5 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003]">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1 font-cinzel">
                        Official Admin Email (Login ID) <span class="text-red-600">*</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email', $admin->email) }}" required
                        class="w-full bg-[#FAF7F2] border border-[#E5DCD0] rounded-xl px-4 py-2.5 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003]">
                </div>

                <!-- Mobile -->
                <div>
                    <label class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1 font-cinzel">
                        Emergency Mobile Number <span class="text-red-600">*</span>
                    </label>
                    <input type="tel" name="mobile_number" value="{{ old('mobile_number', $admin->mobile_number) }}" required
                        class="w-full bg-[#FAF7F2] border border-[#E5DCD0] rounded-xl px-4 py-2.5 text-sm text-[#1C120C] focus:outline-none focus:border-[#912003]">
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-3 rounded-xl bg-white hover:bg-[#FAF7F2] border border-[#DEC7A2] text-[#912003] font-cinzel font-bold text-xs uppercase tracking-wider shadow-2xs transition-all hover:scale-101 cursor-pointer">
                        💾 Save Profile Information
                    </button>
                </div>
            </form>
        </div>

    </div>

    <!-- 3. Dynamic Homepage Media Customization (Hero & Section Images) -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-[#E5DCD0] shadow-[0_2px_16px_rgba(44,29,20,0.03)] space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-[#E5DCD0]">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-[#912003] font-bold text-2xl border border-amber-200 shadow-2xs">
                    🖼️
                </div>
                <div>
                    <h3 class="font-cinzel text-base sm:text-lg font-black text-[#1C120C] uppercase tracking-wider">
                        Home Page Dynamic Media & Hero Banners (मुख्य पृष्ठ छायाचित्र प्रबन्धन)
                    </h3>
                    <p class="text-xs text-[#6C1802] font-sans mt-0.5">
                        Upload custom high-definition photos for the main Hero sanctuary and public homepage narrative sections.
                    </p>
                </div>
            </div>
            <a href="{{ route('home') }}" target="_blank" class="px-4 py-2 rounded-xl bg-[#FAF7F2] hover:bg-[#E5DCD0] border border-[#DEC7A2] text-xs font-cinzel font-bold text-[#912003] transition-all self-start sm:self-auto">
                🌐 View Public Home Page ↗
            </a>
        </div>

        <form action="{{ route('admin.settings.homepage-media') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- 1. Hero Section Background Sanctuary -->
                @php
                    $heroImg = \App\Models\SiteSetting::getImageUrl('hero_mandir_image', 'images/hero-mandir.jpg');
                @endphp
                <div class="bg-[#FAF7F2] p-5 rounded-2xl border border-[#DEC7A2] space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-[#912003] font-cinzel">1. Hero Sanctuary Banner</span>
                        <span class="text-[10px] bg-amber-100 text-amber-900 px-2 py-0.5 rounded-full font-mono font-bold">Top of Home</span>
                    </div>

                    <!-- Thumbnail Preview -->
                    <div class="relative h-44 rounded-xl overflow-hidden border border-[#DEC7A2] group">
                        <img src="{{ $heroImg }}" alt="Hero Mandir Background" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent flex items-end p-3">
                            <span class="text-[11px] text-white font-cinzel font-bold">Current Active Hero Background</span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1 font-cinzel">
                            Upload New Hero Image
                        </label>
                        <input type="file" name="hero_mandir_image" accept="image/*"
                            class="w-full bg-white border border-[#E5DCD0] rounded-xl px-3.5 py-2 text-xs text-[#1C120C] file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#912003] file:text-white hover:file:bg-[#6C1802] file:cursor-pointer">
                        <span class="text-[11px] text-gray-500 italic mt-1 block font-sans">Recommended size: 1920x1080px (JPG, WebP, PNG max 8MB).</span>
                    </div>
                </div>

                <!-- 2. Chapter 1: Sacred Heritage & History Image -->
                @php
                    $aboutImg = \App\Models\SiteSetting::getImageUrl('about_history_image', 'images/mandir-aarti.jpg');
                @endphp
                <div class="bg-[#FAF7F2] p-5 rounded-2xl border border-[#DEC7A2] space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-[#912003] font-cinzel">2. Sacred Heritage Scroll Photo</span>
                        <span class="text-[10px] bg-blue-100 text-blue-900 px-2 py-0.5 rounded-full font-mono font-bold">Chapter 1 History</span>
                    </div>

                    <!-- Thumbnail Preview -->
                    <div class="relative h-44 rounded-xl overflow-hidden border border-[#DEC7A2] group">
                        <img src="{{ $aboutImg }}" alt="Mandir Heritage Photo" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent flex items-end p-3">
                            <span class="text-[11px] text-white font-cinzel font-bold">Current Active Heritage Photo</span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1 font-cinzel">
                            Upload New Heritage Photo
                        </label>
                        <input type="file" name="about_history_image" accept="image/*"
                            class="w-full bg-white border border-[#E5DCD0] rounded-xl px-3.5 py-2 text-xs text-[#1C120C] file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#912003] file:text-white hover:file:bg-[#6C1802] file:cursor-pointer">
                        <span class="text-[11px] text-gray-500 italic mt-1 block font-sans">Recommended size: 800x600px (JPG, WebP, PNG).</span>
                    </div>
                </div>

                <!-- 3. Chapter 3: 24/7 Akhand Live Darshan Broadcast Window -->
                @php
                    $darshanImg = \App\Models\SiteSetting::getImageUrl('live_darshan_image', 'images/mandir-aarti.jpg');
                @endphp
                <div class="bg-[#FAF7F2] p-5 rounded-2xl border border-[#DEC7A2] space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-[#912003] font-cinzel">3. Live Darshan Broadcast Photo</span>
                        <span class="text-[10px] bg-red-100 text-red-900 px-2 py-0.5 rounded-full font-mono font-bold">Chapter 3 Darshan</span>
                    </div>

                    <!-- Thumbnail Preview -->
                    <div class="relative h-44 rounded-xl overflow-hidden border border-[#DEC7A2] group">
                        <img src="{{ $darshanImg }}" alt="Live Aarti Window Photo" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent flex items-end p-3">
                            <span class="text-[11px] text-white font-cinzel font-bold">Current Active Live Broadcast Photo</span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1 font-cinzel">
                            Upload New Live Darshan Photo
                        </label>
                        <input type="file" name="live_darshan_image" accept="image/*"
                            class="w-full bg-white border border-[#E5DCD0] rounded-xl px-3.5 py-2 text-xs text-[#1C120C] file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#912003] file:text-white hover:file:bg-[#6C1802] file:cursor-pointer">
                        <span class="text-[11px] text-gray-500 italic mt-1 block font-sans">Recommended size: 1280x720px (16:9 aspect).</span>
                    </div>
                </div>

                <!-- 4. Chapter 4: Surabhi Goshala Seva Photo -->
                @php
                    $goshalaImg = \App\Models\SiteSetting::getImageUrl('goshala_seva_image', 'images/mandir-goshala.jpg');
                @endphp
                <div class="bg-[#FAF7F2] p-5 rounded-2xl border border-[#DEC7A2] space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-[#912003] font-cinzel">4. Surabhi Goshala Seva Photo</span>
                        <span class="text-[10px] bg-emerald-100 text-emerald-900 px-2 py-0.5 rounded-full font-mono font-bold">Chapter 4 Goshala</span>
                    </div>

                    <!-- Thumbnail Preview -->
                    <div class="relative h-44 rounded-xl overflow-hidden border border-[#DEC7A2] group">
                        <img src="{{ $goshalaImg }}" alt="Goshala Seva Photo" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent flex items-end p-3">
                            <span class="text-[11px] text-white font-cinzel font-bold">Current Active Goshala Photo</span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-wider font-bold text-[#2C1D14] mb-1 font-cinzel">
                            Upload New Goshala Photo
                        </label>
                        <input type="file" name="goshala_seva_image" accept="image/*"
                            class="w-full bg-white border border-[#E5DCD0] rounded-xl px-3.5 py-2 text-xs text-[#1C120C] file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#912003] file:text-white hover:file:bg-[#6C1802] file:cursor-pointer">
                        <span class="text-[11px] text-gray-500 italic mt-1 block font-sans">Recommended size: 800x600px (JPG, WebP, PNG).</span>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 border-t border-[#E5DCD0] flex justify-end">
                <button type="submit" class="px-8 py-3.5 rounded-2xl bg-gradient-to-r from-[#912003] to-[#B93815] hover:from-[#6C1802] text-[#FFFDF9] font-cinzel font-bold text-xs uppercase tracking-wider shadow-md hover:shadow-lg transition-all hover:scale-101 cursor-pointer">
                    💾 Save & Publish Home Page Images ✓
                </button>
            </div>
        </form>
    </div>

</x-admin.layout>
