<div>
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-white">Series de tutoriales</h2>
        <a href="{{ route('admin.tutorial-series.create') }}" class="px-4 py-2 bg-brand-600 hover:bg-brand-700 rounded-lg text-sm font-medium transition">Nueva serie</a>
    </div>

    <div class="flex gap-4 mb-6">
        <x-text-input wire:model.live="search" placeholder="Buscar series..." class="w-64" />
    </div>

    <div class="card overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-surface-card border-b border-surface-border">
                <tr>
                    <th class="text-left py-3 px-4 text-gray-400 font-medium">Título</th>
                    <th class="text-left py-3 px-4 text-gray-400 font-medium">Dificultad</th>
                    <th class="text-center py-3 px-4 text-gray-400 font-medium">Tutoriales</th>
                    <th class="text-center py-3 px-4 text-gray-400 font-medium">Activo</th>
                    <th class="text-right py-3 px-4 text-gray-400 font-medium">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-border">
                @forelse ($series as $s)
                    <tr class="hover:bg-surface-hover transition">
                        <td class="py-3 px-4 text-white">{{ $s->title }}</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-0.5 text-xs rounded-full {{ (new \App\Models\Tutorial)->difficultyColor() }}">
                                {{ (new \App\Models\Tutorial)->difficultyLabel() }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <span class="px-2 py-0.5 text-xs rounded-full bg-brand-500/10 text-brand-400">{{ $s->tutorials_count }}</span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <span class="{{ $s->is_active ? 'text-green-400' : 'text-gray-600' }}">{{ $s->is_active ? 'Sí' : 'No' }}</span>
                        </td>
                        <td class="py-3 px-4 text-right">
                            <a href="{{ route('admin.tutorial-series.edit', $s) }}" class="text-brand-400 hover:text-brand-300 transition text-sm mr-3">Editar</a>
                            <button wire:click="delete({{ $s->id }})" wire:confirm="¿Eliminar esta serie?" class="text-red-400 hover:text-red-300 transition text-sm">Eliminar</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center text-gray-500">No hay series aún</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $series->links() }}
    </div>
</div>
