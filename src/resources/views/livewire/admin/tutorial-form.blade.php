<div>
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-white">{{ $tutorial?->exists ? 'Editar tutorial' : 'Nuevo tutorial' }}</h2>
        <a href="{{ route('admin.tutorials.index') }}" class="px-4 py-2 bg-surface-card hover:bg-surface-hover rounded-lg text-sm font-medium transition text-gray-300">← Volver</a>
    </div>

    <form wire:submit="save" class="space-y-6 max-w-4xl">
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
                <x-input-label for="excerpt" value="Extracto" />
                <textarea wire:model="excerpt" id="excerpt" rows="2" class="w-full mt-1 border-surface-input bg-surface-card text-gray-200 focus:border-brand-500 focus:ring-brand-500 rounded-md shadow-sm text-sm"></textarea>
                <x-input-error :messages="$errors->get('excerpt')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="content" value="Contenido" />
                <x-trix-editor wire:model="content" id="content" placeholder="Escribe el contenido del tutorial aquí..." />
                <x-input-error :messages="$errors->get('content')" class="mt-1" />
            </div>
        </div>

        <div class="card p-6 space-y-4">
            <h3 class="text-lg font-semibold text-white">Configuración</h3>
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
                    <x-input-label for="duration_minutes" value="Duración (minutos)" />
                    <x-text-input wire:model="duration_minutes" id="duration_minutes" type="number" class="w-full mt-1" />
                    <x-input-error :messages="$errors->get('duration_minutes')" class="mt-1" />
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="series_id" value="Serie" />
                    <select wire:model="series_id" id="series_id" class="w-full mt-1 border-surface-input bg-surface-card text-gray-200 focus:border-brand-500 focus:ring-brand-500 rounded-md shadow-sm text-sm">
                        <option value="">— Sin serie —</option>
                        @foreach ($seriesList as $s)
                            <option value="{{ $s->id }}">{{ $s->title }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('series_id')" class="mt-1" />
                </div>
                <div>
                    <x-input-label for="order_in_series" value="Orden en la serie" />
                    <x-text-input wire:model="order_in_series" id="order_in_series" type="number" class="w-full mt-1" />
                    <x-input-error :messages="$errors->get('order_in_series')" class="mt-1" />
                </div>
            </div>

            <div>
                <x-input-label for="prerequisites" value="Prerrequisitos" />
                <x-text-input wire:model="prerequisites" id="prerequisites" class="w-full mt-1" placeholder="ej: Conocimientos básicos de PHP, Laravel instalado" />
                <x-input-error :messages="$errors->get('prerequisites')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="tags" value="Tags" />
                <div class="flex flex-wrap gap-2 mt-1">
                    @foreach ($tags as $tag)
                        <label class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border text-sm cursor-pointer transition
                            {{ in_array((string) $tag->id, $selectedTags) ? 'border-brand-500 bg-brand-500/10 text-brand-400' : 'border-surface-border text-gray-400 hover:border-gray-500' }}">
                            <input type="checkbox" value="{{ $tag->id }}" wire:model="selectedTags" class="hidden">
                            #{{ $tag->name }}
                        </label>
                    @endforeach
                </div>
                <x-input-error :messages="$errors->get('selectedTags')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="status" value="Estado" />
                <select wire:model="status" id="status" class="w-full mt-1 border-surface-input bg-surface-card text-gray-200 focus:border-brand-500 focus:ring-brand-500 rounded-md shadow-sm text-sm">
                    <option value="draft">Borrador</option>
                    <option value="published">Publicado</option>
                </select>
                <x-input-error :messages="$errors->get('status')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="thumbnail" value="URL thumbnail" />
                <x-text-input wire:model="thumbnail" id="thumbnail" class="w-full mt-1" placeholder="https://..." />
                <x-input-error :messages="$errors->get('thumbnail')" class="mt-1" />
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
            <x-primary-button>{{ $tutorial?->exists ? 'Actualizar' : 'Crear tutorial' }}</x-primary-button>
            <a href="{{ route('admin.tutorials.index') }}" class="px-4 py-2 bg-surface-card hover:bg-surface-hover rounded-lg text-sm font-medium transition text-gray-300">Cancelar</a>
        </div>
    </form>
</div>
