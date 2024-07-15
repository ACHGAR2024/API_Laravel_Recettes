<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RecetteController;
use App\Http\Controllers\API\IngredientController;
use App\Http\Controllers\API\RecetteIngredientController;
use App\Http\Controllers\API\RatingController; 

Route::middleware('auth:api')->get('/user', function (Request $request) {
    
    return $request->user();
});



Route::apiResource('recettes', RecetteController::class)->except(['create', 'edit']);

Route::apiResource('ingredients', IngredientController::class)->except(['create', 'edit']);

Route::resource('recette-ingredients', RecetteIngredientController::class)->except(['create', 'edit']);

Route::apiResource('ratings', RatingController::class)->except(['index', 'create']);