<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    /** @use HasFactory<\Database\Factories\IngredientFactory> */
    use HasFactory;

    protected $fillable = ['name', 'photo', 'category_id', 'description'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function unite()
    {
        return $this->belongsTo(Unite::class);
    }

    public function recettes()
    {
        return $this->belongsToMany(Recette::class, 'recette_ingredient');
    }
}
