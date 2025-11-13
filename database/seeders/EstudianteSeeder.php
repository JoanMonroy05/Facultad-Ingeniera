<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estudiante;
use App\Models\User;
use Faker\Factory as Faker;

class EstudianteSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $programas = [
            'Ingeniería de Sistemas' => '19',
            'Ingeniería Industrial' => '18',
            'Ingeniería Civil' => '17',
        ];

        // Buscar los primeros 30 usuarios (sin contar admin ni los usuarios especiales)
        $users = User::where('email', 'not like', 'admin%')
            ->where('email', '!=', 'ejbayonai@ufpso.edu.co')
            ->take(30)
            ->get();

        $contador = [
            'Ingeniería de Sistemas' => 1,
            'Ingeniería Industrial' => 1,
            'Ingeniería Civil' => 1,
        ];

        foreach ($users as $i => $user) {
            // Alternar programas
            $programa = array_keys($programas)[$i % 3];
            $prefijo = $programas[$programa];
            $numero = str_pad($contador[$programa], 4, '0', STR_PAD_LEFT);
            $codigo = $prefijo . $numero;

            Estudiante::create([
                'user_id' => $user->id,
                'programa' => $programa,
                'codigo' => $codigo,
                'semestre' => rand(1, 10),
            ]);

            $contador[$programa]++;
        }
    }
}
