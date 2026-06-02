@php echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n"; @endphp
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>Clyrion Studio | Blog</title>
        <link>{{ url('/blog') }}</link>
        <description>Artículos sobre desarrollo web, Laravel, arquitectura de software y soluciones enterprise.</description>
        <language>es</language>
        <atom:link href="{{ url('/blog/feed.xml') }}" rel="self" type="application/rss+xml"/>
        @foreach ($posts as $post)
            <item>
                <title>{{ $post->title }}</title>
                <link>{{ route('blog.show', $post->slug) }}</link>
                <guid>{{ route('blog.show', $post->slug) }}</guid>
                <description>{{ $post->excerpt ?? $post->title }}</description>
                <pubDate>{{ $post->published_at->toRssString() }}</pubDate>
                @foreach ($post->categories as $cat)
                    <category>{{ $cat->name }}</category>
                @endforeach
            </item>
        @endforeach
    </channel>
</rss>
