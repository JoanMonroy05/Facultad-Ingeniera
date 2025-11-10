<x-app-layout>
    <x-slot name="header">
        Crear Asignatura | Gestión
    </x-slot>
    <div>
        <a href="{{ route('asignaturas.create') }}"
            class="inline-block bg-blue-500 text-white px-4 py-2 mb-4 rounded hover:bg-blue-700"><i
                class="fas fa-plus"></i> Agregar Asignatura</a>
    </div>
    @include('profile.partials.alertas')
    @if ($asignaturas->isNotEmpty())
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">Nombre</th>
                        <th class="px-4 py-2 text-left">Créditos</th>
                        <th class="px-4 py-2 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($asignaturas as $asignatura)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $asignatura->id }}</td>
                            <td class="px-4 py-2">{{ $asignatura->nombre }}</td>
                            <td class="px-4 py-2">{{ $asignatura->creditos }}</td>
                            <td class="px-4 py-2">
                                @include('profile.partials.buttons_accions', [
                                    'routePrefix' => 'asignaturas',
                                    'model' => $asignatura,
                                ])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>No hay docentes registrados.</p>
    @endif
</x-app-layout>
