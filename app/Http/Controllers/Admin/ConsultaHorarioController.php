<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Docente;
use App\Models\Estudiante;
use App\Models\Horario;
use App\Models\Inscripcion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ConsultaHorarioController
{
    /**
     * Días disponibles para mostrar en la vista.
     */
    private array $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];

    /**
     * Página principal de consulta (modo administrador).
     */
    public function index()
    {
        return view('consultas.index', [
            'estudiantes' => Estudiante::with('user')->get(),
            'docentes' => Docente::with('user')->get(),
            'materias' => [],
            'tipo' => null,
            'nombre' => null,
        ]);
    }

    /**
     * Buscar horarios según tipo (estudiante o docente).
     */
    public function buscar(Request $request)
    {
        $request->validate([
            'tipo' => 'required|in:estudiante,docente',
            'id' => 'required|integer',
        ]);

        if ($request->tipo === 'estudiante') {
            $estudiante = Estudiante::with('user')->findOrFail($request->id);

            $inscripciones = Inscripcion::with(['asignatura.horarios.docente.user'])
                ->where('estudiante_id', $estudiante->id)
                ->get();

            $materias = $inscripciones->map(function ($inscripcion) {
                return [
                    'asignatura' => $inscripcion->asignatura,
                    'horarios' => $inscripcion->asignatura->horarios ?? collect(),
                ];
            });

            $nombre = "{$estudiante->user->primer_nombre} {$estudiante->user->primer_apellido}";
        } else {
            $docente = Docente::with('user')->findOrFail($request->id);

            // Buscar horarios del docente
            $horarios = Horario::with(['asignatura', 'docente.user'])
                ->where('docente_id', $docente->id)
                ->get();

            // Agrupar por asignatura y obtener los estudiantes inscritos
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

            $nombre = "{$docente->user->primer_nombre} {$docente->user->primer_apellido}";
        }

        return view('consultas.index', [
            'estudiantes' => Estudiante::with('user')->get(),
            'docentes' => Docente::with('user')->get(),
            'dias' => $this->dias,
            'materias' => $materias ?? [],
            'tipo' => $request->tipo,
            'nombre' => $nombre,
        ]);
    }

    /**
     * Mostrar el horario del usuario autenticado (docente o estudiante).
     */
    public function miHorario()
    {
        $user = Auth::user();

        if ($user->hasRole('estudiante')) {
            return $this->horarioEstudiante($user);
        }

        if ($user->hasRole('docente')) {
            return $this->horarioDocente($user);
        }

        abort(403, 'No autorizado para consultar este horario.');
    }

    /**
     * Obtener horario del estudiante autenticado.
     */
    private function horarioEstudiante($user)
    {
        $estudiante = $user->estudiante;

        $inscripciones = Inscripcion::with(['asignatura.horarios.docente.user'])
            ->where('estudiante_id', $estudiante->id)
            ->get();

        $materias = $inscripciones->map(function ($inscripcion) {
            return [
                'asignatura' => $inscripcion->asignatura,
                'horarios' => $inscripcion->asignatura->horarios ?? collect(),
            ];
        });

        return view('consultas.mi-horario', [
            'dias' => $this->dias,
            'materias' => $materias ?? [],
            'tipo' => 'estudiante',
        ]);
    }

    /**
     * Obtener horario del docente autenticado.
     */
    private function horarioDocente($user)
    {
        $docente = $user->docente;

        $horarios = Horario::with(['asignatura', 'docente.user'])
            ->where('docente_id', $docente->id)
            ->get();

        // Agrupar asignaturas y añadir estudiantes inscritos a cada una
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

        return view('consultas.mi-horario', [
            'dias' => $this->dias,
            'materias' => $materias ?? [],
            'tipo' => 'docente',
        ]);
    }

    /**
     * Mostrar lista de estudiantes asignados al docente autenticado.
     */
    public function miHorarioEstudiantes()
    {
        $user = Auth::user();
        if (!$user->hasRole('docente')) {
            abort(403, 'No autorizado para consultar esta información.');
        }
        $docente = $user->docente;
        $horarios = Horario::with(['asignatura'])
            ->where('docente_id', $docente->id)
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
                    'estudiantes' => $estudiantes,
                ];
            })
            ->values();
        return view('consultas.mi-horario-estudiantes', [
            'materias' => $materias,
        ]);
    }
}