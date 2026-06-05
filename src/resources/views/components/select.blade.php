@props(['disabled' => false])

<select @disabled($disabled) {{ $attributes->merge(['class' => 'border-surface-input bg-surface-card text-gray-200 focus:border-brand-500 focus:ring-brand-500 rounded-md shadow-sm text-sm']) }}>
    {{ $slot }}
</select>
