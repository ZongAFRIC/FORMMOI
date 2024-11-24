<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FormateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('formateurs')->insert([
            [
                'nom' => 'AZE',
                'prenom' => 'ty',
                'telephone' => '61234567',
                'email' => 'formateur1@example.com',
                'image' => null,
                'cv' => null,
                'attestation' => null,
                'bio' => 'Expert en développement web.',
                'is_validated' => true,
                'status' => 'active',
                'password' => Hash::make('password'), // Assure-toi de chiffrer le mot de passe
                'remember_token' => \Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Mar',
                'prenom' => 'Cla',
                'telephone' => '62346789',
                'email' => 'mmm@example.com',
                'image' => null,
                'cv' => null,
                'attestation' => null,
                'bio' => 'Spécialiste en marketing digital.',
                'is_validated' => false,
                'status' => 'desactive',
                'password' => Hash::make('password'),
                'remember_token' => \Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
