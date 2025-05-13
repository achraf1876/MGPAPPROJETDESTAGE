<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Entite;

class EntiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Entite::create([
            'nom' => 'Direction Régionale Rabat',
            'type_rattachement' => 'Direction',
            'ville' => 'Rabat',
        ]);

        Entite::create([
            'nom' => 'Agence MGPAP Casablanca',
            'type_rattachement' => 'Agence',
            'ville' => 'Casablanca',
        ]);
        Entite::create([
            'nom' => 'Agence MGPAP fes',
            'type_rattachement' => 'Agence',
            'ville' => 'fes',
        ]);
    }
}
