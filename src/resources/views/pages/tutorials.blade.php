@extends('layouts.public')

@section('title', __('tutorials.title') . ' | Clyrion Studio | JIMMY')

@section('meta')
    <x-meta-tags title="{{ __('tutorials.title') }} | Clyrion Studio | JIMMY" description="Tutoriales técnicos sobre Laravel, PHP, Docker, arquitectura de software y desarrollo web." />
@endsection

@section('content')

<section class="section-padding">
    <div class="container-page">
        <div class="text-center mb-16">
            <p class="text-brand-400 mb-4 uppercase tracking-widest text-sm font-medium">{{ __('tutorials.title') }}</p>
            <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4">{{ __('tutorials.title') }}</h1>
            <p class="text-gray-400 max-w-2xl mx-auto">
                {{ __('tutorials.subtitle') }}
            </p>
        </div>

        {{-- Series --}}
        @if ($series->isNotEmpty())
            <h2 class="text-2xl font-bold text-white mb-8">{{ __('tutorials.series') }}</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                @foreach ($series as $s)
                    <a href="{{ route('tutorials.series', $s->slug) }}" class="card-hover p-6 group">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-xs px-2 py-0.5 rounded-full {{ (new \App\Models\Tutorial)->difficultyColor() }}">
                                {{ (new \App\Models\Tutorial)->difficultyLabel() }}
                            </span>
                            <span class="text-xs text-gray-500">{{ $s->tutorials_count }} {{ __('tutorials.title') }}</span>
                        </div>
                        <h3 class="text-lg font-semibold text-white mb-2 group-hover:text-brand-400 transition">{{ $s->title }}</h3>
                        @if ($s->description)
                            <p class="text-sm text-gray-400 line-clamp-2">{{ $s->description }}</p>
                        @endif
                    </a>
                @endforeach
            </div>
        @endif

        {{-- Standalone Tutorials --}}
        <h2 class="text-2xl font-bold text-white mb-8">{{ __('tutorials.title') }}</h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($standalone as $tutorial)
                <a href="{{ route('tutorials.show', $tutorial->slug) }}" class="card-hover p-5 group">
                    <div class="flex flex-wrap items-center gap-2 mb-3">
                        <span class="text-xs px-2 py-0.5 rounded-full {{ $tutorial->difficultyColor() }}">{{ $tutorial->difficultyLabel() }}</span>
                        <span class="text-xs text-gray-500">{{ $tutorial->readingTime() }}</span>
                        @if ($tutorial->series)
                            <span class="text-xs text-brand-400">{{ $tutorial->series->title }}</span>
                        @endif
                    </div>
                    <h3 class="text-base font-semibold text-white mb-2 group-hover:text-brand-400 transition">{{ $tutorial->title }}</h3>
                    @if ($tutorial->excerpt)
                        <p class="text-sm text-gray-400 line-clamp-2">{{ $tutorial->excerpt }}</p>
                    @endif
                    @if ($tutorial->tags->isNotEmpty())
                        <div class="flex flex-wrap gap-1.5 mt-3">
                            @foreach ($tutorial->tags as $tag)
                                <span class="text-xs text-gray-600">#{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    @endif
                </a>
            @empty
                <div class="col-span-full text-center py-20 text-gray-500">
                    <p class="text-lg">{{ __('tutorials.empty') }}</p>
                </div>
            @endforelse
        </div>

        @if ($standalone->hasPages())
            <div class="mt-12">
                {{ $standalone->links() }}
            </div>
        @endif
    </div>
</section>

@endsection
