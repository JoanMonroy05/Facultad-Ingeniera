<x-app-layout>
    <x-slot name="header">
        {{ $asignatura->nombre }} | Horarios asignados
    </x-slot>

    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-lg font-semibold mb-4">Horarios de la asignatura</h2>

        @if ($asignatura->horarios->isNotEmpty())
            <table class="min-w-full border border-gray-300 rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Día</th>
                        <th class="px-4 py-2 text-left">Hora Inicio</th>
                        <th class="px-4 py-2 text-left">Hora Fin</th>
                        <th class="px-4 py-2 text-left">Aula</th>
                        <th class="px-4 py-2 text-left">Docente</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($asignatura->horarios as $horario)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $horario->dia }}</td>
                            <td class="px-4 py-2">{{ $horario->hora_inicio }}</td>
                            <td class="px-4 py-2">{{ $horario->hora_fin }}</td>
                            <td class="px-4 py-2">{{ $horario->aula }}</td>
                            <td class="px-4 py-2">
                                {{ $horario->docente->user->name ?? 'Sin asignar' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-600">No hay horarios asignados a esta asignatura.</p>
        @endif
    </div>
</x-app-layout>
