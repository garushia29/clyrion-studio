

<?php $__env->startSection('title', 'Clyrion Studio | JIMMY — Software Engineer & Fullstack Developer'); ?>

<?php $__env->startSection('meta'); ?>
    <?php if (isset($component)) { $__componentOriginal77c87fdb81a645a26baace7b9ad23d77 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal77c87fdb81a645a26baace7b9ad23d77 = $attributes; } ?>
<?php $component = App\View\Components\MetaTags::resolve(['title' => 'Clyrion Studio | JIMMY','description' => 'Software Engineer & Fullstack Developer especializado en arquitecturas backend, automatización de procesos y soluciones empresariales escalables.'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
    <div class="container-page text-center animate-fade-in">
        <p class="text-brand-400 mb-4 uppercase tracking-widest text-sm font-medium">
            <?php echo e(__('home.tagline')); ?>

        </p>
        <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold leading-tight mb-6 text-white">
            <?php echo e(__('home.title')); ?>

            <span class="gradient-text">
                <?php echo e(__('home.title_accent')); ?>

            </span>
        </h1>
        <p class="max-w-3xl mx-auto text-gray-400 text-lg leading-relaxed">
            <?php echo e(__('home.subtitle')); ?>

        </p>
        <div class="mt-10 flex justify-center gap-4">
            <a href="#proyectos"
               class="px-8 py-4 bg-brand-600 hover:bg-brand-700 rounded-xl font-medium transition">
                <?php echo e(__('home.cta_projects')); ?>

            </a>
            <a href="#contacto"
               class="px-8 py-4 border border-surface-border hover:border-brand-500 rounded-xl transition">
                <?php echo e(__('home.cta_contact')); ?>

            </a>
        </div>
    </div>
</section>



<section id="servicios" class="section-padding bg-surface-card/50">
    <div class="container-page">
        <h2 class="text-3xl sm:text-4xl font-bold text-center mb-4 text-white"><?php echo e(__('home.services_title')); ?></h2>
        <p class="text-gray-400 text-center mb-16 max-w-2xl mx-auto">
            <?php echo e(__('home.services_subtitle')); ?>

        </p>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div class="card-hover p-6">
                    <h3 class="text-lg font-semibold mb-2 text-white group-hover:text-brand-400 transition"><?php echo e($service->title); ?></h3>
                    <p class="text-gray-400 text-sm"><?php echo e($service->description); ?></p>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <div class="col-span-full text-center py-12 text-gray-500">
                    <p><?php echo e(__('home.services_empty')); ?></p>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</section>


<section id="proyectos" class="section-padding">
    <div class="container-page">
        <h2 class="text-3xl sm:text-4xl font-bold text-center mb-4 text-white"><?php echo e(__('home.projects_title')); ?></h2>
        <p class="text-gray-400 text-center mb-16 max-w-2xl mx-auto">
            <?php echo e(__('home.projects_subtitle')); ?>

        </p>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $featured; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <a href="<?php echo e(route('projects.show', $project->slug)); ?>" class="card-hover p-6 flex flex-col group">
                    <div class="w-10 h-10 rounded-lg bg-brand-500/10 flex items-center justify-center mb-4 text-brand-400 font-bold text-lg">
                        <?php echo e($loop->iteration); ?>

                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2 group-hover:text-brand-400 transition"><?php echo e($project->title); ?></h3>
                    <p class="text-gray-400 text-sm flex-1"><?php echo e($project->description); ?></p>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->technologies): ?>
                        <div class="mt-4 pt-4 border-t border-surface-border">
                            <span class="text-xs text-gray-500"><?php echo e(implode(', ', $project->technologies)); ?></span>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <div class="col-span-full text-center py-12 text-gray-500">
                    <p><?php echo e(__('home.projects_empty')); ?></p>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        <div class="text-center mt-12">
            <a href="<?php echo e(route('projects.index')); ?>" class="inline-flex items-center gap-2 text-brand-400 hover:text-brand-300 transition font-medium">
                <?php echo e(__('home.projects_all')); ?>

                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>


<section id="contacto" class="section-padding bg-surface-card/50">
    <div class="container-page max-w-2xl text-center">
        <h2 class="text-3xl sm:text-4xl font-bold mb-4 text-white"><?php echo e(__('home.contact_title')); ?></h2>
        <p class="text-gray-400 mb-12">
            <?php echo e(__('home.contact_subtitle')); ?>

        </p>
        <div class="card p-8 text-left">
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('contact-form', []);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-979180403-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/pages/home.blade.php ENDPATH**/ ?>