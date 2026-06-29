<x-app-layout>
    @section('title', $author->name . ' - Penulis Portal Berita')
    @section('meta_description', ($author->profile->bio ?? $author->name . ' adalah penulis di Portal Berita.'))

    @php
        $totalViews = $author->articles()->sum('views_count');
        $latestArticle = $articles->first();
    @endphp

    <div class="bg-white dark:bg-gray-950">
        <section class="relative overflow-hidden bg-slate-950 text-white">
            <div class="absolute inset-0 opacity-40">
                <div class="absolute left-0 top-0 h-80 w-80 rounded-full bg-blue-600 blur-3xl"></div>
                <div class="absolute right-0 bottom-0 h-80 w-80 rounded-full bg-indigo-600 blur-3xl"></div>
            </div>

            <div class="relative mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
                <nav class="mb-8 flex overflow-x-auto text-sm text-gray-300" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center gap-2 whitespace-nowrap">
                        <li><a href="{{ route('home') }}" class="font-semibold transition-colors hover:text-white">Beranda</a></li>
                        <li class="text-gray-500">/</li>
                        <li class="font-bold text-white">{{ $author->name }}</li>
                    </ol>
                </nav>

                <div class="grid gap-8 lg:grid-cols-12 lg:items-center">
                    <div class="lg:col-span-3">
                        <div class="relative mx-auto h-44 w-44 overflow-hidden rounded-[2rem] border-4 border-white/10 bg-white/10 shadow-2xl lg:mx-0 lg:h-56 lg:w-56">
                            @if($author->profile && $author->profile->photo)
                                <img src="{{ Storage::url($author->profile->photo) }}" alt="{{ $author->name }}" class="h-full w-full object-cover">
                            @else
                                <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-blue-600 to-indigo-700 text-6xl font-black text-white">
                                    {{ substr($author->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="text-center lg:col-span-6 lg:text-left">
                        <span class="inline-flex rounded-full border border-white/10 bg-white/10 px-4 py-2 text-xs font-black uppercase tracking-[0.25em] text-blue-100 backdrop-blur">Profil Penulis</span>
                        <h1 class="mt-5 text-4xl font-black tracking-tight md:text-6xl">{{ $author->name }}</h1>
                        @if($author->profile && $author->profile->expertise)
                            <p class="mt-3 text-sm font-black uppercase tracking-[0.25em] text-blue-300">{{ $author->profile->expertise }}</p>
                        @endif
                        <p class="mt-5 max-w-3xl text-base leading-8 text-gray-300">
                            {{ $author->profile->bio ?? 'Jurnalis Portal Berita yang menyajikan informasi terkini dengan akurasi, konteks, dan sudut pandang yang relevan untuk pembaca.' }}
                        </p>

                        @if($author->profile && ($author->profile->twitter_url || $author->profile->facebook_url || $author->profile->instagram_url))
                            <div class="mt-6 flex justify-center gap-3 lg:justify-start">
                                @if($author->profile->twitter_url)
                                    <a href="{{ $author->profile->twitter_url }}" target="_blank" rel="noopener noreferrer" class="rounded-full bg-white/10 px-4 py-2 text-sm font-bold text-gray-200 transition-colors hover:bg-white hover:text-slate-950">X</a>
                                @endif
                                @if($author->profile->facebook_url)
                                    <a href="{{ $author->profile->facebook_url }}" target="_blank" rel="noopener noreferrer" class="rounded-full bg-white/10 px-4 py-2 text-sm font-bold text-gray-200 transition-colors hover:bg-white hover:text-slate-950">Facebook</a>
                                @endif
                                @if($author->profile->instagram_url)
                                    <a href="{{ $author->profile->instagram_url }}" target="_blank" rel="noopener noreferrer" class="rounded-full bg-white/10 px-4 py-2 text-sm font-bold text-gray-200 transition-colors hover:bg-white hover:text-slate-950">Instagram</a>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="grid grid-cols-3 gap-3 lg:col-span-3 lg:grid-cols-1">
                        <div class="rounded-2xl border border-white/10 bg-white/10 p-4 backdrop-blur">
                            <span class="block text-2xl font-black">{{ number_format($articles->total()) }}</span>
                            <span class="mt-1 block text-xs font-semibold uppercase tracking-wide text-gray-300">Artikel</span>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/10 p-4 backdrop-blur">
                            <span class="block text-2xl font-black">{{ number_format($totalViews) }}</span>
                            <span class="mt-1 block text-xs font-semibold uppercase tracking-wide text-gray-300">Pembaca</span>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/10 p-4 backdrop-blur">
                            <span class="block text-2xl font-black">{{ $author->created_at->format('Y') }}</span>
                            <span class="mt-1 block text-xs font-semibold uppercase tracking-wide text-gray-300">Bergabung</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
            <x-ad-banner position="header" />

            @if($latestArticle)
                <section class="mt-8 rounded-[2rem] border border-gray-100 bg-gray-50 p-4 dark:border-gray-800 dark:bg-gray-900/50">
                    <a href="{{ route('article.show', $latestArticle->slug) }}" class="group grid gap-6 lg:grid-cols-[420px_1fr] lg:items-center">
                        <div class="relative aspect-[16/10] overflow-hidden rounded-[1.5rem] bg-gray-100 dark:bg-gray-800">
                            @if($latestArticle->hasMedia('images'))
                                <img src="{{ $latestArticle->getFirstMediaUrl('images', 'webp-full') }}" alt="{{ $latestArticle->title }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                            @else
                                <div class="h-full w-full bg-gradient-to-br from-blue-100 to-gray-200 dark:from-blue-950 dark:to-gray-800"></div>
                            @endif
                        </div>
                        <div class="p-2 lg:p-4">
                            <span class="text-xs font-black uppercase tracking-[0.25em] text-blue-600 dark:text-blue-400">Artikel Terbaru</span>
                            <h2 class="mt-3 text-3xl font-black leading-tight text-gray-950 transition-colors group-hover:text-blue-600 dark:text-white dark:group-hover:text-blue-400">
                                {{ $latestArticle->title }}
                            </h2>
                            <p class="mt-4 line-clamp-2 text-sm leading-7 text-gray-600 dark:text-gray-300">
                                {{ $latestArticle->excerpt ?? Str::limit(strip_tags($latestArticle->content), 170) }}
                            </p>
                            <p class="mt-5 text-xs font-bold uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                {{ $latestArticle->published_at ? $latestArticle->published_at->diffForHumans() : $latestArticle->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </a>
                </section>
            @endif

            <div class="mt-10 grid grid-cols-1 gap-10 lg:grid-cols-12">
                <main class="lg:col-span-8">
                    <div class="mb-6 border-b border-gray-200 pb-4 dark:border-gray-800">
                        <p class="text-xs font-black uppercase tracking-[0.25em] text-blue-600 dark:text-blue-400">Arsip Penulis</p>
                        <h2 class="mt-2 text-2xl font-black text-gray-950 dark:text-white">Artikel oleh {{ $author->name }}</h2>
                    </div>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        @forelse($articles as $article)
                            <x-article-card :article="$article" />
                        @empty
                            <div class="col-span-full rounded-[2rem] border border-dashed border-gray-200 bg-white p-12 text-center dark:border-gray-800 dark:bg-gray-900">
                                <h3 class="text-lg font-black text-gray-950 dark:text-white">Belum ada artikel</h3>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Penulis ini belum mempublikasikan artikel apa pun.</p>
                            </div>
                        @endforelse
                    </div>

                    @if($articles->hasPages())
                        <div class="mt-10">{{ $articles->links() }}</div>
                    @endif
                </main>

                <aside class="lg:col-span-4">
                    <div class="sticky top-36 space-y-8">
                        <x-ad-banner position="sidebar" />

                        <section class="rounded-[2rem] border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                            <h3 class="text-lg font-black text-gray-950 dark:text-white">Jelajahi Berita</h3>
                            <p class="mt-2 text-sm leading-6 text-gray-500 dark:text-gray-400">Temukan update terbaru dari kanal utama Portal Berita.</p>
                            <a href="{{ route('home') }}" class="mt-5 inline-flex w-full items-center justify-center rounded-xl bg-blue-600 px-4 py-3 text-sm font-bold text-white transition-colors hover:bg-blue-700">
                                Kembali ke Beranda
                            </a>
                        </section>

                        <section class="rounded-[2rem] bg-gradient-to-br from-blue-600 to-slate-950 p-6 text-white shadow-xl shadow-blue-900/20">
                            <h3 class="text-xl font-black">Newsletter</h3>
                            <p class="mt-2 text-sm leading-6 text-blue-100">Ikuti rangkuman berita pilihan redaksi.</p>
                            <div class="mt-5">
                                <livewire:newsletter-form variant="dark" />
                            </div>
                        </section>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</x-app-layout>
