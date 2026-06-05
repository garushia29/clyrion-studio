<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['wire' => '', 'id' => 'trix-' . Str::random(8), 'value' => '', 'placeholder' => '']));

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

foreach (array_filter((['wire' => '', 'id' => 'trix-' . Str::random(8), 'value' => '', 'placeholder' => '']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div wire:ignore x-data="{
    value: '<?php echo e($value); ?>',
    init() {
        const editor = this.$refs.trix;
        editor.editor?.loadHTML(this.value);
        this.$watch('value', (val) => {
            if (document.activeElement !== editor) {
                editor.editor?.loadHTML(val);
            }
        });
    }
}">
    <input type="hidden" <?php echo e($wire); ?> :value="value" />
    <trix-editor
        x-ref="trix"
        id="<?php echo e($id); ?>"
        placeholder="<?php echo e($placeholder); ?>"
        class="trix-content"
        x-on:trix-change="$wire.set('<?php echo e($attributes->get('wire:model')); ?>', $event.target.value)"
        style="min-height: 300px;"
    ></trix-editor>
</div>

<?php $__env->startPush('styles'); ?>
<style>
    trix-editor {
        @apply w-full border border-surface-input bg-surface-card text-gray-200 rounded-md shadow-sm;
        min-height: 300px;
    }
    trix-editor:focus {
        @apply border-brand-500 ring-1 ring-brand-500;
    }
    trix-toolbar {
        @apply border-b border-surface-input bg-surface-card rounded-t-md p-2;
        position: sticky;
        top: 0;
        z-index: 10;
    }
    trix-toolbar .trix-button-group {
        @apply border border-surface-border rounded-md mb-0;
    }
    trix-toolbar .trix-button {
        @apply border-0 text-gray-400 hover:text-white hover:bg-surface-hover;
    }
    trix-toolbar .trix-button.trix-active {
        @apply text-brand-400 bg-brand-500/10;
    }
    .trix-content {
        @apply text-gray-200;
    }
    .trix-content a {
        @apply text-brand-400;
    }
    .trix-content blockquote {
        @apply border-l-4 border-brand-500/50 pl-4 italic text-gray-400;
    }
    .trix-content pre {
        @apply bg-surface border border-surface-border rounded-md p-4 text-sm font-mono text-gray-300;
    }
    .trix-content code {
        @apply bg-surface px-1.5 py-0.5 rounded text-sm font-mono text-brand-400;
    }
    .trix-content ul, .trix-content ol {
        @apply pl-6;
    }
    .trix-content h1 {
        @apply text-2xl font-bold text-white mt-6 mb-3;
    }
    .trix-content h2 {
        @apply text-xl font-bold text-white mt-5 mb-2;
    }
    .trix-content p {
        @apply mb-3 leading-relaxed;
    }
    .trix-content img {
        @apply rounded-lg max-w-full h-auto my-4;
    }
</style>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/resources/views/components/trix-editor.blade.php ENDPATH**/ ?>