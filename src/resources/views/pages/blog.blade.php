@extends('layouts.public')

@section('title', 'Blog | Clyrion Studio | JIMMY')

@section('meta')
    <x-meta-tags title="Blog | Clyrion Studio | JIMMY" description="Artículos sobre desarrollo web, Laravel, arquitectura de software, DevOps y soluciones enterprise." />
@endsection

@section('content')

<section class="section-padding">
    <div class="container-page">
        <div class="text-center mb-16">
            <p class="text-brand-400 mb-4 uppercase tracking-widest text-sm font-medium">Blog</p>
            <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4">Artículos</h1>
            <p class="text-gray-400 max-w-2xl mx-auto">
                Tecnología, arquitectura, y desarrollo de software
            </p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $posts = [
                    ['title' => 'Arquitectura limpia en Laravel', 'excerpt' => 'Cómo aplicar principios SOLID y Clean Architecture en proyectos Laravel enterprise.', 'cat' => 'Arquitectura', 'date' => 'Mar 2025'],
                    ['title' => 'Docker para desarrolladores PHP', 'excerpt' => 'Guía práctica para dockerizar aplicaciones Laravel con PostgreSQL y Nginx.', 'cat' => 'DevOps', 'date' => 'Feb 2025'],
                    ['title' => 'Livewire vs Filament', 'excerpt' => 'Comparativa técnica entre Livewire y Filament para paneles de administración.', 'cat' => 'Frontend', 'date' => 'Ene 2025'],
                ];
            @endphp
            @foreach ($posts as $post)
                <article class="card-hover p-6 group">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-xs text-gray-500">{{ $post['date'] }}</span>
                        <span class="text-xs px-2 py-0.5 rounded-full bg-brand-500/10 text-brand-400">{{ $post['cat'] }}</span>
                    </div>
                    <h2 class="text-lg font-semibold text-white mb-2 group-hover:text-brand-400 transition">{{ $post['title'] }}</h2>
                    <p class="text-gray-400 text-sm">{{ $post['excerpt'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

@endsection
