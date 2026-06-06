<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
    'disabled' => false,
    'type' => 'submit',
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
    'disabled' => false,
    'type' => 'submit',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$base = 'inline-flex items-center justify-center font-medium rounded-lg transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-surface disabled:pointer-events-none disabled:opacity-50';

$variants = [
    'primary' => 'bg-brand-600 text-white hover:bg-brand-700 focus:ring-brand-500',
    'secondary' => 'bg-surface-card text-gray-300 border border-surface-border hover:bg-surface-hover hover:text-white focus:ring-brand-500',
    'danger' => 'bg-red-600 text-white hover:bg-red-500 focus:ring-red-500',
    'ghost' => 'text-gray-400 hover:text-white hover:bg-surface-hover focus:ring-brand-500',
    'outline' => 'border border-surface-border text-gray-300 hover:text-white hover:bg-surface-hover focus:ring-brand-500',
];

$sizes = [
    'sm' => 'px-3 py-1.5 text-xs gap-1.5',
    'md' => 'px-4 py-2 text-sm gap-2',
    'lg' => 'px-6 py-3 text-base gap-2.5',
];

$classes = $base . ' ' . $variants[$variant] . ' ' . $sizes[$size];
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($href): ?>
    <a href="<?php echo e($href); ?>" <?php echo e($attributes->merge(['class' => $classes])); ?>>
        <?php echo e($slot); ?>

    </a>
<?php else: ?>
    <button type="<?php echo e($type); ?>" <?php if($disabled): echo 'disabled'; endif; ?> <?php echo e($attributes->merge(['class' => $classes])); ?>>
        <?php echo e($slot); ?>

    </button>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /var/www/resources/views/components/button.blade.php ENDPATH**/ ?>