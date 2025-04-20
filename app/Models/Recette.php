<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recette extends Model
{
    /** @use HasFactory<\Database\Factories\RecetteFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'prepTime',
        'difficulty',
        'description',
        'etape',
        'image',
        'videoUrl'
    ];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'recette_ingredients')->withPivot('quantity', 'unite');
    }

    public function regimes()
    {
        return $this->belongsToMany(Regime::class, 'recette_regimes');
    }

    public function etapes()
    { 
        return $this->hasMany(Etape::class);
    }

}
