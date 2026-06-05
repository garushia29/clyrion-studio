<div x-data="{ open: false }" class="relative" @click.outside="open = false">
    <button @click="open = !open" class="relative p-2 rounded-lg text-gray-400 hover:text-white hover:bg-surface-hover transition" title="Notificaciones">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
        </svg>
        @if($unreadCount > 0)
            <span class="absolute -top-0.5 -right-0.5 w-4.5 h-4.5 flex items-center justify-center bg-red-500 text-white text-[10px] font-bold rounded-full min-w-[18px] min-h-[18px]">{{ min($unreadCount, 99) }}</span>
        @endif
    </button>

    <div x-show="open" x-transition class="absolute right-0 mt-2 w-80 bg-surface-card border border-surface-border rounded-xl shadow-2xl z-50" style="display: none;">
        <div class="flex items-center justify-between px-4 py-3 border-b border-surface-border">
            <span class="text-sm font-semibold text-white">Notificaciones</span>
            @if($unreadCount > 0)
                <button wire:click="markAllAsRead" class="text-xs text-brand-400 hover:text-brand-300 transition">Marcar todas como leídas</button>
            @endif
        </div>

        <div class="max-h-80 overflow-y-auto scrollbar-thin">
            @forelse ($notifications as $notification)
                <div class="flex items-start gap-3 px-4 py-3 hover:bg-surface-hover transition border-b border-surface-border/50 group" wire:key="{{ $notification->id }}">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm text-white truncate">{{ $notification->data['message'] ?? 'Notificación' }}</p>
                        <p class="text-xs text-gray-500 mt-0.5">{{ $notification->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="flex items-center gap-1 shrink-0">
                        @if($url = $notification->data['url'] ?? null)
                            <a href="{{ $url }}" wire:navigate class="p-1 text-gray-500 hover:text-brand-400 transition">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        @endif
                        <button wire:click="markAsRead('{{ $notification->id }}')" class="p-1 text-gray-500 hover:text-green-400 transition opacity-0 group-hover:opacity-100">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </button>
                    </div>
                </div>
            @empty
                <div class="px-4 py-8 text-center text-sm text-gray-500">No hay notificaciones sin leer</div>
            @endforelse
        </div>

        <div class="border-t border-surface-border px-4 py-2.5">
            <a href="{{ route('admin.notifications.index') }}" wire:navigate class="block text-center text-sm text-brand-400 hover:text-brand-300 transition">Ver todas las notificaciones</a>
        </div>
    </div>
</div>
