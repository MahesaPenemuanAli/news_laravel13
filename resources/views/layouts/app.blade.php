<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ darkMode: localStorage.getItem('theme') === 'dark' }"
      x-init="$watch('darkMode', val => localStorage.setItem('theme', val ? 'dark' : 'light'))"
      x-bind:class="{ 'dark': darkMode }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Portal Berita'))</title>
        <meta name="description" content="@yield('meta_description', 'Portal berita terpercaya dan tercepat. Dapatkan informasi terkini dari berbagai kategori.')">

        <!-- Open Graph Meta -->
        <meta property="og:title" content="@yield('title', config('app.name', 'Portal Berita'))">
        <meta property="og:description" content="@yield('meta_description', 'Portal berita terpercaya dan tercepat.')">
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="{{ config('app.name', 'Portal Berita') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            [x-cloak] { display: none !important; }
        </style>
    </head>
    <body
        class="font-sans antialiased bg-gray-50 text-gray-900 dark:bg-gray-950 dark:text-gray-100 transition-colors duration-300"
        x-data="{ toasts: [] }"
        @toast.window="
            const toast = { id: Date.now() + Math.random(), type: $event.detail.type || 'success', message: $event.detail.message || 'Berhasil diproses.' };
            toasts.push(toast);
            setTimeout(() => { toasts = toasts.filter(item => item.id !== toast.id) }, 4000);
        "
    >
        <div class="min-h-screen flex flex-col">
            <!-- Navbar Component -->
            <x-navbar />

            <!-- Page Content -->
            <main class="flex-grow">
                {{ $slot }}
            </main>

            <!-- Footer Component -->
            <x-footer />
        </div>

        <!-- Back to Top Button -->
        <button x-data="{ show: false }"
                x-on:scroll.window="show = window.scrollY > 500"
                x-show="show"
                x-cloak
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-4"
                @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                class="fixed bottom-6 right-6 z-50 w-12 h-12 bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow-lg flex items-center justify-center transition-all duration-200 hover:scale-110 focus:outline-none">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
            </svg>
        </button>

        <div class="fixed right-4 top-20 z-[80] flex w-[calc(100%-2rem)] max-w-sm flex-col gap-3 sm:right-6">
            <template x-for="toast in toasts" :key="toast.id">
                <div
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-2"
                    class="rounded-lg border bg-white px-4 py-3 text-sm shadow-lg dark:bg-gray-900"
                    :class="{
                        'border-green-200 text-green-800 dark:border-green-900 dark:text-green-200': toast.type === 'success',
                        'border-blue-200 text-blue-800 dark:border-blue-900 dark:text-blue-200': toast.type === 'info',
                        'border-red-200 text-red-800 dark:border-red-900 dark:text-red-200': toast.type === 'error',
                    }"
                >
                    <p class="font-semibold" x-text="toast.message"></p>
                </div>
            </template>
        </div>
    </body>
</html>
