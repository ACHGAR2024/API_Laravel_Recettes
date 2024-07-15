<?php

namespace App\Http\Controllers\API; // Vérifiez le bon namespace ici

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller; // Assurez-vous d'importer le bon Controller

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'recette_id' => 'required|exists:recettes,id',
            'score' => 'required|integer|min:1|max:5',
        ]);

        $rating = Rating::updateOrCreate(
            ['user_id' => Auth::id(), 'recette_id' => $request->recette_id],
            ['score' => $request->score]
        );

        return response()->json($rating, 201);
    }

    public function show($id)
    {
        $ratings = Rating::where('recette_id', $id)->get();
        return response()->json($ratings);
    }
}