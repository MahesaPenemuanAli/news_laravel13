<x-app-layout>
    @section('title', ($article->meta_title ?? $article->title) . ' - Portal Berita')
    @section('meta_description', $article->meta_description ?? $article->excerpt ?? Str::limit(strip_tags($article->content), 160))
    @section('og_type', 'article')
    @section('og_image', $article->hasMedia('images') ? $article->getFirstMediaUrl('images', 'webp-full') : asset('images/default-share.png'))

    @section('json_ld')
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@graph": [
            {
                "@@type": "NewsArticle",
                "@@id": "{{ request()->url() }}#article",
                "isPartOf": {
                    "@@type": "WebPage",
                    "@@id": "{{ request()->url() }}",
                    "url": "{{ request()->url() }}",
                    "name": "{{ e($article->meta_title ?? $article->title) }}"
                },
                "headline": "{{ e($article->title) }}",
                "image": [
                    "{{ $article->hasMedia('images') ? $article->getFirstMediaUrl('images', 'webp-full') : asset('images/default-share.png') }}"
                ],
                "datePublished": "{{ $article->published_at ? $article->published_at->toIso8601String() : $article->created_at->toIso8601String() }}",
                "dateModified": "{{ $article->updated_at->toIso8601String() }}",
                "author": {
                    "@@type": "Person",
                    "name": "{{ e($article->author->name ?? 'Redaksi') }}",
                    "url": "{{ route('author.show', $article->author->id) }}"
                },
                "publisher": {
                    "@@type": "Organization",
                    "name": "{{ e(config('app.name', 'Portal Berita')) }}",
                    "logo": {
                        "@@type": "ImageObject",
                        "url": "{{ asset('images/default-share.png') }}"
                    }
                },
                "description": "{{ e($article->meta_description ?? $article->excerpt ?? Str::limit(strip_tags($article->content), 160)) }}"
            },
            {
                "@@type": "BreadcrumbList",
                "@@id": "{{ request()->url() }}#breadcrumb",
                "itemListElement": [
                    {
                        "@@type": "ListItem",
                        "position": 1,
                        "name": "Beranda",
                        "item": "{{ route('home') }}"
                    },
                    @if($article->category)
                    {
                        "@@type": "ListItem",
                        "position": 2,
                        "name": "{{ e($article->category->name) }}",
                        "item": "{{ route('category.show', $article->category->slug) }}"
                    },
                    @endif
                    {
                        "@@type": "ListItem",
                        "position": {{ $article->category ? 3 : 2 }},
                        "name": "{{ e($article->title) }}",
                        "item": "{{ request()->url() }}"
                    }
                ]
            }
        ]
    }
    </script>
    @endsection

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">

        <!-- Breadcrumb -->
        <nav class="flex text-sm text-gray-500 dark:text-gray-400 mb-8 overflow-x-auto whitespace-nowrap pb-2" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                        Beranda
                    </a>
                </li>
                @if($article->category)
                <li>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <a href="{{ route('category.show', $article->category->slug) }}" class="ml-1 md:ml-2 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">{{ $article->category->name }}</a>
                    </div>
                </li>
                @endif
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <span class="ml-1 md:ml-2 text-gray-400 dark:text-gray-500 max-w-[200px] sm:max-w-xs truncate">{{ $article->title }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header Ad Banner -->
        <x-ad-banner position="header" />

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 my-8">
            <!-- Main Article Content Area -->
            <article class="lg:col-span-8 bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 p-6 md:p-10">

                <!-- Article Meta & Title -->
                <header class="mb-8">
                    @if($article->category)
                        <a href="{{ route('category.show', $article->category->slug) }}" class="inline-block px-3 py-1 mb-4 text-xs font-bold uppercase tracking-wider text-white bg-blue-600 rounded-full hover:bg-blue-700 transition-colors">
                            {{ $article->category->name }}
                        </a>
                    @endif

                    <h1 class="text-3xl md:text-5xl font-black text-gray-900 dark:text-white leading-tight mb-6">
                        {{ $article->title }}
                    </h1>

                    <div class="flex flex-wrap items-center text-sm text-gray-500 dark:text-gray-400 gap-4 md:gap-6 border-b border-gray-100 dark:border-gray-800 pb-6">
                        <div class="flex items-center">
                            <a href="{{ route('author.show', $article->author->id) }}" class="flex items-center group">
                                <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-700 dark:text-blue-300 font-bold text-sm uppercase overflow-hidden mr-3 group-hover:bg-blue-200 transition-colors">
                                    @if($article->author->profile && $article->author->profile->photo)
                                        <img src="{{ Storage::url($article->author->profile->photo) }}" alt="{{ $article->author->name }}" class="w-full h-full object-cover">
                                    @else
                                        {{ substr($article->author->name ?? 'A', 0, 1) }}
                                    @endif
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 dark:text-gray-200 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">{{ $article->author->name ?? 'Admin' }}</p>
                                    @if($article->author->profile && $article->author->profile->expertise)
                                        <p class="text-xs text-blue-500">{{ $article->author->profile->expertise }}</p>
                                    @endif
                                </div>
                            </a>
                        </div>

                        <div class="flex items-center ml-auto md:ml-0 border-l border-gray-200 dark:border-gray-700 pl-4 md:pl-6">
                            <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            {{ $article->published_at ? $article->published_at->format('d M Y, H:i') : $article->created_at->format('d M Y, H:i') }}
                        </div>

                        <div class="flex items-center border-l border-gray-200 dark:border-gray-700 pl-4 md:pl-6">
                            <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            {{ number_format($article->views_count) }} dibaca
                        </div>
                    </div>

                    <div class="mt-6">
                        <livewire:bookmark-button :article="$article" />
                    </div>
                </header>

                <!-- Featured Image -->
                @if($article->hasMedia('images'))
                    <figure class="mb-10 w-full overflow-hidden rounded-xl bg-gray-100 dark:bg-gray-800">
                        <img src="{{ $article->getFirstMediaUrl('images', 'webp-full') }}" alt="{{ $article->title }}" class="w-full h-auto object-cover max-h-[500px]">
                        @if($article->getFirstMedia('images')?->getCustomProperty('caption'))
                            <figcaption class="mt-3 text-center text-sm text-gray-500 italic pb-2">
                                {{ $article->getFirstMedia('images')->getCustomProperty('caption') }}
                            </figcaption>
                        @endif
                    </figure>
                @endif

                <livewire:article-live-updates :article="$article" />

                <!-- Article Content Typography with In-Content Ad -->
                <div class="prose prose-lg dark:prose-invert max-w-none prose-blue prose-img:rounded-xl prose-a:text-blue-600 dark:prose-a:text-blue-400 prose-headings:font-bold prose-p:leading-relaxed">
                    @php
                        // Membagi artikel berdasarkan tag paragraf penutup
                        $paragraphs = explode('</p>', $article->content);
                        $middleIndex = floor(count($paragraphs) / 2);
                    @endphp

                    @foreach($paragraphs as $index => $paragraph)
                        <!-- Render paragraph -->
                        {!! $paragraph !!}{!! trim($paragraph) ? '</p>' : '' !!}

                        <!-- Inject In-Content Ad Banner di tengah-tengah artikel -->
                        @if($index === $middleIndex && count($paragraphs) >= 3)
                            <div class="not-prose my-10">
                                <x-ad-banner position="in_content" />
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Share Buttons -->
                <div class="mt-10 pt-6 border-t border-gray-100 dark:border-gray-800" x-data="{ copied: false }">
                    <div class="flex items-center justify-between flex-wrap gap-4">
                        <h4 class="text-sm font-bold text-gray-900 dark:text-white uppercase">Bagikan Artikel:</h4>
                        <div class="flex items-center gap-2">
                            <!-- Facebook -->
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" rel="noopener noreferrer"
                               class="w-10 h-10 rounded-full bg-blue-600 hover:bg-blue-700 text-white flex items-center justify-center transition-all duration-200 hover:scale-110">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                            </a>
                            <!-- Twitter/X -->
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($article->title) }}" target="_blank" rel="noopener noreferrer"
                               class="w-10 h-10 rounded-full bg-gray-900 dark:bg-gray-700 hover:bg-gray-800 dark:hover:bg-gray-600 text-white flex items-center justify-center transition-all duration-200 hover:scale-110">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            </a>
                            <!-- LinkedIn -->
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank" rel="noopener noreferrer"
                               class="w-10 h-10 rounded-full bg-blue-700 hover:bg-blue-800 text-white flex items-center justify-center transition-all duration-200 hover:scale-110">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            </a>
                            <!-- Copy Link -->
                            <button @click="navigator.clipboard.writeText(window.location.href); copied = true; setTimeout(() => copied = false, 2000)"
                                    class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300 flex items-center justify-center transition-all duration-200 hover:scale-110 relative">
                                <svg x-show="!copied" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg>
                                <svg x-show="copied" x-cloak class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            </button>
                        </div>
                    </div>
                    <div x-show="copied" x-cloak x-transition class="mt-2 text-xs text-green-600 dark:text-green-400 font-medium">✓ Link berhasil disalin!</div>
                </div>

                <!-- Tags -->
                @if($article->tags->isNotEmpty())
                <div class="mt-8 pt-6 border-t border-gray-100 dark:border-gray-800">
                    <h4 class="text-sm font-bold text-gray-900 dark:text-white uppercase mb-4">Topik Terkait:</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach($article->tags as $tag)
                            <a href="#" class="inline-block bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-blue-100 dark:hover:bg-blue-900 hover:text-blue-700 dark:hover:text-blue-300 px-3 py-1.5 rounded-lg text-sm font-medium transition-colors">
                                #{{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Author Bio Box -->
                <a href="{{ route('author.show', $article->author->id) }}" class="mt-10 grid grid-cols-[auto_1fr] items-center bg-gray-50 dark:bg-gray-800/50 rounded-xl p-6 border border-gray-100 dark:border-gray-700 hover:shadow-md transition-shadow group">
                    <div class="w-16 h-16 rounded-full bg-blue-100 dark:bg-blue-900 flex-shrink-0 flex items-center justify-center text-blue-700 dark:text-blue-300 font-bold text-2xl uppercase overflow-hidden mr-4 shadow-sm group-hover:scale-105 transition-transform">
                        @if($article->author->profile && $article->author->profile->photo)
                            <img src="{{ Storage::url($article->author->profile->photo) }}" alt="{{ $article->author->name }}" class="w-full h-full object-cover">
                        @else
                            {{ substr($article->author->name ?? 'A', 0, 1) }}
                        @endif
                    </div>
                    <div>
                        <h4 class="font-bold text-lg text-gray-900 dark:text-white group-hover:text-blue-600 transition-colors">{{ $article->author->name ?? 'Admin' }}</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1 line-clamp-2">{{ $article->author->profile->bio ?? 'Jurnalis profesional di Portal Berita. Menyajikan berita dengan tajam, berimbang, dan tepercaya.' }}</p>
                    </div>
                </a>

                <livewire:article-comments :article="$article" />
            </article>

            <!-- Sticky Sidebar Area -->
            <aside class="lg:col-span-4 space-y-8">
                <div class="sticky top-24 space-y-8">
                    <!-- Sidebar Ad Banner -->
                    <x-ad-banner position="sidebar" />

                    <!-- Related Articles Widget -->
                    @if($relatedArticles->isNotEmpty())
                    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 p-6">
                        <h3 class="text-lg font-black text-gray-900 dark:text-white mb-6 uppercase tracking-wider border-l-4 border-blue-600 pl-3">Terkait</h3>
                        <div class="space-y-5">
                            @foreach($relatedArticles as $index => $related)
                            <a href="{{ route('article.show', $related->slug) }}" class="flex gap-4 group">
                                <span class="text-2xl font-black text-gray-200 dark:text-gray-700 group-hover:text-blue-500 transition-colors leading-none min-w-[1.5rem]">{{ $loop->iteration }}</span>
                                <div class="flex-1 flex flex-col justify-center min-w-0">
                                    <h4 class="text-sm font-bold text-gray-900 dark:text-white leading-snug group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors line-clamp-3">
                                        {{ $related->title }}
                                    </h4>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-2 flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        {{ $related->published_at ? $related->published_at->diffForHumans() : $related->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </a>
                            @if(!$loop->last)
                                <div class="border-b border-gray-100 dark:border-gray-700"></div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Jajak Pendapat / Poll Widget -->
                    <livewire:poll-widget />

                    <!-- Subscription Widget -->
                    <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl shadow-lg p-6 text-white">
                        <h3 class="text-lg font-bold mb-2 text-center">📬 Berlangganan</h3>
                        <p class="text-sm text-blue-100 text-center mb-4">Dapatkan berita terbaru langsung ke inbox Anda.</p>
                        <livewire:newsletter-form variant="dark" />
                    </div>
                </div>
            </aside>
        </div>
    </div>
</x-app-layout>
