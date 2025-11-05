<div class="flex items-center">
    <label for="Nombre" class="block text-gray-700 font-semibold w-32">Nombre</label>
    <input type="text" name="Nombre" required class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300"
        placeholder="Ingrese el nombre" value="{{ old('Nombre', $estudiante->Nombre ?? '') }}">
</div>

<div class="flex items-center">
    <label for="Apellido" class="block text-gray-700 font-semibold w-32">Apellido</label>
    <input type="text" name="Apellido" required class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300"
        placeholder="Ingrese el apellido" value="{{ old('Apellido', $estudiante->Apellido ?? '') }}">
</div>

<div class="flex items-center">
    <label for="Semestre" class="block text-gray-700 font-semibold w-32">Semestre</label>
    <input type="number" name="Semestre" min="1" required
        class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" placeholder="Ingrese el semestre"
        value="{{ old('Semestre', $estudiante->Semestre ?? '') }}">
</div>
