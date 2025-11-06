<div class="flex items-center">
    <label for="documento" class="block text-gray-700 font-semibold w-32">Documento *</label>
    <input type="text" name="documento" required class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300"
        placeholder="Ingrese el número de documento" value="{{ old('documento', $estudiante->user->documento ?? '') }}">
</div>
@error('documento')
    <p class="text-red-500 text-sm mt-1 ml-32">{{ $message }}</p>
@enderror

<div class="flex items-center">
    <label for="primer_nombre" class="block text-gray-700 font-semibold w-32">Primer Nombre *</label>
    <input type="text" name="primer_nombre" required class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300"
        placeholder="Ingrese el primer nombre" value="{{ old('primer_nombre', $estudiante->user->primer_nombre ?? '') }}">
</div>
@error('primer_nombre')
    <p class="text-red-500 text-sm mt-1 ml-32">{{ $message }}</p>
@enderror

<div class="flex items-center">
    <label for="segundo_nombre" class="block text-gray-700 font-semibold w-32">Segundo Nombre</label>
    <input type="text" name="segundo_nombre" class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300"
        placeholder="Ingrese el segundo nombre (opcional)"
        value="{{ old('segundo_nombre', $estudiante->user->segundo_nombre ?? '') }}">
</div>
@error('segundo_nombre')
    <p class="text-red-500 text-sm mt-1 ml-32">{{ $message }}</p>
@enderror

<div class="flex items-center">
    <label for="primer_apellido" class="block text-gray-700 font-semibold w-32">Primer Apellido *</label>
    <input type="text" name="primer_apellido" required
        class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" placeholder="Ingrese el primer apellido"
        value="{{ old('primer_apellido', $estudiante->user->primer_apellido ?? '') }}">
</div>
@error('primer_apellido')
    <p class="text-red-500 text-sm mt-1 ml-32">{{ $message }}</p>
@enderror

<div class="flex items-center">
    <label for="segundo_apellido" class="block text-gray-700 font-semibold w-32">Segundo Apellido</label>
    <input type="text" name="segundo_apellido" class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300"
        placeholder="Ingrese el segundo apellido (opcional)"
        value="{{ old('segundo_apellido', $estudiante->user->segundo_apellido ?? '') }}">
</div>
@error('segundo_apellido')
    <p class="text-red-500 text-sm mt-1 ml-32">{{ $message }}</p>
@enderror

@if (!empty($estudiante->user->password))
    <div class="flex items-center">
        <label for="password" class="block text-gray-700 font-semibold w-32">Contraseña *</label>
        <input type="password" name="password"
            class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" placeholder="Ingrese la contraseña">
    </div>
    @error('password')
        <p class="text-red-500 text-sm mt-1 ml-32">{{ $message }}</p>
    @enderror

    <div class="flex items-center">
        <label for="password_confirmation" class="block text-gray-700 font-semibold w-32">Confirmar Contraseña *</label>
        <input type="password" name="password_confirmation"
            class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" placeholder="Confirme la contraseña">
    </div>
@endif

<div class="flex items-center">
    <label for="programa" class="block text-gray-700 font-semibold w-32">Programa *</label>
    <select name="programa" required class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300">
        <option value="" disabled selected>Seleccione un programa</option>
        <option value="Ingenieria de Sistemas" {{ old('programa', $estudiante->programa ?? '') == 'Ingenieria de Sistemas' ? 'selected' : '' }}>Ingeniería de Sistemas</option>
        <option value="Ingenieria Mecanica" {{ old('programa', $estudiante->programa ?? '') == 'Ingenieria Mecanica' ? 'selected' : '' }}>Ingeniería Mecánica</option>
        <option value="Ingenieria Civil" {{ old('programa', $estudiante->programa ?? '') == 'Ingenieria Civil' ? 'selected' : '' }}>Ingeniería Civil</option>
    </select>
</div>
@error('programa')
    <p class="text-red-500 text-sm mt-1 ml-32">{{ $message }}</p>
@enderror

<div class="flex items-center">
    <label for="semestre" class="block text-gray-700 font-semibold w-32">Semestre *</label>
    <input type="number" name="semestre" min="1" required
        class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" placeholder="Ingrese el semestre"
        value="{{ old('semestre', $estudiante->semestre ?? '') }}">
</div>
@error('semestre')
    <p class="text-red-500 text-sm mt-1 ml-32">{{ $message }}</p>
@enderror

<div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
    <p class="text-sm text-gray-700">
        <strong>Nota:</strong> El correo institucional se generará automáticamente con el formato:
        <code class="bg-gray-200 px-2 py-1 rounded text-xs">primera_letra_nombre + primera_letra_segundo_nombre +
            primer_apellido_completo + primera_letra_segundo_apellido@ufpso.edu.co</code>
    </p>
</div>
