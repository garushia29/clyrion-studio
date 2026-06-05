@props([
    'label' => null,
    'value' => null,
    'description' => null,
    'icon' => null,
])

<div class="stat-card">
    <div class="flex items-start justify-between gap-4 mb-4">
        <div>
            @if ($label)
                <p class="text-xs uppercase tracking-[0.28em] text-brand-300">{{ $label }}</p>
            @endif
            @if ($value)
                <p class="text-3xl font-semibold text-white mt-3">{{ $value }}</p>
            @endif
        </div>
        @if ($icon)
            <div class="w-11 h-11 rounded-3xl bg-brand-500/10 text-brand-300 flex items-center justify-center">
                {!! $icon !!}
            </div>
        @endif
    </div>

    @if ($description)
        <p class="text-sm text-gray-400 leading-6">{{ $description }}</p>
    @endif
</div>
