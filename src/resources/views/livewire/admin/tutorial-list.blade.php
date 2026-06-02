<div>
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-white">Tutoriales</h2>
        <a href="{{ route('admin.tutorials.create') }}" class="px-4 py-2 bg-brand-600 hover:bg-brand-700 rounded-lg text-sm font-medium transition">Nuevo tutorial</a>
    </div>

    <div class="flex gap-4 mb-6">
        <x-text-input wire:model.live="search" placeholder="Buscar tutoriales..." class="w-64" />
        <select wire:model.live="status" class="border-surface-input bg-surface-card text-gray-200 focus:border-brand-500 focus:ring-brand-500 rounded-md shadow-sm text-sm">
            <option value="">Todos</option>
            <option value="published">Publicados</option>
            <option value="draft">Borradores</option>
        </select>
    </div>

    <div class="card overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-surface-card border-b border-surface-border">
                <tr>
                    <th class="text-left py-3 px-4 text-gray-400 font-medium">Título</th>
                    <th class="text-left py-3 px-4 text-gray-400 font-medium">Serie</th>
                    <th class="text-left py-3 px-4 text-gray-400 font-medium">Dificultad</th>
                    <th class="text-center py-3 px-4 text-gray-400 font-medium">Duración</th>
                    <th class="text-left py-3 px-4 text-gray-400 font-medium">Estado</th>
                    <th class="text-right py-3 px-4 text-gray-400 font-medium">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-border">
                @forelse ($tutorials as $tutorial)
                    <tr class="hover:bg-surface-hover transition">
                        <td class="py-3 px-4 text-white">{{ $tutorial->title }}</td>
                        <td class="py-3 px-4 text-gray-400">{{ $tutorial->series?->title ?? '—' }}</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-0.5 text-xs rounded-full {{ $tutorial->difficultyColor() }}">{{ $tutorial->difficultyLabel() }}</span>
                        </td>
                        <td class="py-3 px-4 text-center text-gray-400 text-xs">{{ $tutorial->readingTime() }}</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-0.5 text-xs rounded-full {{ $tutorial->status === 'published' ? 'bg-green-500/10 text-green-400' : 'bg-yellow-500/10 text-yellow-400' }}">
                                {{ $tutorial->status }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-right">
                            <a href="{{ route('admin.tutorials.edit', $tutorial) }}" class="text-brand-400 hover:text-brand-300 transition text-sm mr-3">Editar</a>
                            <button wire:click="delete({{ $tutorial->id }})" wire:confirm="¿Eliminar este tutorial?" class="text-red-400 hover:text-red-300 transition text-sm">Eliminar</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-gray-500">No hay tutoriales aún</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $tutorials->links() }}
    </div>
</div>
