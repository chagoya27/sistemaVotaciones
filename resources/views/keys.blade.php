<x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Generación de llaves') }}
        </h2>
    </x-slot>

    <form action="{{ route('keys.generate') }}" method="POST">
        @csrf
          <x-primary-button class="m-4">{{ __('Generar') }}</x-primary-button>
    </form>


</x-app-layout>

