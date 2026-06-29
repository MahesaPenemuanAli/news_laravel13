<div>
    @if($poll)
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
            <h3 class="text-lg font-black text-gray-900 dark:text-white mb-4 uppercase tracking-wider text-center flex items-center justify-center gap-2">
                <svg class="w-5 h-5 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
                Jajak Pendapat
            </h3>
            <p class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-4 text-center">{{ $poll->question }}</p>

            @if($hasVoted)
                <div class="space-y-4">
                    @foreach($poll->options as $option)
                        @php
                            $percentage = $totalVotes > 0 ? round(($option->votes_count / $totalVotes) * 100) : 0;
                        @endphp
                        <div>
                            <div class="mb-1 flex items-center justify-between gap-3 text-sm">
                                <span class="font-medium text-gray-700 dark:text-gray-200">{{ $option->option_text }}</span>
                                <span class="font-bold text-blue-600 dark:text-blue-300">{{ $percentage }}%</span>
                            </div>
                            <div class="h-2 overflow-hidden rounded-full bg-gray-100 dark:bg-gray-700">
                                <div class="h-full rounded-full bg-blue-600 transition-all" @style(['width: ' . $percentage . '%'])></div>
                            </div>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ number_format($option->votes_count) }} suara</p>
                        </div>
                    @endforeach
                    <p class="text-center text-xs font-semibold text-gray-500 dark:text-gray-400">Total {{ number_format($totalVotes) }} suara</p>
                </div>
            @else
                <form wire:submit.prevent="vote" class="space-y-3">
                    @foreach($poll->options as $option)
                        <label class="flex cursor-pointer items-center gap-3 rounded-lg border border-gray-200 p-3 transition-colors hover:border-blue-400 dark:border-gray-600 dark:hover:border-blue-500">
                            <input type="radio" wire:model="selectedOptionId" value="{{ $option->id }}" class="text-blue-600 focus:ring-blue-500">
                            <span class="text-sm text-gray-700 dark:text-gray-300">{{ $option->option_text }}</span>
                        </label>
                    @endforeach
                    @error('selectedOptionId')
                        <p class="text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                    <button type="submit" wire:loading.attr="disabled" wire:target="vote" class="w-full rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition-colors hover:bg-blue-700 disabled:opacity-60">
                        <span wire:loading.remove wire:target="vote">Vote</span>
                        <span wire:loading wire:target="vote">Menyimpan...</span>
                    </button>
                </form>
            @endif
        </div>
    @endif
</div>
