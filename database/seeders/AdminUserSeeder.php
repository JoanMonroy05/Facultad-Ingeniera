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
            'name' => 'DEWAR WILMER RICO BAUTISTA',
            'email' => 'dwricob@ufpso.edu.co',
            'password' => Hash::make('Admin1234'),
        ]);

        $admin->assignRole('admin');
    }
}
