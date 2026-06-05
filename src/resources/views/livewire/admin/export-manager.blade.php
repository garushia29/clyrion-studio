@section('title', 'Exportar Datos')
<div>
    <x-card>
        <x-slot:header>
            <h2 class="text-lg font-semibold text-white">Exportar Datos</h2>
        </x-slot:header>

        <form wire:submit="export" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Modelo</label>
                    <select wire:model="selectedModel" class="w-full rounded-lg border-surface-border bg-surface-card text-white px-3 py-2 text-sm focus:ring-brand-500 focus:border-brand-500">
                        <option value="posts">Posts</option>
                        <option value="projects">Proyectos</option>
                        <option value="tutorials">Tutoriales</option>
                        <option value="users">Usuarios</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Formato</label>
                    <select wire:model="fileType" class="w-full rounded-lg border-surface-border bg-surface-card text-white px-3 py-2 text-sm focus:ring-brand-500 focus:border-brand-500">
                        <option value="csv">CSV</option>
                        <option value="pdf">PDF</option>
                    </select>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <x-button variant="primary" type="submit" :disabled="$status === 'processing'">
                    @if ($status === 'processing')
                        <svg class="w-4 h-4 animate-spin mr-1" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                        Procesando...
                    @else
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Exportar
                    @endif
                </x-button>

                @if ($status === 'completed')
                    <span class="text-sm text-green-400">{{ $message }}</span>
                @elseif ($status === 'error')
                    <span class="text-sm text-red-400">{{ $message }}</span>
                @endif
            </div>
        </form>
    </x-card>

    {{-- Recent exports --}}
    @if ($recentExports->isNotEmpty())
        <x-card class="mt-6">
            <x-slot:header>
                <h3 class="text-md font-semibold text-white">Exportaciones Recientes</h3>
            </x-slot:header>

            <x-table :columns="[['label' => 'Modelo'], ['label' => 'Formato'], ['label' => 'Archivo', 'class' => 'hidden md:table-cell'], ['label' => 'Estado'], ['label' => 'Fecha'], ['label' => '']]">
                <x-slot:body>
                    @foreach ($recentExports as $export)
                        <tr class="border-b border-surface-border">
                            <td class="px-4 py-3 text-sm text-white">{{ ucfirst($export->model_type) }}</td>
                            <td class="px-4 py-3 text-sm text-gray-400 uppercase">{{ $export->file_type }}</td>
                            <td class="px-4 py-3 text-sm text-gray-400 hidden md:table-cell">{{ $export->file_name }}</td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $export->status === 'completed' ? 'bg-green-500/10 text-green-400' : 'bg-red-500/10 text-red-400' }}">
                                    {{ $export->status === 'completed' ? 'Completado' : 'Falló' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-400">{{ $export->created_at->format('d/m/y H:i') }}</td>
                            <td class="px-4 py-3">
                                @if ($export->status === 'completed')
                                    <button wire:click="download({{ $export->id }})" class="text-sm text-brand-400 hover:text-brand-300">Descargar</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </x-slot:body>
            </x-table>
        </x-card>
    @endif
</div>

