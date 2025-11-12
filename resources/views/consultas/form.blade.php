<div class="flex flex-col md:flex-row gap-4 items-end">
    {{-- Tipo --}}
    <div class="w-full md:w-1/3">
        <label class="font-semibold block mb-1">Tipo de Consulta</label>
        <select id="tipoSelect" name="tipo" class="w-full border p-2 rounded" required>
            <option disabled selected>Seleccione...</option>
            <option value="estudiante" {{ old('tipo') == 'estudiante' ? 'selected' : '' }}>Estudiante</option>
            <option value="docente" {{ old('tipo') == 'docente' ? 'selected' : '' }}>Docente</option>
        </select>
    </div>

    {{-- Estudiantes --}}
    <div id="estudianteSelect" class="hidden w-full md:w-1/3">
        <label class="font-semibold block mb-1">Estudiante</label>
        <select name="id" class="w-full border p-2 rounded">
            <option disabled selected>Seleccione un estudiante</option>
            @foreach ($estudiantes as $e)
                <option value="{{ $e->id }}">{{ $e->user->getNombreCompletoAttribute() }}</option>
            @endforeach
        </select>
    </div>

    {{-- Docentes --}}
    <div id="docenteSelect" class="hidden w-full md:w-1/3">
        <label class="font-semibold block mb-1">Docente</label>
        <select name="id" class="w-full border p-2 rounded">
            <option disabled selected>Seleccione un docente</option>
            @foreach ($docentes as $d)
                <option value="{{ $d->id }}">{{ $d->user->getNombreCompletoAttribute() }}</option>
            @endforeach
        </select>
    </div>

