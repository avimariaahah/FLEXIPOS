<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Role::create([
            'name' => 'superadmin',
        ]);
        Role::create([
            'name' => 'admin',
        ]);

        User::create([
            'role_id' => 1,
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'superadmin@flexipos.com',
            'password' => Hash::make('superadmin'),
        ]);

        User::create([
            'role_id' => 2,
            'firstname' => 'Johnny',
            'lastname' => 'Depp',
            'email' => 'admin@flexipos.com',
            'password' => Hash::make('admin'),
        ]);
    }
}
