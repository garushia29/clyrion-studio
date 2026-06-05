@section('title', 'Series de Tutoriales')
<div>
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-white">Series de tutoriales</h2>
        <x-button variant="primary" href="{{ route('admin.series.create') }}">Nueva serie</x-button>
    </div>

    <div class="flex gap-4 mb-6">
        <x-text-input wire:model.live="search" placeholder="Buscar series..." class="w-64" />
    </div>

    <x-table :headers="['Título', 'Dificultad', 'Tutoriales', 'Activo', '']">
        @forelse ($series as $s)
            <tr class="hover:bg-surface-hover transition">
                <td class="py-3 px-4 text-white">{{ $s->title }}</td>
                <td class="py-3 px-4">
                    <x-badge variant="neutral">{{ $s->difficulty }}</x-badge>
                </td>
                <td class="py-3 px-4">
                    <x-badge variant="brand">{{ $s->tutorials_count }}</x-badge>
                </td>
                <td class="py-3 px-4">
                    <span class="{{ $s->is_active ? 'text-green-400' : 'text-gray-600' }}">{{ $s->is_active ? 'Sí' : 'No' }}</span>
                </td>
                <td class="py-3 px-4 text-right whitespace-nowrap">
                    <x-button variant="ghost" size="sm" href="{{ route('admin.series.edit', $s) }}">Editar</x-button>
                    <button wire:click="delete({{ $s->id }})" wire:confirm="¿Eliminar esta serie?" class="text-red-400 hover:text-red-300 transition text-sm">Eliminar</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="py-12">
                    <x-empty-state title="No hay series aún" description="Crea una serie para agrupar tutoriales relacionados" />
                </td>
            </tr>
        @endforelse
    </x-table>

    <div class="mt-6">
        {{ $series->links() }}
    </div>
</div>
