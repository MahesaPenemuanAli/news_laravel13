<x-app-layout>
    @section('title', $category->name . ' - Portal Berita')
    @section('meta_description', $category->description ?? 'Kumpulan berita ' . $category->name . ' terkini dan terpercaya.')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        
        <!-- Breadcrumb -->
        <nav class="flex text-sm text-gray-500 dark:text-gray-400 mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                        Beranda
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <span class="ml-1 md:ml-2 font-medium text-gray-700 dark:text-gray-300">{{ $category->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Category Header -->
        <div class="mb-10 text-center max-w-3xl mx-auto">
            <span class="text-sm font-bold tracking-wider text-blue-600 dark:text-blue-400 uppercase mb-2 block">Kategori</span>
            <h1 class="text-3xl md:text-5xl font-black text-gray-900 dark:text-white mb-4">
                {{ $category->name }}
            </h1>
            @if($category->description)
                <p class="text-gray-600 dark:text-gray-400 text-base md:text-lg">
                    {{ $category->description }}
                </p>
            @endif
        </div>

        <!-- Header Ad Banner -->
        <x-ad-banner position="header" />

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 my-10">
            <!-- Main Content Area -->
            <div class="lg:col-span-3">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($articles as $article)
                        <x-article-card :article="$article" />
                    @empty
                        <div class="col-span-full py-20 text-center">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-800 mb-4 text-gray-400">
                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15M9 11l3 3m0 0l3-3m-3 3V8" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Belum ada artikel</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Belum ada artikel yang dipublikasikan pada kategori ini.</p>
                        </div>
                    @endforelse
                </div>
                
                <!-- Pagination -->
                <div class="mt-10">
                    {{ $articles->links() }}
                </div>
                
                <!-- In Content Ad Banner -->
                <div class="mt-10">
                    <x-ad-banner position="in_content" />
                </div>
            </div>
            
            <!-- Sidebar Area -->
            <div class="lg:col-span-1 space-y-8">
                <!-- Sidebar Ad Banner -->
                <x-ad-banner position="sidebar" />
                
                <!-- Newsletter Widget -->
                <div class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-2xl shadow-lg p-6 text-white">
                    <h3 class="text-lg font-bold mb-2 text-center">📬 Newsletter</h3>
                    <p class="text-sm text-blue-100 text-center mb-4">Berlangganan untuk info terkini seputar {{ $category->name }}.</p>
                    <form class="flex flex-col gap-3">
                        <input type="email" placeholder="Email Anda" class="rounded-lg border-white/20 bg-white/10 text-white placeholder-blue-200 text-sm focus:ring-white focus:border-white backdrop-blur-sm">
                        <button type="submit" class="w-full bg-white hover:bg-blue-50 text-blue-700 font-bold py-2.5 px-4 rounded-lg transition-colors text-sm">Daftar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
