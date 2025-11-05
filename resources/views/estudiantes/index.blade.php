@extends('layouts.app')

@section('title', 'Crear Estudiante | Gestión')
@section('header', 'Gestión de Estudiantes')

@section('content')

<div>
    <a href="{{ route('estudiantes.create') }}" class="inline-block bg-blue-500 text-white px-4 py-2 mb-4 rounded hover:bg-blue-700"><i class="fas fa-plus"></i> Agregar Estudiante</a>
</div>
@include('partials.alertas')
@if($estudiantes->isNotEmpty())
<div class="overflow-x-auto">
    <table class="min-w-full border border-gray-300 rounded-lg">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left">ID</th>
                <th class="px-4 py-2 text-left">Nombre</th>
                <th class="px-4 py-2 text-left">Apellido</th>
                <th class="px-4 py-2 text-left">Semestre</th>
                <th class="px-4 py-2 text-left">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($estudiantes as $estudiante)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $estudiante->ID_Estudiante }}</td>
                    <td class="px-4 py-2">{{ $estudiante->Nombre }}</td>
                    <td class="px-4 py-2">{{ $estudiante->Apellido }}</td>
                    <td class="px-4 py-2">{{ $estudiante->Semestre }}</td>
                    <td class="px-4 py-2">
                        @include('partials.buttons_accions', ['routePrefix' => 'estudiantes', 'model' => $estudiante])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
    <p>No hay estudiantes registrados.</p>
@endif
@endsection