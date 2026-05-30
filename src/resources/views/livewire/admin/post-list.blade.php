<div>
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-white">Blog Posts</h2>
        <a href="{{ route('admin.posts.create') }}" class="px-4 py-2 bg-brand-600 hover:bg-brand-700 rounded-lg text-sm font-medium transition">Nuevo post</a>
    </div>

    <div class="flex gap-4 mb-6">
        <x-text-input wire:model.live="search" placeholder="Buscar posts..." class="w-64" />
        <select wire:model.live="status" class="border-surface-input bg-surface-card text-gray-200 focus:border-brand-500 focus:ring-brand-500 rounded-md shadow-sm text-sm">
            <option value="">Todos</option>
            <option value="published">Publicados</option>
            <option value="draft">Borradores</option>
        </select>
    </div>

    <div class="card overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-surface-card border-b border-surface-border">
                <tr>
                    <th class="text-left py-3 px-4 text-gray-400 font-medium">Título</th>
                    <th class="text-left py-3 px-4 text-gray-400 font-medium">Categoría</th>
                    <th class="text-left py-3 px-4 text-gray-400 font-medium">Estado</th>
                    <th class="text-left py-3 px-4 text-gray-400 font-medium">Fecha</th>
                    <th class="text-right py-3 px-4 text-gray-400 font-medium">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-border">
                @forelse ($posts as $post)
                    <tr class="hover:bg-surface-hover transition">
                        <td class="py-3 px-4 text-white">{{ $post->title }}</td>
                        <td class="py-3 px-4 text-gray-400">{{ $post->category ?: '—' }}</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-0.5 text-xs rounded-full {{ $post->status === 'published' ? 'bg-green-500/10 text-green-400' : 'bg-yellow-500/10 text-yellow-400' }}">
                                {{ $post->status }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-gray-400">{{ $post->published_at?->format('d/m/Y') ?: '—' }}</td>
                        <td class="py-3 px-4 text-right">
                            <a href="{{ route('admin.posts.edit', $post) }}" class="text-brand-400 hover:text-brand-300 transition text-sm mr-3">Editar</a>
                            <button wire:click="delete({{ $post->id }})" wire:confirm="¿Eliminar este post?" class="text-red-400 hover:text-red-300 transition text-sm">Eliminar</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center text-gray-500">No hay posts aún</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $posts->links() }}
    </div>
</div>
