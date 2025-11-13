<x-app-layout>
    <x-slot name="header">
        Actualizar Horario | Gestión
    </x-slot>
    {{-- Formulario para crear un horario --}}
    <form action="{{ route('horarios.update', $horario->id) }}" method="POST"
        class="space-y-4 mx-auto p-6 rounded-lg" novalidate>
        @include('profile.partials.alertas')
        @csrf
        @method('PUT')

        @include('horarios.form')

        <button type="submit"
            class="bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 transition-all m-auto block">
            Actualizar Horario
        </button>
    </form>
</x-app-layout>
