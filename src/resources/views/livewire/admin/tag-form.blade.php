@section('title', $tag?->exists ? 'Editar Tag' : 'Nuevo Tag')
<div>
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-white">{{ $tag?->exists ? 'Editar tag' : 'Nuevo tag' }}</h2>
        <a href="{{ route('admin.tags.index') }}" class="px-4 py-2 bg-surface-card hover:bg-surface-hover rounded-lg text-sm font-medium transition text-gray-300">← Volver</a>
    </div>

    <form wire:submit="save" class="space-y-6 max-w-lg">
        <div class="card p-6 space-y-4">
            <div>
                <x-input-label for="name" value="Nombre" />
                <x-text-input wire:model="name" id="name" class="w-full mt-1" placeholder="ej: Laravel, PHP, Docker" />
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
                    <p class="mt-1 text-sm text-gray-500 font-mono">#{{ $slug ?: Str::slug($name) }}</p>
                @endif
                <x-input-error :messages="$errors->get('slug')" class="mt-1" />
            </div>
        </div>

        <div class="flex gap-4">
            <x-primary-button>{{ $tag?->exists ? 'Actualizar' : 'Crear tag' }}</x-primary-button>
            <a href="{{ route('admin.tags.index') }}" class="px-4 py-2 bg-surface-card hover:bg-surface-hover rounded-lg text-sm font-medium transition text-gray-300">Cancelar</a>
        </div>
    </form>
</div>
