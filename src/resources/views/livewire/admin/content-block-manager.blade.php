<div>
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-white">Bloques de contenido</h2>
        <button wire:click="create" class="px-4 py-2 bg-brand-600 hover:bg-brand-700 rounded-lg text-sm font-medium transition">Nuevo bloque</button>
    </div>

    @if ($showForm)
        <div class="card p-6 mb-6 border-brand-500/30">
            <h3 class="text-lg font-semibold text-white mb-4">{{ $editing?->exists ? 'Editar bloque' : 'Nuevo bloque' }}</h3>
            <form wire:submit="save" class="space-y-4">
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="key" value="Key (identificador único)" />
                        <x-text-input wire:model="key" id="key" class="w-full mt-1 font-mono text-sm" placeholder="ej: hero_title, services_intro" />
                        <x-input-error :messages="$errors->get('key')" class="mt-1" />
                    </div>
                    <div>
                        <x-input-label for="label" value="Label descriptivo" />
                        <x-text-input wire:model="label" id="label" class="w-full mt-1" placeholder="ej: Título del Hero" />
                        <x-input-error :messages="$errors->get('label')" class="mt-1" />
                    </div>
                </div>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="type" value="Tipo" />
                        <select wire:model="type" id="type" class="w-full mt-1 border-surface-input bg-surface-card text-gray-200 focus:border-brand-500 focus:ring-brand-500 rounded-md shadow-sm text-sm">
                            <option value="text">Texto</option>
                            <option value="html">HTML</option>
                            <option value="image">Imagen</option>
                            <option value="gallery">Galería</option>
                            <option value="json">JSON</option>
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="mt-1" />
                    </div>
                    <div>
                        <x-input-label for="sort_order" value="Orden" />
                        <x-text-input wire:model="sort_order" id="sort_order" type="number" class="w-full mt-1" />
                        <x-input-error :messages="$errors->get('sort_order')" class="mt-1" />
                    </div>
                </div>

                <div>
                    <x-input-label for="content" value="Contenido" />
                    @if ($type === 'html')
                        <x-trix-editor wire:model="content" id="content" />
                    @else
                        <textarea wire:model="content" id="content" rows="4" class="w-full mt-1 border-surface-input bg-surface-card text-gray-200 focus:border-brand-500 focus:ring-brand-500 rounded-md shadow-sm text-sm font-mono"></textarea>
                    @endif
                    <x-input-error :messages="$errors->get('content')" class="mt-1" />
                </div>

                <div class="flex items-center gap-3">
                    <input type="checkbox" wire:model="is_active" id="is_active" class="rounded border-surface-input bg-surface-card text-brand-500 focus:ring-brand-500">
                    <x-input-label for="is_active" value="Activo" />
                </div>

                <div class="flex gap-4 pt-2">
                    <x-primary-button>{{ $editing?->exists ? 'Actualizar' : 'Crear bloque' }}</x-primary-button>
                    <button type="button" wire:click="cancel" class="px-4 py-2 bg-surface-card hover:bg-surface-hover rounded-lg text-sm font-medium transition text-gray-300">Cancelar</button>
                </div>
            </form>
        </div>
    @endif

    <div class="space-y-3">
        @forelse ($blocks as $block)
            <div class="card p-4 flex items-center justify-between hover:bg-surface-hover transition group">
                <div class="flex items-center gap-4 min-w-0 flex-1">
                    <span class="w-8 h-8 rounded-lg {{ $block->is_active ? 'bg-brand-500/10 text-brand-400' : 'bg-gray-500/10 text-gray-500' }} flex items-center justify-center text-xs font-mono">{{ $block->sort_order }}</span>
                    <div class="min-w-0">
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-medium text-white">{{ $block->label }}</span>
                            <span class="text-xs px-1.5 py-0.5 rounded bg-surface-border text-gray-500 font-mono">{{ $block->key }}</span>
                            <span class="text-xs text-gray-600">({{ $block->type }})</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-0.5 truncate">{{ is_array($block->content) ? json_encode($block->content) : $block->content }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-2 shrink-0 ml-4">
                    <button wire:click="toggleActive({{ $block->id }})" class="text-xs {{ $block->is_active ? 'text-green-400' : 'text-gray-600' }} hover:text-white transition" title="{{ $block->is_active ? 'Desactivar' : 'Activar' }}">
                        {{ $block->is_active ? 'Activo' : 'Inactivo' }}
                    </button>
                    <button wire:click="edit({{ $block->id }})" class="text-brand-400 hover:text-brand-300 text-sm transition">Editar</button>
                    <button wire:click="delete({{ $block->id }})" wire:confirm="¿Eliminar este bloque de contenido?" class="text-red-400 hover:text-red-300 text-sm transition">Eliminar</button>
                </div>
            </div>
        @empty
            <div class="card p-12 text-center">
                <p class="text-gray-500">No hay bloques de contenido aún.</p>
                <p class="text-gray-600 text-sm mt-1">Crea bloques para gestionar el contenido del homepage desde el admin.</p>
            </div>
        @endforelse
    </div>
</div>
