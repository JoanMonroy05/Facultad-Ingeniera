<div class="flex items-center mb-3">
    <label for="asignatura_id" class="block text-gray-700 font-semibold w-32">Asignatura</label>
    <select name="asignatura_id" class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" required>
        <option value="">Seleccione una asignatura</option>
        @foreach ($asignaturas as $asignatura)
            <option value="{{ $asignatura->id }}" 
                {{ old('asignatura_id', $horario->asignatura_id ?? '') == $asignatura->id ? 'selected' : '' }}>
                {{ $asignatura->nombre }}
            </option>
        @endforeach
    </select>
</div>

<div class="flex items-center mb-3">
    <label for="docente_id" class="block text-gray-700 font-semibold w-32">Docente</label>
    <select name="docente_id" class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" required>
        <option value="">Seleccione un docente</option>
        @foreach ($docentes as $docente)
            <option value="{{ $docente->id }}" 
                {{ old('docente_id', $horario->docente_id ?? '') == $docente->id ? 'selected' : '' }}>
                {{ $docente->user->nombre_completo }}
            </option>
        @endforeach
    </select>
</div>

<div class="flex items-center mb-3">
    <label for="dia" class="block text-gray-700 font-semibold w-32">Día</label>
    <select name="dia" class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" required>
        @foreach (['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'] as $dia)
            <option value="{{ $dia }}" {{ old('dia', $horario->dia ?? '') == $dia ? 'selected' : '' }}>{{ $dia }}</option>
        @endforeach
    </select>
</div>

<div class="flex items-center mb-3">
    <label for="hora_inicio" class="block text-gray-700 font-semibold w-32">Hora Inicio</label>
    <input type="time" name="hora_inicio" required
        class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300"
        value="{{ old('hora_inicio', $horario->hora_inicio ?? '') }}">
</div>

<div class="flex items-center mb-3">
    <label for="hora_fin" class="block text-gray-700 font-semibold w-32">Hora Fin</label>
    <input type="time" name="hora_fin" required
        class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300"
        value="{{ old('hora_fin', $horario->hora_fin ?? '') }}">
</div>

<div class="flex items-center mb-3">
    <label for="aula" class="block text-gray-700 font-semibold w-32">Aula</label>
    <input type="text" name="aula" required
        class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300"
        placeholder="Ingrese el aula"
        value="{{ old('aula', $horario->aula ?? '') }}">
</div>
