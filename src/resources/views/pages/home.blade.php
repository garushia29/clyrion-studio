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
            Software Engineer &bull; Fullstack Developer
        </p>
        <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold leading-tight mb-6 text-white">
            Building scalable
            <span class="gradient-text">
                digital solutions
            </span>
        </h1>
        <p class="max-w-3xl mx-auto text-gray-400 text-lg leading-relaxed">
            Desarrollador especializado en arquitecturas backend,
            automatización de procesos y soluciones empresariales escalables.
        </p>
        <div class="mt-10 flex justify-center gap-4">
            <a href="#proyectos"
               class="px-8 py-4 bg-brand-600 hover:bg-brand-700 rounded-xl font-medium transition">
                Ver proyectos
            </a>
            <a href="#contacto"
               class="px-8 py-4 border border-surface-border hover:border-brand-500 rounded-xl transition">
                Contactar
            </a>
        </div>
    </div>
</section>

{{-- Services --}}
<section id="servicios" class="section-padding bg-surface-card/50">
    <div class="container-page">
        <h2 class="text-3xl sm:text-4xl font-bold text-center mb-4 text-white">Servicios</h2>
        <p class="text-gray-400 text-center mb-16 max-w-2xl mx-auto">
            Soluciones enterprise de principio a fin
        </p>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $services = [
                    ['title' => 'Fullstack Development', 'desc' => 'Aplicaciones web modernas con Laravel, Livewire y TailwindCSS'],
                    ['title' => 'Enterprise Systems', 'desc' => 'Sistemas escalables para empresas, trazabilidad y gestión'],
                    ['title' => 'Process Automation', 'desc' => 'Automatización de procesos con arquitecturas robustas'],
                    ['title' => 'Infrastructure', 'desc' => 'DevOps, Docker, VPS, CI/CD y despliegue en producción'],
                    ['title' => 'Tech Consulting', 'desc' => 'Consultoría en arquitectura, stack tecnológico y mejores prácticas'],
                    ['title' => 'AI Integrations', 'desc' => 'Integración de inteligencia artificial en sistemas existentes'],
                ];
            @endphp
            @foreach ($services as $service)
                <div class="card-hover p-6">
                    <h3 class="text-lg font-semibold mb-2 text-white group-hover:text-brand-400 transition">{{ $service['title'] }}</h3>
                    <p class="text-gray-400 text-sm">{{ $service['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Projects --}}
<section id="proyectos" class="section-padding">
    <div class="container-page">
        <h2 class="text-3xl sm:text-4xl font-bold text-center mb-4 text-white">Proyectos destacados</h2>
        <p class="text-gray-400 text-center mb-16 max-w-2xl mx-auto">
            Soluciones enterprise que he construido
        </p>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $featured = [
                    ['title' => 'Sistema de Trazabilidad', 'desc' => 'Plataforma enterprise para gestión y trazabilidad de procesos industriales.', 'tech' => 'Laravel, PostgreSQL, Docker'],
                    ['title' => 'Automatización de Desinfección', 'desc' => 'Sistema automatizado con IoT para control de desinfección en plantas.', 'tech' => 'PHP, IoT, PostgreSQL'],
                    ['title' => 'Plataforma Educativa', 'desc' => 'LMS moderno con tutorías, cursos y seguimiento de estudiantes.', 'tech' => 'Laravel, Livewire, TailwindCSS'],
                ];
            @endphp
            @foreach ($featured as $project)
                <div class="card-hover p-6 flex flex-col group">
                    <div class="w-10 h-10 rounded-lg bg-brand-500/10 flex items-center justify-center mb-4 text-brand-400 font-bold text-lg">
                        {{ $loop->iteration }}
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2 group-hover:text-brand-400 transition">{{ $project['title'] }}</h3>
                    <p class="text-gray-400 text-sm flex-1">{{ $project['desc'] }}</p>
                    <div class="mt-4 pt-4 border-t border-surface-border">
                        <span class="text-xs text-gray-500">{{ $project['tech'] }}</span>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-12">
            <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 text-brand-400 hover:text-brand-300 transition font-medium">
                Ver todos los proyectos
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- Contact --}}
<section id="contacto" class="section-padding bg-surface-card/50">
    <div class="container-page max-w-2xl text-center">
        <h2 class="text-3xl sm:text-4xl font-bold mb-4 text-white">Contacto</h2>
        <p class="text-gray-400 mb-12">
            ¿Tienes un proyecto en mente? Hablemos.
        </p>
        <div class="card p-8 text-left">
            <form action="#" method="POST" class="space-y-6">
                @csrf
                <div>
                    <x-input-label for="name" :value="__('Nombre')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" required />
                </div>
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" required />
                </div>
                <div>
                    <x-input-label for="message" :value="__('Mensaje')" />
                    <textarea id="message" rows="4" class="block mt-1 w-full border-surface-input bg-surface-card text-gray-200 focus:border-brand-500 focus:ring-brand-500 rounded-md shadow-sm" required></textarea>
                </div>
                <x-primary-button class="w-full justify-center">Enviar mensaje</x-primary-button>
            </form>
        </div>
    </div>
</section>

@endsection