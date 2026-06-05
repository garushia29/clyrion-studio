@props(['items' => []])

<nav aria-label="Breadcrumb" {{ $attributes->merge(['class' => 'flex items-center gap-1.5 text-sm text-gray-500']) }}>
    <a href="{{ route('admin.dashboard') }}" class="hover:text-brand-400 transition flex items-center gap-1">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
    </a>

    @foreach ($items as $item)
        <svg class="w-3 h-3 text-gray-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>

        @if ($loop->last || !($item['url'] ?? null))
            <span class="text-gray-300 font-medium" aria-current="page">{{ $item['label'] }}</span>
        @else
            <a href="{{ $item['url'] }}" class="hover:text-brand-400 transition">{{ $item['label'] }}</a>
        @endif
    @endforeach
</nav>
