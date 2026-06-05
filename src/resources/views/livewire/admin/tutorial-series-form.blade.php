@section('title', $series?->exists ? 'Editar Serie' : 'Nueva Serie')
<div>
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-white">{{ $series?->exists ? 'Editar serie' : 'Nueva serie' }}</h2>
        <a href="{{ route('admin.series.index') }}" class="px-4 py-2 bg-surface-card hover:bg-surface-hover rounded-lg text-sm font-medium transition text-gray-300">← Volver</a>
    </div>

    <form wire:submit="save" class="space-y-6 max-w-xl">
        <div class="card p-6 space-y-4">
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="title" value="Título" />
                    <x-text-input wire:model="title" id="title" class="w-full mt-1" />
                    <x-input-error :messages="$errors->get('title')" class="mt-1" />
                </div>
                <div>
                    <div class="flex items-center justify-between">
                        <x-input-label value="Slug" />
                        <button type="button" wire:click="toggleSlugEditor" class="text-xs text-brand-400 hover:text-brand-300">
                            {{ $showSlugEditor ? 'Auto' : 'Editar' }}
                        </button>
                    </div>
                    @if ($showSlugEditor)
                        <x-text-input wire:model="slug" id="slug" class="w-full mt-1 font-mono text-sm" />
                    @else
                        <p class="mt-1 text-sm text-gray-500 font-mono">{{ $slug ?: Str::slug($title) }}</p>
                    @endif
                    <x-input-error :messages="$errors->get('slug')" class="mt-1" />
                </div>
            </div>

            <div>
                <x-input-label for="description" value="Descripción" />
                <textarea wire:model="description" id="description" rows="3" class="w-full mt-1 border-surface-input bg-surface-card text-gray-200 focus:border-brand-500 focus:ring-brand-500 rounded-md shadow-sm text-sm"></textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-1" />
            </div>

            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="difficulty" value="Dificultad" />
                    <select wire:model="difficulty" id="difficulty" class="w-full mt-1 border-surface-input bg-surface-card text-gray-200 focus:border-brand-500 focus:ring-brand-500 rounded-md shadow-sm text-sm">
                        <option value="beginner">Principiante</option>
                        <option value="intermediate">Intermedio</option>
                        <option value="advanced">Avanzado</option>
                    </select>
                    <x-input-error :messages="$errors->get('difficulty')" class="mt-1" />
                </div>
                <div>
                    <x-input-label for="sort_order" value="Orden" />
                    <x-text-input wire:model="sort_order" id="sort_order" type="number" class="w-full mt-1" />
                    <x-input-error :messages="$errors->get('sort_order')" class="mt-1" />
                </div>
            </div>

            <div>
                <x-input-label for="thumbnail" value="URL thumbnail" />
                <x-text-input wire:model="thumbnail" id="thumbnail" class="w-full mt-1" placeholder="https://..." />
                <x-input-error :messages="$errors->get('thumbnail')" class="mt-1" />
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" wire:model="is_active" id="is_active" class="rounded border-surface-input bg-surface-card text-brand-500 focus:ring-brand-500">
                <x-input-label for="is_active" value="Activo" />
            </div>
        </div>

        <div class="flex gap-4">
            <x-primary-button>{{ $series?->exists ? 'Actualizar' : 'Crear serie' }}</x-primary-button>
            <a href="{{ route('admin.series.index') }}" class="px-4 py-2 bg-surface-card hover:bg-surface-hover rounded-lg text-sm font-medium transition text-gray-300">Cancelar</a>
        </div>
    </form>
</div>
