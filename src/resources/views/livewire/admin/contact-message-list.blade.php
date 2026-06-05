<div>
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-white">Mensajes de contacto</h2>
    </div>

    <div class="flex gap-4 mb-6">
        <x-text-input wire:model.live="search" placeholder="Buscar mensajes..." class="w-64" />
        <select wire:model.live="filter" class="border-surface-input bg-surface-card text-gray-200 focus:border-brand-500 focus:ring-brand-500 rounded-md shadow-sm text-sm">
            <option value="">Todos</option>
            <option value="unread">No leídos</option>
            <option value="read">Leídos</option>
        </select>
    </div>

    <x-table :headers="['Nombre', 'Email', 'Mensaje', 'Estado', 'Fecha', '']">
        @forelse ($messages as $message)
            <tr class="hover:bg-surface-hover transition {{ !$message->read ? 'bg-brand-500/5' : '' }}">
                <td class="py-3 px-4 text-white font-medium">{{ $message->name }}</td>
                <td class="py-3 px-4 text-gray-400">
                    <a href="mailto:{{ $message->email }}" class="hover:text-brand-400 transition">{{ $message->email }}</a>
                </td>
                <td class="py-3 px-4 text-gray-400 max-w-xs truncate">{{ $message->message }}</td>
                <td class="py-3 px-4">
                    <x-badge :variant="$message->read ? 'neutral' : 'brand'">{{ $message->read ? 'Leído' : 'Nuevo' }}</x-badge>
                </td>
                <td class="py-3 px-4 text-gray-400 text-sm">{{ $message->created_at->diffForHumans() }}</td>
                <td class="py-3 px-4 text-right whitespace-nowrap">
                    @if (!$message->read)
                        <button wire:click="markAsRead({{ $message->id }})" class="text-brand-400 hover:text-brand-300 transition text-sm mr-2">Marcar leído</button>
                    @else
                        <button wire:click="markAsUnread({{ $message->id }})" class="text-gray-400 hover:text-white transition text-sm mr-2">No leído</button>
                    @endif
                    <button wire:click="delete({{ $message->id }})" wire:confirm="¿Eliminar este mensaje?" class="text-red-400 hover:text-red-300 transition text-sm">Eliminar</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="py-12 text-center text-gray-500">No hay mensajes</td>
            </tr>
        @endforelse
    </x-table>

    <div class="mt-6">
        {{ $messages->links() }}
    </div>
</div>
