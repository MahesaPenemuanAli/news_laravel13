<x-app-layout>
    @section('title', 'Dashboard - Artikel Tersimpan')

    <div class="py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                <p class="text-sm font-semibold uppercase tracking-wide text-blue-600 dark:text-blue-400">Dashboard Pembaca</p>
                <h1 class="mt-2 text-2xl font-black text-gray-900 dark:text-white">Artikel Tersimpan</h1>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    Kumpulan artikel yang Anda simpan dari tombol bookmark di halaman detail berita.
                </p>
            </div>

            @if($bookmarkedArticles->isNotEmpty())
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($bookmarkedArticles as $article)
                        <x-article-card :article="$article" />
                    @endforeach
                </div>
            @else
                <div class="rounded-2xl border border-dashed border-gray-200 bg-white p-10 text-center shadow-sm dark:border-gray-800 dark:bg-gray-900">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-blue-50 text-blue-600 dark:bg-blue-950/50 dark:text-blue-300">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-4-7 4V5z" />
                        </svg>
                    </div>
                    <h2 class="mt-4 text-lg font-bold text-gray-900 dark:text-white">Belum ada artikel tersimpan</h2>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Buka artikel dan klik tombol Simpan untuk menambahkannya ke dashboard.</p>
                    <a href="{{ route('home') }}" class="mt-5 inline-flex rounded-lg bg-blue-600 px-4 py-2 text-sm font-bold text-white transition-colors hover:bg-blue-700">
                        Jelajahi Berita
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
