<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Docente;
use App\Models\User;
use Faker\Factory as Faker;

class DocenteSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $users = User::where('email', 'not like', 'admin%')
            ->where('email', '!=', 'jdmonroyq@ufpso.edu.co')
            ->where('email', '!=', 'ejbayonai@ufpso.edu.co')
            ->skip(30) // los primeros 30 fueron estudiantes
            ->take(5)
            ->get();

        foreach ($users as $user) {
            Docente::create([
                'user_id' => $user->id,
                'especialidad' => $faker->randomElement(['Programación', 'Matemáticas', 'Electrónica']),
                'titulo' => $faker->randomElement(['Ingeniero', 'Magíster']),
                'telefono' => $faker->phoneNumber,
            ]);
        }

        // Eduar Jose Bayona Ibañez
        $userEduar = User::where('email', 'ejbayonai@ufpso.edu.co')->first();
        Docente::create([
            'user_id' => $userEduar->id,
            'especialidad' => 'Sistemas',
            'titulo' => 'Ingeniero',
            'telefono' => '3201234567',
        ]);
    }
}
