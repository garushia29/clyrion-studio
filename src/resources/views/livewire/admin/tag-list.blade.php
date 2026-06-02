<div>
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-white">Tags</h2>
        <a href="{{ route('admin.tags.create') }}" class="px-4 py-2 bg-brand-600 hover:bg-brand-700 rounded-lg text-sm font-medium transition">Nuevo tag</a>
    </div>

    <div class="flex gap-4 mb-6">
        <x-text-input wire:model.live="search" placeholder="Buscar tags..." class="w-64" />
    </div>

    <div class="flex flex-wrap gap-2">
        @forelse ($tags as $tag)
            <div class="flex items-center gap-2 px-3 py-1.5 rounded-lg border border-surface-border hover:bg-surface-hover transition group">
                <span class="text-sm text-gray-300">#{{ $tag->name }}</span>
                <span class="text-xs text-gray-600">{{ $tag->posts_count }} posts</span>
                <a href="{{ route('admin.tags.edit', $tag) }}" class="text-brand-400 hover:text-brand-300 text-xs ml-1 opacity-0 group-hover:opacity-100 transition">Editar</a>
                <button wire:click="delete({{ $tag->id }})" wire:confirm="¿Eliminar este tag?" class="text-red-400 hover:text-red-300 text-xs opacity-0 group-hover:opacity-100 transition">×</button>
            </div>
        @empty
            <p class="text-sm text-gray-500 text-center w-full py-4">No hay tags aún</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $tags->links() }}
    </div>
</div>
