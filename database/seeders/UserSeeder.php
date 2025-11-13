<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // 🔸 Usuario específico: estudiante
        $joan = User::create([
            'documento' => mt_rand(1000000000, 9999999999),
            'primer_nombre' => 'Joan',
            'segundo_nombre' => 'David',
            'primer_apellido' => 'Monroy',
            'segundo_apellido' => 'Quintero',
            'email' => 'jdmonroyq@ufpso.edu.co',
            'password' => Hash::make('123456789'),
        ]);
        $joan->assignRole('estudiante');

        // 🔸 Usuario específico: docente
        $eduar = User::create([
            'documento' => mt_rand(1000000000, 9999999999),
            'primer_nombre' => 'Eduar',
            'segundo_nombre' => 'Jose',
            'primer_apellido' => 'Bayona',
            'segundo_apellido' => 'Ibañez',
            'email' => 'ejbayonai@ufpso.edu.co',
            'password' => Hash::make('123456789'),
        ]);
        $eduar->assignRole('docente');

        // 🔸 30 estudiantes generados
        foreach (range(1, 30) as $i) {
            $primerNombre = $faker->firstName;
            $segundoNombre = $faker->optional()->firstName;
            $primerApellido = $faker->lastName;
            $segundoApellido = $faker->lastName;

            $email = self::generarEmail($primerNombre, $segundoNombre, $primerApellido, $segundoApellido);

            $estudiante = User::create([
                'documento' => mt_rand(1000000000, 9999999999),
                'primer_nombre' => $primerNombre,
                'segundo_nombre' => $segundoNombre,
                'primer_apellido' => $primerApellido,
                'segundo_apellido' => $segundoApellido,
                'email' => $email,
                'password' => Hash::make('123456789'),
            ]);
            $estudiante->assignRole('estudiante');
        }

        // 🔸 5 docentes generados
        foreach (range(1, 5) as $i) {
            $primerNombre = $faker->firstName;
            $segundoNombre = $faker->optional()->firstName;
            $primerApellido = $faker->lastName;
            $segundoApellido = $faker->lastName;

            $email = self::generarEmail($primerNombre, $segundoNombre, $primerApellido, $segundoApellido);

            $docente = User::create([
                'documento' => mt_rand(1000000000, 9999999999),
                'primer_nombre' => $primerNombre,
                'segundo_nombre' => $segundoNombre,
                'primer_apellido' => $primerApellido,
                'segundo_apellido' => $segundoApellido,
                'email' => $email,
                'password' => Hash::make('123456789'),
            ]);
            $docente->assignRole('docente');
        }
    }

    // 🧩 Generador de correo institucional
    public static function generarEmail(string $p1, ?string $p2, string $a1, ?string $a2): string
    {
        $correo = strtolower(substr($p1, 0, 1));
        $correo .= $p2 ? strtolower(substr($p2, 0, 1)) : '';
        $correo .= strtolower($a1);
        $correo .= $a2 ? strtolower(substr($a2, 0, 1)) : '';
        return $correo . '@ufpso.edu.co';
    }
}
