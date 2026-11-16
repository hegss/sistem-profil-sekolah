<x-guest-layout>
    <div class="space-y-7">

        <!-- Header Logo & Title -->
        <div class="text-center space-y-3">
            <div class="inline-flex items-center justify-center p-2.5 rounded-2xl bg-[#F4EBE8] dark:bg-slate-700 shadow-sm border border-rose-100/60 dark:border-slate-600">
                <x-application-logo class="size-12 object-contain" />
            </div>
            <div>
                <h1 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">Lupa Kata Sandi?</h1>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 leading-relaxed max-w-sm mx-auto">
                    Tidak masalah. Masukkan alamat email terdaftar Anda dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda.
                </p>
            </div>
        </div>

        <!-- Session Status Alert (Notifikasi Email Terkirim) -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Form Forgot Password -->
        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <!-- Email Address Input -->
            <div class="space-y-1.5">
                <label for="email" class="block text-xs font-bold text-slate-700 dark:text-slate-300">
                    Alamat Email Terdaftar
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

            <!-- Submit Button -->
            <div class="pt-2 space-y-3">
                <button type="submit"
                        class="w-full py-3.5 rounded-2xl bg-red-900 hover:bg-red-950 text-white font-black text-xs sm:text-sm tracking-wider uppercase shadow-lg shadow-rose-900/20 hover:shadow-xl transition duration-300">
                    Kirim Tautan Reset Password
                </button>

                <!-- Back to Login Button -->
                <a href="{{ route('login') }}"
                   class="w-full py-3 rounded-2xl border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700/50 text-slate-700 dark:text-slate-300 font-bold text-xs tracking-wide flex items-center justify-center gap-2 transition">
                    <svg class="size-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    <span>Kembali ke Halaman Login</span>
                </a>
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
