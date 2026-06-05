@section('title', $category?->exists ? 'Editar Categoría' : 'Nueva Categoría')
<div>
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-white">{{ $category?->exists ? 'Editar categoría' : 'Nueva categoría' }}</h2>
        <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 bg-surface-card hover:bg-surface-hover rounded-lg text-sm font-medium transition text-gray-300">← Volver</a>
    </div>

    <form wire:submit="save" class="space-y-6 max-w-xl">
        <div class="card p-6 space-y-4">
            <div>
                <x-input-label for="name" value="Nombre" />
                <x-text-input wire:model="name" id="name" class="w-full mt-1" />
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
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
                    <p class="mt-1 text-sm text-gray-500 font-mono">{{ $slug ?: Str::slug($name) }}</p>
                @endif
                <x-input-error :messages="$errors->get('slug')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="description" value="Descripción" />
                <textarea wire:model="description" id="description" rows="2" class="w-full mt-1 border-surface-input bg-surface-card text-gray-200 focus:border-brand-500 focus:ring-brand-500 rounded-md shadow-sm text-sm"></textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="parent_id" value="Categoría padre" />
                <select wire:model="parent_id" id="parent_id" class="w-full mt-1 border-surface-input bg-surface-card text-gray-200 focus:border-brand-500 focus:ring-brand-500 rounded-md shadow-sm text-sm">
                    <option value="">— Sin padre —</option>
                    @foreach ($parents as $parent)
                        <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('parent_id')" class="mt-1" />
            </div>
        </div>

        <div class="flex gap-4">
            <x-primary-button>{{ $category?->exists ? 'Actualizar' : 'Crear categoría' }}</x-primary-button>
            <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 bg-surface-card hover:bg-surface-hover rounded-lg text-sm font-medium transition text-gray-300">Cancelar</a>
        </div>
    </form>
</div>
