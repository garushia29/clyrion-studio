@extends('layouts.public')

@section('title', 'Clyrion Studio | JIMMY — Software Engineer & Fullstack Developer')

@section('meta')
    <x-meta-tags title="Clyrion Studio | JIMMY" description="Software Engineer & Fullstack Developer especializado en arquitecturas backend, automatización de procesos y soluciones empresariales escalables." />
@endsection

@section('content')

{{-- Hero --}}
<section class="section-padding">
    <div class="container-page text-center animate-fade-in">
        <p class="text-brand-400 mb-4 uppercase tracking-widest text-sm font-medium">
            {{ __('home.tagline') }}
        </p>
        <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold leading-tight mb-6 text-white">
            {{ __('home.title') }}
            <span class="gradient-text">
                {{ __('home.title_accent') }}
            </span>
        </h1>
        <p class="max-w-3xl mx-auto text-gray-400 text-lg leading-relaxed">
            {{ __('home.subtitle') }}
        </p>
        <div class="mt-10 flex justify-center gap-4">
            <a href="#proyectos"
               class="px-8 py-4 bg-brand-600 hover:bg-brand-700 rounded-xl font-medium transition">
                {{ __('home.cta_projects') }}
            </a>
            <a href="#contacto"
               class="px-8 py-4 border border-surface-border hover:border-brand-500 rounded-xl transition">
                {{ __('home.cta_contact') }}
            </a>
        </div>
    </div>
</section>

{{-- Services: sección dinámica extraída desde la base de datos --}}
{{-- Los servicios se obtienen activos y ordenados por sort_order --}}
<section id="servicios" class="section-padding bg-surface-card/50">
    <div class="container-page">
        <h2 class="text-3xl sm:text-4xl font-bold text-center mb-4 text-white">{{ __('home.services_title') }}</h2>
        <p class="text-gray-400 text-center mb-16 max-w-2xl mx-auto">
            {{ __('home.services_subtitle') }}
        </p>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($services as $service)
                <div class="card-hover p-6">
                    <h3 class="text-lg font-semibold mb-2 text-white group-hover:text-brand-400 transition">{{ $service->title }}</h3>
                    <p class="text-gray-400 text-sm">{{ $service->description }}</p>
                </div>
            @empty
                <div class="col-span-full text-center py-12 text-gray-500">
                    <p>{{ __('home.services_empty') }}</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- Projects --}}
<section id="proyectos" class="section-padding">
    <div class="container-page">
        <h2 class="text-3xl sm:text-4xl font-bold text-center mb-4 text-white">{{ __('home.projects_title') }}</h2>
        <p class="text-gray-400 text-center mb-16 max-w-2xl mx-auto">
            {{ __('home.projects_subtitle') }}
        </p>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($featured as $project)
                <a href="{{ route('projects.show', $project->slug) }}" class="card-hover p-6 flex flex-col group">
                    <div class="w-10 h-10 rounded-lg bg-brand-500/10 flex items-center justify-center mb-4 text-brand-400 font-bold text-lg">
                        {{ $loop->iteration }}
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2 group-hover:text-brand-400 transition">{{ $project->title }}</h3>
                    <p class="text-gray-400 text-sm flex-1">{{ $project->description }}</p>
                    @if ($project->technologies)
                        <div class="mt-4 pt-4 border-t border-surface-border">
                            <span class="text-xs text-gray-500">{{ implode(', ', $project->technologies) }}</span>
                        </div>
                    @endif
                </a>
            @empty
                <div class="col-span-full text-center py-12 text-gray-500">
                    <p>{{ __('home.projects_empty') }}</p>
                </div>
            @endforelse
        </div>
        <div class="text-center mt-12">
            <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 text-brand-400 hover:text-brand-300 transition font-medium">
                {{ __('home.projects_all') }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- Contact --}}
<section id="contacto" class="section-padding bg-surface-card/50">
    <div class="container-page max-w-2xl text-center">
        <h2 class="text-3xl sm:text-4xl font-bold mb-4 text-white">{{ __('home.contact_title') }}</h2>
        <p class="text-gray-400 mb-12">
            {{ __('home.contact_subtitle') }}
        </p>
        <div class="card p-8 text-left">
            <livewire:contact-form />
        </div>
    </div>
</section>

@endsection