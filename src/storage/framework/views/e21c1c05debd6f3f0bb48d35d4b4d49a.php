<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'variant' => 'neutral',
    'size' => 'sm',
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
    'variant' => 'neutral',
    'size' => 'sm',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$variants = [
    'success' => 'bg-green-500/10 text-green-400 border-green-500/20',
    'warning' => 'bg-yellow-500/10 text-yellow-400 border-yellow-500/20',
    'danger' => 'bg-red-500/10 text-red-400 border-red-500/20',
    'info' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
    'brand' => 'bg-brand-500/10 text-brand-400 border-brand-500/20',
    'neutral' => 'bg-gray-500/10 text-gray-400 border-gray-500/20',
];

$sizes = [
    'sm' => 'px-2 py-0.5 text-xs',
    'md' => 'px-2.5 py-1 text-sm',
];

$classes = 'inline-flex items-center font-medium rounded-full border ' . $variants[$variant] . ' ' . $sizes[$size];
?>

<span <?php echo e($attributes->merge(['class' => $classes])); ?>>
    <?php echo e($slot); ?>

</span>
<?php /**PATH /var/www/resources/views/components/badge.blade.php ENDPATH**/ ?>