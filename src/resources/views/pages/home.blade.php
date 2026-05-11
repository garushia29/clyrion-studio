@extends('layouts.public')

@section('title', 'Clyrion Studio | JIMMY — Software Engineer & Fullstack Developer')

@section('content')

{{-- Hero --}}
<section class="py-32">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <p class="text-blue-400 mb-4 uppercase tracking-widest text-sm font-medium">
            Software Engineer &bull; Fullstack Developer
        </p>
        <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold leading-tight mb-6">
            Building scalable
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-600">
                digital solutions
            </span>
        </h1>
        <p class="max-w-3xl mx-auto text-gray-400 text-lg leading-relaxed">
            Desarrollador especializado en arquitecturas backend,
            automatización de procesos y soluciones empresariales escalables.
        </p>
        <div class="mt-10 flex justify-center gap-4">
            <a href="#proyectos"
               class="px-8 py-4 bg-blue-600 hover:bg-blue-700 rounded-xl font-medium transition">
                Ver proyectos
            </a>
            <a href="#contacto"
               class="px-8 py-4 border border-gray-700 hover:border-blue-500 rounded-xl transition">
                Contactar
            </a>
        </div>
    </div>
</section>

{{-- Services --}}
<section id="servicios" class="py-24 bg-gray-900/50">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-3xl sm:text-4xl font-bold text-center mb-4">Servicios</h2>
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
                <div class="p-6 rounded-xl border border-gray-800 bg-gray-950 hover:border-blue-500/50 transition group">
                    <h3 class="text-lg font-semibold mb-2 group-hover:text-blue-400 transition">{{ $service['title'] }}</h3>
                    <p class="text-gray-400 text-sm">{{ $service['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-24">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-3xl sm:text-4xl font-bold mb-6">
            ¿Listo para construir algo <span class="text-blue-500">grande</span>?
        </h2>
        <p class="text-gray-400 mb-8 text-lg">
            Hablemos sobre tu próximo proyecto.
        </p>
        <a href="#contacto"
           class="inline-block px-8 py-4 bg-blue-600 hover:bg-blue-700 rounded-xl font-medium transition">
            Contáctame
        </a>
    </div>
</section>

@endsection