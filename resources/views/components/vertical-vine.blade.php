@props([
    'position' => 'left',
    'size' => 'w-14 sm:w-16 md:w-20 h-40 sm:h-56 md:h-64',
    'opacity' => 'opacity-70 group-hover:opacity-90',
    'class' => '',
])

@php
    $transform = $position === 'right' ? 'scale-x-[-1]' : '';
@endphp

<!-- Rising Vertical Floral Vine Flourish (images (2).jpg) -->
<div class="pointer-events-none select-none mix-blend-multiply {{ $size }} {{ $opacity }} transition-all duration-500 {{ $class }}">
    <img src="{{ asset('images/images (2).jpg') }}" alt="Vedic Floral Vine" class="w-full h-full object-contain {{ $transform }}">
</div>
