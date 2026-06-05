<div>
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-white">Categorías</h2>
        <x-button variant="primary" href="{{ route('admin.categories.create') }}">Nueva categoría</x-button>
    </div>

    <div class="flex gap-4 mb-6">
        <x-text-input wire:model.live="search" placeholder="Buscar categorías..." class="w-64" />
    </div>

    <x-table :headers="['Nombre', 'Slug', 'Posts', 'Creada', '']">
        @forelse ($categories as $category)
            <tr class="hover:bg-surface-hover transition">
                <td class="py-3 px-4">
                    <span class="text-white font-medium">{{ $category->name }}</span>
                    @if ($category->parent)
                        <span class="text-xs text-gray-500 ml-2">→ {{ $category->parent->name }}</span>
                    @endif
                </td>
                <td class="py-3 px-4 text-gray-400 font-mono text-xs">{{ $category->slug }}</td>
                <td class="py-3 px-4">
                    <x-badge variant="brand">{{ $category->posts_count }}</x-badge>
                </td>
                <td class="py-3 px-4 text-gray-400 text-xs">{{ $category->created_at->diffForHumans() }}</td>
                <td class="py-3 px-4 text-right whitespace-nowrap">
                    <x-button variant="ghost" size="sm" href="{{ route('admin.categories.edit', $category) }}">Editar</x-button>
                    <button wire:click="delete({{ $category->id }})" wire:confirm="¿Eliminar esta categoría?" class="text-red-400 hover:text-red-300 transition text-sm">Eliminar</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="py-12 text-center text-gray-500">No hay categorías aún</td>
            </tr>
        @endforelse
    </x-table>

    <div class="mt-6">
        {{ $categories->links() }}
    </div>
</div>
