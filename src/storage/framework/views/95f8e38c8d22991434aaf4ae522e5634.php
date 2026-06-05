<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'type' => 'Organization',
    'name' => null,
    'description' => null,
    'image' => null,
    'url' => null,
    'headline' => null,
    'datePublished' => null,
    'dateModified' => null,
    'authorName' => null,
    'publisherName' => null,
    'publisherLogo' => null,
    'sameAs' => null,
    'educationalLevel' => null,
    'breadcrumbs' => null,
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
    'type' => 'Organization',
    'name' => null,
    'description' => null,
    'image' => null,
    'url' => null,
    'headline' => null,
    'datePublished' => null,
    'dateModified' => null,
    'authorName' => null,
    'publisherName' => null,
    'publisherLogo' => null,
    'sameAs' => null,
    'educationalLevel' => null,
    'breadcrumbs' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $orgId = url('/') . '#organization';
    $siteName = config('app.name', 'Clyrion Studio | JIMMY');

    $schema = match ($type) {
        'WebSite' => [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => $name ?: $siteName,
            'url' => $url ?: url('/'),
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => [
                    '@type' => 'EntryPoint',
                    'urlTemplate' => url('/blog?search={search_term_string}'),
                ],
                'query-input' => 'required name=search_term_string',
            ],
        ],
        'BreadcrumbList' => [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $breadcrumbs ?: [],
        ],
        'Article' => [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $headline ?: $name,
            'description' => $description,
            'image' => $image,
            'datePublished' => $datePublished,
            'dateModified' => $dateModified ?: $datePublished,
            'author' => ['@type' => 'Person', 'name' => $authorName ?: 'JIMMY', 'url' => url('/about')],
            'publisher' => [
                '@type' => 'Organization',
                '@id' => $orgId,
                'name' => $publisherName ?: $siteName,
                'logo' => $publisherLogo ?: ['@type' => 'ImageObject', 'url' => asset('images/og-default.svg')],
            ],
            'mainEntityOfPage' => ['@type' => 'WebPage', '@id' => $url ?: url()->current()],
        ],
        'Project' => [
            '@context' => 'https://schema.org',
            '@type' => 'CreativeWork',
            'name' => $name,
            'description' => $description,
            'image' => $image,
            'datePublished' => $datePublished,
            'author' => ['@type' => 'Person', 'name' => $authorName ?: 'JIMMY', 'url' => url('/about')],
        ],
        'Tutorial' => [
            '@context' => 'https://schema.org',
            '@type' => 'LearningResource',
            'name' => $name,
            'description' => $description,
            'image' => $image,
            'datePublished' => $datePublished,
            'author' => ['@type' => 'Person', 'name' => $authorName ?: 'JIMMY', 'url' => url('/about')],
            'educationalLevel' => $educationalLevel ?: 'beginner',
        ],
        'Person' => [
            '@context' => 'https://schema.org',
            '@type' => 'Person',
            'name' => $name ?: 'JIMMY',
            'description' => $description,
            'url' => $url ?: url('/'),
            'image' => $image,
            'jobTitle' => 'Software Engineer & Fullstack Developer',
            'sameAs' => $sameAs ?: [
                'https://github.com/jimmy',
                'https://linkedin.com/in/jimmy',
            ],
        ],
        default => [
            '@context' => 'https://schema.org',
            '@type' => $type,
            'name' => $name ?: $siteName,
            'description' => $description,
            'url' => $url ?: url('/'),
            'image' => $image,
        ],
    };
?>

<script type="application/ld+json"><?php echo json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?></script>
<?php /**PATH /var/www/resources/views/components/schema-org.blade.php ENDPATH**/ ?>