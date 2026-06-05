@section('title', $user?->exists ? 'Editar Usuario' : 'Nuevo Usuario')

<div>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white">{{ $user?->exists ? 'Editar Usuario' : 'Nuevo Usuario' }}</h1>
            <p class="text-sm text-gray-400 mt-1">{{ $user?->exists ? "Editando: {$user->name}" : 'Crear una nueva cuenta de usuario' }}</p>
        </div>
        <a href="{{ route('admin.users.index') }}" wire:navigate class="px-4 py-2 text-sm text-gray-400 hover:text-white transition">
            ← Volver
        </a>
    </div>

    <form wire:submit="save" class="max-w-2xl space-y-6">
        <div class="bg-surface-card rounded-xl border border-surface-border p-6 space-y-5">
            <h2 class="text-lg font-semibold text-white">Información del usuario</h2>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Nombre</label>
                <input type="text" wire:model="name"
                       class="w-full bg-surface border border-surface-border rounded-lg px-4 py-2.5 text-sm text-gray-200 placeholder-gray-500 focus:outline-none focus:border-brand-500">
                @error('name') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                <input type="email" wire:model="email"
                       class="w-full bg-surface border border-surface-border rounded-lg px-4 py-2.5 text-sm text-gray-200 placeholder-gray-500 focus:outline-none focus:border-brand-500">
                @error('email') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Rol (legacy)</label>
                <select wire:model="role"
                        class="w-full bg-surface border border-surface-border rounded-lg px-4 py-2.5 text-sm text-gray-200 focus:outline-none focus:border-brand-500">
                    <option value="user">Usuario</option>
                    <option value="admin">Administrador</option>
                </select>
                @error('role') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="bg-surface-card rounded-xl border border-surface-border p-6 space-y-5">
            <h2 class="text-lg font-semibold text-white">Roles del sistema</h2>
            <p class="text-sm text-gray-400">Asigna roles de Spatie a este usuario</p>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                @foreach ($roles as $role)
                    <label class="flex items-center gap-2 px-3 py-2 rounded-lg border border-surface-border hover:bg-surface-hover cursor-pointer transition">
                        <input type="checkbox" wire:model="selectedRoles" value="{{ $role->name }}"
                               class="rounded border-surface-input bg-surface text-brand-500 focus:ring-brand-500">
                        <span class="text-sm text-gray-300">{{ $role->name }}</span>
                    </label>
                @endforeach
            </div>
            @error('selectedRoles') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
        </div>

        <div class="bg-surface-card rounded-xl border border-surface-border p-6 space-y-5">
            <h2 class="text-lg font-semibold text-white">{{ $user?->exists ? 'Cambiar contraseña (opcional)' : 'Contraseña' }}</h2>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Contraseña</label>
                <input type="password" wire:model="password"
                       class="w-full bg-surface border border-surface-border rounded-lg px-4 py-2.5 text-sm text-gray-200 placeholder-gray-500 focus:outline-none focus:border-brand-500">
                @error('password') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Confirmar contraseña</label>
                <input type="password" wire:model="password_confirmation"
                       class="w-full bg-surface border border-surface-border rounded-lg px-4 py-2.5 text-sm text-gray-200 placeholder-gray-500 focus:outline-none focus:border-brand-500">
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.users.index') }}" wire:navigate
               class="px-4 py-2 text-sm text-gray-400 hover:text-white transition">
                Cancelar
            </a>
            <button type="submit"
                    class="px-6 py-2 bg-brand-600 hover:bg-brand-700 rounded-lg text-sm font-medium transition">
                {{ $user?->exists ? 'Actualizar' : 'Crear usuario' }}
            </button>
        </div>
    </form>
</div>
