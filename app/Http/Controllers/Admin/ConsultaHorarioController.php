<?php

namespace App\Http\Controllers\Admin;

use App\Models\Docente;
use App\Models\Estudiante;
use App\Models\Horario;
use App\Models\Inscripcion;
use Illuminate\Http\Request;

class ConsultaHorarioController
{
    public function index()
    {
        $estudiantes = Estudiante::with('user')->get();
        $docentes = Docente::with('user')->get();

        return view('consultas.index', [
            'estudiantes' => $estudiantes,
            'docentes' => $docentes,
            'materias' => [],
            'tipo' => null,
            'nombre' => null,
        ]);
    }

    public function buscar(Request $request)
    {
        $request->validate([
            'tipo' => 'required|in:estudiante,docente',
            'id' => 'required|integer',
        ]);

        $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];

        if ($request->tipo === 'estudiante') {
            $estudiante = Estudiante::with('user')->find($request->id);

            $inscripciones = Inscripcion::with(['asignatura.horarios.docente.user'])
                ->where('estudiante_id', $request->id)
                ->get();

            $materias = $inscripciones->map(function ($inscripcion) {
                return [
                    'asignatura' => $inscripcion->asignatura,
                    'horarios' => $inscripcion->asignatura->horarios ?? collect(),
                ];
            });

            $nombre = $estudiante
                ? $estudiante->user->primer_nombre.' '.$estudiante->user->primer_apellido
                : 'No encontrado';
        } else {
            $docente = Docente::with('user')->find($request->id);

            $horarios = Horario::with(['asignatura', 'docente.user'])
                ->where('docente_id', $request->id)
                ->get();

            $materias = $horarios
                ->groupBy('asignatura_id')
                ->map(function ($grupo) {
                    $asignatura = $grupo->first()->asignatura;

                    $estudiantes = Inscripcion::with(['estudiante.user'])
                        ->where('asignatura_id', $asignatura->id)
                        ->get()
                        ->pluck('estudiante');

                    return [
                        'asignatura' => $asignatura,
                        'horarios' => $grupo,
                        'estudiantes' => $estudiantes,
                    ];
                })
                ->values();

            $nombre = $docente
                ? $docente->user->primer_nombre.' '.$docente->user->primer_apellido
                : 'No encontrado';
        }

        return view('consultas.index', [
            'estudiantes' => Estudiante::with('user')->get(),
            'docentes' => Docente::with('user')->get(),
            'dias' => $dias,
            'materias' => $materias ?? [],
            'tipo' => $request->tipo,
            'nombre' => $nombre,
        ]);
    }
}
