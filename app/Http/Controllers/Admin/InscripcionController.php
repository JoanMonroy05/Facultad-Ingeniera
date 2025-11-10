<?php

namespace App\Http\Controllers\Admin;

use App\Models\Inscripcion;
use App\Models\Estudiante;
use App\Models\Asignatura;
use Illuminate\Http\Request;

class InscripcionController
{
    /**
     * Mostrar listado de inscripciones.
     */
    public function index()
    {
        $inscripciones = Inscripcion::with(['estudiante.user', 'asignatura'])->get();
        return view('inscripciones.index', compact('inscripciones'));
    }

    /**
     * Mostrar formulario de creación.
     */
    public function create()
    {
        $estudiantes = Estudiante::with('user')->get();
        $asignaturas = Asignatura::all();
        return view('inscripciones.create', compact('estudiantes', 'asignaturas'));
    }

    /**
     * Guardar una nueva inscripción.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'estudiante_id' => 'required|exists:estudiantes,id',
            'asignatura_id' => 'required|exists:asignaturas,id',
        ], [
            'estudiante_id.required' => 'Seleccione un estudiante.',
            'asignatura_id.required' => 'Seleccione una asignatura.',
        ]);

        // Evitar duplicados (misma asignatura y estudiante)
        $existe = Inscripcion::where('estudiante_id', $request->estudiante_id)
            ->where('asignatura_id', $request->asignatura_id)
            ->first();

        if ($existe) {
            return redirect()->back()
                ->withErrors(['asignatura_id' => 'El estudiante ya está inscrito en esta asignatura.'])
                ->withInput();
        }

        Inscripcion::create($validated);

        return redirect()->route('inscripciones.index')
            ->with('success', 'Inscripción registrada correctamente.');
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(Inscripcion $inscripcion)
    {
        $estudiantes = Estudiante::with('user')->get();
        $asignaturas = Asignatura::all();

        return view('inscripciones.edit', compact('inscripcion', 'estudiantes', 'asignaturas'));
    }

    /**
     * Actualizar inscripción existente.
     */
    public function update(Request $request, Inscripcion $inscripcion)
    {
        $validated = $request->validate([
            'estudiante_id' => 'required|exists:estudiantes,id',
            'asignatura_id' => 'required|exists:asignaturas,id',
        ]);

        // Validar duplicado (excluyendo la actual)
        $duplicado = Inscripcion::where('id', '!=', $inscripcion->id)
            ->where('estudiante_id', $request->estudiante_id)
            ->where('asignatura_id', $request->asignatura_id)
            ->exists();

        if ($duplicado) {
            return redirect()->back()
                ->withErrors(['asignatura_id' => 'Este estudiante ya está inscrito en esa asignatura.'])
                ->withInput();
        }

        $inscripcion->update($validated);

        return redirect()->route('inscripciones.index')
            ->with('success', 'Inscripción actualizada correctamente.');
    }

    /**
     * Eliminar inscripción.
     */
    public function destroy(Inscripcion $inscripcion)
    {
        $inscripcion->delete();
        return redirect()->route('inscripciones.index')
            ->with('success', 'Inscripción eliminada correctamente.');
    }
}
