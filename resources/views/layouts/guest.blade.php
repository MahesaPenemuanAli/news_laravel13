<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ darkMode: localStorage.getItem('theme') === 'dark' }"
      x-init="$watch('darkMode', val => localStorage.setItem('theme', val ? 'dark' : 'light'))"
      x-bind:class="{ 'dark': darkMode }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Portal Berita') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-950 antialiased bg-gray-50 dark:bg-gray-950 dark:text-gray-100 transition-colors duration-300">
        <div class="min-h-screen grid lg:grid-cols-12">
            <!-- Left Side: Cover (Hidden on mobile) -->
            <div class="hidden lg:flex lg:col-span-5 relative overflow-hidden bg-slate-950 text-white flex-col justify-between p-12">
                <!-- Background ambient glow effects -->
                <div class="absolute inset-0 opacity-40">
                    <div class="absolute -left-12 top-10 h-96 w-96 rounded-full bg-blue-600 blur-[100px]"></div>
                    <div class="absolute -right-12 bottom-10 h-96 w-96 rounded-full bg-red-600 blur-[100px]"></div>
                </div>
                
                <!-- Brand Logo -->
                <div class="relative z-10">
                    <a href="/" class="text-2xl font-black tracking-tight text-white flex items-center gap-2">
                        <span class="bg-blue-600 text-white px-3 py-1.5 rounded-xl text-lg font-black shadow-lg shadow-blue-500/30">N</span>
                        <span>{{ config('app.name', 'Portal Berita') }}</span>
                    </a>
                </div>

                <!-- Core Message -->
                <div class="relative z-10 my-auto max-w-md">
                    <h2 class="text-4xl font-black leading-tight tracking-tight">Dapatkan Informasi Terpercaya & Tercepat</h2>
                    <p class="mt-5 text-gray-400 leading-relaxed text-base">
                        Masuk untuk menyimpan artikel favorit Anda, berpartisipasi dalam jajak pendapat, serta berdiskusi dengan pembaca lainnya melalui kolom komentar.
                    </p>
                </div>

                <!-- Footer Copyright -->
                <div class="relative z-10 text-xs text-gray-500">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Portal Berita') }}. Hak Cipta Dilindungi.
                </div>
            </div>

            <!-- Right Side: Form Content -->
            <div class="lg:col-span-7 flex flex-col justify-center items-center p-6 sm:p-12 bg-gray-50 dark:bg-gray-950 relative">
                <!-- Theme Toggle Button in Auth Page -->
                <button @click="darkMode = !darkMode" 
                        class="absolute top-6 right-6 p-3 rounded-full bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors shadow-sm focus:outline-none">
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                    <svg x-show="darkMode" x-cloak class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z" /></svg>
                </button>

                <div class="w-full max-w-md">
                    <!-- Brand Logo for Mobile View -->
                    <div class="lg:hidden mb-8 text-center">
                        <a href="/" class="text-3xl font-black tracking-tight text-slate-950 dark:text-white inline-flex items-center gap-2">
                            <span class="bg-blue-600 text-white px-3 py-1.5 rounded-xl text-lg font-black shadow-lg shadow-blue-500/30">N</span>
                            <span>{{ config('app.name', 'Portal Berita') }}</span>
                        </a>
                    </div>

                    <!-- Main Auth Card -->
                    <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-3xl shadow-xl shadow-gray-200/50 dark:shadow-none p-8 sm:p-10 transition-colors">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
