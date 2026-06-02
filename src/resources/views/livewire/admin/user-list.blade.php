@section('title', 'Usuarios')

<div>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Usuarios</h1>
            <p class="text-sm text-gray-400 mt-1">Gestiona los usuarios registrados en la plataforma</p>
        </div>
        <a href="{{ route('admin.users.create') }}" wire:navigate class="px-4 py-2 bg-brand-600 hover:bg-brand-700 rounded-lg text-sm font-medium transition">
            + Nuevo usuario
        </a>
    </div>

    <div class="bg-surface-card rounded-xl border border-surface-border overflow-hidden">
        <div class="p-4 border-b border-surface-border">
            <input type="text" wire:model.live="search" placeholder="Buscar por nombre o email..."
                   class="w-full bg-surface border border-surface-border rounded-lg px-4 py-2 text-sm text-gray-200 placeholder-gray-500 focus:outline-none focus:border-brand-500">
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-sm text-gray-400 border-b border-surface-border">
                        <th class="px-4 py-3 font-medium">Nombre</th>
                        <th class="px-4 py-3 font-medium">Email</th>
                        <th class="px-4 py-3 font-medium">Rol</th>
                        <th class="px-4 py-3 font-medium">Registrado</th>
                        <th class="px-4 py-3 font-medium">Verificado</th>
                        <th class="px-4 py-3 font-medium text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border">
                    @foreach($users as $user)
                        <tr class="text-sm text-gray-300 hover:bg-surface-hover/50 transition">
                            <td class="px-4 py-3 font-medium text-white">{{ $user->name }}</td>
                            <td class="px-4 py-3">{{ $user->email }}</td>
                            <td class="px-4 py-3">
                                @if($user->isAdmin())
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-brand-500/10 text-brand-400 border border-brand-500/20">
                                        Admin
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-500/10 text-gray-400 border border-gray-500/20">
                                        Usuario
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-gray-400">{{ $user->created_at->format('d/m/Y') }}</td>
                            <td class="px-4 py-3">
                                @if($user->email_verified_at)
                                    <span class="text-green-400">✓</span>
                                @else
                                    <span class="text-gray-600">—</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" wire:navigate
                                       class="px-3 py-1.5 text-xs font-medium text-gray-400 hover:text-white hover:bg-surface-hover rounded-lg transition">
                                        Editar
                                    </a>
                                    @if($user->id !== auth()->id())
                                        <button wire:click="delete({{ $user->id }})"
                                                wire:confirm="¿Eliminar este usuario? Esta acción no se puede deshacer."
                                                class="px-3 py-1.5 text-xs font-medium text-red-400 hover:text-red-300 hover:bg-red-500/10 rounded-lg transition">
                                            Eliminar
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($users->isEmpty())
            <div class="text-center py-12 text-gray-500">
                <p>No se encontraron usuarios.</p>
            </div>
        @endif

        <div class="p-4 border-t border-surface-border">
            {{ $users->links(data: ['scrollTo' => false]) }}
        </div>
    </div>
</div>
