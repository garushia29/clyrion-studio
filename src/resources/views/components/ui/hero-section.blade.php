@props(['subtitle' => null])

<section {{ $attributes->merge(['class' => 'section-padding']) }}>
    <div class="container-page">
        <div class="mx-auto max-w-4xl text-center">
            @isset($eyebrow)
                <p class="text-xs tracking-[0.32em] uppercase text-brand-300 mb-3">{{ $eyebrow }}</p>
            @endisset

            @isset($title)
                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold tracking-tight text-white leading-tight">
                    {!! $title !!}
                </h1>
            @endisset

            @if ($subtitle)
                <p class="mt-6 text-base sm:text-lg leading-8 text-gray-400">{{ $subtitle }}</p>
            @endif

            <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                {{ $slot }}
            </div>
        </div>
    </div>
</section>
