<x-app-layout>
    <x-slot name="header">
        Consultar Horarios | Gestión
    </x-slot>
    <div class="mx-auto">
        {{-- Formulario --}}
        <form action="{{ route('consultas.buscar') }}" method="POST" class="space-y-4 mx-auto p-6 rounded-lg">
            @csrf
            @include('profile.partials.alertas')
            @include('consultas.form')
            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Consultar
            </button>
    </div>
    </form>

    {{-- Resultados --}}
    @if($tipo)
        <h2 class="text-xl font-bold mb-4">
            Resultado para {{ ucfirst($tipo) }}: <span class="text-blue-700">{{ $nombre }}</span>
        </h2>
        @if($materias->isEmpty())
            <p class="text-gray-600">No tiene horarios asignados.</p>
        @else
            {{-- Tabla 1 --}}
            @include('consultas.horario')
            {{-- Tabla 2 --}}
            @if ($tipo === 'estudiante')
                <h2 class="text-xl font-bold mb-4">Detalle de Asignaturas y Docentes</h2>
                @include('consultas.info_horario_estudiante')
            @else
                <h2 class="text-xl font-bold mb-4">Detalle de Asignaturas y Estudiantes</h2>
                @include('consultas.info_horario_docente')
            @endif
        @endif
    @endif
    </div>
</x-app-layout>
