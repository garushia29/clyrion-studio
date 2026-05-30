<div>
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-white">{{ $post?->exists ? 'Editar post' : 'Nuevo post' }}</h2>
        <a href="{{ route('admin.posts.index') }}" class="px-4 py-2 bg-surface-card hover:bg-surface-hover rounded-lg text-sm font-medium transition text-gray-300">← Volver</a>
    </div>

    <form wire:submit="save" class="space-y-6 max-w-3xl">
        <div class="card p-6 space-y-4">
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

            <div>
                <x-input-label for="excerpt" value="Extracto" />
                <textarea wire:model="excerpt" id="excerpt" rows="3" class="w-full mt-1 border-surface-input bg-surface-card text-gray-200 focus:border-brand-500 focus:ring-brand-500 rounded-md shadow-sm text-sm"></textarea>
                <x-input-error :messages="$errors->get('excerpt')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="content" value="Contenido" />
                <textarea wire:model="content" id="content" rows="15" class="w-full mt-1 border-surface-input bg-surface-card text-gray-200 focus:border-brand-500 focus:ring-brand-500 rounded-md shadow-sm text-sm font-mono"></textarea>
                <x-input-error :messages="$errors->get('content')" class="mt-1" />
            </div>

            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="category" value="Categoría" />
                    <x-text-input wire:model="category" id="category" class="w-full mt-1" />
                    <x-input-error :messages="$errors->get('category')" class="mt-1" />
                </div>
                <div>
                    <x-input-label for="tags" value="Tags (separados por coma)" />
                    <x-text-input wire:model="tags" id="tags" class="w-full mt-1" />
                    <x-input-error :messages="$errors->get('tags')" class="mt-1" />
                </div>
            </div>

            <div>
                <x-input-label for="status" value="Estado" />
                <select wire:model="status" id="status" class="w-full mt-1 border-surface-input bg-surface-card text-gray-200 focus:border-brand-500 focus:ring-brand-500 rounded-md shadow-sm text-sm">
                    <option value="draft">Borrador</option>
                    <option value="published">Publicado</option>
                </select>
                <x-input-error :messages="$errors->get('status')" class="mt-1" />
            </div>
        </div>

        <div class="card p-6 space-y-4">
            <h3 class="text-lg font-semibold text-white">SEO</h3>
            <div>
                <x-input-label for="meta_title" value="Meta título" />
                <x-text-input wire:model="meta_title" id="meta_title" class="w-full mt-1" />
                <x-input-error :messages="$errors->get('meta_title')" class="mt-1" />
            </div>
            <div>
                <x-input-label for="meta_description" value="Meta descripción" />
                <textarea wire:model="meta_description" id="meta_description" rows="2" class="w-full mt-1 border-surface-input bg-surface-card text-gray-200 focus:border-brand-500 focus:ring-brand-500 rounded-md shadow-sm text-sm"></textarea>
                <x-input-error :messages="$errors->get('meta_description')" class="mt-1" />
            </div>
            <div>
                <x-input-label for="featured_image" value="URL imagen destacada" />
                <x-text-input wire:model="featured_image" id="featured_image" class="w-full mt-1" placeholder="https://..." />
                <x-input-error :messages="$errors->get('featured_image')" class="mt-1" />
            </div>
        </div>

        <div class="flex gap-4">
            <x-primary-button>{{ $post?->exists ? 'Actualizar' : 'Crear post' }}</x-primary-button>
            <a href="{{ route('admin.posts.index') }}" class="px-4 py-2 bg-surface-card hover:bg-surface-hover rounded-lg text-sm font-medium transition text-gray-300">Cancelar</a>
        </div>
    </form>

    @if (session('message'))
        <div class="fixed bottom-6 right-6 px-6 py-3 bg-green-600 text-white rounded-lg shadow-lg text-sm">
            {{ session('message') }}
        </div>
    @endif
</div>
