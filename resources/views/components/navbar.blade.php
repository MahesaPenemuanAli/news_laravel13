<nav
    class="sticky top-0 z-50 border-b border-gray-100 bg-white/95 shadow-sm backdrop-blur-xl transition-colors duration-300 dark:border-gray-800 dark:bg-gray-950/95"
    x-data="{ mobileOpen: false, searchOpen: false, megaOpen: false }"
    @keydown.escape.window="searchOpen = false; megaOpen = false; mobileOpen = false"
>
    <div class="hidden border-b border-blue-900/40 bg-slate-950 text-white lg:block">
        <div class="mx-auto flex h-9 max-w-7xl items-center justify-between px-4 text-xs sm:px-6 lg:px-8">
            <div class="flex min-w-0 items-center gap-4">
                <span class="inline-flex items-center gap-2 font-semibold text-blue-200">
                    <span class="h-2 w-2 rounded-full bg-red-500"></span>
                    Update {{ now()->format('d M Y') }}
                </span>
                @if($trendingArticles->isNotEmpty())
                    <a href="{{ route('article.show', $trendingArticles->first()->slug) }}" class="truncate text-gray-300 transition-colors hover:text-white">
                        Trending: {{ $trendingArticles->first()->title }}
                    </a>
                @endif
            </div>

            <div class="flex items-center gap-4 text-gray-300">
                <a href="{{ url('/admin') }}" class="transition-colors hover:text-white">Admin</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="transition-colors hover:text-white">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="transition-colors hover:text-white">Masuk</a>
                @endauth
            </div>
        </div>
    </div>

    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:h-20 lg:px-8">
        <a href="{{ route('home') }}" class="flex flex-shrink-0 items-center gap-3" aria-label="NEWS PORTAL">
            <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-blue-600 text-lg font-black text-white shadow-lg shadow-blue-600/20 lg:h-12 lg:w-12">N</span>
            <span class="leading-none">
                <span class="block text-2xl font-black tracking-tight text-gray-950 dark:text-white lg:text-3xl">NEWS</span>
                <span class="block text-xs font-extrabold uppercase tracking-[0.35em] text-blue-600 dark:text-blue-400">Portal</span>
            </span>
        </a>

        <div x-show="!searchOpen" x-cloak x-transition class="hidden flex-1 justify-center px-10 lg:flex">
            <button
                type="button"
                @click="searchOpen = true; megaOpen = false"
                class="group flex w-full max-w-xl items-center justify-between rounded-full border border-gray-200 bg-gray-50 px-5 py-3 text-sm text-gray-500 transition-all hover:border-blue-200 hover:bg-white hover:shadow-md dark:border-gray-800 dark:bg-gray-900 dark:text-gray-400 dark:hover:border-blue-700 dark:hover:bg-gray-900"
            >
                <span class="flex items-center gap-3">
                    <svg class="h-5 w-5 text-gray-400 group-hover:text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Cari berita, topik, atau penulis...
                </span>
                <span class="rounded-full bg-white px-2 py-1 text-[10px] font-bold uppercase tracking-wide text-gray-400 ring-1 ring-gray-200 dark:bg-gray-950 dark:ring-gray-800">Live</span>
            </button>
        </div>

        <div class="flex items-center gap-2">
            <button @click="searchOpen = !searchOpen; megaOpen = false" class="rounded-full p-2.5 text-gray-500 transition-colors hover:bg-gray-100 hover:text-blue-600 dark:text-gray-400 dark:hover:bg-gray-900 dark:hover:text-blue-400 lg:hidden" aria-label="Buka pencarian">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>

            <button @click="darkMode = !darkMode" class="rounded-full bg-gray-100 p-2.5 text-gray-500 transition-colors hover:bg-gray-200 dark:bg-gray-900 dark:text-gray-400 dark:hover:bg-gray-800" aria-label="Ubah tema">
                <svg x-show="darkMode" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <svg x-show="!darkMode" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
            </button>

            <button @click="mobileOpen = !mobileOpen; searchOpen = false; megaOpen = false" type="button" class="inline-flex items-center justify-center rounded-full p-2.5 text-gray-500 transition-colors hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-900 dark:hover:text-gray-200 lg:hidden" aria-label="Buka menu mobile">
                <svg x-show="!mobileOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="mobileOpen" x-cloak class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <div class="hidden border-t border-gray-100 bg-white dark:border-gray-800 dark:bg-gray-950 lg:block">
        <div class="mx-auto flex h-12 max-w-7xl items-center px-4 sm:px-6 lg:px-8">
            <div class="flex min-w-0 flex-1 items-center gap-1">
                @foreach($primaryItems as $item)
                    <div class="group relative h-12" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <a href="{{ $item['url'] }}" class="inline-flex h-12 items-center gap-1.5 px-3 text-sm font-bold text-gray-700 transition-colors hover:text-blue-600 dark:text-gray-200 dark:hover:text-blue-400 {{ url()->current() === $item['url'] ? 'text-blue-600 dark:text-blue-400' : '' }}">
                            {{ $item['title'] }}
                            @if(count($item['children']) > 0)
                                <svg class="h-3.5 w-3.5 transition-transform group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            @endif
                        </a>

                        @if(count($item['children']) > 0)
                            <div x-show="open" x-cloak x-transition class="absolute left-0 top-full z-50 w-64 rounded-b-2xl border border-gray-100 bg-white p-2 shadow-2xl shadow-gray-900/10 dark:border-gray-800 dark:bg-gray-900">
                                @foreach($item['children'] as $child)
                                    <a href="{{ $child['url'] }}" class="block rounded-xl px-4 py-3 text-sm font-semibold text-gray-700 transition-colors hover:bg-blue-50 hover:text-blue-600 dark:text-gray-200 dark:hover:bg-gray-800 dark:hover:text-blue-400">
                                        {{ $child['title'] }}
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <button
                type="button"
                @click="megaOpen = !megaOpen; searchOpen = false"
                class="ml-3 inline-flex h-9 items-center gap-2 rounded-full border border-gray-200 px-4 text-sm font-black text-gray-700 transition-all hover:border-blue-200 hover:bg-blue-50 hover:text-blue-600 dark:border-gray-800 dark:text-gray-200 dark:hover:border-blue-800 dark:hover:bg-gray-900 dark:hover:text-blue-400"
            >
                Kanal Lainnya
                <svg class="h-4 w-4 transition-transform" :class="{ 'rotate-180': megaOpen }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
        </div>
    </div>

    <div x-show="megaOpen" x-cloak x-transition @click.outside="megaOpen = false" class="hidden border-t border-gray-100 bg-white shadow-2xl shadow-gray-900/10 dark:border-gray-800 dark:bg-gray-950 lg:block">
        <div class="mx-auto grid max-w-7xl grid-cols-12 gap-8 px-4 py-8 sm:px-6 lg:px-8">
            <div class="col-span-7">
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="text-sm font-black uppercase tracking-[0.25em] text-gray-900 dark:text-white">Semua Kanal</h3>
                    <span class="text-xs font-semibold text-gray-400">Navigasi cepat berita</span>
                </div>
                <div class="grid grid-cols-3 gap-2">
                    @foreach(array_merge($primaryItems, $moreItems) as $item)
                        <a href="{{ $item['url'] }}" class="rounded-2xl border border-gray-100 bg-gray-50 px-4 py-3 text-sm font-bold text-gray-700 transition-all hover:-translate-y-0.5 hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-200 dark:hover:border-blue-900 dark:hover:bg-blue-950/40 dark:hover:text-blue-300">
                            {{ $item['title'] }}
                        </a>
                    @endforeach
                </div>

                @if($featuredCategories->isNotEmpty())
                    <div class="mt-6 flex flex-wrap gap-2">
                        @foreach($featuredCategories as $category)
                            <a href="{{ route('category.show', $category->slug) }}" class="rounded-full bg-white px-3 py-1.5 text-xs font-bold text-gray-500 ring-1 ring-gray-200 transition-colors hover:text-blue-600 hover:ring-blue-200 dark:bg-gray-950 dark:text-gray-400 dark:ring-gray-800 dark:hover:text-blue-300">
                                #{{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="col-span-5 rounded-3xl bg-slate-950 p-6 text-white">
                <div class="mb-5 flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-red-500"></span>
                    <h3 class="text-sm font-black uppercase tracking-[0.25em]">Trending</h3>
                </div>
                <div class="space-y-4">
                    @forelse($trendingArticles as $index => $article)
                        <a href="{{ route('article.show', $article->slug) }}" class="group flex gap-4">
                            <span class="text-2xl font-black text-blue-400">{{ $index + 1 }}</span>
                            <span class="text-sm font-bold leading-snug text-gray-100 group-hover:text-blue-300">
                                {{ $article->title }}
                            </span>
                        </a>
                    @empty
                        <p class="text-sm text-gray-400">Trending akan tampil setelah artikel memiliki pembaca.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div x-show="searchOpen" x-cloak x-transition class="border-t border-gray-100 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-950">
        <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">
            <livewire:navbar-search />
        </div>
    </div>

    <div x-show="mobileOpen" x-cloak x-transition class="border-t border-gray-100 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-950 lg:hidden">
        <div class="space-y-4 px-4 py-5">
            <livewire:navbar-search />

            <div class="grid grid-cols-2 gap-2">
                @foreach(array_merge($primaryItems, $moreItems) as $item)
                    <a href="{{ $item['url'] }}" class="rounded-2xl border border-gray-100 bg-gray-50 px-4 py-3 text-sm font-bold text-gray-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-200" @click="mobileOpen = false">
                        {{ $item['title'] }}
                    </a>
                    @foreach($item['children'] as $child)
                        <a href="{{ $child['url'] }}" class="rounded-2xl border border-blue-100 bg-blue-50 px-4 py-3 text-sm font-bold text-blue-700 dark:border-blue-950 dark:bg-blue-950/40 dark:text-blue-200" @click="mobileOpen = false">
                            {{ $child['title'] }}
                        </a>
                    @endforeach
                @endforeach
            </div>

            <div class="flex gap-2 border-t border-gray-100 pt-4 dark:border-gray-800">
                <a href="{{ url('/admin') }}" class="flex-1 rounded-xl bg-slate-950 px-4 py-3 text-center text-sm font-bold text-white">Admin</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="flex-1 rounded-xl bg-blue-600 px-4 py-3 text-center text-sm font-bold text-white">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="flex-1 rounded-xl bg-blue-600 px-4 py-3 text-center text-sm font-bold text-white">Masuk</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
