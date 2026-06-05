@section('title', 'Audit Trail')
<div>
    <x-card>
        <x-slot:header>
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <h2 class="text-lg font-semibold text-white">Audit Trail</h2>
                <div class="flex items-center gap-2">
                    <input type="text" wire:model.live.debounce="search" placeholder="Buscar..."
                           class="w-full sm:w-48 rounded-lg border-surface-border bg-surface-card text-white px-3 py-1.5 text-sm focus:ring-brand-500 focus:border-brand-500">
                    <select wire:model.live="filterType" class="rounded-lg border-surface-border bg-surface-card text-white px-3 py-1.5 text-sm focus:ring-brand-500 focus:border-brand-500">
                        <option value="">Todos los tipos</option>
                        <option value="created">Creado</option>
                        <option value="updated">Actualizado</option>
                        <option value="deleted">Eliminado</option>
                    </select>
                    <select wire:model.live="filterModel" class="rounded-lg border-surface-border bg-surface-card text-white px-3 py-1.5 text-sm focus:ring-brand-500 focus:border-brand-500">
                        <option value="">Todos los modelos</option>
                        <option value="Post">Post</option>
                        <option value="Project">Proyecto</option>
                        <option value="Tutorial">Tutorial</option>
                        <option value="User">Usuario</option>
                        <option value="Category">Categoría</option>
                        <option value="Tag">Tag</option>
                        <option value="Service">Servicio</option>
                        <option value="Webhook">Webhook</option>
                        <option value="Redirect">Redirección</option>
                    </select>
                </div>
            </div>
        </x-slot:header>

        <x-table :columns="[['label' => 'Usuario'], ['label' => 'Acción'], ['label' => 'Modelo'], ['label' => 'ID', 'class' => 'hidden md:table-cell'], ['label' => 'Descripción'], ['label' => 'IP', 'class' => 'hidden md:table-cell'], ['label' => 'Fecha']]">
            <x-slot:body>
                @forelse ($logs as $log)
                    <tr class="border-b border-surface-border hover:bg-surface-hover/50">
                        <td class="px-4 py-3 text-sm text-white">{{ $log->user?->name ?? 'Sistema' }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $log->log_type === 'created' ? 'bg-green-500/10 text-green-400' : '' }}
                                {{ $log->log_type === 'updated' ? 'bg-blue-500/10 text-blue-400' : '' }}
                                {{ $log->log_type === 'deleted' ? 'bg-red-500/10 text-red-400' : '' }}">
                                {{ ucfirst($log->log_type) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-400">{{ $log->model_type }}</td>
                        <td class="px-4 py-3 text-sm text-gray-400 hidden md:table-cell">{{ $log->model_id ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-400 max-w-xs truncate">{{ $log->description }}</td>
                        <td class="px-4 py-3 text-sm text-gray-500 hidden md:table-cell">{{ $log->ip_address ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-400">{{ $log->created_at->format('d/m/y H:i:s') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8">
                            <x-empty-state icon="activity" title="Sin actividad" message="No hay registros de actividad aún." />
                        </td>
                    </tr>
                @endforelse
            </x-slot:body>
        </x-table>

        <div class="mt-4">
            {{ $logs->links() }}
        </div>
    </x-card>
</div>
