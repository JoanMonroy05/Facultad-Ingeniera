<x-guest-layout>

    <div class="mb-6 text-center">
        <h2 class="mt-4 text-2xl font-extrabold text-gray-900">Iniciar sesión</h2>
        <p class="mt-1 text-sm text-gray-600">Introduce tus credenciales para acceder</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" />
            <x-text-input id="email"
                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Contraseña')" />
            <x-text-input id="password"
                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <div class="text-sm">
                @if (Route::has('password.request'))
                    <a class="font-medium text-indigo-600 hover:text-indigo-500" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>
            <div class="text-sm">
                @if (Route::has('register'))
                    <a class="font-medium text-gray-600 hover:text-gray-800" href="{{ route('register') }}">
                        Crear cuenta
                    </a>
                @endif
            </div>
        </div>

        <div>
            <x-primary-button class="w-full justify-center py-2">
                {{ __('Iniciar sesión') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
