@extends('layouts.public')

@section('title', isset($category) ? "{$category->name} | " . __('blog.title') . " | Clyrion Studio" : (isset($tag) ? "#{$tag->name} | " . __('blog.title') . " | Clyrion Studio" : __('blog.title') . ' | Clyrion Studio | JIMMY'))

@section('meta')
    <x-meta-tags
        title="{{ isset($category) ? $category->name . ' | ' . __('blog.title') : (isset($tag) ? '#' . $tag->name . ' | ' . __('blog.title') : __('blog.title')) }} | Clyrion Studio | JIMMY"
        description="{{ isset($category) ? __('blog.title') . ' ' . $category->name : (isset($tag) ? __('blog.title') . ' ' . $tag->name : __('blog.subtitle')) }}"
    />
@endsection

@section('content')

<section class="section-padding">
    <div class="container-page">
        <div class="text-center mb-12">
            <p class="text-brand-400 mb-4 uppercase tracking-widest text-sm font-medium">{{ __('blog.title') }}</p>
            <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4">
                @if (isset($category))
                    {{ $category->name }}
                @elseif (isset($tag))
                    #{{ $tag->name }}
                @else
                    {{ __('blog.title') }}
                @endif
            </h1>
            @if (isset($category))
                <p class="text-gray-400 max-w-2xl mx-auto">{{ $category->description ?: __('blog.title') . ' ' . $category->name }}</p>
            @elseif (isset($tag))
                <p class="text-gray-400 max-w-2xl mx-auto">{{ __('blog.title') }} #{{ $tag->name }}</p>
            @else
                <p class="text-gray-400 max-w-2xl mx-auto">{{ __('blog.subtitle') }}</p>
            @endif
        </div>

        <div class="lg:grid lg:grid-cols-4 lg:gap-8">
            {{-- Main --}}
            <div class="lg:col-span-3">
                @if (!isset($category) && !isset($tag))
                    <form method="GET" action="{{ route('blog.index') }}" class="mb-8">
                        <div class="relative">
                            <input type="text" name="search" placeholder="{{ __('blog.search') }}" value="{{ request('search') }}"
                                class="w-full pl-10 pr-4 py-2.5 bg-surface-card border border-surface-input rounded-lg text-gray-200 placeholder-gray-500 focus:border-brand-500 focus:ring-brand-500 text-sm transition">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </form>
                @endif

                @if (request('search'))
                    <p class="text-sm text-gray-500 mb-6">{{ __('blog.search') }}: <span class="text-gray-300">"{{ request('search') }}"</span></p>
                @endif

                <div class="grid sm:grid-cols-2 gap-6">
                    @forelse ($posts as $post)
                        <a href="{{ route('blog.show', $post->slug) }}" class="card-hover p-5 group flex flex-col">
                            <div class="flex items-center gap-3 mb-3 text-xs text-gray-500">
                                <span>{{ $post->published_at?->format('M Y') }}</span>
                                <span>{{ $post->readingTime() }} {{ __('blog.reading_time') }}</span>
                                @foreach ($post->categories as $cat)
                                    <span class="px-2 py-0.5 rounded-full bg-brand-500/10 text-brand-400">{{ $cat->name }}</span>
                                @endforeach
                            </div>
                            <h2 class="text-lg font-semibold text-white mb-2 group-hover:text-brand-400 transition flex-1">{{ $post->title }}</h2>
                            @if ($post->excerpt)
                                <p class="text-gray-400 text-sm line-clamp-2">{{ $post->excerpt }}</p>
                            @endif
                            @if ($post->tagsRelation->isNotEmpty())
                                <div class="flex flex-wrap gap-1.5 mt-3">
                                    @foreach ($post->tagsRelation as $tag)
                                        <span class="text-xs text-gray-600">#{{ $tag->name }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </a>
                    @empty
                        <div class="col-span-full text-center py-20 text-gray-500">
                            <p class="text-lg">{{ __('blog.empty') }}</p>
                        </div>
                    @endforelse
                </div>

                @if ($posts->hasPages())
                    <div class="mt-12">
                        {{ $posts->links() }}
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <aside class="lg:col-span-1 mt-10 lg:mt-0 space-y-8">
                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">{{ __('blog.categories') }}</h3>
                    @php $allCategories = \App\Models\Category::whereHas('posts')->withCount('posts')->orderByDesc('posts_count')->get(); @endphp
                    @if ($allCategories->isNotEmpty())
                        <div class="space-y-2">
                            @foreach ($allCategories as $cat)
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
                    @php $allTags = \App\Models\Tag::whereHas('posts')->withCount('posts')->orderByDesc('posts_count')->take(15)->get(); @endphp
                    @if ($allTags->isNotEmpty())
                        <div class="flex flex-wrap gap-2">
                            @foreach ($allTags as $t)
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
            </aside>
        </div>
    </div>
</section>

@endsection
