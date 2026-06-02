{{-- Panel de administración: listado de servicios --}}
{{-- Muestra una tabla paginada con búsqueda, toggle de estado y acciones --}}

@section('title', 'Servicios')

<div>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Servicios</h1>
            <p class="text-sm text-gray-400 mt-1">Gestiona los servicios que se muestran en la página principal</p>
        </div>
        <a href="{{ route('admin.services.create') }}" wire:navigate class="px-4 py-2 bg-brand-600 hover:bg-brand-700 rounded-lg text-sm font-medium transition">
            + Nuevo servicio
        </a>
    </div>

    <div class="bg-surface-card rounded-xl border border-surface-border overflow-hidden">
        <div class="p-4 border-b border-surface-border">
            <input type="text" wire:model.live="search" placeholder="Buscar servicios..."
                   class="w-full bg-surface border border-surface-border rounded-lg px-4 py-2 text-sm text-gray-200 placeholder-gray-500 focus:outline-none focus:border-brand-500">
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-sm text-gray-400 border-b border-surface-border">
                        <th class="px-4 py-3 font-medium">Orden</th>
                        <th class="px-4 py-3 font-medium">Título</th>
                        <th class="px-4 py-3 font-medium">Descripción</th>
                        <th class="px-4 py-3 font-medium">Icono</th>
                        <th class="px-4 py-3 font-medium">Estado</th>
                        <th class="px-4 py-3 font-medium text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border">
                    @foreach($services as $service)
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
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.services.edit', $service) }}" wire:navigate
                                       class="px-3 py-1.5 text-xs font-medium text-gray-400 hover:text-white hover:bg-surface-hover rounded-lg transition">
                                        Editar
                                    </a>
                                    <button wire:click="delete({{ $service->id }})"
                                            wire:confirm="¿Eliminar este servicio?"
                                            class="px-3 py-1.5 text-xs font-medium text-red-400 hover:text-red-300 hover:bg-red-500/10 rounded-lg transition">
                                        Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($services->isEmpty())
            <div class="text-center py-12 text-gray-500">
                <p>No se encontraron servicios.</p>
            </div>
        @endif

        <div class="p-4 border-t border-surface-border">
            {{ $services->links(data: ['scrollTo' => false]) }}
        </div>
    </div>
</div>
