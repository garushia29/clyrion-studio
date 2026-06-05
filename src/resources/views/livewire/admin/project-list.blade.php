@section('title', 'Proyectos')
<div>
    <div class="flex flex-wrap items-center justify-between gap-2 mb-6">
        <h2 class="text-2xl font-bold text-white">Proyectos</h2>
        <x-button variant="primary" href="{{ route('admin.projects.create') }}">Nuevo proyecto</x-button>
    </div>

    <div class="flex flex-col sm:flex-row gap-4 mb-6">
        <x-text-input wire:model.live="search" placeholder="Buscar proyectos..." class="w-full sm:w-64" />
        <select wire:model.live="status" class="border-surface-input bg-surface-card text-gray-200 focus:border-brand-500 focus:ring-brand-500 rounded-md shadow-sm text-sm">
            <option value="">Todos</option>
            <option value="published">Publicados</option>
            <option value="draft">Borradores</option>
        </select>
    </div>

    <x-table :headers="['Título', 'Estado', 'Año', 'Destacado', '']">
        @forelse ($projects as $project)
            <tr class="hover:bg-surface-hover transition">
                <td class="py-3 px-4 text-white">{{ $project->title }}</td>
                <td class="py-3 px-4">
                    <x-badge :variant="$project->status === 'published' ? 'success' : 'warning'">{{ $project->status }}</x-badge>
                </td>
                <td class="py-3 px-4 text-gray-400">{{ $project->year }}</td>
                <td class="py-3 px-4">
                    @if ($project->featured)
                        <span class="text-brand-400">★</span>
                    @endif
                </td>
                <td class="py-3 px-4 text-right whitespace-nowrap">
                    <x-button variant="ghost" size="sm" href="{{ route('admin.projects.edit', $project) }}">Editar</x-button>
                    <button wire:click="delete({{ $project->id }})" wire:confirm="¿Eliminar este proyecto?" class="text-red-400 hover:text-red-300 transition text-sm">Eliminar</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="py-12 text-center text-gray-500">No hay proyectos aún</td>
            </tr>
        @endforelse
    </x-table>

    <div class="mt-6">
        {{ $projects->links() }}
    </div>
</div>
