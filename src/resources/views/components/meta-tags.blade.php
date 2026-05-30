@php
    $siteName = config('app.name', 'Clyrion Studio | JIMMY');
    $url = url()->current();
    $image = $image ?? asset('images/og-default.png');
@endphp

<meta name="description" content="{{ $description }}">

<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:url" content="{{ $url }}">
<meta property="og:type" content="{{ $type }}">
<meta property="og:site_name" content="{{ $siteName }}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $image }}">

<link rel="canonical" href="{{ $url }}">
