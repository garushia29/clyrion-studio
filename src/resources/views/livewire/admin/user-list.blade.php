<div>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Usuarios</h1>
            <p class="text-sm text-gray-400 mt-1">Gestiona los usuarios registrados en la plataforma</p>
        </div>
        <x-button variant="primary" href="{{ route('admin.users.create') }}">Nuevo usuario</x-button>
    </div>

    <x-card padding="false">
        <x-slot:title>Usuarios</x-slot:title>
        <x-slot:action>
            <x-text-input wire:model.live="search" placeholder="Buscar por nombre o email..." class="w-64" />
        </x-slot:action>

        <x-table :headers="['Nombre', 'Email', 'Rol', 'Roles', 'Registrado', 'Verificado', '']">
            @forelse ($users as $user)
                <tr class="text-sm text-gray-300 hover:bg-surface-hover/50 transition">
                    <td class="px-4 py-3 font-medium text-white">{{ $user->name }}</td>
                    <td class="px-4 py-3">{{ $user->email }}</td>
                    <td class="px-4 py-3">
                        @if($user->isAdmin())
                            <x-badge variant="brand">Admin</x-badge>
                        @else
                            <x-badge variant="neutral">Usuario</x-badge>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex flex-wrap gap-1">
                            @forelse ($user->roles as $role)
                                <x-badge variant="neutral" size="sm">{{ $role->name }}</x-badge>
                            @empty
                                <span class="text-gray-600">—</span>
                            @endforelse
                        </div>
                    </td>
                    <td class="px-4 py-3 text-gray-400">{{ $user->created_at->format('d/m/Y') }}</td>
                    <td class="px-4 py-3">
                        @if($user->email_verified_at)
                            <span class="text-green-400">✓</span>
                        @else
                            <span class="text-gray-600">—</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-right whitespace-nowrap">
                        <x-button variant="ghost" size="sm" href="{{ route('admin.users.edit', $user) }}">Editar</x-button>
                        @if($user->id !== auth()->id())
                            <button wire:click="delete({{ $user->id }})"
                                    wire:confirm="¿Eliminar este usuario? Esta acción no se puede deshacer."
                                    class="px-3 py-1.5 text-xs font-medium text-red-400 hover:text-red-300 hover:bg-red-500/10 rounded-lg transition">
                                Eliminar
                            </button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="py-12 text-center text-gray-500">No se encontraron usuarios.</td>
                </tr>
            @endforelse
        </x-table>

        <x-slot:footer>
            {{ $users->links(data: ['scrollTo' => false]) }}
        </x-slot:footer>
    </x-card>
</div>
