<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unite extends Model
{
    /** @use HasFactory<\Database\Factories\UniteFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }
}
