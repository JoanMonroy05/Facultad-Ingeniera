<x-app-layout>
    <x-slot name="header">
        Crear Inscripción | Gestión
    </x-slot>

    <form action="{{ route('inscripciones.store') }}" method="POST"
        class="space-y-4 mx-auto p-6 rounded-lg" novalidate>
        @csrf

        @include('inscripciones.form')

        <button type="submit"
            class="bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 transition-all m-auto block">
            Guardar Inscripción
        </button>
    </form>
</x-app-layout>