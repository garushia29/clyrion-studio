@extends('layouts.public')

@section('title', $series->title . ' | ' . __('tutorials.title') . ' | Clyrion Studio | JIMMY')

@section('meta')
    <x-meta-tags :title="$series->title . ' | ' . __('tutorials.title')" :description="$series->description ?? __('tutorials.series') . ' ' . $series->title" />
@endsection

@section('content')

<section class="section-padding">
    <div class="container-page max-w-4xl">
        <a href="{{ route('tutorials.index') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-brand-400 transition mb-8 text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            {{ __('tutorials.back') }}
        </a>

        <header class="mb-12">
            <div class="flex items-center gap-3 mb-4">
                <span class="text-xs px-2 py-0.5 rounded-full {{ (new \App\Models\Tutorial)->difficultyColor() }}">
                    {{ (new \App\Models\Tutorial)->difficultyLabel() }}
                </span>
                <span class="text-xs text-gray-500">{{ $tutorials->count() }} {{ __('tutorials.title') }}</span>
            </div>
            <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4">{{ $series->title }}</h1>
            @if ($series->description)
                <p class="text-lg text-gray-400 leading-relaxed">{{ $series->description }}</p>
            @endif
        </header>

        <div class="space-y-4">
            @forelse ($tutorials as $index => $tutorial)
                <a href="{{ route('tutorials.show', $tutorial->slug) }}" class="card-hover p-5 flex items-center gap-4 group">
                    <div class="w-10 h-10 rounded-lg bg-brand-500/10 flex items-center justify-center text-brand-400 font-bold shrink-0">
                        {{ $index + 1 }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <h3 class="text-base font-semibold text-white group-hover:text-brand-400 transition">{{ $tutorial->title }}</h3>
                            <span class="text-xs text-gray-500">{{ $tutorial->readingTime() }}</span>
                        </div>
                        @if ($tutorial->excerpt)
                            <p class="text-sm text-gray-400 line-clamp-1">{{ $tutorial->excerpt }}</p>
                        @endif
                    </div>
                    <svg class="w-5 h-5 text-gray-600 group-hover:text-brand-400 transition shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            @empty
                <div class="text-center py-12 text-gray-500">
                    <p>{{ __('tutorials.series_empty') }}</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection
