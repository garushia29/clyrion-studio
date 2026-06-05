@props([
    'title' => null,
    'description' => null,
    'icon' => null,
    'badge' => null,
    'href' => null,
])

@if ($href)
    <a href="{{ $href }}" class="block card-hover p-6 group transition">
@else
    <div class="card-hover p-6 group transition">
@endif
        <div class="flex items-start justify-between gap-4 mb-4">
            <div class="min-w-0 flex-1">
                @if ($icon)
                    <div class="w-12 h-12 rounded-3xl bg-brand-500/10 text-brand-300 flex items-center justify-center mb-4">
                        {!! $icon !!}
                    </div>
                @endif
            </div>
            @if ($badge)
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-brand-500/10 text-brand-300 border border-brand-500/20">
                    {{ $badge }}
                </span>
            @endif
        </div>

        @if ($title)
            <h3 class="text-xl font-semibold text-white mb-2">{{ $title }}</h3>
        @endif

        @if ($description)
            <p class="text-gray-400 text-sm leading-6">{{ $description }}</p>
        @endif

        {{ $slot }}

@if ($href)
    </a>
@else
    </div>
@endif
