<div>
    @auth
        <button
            type="button"
            wire:click="toggle"
            wire:loading.attr="disabled"
            wire:target="toggle"
            class="inline-flex items-center gap-2 rounded-lg border px-4 py-2 text-sm font-bold transition-colors disabled:opacity-60 {{ $bookmarked ? 'border-blue-600 bg-blue-600 text-white hover:bg-blue-700' : 'border-gray-200 bg-white text-gray-700 hover:border-blue-300 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 dark:hover:border-blue-500 dark:hover:text-blue-300' }}"
        >
            <svg class="h-4 w-4" fill="{{ $bookmarked ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-4-7 4V5z" />
            </svg>
            <span>{{ $bookmarked ? 'Tersimpan' : 'Simpan' }}</span>
        </button>
    @else
        <a
            href="{{ route('login') }}"
            class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-bold text-gray-700 transition-colors hover:border-blue-300 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 dark:hover:border-blue-500 dark:hover:text-blue-300"
        >
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-4-7 4V5z" />
            </svg>
            <span>Simpan</span>
        </a>
    @endauth
</div>
