<div>
    <x-card>
        <x-slot:header>
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-white">Llamadas de Webhook</h2>
                @if ($webhookId)
                    <a href="{{ route('admin.webhooks.index') }}" class="text-sm text-brand-400 hover:text-brand-300">Ver todas</a>
                @endif
            </div>
        </x-slot:header>

        <x-table :columns="['Webhook', 'Evento', 'URL', 'Estado', 'Código', 'Intentos', 'Fecha']">
            <x-slot:body>
                @forelse ($calls as $call)
                    <tr class="border-b border-surface-border hover:bg-surface-hover/50 cursor-pointer" wire:click="showDetail({{ $call->id }})">
                        <td class="px-4 py-3 text-sm text-white">{{ $call->webhook->name }}</td>
                        <td class="px-4 py-3 text-sm text-gray-400">{{ $call->event }}</td>
                        <td class="px-4 py-3 text-sm text-gray-400 max-w-xs truncate">{{ $call->url }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $call->success ? 'bg-green-500/10 text-green-400' : 'bg-red-500/10 text-red-400' }}">
                                {{ $call->success ? 'Éxito' : 'Falló' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-400">{{ $call->status_code ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-400">{{ $call->attempts }}</td>
                        <td class="px-4 py-3 text-sm text-gray-400">{{ $call->created_at->format('d/m/y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8">
                            <x-empty-state icon="webhook" title="Sin llamadas" message="No hay llamadas de webhook registradas." />
                        </td>
                    </tr>
                @endforelse
            </x-slot:body>
        </x-table>

        <div class="mt-4">
            {{ $calls->links() }}
        </div>
    </x-card>

    {{-- Detail modal --}}
    @if ($selectedCall)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/60" wire:click="closeDetail">
            <div class="bg-surface-card rounded-xl border border-surface-border p-6 max-w-2xl w-full mx-4 max-h-[80vh] overflow-y-auto" wire:click.stop>
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-white">Detalle de llamada</h3>
                    <button wire:click="closeDetail" class="p-1 text-gray-500 hover:text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-400">Webhook: <span class="text-white">{{ $selectedCall->webhook->name }}</span></p>
                        <p class="text-sm text-gray-400">Evento: <span class="text-white">{{ $selectedCall->event }}</span></p>
                        <p class="text-sm text-gray-400">URL: <span class="text-white break-all">{{ $selectedCall->url }}</span></p>
                        <p class="text-sm text-gray-400">Estado: <span class="{{ $selectedCall->success ? 'text-green-400' : 'text-red-400' }}">{{ $selectedCall->success ? 'Éxito' : 'Falló' }}</span></p>
                        <p class="text-sm text-gray-400">Código HTTP: <span class="text-white">{{ $selectedCall->status_code ?? '-' }}</span></p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-300 mb-2">Payload:</p>
                        <pre class="bg-surface-alt rounded-lg p-3 text-xs text-gray-300 overflow-x-auto">{{ json_encode($selectedCall->payload, JSON_PRETTY_PRINT) }}</pre>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-300 mb-2">Respuesta:</p>
                        <pre class="bg-surface-alt rounded-lg p-3 text-xs text-gray-300 overflow-x-auto">{{ json_encode($selectedCall->response, JSON_PRETTY_PRINT) }}</pre>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
