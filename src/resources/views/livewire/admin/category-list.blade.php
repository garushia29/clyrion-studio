<div>
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-white">Categorías</h2>
        <a href="{{ route('admin.categories.create') }}" class="px-4 py-2 bg-brand-600 hover:bg-brand-700 rounded-lg text-sm font-medium transition">Nueva categoría</a>
    </div>

    <div class="flex gap-4 mb-6">
        <x-text-input wire:model.live="search" placeholder="Buscar categorías..." class="w-64" />
    </div>

    <div class="card overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-surface-card border-b border-surface-border">
                <tr>
                    <th class="text-left py-3 px-4 text-gray-400 font-medium">Nombre</th>
                    <th class="text-left py-3 px-4 text-gray-400 font-medium">Slug</th>
                    <th class="text-center py-3 px-4 text-gray-400 font-medium">Posts</th>
                    <th class="text-left py-3 px-4 text-gray-400 font-medium">Creada</th>
                    <th class="text-right py-3 px-4 text-gray-400 font-medium">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-border">
                @forelse ($categories as $category)
                    <tr class="hover:bg-surface-hover transition">
                        <td class="py-3 px-4">
                            <span class="text-white font-medium">{{ $category->name }}</span>
                            @if ($category->parent)
                                <span class="text-xs text-gray-500 ml-2">→ {{ $category->parent->name }}</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-gray-400 font-mono text-xs">{{ $category->slug }}</td>
                        <td class="py-3 px-4 text-center">
                            <span class="px-2 py-0.5 text-xs rounded-full bg-brand-500/10 text-brand-400">{{ $category->posts_count }}</span>
                        </td>
                        <td class="py-3 px-4 text-gray-400 text-xs">{{ $category->created_at->diffForHumans() }}</td>
                        <td class="py-3 px-4 text-right">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="text-brand-400 hover:text-brand-300 transition text-sm mr-3">Editar</a>
                            <button wire:click="delete({{ $category->id }})" wire:confirm="¿Eliminar esta categoría?" class="text-red-400 hover:text-red-300 transition text-sm">Eliminar</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center text-gray-500">No hay categorías aún</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $categories->links() }}
    </div>
</div>
