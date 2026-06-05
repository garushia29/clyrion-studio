@props([
    'variant' => 'info',
])

@php
$variants = [
    'info' => 'bg-brand-500/10 border-brand-500/20 text-brand-400',
    'success' => 'bg-green-500/10 border-green-500/20 text-green-400',
    'warning' => 'bg-yellow-500/10 border-yellow-500/20 text-yellow-400',
    'danger' => 'bg-red-500/10 border-red-500/20 text-red-400',
];
@endphp

<div {{ $attributes->merge(['class' => 'px-4 py-3 rounded-lg border text-sm ' . $variants[$variant]]) }}>
    {{ $slot }}
</div>
