<x-guest-layout>
    <!-- Header -->
    <div class="mb-8 text-center sm:text-left">
        <h2 class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">Daftar Akun</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Buat akun Anda untuk mulai menyimpan artikel, berdiskusi, dan menerima newsletter terbaru.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300">Nama Lengkap</label>
            <div class="mt-2 relative rounded-xl shadow-sm">
                <input id="name" 
                       class="block w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:text-white transition-all" 
                       type="text" 
                       name="name" 
                       :value="old('name')" 
                       required 
                       autofocus 
                       placeholder="Nama Lengkap Anda"
                       autocomplete="name" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs text-red-500" />
        </div>

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
                       placeholder="nama@email.com"
                       autocomplete="username" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-500" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300">Kata Sandi</label>
            <div class="mt-2 relative rounded-xl shadow-sm">
                <input id="password" 
                       class="block w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:text-white transition-all"
                       type="password"
                       name="password"
                       required 
                       placeholder="Minimal 8 karakter"
                       autocomplete="new-password" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-500" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300">Konfirmasi Kata Sandi</label>
            <div class="mt-2 relative rounded-xl shadow-sm">
                <input id="password_confirmation" 
                       class="block w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:text-white transition-all"
                       type="password"
                       name="password_confirmation" 
                       required 
                       placeholder="Ulangi kata sandi"
                       autocomplete="new-password" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs text-red-500" />
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-150 hover:scale-[1.01] active:scale-[0.99] shadow-blue-500/25">
                Daftar Sekarang
            </button>
        </div>

        <!-- Login Link -->
        <div class="pt-4 border-t border-gray-100 dark:border-gray-800 text-center text-xs text-gray-500 dark:text-gray-400">
            Sudah memiliki akun? 
            <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 transition-colors">
                Masuk Di Sini
            </a>
        </div>
    </form>
</x-guest-layout>
