<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'nom_categorie' => 'Développement Web',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom_categorie' => 'Marketing Digital',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom_categorie' => 'Intelligence Artificielle',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nom_categorie' => 'Programmation Python',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nom_categorie' => 'Bureautique',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nom_categorie' => 'Helpdesk',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
