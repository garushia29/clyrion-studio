<div>
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-white">Mediateca</h2>
    </div>

    <div class="card p-6 mb-8">
        <form wire:submit="uploadFile" class="space-y-4">
            <div class="border-2 border-dashed border-surface-border rounded-xl p-8 text-center hover:border-brand-500/50 transition cursor-pointer" x-data="{ dragging: false }" x-on:dragover.prevent="dragging = true" x-on:dragleave.prevent="dragging = false" x-on:drop.prevent="dragging = false; if ($event.dataTransfer?.files?.length) $wire.$upload('upload', $event.dataTransfer.files[0], () => $wire.uploadFile())">
                <div x-show="!dragging">
                    <svg class="w-12 h-12 mx-auto text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                    <p class="text-gray-400 text-sm">Arrastra un archivo aquí o</p>
                    <label class="inline-block mt-2 px-4 py-2 bg-brand-600 hover:bg-brand-700 rounded-lg text-sm font-medium cursor-pointer transition">
                        Seleccionar archivo
                        <input type="file" x-on:change="if ($event.target.files.length) $wire.$upload('upload', $event.target.files[0], () => $wire.uploadFile())" class="hidden" accept="image/*,.pdf,.doc,.docx">
                    </label>
                    <p class="text-gray-500 text-xs mt-2">JPEG, PNG, GIF, WebP, SVG, PDF. Máx 10MB</p>
                </div>
                <div wire:loading wire:target="upload" class="text-brand-400">
                    <p class="text-sm">Subiendo...</p>
                </div>
            </div>
            @error('upload') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </form>
    </div>

    <div class="mb-6">
        <x-text-input wire:model.live="search" placeholder="Buscar archivos..." class="w-64" />
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
        @forelse ($mediaItems as $media)
            <div class="card overflow-hidden group relative">
                <div class="aspect-square bg-surface-card overflow-hidden">
                    @if (str_starts_with($media->mime_type, 'image/'))
                        <img src="{{ $media->url }}" alt="{{ $media->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-500">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="p-2">
                    <p class="text-xs text-white truncate">{{ $media->name }}</p>
                    <p class="text-xs text-gray-500">{{ $media->size_for_humans }}</p>
                </div>
                <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition flex items-center justify-center gap-2">
                    <button type="button" x-data @click="navigator.clipboard.writeText('{{ $media->url }}'); $el.textContent='Copiado!'" class="px-2 py-1 text-xs bg-white/20 hover:bg-white/30 rounded text-white transition">Copiar URL</button>
                    <button wire:click="delete({{ $media->id }})" wire:confirm="¿Eliminar este archivo?" class="px-2 py-1 text-xs bg-red-500/70 hover:bg-red-500 rounded text-white transition">Eliminar</button>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-20 text-gray-500">
                <p class="text-lg">No hay archivos aún</p>
                <p class="text-sm mt-2">Arrastra imágenes arriba para empezar.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $mediaItems->links() }}
    </div>

</div>
