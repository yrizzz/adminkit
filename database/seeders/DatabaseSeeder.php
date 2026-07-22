<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Primary demo admin
        User::updateOrCreate(
            ['email' => 'admin@adminkit.test'],
            ['name' => 'Aisha Rahman', 'password' => Hash::make('password')],
        );

        // A few demo teammates (used by the Tables page)
        $people = [
            ['name' => 'David Chen',       'email' => 'david@adminkit.test'],
            ['name' => 'Sofia Martinez',   'email' => 'sofia@adminkit.test'],
            ['name' => 'Omar Haddad',      'email' => 'omar@adminkit.test'],
            ['name' => 'Emily Watson',     'email' => 'emily@adminkit.test'],
            ['name' => 'Kenji Tanaka',     'email' => 'kenji@adminkit.test'],
            ['name' => 'Layla Farouk',     'email' => 'layla@adminkit.test'],
            ['name' => 'Marcus Johnson',   'email' => 'marcus@adminkit.test'],
            ['name' => 'Priya Sharma',     'email' => 'priya@adminkit.test'],
        ];

        foreach ($people as $p) {
            User::updateOrCreate(['email' => $p['email']], [
                'name' => $p['name'],
                'password' => Hash::make('password'),
            ]);
        }
    }
}
