@extends('layouts.app')

@section('title', 'Actualizar Estudiante | Gestión')
@section('header', 'Actualizar Estudiante')

@section('content')
<form action="{{ route('estudiantes.update', $estudiante->ID_Estudiante) }}" method="POST" class="space-y-4 mx-auto p-6 rounded-lg" novalidate>
    @include('partials.alertas')
    @csrf
    @method('PUT')

    @include('estudiantes.form')

    <button type="submit" 
        class="bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 transition-all m-auto block">
        Actualizar Estudiante
    </button>
</form>
@endsection