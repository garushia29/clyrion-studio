<div>
    @if ($show)
        <div
            x-data="{ show: true }"
            x-show="show"
            x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center"
        >
            <div class="absolute inset-0 bg-black/50" @click="cancel()"></div>
            <div class="relative bg-surface-card border border-surface-border rounded-xl shadow-2xl max-w-md w-full mx-4 p-6">
                <div class="flex items-start gap-4">
                    <div class="shrink-0 w-10 h-10 rounded-full bg-red-500/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-lg font-semibold text-white">{{ $title }}</h3>
                        <p class="mt-1 text-sm text-gray-400">{{ $message }}</p>
                    </div>
                </div>
                <div class="mt-6 flex justify-end gap-3">
                    <button
                        wire:click="cancel"
                        class="px-4 py-2 text-sm font-medium text-gray-300 bg-surface border border-surface-border rounded-lg hover:bg-surface-hover transition"
                    >
                        {{ $cancelText }}
                    </button>
                    <button
                        wire:click="confirm"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition"
                    >
                        {{ $confirmText }}
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
