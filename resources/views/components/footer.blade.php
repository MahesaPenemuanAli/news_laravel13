<footer class="bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800 transition-colors duration-300 mt-auto">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Brand & About -->
            <div class="col-span-1 md:col-span-2">
                <a href="/" class="flex-shrink-0 flex items-center gap-2 mb-4">
                    <span class="text-2xl font-black text-blue-600 dark:text-blue-400">NEWS</span>
                    <span class="text-xl font-bold text-gray-900 dark:text-white">PORTAL</span>
                </a>
                <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed max-w-md">
                    Portal berita terpercaya dan tercepat yang menyajikan informasi terkini dari seluruh penjuru dunia. Dapatkan update berita harian dengan akurasi tinggi dan berimbang.
                </p>
                <div class="mt-6 flex space-x-4">
                    <!-- Social Icons -->
                    <a href="#" class="text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-blue-400 dark:hover:text-blue-300 transition-colors">
                        <span class="sr-only">Twitter</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                    </a>
                </div>
            </div>

            <!-- Dynamic Footer Menu -->
            <div class="col-span-1">
                <h3 class="text-sm font-bold text-gray-900 dark:text-white tracking-wider uppercase mb-4">Navigasi</h3>
                <ul class="space-y-3">
                    @if($menu)
                        @foreach($menu->items as $item)
                            <li>
                                <a href="{{ $item->url ?? ($item->category ? url('/category/' . $item->category->slug) : ($item->page ? url('/page/' . $item->page->slug) : '#')) }}" 
                                   class="text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                    {{ $item->title }}
                                </a>
                            </li>
                        @endforeach
                    @else
                        <li><span class="text-sm text-gray-500">Menu belum disetel.</span></li>
                    @endif
                </ul>
            </div>

            <!-- Subscribe -->
            <div class="col-span-1">
                <h3 class="text-sm font-bold text-gray-900 dark:text-white tracking-wider uppercase mb-4">Newsletter</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Dapatkan berita terbaru langsung di inbox Anda.</p>
                <form class="flex flex-col sm:flex-row gap-2">
                    <input type="email" placeholder="Email address" class="flex-grow rounded-md border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                        Langganan
                    </button>
                </form>
            </div>
        </div>
        
        <div class="mt-12 border-t border-gray-200 dark:border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-sm text-gray-400 dark:text-gray-500">
                &copy; {{ date('Y') }} {{ config('app.name', 'Portal Berita') }}. All rights reserved.
            </p>
        </div>
    </div>
</footer>