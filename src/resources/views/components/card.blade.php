@props([
    'title' => null,
    'subtitle' => null,
    'action' => null,
    'padding' => true,
    'hover' => false,
])

@php
$classes = 'bg-surface-card border border-surface-border rounded-xl';
if ($hover) {
    $classes .= ' hover:border-brand-500/50 transition-colors duration-300';
}
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    @if ($title || $subtitle || $action)
        <div class="flex items-center justify-between px-6 py-5 border-b border-surface-border">
            <div class="min-w-0 flex-1">
                @if ($title)
                    <h3 class="text-lg font-semibold text-white truncate">{{ $title }}</h3>
                @endif
                @if ($subtitle)
                    <p class="text-sm text-gray-400 mt-0.5">{{ $subtitle }}</p>
                @endif
            </div>
            @if ($action)
                <div class="ml-4 shrink-0">{{ !! $action !!}}</div>
            @endif
        </div>
    @endif

    <div class="{{ $padding ? 'p-6' : '' }}">
        {{ $slot }}
    </div>

    @isset($footer)
        <div class="px-6 py-4 border-t border-surface-border">
            {{ $footer }}
        </div>
    @endisset
</div>
