@extends('layouts.public')

@section('title', 'Clyrion Studio | JIMMY — Software Engineer & Fullstack Developer')

@section('meta')
    <x-meta-tags title="Clyrion Studio | JIMMY" description="Software Engineer & Fullstack Developer especializado en arquitecturas backend, automatización de procesos y soluciones empresariales escalables." />
@endsection

@section('content')

{{-- Hero --}}
<x-ui.hero-section subtitle="{{ __('home.subtitle') }}">
    <x-slot name="eyebrow">{{ __('home.tagline') }}</x-slot>
    <x-slot name="title">
        {{ __('home.title') }}
        <span class="gradient-text">{{ __('home.title_accent') }}</span>
    </x-slot>

    <x-button href="#proyectos" class="hero-cta hero-cta-primary">
        {{ __('home.cta_projects') }}
    </x-button>

    <x-button href="#contacto" variant="secondary" class="hero-cta hero-cta-secondary">
        {{ __('home.cta_contact') }}
    </x-button>
</x-ui.hero-section>

<section id="servicios" class="section-padding bg-surface-card/50">
    <div class="container-page">
        <x-ui.section-heading
            eyebrow="{{ __('home.services_eyebrow', ['brand' => 'Clyrion Studio']) }}"
            title="{{ __('home.services_title') }}"
            subtitle="{{ __('home.services_subtitle') }}" />

        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($services as $service)
                <x-ui.feature-card
                    title="{{ $service->title }}"
                    description="{{ $service->description }}"
                    icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>'
                    badge="{{ $service->category ?? __('home.service_tag') }}" />
            @empty
                <div class="col-span-full text-center py-12 text-gray-500">
                    <p>{{ __('home.services_empty') }}</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<section id="proyectos" class="section-padding">
    <div class="container-page">
        <x-ui.section-heading
            eyebrow="{{ __('home.projects_eyebrow') }}"
            title="{{ __('home.projects_title') }}"
            subtitle="{{ __('home.projects_subtitle') }}" />

        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($featured as $project)
                <x-ui.feature-card
                    title="{{ $project->title }}"
                    description="{{ $project->description }}"
                    icon='<span class="text-sm font-semibold">{{ $loop->iteration }}</span>'
                    href="{{ route('projects.show', $project->slug) }}">
                    @if ($project->technologies)
                        <div class="mt-4 pt-4 border-t border-surface-border">
                            <span class="text-xs text-gray-500">{{ implode(', ', $project->technologies) }}</span>
                        </div>
                    @endif
                </x-ui.feature-card>
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