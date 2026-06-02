<div>
    @if ($success)
        <div class="text-center py-8">
            <div class="w-16 h-16 rounded-full bg-green-500/10 flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <p class="text-lg text-white font-medium">{{ __('contact.success') }}</p>
        </div>
    @else
        <form wire:submit="save" class="space-y-6">
            <div>
                <x-input-label for="name" :value="__('contact.name')" />
                <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" required />
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>
            <div>
                <x-input-label for="email" :value="__('contact.email')" />
                <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" required />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>
            <div>
                <x-input-label for="message" :value="__('contact.message')" />
                <textarea wire:model="message" id="message" rows="4" class="block mt-1 w-full border-surface-input bg-surface-card text-gray-200 focus:border-brand-500 focus:ring-brand-500 rounded-md shadow-sm" required></textarea>
                <x-input-error :messages="$errors->get('message')" class="mt-1" />
            </div>
            <x-primary-button class="w-full justify-center" wire:loading.attr="disabled">
                <span wire:loading.remove>{{ __('contact.send') }}</span>
                <span wire:loading>{{ __('contact.sending') }}</span>
            </x-primary-button>
        </form>
    @endif
</div>
