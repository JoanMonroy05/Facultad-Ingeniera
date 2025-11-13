<?php

namespace App\Http\Controllers\Admin;

use App\Models\Asignatura;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AsignaturaController
{
    /**
     * Mostrar listado.
     */
    public function index()
    {
        $asignaturas = Asignatura::all();
        return view('asignaturas.index', compact('asignaturas'));
    }

    /**
     * Mostrar formulario de creación.
     */
    public function create()
    {
        return view('asignaturas.create');
    }

    /**
     * Guardar nueva asignatura.
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|max:20|unique:asignaturas,codigo',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'creditos' => 'required|integer|min:1',
        ]);

        Asignatura::create([
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'creditos' => $request->creditos,
        ]);

        return redirect()->route('asignaturas.index')
            ->with('success', 'Asignatura creada correctamente.');
    }

    /**
     * Mostrar detalle (opcional).
     */
    public function show(Asignatura $asignatura)
    {
        $asignatura = Asignatura::with('horarios.docente.user')->findOrFail($asignatura->id);
        return view('asignaturas.show', compact('asignatura'));
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(Asignatura $asignatura)
    {
        return view('asignaturas.edit', compact('asignatura'));
    }

    /**
     * Actualizar asignatura.
     */
    public function update(Request $request, Asignatura $asignatura)
    {
        $request->validate([
            'codigo' => [
                'required',
                'string',
                'max:20',
                Rule::unique('asignaturas', 'codigo')->ignore($asignatura->id),
            ],
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'creditos' => 'required|integer|min:1',
        ]);

        $asignatura->update([
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'creditos' => $request->creditos,
        ]);

        return redirect()->route('asignaturas.index')
            ->with('success', 'Asignatura actualizada correctamente.');
    }

    /**
     * Eliminar asignatura.
     */
    public function destroy(Asignatura $asignatura)
    {
        // Si tiene FK (horarios), asegurarse que onDelete cascade o manejar la lógica aquí.
        $asignatura->delete();

        return redirect()->route('asignaturas.index')
            ->with('success', 'Asignatura eliminada correctamente.');
    }
}
