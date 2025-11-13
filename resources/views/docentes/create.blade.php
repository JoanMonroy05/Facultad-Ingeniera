<x-app-layout>
    <x-slot name="header">
        Crear Docente | Gestión
    </x-slot>

    <form action="{{ route('docentes.store') }}" method="POST" class="space-y-4 mx-auto p-6 rounded-lg" novalidate>
        @csrf

        @include('docentes.form')

        <button type="submit"
            class="bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 transition-all m-auto block">
            Guardar Docente
        </button>
    </form>
</x-app-layout>
