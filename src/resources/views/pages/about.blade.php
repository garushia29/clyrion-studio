@extends('layouts.public')

@section('title', __('about.title') . ' | Clyrion Studio | JIMMY')

@section('content')

<section class="section-padding">
    <div class="container-page">
        <div class="grid lg:grid-cols-5 gap-16 items-start">
            <div class="lg:col-span-2">
                <div class="card p-8 text-center lg:text-left">
                    <div class="w-32 h-32 mx-auto lg:mx-0 rounded-full bg-gradient-to-br from-brand-500 to-brand-700 flex items-center justify-center text-4xl font-bold text-white mb-6">
                        J
                    </div>
                    <h1 class="text-3xl font-bold text-white mb-2">JIMMY</h1>
                    <p class="text-brand-400 font-medium mb-4">Software Engineer & Fullstack Developer</p>
                    <p class="text-gray-400 text-sm leading-relaxed mb-6">
                        {{ __('about.bio') }}
                    </p>
                    <div class="flex flex-wrap gap-3 justify-center lg:justify-start">
                        <span class="px-3 py-1 text-xs rounded-full bg-surface-card border border-surface-border text-gray-300">Laravel</span>
                        <span class="px-3 py-1 text-xs rounded-full bg-surface-card border border-surface-border text-gray-300">Livewire</span>
                        <span class="px-3 py-1 text-xs rounded-full bg-surface-card border border-surface-border text-gray-300">PostgreSQL</span>
                        <span class="px-3 py-1 text-xs rounded-full bg-surface-card border border-surface-border text-gray-300">Docker</span>
                        <span class="px-3 py-1 text-xs rounded-full bg-surface-card border border-surface-border text-gray-300">PHP</span>
                        <span class="px-3 py-1 text-xs rounded-full bg-surface-card border border-surface-border text-gray-300">TailwindCSS</span>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-3 space-y-8">
                <div>
                    <h2 class="text-2xl font-bold text-white mb-4">{{ __('about.approach_title') }}</h2>
                    <div class="space-y-4">
                        @php
                            $approaches = [
                                ['title' => 'Clean Architecture', 'desc' => 'Código mantenible con separación clara de responsabilidades y principios SOLID.'],
                                ['title' => 'DevOps First', 'desc' => 'Entornos dockerizados, CI/CD, y despliegues automatizados desde el día uno.'],
                                ['title' => 'Escalabilidad', 'desc' => 'Sistemas diseñados para crecer sin reescribir. Base de datos, cache y colas desde el inicio.'],
                                ['title' => 'UX Técnico', 'desc' => 'Interfaces funcionales, rápidas y consistentes. Diseño premium sin sacrificar rendimiento.'],
                            ];
                        @endphp
                        @foreach ($approaches as $item)
                            <div class="flex gap-4">
                                <div class="w-1.5 h-1.5 rounded-full bg-brand-500 mt-2.5 shrink-0"></div>
                                <div>
                                    <h3 class="text-white font-medium">{{ $item['title'] }}</h3>
                                    <p class="text-gray-400 text-sm">{{ $item['desc'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-white mb-4">{{ __('about.stack_title') }}</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        @php
                            $stack = [
                                ['name' => 'Laravel', 'cat' => 'Backend'],
                                ['name' => 'Livewire', 'cat' => 'Frontend'],
                                ['name' => 'PostgreSQL', 'cat' => 'Database'],
                                ['name' => 'Docker', 'cat' => 'DevOps'],
                                ['name' => 'TailwindCSS', 'cat' => 'Frontend'],
                                ['name' => 'Alpine.js', 'cat' => 'Frontend'],
                                ['name' => 'Vite', 'cat' => 'Build'],
                                ['name' => 'Nginx', 'cat' => 'Infra'],
                            ];
                        @endphp
                        @foreach ($stack as $tech)
                            <div class="card p-4 text-center">
                                <div class="text-sm font-medium text-white">{{ $tech['name'] }}</div>
                                <div class="text-xs text-gray-500 mt-1">{{ $tech['cat'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
