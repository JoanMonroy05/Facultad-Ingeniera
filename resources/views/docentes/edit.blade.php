<x-app-layout>
    <x-slot name="header">
        Actualizar Estudiante | Gestión
    </x-slot>

    <form action="{{ route('estudiantes.update', $estudiante->id) }}" method="POST"
        class="space-y-4 mx-auto p-6 rounded-lg" novalidate>
        @csrf
        @method('PUT')

        @include('estudiantes.form')

        <button type="submit"
            class="bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 transition-all m-auto block">
            Actualizar Estudiante
        </button>
    </form>
</x-app-layout>
