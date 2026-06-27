@props(['articles'])

@php
    $mainArticle = $articles->first();
    $sideArticles = $articles->skip(1)->take(2);
@endphp

@if($mainArticle)
<section class="w-full">
    <div class="relative group overflow-hidden rounded-2xl shadow-lg h-[350px] lg:h-[480px]">
        <a href="{{ route('article.show', $mainArticle->slug ?? '#') }}" class="block w-full h-full">
            @if($mainArticle->hasMedia('images'))
                <img src="{{ $mainArticle->getFirstMediaUrl('images', 'webp-full') }}" alt="{{ $mainArticle->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-in-out">
            @else
                <div class="w-full h-full bg-gradient-to-br from-gray-300 to-gray-400 dark:from-gray-700 dark:to-gray-600 flex items-center justify-center text-gray-500">
                    <svg class="w-16 h-16 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            @endif
            
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/60 to-transparent"></div>
            
            <div class="absolute bottom-0 left-0 p-6 md:p-8 w-full">
                @if($mainArticle->category)
                    <span class="inline-block px-3 py-1 mb-3 text-xs font-bold uppercase tracking-wider text-white bg-blue-600 rounded-full">
                        {{ $mainArticle->category->name }}
                    </span>
                @endif
                <h2 class="text-2xl md:text-4xl font-black text-white leading-tight mb-3 group-hover:text-blue-300 transition-colors">
                    {{ $mainArticle->title }}
                </h2>
                <p class="text-gray-300 text-sm md:text-base line-clamp-2 hidden md:block max-w-3xl">
                    {{ $mainArticle->excerpt ?? Str::limit(strip_tags($mainArticle->content), 150) }}
                </p>
                <div class="flex items-center text-xs text-gray-400 mt-4 space-x-3">
                    <span class="font-medium text-gray-200">{{ $mainArticle->author->name ?? 'Admin' }}</span>
                    <span>&bull;</span>
                    <span>{{ $mainArticle->published_at ? $mainArticle->published_at->format('d M Y') : $mainArticle->created_at->format('d M Y') }}</span>
                </div>
            </div>
        </a>
    </div>
    
    <!-- Side Articles (below on mobile, grid on larger) -->
    @if($sideArticles->isNotEmpty())
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
        @foreach($sideArticles as $article)
        <div class="relative group overflow-hidden rounded-xl shadow-md h-[200px]">
            <a href="{{ route('article.show', $article->slug ?? '#') }}" class="block w-full h-full">
                @if($article->hasMedia('images'))
                    <img src="{{ $article->getFirstMediaUrl('images', 'thumb') }}" alt="{{ $article->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-in-out">
                @else
                    <div class="w-full h-full bg-gradient-to-br from-gray-300 to-gray-400 dark:from-gray-700 dark:to-gray-600 flex items-center justify-center text-gray-500">
                        <svg class="w-8 h-8 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                @endif
                
                <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent"></div>
                
                <div class="absolute bottom-0 left-0 p-5 w-full">
                    @if($article->category)
                        <span class="inline-block px-2 py-0.5 mb-2 text-[10px] font-bold uppercase tracking-wider text-white bg-red-600 rounded-full shadow-sm">
                            {{ $article->category->name }}
                        </span>
                    @endif
                    <h3 class="text-base font-bold text-white leading-snug group-hover:text-red-300 transition-colors line-clamp-2">
                        {{ $article->title }}
                    </h3>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    @endif
</section>
@endif
