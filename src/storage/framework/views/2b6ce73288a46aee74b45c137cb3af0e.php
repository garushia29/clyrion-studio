<?php $__env->startSection('title', ($tutorial->meta_title ?: $tutorial->title) . ' | ' . __('tutorials.title') . ' | Clyrion Studio | JIMMY'); ?>

<?php $__env->startSection('meta'); ?>
    <?php if (isset($component)) { $__componentOriginal77c87fdb81a645a26baace7b9ad23d77 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal77c87fdb81a645a26baace7b9ad23d77 = $attributes; } ?>
<?php $component = App\View\Components\MetaTags::resolve(['title' => $tutorial->meta_title ?: $tutorial->title,'description' => $tutorial->meta_description ?: $tutorial->excerpt,'image' => $tutorial->featured_image] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.schema-org','data' => ['type' => 'Tutorial','name' => $tutorial->meta_title ?: $tutorial->title,'description' => $tutorial->meta_description ?: $tutorial->excerpt,'datePublished' => $tutorial->published_at?->toIso8601String(),'educationalLevel' => $tutorial->difficulty,'url' => route('tutorials.show', $tutorial->slug)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('schema-org'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'Tutorial','name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tutorial->meta_title ?: $tutorial->title),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tutorial->meta_description ?: $tutorial->excerpt),'datePublished' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tutorial->published_at?->toIso8601String()),'educationalLevel' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tutorial->difficulty),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('tutorials.show', $tutorial->slug))]); ?>
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

<article class="section-padding">
    <div class="container-page max-w-3xl">
        <div class="flex items-center justify-between mb-8">
            <a href="<?php echo e($series ? route('tutorials.series', $series->slug) : route('tutorials.index')); ?>" class="inline-flex items-center gap-2 text-gray-400 hover:text-brand-400 transition text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                <?php echo e($series ? $series->title : __('tutorials.back')); ?>

            </a>
        </div>

        <header class="mb-8">
            <div class="flex flex-wrap items-center gap-3 text-sm mb-4">
                <span class="px-2.5 py-1 text-xs rounded-full <?php echo e($tutorial->difficultyColor()); ?>"><?php echo e($tutorial->difficultyLabel()); ?></span>
                <span class="text-gray-500"><?php echo e($tutorial->readingTime()); ?></span>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tutorial->published_at): ?>
                    <span class="text-gray-500"><?php echo e($tutorial->published_at->format('d M, Y')); ?></span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($series): ?>
                    <span class="text-brand-400 text-xs"><?php echo e($series->title); ?></span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4"><?php echo e($tutorial->title); ?></h1>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tutorial->excerpt): ?>
                <p class="text-lg text-gray-400 leading-relaxed"><?php echo e($tutorial->excerpt); ?></p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </header>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tutorial->prerequisites): ?>
            <div class="mb-8 p-4 rounded-lg bg-yellow-500/5 border border-yellow-500/10">
                <h3 class="text-sm font-semibold text-yellow-400 mb-2"><?php echo e(__('tutorials.prerequisites')); ?></h3>
                <p class="text-sm text-gray-400"><?php echo e($tutorial->prerequisites); ?></p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($series): ?>
            <div class="mb-8 p-4 rounded-lg bg-surface-card border border-surface-border">
                <div class="flex items-center justify-between">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prev): ?>
                        <a href="<?php echo e(route('tutorials.show', $prev->slug)); ?>" class="flex items-center gap-2 text-sm text-gray-400 hover:text-brand-400 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            <?php echo e(__('tutorials.back_series')); ?>

                        </a>
                    <?php else: ?>
                        <div></div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <span class="text-xs text-gray-600"><?php echo e($series->title); ?></span>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($next): ?>
                        <a href="<?php echo e(route('tutorials.show', $next->slug)); ?>" class="flex items-center gap-2 text-sm text-gray-400 hover:text-brand-400 transition">
                            <?php echo e(__('tutorials.back_series')); ?>

                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    <?php else: ?>
                        <div></div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tutorial->content): ?>
            <div class="prose prose-invert max-w-none text-gray-300 leading-relaxed">
                <?php echo e($tutorial->content); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tutorial->tags->isNotEmpty()): ?>
            <div class="mt-8 pt-8 border-t border-surface-border">
                <div class="flex flex-wrap gap-2">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $tutorial->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <span class="px-3 py-1 text-xs rounded-full bg-surface-card border border-surface-border text-gray-400">#<?php echo e($tag->name); ?></span>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($related->isNotEmpty()): ?>
            <div class="mt-12 pt-8 border-t border-surface-border">
                <h3 class="text-xl font-semibold text-white mb-6"><?php echo e(__('tutorials.related')); ?></h3>
                <div class="grid sm:grid-cols-2 gap-6">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <a href="<?php echo e(route('tutorials.show', $rel->slug)); ?>" class="card-hover p-4 group">
                            <div class="text-xs text-gray-500 mb-2"><?php echo e($rel->readingTime()); ?> · <?php echo e($rel->difficultyLabel()); ?></div>
                            <h4 class="text-sm font-semibold text-white group-hover:text-brand-400 transition"><?php echo e($rel->title); ?></h4>
                        </a>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</article>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/pages/tutorial-detail.blade.php ENDPATH**/ ?>