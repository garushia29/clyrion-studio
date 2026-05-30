<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container-page">
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="card p-6">
                    <div class="text-2xl font-bold text-white">{{ $projectsCount }}</div>
                    <div class="text-sm text-gray-400 mt-1">Proyectos</div>
                </div>
                <div class="card p-6">
                    <div class="text-2xl font-bold text-white">{{ $postsCount }}</div>
                    <div class="text-sm text-gray-400 mt-1">Blog posts</div>
                </div>
                <div class="card p-6">
                    <div class="text-2xl font-bold text-white">{{ $usersCount }}</div>
                    <div class="text-sm text-gray-400 mt-1">Usuarios</div>
                </div>
                <div class="card p-6">
                    <div class="text-2xl font-bold text-white">—</div>
                    <div class="text-sm text-gray-400 mt-1">Visitas</div>
                </div>
            </div>

            <div class="grid lg:grid-cols-2 gap-6">
                <div class="card p-6">
                    <h3 class="text-lg font-semibold text-white mb-4">Acceso rápido</h3>
                    <div class="space-y-3">
                        <a href="{{ route('admin.projects.index') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-surface-hover transition">
                            <span class="w-8 h-8 rounded-lg bg-brand-500/10 flex items-center justify-center text-brand-400">P</span>
                            <span class="text-gray-300">Gestionar proyectos</span>
                        </a>
                        <a href="{{ route('admin.posts.index') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-surface-hover transition">
                            <span class="w-8 h-8 rounded-lg bg-brand-500/10 flex items-center justify-center text-brand-400">B</span>
                            <span class="text-gray-300">Gestionar blog posts</span>
                        </a>
                        <a href="{{ route('home') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-surface-hover transition">
                            <span class="w-8 h-8 rounded-lg bg-brand-500/10 flex items-center justify-center text-brand-400">S</span>
                            <span class="text-gray-300">Ver sitio público</span>
                        </a>
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-surface-hover transition">
                            <span class="w-8 h-8 rounded-lg bg-brand-500/10 flex items-center justify-center text-brand-400">A</span>
                            <span class="text-gray-300">Mi perfil</span>
                        </a>
                    </div>
                </div>

                <div class="card p-6">
                    <h3 class="text-lg font-semibold text-white mb-4">Bienvenido</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Panel de administración de <strong class="text-white">Clyrion Studio</strong>.
                        Desde aquí puedes gestionar proyectos, contenido del blog,
                        y configurar tu plataforma.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
