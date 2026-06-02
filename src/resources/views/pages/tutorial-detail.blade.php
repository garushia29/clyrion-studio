@extends('layouts.public')

@section('title', ($tutorial->meta_title ?: $tutorial->title) . ' | ' . __('tutorials.title') . ' | Clyrion Studio | JIMMY')

@section('meta')
    <x-meta-tags
        :title="$tutorial->meta_title ?: $tutorial->title"
        :description="$tutorial->meta_description ?: $tutorial->excerpt"
    />
@endsection

@section('content')

<article class="section-padding">
    <div class="container-page max-w-3xl">
        <div class="flex items-center justify-between mb-8">
            <a href="{{ $series ? route('tutorials.series', $series->slug) : route('tutorials.index') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-brand-400 transition text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                {{ $series ? $series->title : __('tutorials.back') }}
            </a>
        </div>

        <header class="mb-8">
            <div class="flex flex-wrap items-center gap-3 text-sm mb-4">
                <span class="px-2.5 py-1 text-xs rounded-full {{ $tutorial->difficultyColor() }}">{{ $tutorial->difficultyLabel() }}</span>
                <span class="text-gray-500">{{ $tutorial->readingTime() }}</span>
                @if ($tutorial->published_at)
                    <span class="text-gray-500">{{ $tutorial->published_at->format('d M, Y') }}</span>
                @endif
                @if ($series)
                    <span class="text-brand-400 text-xs">{{ $series->title }}</span>
                @endif
            </div>

            <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4">{{ $tutorial->title }}</h1>
            @if ($tutorial->excerpt)
                <p class="text-lg text-gray-400 leading-relaxed">{{ $tutorial->excerpt }}</p>
            @endif
        </header>

        {{-- Prerequisites --}}
        @if ($tutorial->prerequisites)
            <div class="mb-8 p-4 rounded-lg bg-yellow-500/5 border border-yellow-500/10">
                <h3 class="text-sm font-semibold text-yellow-400 mb-2">{{ __('tutorials.prerequisites') }}</h3>
                <p class="text-sm text-gray-400">{{ $tutorial->prerequisites }}</p>
            </div>
        @endif

        {{-- Series Navigation --}}
        @if ($series)
            <div class="mb-8 p-4 rounded-lg bg-surface-card border border-surface-border">
                <div class="flex items-center justify-between">
                    @if ($prev)
                        <a href="{{ route('tutorials.show', $prev->slug) }}" class="flex items-center gap-2 text-sm text-gray-400 hover:text-brand-400 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            {{ __('tutorials.back_series') }}
                        </a>
                    @else
                        <div></div>
                    @endif
                    <span class="text-xs text-gray-600">{{ $series->title }}</span>
                    @if ($next)
                        <a href="{{ route('tutorials.show', $next->slug) }}" class="flex items-center gap-2 text-sm text-gray-400 hover:text-brand-400 transition">
                            {{ __('tutorials.back_series') }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    @else
                        <div></div>
                    @endif
                </div>
            </div>
        @endif

        {{-- Content --}}
        @if ($tutorial->content)
            <div class="prose prose-invert max-w-none text-gray-300 leading-relaxed">
                {{ $tutorial->content }}
            </div>
        @endif

        {{-- Tags --}}
        @if ($tutorial->tags->isNotEmpty())
            <div class="mt-8 pt-8 border-t border-surface-border">
                <div class="flex flex-wrap gap-2">
                    @foreach ($tutorial->tags as $tag)
                        <span class="px-3 py-1 text-xs rounded-full bg-surface-card border border-surface-border text-gray-400">#{{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Related --}}
        @if ($related->isNotEmpty())
            <div class="mt-12 pt-8 border-t border-surface-border">
                <h3 class="text-xl font-semibold text-white mb-6">{{ __('tutorials.related') }}</h3>
                <div class="grid sm:grid-cols-2 gap-6">
                    @foreach ($related as $rel)
                        <a href="{{ route('tutorials.show', $rel->slug) }}" class="card-hover p-4 group">
                            <div class="text-xs text-gray-500 mb-2">{{ $rel->readingTime() }} · {{ $rel->difficultyLabel() }}</div>
                            <h4 class="text-sm font-semibold text-white group-hover:text-brand-400 transition">{{ $rel->title }}</h4>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</article>

@endsection
