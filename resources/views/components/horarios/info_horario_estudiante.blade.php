<div class="overflow-auto mb-8 flex justify-center">
    <table class="border-collapse border border-gray-300" style="min-width: 400px;">
        <thead>
            <tr class="bg-yellow-400 text-white">
                <th class="border p-2 text-left">ASIGNATURA</th>
                <th class="border p-2 text-left">DOCENTE</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($materias as $materia)
                <tr class="hover:bg-gray-100">
                    <td class="border p-2 font-semibold">
                        {{ strtoupper($materia['asignatura']->nombre ?? 'SIN NOMBRE') }}
                    </td>
                    <td class="border p-2">
                        {{ strtoupper($materia['horarios']->first()->docente->user->primer_nombre ?? 'SIN NOMBRE') }}
                        {{ strtoupper($materia['horarios']->first()->docente->user->primer_apellido ?? 'SIN APELLIDO') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
