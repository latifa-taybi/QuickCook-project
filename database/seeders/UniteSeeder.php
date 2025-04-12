<?php

namespace Database\Seeders;

use App\Models\Unite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UniteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            ['name' => 'Milligramme', 'symbol' => 'mg'],
            ['name' => 'Gramme', 'symbol' => 'g'],
            ['name' => 'Kilogramme', 'symbol' => 'kg'],
            ['name' => 'Millilitre', 'symbol' => 'ml'],
            ['name' => 'Centilitre', 'symbol' => 'cl'],
            ['name' => 'Tasse', 'symbol' => 'cup'],
            ['name' => 'Unité', 'symbol' => 'unité'],
            ['name' => 'Pièce', 'symbol' => 'pc'],
            ['name' => 'Tranche', 'symbol' => 'tr'],
            ['name' => 'Boîte', 'symbol' => 'boîte'],
        ];
        foreach ($units as $unit) {
            Unite::create($unit);
        }
    }
}
