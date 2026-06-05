@props([
    'title' => 'No hay datos',
    'description' => null,
    'action' => null,
    'icon' => null,
])

<div {{ $attributes->merge(['class' => 'text-center py-12']) }}>
    @if ($icon)
        <div class="mb-4 text-gray-600 [&>svg]:mx-auto [&>svg]:w-12 [&>svg]:h-12">
            {{ $icon }}
        </div>
    @endif
    <p class="text-gray-400 font-medium">{{ $title }}</p>
    @if ($description)
        <p class="text-sm text-gray-500 mt-1 max-w-sm mx-auto">{{ $description }}</p>
    @endif
    @if ($action)
        <div class="mt-4">
            {{ $action }}
        </div>
    @endif
</div>
