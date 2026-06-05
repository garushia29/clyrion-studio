<div>
    {{-- Stats Grid --}}
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-8">
        <x-card>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-white">{{ $stats['projects'] }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">Proyectos</p>
                </div>
                <span class="w-10 h-10 rounded-lg bg-brand-500/10 flex items-center justify-center text-brand-400 text-lg font-bold">P</span>
            </div>
            <div class="mt-2 text-xs text-gray-500">{{ $publishedProjects }} publicados</div>
        </x-card>

        <x-card>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-white">{{ $stats['posts'] }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">Blog posts</p>
                </div>
                <span class="w-10 h-10 rounded-lg bg-green-500/10 flex items-center justify-center text-green-400 text-lg font-bold">B</span>
            </div>
            <div class="mt-2 text-xs text-gray-500">{{ $publishedPosts }} publicados</div>
        </x-card>

        <x-card>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-white">{{ $stats['categories'] }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">Categorías</p>
                </div>
                <span class="w-10 h-10 rounded-lg bg-purple-500/10 flex items-center justify-center text-purple-400 text-lg font-bold">C</span>
            </div>
        </x-card>

        <x-card>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-white">{{ $stats['tags'] }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">Tags</p>
                </div>
                <span class="w-10 h-10 rounded-lg bg-yellow-500/10 flex items-center justify-center text-yellow-400 text-lg font-bold">T</span>
            </div>
        </x-card>

        <x-card>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-white">{{ $stats['users'] }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">Usuarios</p>
                </div>
                <span class="w-10 h-10 rounded-lg bg-blue-500/10 flex items-center justify-center text-blue-400 text-lg font-bold">U</span>
            </div>
        </x-card>

        <x-card>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-white">{{ $stats['unreadMessages'] }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">Mensajes nuevos</p>
                </div>
                <span class="w-10 h-10 rounded-lg {{ $stats['unreadMessages'] > 0 ? 'bg-red-500/10 text-red-400' : 'bg-gray-500/10 text-gray-400' }} flex items-center justify-center text-lg font-bold">!</span>
            </div>
        </x-card>
    </div>

    {{-- Charts Row --}}
    <div class="grid lg:grid-cols-2 gap-6 mb-6">
        {{-- Traffic Chart --}}
        <x-card title="Tráfico (30 días)">
            <div class="h-64" wire:ignore>
                <canvas x-data="{}"
                        x-init="$nextTick(() => lineChart($el,
                            @js($chartLabels),
                            [{
                                label: 'Visitas',
                                data: @js($chartData),
                                borderColor: '#3b82f6',
                                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                fill: true,
                                tension: 0.3,
                                pointRadius: 3,
                                pointHoverRadius: 6,
                            }]
                        ))"></canvas>
            </div>
        </x-card>

        {{-- Posts per Month Chart --}}
        <x-card title="Posts por mes (12 meses)">
            <div class="h-64" wire:ignore>
                <canvas x-data="{}"
                        x-init="$nextTick(() => barChart($el,
                            @js($postChartLabels),
                            [{
                                label: 'Posts',
                                data: @js($postChartData),
                                backgroundColor: 'rgba(34, 197, 94, 0.5)',
                                borderColor: '#22c55e',
                                borderWidth: 1,
                                borderRadius: 4,
                            }]
                        ))"></canvas>
            </div>
        </x-card>
    </div>

    {{-- Analytics Summary --}}
    <div class="grid sm:grid-cols-3 gap-4 mb-6">
        <x-card hover>
            <a href="{{ route('admin.analytics.index') }}" class="block group">
                <p class="text-2xl font-bold text-white group-hover:text-brand-400 transition">{{ number_format($analytics['totalViews']) }}</p>
                <p class="text-xs text-gray-400 mt-0.5">Visitas (30d)</p>
            </a>
        </x-card>
        <x-card hover>
            <a href="{{ route('admin.analytics.index') }}" class="block group">
                <p class="text-2xl font-bold text-white group-hover:text-brand-400 transition">{{ number_format($analytics['todayViews']) }}</p>
                <p class="text-xs text-gray-400 mt-0.5">Visitas hoy</p>
            </a>
        </x-card>
        <x-card hover>
            <a href="{{ route('admin.analytics.index') }}" class="block group">
                <p class="text-2xl font-bold text-white group-hover:text-brand-400 transition">{{ number_format($analytics['uniqueVisitors']) }}</p>
                <p class="text-xs text-gray-400 mt-0.5">Visitantes únicos (30d)</p>
            </a>
        </x-card>
    </div>

    <div class="grid lg:grid-cols-2 gap-6">
        {{-- Recent Posts --}}
        <x-card title="Posts recientes" :action="'<a href=\'' . route('admin.posts.index') . '\' class=\'text-sm text-brand-400 hover:text-brand-300 transition\'>Ver todos →</a>'">
            <div class="space-y-3">
                @forelse ($recentPosts as $post)
                    <a href="{{ route('admin.posts.edit', $post) }}" class="flex items-center justify-between p-3 rounded-lg hover:bg-surface-hover transition group">
                        <div class="min-w-0 flex-1">
                            <p class="text-sm text-white truncate group-hover:text-brand-400 transition">{{ $post->title }}</p>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $post->created_at->diffForHumans() }} · {{ ucfirst($post->status) }}</p>
                        </div>
                        <span class="text-xs text-gray-600 ml-3">{{ $post->user?->name }}</span>
                    </a>
                @empty
                    <p class="text-sm text-gray-500 text-center py-4">No hay posts aún</p>
                @endforelse
            </div>
        </x-card>

        {{-- Recent Messages --}}
        <x-card title="Mensajes sin leer" :action="'<a href=\'' . route('admin.messages.index') . '\' class=\'text-sm text-brand-400 hover:text-brand-300 transition\'>Ver todos →</a>'">
            <div class="space-y-3">
                @forelse ($recentMessages as $message)
                    <div class="p-3 rounded-lg bg-brand-500/5 border border-brand-500/10">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-white">{{ $message->name }}</p>
                            <span class="text-xs text-gray-500">{{ $message->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-xs text-gray-400 mt-1 truncate">{{ $message->email }}</p>
                        <p class="text-sm text-gray-400 mt-1 line-clamp-2">{{ $message->message }}</p>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 text-center py-4">No hay mensajes sin leer</p>
                @endforelse
            </div>
        </x-card>
    </div>

    {{-- Quick Actions --}}
    <x-card title="Acciones rápidas" class="mt-6">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
            <a href="{{ route('admin.projects.create') }}" class="flex flex-col items-center gap-2 p-4 rounded-lg border border-surface-border hover:border-brand-500/30 hover:bg-surface-hover transition group">
                <span class="w-10 h-10 rounded-lg bg-brand-500/10 flex items-center justify-center text-brand-400 group-hover:scale-110 transition text-lg font-bold">+</span>
                <span class="text-xs text-gray-400 group-hover:text-white transition">Nuevo proyecto</span>
            </a>
            <a href="{{ route('admin.posts.create') }}" class="flex flex-col items-center gap-2 p-4 rounded-lg border border-surface-border hover:border-green-500/30 hover:bg-surface-hover transition group">
                <span class="w-10 h-10 rounded-lg bg-green-500/10 flex items-center justify-center text-green-400 group-hover:scale-110 transition text-lg font-bold">+</span>
                <span class="text-xs text-gray-400 group-hover:text-white transition">Nuevo post</span>
            </a>
            <a href="{{ route('admin.categories.create') }}" class="flex flex-col items-center gap-2 p-4 rounded-lg border border-surface-border hover:border-purple-500/30 hover:bg-surface-hover transition group">
                <span class="w-10 h-10 rounded-lg bg-purple-500/10 flex items-center justify-center text-purple-400 group-hover:scale-110 transition text-lg font-bold">+</span>
                <span class="text-xs text-gray-400 group-hover:text-white transition">Nueva categoría</span>
            </a>
            <a href="{{ route('admin.tags.create') }}" class="flex flex-col items-center gap-2 p-4 rounded-lg border border-surface-border hover:border-yellow-500/30 hover:bg-surface-hover transition group">
                <span class="w-10 h-10 rounded-lg bg-yellow-500/10 flex items-center justify-center text-yellow-400 group-hover:scale-110 transition text-lg font-bold">+</span>
                <span class="text-xs text-gray-400 group-hover:text-white transition">Nuevo tag</span>
            </a>
            <a href="{{ route('admin.media.index') }}" class="flex flex-col items-center gap-2 p-4 rounded-lg border border-surface-border hover:border-blue-500/30 hover:bg-surface-hover transition group">
                <span class="w-10 h-10 rounded-lg bg-blue-500/10 flex items-center justify-center text-blue-400 group-hover:scale-110 transition text-lg font-bold">+</span>
                <span class="text-xs text-gray-400 group-hover:text-white transition">Subir archivo</span>
            </a>
            <a href="{{ route('admin.blocks.index') }}" class="flex flex-col items-center gap-2 p-4 rounded-lg border border-surface-border hover:border-gray-500/30 hover:bg-surface-hover transition group">
                <span class="w-10 h-10 rounded-lg bg-gray-500/10 flex items-center justify-center text-gray-400 group-hover:scale-110 transition text-lg font-bold">+</span>
                <span class="text-xs text-gray-400 group-hover:text-white transition">Bloques de contenido</span>
            </a>
        </div>
    </x-card>
</div>
