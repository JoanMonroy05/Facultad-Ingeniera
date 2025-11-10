<?php

namespace App\Http\Controllers\Admin;

use App\Models\Horario;
use App\Models\Asignatura;
use App\Models\Docente;
use Illuminate\Http\Request;

class HorarioController
{
    public function index()
    {
        $horarios = Horario::with(['asignatura', 'docente.user'])->get();
        return view('horarios.index', compact('horarios'));
    }

    public function create()
    {
        $asignaturas = Asignatura::all();
        $docentes = Docente::with('user')->get();
        return view('horarios.create', compact('asignaturas', 'docentes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'asignatura_id' => 'required|exists:asignaturas,id',
            'docente_id' => 'required|exists:docentes,id',
            'dia' => 'required|string|max:20',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'aula' => 'required|string|max:50',
        ]);

        // Validar conflictos de horario del docente
        $conflicto = Horario::where('docente_id', $request->docente_id)
            ->where('dia', $request->dia)
            ->where(function ($query) use ($request) {
                $query->whereBetween('hora_inicio', [$request->hora_inicio, $request->hora_fin])
                      ->orWhereBetween('hora_fin', [$request->hora_inicio, $request->hora_fin]);
            })
            ->exists();

        if ($conflicto) {
            return back()->withErrors(['conflicto' => 'El docente ya tiene una clase en ese horario.']);
        }

        Horario::create($request->all());

        return redirect()->route('horarios.index')
            ->with('success', 'Horario creado correctamente.');
    }

    public function edit(Horario $horario)
    {
        $asignaturas = Asignatura::all();
        $docentes = Docente::with('user')->get();
        return view('horarios.edit', compact('horario', 'asignaturas', 'docentes'));
    }

    public function update(Request $request, Horario $horario)
    {
        $request->validate([
            'asignatura_id' => 'required|exists:asignaturas,id',
            'docente_id' => 'required|exists:docentes,id',
            'dia' => 'required|string|max:20',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'aula' => 'required|string|max:50',
        ]);

        $horario->update($request->all());

        return redirect()->route('horarios.index')
            ->with('success', 'Horario actualizado correctamente.');
    }

    public function destroy(Horario $horario)
    {
        $horario->delete();

        return redirect()->route('horarios.index')
            ->with('success', 'Horario eliminado correctamente.');
    }
}
