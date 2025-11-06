@props([
    'routePrefix', 
    'model',       
])

<div class="btn-group" role="group">
    {{-- Botón Editar --}}
    <a href="{{ route($routePrefix . '.edit', $model) }}" class="inline-block bg-yellow-400 text-black px-4 py-2 rounded mr-2 hover:bg-yellow-500 transition">Editar</a>
    <form action="{{ route($routePrefix . '.destroy', $model) }}" method="POST" class="inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="inline-block bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">Eliminar</button>
    </form>
</div>