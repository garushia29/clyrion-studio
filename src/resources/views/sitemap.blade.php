@php echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n"; @endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($urls as $url)
    <url>
        <loc>{{ $url['loc'] }}</loc>
        <lastmod>{{ now()->toDateString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>{{ $url['priority'] }}</priority>
    </url>
    @endforeach
</urlset>
