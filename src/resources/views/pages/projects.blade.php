@extends('layouts.public')

@section('title', __('projects.title') . ' | Clyrion Studio | JIMMY')

@section('meta')
    <x-meta-tags title="{{ __('projects.title') }} | Clyrion Studio | JIMMY" description="Portafolio de proyectos enterprise: sistemas de trazabilidad, automatización, plataformas SaaS y más." />
@endsection

@section('content')

<section class="section-padding">
    <div class="container-page">
        <div class="text-center mb-16">
            <p class="text-brand-400 mb-4 uppercase tracking-widest text-sm font-medium">{{ __('projects.title') }}</p>
            <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4">{{ __('projects.title') }}</h1>
            <p class="text-gray-400 max-w-2xl mx-auto">
                {{ __('projects.subtitle') }}
            </p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($projects as $project)
                <a href="{{ route('projects.show', $project->slug) }}" class="card-hover p-6 flex flex-col group animate-fade-in" style="animation-delay: {{ $loop->index * 0.1 }}s">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs text-gray-500">{{ $project->year }}</span>
                        <span class="w-8 h-8 rounded-lg bg-brand-500/10 flex items-center justify-center text-brand-400 font-bold text-sm">
                            {{ $loop->iteration }}
                        </span>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2 group-hover:text-brand-400 transition">{{ $project->title }}</h3>
                    <p class="text-gray-400 text-sm flex-1">{{ $project->description }}</p>
                    @if ($project->technologies)
                        <div class="mt-4 pt-4 border-t border-surface-border flex flex-wrap gap-2">
                            @foreach ($project->technologies as $tech)
                                <span class="px-2 py-0.5 text-xs rounded bg-surface-card border border-surface-border text-gray-400">{{ $tech }}</span>
                            @endforeach
                        </div>
                    @endif
                </a>
            @empty
                <div class="col-span-full text-center py-20 text-gray-500">
                    <p class="text-lg">{{ __('projects.empty') }}</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection
