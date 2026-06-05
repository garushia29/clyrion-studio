@props([
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
])

@php
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
@endphp

<script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
