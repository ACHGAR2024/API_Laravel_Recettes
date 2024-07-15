<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\RecetteIngredient;
use Illuminate\Http\Request;

class RecetteIngredientController extends Controller
{
    public function index()
    {
        $recetteIngredients = RecetteIngredient::with(['recette', 'ingredient'])->get();
        return response()->json($recetteIngredients);
    }

    public function store(Request $request)
    {
        $recetteIngredient = RecetteIngredient::create($request->all());
        return response()->json($recetteIngredient, 201);
    }

    public function show($id)
    {
        $recetteIngredient = RecetteIngredient::with(['recette', 'ingredient'])->findOrFail($id);
        return response()->json($recetteIngredient);
    }

    public function update(Request $request, $id)
    {
        $recetteIngredient = RecetteIngredient::findOrFail($id);
        $recetteIngredient->update($request->all());
        return response()->json($recetteIngredient, 200);
    }

    public function destroy($id)
    {
        RecetteIngredient::destroy($id);
        return response()->json(null, 204);
    }
}