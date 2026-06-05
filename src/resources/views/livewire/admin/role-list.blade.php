<div>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Roles</h1>
            <p class="text-sm text-gray-400 mt-1">Gestiona los roles de usuario del sistema</p>
        </div>
        <x-button variant="primary" href="{{ route('admin.roles.create') }}">Nuevo rol</x-button>
    </div>

    <x-card padding="false">
        <x-slot:title>Roles</x-slot:title>
        <x-slot:action>
            <x-text-input wire:model.live="search" placeholder="Buscar roles..." class="w-64" />
        </x-slot:action>

        <x-table :headers="['Nombre', 'Usuarios', 'Permisos', '']">
            @forelse ($roles as $role)
                <tr class="text-sm text-gray-300 hover:bg-surface-hover/50 transition">
                    <td class="px-4 py-3 font-medium text-white">{{ $role->name }}</td>
                    <td class="px-4 py-3">{{ $role->users_count }}</td>
                    <td class="px-4 py-3">{{ $role->permissions_count }}</td>
                    <td class="px-4 py-3 text-right whitespace-nowrap">
                        <x-button variant="ghost" size="sm" href="{{ route('admin.roles.edit', $role) }}">Editar</x-button>
                        @if($role->name !== 'super-admin')
                            <button wire:click="delete({{ $role->id }})"
                                    wire:confirm="¿Eliminar este rol? Los usuarios perderán este rol."
                                    class="px-3 py-1.5 text-xs font-medium text-red-400 hover:text-red-300 hover:bg-red-500/10 rounded-lg transition">
                                Eliminar
                            </button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="py-12 text-center text-gray-500">No se encontraron roles.</td>
                </tr>
            @endforelse
        </x-table>

        <x-slot:footer>
            {{ $roles->links(data: ['scrollTo' => false]) }}
        </x-slot:footer>
    </x-card>
</div>
