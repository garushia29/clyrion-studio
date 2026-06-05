<?php $__env->startSection('title', __('tutorials.title') . ' | Clyrion Studio | JIMMY'); ?>

<?php $__env->startSection('meta'); ?>
    <?php if (isset($component)) { $__componentOriginal77c87fdb81a645a26baace7b9ad23d77 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal77c87fdb81a645a26baace7b9ad23d77 = $attributes; } ?>
<?php $component = App\View\Components\MetaTags::resolve(['title' => ''.e(__('tutorials.title')).' | Clyrion Studio | JIMMY','description' => 'Tutoriales técnicos sobre Laravel, PHP, Docker, arquitectura de software y desarrollo web.'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('meta-tags'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\MetaTags::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal77c87fdb81a645a26baace7b9ad23d77)): ?>
<?php $attributes = $__attributesOriginal77c87fdb81a645a26baace7b9ad23d77; ?>
<?php unset($__attributesOriginal77c87fdb81a645a26baace7b9ad23d77); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal77c87fdb81a645a26baace7b9ad23d77)): ?>
<?php $component = $__componentOriginal77c87fdb81a645a26baace7b9ad23d77; ?>
<?php unset($__componentOriginal77c87fdb81a645a26baace7b9ad23d77); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="section-padding">
    <div class="container-page">
        <div class="text-center mb-16">
            <p class="text-brand-400 mb-4 uppercase tracking-widest text-sm font-medium"><?php echo e(__('tutorials.title')); ?></p>
            <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4"><?php echo e(__('tutorials.title')); ?></h1>
            <p class="text-gray-400 max-w-2xl mx-auto">
                <?php echo e(__('tutorials.subtitle')); ?>

            </p>
        </div>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($series->isNotEmpty()): ?>
            <h2 class="text-2xl font-bold text-white mb-8"><?php echo e(__('tutorials.series')); ?></h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $series; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <a href="<?php echo e(route('tutorials.series', $s->slug)); ?>" class="card-hover p-6 group">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-xs px-2 py-0.5 rounded-full <?php echo e((new \App\Models\Tutorial)->difficultyColor()); ?>">
                                <?php echo e((new \App\Models\Tutorial)->difficultyLabel()); ?>

                            </span>
                            <span class="text-xs text-gray-500"><?php echo e($s->tutorials_count); ?> <?php echo e(__('tutorials.title')); ?></span>
                        </div>
                        <h3 class="text-lg font-semibold text-white mb-2 group-hover:text-brand-400 transition"><?php echo e($s->title); ?></h3>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($s->description): ?>
                            <p class="text-sm text-gray-400 line-clamp-2"><?php echo e($s->description); ?></p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </a>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <h2 class="text-2xl font-bold text-white mb-8"><?php echo e(__('tutorials.title')); ?></h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $standalone; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tutorial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <a href="<?php echo e(route('tutorials.show', $tutorial->slug)); ?>" class="card-hover p-5 group">
                    <div class="flex flex-wrap items-center gap-2 mb-3">
                        <span class="text-xs px-2 py-0.5 rounded-full <?php echo e($tutorial->difficultyColor()); ?>"><?php echo e($tutorial->difficultyLabel()); ?></span>
                        <span class="text-xs text-gray-500"><?php echo e($tutorial->readingTime()); ?></span>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tutorial->series): ?>
                            <span class="text-xs text-brand-400"><?php echo e($tutorial->series->title); ?></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <h3 class="text-base font-semibold text-white mb-2 group-hover:text-brand-400 transition"><?php echo e($tutorial->title); ?></h3>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tutorial->excerpt): ?>
                        <p class="text-sm text-gray-400 line-clamp-2"><?php echo e($tutorial->excerpt); ?></p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tutorial->tags->isNotEmpty()): ?>
                        <div class="flex flex-wrap gap-1.5 mt-3">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $tutorial->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <span class="text-xs text-gray-600">#<?php echo e($tag->name); ?></span>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <div class="col-span-full text-center py-20 text-gray-500">
                    <p class="text-lg"><?php echo e(__('tutorials.empty')); ?></p>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($standalone->hasPages()): ?>
            <div class="mt-12">
                <?php echo e($standalone->links()); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/pages/tutorials.blade.php ENDPATH**/ ?>