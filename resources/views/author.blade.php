<x-app-layout>
    @section('title', $author->name . ' - Penulis Portal Berita')
    @section('meta_description', ($author->profile->bio ?? $author->name . ' adalah penulis di Portal Berita.'))

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
                        <span class="ml-1 md:ml-2 font-medium text-gray-700 dark:text-gray-300">{{ $author->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Author Profile Box (E-E-A-T Focus) -->
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 p-8 md:p-12 mb-12 flex flex-col md:flex-row items-center md:items-start gap-8">
            <!-- Author Photo -->
            <div class="w-32 h-32 md:w-40 md:h-40 flex-shrink-0 rounded-full overflow-hidden bg-gradient-to-br from-blue-100 to-blue-200 dark:from-blue-900 dark:to-blue-800 border-4 border-white dark:border-gray-800 shadow-lg flex items-center justify-center">
                @if($author->profile && $author->profile->photo)
                    <img src="{{ Storage::url($author->profile->photo) }}" alt="{{ $author->name }}" class="w-full h-full object-cover">
                @else
                    <span class="text-4xl md:text-5xl font-black text-blue-600 dark:text-blue-300">{{ substr($author->name, 0, 1) }}</span>
                @endif
            </div>
            
            <!-- Author Details -->
            <div class="flex-1 text-center md:text-left">
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-4">
                    <div>
                        <h1 class="text-3xl font-black text-gray-900 dark:text-white">{{ $author->name }}</h1>
                        @if($author->profile && $author->profile->expertise)
                            <p class="text-blue-600 dark:text-blue-400 font-semibold text-sm uppercase tracking-widest mt-1">{{ $author->profile->expertise }}</p>
                        @endif
                    </div>
                    
                    <!-- Social Links -->
                    @if($author->profile && ($author->profile->twitter_url || $author->profile->facebook_url || $author->profile->instagram_url))
                    <div class="flex space-x-3 mt-4 md:mt-0 justify-center md:justify-end">
                        @if($author->profile->twitter_url)
                        <a href="{{ $author->profile->twitter_url }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-400 hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-gray-700 transition-all duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                        </a>
                        @endif
                        @if($author->profile->facebook_url)
                        <a href="{{ $author->profile->facebook_url }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-gray-700 transition-all duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                        </a>
                        @endif
                        @if($author->profile->instagram_url)
                        <a href="{{ $author->profile->instagram_url }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-400 hover:text-pink-500 hover:bg-pink-50 dark:hover:bg-gray-700 transition-all duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" /></svg>
                        </a>
                        @endif
                    </div>
                    @endif
                </div>
                
                <div class="prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-300">
                    <p>{{ $author->profile->bio ?? 'Penulis tetap di Portal Berita yang berdedikasi tinggi dalam menyajikan informasi terkini dan terpercaya.' }}</p>
                </div>
                
                <div class="mt-6 flex flex-wrap gap-4 justify-center md:justify-start">
                    <div class="bg-gray-50 dark:bg-gray-800 px-5 py-3 rounded-xl border border-gray-100 dark:border-gray-700">
                        <span class="block text-2xl font-black text-gray-900 dark:text-white">{{ $articles->total() }}</span>
                        <span class="text-xs text-gray-500 uppercase tracking-wide font-medium">Artikel Dipublikasi</span>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-800 px-5 py-3 rounded-xl border border-gray-100 dark:border-gray-700">
                        <span class="block text-2xl font-black text-gray-900 dark:text-white">{{ $author->created_at->format('Y') }}</span>
                        <span class="text-xs text-gray-500 uppercase tracking-wide font-medium">Bergabung Sejak</span>
                    </div>
                    @php
                        $totalViews = $author->articles()->sum('views_count');
                    @endphp
                    @if($totalViews > 0)
                    <div class="bg-gray-50 dark:bg-gray-800 px-5 py-3 rounded-xl border border-gray-100 dark:border-gray-700">
                        <span class="block text-2xl font-black text-gray-900 dark:text-white">{{ number_format($totalViews) }}</span>
                        <span class="text-xs text-gray-500 uppercase tracking-wide font-medium">Total Pembaca</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Header Ad Banner -->
        <x-ad-banner position="header" />

        <div class="flex items-center justify-between mb-8 mt-12">
            <h2 class="text-2xl font-black text-gray-900 dark:text-white uppercase tracking-tight border-l-4 border-blue-600 pl-3">
                Artikel oleh {{ $author->name }}
            </h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 mb-10">
            <!-- Main Content Area -->
            <div class="lg:col-span-3">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($articles as $article)
                        <x-article-card :article="$article" />
                    @empty
                        <div class="col-span-full py-20 text-center">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-800 mb-4 text-gray-400">
                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Belum ada artikel</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Penulis ini belum mempublikasikan artikel apa pun.</p>
                        </div>
                    @endforelse
                </div>
                
                <!-- Pagination -->
                <div class="mt-10">
                    {{ $articles->links() }}
                </div>
            </div>
            
            <!-- Sidebar Area -->
            <div class="lg:col-span-1 space-y-8">
                <!-- Sidebar Ad Banner -->
                <x-ad-banner position="sidebar" />

                <!-- Back to Home Widget -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 text-center">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Jelajahi lebih banyak berita terkini</p>
                    <a href="{{ route('home') }}" class="inline-flex items-center justify-center w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-lg transition-colors text-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
