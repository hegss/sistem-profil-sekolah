<x-guest-layout>
    <div class="space-y-7" x-data="{ showPassword: false }">

        <!-- Header Logo & Title -->
        <div class="text-center space-y-3">
            <div class="inline-flex items-center justify-center p-2.5 rounded-2xl bg-[#F4EBE8] dark:bg-slate-700 shadow-sm border border-rose-100/60 dark:border-slate-600">
                <x-application-logo class="size-12 object-contain" />
            </div>
            <div>
                <h1 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">Selamat Datang Kembali</h1>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                    Silakan masuk dengan kredensial akun Anda untuk mengakses sistem.
                </p>
            </div>
        </div>

        <!-- Session Status Alert -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Form Login -->
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email / Username Input -->
            <div class="space-y-1.5">
                <label for="email" class="block text-xs font-bold text-slate-700 dark:text-slate-300">
                    Email
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                        <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                    </span>
                    <input id="email"
                           type="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           placeholder="nama@sdngedong12.sch.id"
                           class="w-full pl-10 pr-4 py-3 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-xs sm:text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-red-900 focus:border-transparent transition placeholder:text-slate-400">
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
            </div>

            <!-- Password Input -->
            <div class="space-y-1.5">
                <label for="password" class="block text-xs font-bold text-slate-700 dark:text-slate-300">
                    Kata Sandi
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                        <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </span>
                    <input id="password"
                           :type="showPassword ? 'text' : 'password'"
                           name="password"
                           required
                           placeholder="••••••••"
                           class="w-full pl-10 pr-10 py-3 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-xs sm:text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-red-900 focus:border-transparent transition placeholder:text-slate-400">

                    <!-- Toggle Show/Hide Password Button -->
                    <button type="button"
                            @click="showPassword = !showPassword"
                            class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 focus:outline-none">
                        <svg x-show="!showPassword" class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        <svg x-show="showPassword" x-cloak class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.025 10.025 0 0110.123 2.937m-2.93 2.93a3 3 0 01-4.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/></svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between text-xs pt-1">
                <label for="remember_me" class="inline-flex items-center gap-2 cursor-pointer">
                    <input id="remember_me"
                           type="checkbox"
                           name="remember"
                           class="rounded-md border-slate-300 dark:border-slate-700 text-red-900 focus:ring-red-900 dark:bg-slate-900 size-4">
                    <span class="text-slate-600 dark:text-slate-400 font-medium">Ingat saya</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="font-bold text-red-900 dark:text-rose-400 hover:underline">
                        Lupa kata sandi?
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <div class="pt-3">
                <button type="submit"
                        class="w-full py-3.5 rounded-2xl bg-red-900 hover:bg-red-950 text-white font-black text-xs sm:text-sm tracking-wider uppercase shadow-lg shadow-rose-900/20 hover:shadow-xl transition duration-300">
                    Masuk ke Sistem
                </button>
            </div>

        </form>

        <!-- Footer Text -->
        <div class="text-center pt-4 border-t border-slate-100 dark:border-slate-700">
            <p class="text-[11px] text-slate-400">
                &copy; {{ date('Y') }} SDN Gedong 12 Jakarta Timur. Hak Cipta Dilindungi.
            </p>
        </div>

    </div>
</x-guest-layout>
