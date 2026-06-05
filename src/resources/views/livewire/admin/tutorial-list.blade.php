@section('title', 'Tutoriales')
<div>
    <div class="flex flex-wrap items-center justify-between gap-2 mb-6">
        <h2 class="text-2xl font-bold text-white">Tutoriales</h2>
        <x-button variant="primary" href="{{ route('admin.tutorials.create') }}">Nuevo tutorial</x-button>
    </div>

    <div class="flex flex-col sm:flex-row gap-4 mb-6">
        <x-text-input wire:model.live="search" placeholder="Buscar tutoriales..." class="w-full sm:w-64" />
        <select wire:model.live="status" class="border-surface-input bg-surface-card text-gray-200 focus:border-brand-500 focus:ring-brand-500 rounded-md shadow-sm text-sm">
            <option value="">Todos</option>
            <option value="published">Publicados</option>
            <option value="draft">Borradores</option>
        </select>
    </div>

    <x-table :headers="['Título', 'Serie', 'Dificultad', 'Duración', 'Estado', '']">
        @forelse ($tutorials as $tutorial)
            <tr class="hover:bg-surface-hover transition">
                <td class="py-3 px-4 text-white">{{ $tutorial->title }}</td>
                <td class="py-3 px-4 text-gray-400">{{ $tutorial->series?->title ?? '—' }}</td>
                <td class="py-3 px-4">
                    <x-badge variant="neutral">{{ $tutorial->difficultyLabel() }}</x-badge>
                </td>
                <td class="py-3 px-4 text-center text-gray-400 text-xs">{{ $tutorial->readingTime() }}</td>
                <td class="py-3 px-4">
                    <x-badge :variant="$tutorial->status === 'published' ? 'success' : 'warning'">{{ $tutorial->status }}</x-badge>
                </td>
                <td class="py-3 px-4 text-right whitespace-nowrap">
                    <x-button variant="ghost" size="sm" href="{{ route('admin.tutorials.edit', $tutorial) }}">Editar</x-button>
                    <button wire:click="delete({{ $tutorial->id }})" wire:confirm="¿Eliminar este tutorial?" class="text-red-400 hover:text-red-300 transition text-sm">Eliminar</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="py-12 text-center text-gray-500">No hay tutoriales aún</td>
            </tr>
        @endforelse
    </x-table>

    <div class="mt-6">
        {{ $tutorials->links() }}
    </div>
</div>
