@section('title', $role?->exists ? 'Editar Rol' : 'Nuevo Rol')

<div>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white">{{ $role?->exists ? 'Editar Rol' : 'Nuevo Rol' }}</h1>
            <p class="text-sm text-gray-400 mt-1">{{ $role?->exists ? "Editando: {$role->name}" : 'Crear un nuevo rol de usuario' }}</p>
        </div>
        <a href="{{ route('admin.roles.index') }}" wire:navigate class="px-4 py-2 text-sm text-gray-400 hover:text-white transition">
            ← Volver
        </a>
    </div>

    <form wire:submit="save" class="max-w-2xl space-y-6">
        <div class="bg-surface-card rounded-xl border border-surface-border p-6 space-y-5">
            <h2 class="text-lg font-semibold text-white">Información del rol</h2>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Nombre</label>
                <input type="text" wire:model="name"
                       class="w-full bg-surface border border-surface-border rounded-lg px-4 py-2.5 text-sm text-gray-200 placeholder-gray-500 focus:outline-none focus:border-brand-500"
                       placeholder="ej: editor, moderator">
                @error('name') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="bg-surface-card rounded-xl border border-surface-border p-6 space-y-5">
            <h2 class="text-lg font-semibold text-white">Permisos</h2>
            <p class="text-sm text-gray-400">Selecciona los permisos que tendrá este rol</p>

            @foreach ($permissions as $group => $groupPermissions)
                <div class="space-y-2">
                    <h3 class="text-sm font-medium text-gray-300 capitalize border-b border-surface-border pb-1">
                        {{ $group }}
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                        @foreach ($groupPermissions as $permission)
                            <label class="flex items-center gap-2 px-3 py-2 rounded-lg border border-surface-border hover:bg-surface-hover cursor-pointer transition">
                                <input type="checkbox" wire:model="selectedPermissions" value="{{ $permission->name }}"
                                       class="rounded border-surface-input bg-surface text-brand-500 focus:ring-brand-500">
                                <span class="text-sm text-gray-300">{{ $permission->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endforeach
            @error('selectedPermissions') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.roles.index') }}" wire:navigate
               class="px-4 py-2 text-sm text-gray-400 hover:text-white transition">
                Cancelar
            </a>
            <button type="submit"
                    class="px-6 py-2 bg-brand-600 hover:bg-brand-700 rounded-lg text-sm font-medium transition">
                {{ $role?->exists ? 'Actualizar' : 'Crear rol' }}
            </button>
        </div>
    </form>
</div>
