<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nom' => 'Admin',
                'prenom' => 'Super',
                'email' => 'admin1@example.com',
                'image' => null,
                'role' => 'admin',
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // Assure-toi de chiffrer le mot de passe
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'User',
                'prenom' => 'Test',
                'email' => 'user1@example.com',
                'image' => null,
                'role' => 'user',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
