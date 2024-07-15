<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'recette_id', 'score'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recette()
    {
        return $this->belongsTo(Recette::class);
    }
}