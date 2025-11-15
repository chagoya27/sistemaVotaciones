<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Last Name 1-->
        <div>
            <x-input-label for="last_name1" :value="__('Apellido Materno')" />
            <x-text-input id="last_name1" class="block mt-1 w-full" type="text" name="last_name1" :value="old('last_name1')" required autofocus autocomplete="last_name1" />
            <x-input-error :messages="$errors->get('last_name1')" class="mt-2" />
        </div>


        <!-- Last Name 2 -->
        <div>
            <x-input-label for="last_name2" :value="__('Apellido Paterno')" />
            <x-text-input id="last_name2" class="block mt-1 w-full" type="text" name="last_name2" :value="old('last_name2')" required autofocus autocomplete="last_name2" />
            <x-input-error :messages="$errors->get('last_name2')" class="mt-2" />
        </div>

        <!-- User Name -->
        <div class="mt-4">
            <x-input-label for="" :value="__('Nombre de Usuario')" />
            <x-text-input id="user_name" class="block mt-1 w-full" type="text" name="user_name" :value="old('user_name')" required autocomplete="user_name" />
            <x-input-error :messages="$errors->get('user_name')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirme su contraseña')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('¿Ya tiene cuenta?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
