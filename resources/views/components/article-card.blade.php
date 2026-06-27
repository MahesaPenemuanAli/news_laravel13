@props(['article'])

<article class="flex flex-col bg-white dark:bg-gray-800 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden group border border-gray-100 dark:border-gray-700 h-full">
    <!-- Image Container -->
    <a href="{{ route('article.show', $article->slug ?? '#') }}" class="relative w-full aspect-[4/3] overflow-hidden bg-gray-200 dark:bg-gray-700 block">
        @if($article->hasMedia('images'))
            <img src="{{ $article->getFirstMediaUrl('images', 'thumb') }}" alt="{{ $article->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500 ease-in-out">
        @else
            <div class="w-full h-full flex items-center justify-center text-gray-400 dark:text-gray-500">
                <svg class="w-12 h-12 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        @endif
        
        <!-- Category Badge -->
        @if($article->category)
            <div class="absolute top-4 left-4 z-10">
                <span class="px-3 py-1 text-xs font-bold uppercase tracking-wider text-white bg-blue-600/90 backdrop-blur-sm rounded-full shadow-sm">
                    {{ $article->category->name }}
                </span>
            </div>
        @endif
        
        <!-- Overlay Gradient for text readability if needed -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
    </a>

    <!-- Content -->
    <div class="p-5 flex flex-col flex-grow">
        <!-- Meta Data -->
        <div class="flex items-center text-xs text-gray-500 dark:text-gray-400 mb-3 space-x-3">
            <div class="flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>{{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}</span>
            </div>
            @if($article->views_count > 0)
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <span>{{ number_format($article->views_count) }}</span>
                </div>
            @endif
        </div>

        <!-- Title -->
        <h3 class="text-xl font-bold text-gray-900 dark:text-white leading-snug mb-2 line-clamp-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
            <a href="{{ route('article.show', $article->slug ?? '#') }}" class="focus:outline-none">
                <span class="absolute inset-0" aria-hidden="true"></span>
                {{ $article->title }}
            </a>
        </h3>

        <!-- Excerpt -->
        <p class="text-gray-600 dark:text-gray-300 text-sm line-clamp-3 mb-4 flex-grow">
            {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 120) }}
        </p>

        <!-- Footer: Author -->
        <div class="mt-auto pt-4 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-700 dark:text-blue-300 font-bold text-xs uppercase overflow-hidden">
                    {{ substr($article->author->name ?? 'A', 0, 1) }}
                </div>
                <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ $article->author->name ?? 'Admin' }}
                </span>
            </div>
            
            @if($article->is_premium)
                <span class="flex items-center text-xs font-bold text-amber-500 bg-amber-50 dark:bg-amber-900/30 px-2 py-1 rounded-md">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 01.967.744L14.146 7.2 17.5 9.134a1 1 0 010 1.732l-3.354 1.935-1.18 4.455a1 1 0 01-1.933 0L9.854 12.8l-3.354-1.935a1 1 0 010-1.732l3.354-1.935 1.18-4.455A1 1 0 0112 2z" clip-rule="evenodd" />
                    </svg>
                    PREMIUM
                </span>
            @endif
        </div>
    </div>
</article>
