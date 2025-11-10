<x-app-layout>
    <x-slot name="header">
        Actualizar Asignatura | Gestión
    </x-slot>
    <form action="{{ route('asignaturas.update', $asignatura->id) }}" method="POST"
        class="space-y-4 mx-auto p-6 rounded-lg" novalidate>
        @include('profile.partials.alertas')
        @csrf
        @method('PUT')

        @include('asignaturas.form')

        <button type="submit"
            class="bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 transition-all m-auto block">
            Actualizar Asignatura
        </button>
    </form>
</x-app-layout>
