<div>
    <x-card>
        <x-slot:header>
            <h2 class="text-lg font-semibold text-white">Importar Datos (CSV)</h2>
        </x-slot:header>

        <form wire:submit="import" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Modelo</label>
                <select wire:model="selectedModel" class="w-full rounded-lg border-surface-border bg-surface-card text-white px-3 py-2 text-sm focus:ring-brand-500 focus:border-brand-500">
                    <option value="posts">Posts</option>
                    <option value="projects">Proyectos</option>
                    <option value="tutorials">Tutoriales</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Archivo CSV</label>
                <input type="file" wire:model="file" accept=".csv,.txt" class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-brand-500/10 file:text-brand-400 hover:file:bg-brand-500/20">
                @error('file') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                <p class="text-xs text-gray-500 mt-1">Máximo 10MB. La primera fila debe contener los nombres de columna.</p>
            </div>

            <div class="flex items-center gap-3">
                <x-button variant="primary" type="submit" :disabled="$status === 'processing'">
                    @if ($status === 'processing')
                        <svg class="w-4 h-4 animate-spin mr-1" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                        Importando...
                    @else
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                        Importar
                    @endif
                </x-button>

                @if ($status === 'completed')
                    <span class="text-sm text-green-400">{{ $message }}</span>
                @elseif ($status === 'error')
                    <span class="text-sm text-red-400">{{ $message }}</span>
                @endif
            </div>
        </form>

        {{-- Progress --}}
        @if ($file)
            <div class="mt-4 p-3 bg-surface-alt rounded-lg">
                <p class="text-sm text-gray-300">Archivo: {{ $file->getClientOriginalName() }} ({{ number_format($file->getSize() / 1024, 1) }} KB)</p>
            </div>
        @endif
    </x-card>

    {{-- Recent imports --}}
    @if ($recentImports->isNotEmpty())
        <x-card class="mt-6">
            <x-slot:header>
                <h3 class="text-md font-semibold text-white">Importaciones Recientes</h3>
            </x-slot:header>

            <x-table :columns="['Modelo', 'Archivo', 'Filas', 'Procesadas', 'Errores', 'Estado', 'Fecha']">
                <x-slot:body>
                    @foreach ($recentImports as $import)
                        <tr class="border-b border-surface-border">
                            <td class="px-4 py-3 text-sm text-white">{{ ucfirst($import->model_type) }}</td>
                            <td class="px-4 py-3 text-sm text-gray-400">{{ $import->file_name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-400">{{ $import->total_rows }}</td>
                            <td class="px-4 py-3 text-sm text-gray-400">{{ $import->processed_rows }}</td>
                            <td class="px-4 py-3">
                                @if ($import->failed_rows > 0)
                                    <button wire:click="viewErrors({{ $import->id }})" class="text-sm text-red-400 hover:text-red-300">{{ $import->failed_rows }} errores</button>
                                @else
                                    <span class="text-sm text-gray-400">0</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $import->status === 'completed' ? 'bg-green-500/10 text-green-400' : 'bg-red-500/10 text-red-400' }}">
                                    {{ $import->status === 'completed' ? 'Completado' : 'Falló' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-400">{{ $import->created_at->format('d/m/y H:i') }}</td>
                        </tr>
                    @endforeach
                </x-slot:body>
            </x-table>
        </x-card>
    @endif
</div>
