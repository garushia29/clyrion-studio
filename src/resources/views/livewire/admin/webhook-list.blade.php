@section('title', 'Webhooks')
<div>
    <x-card>
        <x-slot:header>
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-white">Webhooks</h2>
                <x-button variant="primary" wire:click="create">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Nuevo Webhook
                </x-button>
            </div>
        </x-slot:header>

        {{-- Form --}}
        @if ($showForm)
            <form wire:submit="save" class="mb-6 p-4 bg-surface-alt rounded-lg border border-surface-border space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Nombre</label>
                        <input type="text" wire:model="name" class="w-full rounded-lg border-surface-border bg-surface-card text-white px-3 py-2 text-sm focus:ring-brand-500 focus:border-brand-500" placeholder="Ej: Notificar Slack">
                        @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">URL</label>
                        <input type="url" wire:model="url" class="w-full rounded-lg border-surface-border bg-surface-card text-white px-3 py-2 text-sm focus:ring-brand-500 focus:border-brand-500" placeholder="https://hooks.slack.com/...">
                        @error('url') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Eventos (separados por coma, vacío = todos)</label>
                        <input type="text" wire:model="events" class="w-full rounded-lg border-surface-border bg-surface-card text-white px-3 py-2 text-sm focus:ring-brand-500 focus:border-brand-500" placeholder="post.created, project.updated">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Secreto (opcional)</label>
                        <input type="text" wire:model="secret" class="w-full rounded-lg border-surface-border bg-surface-card text-white px-3 py-2 text-sm focus:ring-brand-500 focus:border-brand-500" placeholder="Firma HMAC">
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" wire:model="is_active" id="is_active" class="rounded border-surface-border bg-surface-card text-brand-500 focus:ring-brand-500">
                    <label for="is_active" class="text-sm text-gray-300">Activo</label>
                </div>
                <div class="flex items-center gap-2">
                    <x-button variant="primary" type="submit">{{ $editingWebhook ? 'Actualizar' : 'Crear' }}</x-button>
                    <x-button variant="secondary" wire:click="resetForm">Cancelar</x-button>
                </div>
            </form>
        @endif

        {{-- Table --}}
        <x-table :columns="['Nombre', 'URL', 'Eventos', 'Llamadas', 'Estado', 'Acciones']">
            <x-slot:body>
                @forelse ($webhooks as $webhook)
                    <tr class="border-b border-surface-border hover:bg-surface-hover/50">
                        <td class="px-4 py-3 text-sm text-white">{{ $webhook->name }}</td>
                        <td class="px-4 py-3 text-sm text-gray-400 max-w-xs truncate">{{ $webhook->url }}</td>
                        <td class="px-4 py-3 text-sm text-gray-400">{{ $webhook->events ?? 'Todos' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-400">{{ $webhook->calls_count }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $webhook->is_active ? 'bg-green-500/10 text-green-400' : 'bg-gray-500/10 text-gray-400' }}">
                                {{ $webhook->is_active ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <button wire:click="edit({{ $webhook->id }})" class="p-1 text-gray-500 hover:text-white transition" title="Editar">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </button>
                                <button wire:click="toggleActive({{ $webhook->id }})" class="p-1 text-gray-500 hover:text-white transition" title="{{ $webhook->is_active ? 'Desactivar' : 'Activar' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                </button>
                                <button wire:click="delete({{ $webhook->id }})" wire:confirm="¿Eliminar este webhook?" class="p-1 text-gray-500 hover:text-red-400 transition" title="Eliminar">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8">
                            <x-empty-state icon="webhook" title="Sin webhooks" message="Crea tu primer webhook para recibir notificaciones de eventos." />
                        </td>
                    </tr>
                @endforelse
            </x-slot:body>
        </x-table>

        <div class="mt-4">
            {{ $webhooks->links() }}
        </div>
    </x-card>
</div>
