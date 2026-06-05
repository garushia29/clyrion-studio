@props([
    'title' => '',
    'description' => '',
    'image' => null,
    'type' => 'website',
    'route' => null,
    'articlePublished' => null,
    'articleModified' => null,
    'articleAuthor' => null,
    'articleTags' => null,
    'profileFirstName' => null,
    'profileLastName' => null,
    'profileUsername' => null,
    'twitterSite' => null,
    'twitterCreator' => null,
    'fbAppId' => null,
    'imageWidth' => null,
    'imageHeight' => null,
])

@php
    $siteName = config('app.name', 'Clyrion Studio | JIMMY');
    $url = url()->current();
    $locale = str_replace('_', '-', app()->getLocale());

    // Use SeoSettings as fallback when route is provided and no explicit override
    if ($route) {
        $seo = \App\Models\SeoSettings::forRoute($route);
        if ($seo) {
            $title = $title ?: $seo->title;
            $description = $description ?: $seo->description;
            $image = $image ?: ($seo->image ? asset($seo->image) : null);
            $type = $type ?: $seo->type;
        }
    }

    $image = $image ?? asset('images/og-default.svg');
    $imageSecureUrl = $image;
@endphp

<meta name="description" content="{{ $description }}">

<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ $image }}">
@if ($imageWidth)<meta property="og:image:width" content="{{ $imageWidth }}">@endif
@if ($imageHeight)<meta property="og:image:height" content="{{ $imageHeight }}">@endif
<meta property="og:image:secure_url" content="{{ $imageSecureUrl }}">
<meta property="og:url" content="{{ $url }}">
<meta property="og:type" content="{{ $type }}">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:locale" content="{{ $locale }}">

@if ($type === 'article' && $articlePublished)
<meta property="article:published_time" content="{{ $articlePublished }}">
@endif
@if ($type === 'article' && $articleModified)
<meta property="article:modified_time" content="{{ $articleModified }}">
@endif
@if ($type === 'article' && $articleAuthor)
<meta property="article:author" content="{{ $articleAuthor }}">
@endif
@if ($type === 'article' && $articleTags)
<meta property="article:tag" content="{{ $articleTags }}">
@endif

@if ($type === 'profile')
@if ($profileFirstName)<meta property="profile:first_name" content="{{ $profileFirstName }}">@endif
@if ($profileLastName)<meta property="profile:last_name" content="{{ $profileLastName }}">@endif
@if ($profileUsername)<meta property="profile:username" content="{{ $profileUsername }}">@endif
@endif

@if ($fbAppId)
<meta property="fb:app_id" content="{{ $fbAppId }}">
@endif

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $image }}">
@if ($twitterSite)<meta name="twitter:site" content="{{ $twitterSite }}">@endif
@if ($twitterCreator)<meta name="twitter:creator" content="{{ $twitterCreator }}">@endif

<link rel="canonical" href="{{ $url }}">
