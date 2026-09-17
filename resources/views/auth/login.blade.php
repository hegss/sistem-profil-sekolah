<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="relative">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-5 relative">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded bg-gray-300 dark:bg-gray-400 border-gray-300 dark:border-gray-400 text-blue-500 shadow-sm focus:ring-blue-500 dark:focus:ring-offset-gray-300"
                    name="remember">
                <span class="ms-2 text-sm text-gray-900 dark:text-gray-200">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-900 dark:text-gray-200 hover:text-gray-500 rounded-md focus:outline-none"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <!-- Login Button -->
        <div class="flex items-center justify-center w-full mt-4">
            <x-auth-primary-button>
                {{ __('Log in') }}
            </x-auth-primary-button>
        </div>

        <!-- Register -->
        <div class="flex items-center justify-center w-full mt-4">
            <p class="text-gray-900 dark:text-gray-200 mr-1 text-sm">Don't have account?</p>
            <a class="underline text-sm text-gray-900 dark:text-gray-200 hover:text-gray-500"
                href="{{ route('register') }}">
                {{ __('Register') }}
            </a>
        </div>
    </form>
</x-guest-layout>
