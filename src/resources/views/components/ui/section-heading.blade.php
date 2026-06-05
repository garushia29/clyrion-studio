@props([
    'eyebrow' => null,
    'title' => null,
    'subtitle' => null,
    'align' => 'center',
])

<div {{ $attributes->merge(['class' => 'max-w-4xl mx-auto']) }}>
    @if ($eyebrow)
        <p class="text-xs tracking-[0.32em] uppercase text-brand-300 mb-3 {{ $align === 'left' ? 'text-left' : 'text-center' }}">{{ $eyebrow }}</p>
    @endif

    @if ($title)
        <h2 class="text-3xl sm:text-4xl font-semibold text-white {{ $align === 'left' ? 'text-left' : 'text-center' }}">{{ $title }}</h2>
    @endif

    @if ($subtitle)
        <p class="mt-4 text-base sm:text-lg leading-8 text-gray-400 {{ $align === 'left' ? 'text-left' : 'text-center' }}">{{ $subtitle }}</p>
    @endif
</div>
