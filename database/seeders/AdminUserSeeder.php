<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'documento' => '123.456.789',
            'primer_nombre' => 'DEWAR',
            'segundo_nombre' => 'WILMER',
            'primer_apellido' => 'RICO',
            'segundo_apellido' => 'BAUTISTA',
            'email' => 'dwricob@ufpso.edu.co',
            'password' => Hash::make('Admin1234'),
        ]);

        $admin->assignRole('admin');
    }
}
