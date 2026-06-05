@section('title', 'Tags')
<div>
    <div class="flex flex-wrap items-center justify-between gap-2 mb-6">
        <h2 class="text-2xl font-bold text-white">Tags</h2>
        <x-button variant="primary" href="{{ route('admin.tags.create') }}">Nuevo tag</x-button>
    </div>

    <div class="flex gap-4 mb-6">
        <x-text-input wire:model.live="search" placeholder="Buscar tags..." class="w-full sm:w-64" />
    </div>

    <x-card>
        @forelse ($tags as $tag)
            <div class="flex items-center gap-2 px-3 py-1.5 rounded-lg border border-surface-border hover:bg-surface-hover transition group">
                <span class="text-sm text-gray-300">#{{ $tag->name }}</span>
                <x-badge variant="neutral">{{ $tag->posts_count }} posts</x-badge>
                <a href="{{ route('admin.tags.edit', $tag) }}" class="text-brand-400 hover:text-brand-300 text-xs ml-1 opacity-0 group-hover:opacity-100 transition">Editar</a>
                <button wire:click="delete({{ $tag->id }})" wire:confirm="¿Eliminar este tag?" class="text-red-400 hover:text-red-300 text-xs opacity-0 group-hover:opacity-100 transition">×</button>
            </div>
        @empty
            <x-empty-state title="No hay tags aún" />
        @endforelse
    </x-card>

    <div class="mt-6">
        {{ $tags->links() }}
    </div>
</div>

