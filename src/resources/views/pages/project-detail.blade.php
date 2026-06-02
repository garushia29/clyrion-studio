@extends('layouts.public')

@section('title', ($project->meta_title ?: $project->title) . ' | Clyrion Studio | JIMMY')

@section('meta')
    <x-meta-tags
        :title="$project->meta_title ?: $project->title"
        :description="$project->meta_description ?: $project->description"
    />
@endsection

@section('content')

<section class="section-padding">
    <div class="container-page max-w-4xl">
        <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-brand-400 transition mb-8 text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            {{ __('projects.back') }}
        </a>

        <div class="mb-8">
            <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                @if ($project->year)
                    <span>{{ $project->year }}</span>
                @endif
                <span class="px-2 py-0.5 rounded-full text-xs {{ $project->status === 'published' ? 'bg-green-500/10 text-green-400' : 'bg-yellow-500/10 text-yellow-400' }}">
                    {{ $project->status === 'published' ? 'Publicado' : 'Borrador' }}
                </span>
            </div>
            <h1 class="text-4xl sm:text-5xl font-bold text-white mb-6">{{ $project->title }}</h1>
            @if ($project->description)
                <p class="text-xl text-gray-400 leading-relaxed">{{ $project->description }}</p>
            @endif
        </div>

        @if ($project->technologies)
            <div class="flex flex-wrap gap-2 mb-8">
                @foreach ($project->technologies as $tech)
                    <span class="px-3 py-1 text-xs rounded-full bg-brand-500/10 text-brand-400 border border-brand-500/20">{{ $tech }}</span>
                @endforeach
            </div>
        @endif

        @if ($project->content)
            <div class="prose prose-invert max-w-none text-gray-300 leading-relaxed">
                {{ $project->content }}
            </div>
        @endif

        <div class="mt-12 flex flex-wrap gap-4">
            @if ($project->url)
                <a href="{{ $project->url }}" target="_blank" rel="noopener noreferrer" class="px-6 py-3 bg-brand-600 hover:bg-brand-700 rounded-xl font-medium transition inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    {{ __('projects.view_project') }}
                </a>
            @endif
            @if ($project->github_url)
                <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="px-6 py-3 border border-surface-border hover:border-brand-500 rounded-xl font-medium transition inline-flex items-center gap-2 text-gray-300">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                    {{ __('projects.source_code') }}
                </a>
            @endif
        </div>
    </div>
</section>

@endsection
