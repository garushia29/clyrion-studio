<?php $__env->startSection('title', __('about.title') . ' | Clyrion Studio | JIMMY'); ?>

<?php $__env->startSection('meta'); ?>
    <?php if (isset($component)) { $__componentOriginal77c87fdb81a645a26baace7b9ad23d77 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal77c87fdb81a645a26baace7b9ad23d77 = $attributes; } ?>
<?php $component = App\View\Components\MetaTags::resolve(['type' => 'profile','title' => __('about.title') . ' | Clyrion Studio | JIMMY','description' => __('about.bio'),'profileFirstName' => 'JIMMY','profileUsername' => 'jimmy'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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

<?php $__env->startSection('schema'); ?>
    <?php if (isset($component)) { $__componentOriginal4c0f6c0bd58a583f0b502ced662d3ed1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4c0f6c0bd58a583f0b502ced662d3ed1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.schema-org','data' => ['type' => 'Person','description' => 'Software Engineer & Fullstack Developer especializado en arquitecturas backend, automatización de procesos y soluciones empresariales escalables.','url' => route('about')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('schema-org'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'Person','description' => 'Software Engineer & Fullstack Developer especializado en arquitecturas backend, automatización de procesos y soluciones empresariales escalables.','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('about'))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4c0f6c0bd58a583f0b502ced662d3ed1)): ?>
<?php $attributes = $__attributesOriginal4c0f6c0bd58a583f0b502ced662d3ed1; ?>
<?php unset($__attributesOriginal4c0f6c0bd58a583f0b502ced662d3ed1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4c0f6c0bd58a583f0b502ced662d3ed1)): ?>
<?php $component = $__componentOriginal4c0f6c0bd58a583f0b502ced662d3ed1; ?>
<?php unset($__componentOriginal4c0f6c0bd58a583f0b502ced662d3ed1); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="section-padding">
    <div class="container-page">
        <div class="grid lg:grid-cols-5 gap-16 items-start">
            <div class="lg:col-span-2">
                <div class="card p-8 text-center lg:text-left">
                    <div class="w-32 h-32 mx-auto lg:mx-0 rounded-full bg-gradient-to-br from-brand-500 to-brand-700 flex items-center justify-center text-4xl font-bold text-white mb-6">
                        J
                    </div>
                    <h1 class="text-3xl font-bold text-white mb-2">JIMMY</h1>
                    <p class="text-brand-400 font-medium mb-4">Software Engineer & Fullstack Developer</p>
                    <p class="text-gray-400 text-sm leading-relaxed mb-6">
                        <?php echo e(__('about.bio')); ?>

                    </p>
                    <div class="flex flex-wrap gap-3 justify-center lg:justify-start">
                        <span class="px-3 py-1 text-xs rounded-full bg-surface-card border border-surface-border text-gray-300">Laravel</span>
                        <span class="px-3 py-1 text-xs rounded-full bg-surface-card border border-surface-border text-gray-300">Livewire</span>
                        <span class="px-3 py-1 text-xs rounded-full bg-surface-card border border-surface-border text-gray-300">PostgreSQL</span>
                        <span class="px-3 py-1 text-xs rounded-full bg-surface-card border border-surface-border text-gray-300">Docker</span>
                        <span class="px-3 py-1 text-xs rounded-full bg-surface-card border border-surface-border text-gray-300">PHP</span>
                        <span class="px-3 py-1 text-xs rounded-full bg-surface-card border border-surface-border text-gray-300">TailwindCSS</span>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-3 space-y-8">
                <div>
                    <h2 class="text-2xl font-bold text-white mb-4"><?php echo e(__('about.approach_title')); ?></h2>
                    <div class="space-y-4">
                        <?php
                            $approaches = [
                                ['title' => 'Clean Architecture', 'desc' => 'Código mantenible con separación clara de responsabilidades y principios SOLID.'],
                                ['title' => 'DevOps First', 'desc' => 'Entornos dockerizados, CI/CD, y despliegues automatizados desde el día uno.'],
                                ['title' => 'Escalabilidad', 'desc' => 'Sistemas diseñados para crecer sin reescribir. Base de datos, cache y colas desde el inicio.'],
                                ['title' => 'UX Técnico', 'desc' => 'Interfaces funcionales, rápidas y consistentes. Diseño premium sin sacrificar rendimiento.'],
                            ];
                        ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $approaches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <div class="flex gap-4">
                                <div class="w-1.5 h-1.5 rounded-full bg-brand-500 mt-2.5 shrink-0"></div>
                                <div>
                                    <h3 class="text-white font-medium"><?php echo e($item['title']); ?></h3>
                                    <p class="text-gray-400 text-sm"><?php echo e($item['desc']); ?></p>
                                </div>
                            </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-white mb-4"><?php echo e(__('about.stack_title')); ?></h2>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <?php
                            $stack = [
                                ['name' => 'Laravel', 'cat' => 'Backend'],
                                ['name' => 'Livewire', 'cat' => 'Frontend'],
                                ['name' => 'PostgreSQL', 'cat' => 'Database'],
                                ['name' => 'Docker', 'cat' => 'DevOps'],
                                ['name' => 'TailwindCSS', 'cat' => 'Frontend'],
                                ['name' => 'Alpine.js', 'cat' => 'Frontend'],
                                ['name' => 'Vite', 'cat' => 'Build'],
                                ['name' => 'Nginx', 'cat' => 'Infra'],
                            ];
                        ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $stack; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tech): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <div class="card p-4 text-center">
                                <div class="text-sm font-medium text-white"><?php echo e($tech['name']); ?></div>
                                <div class="text-xs text-gray-500 mt-1"><?php echo e($tech['cat']); ?></div>
                            </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/pages/about.blade.php ENDPATH**/ ?>