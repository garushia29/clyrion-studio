<div>
    @if ($visible)
        <div
            x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => { show = false; $wire.dismiss(); }, 5000)"
            class="fixed top-4 right-4 z-50 max-w-sm w-full"
        >
            <div class="{{ $type === 'success' ? 'bg-green-600' : 'bg-red-600' }} text-white px-4 py-3 rounded-lg shadow-lg flex items-center justify-between">
                <div class="flex items-center gap-2">
                    @if ($type === 'success')
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    @else
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    @endif
                    <p class="text-sm font-medium">{{ $message }}</p>
                </div>
                <button wire:click="dismiss" class="text-white/80 hover:text-white ml-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif
</div>
