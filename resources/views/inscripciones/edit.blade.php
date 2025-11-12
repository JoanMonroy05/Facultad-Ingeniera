<x-app-layout>
    <x-slot name="header">
        Editar Inscripción | Gestión
    </x-slot>

    <form action="{{ route('inscripciones.update', $inscripcion->id) }}" method="POST"
        class="space-y-4 mx-auto p-6 rounded-lg" novalidate>
        @csrf
        @method('PUT')

        @include('inscripciones.form')

        <button type="submit"
            class="bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 transition-all m-auto block">
            Actualizar Inscripción
        </button>
    </form>
</x-app-layout>