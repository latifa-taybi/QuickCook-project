<?php

namespace Database\Seeders;

use App\Models\Regime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $regimes = [
            [
                'name' => 'Vegan',
                'description' => 'Un régime alimentaire qui exclut tous les produits d\'origine animale.',
            ],
            [
                'name' => 'Végétarien',
                'description' => 'Un régime alimentaire qui exclut la viande, mais peut inclure des produits d\'origine animale comme les œufs et les produits laitiers.',
            ],
            [
                'name' => 'Paléo',
                'description' => 'Un régime basé sur les aliments que l\'on pense que nos ancêtres chasseurs-cueilleurs auraient mangés.',
            ],
            [
                'name' => 'Cétogène',
                'description' => 'Un régime riche en graisses et pauvre en glucides, conçu pour amener le corps à entrer dans un état de cétose.',
            ],
        ];

        foreach ($regimes as $regime) {
            Regime::create($regime);
        }
    }
}
