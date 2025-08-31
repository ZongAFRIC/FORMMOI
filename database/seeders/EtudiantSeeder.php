<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
                'email' => 'eissa@yayoo.com',
                'password' => Hash::make('password123'),
                'image' => null,
                'status' => 'active',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Etudiant',
                'prenom' => 'kaze',
                'telephone' => '7654321',
                'email' => 'ekaze@gmail.com',
                'password' => Hash::make('password123'),
                'image' => null,
                'status' => 'active',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'ADA',
                'prenom' => 'Kader',
                'telephone' => '78523211',
                'email' => 'akader@educa.com',
                'password' => Hash::make('password123'),
                'image' => null,
                'status' => 'active',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nom' => 'Etu',
                'prenom' => 'malick',
                'telephone' => '77856789',
                'email' => 'malick@yayoo.com',
                'password' => Hash::make('password123'),
                'image' => null,
                'status' => 'active',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
