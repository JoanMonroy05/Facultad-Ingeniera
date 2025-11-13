<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Horario;
use App\Models\Asignatura;
use App\Models\Docente;
use Faker\Factory as Faker;

class HorarioSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
        $docentes = Docente::all();

        foreach (Asignatura::all() as $asignatura) {
            Horario::create([
                'asignatura_id' => $asignatura->id,
                'docente_id' => $docentes->random()->id,
                'dia' => $faker->randomElement($dias),
                'hora_inicio' => $faker->time('H:i', '15:00'),
                'hora_fin' => $faker->time('H:i', '18:00'),
                'aula' => 'A-' . rand(100, 500),
            ]);
        }
    }
}
