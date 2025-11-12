<div class="overflow-auto mb-8">
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-yellow-400 text-white">
                <th class="border p-2 text-left">ASIGNATURA</th>
                @foreach ($dias as $dia)
                    <th class="border p-2 text-center">{{ strtoupper($dia) }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse ($materias as $materia)
                <tr class="hover:bg-gray-100">
                    <td class="border p-2 font-semibold">
                        {{ strtoupper($materia['asignatura']->nombre ?? 'SIN NOMBRE') }}
                    </td>

                    @foreach ($dias as $dia)
                        <td class="border p-2 text-center">
                            @php
                                $horariosDia = $materia['horarios']
                                    ->where('dia', $dia)
                                    ->unique(fn($item) => $item->hora_inicio . $item->hora_fin);
                            @endphp

                            @forelse ($horariosDia as $h)
                                <div class="text-sm">
                                    {{ $h->hora_inicio }} - {{ $h->hora_fin }}
                                    <br>
                                    <span class="text-gray-500 text-xs">
                                        {{ $h->aula ?? '' }}
                                    </span>
                                </div>
                            @empty
                                <span class="text-gray-400 text-xs">—</span>
                            @endforelse
                        </td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($dias) + 1 }}" class="text-center text-gray-500 p-4">
                        No se encontraron materias o inscripciones para mostrar.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
