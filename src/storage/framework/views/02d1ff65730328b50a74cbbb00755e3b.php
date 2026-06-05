<?php $__env->startSection('title', $permission?->exists ? 'Editar Permiso' : 'Nuevo Permiso'); ?>

<div>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white"><?php echo e($permission?->exists ? 'Editar Permiso' : 'Nuevo Permiso'); ?></h1>
            <p class="text-sm text-gray-400 mt-1"><?php echo e($permission?->exists ? "Editando: {$permission->name}" : 'Crear un nuevo permiso'); ?></p>
        </div>
        <a href="<?php echo e(route('admin.permissions.index')); ?>" wire:navigate class="px-4 py-2 text-sm text-gray-400 hover:text-white transition">
            ← Volver
        </a>
    </div>

    <form wire:submit="save" class="max-w-lg space-y-6">
        <div class="bg-surface-card rounded-xl border border-surface-border p-6 space-y-5">
            <h2 class="text-lg font-semibold text-white">Información del permiso</h2>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Nombre</label>
                <input type="text" wire:model="name"
                       class="w-full bg-surface border border-surface-border rounded-lg px-4 py-2.5 text-sm text-gray-200 placeholder-gray-500 focus:outline-none focus:border-brand-500"
                       placeholder="ej: view reports, edit settings">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-400"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="<?php echo e(route('admin.permissions.index')); ?>" wire:navigate
               class="px-4 py-2 text-sm text-gray-400 hover:text-white transition">
                Cancelar
            </a>
            <button type="submit"
                    class="px-6 py-2 bg-brand-600 hover:bg-brand-700 rounded-lg text-sm font-medium transition">
                <?php echo e($permission?->exists ? 'Actualizar' : 'Crear permiso'); ?>

            </button>
        </div>
    </form>
</div>
<?php /**PATH /var/www/resources/views/livewire/admin/permission-form.blade.php ENDPATH**/ ?>