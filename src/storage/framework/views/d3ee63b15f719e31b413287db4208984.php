<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title', config('app.name', 'Clyrion Studio | JIMMY')); ?></title>

    <script>
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>

    <?php if (! empty(trim($__env->yieldContent('meta')))): ?>
        <?php echo $__env->yieldContent('meta'); ?>
    <?php else: ?>
        <?php if (isset($component)) { $__componentOriginal77c87fdb81a645a26baace7b9ad23d77 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal77c87fdb81a645a26baace7b9ad23d77 = $attributes; } ?>
<?php $component = App\View\Components\MetaTags::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('meta-tags'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\MetaTags::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Route::currentRouteName())]); ?>
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
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <style>[x-cloak] { display: none !important; }</style>

    
    <?php $currentUrl = url()->current(); ?>
    <link rel="alternate" hreflang="es" href="<?php echo e($currentUrl); ?>" />
    <link rel="alternate" hreflang="en" href="<?php echo e($currentUrl); ?>" />
    <link rel="alternate" hreflang="x-default" href="<?php echo e($currentUrl); ?>" />

    
    <?php if (isset($component)) { $__componentOriginal4c0f6c0bd58a583f0b502ced662d3ed1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4c0f6c0bd58a583f0b502ced662d3ed1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.schema-org','data' => ['type' => 'WebSite']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('schema-org'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'WebSite']); ?>
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
    <?php if (isset($component)) { $__componentOriginal4c0f6c0bd58a583f0b502ced662d3ed1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4c0f6c0bd58a583f0b502ced662d3ed1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.schema-org','data' => ['type' => 'Organization','name' => config('app.name'),'url' => '/','description' => 'Software Engineer & Fullstack Developer especializado en arquitecturas backend, automatización de procesos y soluciones empresariales escalables.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('schema-org'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'Organization','name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(config('app.name')),'url' => '/','description' => 'Software Engineer & Fullstack Developer especializado en arquitecturas backend, automatización de procesos y soluciones empresariales escalables.']); ?>
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
    <?php if (! empty(trim($__env->yieldContent('schema')))): ?>
        <?php echo $__env->yieldContent('schema'); ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body>

    
    <nav class="border-b border-surface-border">
        <div class="container-page">
            <div class="flex justify-between h-16 items-center">
                <a href="<?php echo e(route('home')); ?>" class="text-xl font-bold tracking-tight text-white">
                    Clyrion <span class="text-brand-500">Studio</span>
                </a>
                
                <div class="hidden sm:flex items-center space-x-8">
                    <a href="<?php echo e(route('home')); ?>" class="text-sm text-gray-400 hover:text-brand-400 transition"><?php echo e(__('nav.home')); ?></a>
                    <a href="<?php echo e(route('about')); ?>" class="text-sm text-gray-400 hover:text-brand-400 transition"><?php echo e(__('nav.about')); ?></a>
                    <a href="<?php echo e(route('projects.index')); ?>" class="text-sm text-gray-400 hover:text-brand-400 transition"><?php echo e(__('nav.projects')); ?></a>
                    <a href="<?php echo e(route('blog.index')); ?>" class="text-sm text-gray-400 hover:text-brand-400 transition"><?php echo e(__('nav.blog')); ?></a>
                    <a href="<?php echo e(route('tutorials.index')); ?>" class="text-sm text-gray-400 hover:text-brand-400 transition"><?php echo e(__('nav.tutorials')); ?></a>
                    <a href="<?php echo e(route('home')); ?>#contacto" class="text-sm text-gray-400 hover:text-brand-400 transition"><?php echo e(__('nav.contact')); ?></a>
                </div>

                
                <div x-data="{ mobileOpen: false }" class="flex items-center gap-3">
                    
                    <button x-data="{ dark: document.documentElement.classList.contains('dark') }"
                            x-init="$watch('dark', val => { document.documentElement.classList.toggle('dark', val); localStorage.setItem('theme', val ? 'dark' : 'light'); })"
                            @click="dark = !dark"
                            class="p-2 rounded-lg text-gray-500 hover:text-gray-300 hover:bg-surface-hover transition"
                            aria-label="Toggle theme">
                        <svg x-show="!dark" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                        <svg x-show="dark" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </button>

                    
                    <div class="flex items-center gap-1 mr-2">
                        <a href="<?php echo e(route('locale.switch', 'es')); ?>" class="text-xs px-1.5 py-0.5 rounded <?php echo e(app()->getLocale() === 'es' ? 'text-brand-400 bg-brand-500/10' : 'text-gray-500 hover:text-gray-300'); ?> transition">ES</a>
                        <span class="text-gray-600">|</span>
                        <a href="<?php echo e(route('locale.switch', 'en')); ?>" class="text-xs px-1.5 py-0.5 rounded <?php echo e(app()->getLocale() === 'en' ? 'text-brand-400 bg-brand-500/10' : 'text-gray-500 hover:text-gray-300'); ?> transition">EN</a>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Route::has('login')): ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-sm text-gray-400 hover:text-brand-400 transition"><?php echo e(__('nav.dashboard')); ?></a>
                        <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>" class="text-sm text-gray-400 hover:text-brand-400 transition"><?php echo e(__('nav.login')); ?></a>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Route::has('register')): ?>
                                <a href="<?php echo e(route('register')); ?>" class="hidden sm:inline-flex text-sm px-4 py-2 bg-brand-600 hover:bg-brand-700 rounded-lg transition"><?php echo e(__('nav.register')); ?></a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    
                    <button @click="mobileOpen = !mobileOpen" class="sm:hidden p-2 rounded-lg text-gray-400 hover:text-white hover:bg-surface-hover transition" aria-label="Menú">
                        <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        <svg x-show="mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>

            
            <div x-show="mobileOpen" x-transition:enter="transition-transform ease-out duration-300" x-transition:enter-start="-translate-y-2 opacity-0" x-transition:enter-end="translate-y-0 opacity-100" x-transition:leave="transition-transform ease-in duration-200" x-transition:leave-start="translate-y-0 opacity-100" x-transition:leave-end="-translate-y-2 opacity-0" class="sm:hidden border-t border-surface-border bg-surface-card" style="display: none;">
                <div class="px-4 py-4 space-y-2">
                    <a href="<?php echo e(route('home')); ?>" class="block px-3 py-2 rounded-lg text-sm text-gray-300 hover:text-white hover:bg-surface-hover transition"><?php echo e(__('nav.home')); ?></a>
                    <a href="<?php echo e(route('about')); ?>" class="block px-3 py-2 rounded-lg text-sm text-gray-300 hover:text-white hover:bg-surface-hover transition"><?php echo e(__('nav.about')); ?></a>
                    <a href="<?php echo e(route('projects.index')); ?>" class="block px-3 py-2 rounded-lg text-sm text-gray-300 hover:text-white hover:bg-surface-hover transition"><?php echo e(__('nav.projects')); ?></a>
                    <a href="<?php echo e(route('blog.index')); ?>" class="block px-3 py-2 rounded-lg text-sm text-gray-300 hover:text-white hover:bg-surface-hover transition"><?php echo e(__('nav.blog')); ?></a>
                    <a href="<?php echo e(route('tutorials.index')); ?>" class="block px-3 py-2 rounded-lg text-sm text-gray-300 hover:text-white hover:bg-surface-hover transition"><?php echo e(__('nav.tutorials')); ?></a>
                    <a href="<?php echo e(route('home')); ?>#contacto" class="block px-3 py-2 rounded-lg text-sm text-gray-300 hover:text-white hover:bg-surface-hover transition"><?php echo e(__('nav.contact')); ?></a>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Route::has('login')): ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(route('admin.dashboard')); ?>" class="block px-3 py-2 rounded-lg text-sm text-brand-400 hover:text-brand-300 hover:bg-surface-hover transition"><?php echo e(__('nav.dashboard')); ?></a>
                        <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>" class="block px-3 py-2 rounded-lg text-sm text-gray-300 hover:text-white hover:bg-surface-hover transition"><?php echo e(__('nav.login')); ?></a>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Route::has('register')): ?>
                                <a href="<?php echo e(route('register')); ?>" class="block px-3 py-2 rounded-lg text-sm text-center bg-brand-600 hover:bg-brand-700 text-white transition"><?php echo e(__('nav.register')); ?></a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('components.flash-message', []);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2472937763-0', $__key);

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

    
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    
    <footer class="border-t border-surface-border py-8 text-center text-sm text-gray-500">
        <p>&copy; <?php echo e(date('Y')); ?> <span class="text-brand-400">Clyrion Studio</span> | JIMMY — <?php echo e(__('footer.copyright')); ?></p>
    </footer>

</body>
</html>
<?php /**PATH /var/www/resources/views/layouts/public.blade.php ENDPATH**/ ?>