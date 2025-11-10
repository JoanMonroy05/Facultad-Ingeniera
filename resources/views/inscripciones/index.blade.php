<x-app-layout>
    <x-slot name="header">
        Gestión de Inscripciones
    </x-slot>

    <div>
        <a href="{{ route('inscripciones.create') }}"
            class="inline-block bg-blue-600 text-white px-4 py-2 mb-4 rounded hover:bg-blue-700 transition-all">
            <i class="fas fa-plus"></i> Nueva Inscripción
        </a>
    </div>

    @include('profile.partials.alertas')

    @if ($inscripciones->isNotEmpty())
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">Estudiante</th>
                        <th class="px-4 py-2 text-left">Asignatura</th>
                        <th class="px-4 py-2 text-left">Créditos</th>
                        <th class="px-4 py-2 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inscripciones as $inscripcion)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $inscripcion->id }}</td>
                            <td class="px-4 py-2">
                                {{ $inscripcion->estudiante->user->primer_nombre }}
                                {{ $inscripcion->estudiante->user->primer_apellido }}
                            </td>
                            <td class="px-4 py-2">{{ $inscripcion->asignatura->nombre }}</td>
                            <td class="px-4 py-2">{{ $inscripcion->asignatura->creditos }}</td>
                            <td class="px-4 py-2">
                                @include('profile.partials.buttons_accions', [
                                    'routePrefix' => 'inscripciones',
                                    'model' => $inscripcion,
                                ])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-600">No hay inscripciones registradas.</p>
    @endif
</x-app-layout>
