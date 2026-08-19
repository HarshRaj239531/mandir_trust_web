@props([
    'position' => 'top-right',
    'size' => 'w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24',
    'opacity' => 'opacity-85 group-hover:opacity-100',
    'class' => '',
])

@php
    $transform = match($position) {
        'top-left' => '',
        'top-right' => 'scale-x-[-1]',
        'bottom-left' => 'scale-y-[-1]',
        'bottom-right' => 'scale-[-1]',
        default => '',
    };
    $posClasses = match($position) {
        'top-left' => 'top-1 left-1',
        'top-right' => 'top-1 right-1',
        'bottom-left' => 'bottom-1 left-1',
        'bottom-right' => 'bottom-1 right-1',
        default => 'top-1 right-1',
    };
@endphp

<!-- Vintage Calligraphic Floral Corner Flourish with Butterfly -->
<div class="absolute {{ $posClasses }} {{ $size }} {{ $opacity }} pointer-events-none select-none z-10 mix-blend-multiply transition-all duration-300 transform {{ $class }}">
    <img src="{{ asset('images/images (1).jpg') }}" alt="Vintage Corner Flourish" class="w-full h-full object-contain {{ $transform }}">
</div>
