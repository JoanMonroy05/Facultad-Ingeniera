<div class="flex items-center">
    <label for="estudiante_id" class="block text-gray-700 font-semibold w-32">Estudiante *</label>
    <select name="estudiante_id" required
        class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300">
        <option value="" disabled selected>Seleccione un estudiante</option>
        @foreach ($estudiantes as $estudiante)
            <option value="{{ $estudiante->id }}"
                {{ old('estudiante_id', $inscripcion->estudiante_id ?? '') == $estudiante->id ? 'selected' : '' }}>
                {{ $estudiante->user->primer_nombre }} {{ $estudiante->user->primer_apellido }}
                ({{ $estudiante->codigo }})
            </option>
        @endforeach
    </select>
</div>
@error('estudiante_id')
    <p class="text-red-500 text-sm mt-1 ml-32">{{ $message }}</p>
@enderror

<div class="flex items-center">
    <label for="asignatura_id" class="block text-gray-700 font-semibold w-32">Asignatura *</label>
    <select name="asignatura_id" required
        class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300">
        <option value="" disabled selected>Seleccione una asignatura</option>
        @foreach ($asignaturas as $asignatura)
            <option value="{{ $asignatura->id }}"
                {{ old('asignatura_id', $inscripcion->asignatura_id ?? '') == $asignatura->id ? 'selected' : '' }}>
                {{ $asignatura->nombre }} ({{ $asignatura->creditos }} créditos)
            </option>
        @endforeach
    </select>
</div>
@error('asignatura_id')
    <p class="text-red-500 text-sm mt-1 ml-32">{{ $message }}</p>
@enderror

<div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded mt-4">
    <p class="text-sm text-gray-700">
        <strong>Nota:</strong> Al guardar la inscripción, el estudiante quedará vinculado oficialmente a la
        asignatura seleccionada y podrá registrarse asistencia en los horarios correspondientes.
    </p>
</div>
