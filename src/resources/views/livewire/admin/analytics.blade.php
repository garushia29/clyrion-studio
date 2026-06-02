{{-- Panel de administración: dashboard de analytics --}}
{{-- Muestra visitas totales, únicas, páginas top y tráfico por día --}}

@section('title', 'Analytics')

<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-white">Analytics</h1>
        <p class="text-sm text-gray-400 mt-1">Estadísticas de visitas de los últimos {{ $days }} días</p>
    </div>

    {{-- Stats Grid --}}
    <div class="grid sm:grid-cols-3 gap-4 mb-8">
        <div class="card p-4">
            <p class="text-3xl font-bold text-white">{{ number_format($totalViews) }}</p>
            <p class="text-xs text-gray-400 mt-1">Visitas totales (30d)</p>
        </div>
        <div class="card p-4">
            <p class="text-3xl font-bold text-white">{{ number_format($todayViews) }}</p>
            <p class="text-xs text-gray-400 mt-1">Visitas hoy</p>
        </div>
        <div class="card p-4">
            <p class="text-3xl font-bold text-white">{{ number_format($uniqueVisitors) }}</p>
            <p class="text-xs text-gray-400 mt-1">Visitantes únicos (30d)</p>
        </div>
    </div>

    <div class="grid lg:grid-cols-2 gap-6">
        {{-- Views by Day Chart --}}
        <div class="card p-6">
            <h3 class="text-sm font-semibold text-white mb-4">Tráfico por día</h3>
            <div class="flex items-end gap-1 h-32">
                @foreach ($viewsByDay as $day)
                    @php
                        $height = $maxDaily > 0 ? max(4, ($day['visits'] / $maxDaily) * 100) : 4;
                    @endphp
                    <div class="flex-1 flex flex-col items-center group relative">
                        <div class="w-full bg-brand-500/20 rounded-t hover:bg-brand-500/40 transition cursor-pointer"
                             style="height: {{ $height }}%">
                        </div>
                        <div class="opacity-0 group-hover:opacity-100 absolute -top-8 bg-surface-card border border-surface-border rounded px-2 py-1 text-xs text-white whitespace-nowrap transition">
                            {{ $day['visits'] }} visits — {{ \Carbon\Carbon::parse($day['date'])->format('d M') }}
                        </div>
                    </div>
                @endforeach
            </div>
            @if (empty($viewsByDay))
                <p class="text-sm text-gray-500 text-center py-8">No hay datos aún</p>
            @endif
        </div>

        {{-- Top Pages --}}
        <div class="card p-6">
            <h3 class="text-sm font-semibold text-white mb-4">Páginas más visitadas</h3>
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
        </div>
    </div>
</div>
