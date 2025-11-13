<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inscripcion;
use App\Models\Estudiante;
use App\Models\Asignatura;
use App\Models\Docente;

class InscripcionSeeder extends Seeder
{
    public function run(): void
    {
        // 🔸 Joan David Monroy inscripto en 6 materias
        $joan = Estudiante::whereHas('user', fn($q) => $q->where('email', 'jdmonroyq@ufpso.edu.co'))->first();
        $materias = Asignatura::inRandomOrder()->take(6)->get();
        foreach ($materias as $a) {
            Inscripcion::create([
                'estudiante_id' => $joan->id,
                'asignatura_id' => $a->id,
            ]);
        }

        // 🔸 Docente Eduar con 2 asignaturas y 15 estudiantes cada una
        $eduar = Docente::whereHas('user', fn($q) => $q->where('email', 'ejbayonai@ufpso.edu.co'))->first();
        $asignaturasEduar = Asignatura::inRandomOrder()->take(2)->get();
        $estudiantes = Estudiante::inRandomOrder()->take(30)->get();

        foreach ($asignaturasEduar as $a) {
            foreach ($estudiantes->take(15) as $e) {
                Inscripcion::create([
                    'estudiante_id' => $e->id,
                    'asignatura_id' => $a->id,
                ]);
            }
        }
    }
}