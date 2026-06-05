<div>
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-white">Blog Posts</h2>
        <x-button variant="primary" href="{{ route('admin.posts.create') }}">Nuevo post</x-button>
    </div>

    <div class="flex gap-4 mb-6">
        <x-text-input wire:model.live="search" placeholder="Buscar posts..." class="w-64" />
        <select wire:model.live="status" class="border-surface-input bg-surface-card text-gray-200 focus:border-brand-500 focus:ring-brand-500 rounded-md shadow-sm text-sm">
            <option value="">Todos</option>
            <option value="published">Publicados</option>
            <option value="draft">Borradores</option>
        </select>
    </div>

    <x-table :headers="['Título', 'Categoría', 'Estado', 'Fecha', '']">
        @forelse ($posts as $post)
            <tr class="hover:bg-surface-hover transition">
                <td class="py-3 px-4 text-white">{{ $post->title }}</td>
                <td class="py-3 px-4 text-gray-400">{{ $post->category ?: '—' }}</td>
                <td class="py-3 px-4">
                    <x-badge :variant="$post->status === 'published' ? 'success' : 'warning'">{{ $post->status }}</x-badge>
                </td>
                <td class="py-3 px-4 text-gray-400">{{ $post->published_at?->format('d/m/Y') ?: '—' }}</td>
                <td class="py-3 px-4 text-right whitespace-nowrap">
                    <x-button variant="ghost" size="sm" href="{{ route('admin.posts.edit', $post) }}">Editar</x-button>
                    <button wire:click="delete({{ $post->id }})" wire:confirm="¿Eliminar este post?" class="text-red-400 hover:text-red-300 transition text-sm">Eliminar</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="py-12 text-center text-gray-500">No hay posts aún</td>
            </tr>
        @endforelse
    </x-table>

    <div class="mt-6">
        {{ $posts->links() }}
    </div>
</div>
