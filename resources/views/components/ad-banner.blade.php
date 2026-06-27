@if($ad)
<div class="w-full flex justify-center items-center my-6 overflow-hidden bg-gray-50 dark:bg-gray-800/50 rounded-lg {{ $position === 'sidebar' ? 'min-h-[250px]' : 'min-h-[90px]' }} transition-colors duration-300">
    <div class="w-full text-center group">
        <span class="text-[10px] uppercase tracking-widest text-gray-400 dark:text-gray-500 block mb-1 mt-1">Advertisement</span>
        <a href="{{ $ad->target_url ?? '#' }}" target="_blank" rel="noopener noreferrer" class="inline-block relative">
            @if($ad->image_url)
                <img src="{{ Storage::url($ad->image_url) }}" alt="{{ $ad->name }}" class="mx-auto max-w-full h-auto object-contain rounded shadow-sm opacity-90 group-hover:opacity-100 transition-opacity">
            @else
                <div class="w-full h-full flex items-center justify-center text-gray-400 dark:text-gray-500 border border-dashed border-gray-300 dark:border-gray-700 p-4">
                    {{ $ad->name }}
                </div>
            @endif
        </a>
    </div>
</div>
@else
<!-- Ad Placeholder (Prevent CLS) -->
<div class="w-full my-6 bg-gray-50 dark:bg-gray-800/30 rounded-lg {{ $position === 'sidebar' ? 'min-h-[250px]' : 'min-h-[90px]' }} flex flex-col items-center justify-center border border-dashed border-gray-200 dark:border-gray-700 transition-colors duration-300">
    <span class="text-[10px] uppercase tracking-widest text-gray-300 dark:text-gray-600 mb-1">Advertisement Space</span>
</div>
@endif
