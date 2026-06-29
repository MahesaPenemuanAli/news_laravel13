<x-app-layout>
    @section('title', 'Beranda - Portal Berita Terkini')
    @section('meta_description', 'Portal berita terpercaya dan tercepat. Dapatkan informasi terkini dari berbagai kategori: nasional, internasional, bisnis, teknologi, olahraga, dan hiburan.')

    <!-- Breaking News Ticker -->
    @if($breakingNews->isNotEmpty())
    <div class="bg-red-600 text-white overflow-hidden relative shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center h-10">
            <div class="font-bold uppercase tracking-wider text-xs md:text-sm whitespace-nowrap pr-4 border-r border-red-500 mr-4 z-10 bg-red-600 flex items-center h-full">
                <span class="animate-pulse mr-2 w-2 h-2 bg-white rounded-full inline-block"></span> Breaking
            </div>

            <div class="flex-1 overflow-hidden ticker-wrap">
                <div class="whitespace-nowrap flex space-x-8 items-center ticker-content">
                    @foreach($breakingNews as $news)
                        <a href="{{ route('article.show', $news->slug ?? '#') }}" class="text-sm hover:underline hover:text-red-100 transition-colors inline-block">
                            {{ $news->title }}
                        </a>
                        <span class="text-red-300">•</span>
                    @endforeach
                    {{-- Duplikasi agar loop seamless --}}
                    @foreach($breakingNews as $news)
                        <a href="{{ route('article.show', $news->slug ?? '#') }}" class="text-sm hover:underline hover:text-red-100 transition-colors inline-block">
                            {{ $news->title }}
                        </a>
                        <span class="text-red-300">•</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Header Ad Banner -->
        <x-ad-banner position="header" />

        <!-- Hero Section + Trending News Sidebar -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-12">
            <!-- Hero (Main + Side Articles) spans 2 columns -->
            <div class="lg:col-span-2">
                @if($featuredArticles->isNotEmpty())
                    <x-hero-section :articles="$featuredArticles" />
                @endif
            </div>

            <!-- Trending News Sidebar -->
            <div class="lg:col-span-1 flex flex-col">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 h-full">
                    <h3 class="text-lg font-black text-gray-900 dark:text-white mb-5 uppercase tracking-wider flex items-center gap-2">
                        <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd" />
                        </svg>
                        Trending News
                    </h3>
                    <div class="space-y-4">
                        @forelse($trendingArticles as $index => $trending)
                            <a href="{{ route('article.show', $trending->slug ?? '#') }}" class="flex items-start gap-4 group">
                                <span class="text-3xl font-black text-gray-200 dark:text-gray-700 group-hover:text-blue-500 dark:group-hover:text-blue-400 transition-colors leading-none min-w-[2rem] text-right">
                                    {{ $loop->iteration }}
                                </span>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-bold text-gray-900 dark:text-white leading-snug group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors line-clamp-2">
                                        {{ $trending->title }}
                                    </h4>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        {{ $trending->published_at ? $trending->published_at->diffForHumans() : $trending->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </a>
                            @if(!$loop->last)
                                <div class="border-b border-gray-100 dark:border-gray-700"></div>
                            @endif
                        @empty
                            <p class="text-sm text-gray-500">Belum ada artikel trending.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 mb-12">
            <!-- Main Content Area -->
            <div class="lg:col-span-3">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-black text-gray-900 dark:text-white uppercase tracking-tight border-l-4 border-blue-600 pl-3">
                        Berita Terbaru
                    </h2>
                    <a href="#" class="text-sm font-semibold text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors">Lihat Semua &rarr;</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($latestArticles as $article)
                        <x-article-card :article="$article" />
                    @empty
                        <div class="col-span-2 py-10 text-center text-gray-500 dark:text-gray-400">
                            Belum ada artikel terbaru.
                        </div>
                    @endforelse
                </div>

                <!-- In Content Ad Banner -->
                <x-ad-banner position="in_content" />
            </div>

            <!-- Sidebar Area -->
            <div class="lg:col-span-1 space-y-8">
                <!-- Sidebar Ad Banner -->
                <x-ad-banner position="sidebar" />

                <!-- Jajak Pendapat / Poll Widget -->
                @if($activePoll)
                    <livewire:poll-widget :poll="$activePoll" />
                @endif

                <!-- Tag Populer Widget -->
                @if($popularTags->isNotEmpty())
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                    <h3 class="text-lg font-black text-gray-900 dark:text-white mb-4 uppercase tracking-wider text-center">Tag Populer</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($popularTags as $tag)
                            <a href="#" class="inline-block bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-blue-100 dark:hover:bg-blue-900 hover:text-blue-700 dark:hover:text-blue-300 px-3 py-1.5 rounded-lg text-sm font-medium transition-colors">
                                {{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Newsletter Widget -->
                <div class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-2xl shadow-lg p-6 text-white">
                    <h3 class="text-lg font-bold mb-2 text-center">📬 Newsletter</h3>
                    <p class="text-sm text-blue-100 text-center mb-4">Berlangganan untuk info terkini langsung ke inbox Anda.</p>
                    <livewire:newsletter-form variant="dark" button-label="Daftar Sekarang" />
                </div>
            </div>
        </div>

        <!-- Featured Categories Blocks -->
        @if($featuredCategories->isNotEmpty())
            <div class="space-y-12 mb-12">
                @foreach($featuredCategories as $category)
                    @if($category->articles->isNotEmpty())
                    <section>
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-black text-gray-900 dark:text-white uppercase tracking-tight border-l-4 border-red-600 pl-3">
                                {{ $category->name }}
                            </h2>
                            <a href="{{ route('category.show', $category->slug ?? '#') }}" class="text-sm font-semibold text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 transition-colors">Lebih banyak &rarr;</a>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            @foreach($category->articles as $article)
                                <x-article-card :article="$article" />
                            @endforeach
                        </div>
                    </section>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
