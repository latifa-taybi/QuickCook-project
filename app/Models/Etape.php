<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etape extends Model
{
    protected $fillable = ['numero_etape', 'description', 'recette_id'];

    public function recette(){
        return $this->recette()->belongsTo(Recette::class);
    }
}
