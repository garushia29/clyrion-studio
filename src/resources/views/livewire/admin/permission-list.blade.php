<div>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Permisos</h1>
            <p class="text-sm text-gray-400 mt-1">Gestiona los permisos del sistema</p>
        </div>
        <x-button variant="primary" href="{{ route('admin.permissions.create') }}">Nuevo permiso</x-button>
    </div>

    <x-card padding="false">
        <x-slot:title>Permisos</x-slot:title>
        <x-slot:action>
            <x-text-input wire:model.live="search" placeholder="Buscar permisos..." class="w-64" />
        </x-slot:action>

        <x-table :headers="['Nombre', 'Roles asignados', '']">
            @forelse ($permissions as $permission)
                <tr class="text-sm text-gray-300 hover:bg-surface-hover/50 transition">
                    <td class="px-4 py-3 font-medium text-white font-mono text-xs">{{ $permission->name }}</td>
                    <td class="px-4 py-3">{{ $permission->roles_count }}</td>
                    <td class="px-4 py-3 text-right whitespace-nowrap">
                        <x-button variant="ghost" size="sm" href="{{ route('admin.permissions.edit', $permission) }}">Editar</x-button>
                        <button wire:click="delete({{ $permission->id }})"
                                wire:confirm="¿Eliminar este permiso? Los roles perderán este permiso."
                                class="px-3 py-1.5 text-xs font-medium text-red-400 hover:text-red-300 hover:bg-red-500/10 rounded-lg transition">
                            Eliminar
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="py-12 text-center text-gray-500">No se encontraron permisos.</td>
                </tr>
            @endforelse
        </x-table>

        <x-slot:footer>
            {{ $permissions->links(data: ['scrollTo' => false]) }}
        </x-slot:footer>
    </x-card>
</div>
