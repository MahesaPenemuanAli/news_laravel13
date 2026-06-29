<form wire:submit.prevent="subscribe" class="flex flex-col gap-3">
    <div>
        <input
            type="email"
            wire:model.blur="email"
            placeholder="Email Anda"
            class="w-full rounded-lg text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 {{ $variant === 'dark' ? 'border-white/20 bg-white/10 text-white placeholder-blue-200 backdrop-blur-sm' : 'border-gray-300 bg-gray-50 text-gray-900 placeholder-gray-400 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 dark:placeholder-gray-500' }}"
        >
        @error('email')
            <p class="mt-1 text-xs {{ $variant === 'dark' ? 'text-blue-100' : 'text-red-600 dark:text-red-400' }}">{{ $message }}</p>
        @enderror
    </div>

    <button
        type="submit"
        wire:loading.attr="disabled"
        wire:target="subscribe"
        class="w-full rounded-lg px-4 py-2.5 text-sm font-bold transition-colors disabled:opacity-60 {{ $variant === 'dark' ? 'bg-white text-blue-700 hover:bg-blue-50' : 'bg-blue-600 text-white hover:bg-blue-700' }}"
    >
        <span wire:loading.remove wire:target="subscribe">{{ $buttonLabel }}</span>
        <span wire:loading wire:target="subscribe">Mengirim...</span>
    </button>
</form>
