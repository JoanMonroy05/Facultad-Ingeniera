@foreach ($materias as $materia)
    <h3 class="font-semibold mt-4">
        {{ $materia['asignatura']->nombre ?? 'SIN NOMBRE' }}
    </h3>
    <div class="overflow-auto mb-8">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-yellow-400 text-white">
                    <th class="border p-2 text-center">CODIGO</th>
                    <th class="border p-2 text-center">NOMBRE</th>
                    <th class="border p-2 text-center">APELLIDO</th>
                    <th class="border p-2 text-center">SEMESTRE</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materia['estudiantes'] as $estudiante)
                    <tr class="hover:bg-gray-100">
                        <td class="border p-2 text-center">
                            {{ $estudiante->codigo ?? 'N/A' }}
                        </td>
                        <td class="border p-2 text-center">
                            {{ strtoupper($estudiante->user->primer_nombre ?? 'SIN NOMBRE') }} {{ strtoupper($estudiante->user->segundo_nombre ?? '') }}
                        </td>
                        <td class="border p-2 text-center">
                            {{ strtoupper($estudiante->user->primer_apellido ?? 'SIN APELLIDO') }} {{ strtoupper($estudiante->user->segundo_apellido ?? '') }}
                        </td>
                        <td class="border p-2 text-center">
                            {{ $estudiante->semestre ?? 'N/A' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endforeach
