{{-- Código --}}
<div class="flex items-center">
    <label for="codigo" class="block text-gray-700 font-semibold w-32">Código</label>
    <input type="text" name="codigo" id="codigo" required
        class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300"
        placeholder="Ej: MAT101"
        value="{{ old('codigo', $asignatura->codigo ?? '') }}">
</div>
@error('codigo')
    <p class="text-red-500 text-sm mt-1 ml-32">{{ $message }}</p>
@enderror

{{-- Nombre --}}
<div class="flex items-center mt-3">
    <label for="nombre" class="block text-gray-700 font-semibold w-32">Nombre</label>
    <input type="text" name="nombre" id="nombre" required
        class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300"
        placeholder="Ingrese el nombre de la asignatura"
        value="{{ old('nombre', $asignatura->nombre ?? '') }}">
</div>
@error('nombre')
    <p class="text-red-500 text-sm mt-1 ml-32">{{ $message }}</p>
@enderror

{{-- Créditos --}}
<div class="flex items-center mt-3">
    <label for="creditos" class="block text-gray-700 font-semibold w-32">Créditos</label>
    <input type="number" name="creditos" id="creditos" min="1" required
        class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300"
        placeholder="Ingrese los créditos"
        value="{{ old('creditos', $asignatura->creditos ?? 3) }}">
</div>
@error('creditos')
    <p class="text-red-500 text-sm mt-1 ml-32">{{ $message }}</p>
@enderror

{{-- Descripción --}}
<div class="flex items-start mt-3">
    <label for="descripcion" class="block text-gray-700 font-semibold w-32 mt-2">Descripción</label>
    <textarea name="descripcion" id="descripcion" rows="4"
        class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300"
        placeholder="Descripción (opcional)">{{ old('descripcion', $asignatura->descripcion ?? '') }}</textarea>
</div>
@error('descripcion')
    <p class="text-red-500 text-sm mt-1 ml-32">{{ $message }}</p>
@enderror
