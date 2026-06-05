<div>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Notificaciones</h1>
            <p class="text-sm text-gray-400 mt-1">Historial de notificaciones</p>
        </div>
        <div class="flex gap-2">
            <button wire:click="markAllAsRead" class="px-4 py-2 text-sm text-brand-400 hover:text-brand-300 transition">Marcar todas como leídas</button>
        </div>
    </div>

    <div class="flex gap-2 mb-6">
        @foreach (['all' => 'Todas', 'unread' => 'Sin leer', 'read' => 'Leídas'] as $key => $label)
            <button wire:click="$set('filter', '{{ $key }}')" class="px-4 py-2 rounded-lg text-sm font-medium transition {{ $filter === $key ? 'bg-brand-500/10 text-brand-400' : 'text-gray-400 hover:text-white hover:bg-surface-hover' }}">
                {{ $label }}
            </button>
        @endforeach
    </div>

    <x-card padding="false">
        <x-slot:title>
            {{ $filter === 'unread' ? 'No leídas' : ($filter === 'read' ? 'Leídas' : 'Todas') }}
        </x-slot:title>

        @forelse ($notifications as $notification)
            <div class="flex items-start gap-4 px-6 py-4 hover:bg-surface-hover/50 transition border-b border-surface-border/50 group {{ $notification->read_at ? '' : 'bg-brand-500/[0.02]' }}">
                <div class="w-2 h-2 rounded-full mt-1.5 shrink-0 {{ $notification->read_at ? 'bg-gray-600' : 'bg-brand-500' }}"></div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-4">
@section('title', 'Notificaciones')
<div>
                            <p class="text-sm text-white {{ $notification->read_at ? '' : 'font-medium' }}">{{ $notification->data['message'] ?? 'Notificación' }}</p>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-xs text-gray-500">{{ $notification->created_at->format('d/m/Y H:i') }}</span>
                                @if($modelType = $notification->data['model_type'] ?? null)
                                    <span class="text-xs px-1.5 py-0.5 rounded bg-surface-hover text-gray-400">{{ $modelType }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center gap-1 shrink-0">
                            @if($url = $notification->data['url'] ?? null)
                                <a href="{{ $url }}" wire:navigate class="p-1.5 text-gray-500 hover:text-brand-400 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                </a>
                            @endif
                            @unless($notification->read_at)
                                <button wire:click="markAsRead('{{ $notification->id }}')" class="p-1.5 text-gray-500 hover:text-green-400 transition" title="Marcar como leída">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </button>
                            @endunless
                            <button wire:click="deleteNotification('{{ $notification->id }}')" wire:confirm="¿Eliminar esta notificación?" class="p-1.5 text-gray-500 hover:text-red-400 transition opacity-0 group-hover:opacity-100" title="Eliminar">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="py-12 text-center text-gray-500">
                <svg class="w-12 h-12 mx-auto mb-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                <p>No hay notificaciones</p>
            </div>
        @endforelse

        <x-slot:footer>
            {{ $notifications->links(data: ['scrollTo' => false]) }}
        </x-slot:footer>
    </x-card>
</div>
