@props(['article', 'compact' => false])

<article class="group relative flex h-full flex-col overflow-hidden rounded-[1.75rem] border border-gray-100 bg-white shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl hover:shadow-gray-900/10 dark:border-gray-800 dark:bg-gray-900 dark:hover:shadow-black/20">
    <a href="{{ route('article.show', $article->slug ?? '#') }}" class="relative block aspect-[16/10] overflow-hidden bg-gray-100 dark:bg-gray-800">
        @if($article->hasMedia('images'))
            <img src="{{ $article->getFirstMediaUrl('images', 'thumb') }}" alt="{{ $article->title }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
        @else
            <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-blue-50 via-gray-100 to-gray-200 text-gray-400 dark:from-gray-800 dark:via-gray-800 dark:to-gray-700">
                <svg class="h-12 w-12 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15" />
                </svg>
            </div>
        @endif

        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/50 via-transparent to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>

        @if($article->category)
            <span class="absolute left-4 top-4 rounded-full bg-blue-600 px-3 py-1 text-[11px] font-black uppercase tracking-wide text-white shadow-lg shadow-blue-900/20">
                {{ $article->category->name }}
            </span>
        @endif

        @if($article->is_premium)
            <span class="absolute right-4 top-4 rounded-full bg-amber-400 px-3 py-1 text-[11px] font-black uppercase tracking-wide text-amber-950 shadow-lg">
                Premium
            </span>
        @endif
    </a>

    <div class="flex flex-1 flex-col p-5">
        <div class="mb-3 flex flex-wrap items-center gap-2 text-[11px] font-bold uppercase tracking-wide text-gray-500 dark:text-gray-400">
            <span>{{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}</span>
            @if($article->views_count > 0)
                <span class="h-1 w-1 rounded-full bg-gray-300 dark:bg-gray-600"></span>
                <span>{{ number_format($article->views_count) }} dibaca</span>
            @endif
        </div>

        <h3 class="line-clamp-2 text-lg font-black leading-snug text-gray-950 transition-colors group-hover:text-blue-600 dark:text-white dark:group-hover:text-blue-400 {{ $compact ? 'md:text-lg' : 'md:text-xl' }}">
            <a href="{{ route('article.show', $article->slug ?? '#') }}">
                {{ $article->title }}
            </a>
        </h3>

        <p class="mt-3 line-clamp-3 flex-1 text-sm leading-6 text-gray-600 dark:text-gray-300">
            {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 130) }}
        </p>

        <div class="mt-5 flex items-center justify-between border-t border-gray-100 pt-4 dark:border-gray-800">
            <div class="flex min-w-0 items-center gap-2">
                <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-blue-50 text-xs font-black uppercase text-blue-700 ring-1 ring-blue-100 dark:bg-blue-950/50 dark:text-blue-200 dark:ring-blue-900">
                    {{ substr($article->author->name ?? 'R', 0, 1) }}
                </div>
                <span class="truncate text-sm font-bold text-gray-700 dark:text-gray-200">{{ $article->author->name ?? 'Redaksi' }}</span>
            </div>
            <span class="inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-gray-50 text-gray-400 transition-colors group-hover:bg-blue-600 group-hover:text-white dark:bg-gray-800">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </span>
        </div>
    </div>
</article>
