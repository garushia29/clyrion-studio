@php echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n"; @endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">
    @foreach ($urls as $url)
    <url>
        <loc>{{ $url['loc'] }}</loc>
        @if (!empty($url['lastmod']))
        <lastmod>{{ $url['lastmod'] }}</lastmod>
        @endif
        <changefreq>{{ $url['changefreq'] ?? 'monthly' }}</changefreq>
        <priority>{{ $url['priority'] }}</priority>
@isset($url['images'])
@foreach ($url['images'] as $img)
        <image:image>
            <image:loc>{{ $img }}</image:loc>
        </image:image>
@endforeach
@endisset
    </url>
    @endforeach
</urlset>
