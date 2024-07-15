<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recette;
use App\Models\Ingredient;

class RecetteIngredient extends Model
{
    use HasFactory;

    protected $table = 'recette_ingredients';

    protected $fillable = [
        'recette_id',
        'ingredient_id',
        'quantite',
    ];

    public function recette()
    {
        return $this->belongsTo(Recette::class);
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }

    public $timestamps = false;
}