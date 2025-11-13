<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Asignatura;

class AsignaturaSeeder extends Seeder
{
    public function run(): void
    {
        $asignaturas = [
            ['codigo' => 'SIS101', 'nombre' => 'Programación I', 'creditos' => 3],
            ['codigo' => 'SIS102', 'nombre' => 'Estructuras de Datos', 'creditos' => 3],
            ['codigo' => 'SIS103', 'nombre' => 'Bases de Datos', 'creditos' => 3],
            ['codigo' => 'SIS104', 'nombre' => 'Redes de Computadores', 'creditos' => 3],
            ['codigo' => 'SIS105', 'nombre' => 'Sistemas Operativos', 'creditos' => 3],
            ['codigo' => 'SIS106', 'nombre' => 'Ingeniería de Software', 'creditos' => 3],
            ['codigo' => 'SIS107', 'nombre' => 'Matemáticas Discretas', 'creditos' => 3],
            ['codigo' => 'SIS108', 'nombre' => 'Cálculo Integral', 'creditos' => 3],
            ['codigo' => 'SIS109', 'nombre' => 'Física General', 'creditos' => 3],
            ['codigo' => 'SIS110', 'nombre' => 'Inteligencia Artificial', 'creditos' => 3],
        ];

        foreach ($asignaturas as $a) {
            Asignatura::create([
                'codigo' => $a['codigo'],
                'nombre' => $a['nombre'],
                'descripcion' => $a['nombre'],
                'creditos' => $a['creditos'],
            ]);
        }
    }
}