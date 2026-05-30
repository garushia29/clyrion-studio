<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-surface-card border border-surface-border rounded-md font-semibold text-xs text-gray-300 uppercase tracking-widest shadow-sm hover:bg-surface-hover focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2 focus:ring-offset-surface disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
