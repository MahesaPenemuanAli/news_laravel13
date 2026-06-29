<div>
    <div
        class="relative mx-auto w-full max-w-2xl"
        x-data="{ focused: false }"
        x-effect="if (typeof searchOpen !== 'undefined' && searchOpen) $nextTick(() => $refs.searchInput?.focus())"
        @click.away="focused = false"
    >
        <form action="#" method="GET" class="flex w-full items-center gap-3" @submit.prevent>
            <div class="relative flex-1">
                <svg class="absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input
                    type="text"
                    wire:model.live.debounce.250ms="search"
                    placeholder="Cari berita, topik, atau penulis..."
                    class="w-full rounded-xl border border-gray-200 bg-gray-50 py-3 pl-10 pr-20 text-sm text-gray-900 transition-colors focus:border-blue-500 focus:ring-2 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100"
                    x-ref="searchInput"
                    @focus="focused = true"
                    @keydown.escape="searchOpen = false; focused = false"
                    autocomplete="off"
                >

                @if($search !== '')
                    <button type="button" wire:click="clear" class="absolute right-10 top-1/2 -translate-y-1/2 rounded-md px-2 py-1 text-xs font-bold text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-700 dark:hover:text-gray-200">
                        Clear
                    </button>
                @endif

                <div wire:loading class="absolute right-3 top-1/2 -translate-y-1/2">
                    <svg class="h-5 w-5 animate-spin text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            </div>
            <button @click="searchOpen = false" type="button" class="hidden px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 md:block">Batal</button>
        </form>

        @if(mb_strlen($term) >= 2)
            <div
                x-show="focused"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-2"
                class="absolute left-0 right-0 z-50 mt-2 overflow-hidden rounded-xl bg-white shadow-2xl ring-1 ring-black/5 dark:bg-gray-800 dark:ring-white/10"
            >
                <div class="max-h-[420px] overflow-y-auto p-2">
                    @if($articles->isNotEmpty())
                        <div class="flex items-center justify-between px-3 py-2 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                            <span>Hasil Pencarian</span>
                            <span>{{ $articles->count() }} berita</span>
                        </div>
                        @foreach($articles as $article)
                            <a href="{{ route('article.show', $article->slug) }}" class="group flex items-center gap-4 rounded-lg p-3 transition-colors hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                @if($article->hasMedia('images'))
                                    <img src="{{ $article->getFirstMediaUrl('images', 'thumb') }}" alt="{{ $article->title }}" class="h-16 w-16 flex-shrink-0 rounded-lg object-cover">
                                @else
                                    <div class="flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-lg bg-gray-200 dark:bg-gray-700">
                                        <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="min-w-0">
                                    <h4 class="line-clamp-2 text-sm font-semibold text-gray-900 group-hover:text-blue-600 dark:text-white dark:group-hover:text-blue-400">{{ $article->title }}</h4>
                                    <div class="mt-1 flex flex-wrap items-center gap-2">
                                        @if($article->category)
                                            <span class="rounded-full bg-blue-100 px-2 py-0.5 text-[10px] font-medium text-blue-700 dark:bg-blue-900/30 dark:text-blue-300">
                                                {{ $article->category->name }}
                                            </span>
                                        @endif
                                        <span class="text-[11px] text-gray-500 dark:text-gray-400">{{ $article->published_at ? $article->published_at->diffForHumans() : '' }}</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @else
                        <div class="p-8 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Tidak ada hasil</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Tidak dapat menemukan berita untuk pencarian "{{ $term }}"</p>
                        </div>
                    @endif
                </div>
            </div>
        @elseif($search !== '')
            <p class="mt-2 px-1 text-xs text-gray-500 dark:text-gray-400">Ketik minimal 2 karakter untuk mulai mencari.</p>
        @endif
    </div>
</div>
