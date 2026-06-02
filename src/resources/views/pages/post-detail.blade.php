@extends('layouts.public')

@section('title', ($post->meta_title ?: $post->title) . ' | Clyrion Studio | JIMMY')

@section('meta')
    <x-meta-tags
        :title="$post->meta_title ?: $post->title"
        :description="$post->meta_description ?: $post->excerpt"
    />
@endsection

@section('content')

<article class="section-padding">
    <div class="container-page">
        <div class="lg:grid lg:grid-cols-4 lg:gap-8">
            {{-- Article --}}
            <div class="lg:col-span-3">
                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-brand-400 transition mb-8 text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    {{ __('blog.back') }}
                </a>

                <header class="mb-8">
                    <div class="flex flex-wrap items-center gap-3 text-sm text-gray-500 mb-4">
                        @foreach ($post->categories as $cat)
                            <a href="{{ route('blog.category', $cat->slug) }}" class="px-2 py-0.5 rounded-full text-xs bg-brand-500/10 text-brand-400 hover:bg-brand-500/20 transition">{{ $cat->name }}</a>
                        @endforeach
                        @if ($post->published_at)
                            <span>{{ $post->published_at->format('d M, Y') }}</span>
                        @endif
                        <span>{{ $post->readingTime() }} {{ __('blog.reading_time') }}</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-4">{{ $post->title }}</h1>
                    @if ($post->excerpt)
                        <p class="text-lg text-gray-400 leading-relaxed">{{ $post->excerpt }}</p>
                    @endif
                </header>

                @if ($post->featured_image)
                    <div class="mb-8 rounded-xl overflow-hidden">
                        <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full h-auto object-cover">
                    </div>
                @endif

                @if ($post->content)
                    <div class="prose prose-invert max-w-none text-gray-300 leading-relaxed">
                        {{ $post->content }}
                    </div>
                @endif

                {{-- Tags --}}
                @if ($post->tagsRelation->isNotEmpty())
                    <div class="mt-8 pt-8 border-t border-surface-border">
                        <div class="flex flex-wrap gap-2">
                            @foreach ($post->tagsRelation as $tag)
                                <a href="{{ route('blog.tag', $tag->slug) }}" class="px-3 py-1 text-xs rounded-full bg-surface-card border border-surface-border text-gray-400 hover:text-brand-400 hover:border-brand-500/30 transition">#{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Related Posts --}}
                @if ($related->isNotEmpty())
                    <div class="mt-12 pt-8 border-t border-surface-border">
                        <h3 class="text-xl font-semibold text-white mb-6">{{ __('blog.related') }}</h3>
                        <div class="grid sm:grid-cols-2 gap-6">
                            @foreach ($related as $rel)
                                <a href="{{ route('blog.show', $rel->slug) }}" class="card-hover p-4 group">
                                    <div class="text-xs text-gray-500 mb-2">{{ $rel->published_at?->format('M Y') }} · {{ $rel->readingTime() }} {{ __('blog.reading_time') }}</div>
                                    <h4 class="text-sm font-semibold text-white group-hover:text-brand-400 transition">{{ $rel->title }}</h4>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <aside class="lg:col-span-1 mt-10 lg:mt-0 space-y-8">
                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">{{ __('blog.categories') }}</h3>
                    @if ($categories->isNotEmpty())
                        <div class="space-y-2">
                            @foreach ($categories as $cat)
                                <a href="{{ route('blog.category', $cat->slug) }}"
                                    class="flex items-center justify-between p-2 rounded-lg hover:bg-surface-hover transition text-sm group">
                                    <span class="text-gray-400 group-hover:text-brand-400 transition">{{ $cat->name }}</span>
                                    <span class="text-xs text-gray-600">{{ $cat->posts_count }}</span>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-gray-600">{{ __('blog.categories') }}</p>
                    @endif
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">{{ __('blog.popular_tags') }}</h3>
                    @if ($tags->isNotEmpty())
                        <div class="flex flex-wrap gap-2">
                            @foreach ($tags as $t)
                                <a href="{{ route('blog.tag', $t->slug) }}"
                                    class="text-xs px-2.5 py-1 rounded-full bg-surface-card border border-surface-border text-gray-400 hover:text-brand-400 hover:border-brand-500/30 transition">
                                    #{{ $t->name }}
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-gray-600">{{ __('blog.popular_tags') }}</p>
                    @endif
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">{{ __('blog.title') }}</h3>
                    @if ($recentPosts->isNotEmpty())
                        <div class="space-y-3">
                            @foreach ($recentPosts as $rp)
                                <a href="{{ route('blog.show', $rp->slug) }}" class="block p-2 rounded-lg hover:bg-surface-hover transition group">
                                    <h4 class="text-sm text-gray-400 group-hover:text-white transition line-clamp-2">{{ $rp->title }}</h4>
                                    <p class="text-xs text-gray-600 mt-1">{{ $rp->published_at?->format('d M Y') }}</p>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </aside>
        </div>
    </div>
</article>

@endsection
