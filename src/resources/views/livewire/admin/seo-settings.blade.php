{{-- Panel de administración: configuración SEO centralizada por ruta --}}
{{-- Permite gestionar meta tags (title, description, image, type) para cada página pública --}}

@section('title', 'Configuración SEO')

<div>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Configuración SEO</h1>
            <p class="text-sm text-gray-400 mt-1">Gestiona los meta tags de cada página del sitio</p>
        </div>
        @if (!$showForm)
            <button wire:click="create" class="px-4 py-2 bg-brand-600 hover:bg-brand-700 rounded-lg text-sm font-medium transition">
                + Nueva configuración
            </button>
        @endif
    </div>

    {{-- Formulario --}}
    @if ($showForm)
        <form wire:submit="save" class="max-w-2xl mb-8">
            <div class="bg-surface-card rounded-xl border border-surface-border p-6 space-y-5">
                <h2 class="text-lg font-semibold text-white">{{ $editing?->exists ? 'Editar' : 'Nueva' }} configuración SEO</h2>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Ruta</label>
                    <select wire:model="page_route"
                            class="w-full bg-surface border border-surface-border rounded-lg px-4 py-2.5 text-sm text-gray-200 focus:outline-none focus:border-brand-500">
                        <option value="">Seleccionar ruta...</option>
                        @foreach ($availableRoutes as $route => $label)
                            <option value="{{ $route }}">{{ $label }} ({{ $route }})</option>
                        @endforeach
                    </select>
                    @error('page_route') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Title</label>
                    <input type="text" wire:model="title"
                           class="w-full bg-surface border border-surface-border rounded-lg px-4 py-2.5 text-sm text-gray-200 placeholder-gray-500 focus:outline-none focus:border-brand-500">
                    @error('title') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Description</label>
                    <textarea wire:model="description" rows="3"
                              class="w-full bg-surface border border-surface-border rounded-lg px-4 py-2.5 text-sm text-gray-200 placeholder-gray-500 focus:outline-none focus:border-brand-500"></textarea>
                    @error('description') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Imagen OG</label>
                        <input type="text" wire:model="image" placeholder="/images/og-default.png"
                               class="w-full bg-surface border border-surface-border rounded-lg px-4 py-2.5 text-sm text-gray-200 placeholder-gray-500 focus:outline-none focus:border-brand-500">
                        @error('image') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Tipo OG</label>
                        <select wire:model="type"
                                class="w-full bg-surface border border-surface-border rounded-lg px-4 py-2.5 text-sm text-gray-200 focus:outline-none focus:border-brand-500">
                            <option value="website">Website</option>
                            <option value="article">Article</option>
                            <option value="profile">Profile</option>
                        </select>
                        @error('type') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <input type="checkbox" wire:model="is_active" id="is_active"
                           class="rounded bg-surface border-surface-border text-brand-600 focus:ring-brand-500">
                    <label for="is_active" class="text-sm text-gray-300">Activo</label>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 mt-4">
                <button type="button" wire:click="cancel"
                        class="px-4 py-2 text-sm text-gray-400 hover:text-white transition">
                    Cancelar
                </button>
                <button type="submit"
                        class="px-6 py-2 bg-brand-600 hover:bg-brand-700 rounded-lg text-sm font-medium transition">
                    {{ $editing?->exists ? 'Actualizar' : 'Crear' }}
                </button>
            </div>
        </form>
    @endif

    {{-- Listado --}}
    <div class="bg-surface-card rounded-xl border border-surface-border overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-surface-border">
                    <th class="text-left px-4 py-3 text-gray-400 font-medium">Ruta</th>
                    <th class="text-left px-4 py-3 text-gray-400 font-medium">Title</th>
                    <th class="text-left px-4 py-3 text-gray-400 font-medium hidden md:table-cell">Description</th>
                    <th class="text-center px-4 py-3 text-gray-400 font-medium">Activo</th>
                    <th class="text-right px-4 py-3 text-gray-400 font-medium">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($settings as $seo)
                    <tr class="border-b border-surface-border hover:bg-surface-hover transition">
                        <td class="px-4 py-3 text-gray-200">{{ $seo->page_route }}</td>
                        <td class="px-4 py-3 text-gray-200 max-w-xs truncate">{{ $seo->title }}</td>
                        <td class="px-4 py-3 text-gray-400 max-w-sm truncate hidden md:table-cell">{{ $seo->description }}</td>
                        <td class="px-4 py-3 text-center">
                            <button wire:click="toggleActive({{ $seo->id }})"
                                    class="inline-flex items-center gap-1 text-xs px-2 py-1 rounded-full transition
                                    {{ $seo->is_active ? 'text-green-400 bg-green-500/10' : 'text-gray-500 bg-gray-500/10' }}">
                                {{ $seo->is_active ? 'Sí' : 'No' }}
                            </button>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button wire:click="edit({{ $seo->id }})"
                                        class="text-xs text-gray-400 hover:text-white transition">
                                    Editar
                                </button>
                                <button wire:click="delete({{ $seo->id }})"
                                        wire:confirm="¿Eliminar esta configuración SEO?"
                                        class="text-xs text-red-400 hover:text-red-300 transition">
                                    Eliminar
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                            No hay configuraciones SEO. Crea la primera.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
