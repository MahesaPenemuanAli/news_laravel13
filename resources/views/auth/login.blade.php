<x-guest-layout>
    <!-- Header -->
    <div class="mb-8 text-center sm:text-left">
        <h2 class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">Masuk Akun</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Selamat datang kembali! Silakan masuk untuk melanjutkan membaca dan berpartisipasi.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300">Alamat Email</label>
            <div class="mt-2 relative rounded-xl shadow-sm">
                <input id="email" 
                       class="block w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:text-white transition-all" 
                       type="email" 
                       name="email" 
                       :value="old('email')" 
                       required 
                       autofocus 
                       placeholder="nama@email.com"
                       autocomplete="username" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-500" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex justify-between items-center">
                <label for="password" class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300">Kata Sandi</label>
                @if (Route::has('password.request'))
                    <a class="text-xs font-semibold text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 transition-colors" href="{{ route('password.request') }}">
                        Lupa sandi?
                    </a>
                @endif
            </div>
            <div class="mt-2 relative rounded-xl shadow-sm">
                <input id="password" 
                       class="block w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:text-white transition-all"
                       type="password"
                       name="password"
                       required 
                       placeholder="••••••••"
                       autocomplete="current-password" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-500" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded-lg border-gray-200 dark:border-gray-700 text-blue-600 shadow-sm focus:ring-blue-500 focus:ring-offset-0 bg-gray-50 dark:bg-gray-800" name="remember">
                <span class="ms-2 text-xs font-semibold text-gray-600 dark:text-gray-400">Ingat perangkat ini</span>
            </label>
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-150 hover:scale-[1.01] active:scale-[0.99] shadow-blue-500/25">
                Masuk Sekarang
            </button>
        </div>

        <!-- Register Link -->
        <div class="pt-4 border-t border-gray-100 dark:border-gray-800 text-center text-xs text-gray-500 dark:text-gray-400">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 transition-colors">
                Daftar Baru
            </a>
        </div>
    </form>
</x-guest-layout>
