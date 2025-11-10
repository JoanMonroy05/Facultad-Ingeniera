<div class="flex items-center">
    <label for="documento" class="block text-gray-700 font-semibold w-32">Documento *</label>
    <input type="text" name="documento" required class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300"
        placeholder="Ingrese el número de documento" value="{{ old('documento', $docente->user->documento ?? '') }}">
</div>
@error('documento')
    <p class="text-red-500 text-sm mt-1 ml-32">{{ $message }}</p>
@enderror

<div class="flex items-center">
    <label for="primer_nombre" class="block text-gray-700 font-semibold w-32">Primer Nombre *</label>
    <input type="text" name="primer_nombre" required class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300"
        placeholder="Ingrese el primer nombre" value="{{ old('primer_nombre', $docente->user->primer_nombre ?? '') }}">
</div>
@error('primer_nombre')
    <p class="text-red-500 text-sm mt-1 ml-32">{{ $message }}</p>
@enderror

<div class="flex items-center">
    <label for="segundo_nombre" class="block text-gray-700 font-semibold w-32">Segundo Nombre</label>
    <input type="text" name="segundo_nombre" class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300"
        placeholder="Ingrese el segundo nombre (opcional)"
        value="{{ old('segundo_nombre', $docente->user->segundo_nombre ?? '') }}">
</div>
@error('segundo_nombre')
    <p class="text-red-500 text-sm mt-1 ml-32">{{ $message }}</p>
@enderror

<div class="flex items-center">
    <label for="primer_apellido" class="block text-gray-700 font-semibold w-32">Primer Apellido *</label>
    <input type="text" name="primer_apellido" required
        class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" placeholder="Ingrese el primer apellido"
        value="{{ old('primer_apellido', $docente->user->primer_apellido ?? '') }}">
</div>
@error('primer_apellido')
    <p class="text-red-500 text-sm mt-1 ml-32">{{ $message }}</p>
@enderror

<div class="flex items-center">
    <label for="segundo_apellido" class="block text-gray-700 font-semibold w-32">Segundo Apellido</label>
    <input type="text" name="segundo_apellido" class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300"
        placeholder="Ingrese el segundo apellido (opcional)"
        value="{{ old('segundo_apellido', $docente->user->segundo_apellido ?? '') }}">
</div>
@error('segundo_apellido')
    <p class="text-red-500 text-sm mt-1 ml-32">{{ $message }}</p>
@enderror

@if (!empty($docente->user->password))
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
    <label for="especialidad" class="block text-gray-700 font-semibold w-32">Especialidad *</label>
    <input type="text" name="especialidad" required
        class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" placeholder="Ingrese la especialidad"
        value="{{ old('especialidad', $docente->especialidad ?? '') }}">
</div>
@error('especialidad')
    <p class="text-red-500 text-sm mt-1 ml-32">{{ $message }}</p>
@enderror

<div class="flex items-center">
    <label for="titulo" class="block text-gray-700 font-semibold w-32">Título *</label>
    <input type="text" name="titulo" required
        class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" placeholder="Ingrese el título"
        value="{{ old('titulo', $docente->titulo ?? '') }}">
</div>
@error('titulo')
    <p class="text-red-500 text-sm mt-1 ml-32">{{ $message }}</p>
@enderror

<div class="flex items-center">
    <label for="telefono" class="block text-gray-700 font-semibold w-32">Teléfono *</label>
    <input type="text" name="telefono" required
        class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" placeholder="Ingrese el teléfono"
        value="{{ old('telefono', $docente->telefono ?? '') }}">
</div>
@error('telefono')
    <p class="text-red-500 text-sm mt-1 ml-32">{{ $message }}</p>
@enderror

<div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
    <p class="text-sm text-gray-700">
        <strong>Nota:</strong> El correo institucional se generará automáticamente con el formato:
        <code class="bg-gray-200 px-2 py-1 rounded text-xs">primera_letra_nombre + primera_letra_segundo_nombre +
            primer_apellido_completo + primera_letra_segundo_apellido@ufpso.edu.co</code>
    </p>
</div>
