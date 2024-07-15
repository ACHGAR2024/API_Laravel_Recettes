<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recette;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = ['nom'];
    public function recettes()
    {
        return $this->belongsToMany(Recette::class, 'recette_ingredients')
                    ->withPivot('quantite')
                    ->withTimestamps();
    }
    
}