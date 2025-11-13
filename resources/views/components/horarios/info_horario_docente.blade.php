@foreach ($materias as $materia)
    <h3 class="text-lg font-medium mt-4 mb-3 text-yellow-700 text-center w-full">
        {{ strtoupper($materia['asignatura']->nombre ?? 'SIN NOMBRE') }}
    </h3>
    </h3>
    <div class="overflow-auto mb-8">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-yellow-400 text-white">
                    <th class="border p-2 text-center">CODIGO</th>
                    <th class="border p-2 text-center">NOMBRES</th>
                    <th class="border p-2 text-center">APELLIDOS</th>
                    <th class="border p-2 text-center">SEMESTRE</th>
                    <th class="border p-2 text-center">CORREO</th>
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
                        <td class="border p-2 text-center">
                            {{ $estudiante->user->email ?? 'N/A' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endforeach
