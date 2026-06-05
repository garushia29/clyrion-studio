<div>
    <div class="flex items-start justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Analytics</h1>
            <p class="text-sm text-gray-400 mt-1">Estadísticas de visitas</p>
        </div>
        <x-button variant="secondary" wire:click="exportCsv">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Exportar CSV
        </x-button>
    </div>

    {{-- Date filters --}}
    <x-card class="mb-6">
        <div class="flex flex-wrap items-end gap-4">
            <div>
                <x-input-label value="Desde" />
                <x-text-input type="date" wire:model.live="startDate" class="mt-1" />
            </div>
            <div>
                <x-input-label value="Hasta" />
                <x-text-input type="date" wire:model.live="endDate" class="mt-1" />
            </div>
            <div>
                <x-input-label value="Rápido" />
                <select wire:model.live="days" class="border-surface-input bg-surface-card text-gray-200 focus:border-brand-500 focus:ring-brand-500 rounded-md shadow-sm text-sm mt-1">
                    <option value="7">7 días</option>
                    <option value="30">30 días</option>
                    <option value="90">90 días</option>
                    <option value="365">1 año</option>
                </select>
            </div>
        </div>
    </x-card>

    {{-- Stats Grid --}}
    <div class="grid sm:grid-cols-3 gap-4 mb-8">
        <x-card>
            <p class="text-3xl font-bold text-white">{{ number_format($totalViews) }}</p>
            <p class="text-xs text-gray-400 mt-1">Visitas totales</p>
        </x-card>
        <x-card>
            <p class="text-3xl font-bold text-white">{{ number_format($todayViews) }}</p>
            <p class="text-xs text-gray-400 mt-1">Visitas hoy</p>
        </x-card>
        <x-card>
            <p class="text-3xl font-bold text-white">{{ number_format($uniqueVisitors) }}</p>
            <p class="text-xs text-gray-400 mt-1">Visitantes únicos</p>
        </x-card>
    </div>

    <div class="grid lg:grid-cols-2 gap-6">
        {{-- Traffic Chart --}}
        <x-card title="Tráfico por día">
            <div class="h-72" wire:ignore>
                <canvas x-data="{}"
                        x-init="$nextTick(() => lineChart($el,
                            @js(collect($viewsByDay)->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('d M'))),
                            [{
                                label: 'Visitas',
                                data: @js(collect($viewsByDay)->pluck('visits')),
                                borderColor: '#3b82f6',
                                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                fill: true,
                                tension: 0.3,
                                pointRadius: 3,
                                pointHoverRadius: 6,
                            }]
                        ))"></canvas>
            </div>
        </x-card>

        {{-- Top Pages --}}
        <x-card title="Páginas más visitadas">
            <div class="space-y-2">
                @forelse ($topPages as $page)
                    <div class="flex items-center justify-between p-2 rounded-lg hover:bg-surface-hover transition">
                        <span class="text-sm text-gray-300 truncate">/{{ $page['path'] }}</span>
                        <span class="text-xs text-gray-500 ml-2">{{ $page['visits'] }} visitas</span>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 text-center py-8">No hay datos aún</p>
                @endforelse
            </div>
        </x-card>
    </div>
</div>
