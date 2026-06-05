@props([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
    'disabled' => false,
    'type' => 'submit',
])

@php
$base = 'inline-flex items-center justify-center font-medium rounded-lg transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-surface disabled:pointer-events-none disabled:opacity-50';

$variants = [
    'primary' => 'bg-brand-600 text-white hover:bg-brand-700 focus:ring-brand-500',
    'secondary' => 'bg-surface-card text-gray-300 border border-surface-border hover:bg-surface-hover hover:text-white focus:ring-brand-500',
    'danger' => 'bg-red-600 text-white hover:bg-red-500 focus:ring-red-500',
    'ghost' => 'text-gray-400 hover:text-white hover:bg-surface-hover focus:ring-brand-500',
    'outline' => 'border border-surface-border text-gray-300 hover:text-white hover:bg-surface-hover focus:ring-brand-500',
];

$sizes = [
    'sm' => 'px-3 py-1.5 text-xs gap-1.5',
    'md' => 'px-4 py-2 text-sm gap-2',
    'lg' => 'px-6 py-3 text-base gap-2.5',
];

$classes = $base . ' ' . $variants[$variant] . ' ' . $sizes[$size];
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" @disabled($disabled) {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
