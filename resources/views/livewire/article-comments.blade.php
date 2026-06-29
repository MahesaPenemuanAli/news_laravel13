<section class="mt-10 border-t border-gray-100 pt-8 dark:border-gray-800">
    <div class="mb-6 flex items-center justify-between gap-4">
        <h2 class="text-xl font-black uppercase tracking-tight text-gray-900 dark:text-white">Komentar</h2>
        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-bold text-gray-600 dark:bg-gray-800 dark:text-gray-300">
            {{ $commentsCount }} diskusi
        </span>
    </div>

    @auth
        <form wire:submit.prevent="postComment" class="mb-8 rounded-xl border border-gray-100 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800/60">
            <textarea
                wire:model="body"
                rows="4"
                placeholder="Tulis komentar Anda..."
                class="w-full rounded-lg border-gray-300 text-sm text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100"
            ></textarea>
            @error('body')
                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
            <div class="mt-3 flex justify-end">
                <button type="submit" wire:loading.attr="disabled" wire:target="postComment" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-bold text-white transition-colors hover:bg-blue-700 disabled:opacity-60">
                    <span wire:loading.remove wire:target="postComment">Kirim Komentar</span>
                    <span wire:loading wire:target="postComment">Mengirim...</span>
                </button>
            </div>
        </form>
    @else
        <div class="mb-8 rounded-xl border border-blue-100 bg-blue-50 p-4 text-sm text-blue-800 dark:border-blue-900/60 dark:bg-blue-950/40 dark:text-blue-100">
            <a href="{{ route('login') }}" class="font-bold underline">Masuk</a> untuk ikut berdiskusi.
        </div>
    @endauth

    @if($comments->isNotEmpty())
        <div class="space-y-5">
            @include('livewire.partials.comment-thread', ['comments' => $comments, 'level' => 0])
        </div>
    @else
        <div class="rounded-xl border border-dashed border-gray-200 p-8 text-center text-sm text-gray-500 dark:border-gray-700 dark:text-gray-400">
            Belum ada komentar. Jadilah yang pertama berdiskusi.
        </div>
    @endif
</section>
