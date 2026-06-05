<?php $__env->startSection('title', 'Redirecciones'); ?>

<div>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Redirecciones</h1>
            <p class="text-sm text-gray-400 mt-1">Gestiona redirecciones 301/302 para URLs antiguas o rotas</p>
        </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$showForm): ?>
            <button wire:click="create" class="px-4 py-2 bg-brand-600 hover:bg-brand-700 rounded-lg text-sm font-medium transition">
                + Nueva redirección
            </button>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    
    <div class="mb-4">
        <input type="text" wire:model.live.debounce="search" placeholder="Buscar por URL..."
               class="w-full max-w-md bg-surface border border-surface-border rounded-lg px-4 py-2 text-sm text-gray-200 placeholder-gray-500 focus:outline-none focus:border-brand-500">
    </div>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showForm): ?>
        <form wire:submit="save" class="max-w-2xl mb-8">
            <div class="bg-surface-card rounded-xl border border-surface-border p-6 space-y-5">
                <h2 class="text-lg font-semibold text-white"><?php echo e($editing?->exists ? 'Editar' : 'Nueva'); ?> redirección</h2>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">URL antigua</label>
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-gray-500 shrink-0">/</span>
                            <input type="text" wire:model="old_url" placeholder="ruta-antigua"
                                   class="w-full bg-surface border border-surface-border rounded-lg px-4 py-2.5 text-sm text-gray-200 placeholder-gray-500 focus:outline-none focus:border-brand-500">
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['old_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-400"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">URL destino</label>
                        <input type="text" wire:model="new_url" placeholder="/nueva-ruta o https://..."
                               class="w-full bg-surface border border-surface-border rounded-lg px-4 py-2.5 text-sm text-gray-200 placeholder-gray-500 focus:outline-none focus:border-brand-500">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['new_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-400"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>

                <div class="flex items-center gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Tipo</label>
                        <select wire:model="status_code"
                                class="bg-surface border border-surface-border rounded-lg px-4 py-2.5 text-sm text-gray-200 focus:outline-none focus:border-brand-500">
                            <option value="301">301 — Permanente</option>
                            <option value="302">302 — Temporal</option>
                        </select>
                    </div>
                    <div class="flex items-center gap-3 pt-5">
                        <input type="checkbox" wire:model="is_active" id="is_active"
                               class="rounded bg-surface border-surface-border text-brand-600 focus:ring-brand-500">
                        <label for="is_active" class="text-sm text-gray-300">Activa</label>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 mt-4">
                <button type="button" wire:click="cancel"
                        class="px-4 py-2 text-sm text-gray-400 hover:text-white transition">
                    Cancelar
                </button>
                <button type="submit"
                        class="px-6 py-2 bg-brand-600 hover:bg-brand-700 rounded-lg text-sm font-medium transition">
                    <?php echo e($editing?->exists ? 'Actualizar' : 'Crear'); ?>

                </button>
            </div>
        </form>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <div class="bg-surface-card rounded-xl border border-surface-border overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-surface-border">
                    <th class="text-left px-4 py-3 text-gray-400 font-medium">URL antigua</th>
                    <th class="text-left px-4 py-3 text-gray-400 font-medium">Destino</th>
                    <th class="text-center px-4 py-3 text-gray-400 font-medium">Tipo</th>
                    <th class="text-center px-4 py-3 text-gray-400 font-medium">Accesos</th>
                    <th class="text-center px-4 py-3 text-gray-400 font-medium">Activa</th>
                    <th class="text-right px-4 py-3 text-gray-400 font-medium">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $redirects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $redirect): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <tr class="border-b border-surface-border hover:bg-surface-hover transition">
                        <td class="px-4 py-3 text-gray-200 max-w-xs truncate">/<?php echo e($redirect->old_url); ?></td>
                        <td class="px-4 py-3 text-gray-400 max-w-xs truncate"><?php echo e($redirect->new_url); ?></td>
                        <td class="px-4 py-3 text-center">
                            <span class="text-xs px-2 py-0.5 rounded-full <?php echo e($redirect->status_code === 301 ? 'text-amber-400 bg-amber-500/10' : 'text-blue-400 bg-blue-500/10'); ?>">
                                <?php echo e($redirect->status_code); ?>

                            </span>
                        </td>
                        <td class="px-4 py-3 text-center text-gray-400"><?php echo e($redirect->hits); ?></td>
                        <td class="px-4 py-3 text-center">
                            <button wire:click="toggleActive(<?php echo e($redirect->id); ?>)"
                                    class="inline-flex items-center gap-1 text-xs px-2 py-1 rounded-full transition
                                    <?php echo e($redirect->is_active ? 'text-green-400 bg-green-500/10' : 'text-gray-500 bg-gray-500/10'); ?>">
                                <?php echo e($redirect->is_active ? 'Sí' : 'No'); ?>

                            </button>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button wire:click="edit(<?php echo e($redirect->id); ?>)"
                                        class="text-xs text-gray-400 hover:text-white transition">
                                    Editar
                                </button>
                                <button wire:click="resetHits(<?php echo e($redirect->id); ?>)"
                                        class="text-xs text-gray-500 hover:text-gray-300 transition">
                                    Reset hits
                                </button>
                                <button wire:click="delete(<?php echo e($redirect->id); ?>)"
                                        wire:confirm="¿Eliminar esta redirección?"
                                        class="text-xs text-red-400 hover:text-red-300 transition">
                                    Eliminar
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                            No hay redirecciones. Crea la primera.
                        </td>
                    </tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php /**PATH /var/www/resources/views/livewire/admin/redirect-list.blade.php ENDPATH**/ ?>