<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
            
        </div>
    </form>

    <div class="flex items-center justify-center mt-4">
        <a href="{{ route('auth.google') }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded flex items-center">
            <svg class="w-5 h-5 mr-2" viewBox="0 0 48 48"><g><path fill="#FFC107" d="M43.6 20.5h-1.9V20H24v8h11.1c-1.5 4.3-5.6 7.5-11.1 7.5-6.6 0-12-5.4-12-12s5.4-12 12-12c3.1 0 5.9 1.1 8.1 3l6.1-6.1C35.1 5.7 29.8 3.5 24 3.5 12.8 3.5 3.5 12.8 3.5 24S12.8 44.5 24 44.5c11.2 0 20.5-9.3 20.5-20.5 0-1.4-.1-2.7-.4-4z"/><path fill="#FF3D00" d="M6.3 14.7l6.7 4.9C14.7 16.1 19 13.5 24 13.5c3.1 0 5.9 1.1 8.1 3l6.1-6.1C35.1 5.7 29.8 3.5 24 3.5c-7.1 0-13.2 3.6-16.7 9.2z"/><path fill="#4CAF50" d="M24 44.5c5.8 0 11.1-2.2 15.1-5.8l-7.1-5.8c-2.1 1.4-4.8 2.3-8 2.3-5.5 0-10.2-3.2-12.1-7.8l-7.1 5.5C7.1 40.9 15 44.5 24 44.5z"/><path fill="#1976D2" d="M43.6 20.5h-1.9V20H24v8h11.1c-1.2 3.3-4.2 5.7-8.1 5.7-5.5 0-10.2-3.2-12.1-7.8l-7.1 5.5C7.1 40.9 15 44.5 24 44.5c11.2 0 20.5-9.3 20.5-20.5 0-1.4-.1-2.7-.4-4z"/></g></svg>
            Đăng nhập bằng Google
        </a>
    </div>
</x-guest-layout>
