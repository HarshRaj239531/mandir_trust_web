@props(['title' => 'Dashboard', 'subtitle' => 'Overview & Devotee Management'])
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} | Mandir Admin Sanctum</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@700;900&family=Cinzel:wght@400;600;700;800;900&family=Marcellus&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .font-cinzel { font-family: 'Cinzel', serif; }
        .font-marcellus { font-family: 'Marcellus', serif; }
        .font-body { font-family: 'Outfit', sans-serif; }
        
        /* Clean custom scrollbar */
        .admin-scroll::-webkit-scrollbar {
            height: 6px;
            width: 6px;
        }
        .admin-scroll::-webkit-scrollbar-track {
            background: #FAF7F2;
        }
        .admin-scroll::-webkit-scrollbar-thumb {
            background: #DEC7A2;
            border-radius: 4px;
        }
        .admin-scroll::-webkit-scrollbar-thumb:hover {
            background: #912003;
        }
    </style>
</head>
<body class="antialiased bg-[#FAF7F2] text-[#2C1D14] min-h-screen flex selection:bg-[#912003] selection:text-white font-body overflow-x-hidden">

    <!-- 1. Light Clean Sidebar -->
    <x-admin.sidebar />

    <!-- 2. Main Area (Spacious & properly padded, no clipping!) -->
    <div class="flex-grow lg:pl-64 flex flex-col min-h-screen w-full overflow-x-hidden">
        
        <!-- 3. Clean Header -->
        <x-admin.header :title="$title" :subtitle="$subtitle" />

        <!-- 4. Dynamic Page Content -->
        <main class="flex-grow p-4 sm:p-6 lg:p-8 space-y-6 max-w-7xl w-full mx-auto">
            {{ $slot }}
        </main>

        <!-- 5. Admin Footer -->
        <footer class="bg-white border-t border-[#E5DCD0] py-4 px-6 text-center text-xs text-[#6C1802] font-marcellus mt-8 flex flex-col sm:flex-row items-center justify-between gap-2">
            <span>॥ ॐ नमः शिवाय ॥ Shri Mandir Trust Management Core</span>
            <span class="text-[11px] text-[#A16207]">Secure Administrative Portal</span>
        </footer>
    </div>

    <!-- Reusable Photo Preview Modal -->
    <div id="photo-modal" class="fixed inset-0 z-50 bg-black/75 hidden items-center justify-center p-4 backdrop-blur-xs">
        <div class="bg-white rounded-3xl p-6 max-w-sm w-full text-center relative border border-[#E5DCD0] shadow-2xl">
            <button onclick="closePhotoModal()" class="absolute top-3 right-3 text-lg font-bold text-[#6C1802] hover:text-black w-8 h-8 rounded-full bg-[#FAF7F2] flex items-center justify-center">✕</button>
            <h4 id="modal-nickname" class="font-cinzel text-lg font-black text-[#912003]"></h4>
            <p id="modal-fullname" class="text-xs text-[#6C1802] font-marcellus mb-4"></p>
            <div class="w-60 h-60 mx-auto rounded-2xl overflow-hidden border border-[#DEC7A2] shadow-sm bg-[#FAF7F2]">
                <img id="modal-photo" src="" alt="" class="w-full h-full object-cover">
            </div>
        </div>
    </div>

    <!-- Core Admin Scripts -->
    <script>
        function toggleAdminSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        }

        function viewPhotoModal(url, nickname, fullname) {
            document.getElementById('modal-photo').src = url;
            document.getElementById('modal-nickname').innerText = nickname;
            document.getElementById('modal-fullname').innerText = 'Legal Name: ' + fullname;
            document.getElementById('photo-modal').classList.remove('hidden');
            document.getElementById('photo-modal').classList.add('flex');
        }

        function closePhotoModal() {
            document.getElementById('photo-modal').classList.add('hidden');
            document.getElementById('photo-modal').classList.remove('flex');
        }
    </script>
</body>
</html>
