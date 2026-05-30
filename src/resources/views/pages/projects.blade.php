@extends('layouts.public')

@section('title', 'Proyectos | Clyrion Studio | JIMMY')

@section('meta')
    <x-meta-tags title="Proyectos | Clyrion Studio | JIMMY" description="Portafolio de proyectos enterprise: sistemas de trazabilidad, automatización, plataformas SaaS y más." />
@endsection

@section('content')

<section class="section-padding">
    <div class="container-page">
        <div class="text-center mb-16">
            <p class="text-brand-400 mb-4 uppercase tracking-widest text-sm font-medium">Portafolio</p>
            <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4">Proyectos</h1>
            <p class="text-gray-400 max-w-2xl mx-auto">
                Sistemas enterprise, plataformas SaaS y soluciones de infraestructura
            </p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $projects = [
                    ['title' => 'Sistema de Trazabilidad', 'desc' => 'Plataforma enterprise para gestión y trazabilidad de procesos industriales con reportes en tiempo real.', 'tech' => ['Laravel', 'PostgreSQL', 'Docker'], 'year' => '2025'],
                    ['title' => 'Automatización de Desinfección', 'desc' => 'Sistema automatizado con control IoT para procesos de desinfección en plantas de producción.', 'tech' => ['PHP', 'IoT', 'PostgreSQL'], 'year' => '2024'],
                    ['title' => 'Plataforma Educativa LMS', 'desc' => 'Learning management system con tutorías en vivo, cursos asincrónicos y analytics.', 'tech' => ['Laravel', 'Livewire', 'TailwindCSS'], 'year' => '2024'],
                    ['title' => 'Sistema de Warehouse', 'desc' => 'Gestión de inventarios, tracking de lotes y logística para almacenes industriales.', 'tech' => ['Laravel', 'PostgreSQL', 'Docker'], 'year' => '2025'],
                    ['title' => 'Dashboard Analytics SaaS', 'desc' => 'Plataforma de análisis con métricas en tiempo real, reportes exportables y alertas.', 'tech' => ['Livewire', 'Charts', 'PostgreSQL'], 'year' => '2024'],
                    ['title' => 'Sistema de Facturación', 'desc' => 'Facturación electrónica compliance con SAT, CFDI y catálogos fiscales.', 'tech' => ['Laravel', 'PostgreSQL', 'SOAP'], 'year' => '2023'],
                ];
            @endphp
            @foreach ($projects as $project)
                <div class="card-hover p-6 flex flex-col group animate-fade-in" style="animation-delay: {{ $loop->index * 0.1 }}s">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs text-gray-500">{{ $project['year'] }}</span>
                        <span class="w-8 h-8 rounded-lg bg-brand-500/10 flex items-center justify-center text-brand-400 font-bold text-sm">
                            {{ $loop->iteration }}
                        </span>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2 group-hover:text-brand-400 transition">{{ $project['title'] }}</h3>
                    <p class="text-gray-400 text-sm flex-1">{{ $project['desc'] }}</p>
                    <div class="mt-4 pt-4 border-t border-surface-border flex flex-wrap gap-2">
                        @foreach ($project['tech'] as $tech)
                            <span class="px-2 py-0.5 text-xs rounded bg-surface-card border border-surface-border text-gray-400">{{ $tech }}</span>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
