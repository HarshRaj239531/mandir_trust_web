@props([
    'size' => 'w-12 h-12 md:w-16 md:h-16',
    'opacity' => 'opacity-90 group-hover:opacity-100',
])

<!-- 4 Ornate Royal Gold Filigree Corners Matching Antique Vedic Frame -->
<div class="pointer-events-none select-none z-20">
    <!-- Top-Left Corner -->
    <div class="absolute -top-1.5 -left-1.5 {{ $size }} {{ $opacity }} transition-all duration-300 transform group-hover:scale-105">
        <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full drop-shadow-[0_2px_4px_rgba(110,40,5,0.3)]">
            <defs>
                <linearGradient id="cornerGoldGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" stop-color="#CA8A04" />
                    <stop offset="25%" stop-color="#FDE047" />
                    <stop offset="50%" stop-color="#FFFBEB" />
                    <stop offset="75%" stop-color="#EAB308" />
                    <stop offset="100%" stop-color="#854D0E" />
                </linearGradient>
            </defs>
            <!-- Corner Spear / Finial -->
            <path d="M 6 6 L 24 10 C 20 14, 14 20, 10 24 Z" fill="url(#cornerGoldGrad)" />
            <circle cx="8" cy="8" r="3.5" fill="url(#cornerGoldGrad)" />
            
            <!-- Outer Double Connecting Track Lines -->
            <path d="M 28 8 L 96 8" stroke="url(#cornerGoldGrad)" stroke-width="2.5" stroke-linecap="round" />
            <path d="M 32 14 L 96 14" stroke="url(#cornerGoldGrad)" stroke-width="1.5" stroke-linecap="round" />
            <path d="M 8 28 L 8 96" stroke="url(#cornerGoldGrad)" stroke-width="2.5" stroke-linecap="round" />
            <path d="M 14 32 L 14 96" stroke="url(#cornerGoldGrad)" stroke-width="1.5" stroke-linecap="round" />

            <!-- Main Intricate Filigree Swirls & Leaf Scrollwork -->
            <path d="M 12 12 C 18 6, 32 6, 38 12 C 44 18, 38 28, 28 28 C 18 28, 14 20, 18 16 C 22 12, 28 14, 28 18 C 28 22, 22 22, 20 20" stroke="url(#cornerGoldGrad)" stroke-width="2.2" fill="none" stroke-linecap="round" />
            
            <path d="M 38 12 C 48 10, 62 16, 56 26 C 50 36, 36 30, 32 24 C 28 18, 32 14, 38 12 Z" fill="url(#cornerGoldGrad)" fill-opacity="0.85" />
            <path d="M 12 38 C 10 48, 16 62, 26 56 C 36 50, 30 36, 24 32 C 18 28, 14 32, 12 38 Z" fill="url(#cornerGoldGrad)" fill-opacity="0.85" />
            
            <!-- Tendrils and Leaf Buds -->
            <path d="M 24 32 C 18 42, 22 58, 14 74 C 10 82, 6 90, 8 96" stroke="url(#cornerGoldGrad)" stroke-width="2" fill="none" stroke-linecap="round" />
            <path d="M 32 24 C 42 18, 58 22, 74 14 C 82 10, 90 6, 96 8" stroke="url(#cornerGoldGrad)" stroke-width="2" fill="none" stroke-linecap="round" />
            
            <!-- Secondary Decorative C-Curls -->
            <path d="M 26 26 C 36 36, 44 44, 48 38 C 52 32, 42 26, 34 26" stroke="url(#cornerGoldGrad)" stroke-width="1.8" fill="none" stroke-linecap="round" />
            <circle cx="48" cy="38" r="2.5" fill="url(#cornerGoldGrad)" />
            <circle cx="38" cy="48" r="2.5" fill="url(#cornerGoldGrad)" />
            <circle cx="28" cy="18" r="2" fill="url(#cornerGoldGrad)" />
            <circle cx="18" cy="28" r="2" fill="url(#cornerGoldGrad)" />
        </svg>
    </div>

    <!-- Top-Right Corner -->
    <div class="absolute -top-1.5 -right-1.5 {{ $size }} {{ $opacity }} transition-all duration-300 transform scale-x-[-1] group-hover:scale-x-[-1] group-hover:scale-y-105">
        <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full drop-shadow-[0_2px_4px_rgba(110,40,5,0.3)]">
            <use href="#cornerGoldGrad" />
            <!-- Corner Spear / Finial -->
            <path d="M 6 6 L 24 10 C 20 14, 14 20, 10 24 Z" fill="url(#cornerGoldGrad)" />
            <circle cx="8" cy="8" r="3.5" fill="url(#cornerGoldGrad)" />
            
            <!-- Outer Double Connecting Track Lines -->
            <path d="M 28 8 L 96 8" stroke="url(#cornerGoldGrad)" stroke-width="2.5" stroke-linecap="round" />
            <path d="M 32 14 L 96 14" stroke="url(#cornerGoldGrad)" stroke-width="1.5" stroke-linecap="round" />
            <path d="M 8 28 L 8 96" stroke="url(#cornerGoldGrad)" stroke-width="2.5" stroke-linecap="round" />
            <path d="M 14 32 L 14 96" stroke="url(#cornerGoldGrad)" stroke-width="1.5" stroke-linecap="round" />

            <!-- Main Intricate Filigree Swirls & Leaf Scrollwork -->
            <path d="M 12 12 C 18 6, 32 6, 38 12 C 44 18, 38 28, 28 28 C 18 28, 14 20, 18 16 C 22 12, 28 14, 28 18 C 28 22, 22 22, 20 20" stroke="url(#cornerGoldGrad)" stroke-width="2.2" fill="none" stroke-linecap="round" />
            
            <path d="M 38 12 C 48 10, 62 16, 56 26 C 50 36, 36 30, 32 24 C 28 18, 32 14, 38 12 Z" fill="url(#cornerGoldGrad)" fill-opacity="0.85" />
            <path d="M 12 38 C 10 48, 16 62, 26 56 C 36 50, 30 36, 24 32 C 18 28, 14 32, 12 38 Z" fill="url(#cornerGoldGrad)" fill-opacity="0.85" />
            
            <!-- Tendrils and Leaf Buds -->
            <path d="M 24 32 C 18 42, 22 58, 14 74 C 10 82, 6 90, 8 96" stroke="url(#cornerGoldGrad)" stroke-width="2" fill="none" stroke-linecap="round" />
            <path d="M 32 24 C 42 18, 58 22, 74 14 C 82 10, 90 6, 96 8" stroke="url(#cornerGoldGrad)" stroke-width="2" fill="none" stroke-linecap="round" />
            
            <!-- Secondary Decorative C-Curls -->
            <path d="M 26 26 C 36 36, 44 44, 48 38 C 52 32, 42 26, 34 26" stroke="url(#cornerGoldGrad)" stroke-width="1.8" fill="none" stroke-linecap="round" />
            <circle cx="48" cy="38" r="2.5" fill="url(#cornerGoldGrad)" />
            <circle cx="38" cy="48" r="2.5" fill="url(#cornerGoldGrad)" />
            <circle cx="28" cy="18" r="2" fill="url(#cornerGoldGrad)" />
            <circle cx="18" cy="28" r="2" fill="url(#cornerGoldGrad)" />
        </svg>
    </div>

    <!-- Bottom-Left Corner -->
    <div class="absolute -bottom-1.5 -left-1.5 {{ $size }} {{ $opacity }} transition-all duration-300 transform scale-y-[-1] group-hover:scale-y-[-1] group-hover:scale-x-105">
        <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full drop-shadow-[0_2px_4px_rgba(110,40,5,0.3)]">
            <use href="#cornerGoldGrad" />
            <!-- Corner Spear / Finial -->
            <path d="M 6 6 L 24 10 C 20 14, 14 20, 10 24 Z" fill="url(#cornerGoldGrad)" />
            <circle cx="8" cy="8" r="3.5" fill="url(#cornerGoldGrad)" />
            
            <!-- Outer Double Connecting Track Lines -->
            <path d="M 28 8 L 96 8" stroke="url(#cornerGoldGrad)" stroke-width="2.5" stroke-linecap="round" />
            <path d="M 32 14 L 96 14" stroke="url(#cornerGoldGrad)" stroke-width="1.5" stroke-linecap="round" />
            <path d="M 8 28 L 8 96" stroke="url(#cornerGoldGrad)" stroke-width="2.5" stroke-linecap="round" />
            <path d="M 14 32 L 14 96" stroke="url(#cornerGoldGrad)" stroke-width="1.5" stroke-linecap="round" />

            <!-- Main Intricate Filigree Swirls & Leaf Scrollwork -->
            <path d="M 12 12 C 18 6, 32 6, 38 12 C 44 18, 38 28, 28 28 C 18 28, 14 20, 18 16 C 22 12, 28 14, 28 18 C 28 22, 22 22, 20 20" stroke="url(#cornerGoldGrad)" stroke-width="2.2" fill="none" stroke-linecap="round" />
            
            <path d="M 38 12 C 48 10, 62 16, 56 26 C 50 36, 36 30, 32 24 C 28 18, 32 14, 38 12 Z" fill="url(#cornerGoldGrad)" fill-opacity="0.85" />
            <path d="M 12 38 C 10 48, 16 62, 26 56 C 36 50, 30 36, 24 32 C 18 28, 14 32, 12 38 Z" fill="url(#cornerGoldGrad)" fill-opacity="0.85" />
            
            <!-- Tendrils and Leaf Buds -->
            <path d="M 24 32 C 18 42, 22 58, 14 74 C 10 82, 6 90, 8 96" stroke="url(#cornerGoldGrad)" stroke-width="2" fill="none" stroke-linecap="round" />
            <path d="M 32 24 C 42 18, 58 22, 74 14 C 82 10, 90 6, 96 8" stroke="url(#cornerGoldGrad)" stroke-width="2" fill="none" stroke-linecap="round" />
            
            <!-- Secondary Decorative C-Curls -->
            <path d="M 26 26 C 36 36, 44 44, 48 38 C 52 32, 42 26, 34 26" stroke="url(#cornerGoldGrad)" stroke-width="1.8" fill="none" stroke-linecap="round" />
            <circle cx="48" cy="38" r="2.5" fill="url(#cornerGoldGrad)" />
            <circle cx="38" cy="48" r="2.5" fill="url(#cornerGoldGrad)" />
            <circle cx="28" cy="18" r="2" fill="url(#cornerGoldGrad)" />
            <circle cx="18" cy="28" r="2" fill="url(#cornerGoldGrad)" />
        </svg>
    </div>

    <!-- Bottom-Right Corner -->
    <div class="absolute -bottom-1.5 -right-1.5 {{ $size }} {{ $opacity }} transition-all duration-300 transform scale-[-1] group-hover:scale-[-1.05]">
        <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full drop-shadow-[0_2px_4px_rgba(110,40,5,0.3)]">
            <use href="#cornerGoldGrad" />
            <!-- Corner Spear / Finial -->
            <path d="M 6 6 L 24 10 C 20 14, 14 20, 10 24 Z" fill="url(#cornerGoldGrad)" />
            <circle cx="8" cy="8" r="3.5" fill="url(#cornerGoldGrad)" />
            
            <!-- Outer Double Connecting Track Lines -->
            <path d="M 28 8 L 96 8" stroke="url(#cornerGoldGrad)" stroke-width="2.5" stroke-linecap="round" />
            <path d="M 32 14 L 96 14" stroke="url(#cornerGoldGrad)" stroke-width="1.5" stroke-linecap="round" />
            <path d="M 8 28 L 8 96" stroke="url(#cornerGoldGrad)" stroke-width="2.5" stroke-linecap="round" />
            <path d="M 14 32 L 14 96" stroke="url(#cornerGoldGrad)" stroke-width="1.5" stroke-linecap="round" />

            <!-- Main Intricate Filigree Swirls & Leaf Scrollwork -->
            <path d="M 12 12 C 18 6, 32 6, 38 12 C 44 18, 38 28, 28 28 C 18 28, 14 20, 18 16 C 22 12, 28 14, 28 18 C 28 22, 22 22, 20 20" stroke="url(#cornerGoldGrad)" stroke-width="2.2" fill="none" stroke-linecap="round" />
            
            <path d="M 38 12 C 48 10, 62 16, 56 26 C 50 36, 36 30, 32 24 C 28 18, 32 14, 38 12 Z" fill="url(#cornerGoldGrad)" fill-opacity="0.85" />
            <path d="M 12 38 C 10 48, 16 62, 26 56 C 36 50, 30 36, 24 32 C 18 28, 14 32, 12 38 Z" fill="url(#cornerGoldGrad)" fill-opacity="0.85" />
            
            <!-- Tendrils and Leaf Buds -->
            <path d="M 24 32 C 18 42, 22 58, 14 74 C 10 82, 6 90, 8 96" stroke="url(#cornerGoldGrad)" stroke-width="2" fill="none" stroke-linecap="round" />
            <path d="M 32 24 C 42 18, 58 22, 74 14 C 82 10, 90 6, 96 8" stroke="url(#cornerGoldGrad)" stroke-width="2" fill="none" stroke-linecap="round" />
            
            <!-- Secondary Decorative C-Curls -->
            <path d="M 26 26 C 36 36, 44 44, 48 38 C 52 32, 42 26, 34 26" stroke="url(#cornerGoldGrad)" stroke-width="1.8" fill="none" stroke-linecap="round" />
            <circle cx="48" cy="38" r="2.5" fill="url(#cornerGoldGrad)" />
            <circle cx="38" cy="48" r="2.5" fill="url(#cornerGoldGrad)" />
            <circle cx="28" cy="18" r="2" fill="url(#cornerGoldGrad)" />
            <circle cx="18" cy="28" r="2" fill="url(#cornerGoldGrad)" />
        </svg>
    </div>
</div>
