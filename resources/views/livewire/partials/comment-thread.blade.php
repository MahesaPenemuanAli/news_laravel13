@foreach($comments as $comment)
    <article wire:key="comment-{{ $comment->id }}" class="rounded-xl border border-gray-100 bg-white p-4 dark:border-gray-800 dark:bg-gray-900/70">
        <div class="flex items-start gap-3">
            <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 text-sm font-black uppercase text-blue-700 dark:bg-blue-900 dark:text-blue-200">
                {{ substr($comment->user->name ?? 'U', 0, 1) }}
            </div>
            <div class="min-w-0 flex-1">
                <div class="flex flex-wrap items-center gap-2">
                    <h3 class="font-bold text-gray-900 dark:text-white">{{ $comment->user->name ?? 'User' }}</h3>
                    <span class="text-xs text-gray-500 dark:text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                </div>
                <p class="mt-2 whitespace-pre-line text-sm leading-relaxed text-gray-700 dark:text-gray-200">{{ $comment->body }}</p>

                @auth
                    <button type="button" wire:click="startReply({{ $comment->id }})" class="mt-3 text-xs font-bold uppercase tracking-wide text-blue-600 hover:text-blue-800 dark:text-blue-300 dark:hover:text-blue-200">
                        Balas
                    </button>
                @endauth
            </div>
        </div>

        @if($replyingTo === $comment->id)
            <form wire:submit.prevent="postReply({{ $comment->id }})" class="ml-12 mt-4 rounded-lg bg-gray-50 p-3 dark:bg-gray-800/60">
                <textarea
                    wire:model="replyBodies.{{ $comment->id }}"
                    rows="3"
                    placeholder="Tulis balasan..."
                    class="w-full rounded-lg border-gray-300 text-sm text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100"
                ></textarea>
                @if($errors->has('replyBodies.' . $comment->id))
                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $errors->first('replyBodies.' . $comment->id) }}</p>
                @endif
                <div class="mt-2 flex justify-end gap-2">
                    <button type="button" wire:click="cancelReply" class="rounded-lg px-3 py-2 text-xs font-bold text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">Batal</button>
                    <button type="submit" wire:loading.attr="disabled" wire:target="postReply({{ $comment->id }})" class="rounded-lg bg-blue-600 px-3 py-2 text-xs font-bold text-white hover:bg-blue-700 disabled:opacity-60">
                        <span wire:loading.remove wire:target="postReply({{ $comment->id }})">Kirim Balasan</span>
                        <span wire:loading wire:target="postReply({{ $comment->id }})">Mengirim...</span>
                    </button>
                </div>
            </form>
        @endif

        @if($comment->approvedRepliesRecursive->isNotEmpty())
            <div class="mt-4 space-y-4 border-l border-gray-100 pl-4 dark:border-gray-800 {{ $level === 0 ? 'ml-12' : 'ml-6' }}">
                @include('livewire.partials.comment-thread', ['comments' => $comment->approvedRepliesRecursive, 'level' => $level + 1])
            </div>
        @endif
    </article>
@endforeach
