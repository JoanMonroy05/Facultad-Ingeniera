@extends('layouts.app')

@section('title', 'Crear Estudiante | Gestión')
@section('header', 'Crear Nuevo Estudiante')

@section('content')
<form action="{{ route('estudiantes.store') }}" method="POST" class="space-y-4 mx-auto p-6 rounded-lg" novalidate>
    @include('partials.alertas')
    @csrf

    @include('estudiantes.form')

    <button type="submit" 
        class="bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 transition-all m-auto block">
        Guardar Estudiante
    </button>
</form>
@endsection