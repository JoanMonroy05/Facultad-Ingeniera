<x-app-layout>
    <x-slot name="header">
        Crear Horarios | Gestión
    </x-slot>

    <div>
        <a href="{{ route('horarios.create') }}"
            class="inline-block bg-blue-600 text-white px-4 py-2 mb-4 rounded hover:bg-blue-700 transition-all">
            <i class="fas fa-plus"></i> Agregar Horario
        </a>
    </div>

    @include('profile.partials.alertas')

    @if ($horarios->isNotEmpty())
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">Asignatura</th>
                        <th class="px-4 py-2 text-left">Docente</th>
                        <th class="px-4 py-2 text-left">Día</th>
                        <th class="px-4 py-2 text-left">Hora Inicio</th>
                        <th class="px-4 py-2 text-left">Hora Fin</th>
                        <th class="px-4 py-2 text-left">Aula</th>
                        <th class="px-4 py-2 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($horarios as $horario)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $horario->id }}</td>
                            <td class="px-4 py-2">{{ $horario->asignatura->nombre ?? 'N/A' }}</td>
                            <td class="px-4 py-2">
                                {{ $horario->docente->user->getNombreCompletoAttribute() ?? 'Sin asignar' }}
                            </td>
                            <td class="px-4 py-2">{{ $horario->dia }}</td>
                            <td class="px-4 py-2">{{ $horario->hora_inicio }}</td>
                            <td class="px-4 py-2">{{ $horario->hora_fin }}</td>
                            <td class="px-4 py-2">{{ $horario->aula ?? 'N/A' }}</td>
                            <td class="px-4 py-2">
                                @include('profile.partials.buttons_accions', [
                                    'routePrefix' => 'horarios',
                                    'model' => $horario,
                                ])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-600">No hay horarios registrados.</p>
    @endif
</x-app-layout>
