<x-app-layout>
    <x-slot name="header">
        Crear Docente | Gestión
    </x-slot>

    <div>
        <a href="{{ route('docentes.create') }}"
            class="inline-block bg-blue-500 text-white px-4 py-2 mb-4 rounded hover:bg-blue-700"><i
                class="fas fa-plus"></i> Agregar Docente</a>
    </div>
    @include('profile.partials.alertas')
    @if ($docentes->isNotEmpty())
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">Codigo</th>
                        <th class="px-4 py-2 text-left">Nombre</th>
                        <th class="px-4 py-2 text-left">Apellido</th>
                        <th class="px-4 py-2 text-left">Especialidad</th>
                        <th class="px-4 py-2 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($docentes as $docente)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $docente->id }}</td>
                            <td class="px-4 py-2">{{ $docente->codigo }}</td>
                            <td class="px-4 py-2">
                                {{ $docente->user->primer_nombre . ($docente->user->segundo_nombre ? ' ' . $docente->user->segundo_nombre : '') }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $docente->user->primer_apellido . ' ' . $docente->user->segundo_apellido }}
                            </td>
                            <td class="px-4 py-2">{{ $docente->especialidad }}</td>
                            <td class="px-4 py-2">
                                @include('profile.partials.buttons_accions', [
                                    'routePrefix' => 'docentes',
                                    'model' => $docente,
                                ])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>No hay estudiantes registrados.</p>
    @endif
</x-app-layout>
