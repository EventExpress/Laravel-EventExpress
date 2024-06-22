<x-guest-layout class="bg-black min-h-screen flex items-center justify-center">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-orange-800" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="bg-gray-700 p-8 ">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('E-mail')" class="text-orange-500" />
            <x-text-input id="email" class="block mt-1 w-full bg-gray-00 text-gray-700 border-orange-500 focus:border-orange-600 focus:ring-orange-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-orange-500" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" class="text-orange-500" />
            <x-text-input id="password" class="block mt-1 w-full bg-gray-00 text-gray-700 border-orange-500 focus:border-orange-600 focus:ring-orange-500" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-orange-500" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-orange-600 shadow-sm focus:ring-orange-500" name="remember">
                <span class="ml-2 text-sm text-orange-500">{{ __('lembrar de mim') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-orange-500 hover:text-orange-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500" href="{{ route('password.request') }}">
                    {{ __('Esqueceu sua senha?') }}
                </a>
            @endif

            <x-primary-button class="ml-3 bg-orange-500 hover:bg-orange-600 focus:bg-orange-600 focus:ring-orange-500">
                {{ __('entrar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
