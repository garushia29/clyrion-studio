{{-- Panel de administración: formulario de creación/edición de servicios --}}
{{-- Incluye campos de título, slug (auto-generado o manual), descripción, icono, orden y estado --}}

@section('title', $service?->exists ? 'Editar Servicio' : 'Nuevo Servicio')

<div>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white">{{ $service?->exists ? 'Editar Servicio' : 'Nuevo Servicio' }}</h1>
            <p class="text-sm text-gray-400 mt-1">{{ $service?->exists ? "Editando: {$service->title}" : 'Crear un nuevo servicio' }}</p>
        </div>
        <a href="{{ route('admin.services.index') }}" wire:navigate class="px-4 py-2 text-sm text-gray-400 hover:text-white transition">
            ← Volver
        </a>
    </div>

    <form wire:submit="save" class="max-w-2xl space-y-6">
        <div class="bg-surface-card rounded-xl border border-surface-border p-6 space-y-5">
            <h2 class="text-lg font-semibold text-white">Información del servicio</h2>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Título</label>
                <input type="text" wire:model="title"
                       class="w-full bg-surface border border-surface-border rounded-lg px-4 py-2.5 text-sm text-gray-200 placeholder-gray-500 focus:outline-none focus:border-brand-500">
                @error('title') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Slug</label>
                <div class="flex items-center gap-2">
                    <input type="text" wire:model="slug"
                           class="flex-1 bg-surface border border-surface-border rounded-lg px-4 py-2.5 text-sm text-gray-200 placeholder-gray-500 focus:outline-none focus:border-brand-500">
                    <button type="button" wire:click="toggleSlugEditor" class="text-xs text-gray-500 hover:text-gray-300 transition">
                        {{ $autoSlug ? 'Personalizar' : 'Auto' }}
                    </button>
                </div>
                @error('slug') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Descripción</label>
                <textarea wire:model="description" rows="3"
                          class="w-full bg-surface border border-surface-border rounded-lg px-4 py-2.5 text-sm text-gray-200 placeholder-gray-500 focus:outline-none focus:border-brand-500"></textarea>
                @error('description') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Icono</label>
                    <input type="text" wire:model="icon" placeholder="code, server, etc."
                           class="w-full bg-surface border border-surface-border rounded-lg px-4 py-2.5 text-sm text-gray-200 placeholder-gray-500 focus:outline-none focus:border-brand-500">
                    @error('icon') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Orden</label>
                    <input type="number" wire:model="sort_order" min="0"
                           class="w-full bg-surface border border-surface-border rounded-lg px-4 py-2.5 text-sm text-gray-200 placeholder-gray-500 focus:outline-none focus:border-brand-500">
                    @error('sort_order') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" wire:model="is_active" id="is_active"
                       class="rounded bg-surface border-surface-border text-brand-600 focus:ring-brand-500">
                <label for="is_active" class="text-sm text-gray-300">Activo</label>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.services.index') }}" wire:navigate
               class="px-4 py-2 text-sm text-gray-400 hover:text-white transition">
                Cancelar
            </a>
            <button type="submit"
                    class="px-6 py-2 bg-brand-600 hover:bg-brand-700 rounded-lg text-sm font-medium transition">
                {{ $service?->exists ? 'Actualizar' : 'Crear servicio' }}
            </button>
        </div>
    </form>
</div>
