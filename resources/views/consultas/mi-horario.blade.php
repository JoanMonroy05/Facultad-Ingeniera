<x-app-layout>
    <x-slot name="header">
        Mi Horario
    </x-slot>

    <div class="p-6">
        @if ($materias->isEmpty())
            <p class="text-gray-600">No tiene horarios asignados.</p>
        @else
            {{-- Tabla 1 --}}
            @include('components.horarios.horario')
            {{-- Tabla 2 --}}
            @if ($tipo === 'estudiante')
                <h2 class="text-xl font-bold mb-4">Detalle de Asignaturas y Docentes</h2>
                @include('components.horarios.info_horario_estudiante')
            @endif
        @endif
    </div>
</x-app-layout>
