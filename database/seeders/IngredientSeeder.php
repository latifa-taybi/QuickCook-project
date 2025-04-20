<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingredients = [
            [
                'name' => 'Tomate',
                'photo' => 'ingredients/tomate.jpg',
                'category_id' => 2, 
                'description' => 'Légume-fruit polyvalent utilisé cru ou cuit.',
            ],
            [
                'name' => 'Farine de blé',
                'photo' => 'ingredients/farine.jpg',
                'category_id' => 7,
                'description' => 'Indispensable pour pains, pâtes et pâtisseries.',
            ],
            [
                'name' => 'Lait entier',
                'photo' => 'ingredients/lait.jpg',
                'category_id' => 5,
                'description' => 'Liquide riche en calcium, base de nombreuses recettes.',
            ],
            [
                'name' => 'Sucre blanc',
                'photo' => 'ingredients/sucre.jpg',
                'category_id' => 11,
                'description' => 'Sucrant courant pour desserts et boissons.',
            ],
            [
                'name' => 'Sel fin',
                'photo' => 'ingredients/sel.jpg',
                'category_id' => 6,
                'description' => 'Assaisonnement de base pour tous types de plats.',
            ],
            [
                'name' => 'Oeuf',
                'photo' => 'ingredients/oeuf.jpg',
                'category_id' => 5,
                'description' => 'Ingrédient protéiné et liant en cuisine.',
            ],
            [
                'name' => 'Huile d\'olive',
                'photo' => 'ingredients/huile_olive.jpg',
                'category_id' => 10,
                'description' => 'Huile végétale très utilisée en assaisonnement.',
            ],
            [
                'name' => 'Beurre',
                'photo' => 'ingredients/beurre.jpg',
                'category_id' => 5,
                'description' => 'Matière grasse animale utilisée en cuisson et pâtisserie.',
            ],
            [
                'name' => 'Thon en boîte',
                'photo' => 'ingredients/thon.jpg',
                'category_id' => 4,
                'description' => 'Poisson pratique et riche en protéines.',
            ],
            [
                'name' => 'Poivre noir',
                'photo' => 'ingredients/poivre.jpg',
                'category_id' => 6,
                'description' => 'Épice piquante utilisée pour relever les plats.',
            ],
        ];

        foreach ($ingredients as $ingredient) {
                Ingredient::create($ingredient);
        }
    }
}
