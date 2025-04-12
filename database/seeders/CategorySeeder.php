<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Fruits', 'description' => 'Ingrédients sucrés, souvent consommés crus ou en dessert.'],
            ['name' => 'Légumes', 'description' => 'Plantes potagères utilisées dans de nombreux plats salés.'],
            ['name' => 'Viandes', 'description' => 'Protéines animales issues de mammifères ou de volailles.'],
            ['name' => 'Poissons et fruits de mer', 'description' => 'Produits de la mer riches en oméga-3.'],
            ['name' => 'Produits laitiers', 'description' => 'Aliments issus du lait : lait, fromage, yaourt, etc.'],
            ['name' => 'Épices et aromates', 'description' => 'Substances végétales pour relever le goût des plats.'],
            ['name' => 'Céréales et farines', 'description' => 'Produits à base de grains, base de nombreux aliments.'],
            ['name' => 'Légumineuses', 'description' => 'Plantes à graines comme les lentilles, pois chiches, haricots.'],
            ['name' => 'Condiments et sauces', 'description' => 'Ajouts pour assaisonner ou accompagner les plats.'],
            ['name' => 'Huiles et matières grasses', 'description' => 'Sources de lipides utilisées en cuisson ou assaisonnement.'],
            ['name' => 'Sucres et sucrants', 'description' => 'Substances sucrantes naturelles ou transformées.'],
            ['name' => 'Boissons', 'description' => 'Liquides consommés pour se désaltérer ou accompagner un repas.'],
            ['name' => 'Produits surgelés', 'description' => 'Aliments conservés par congélation.'],
            ['name' => 'Autres', 'description' => 'Ingrédients divers ne rentrant pas dans les autres catégories.'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
