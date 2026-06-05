<div>
    <div class="flex items-center justify-between mb-6">
@section('title', 'Servicios')
<div>
            <h1 class="text-2xl font-bold text-white">Servicios</h1>
            <p class="text-sm text-gray-400 mt-1">Gestiona los servicios que se muestran en la página principal</p>
        </div>
        <x-button variant="primary" href="{{ route('admin.services.create') }}">Nuevo servicio</x-button>
    </div>

    <x-card padding="false">
        <x-slot:title>Servicios</x-slot:title>
        <x-slot:action>
            <x-text-input wire:model.live="search" placeholder="Buscar servicios..." class="w-64" />
        </x-slot:action>

        <x-table :headers="['Orden', 'Título', 'Descripción', 'Icono', 'Estado', '']">
            @forelse ($services as $service)
                <tr class="text-sm text-gray-300 hover:bg-surface-hover/50 transition">
                    <td class="px-4 py-3 text-gray-400">{{ $service->sort_order }}</td>
                    <td class="px-4 py-3 font-medium text-white">{{ $service->title }}</td>
                    <td class="px-4 py-3 max-w-xs truncate">{{ $service->description }}</td>
                    <td class="px-4 py-3 text-gray-400">{{ $service->icon ?: '—' }}</td>
                    <td class="px-4 py-3">
                        <button wire:click="toggleActive({{ $service->id }})"
                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium transition
                                {{ $service->is_active ? 'bg-green-500/10 text-green-400' : 'bg-gray-500/10 text-gray-500' }}">
                            {{ $service->is_active ? 'Activo' : 'Inactivo' }}
                        </button>
                    </td>
                    <td class="px-4 py-3 text-right whitespace-nowrap">
                        <x-button variant="ghost" size="sm" href="{{ route('admin.services.edit', $service) }}">Editar</x-button>
                        <button wire:click="delete({{ $service->id }})"
                                wire:confirm="¿Eliminar este servicio?"
                                class="px-3 py-1.5 text-xs font-medium text-red-400 hover:text-red-300 hover:bg-red-500/10 rounded-lg transition">
                            Eliminar
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="py-12 text-center text-gray-500">No hay servicios aún</td>
                </tr>
            @endforelse
        </x-table>

        <x-slot:footer>
            {{ $services->links(data: ['scrollTo' => false]) }}
        </x-slot:footer>
    </x-card>
</div>
