<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recette extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'instructions',
        'photo', 
    ];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'recette_ingredients')
                    ->withPivot('quantite')
                    ->withTimestamps();
    }
}