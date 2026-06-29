<x-app-layout>
    @section('title', $category->name . ' - Portal Berita')
    @section('meta_description', $category->description ?? 'Kumpulan berita ' . $category->name . ' terkini dan terpercaya.')

    @section('json_ld')
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "BreadcrumbList",
        "itemListElement": [
            {
                "@@type": "ListItem",
                "position": 1,
                "name": "Beranda",
                "item": "{{ route('home') }}"
            },
            @if($category->parent)
            {
                "@@type": "ListItem",
                "position": 2,
                "name": "{{ e($category->parent->name) }}",
                "item": "{{ route('category.show', $category->parent->slug) }}"
            },
            @endif
            {
                "@@type": "ListItem",
                "position": {{ $category->parent ? 3 : 2 }},
                "name": "{{ e($category->name) }}",
                "item": "{{ request()->url() }}"
            }
        ]
    }
    </script>
    @endsection

    @php
        $mainArticle = $heroArticles->first();
        $sideArticles = $heroArticles->skip(1)->take(3);
    @endphp

    <div class="bg-white dark:bg-gray-950">
        <section class="relative overflow-hidden border-b border-gray-100 bg-slate-950 text-white dark:border-gray-800">
            <div class="absolute inset-0 opacity-30">
                <div class="absolute -left-24 top-10 h-72 w-72 rounded-full bg-blue-500 blur-3xl"></div>
                <div class="absolute right-0 top-0 h-80 w-80 rounded-full bg-red-500 blur-3xl"></div>
            </div>

            <div class="relative mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
                <nav class="mb-8 flex overflow-x-auto text-sm text-gray-300" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center gap-2 whitespace-nowrap">
                        <li>
                            <a href="{{ route('home') }}" class="font-semibold transition-colors hover:text-white">Beranda</a>
                        </li>
                        @if($category->parent)
                            <li class="text-gray-500">/</li>
                            <li>
                                <a href="{{ route('category.show', $category->parent->slug) }}" class="font-semibold transition-colors hover:text-white">{{ $category->parent->name }}</a>
                            </li>
                        @endif
                        <li class="text-gray-500">/</li>
                        <li class="font-bold text-white">{{ $category->name }}</li>
                    </ol>
                </nav>

                <div class="grid gap-8 lg:grid-cols-12 lg:items-end">
                    <div class="lg:col-span-8">
                        <div class="mb-4 inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/10 px-4 py-2 text-xs font-black uppercase tracking-[0.25em] text-blue-100 backdrop-blur">
                            <span class="h-2 w-2 rounded-full bg-red-500"></span>
                            Kanal Berita
                        </div>
                        <h1 class="max-w-4xl text-4xl font-black tracking-tight md:text-6xl">
                            {{ $category->name }}
                        </h1>
                        <p class="mt-5 max-w-3xl text-base leading-8 text-gray-300 md:text-lg">
                            {{ $category->description ?: 'Berita ' . $category->name . ' terbaru, analisis mendalam, dan update penting yang disusun redaksi untuk membantu Anda mengikuti perkembangan terkini.' }}
                        </p>
                    </div>

                    <div class="grid grid-cols-3 gap-3 lg:col-span-4">
                        <div class="rounded-2xl border border-white/10 bg-white/10 p-4 backdrop-blur">
                            <span class="block text-2xl font-black">{{ number_format($heroArticles->count() + $articles->total()) }}</span>
                            <span class="mt-1 block text-xs font-semibold uppercase tracking-wide text-gray-300">Artikel</span>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/10 p-4 backdrop-blur">
                            <span class="block text-2xl font-black">{{ $category->children->count() }}</span>
                            <span class="mt-1 block text-xs font-semibold uppercase tracking-wide text-gray-300">Subkanal</span>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/10 p-4 backdrop-blur">
                            <span class="block text-2xl font-black">Live</span>
                            <span class="mt-1 block text-xs font-semibold uppercase tracking-wide text-gray-300">Update</span>
                        </div>
                    </div>
                </div>

                @if($category->children->isNotEmpty() || $siblingCategories->isNotEmpty())
                    <div class="mt-8 flex gap-2 overflow-x-auto pb-1">
                        @foreach($category->children->merge($siblingCategories)->take(10) as $relatedCategory)
                            <a href="{{ route('category.show', $relatedCategory->slug) }}" class="whitespace-nowrap rounded-full bg-white px-4 py-2 text-sm font-bold text-slate-900 transition-colors hover:bg-blue-50 hover:text-blue-700">
                                {{ $relatedCategory->name }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
            <x-ad-banner position="header" />

            @if($mainArticle)
                <section class="mt-8 grid gap-6 lg:grid-cols-12">
                    <article class="group relative overflow-hidden rounded-[2rem] bg-gray-900 shadow-2xl shadow-gray-900/10 lg:col-span-7">
                        <a href="{{ route('article.show', $mainArticle->slug) }}" class="block min-h-[420px] lg:min-h-[560px]">
                            @if($mainArticle->hasMedia('images'))
                                <img src="{{ $mainArticle->getFirstMediaUrl('images', 'webp-full') }}" alt="{{ $mainArticle->title }}" class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                            @else
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-900 to-slate-950"></div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/50 to-transparent"></div>
                            <div class="absolute inset-x-0 bottom-0 p-6 md:p-8">
                                <span class="mb-4 inline-flex rounded-full bg-blue-600 px-3 py-1 text-xs font-black uppercase tracking-wide text-white">Headline {{ $category->name }}</span>
                                <h2 class="max-w-3xl text-3xl font-black leading-tight text-white md:text-5xl">
                                    {{ $mainArticle->title }}
                                </h2>
                                <p class="mt-4 line-clamp-2 max-w-2xl text-sm leading-7 text-gray-300 md:text-base">
                                    {{ $mainArticle->excerpt ?? Str::limit(strip_tags($mainArticle->content), 170) }}
                                </p>
                                <div class="mt-5 flex flex-wrap items-center gap-3 text-xs font-semibold text-gray-300">
                                    <span>{{ $mainArticle->author->name ?? 'Redaksi' }}</span>
                                    <span class="h-1 w-1 rounded-full bg-gray-500"></span>
                                    <span>{{ $mainArticle->published_at ? $mainArticle->published_at->diffForHumans() : $mainArticle->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </a>
                    </article>

                    <div class="grid gap-6 lg:col-span-5">
                        @foreach($sideArticles as $article)
                            <article class="group overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-sm transition-all hover:-translate-y-1 hover:shadow-xl dark:border-gray-800 dark:bg-gray-900">
                                <a href="{{ route('article.show', $article->slug) }}" class="grid gap-4 p-4 sm:grid-cols-[180px_1fr] lg:grid-cols-[160px_1fr]">
                                    <div class="relative aspect-[4/3] overflow-hidden rounded-2xl bg-gray-100 dark:bg-gray-800">
                                        @if($article->hasMedia('images'))
                                            <img src="{{ $article->getFirstMediaUrl('images', 'thumb') }}" alt="{{ $article->title }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                                        @else
                                            <div class="h-full w-full bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-800 dark:to-gray-700"></div>
                                        @endif
                                    </div>
                                    <div class="flex min-w-0 flex-col justify-center">
                                        <span class="mb-2 text-xs font-black uppercase tracking-wide text-blue-600 dark:text-blue-400">{{ $category->name }}</span>
                                        <h3 class="line-clamp-3 text-lg font-black leading-snug text-gray-950 transition-colors group-hover:text-blue-600 dark:text-white dark:group-hover:text-blue-400">
                                            {{ $article->title }}
                                        </h3>
                                        <p class="mt-3 text-xs font-semibold text-gray-500 dark:text-gray-400">
                                            {{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}
                                        </p>
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endif

            <div class="mt-10 grid grid-cols-1 gap-10 lg:grid-cols-12">
                <main class="lg:col-span-8">
                    <div class="mb-6 flex items-end justify-between gap-4 border-b border-gray-200 pb-4 dark:border-gray-800">
                        <div>
                            <p class="text-xs font-black uppercase tracking-[0.25em] text-blue-600 dark:text-blue-400">Latest Updates</p>
                            <h2 class="mt-2 text-2xl font-black text-gray-950 dark:text-white">Berita Terbaru {{ $category->name }}</h2>
                        </div>
                        <span class="hidden text-sm font-semibold text-gray-500 dark:text-gray-400 sm:block">{{ number_format($articles->total()) }} artikel lainnya</span>
                    </div>

                    <div class="space-y-6">
                        @forelse($articles as $article)
                            <article class="group rounded-3xl border border-gray-100 bg-white p-4 shadow-sm transition-all hover:-translate-y-0.5 hover:shadow-xl dark:border-gray-800 dark:bg-gray-900">
                                <a href="{{ route('article.show', $article->slug) }}" class="grid gap-5 md:grid-cols-[240px_1fr]">
                                    <div class="relative aspect-[16/10] overflow-hidden rounded-2xl bg-gray-100 dark:bg-gray-800">
                                        @if($article->hasMedia('images'))
                                            <img src="{{ $article->getFirstMediaUrl('images', 'thumb') }}" alt="{{ $article->title }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                                        @else
                                            <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200 text-gray-400 dark:from-gray-800 dark:to-gray-700">
                                                <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15" /></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="min-w-0 py-1">
                                        <div class="mb-3 flex flex-wrap items-center gap-2 text-xs font-bold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                            <span class="text-blue-600 dark:text-blue-400">{{ $category->name }}</span>
                                            <span>•</span>
                                            <span>{{ $article->published_at ? $article->published_at->diffForHumans() : $article->created_at->diffForHumans() }}</span>
                                        </div>
                                        <h3 class="text-xl font-black leading-snug text-gray-950 transition-colors group-hover:text-blue-600 dark:text-white dark:group-hover:text-blue-400 md:text-2xl">
                                            {{ $article->title }}
                                        </h3>
                                        <p class="mt-3 line-clamp-2 text-sm leading-7 text-gray-600 dark:text-gray-300">
                                            {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 150) }}
                                        </p>
                                        <div class="mt-4 flex items-center gap-3 text-xs font-semibold text-gray-500 dark:text-gray-400">
                                            <span>{{ $article->author->name ?? 'Redaksi' }}</span>
                                            @if($article->views_count > 0)
                                                <span>•</span>
                                                <span>{{ number_format($article->views_count) }} dibaca</span>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </article>
                        @empty
                            <div class="rounded-[2rem] border border-dashed border-gray-200 bg-white p-12 text-center dark:border-gray-800 dark:bg-gray-900">
                                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-blue-50 text-blue-600 dark:bg-blue-950/40 dark:text-blue-300">
                                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-black text-gray-950 dark:text-white">Belum ada artikel lain</h3>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Artikel terbaru untuk kanal ini akan tampil di sini.</p>
                            </div>
                        @endforelse
                    </div>

                    @if($articles->hasPages())
                        <div class="mt-10">
                            {{ $articles->links() }}
                        </div>
                    @endif

                    <div class="mt-10">
                        <x-ad-banner position="in_content" />
                    </div>
                </main>

                <aside class="lg:col-span-4">
                    <div class="sticky top-36 space-y-8">
                        <x-ad-banner position="sidebar" />

                        <section class="rounded-[2rem] border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                            <div class="mb-5 flex items-center gap-2">
                                <span class="h-2 w-2 rounded-full bg-red-500"></span>
                                <h3 class="text-sm font-black uppercase tracking-[0.25em] text-gray-950 dark:text-white">Terpopuler</h3>
                            </div>
                            <div class="space-y-5">
                                @forelse($popularArticles as $index => $article)
                                    <a href="{{ route('article.show', $article->slug) }}" class="group flex gap-4">
                                        <span class="text-2xl font-black text-gray-200 transition-colors group-hover:text-blue-600 dark:text-gray-700">{{ $loop->iteration }}</span>
                                        <span class="text-sm font-bold leading-snug text-gray-800 transition-colors group-hover:text-blue-600 dark:text-gray-100 dark:group-hover:text-blue-400">
                                            {{ $article->title }}
                                        </span>
                                    </a>
                                @empty
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada artikel populer.</p>
                                @endforelse
                            </div>
                        </section>

                        @if($activePoll)
                            <livewire:poll-widget :poll="$activePoll" />
                        @endif

                        <section class="rounded-[2rem] bg-gradient-to-br from-blue-600 to-slate-950 p-6 text-white shadow-xl shadow-blue-900/20">
                            <h3 class="text-xl font-black">Newsletter {{ $category->name }}</h3>
                            <p class="mt-2 text-sm leading-6 text-blue-100">Dapatkan rangkuman berita pilihan langsung ke inbox Anda.</p>
                            <div class="mt-5">
                                <livewire:newsletter-form variant="dark" button-label="Langganan" />
                            </div>
                        </section>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</x-app-layout>
