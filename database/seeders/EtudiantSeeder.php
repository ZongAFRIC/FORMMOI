<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EtudiantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('etudiants')->insert([
            [
                'nom' => 'Etudiant',
                'prenom' => 'issa',
                'telephone' => '76856789',
                'email' => 'issa@example.com',
                'password' => Hash::make('password123'),
                'image' => null,
                'status' => 'active',
                'remember_token' => \Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Etudiant',
                'prenom' => 'kaze',
                'telephone' => '7654321',
                'email' => 'aaaaa@example.com',
                'password' => Hash::make('password123'),
                'image' => null,
                'status' => 'active',
                'remember_token' => \Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Ajoutez d'autres entrées si nécessaire
        ]);
    }
}
