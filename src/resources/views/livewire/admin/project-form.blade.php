<div>
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-white">{{ $project?->exists ? 'Editar proyecto' : 'Nuevo proyecto' }}</h2>
        <a href="{{ route('admin.projects.index') }}" class="px-4 py-2 bg-surface-card hover:bg-surface-hover rounded-lg text-sm font-medium transition text-gray-300">← Volver</a>
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
                <x-input-label for="description" value="Descripción" />
                <textarea wire:model="description" id="description" rows="3" class="w-full mt-1 border-surface-input bg-surface-card text-gray-200 focus:border-brand-500 focus:ring-brand-500 rounded-md shadow-sm text-sm"></textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="content" value="Contenido" />
                <textarea wire:model="content" id="content" rows="15" class="w-full mt-1 border-surface-input bg-surface-card text-gray-200 focus:border-brand-500 focus:ring-brand-500 rounded-md shadow-sm text-sm font-mono"></textarea>
                <x-input-error :messages="$errors->get('content')" class="mt-1" />
            </div>

            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="technologies" value="Tecnologías (separadas por coma)" />
                    <x-text-input wire:model="technologies" id="technologies" class="w-full mt-1" placeholder="Laravel, React, PostgreSQL" />
                    <x-input-error :messages="$errors->get('technologies')" class="mt-1" />
                </div>
                <div>
                    <x-input-label for="year" value="Año" />
                    <x-text-input wire:model="year" id="year" type="number" class="w-full mt-1" />
                    <x-input-error :messages="$errors->get('year')" class="mt-1" />
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="url" value="URL del proyecto" />
                    <x-text-input wire:model="url" id="url" class="w-full mt-1" placeholder="https://..." />
                    <x-input-error :messages="$errors->get('url')" class="mt-1" />
                </div>
                <div>
                    <x-input-label for="github_url" value="URL de GitHub" />
                    <x-text-input wire:model="github_url" id="github_url" class="w-full mt-1" placeholder="https://github.com/..." />
                    <x-input-error :messages="$errors->get('github_url')" class="mt-1" />
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="status" value="Estado" />
                    <select wire:model="status" id="status" class="w-full mt-1 border-surface-input bg-surface-card text-gray-200 focus:border-brand-500 focus:ring-brand-500 rounded-md shadow-sm text-sm">
                        <option value="draft">Borrador</option>
                        <option value="published">Publicado</option>
                    </select>
                    <x-input-error :messages="$errors->get('status')" class="mt-1" />
                </div>
                <div>
                    <x-input-label for="sort_order" value="Orden" />
                    <x-text-input wire:model="sort_order" id="sort_order" type="number" class="w-full mt-1" />
                    <x-input-error :messages="$errors->get('sort_order')" class="mt-1" />
                </div>
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" wire:model="featured" id="featured" class="rounded border-surface-input bg-surface-card text-brand-500 focus:ring-brand-500">
                <x-input-label for="featured" value="Proyecto destacado" />
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
        </div>

        <div class="flex gap-4">
            <x-primary-button>{{ $project?->exists ? 'Actualizar' : 'Crear proyecto' }}</x-primary-button>
            <a href="{{ route('admin.projects.index') }}" class="px-4 py-2 bg-surface-card hover:bg-surface-hover rounded-lg text-sm font-medium transition text-gray-300">Cancelar</a>
        </div>
    </form>

    @if (session('message'))
        <div class="fixed bottom-6 right-6 px-6 py-3 bg-green-600 text-white rounded-lg shadow-lg text-sm">
            {{ session('message') }}
        </div>
    @endif
</div>
