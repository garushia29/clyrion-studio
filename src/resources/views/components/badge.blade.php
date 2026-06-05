@props([
    'variant' => 'neutral',
    'size' => 'sm',
])

@php
$variants = [
    'success' => 'bg-green-500/10 text-green-400 border-green-500/20',
    'warning' => 'bg-yellow-500/10 text-yellow-400 border-yellow-500/20',
    'danger' => 'bg-red-500/10 text-red-400 border-red-500/20',
    'info' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
    'brand' => 'bg-brand-500/10 text-brand-400 border-brand-500/20',
    'neutral' => 'bg-gray-500/10 text-gray-400 border-gray-500/20',
];

$sizes = [
    'sm' => 'px-2 py-0.5 text-xs',
    'md' => 'px-2.5 py-1 text-sm',
];

$classes = 'inline-flex items-center font-medium rounded-full border ' . $variants[$variant] . ' ' . $sizes[$size];
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>
