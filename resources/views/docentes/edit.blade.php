<x-app-layout>
    <x-slot name="header">
        Actualizar Docente | Gestión
    </x-slot>

    <form action="{{ route('docentes.update', $docente->id) }}" method="POST"
        class="space-y-4 mx-auto p-6 rounded-lg" novalidate>
        @csrf
        @method('PUT')

        @include('docentes.form')

        <button type="submit"
            class="bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 transition-all m-auto block">
            Actualizar Docente
        </button>
    </form>
</x-app-layout>
