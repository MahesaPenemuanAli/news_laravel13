<div wire:poll.visible.10s>
    @if($updates->isNotEmpty())
        <section class="not-prose mb-10 rounded-xl border border-red-200 bg-red-50/80 p-5 shadow-sm dark:border-red-900/60 dark:bg-red-950/30">
            <div class="mb-5 flex items-center justify-between gap-4 border-b border-red-200 pb-4 dark:border-red-900/60">
                <div class="flex items-center gap-3">
                    <span class="relative flex h-3 w-3">
                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-red-500 opacity-75"></span>
                        <span class="relative inline-flex h-3 w-3 rounded-full bg-red-600"></span>
                    </span>
                    <h2 class="text-sm font-black uppercase tracking-[0.2em] text-red-700 dark:text-red-300">Live Update</h2>
                </div>
                <span class="text-xs font-semibold text-red-600 dark:text-red-300">{{ $updates->count() }} update</span>
            </div>

            <div class="space-y-5">
                @foreach($updates as $update)
                    <article class="border-l-2 border-red-500 pl-4">
                        <time class="mb-1 block text-xs font-bold uppercase tracking-wide text-red-600 dark:text-red-300">
                            {{ $update->created_at->format('H:i') }} WIB
                        </time>
                        <p class="text-sm leading-relaxed text-gray-800 dark:text-gray-100">
                            {!! nl2br(e($update->update_content)) !!}
                        </p>
                    </article>
                @endforeach
            </div>
        </section>
    @endif
</div>
