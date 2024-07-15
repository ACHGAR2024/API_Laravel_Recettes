<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Recette;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB; // Ajout de DB
use App\Http\ResponseClass; // Ajout de ResponseClass

class RecetteController extends Controller
{
    public function index()
    {
        return Recette::orderBy('id', 'desc')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
           
        ]);

        $input = $request->except('photo');

        // Gestion de l'upload de l'image
        $filename = "";
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $name = time() . '_' . $image->getClientOriginalName();
            $filePath = $image->storeAs('images', $name, 'public');
            $input['photo'] = '/' . $filePath;
        }

        $recette = Recette::create($input);
        return response()->json([
            'status' => 'Success',
            'message' => 'Recette ajoutée avec succès',
            'data' => $recette,
        ], 201);
    }

    public function show($id)
    {
        return Recette::findOrFail($id);
    }

    public function update(Request $request, $id)
{
    $recette = Recette::findOrFail($id);
    $file_temp = $recette->photo; 

    $request->validate([
        'titre' => 'required|max:255',
    ]);

    $input = $request->except('photo'); 

    if ($request->hasFile('photo')) {
        //  upload image
        $filenameWithExt = $request->file('photo')->getClientOriginalName();
        $filenameWithoutExt = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('photo')->getClientOriginalExtension();
        $filename = $filenameWithoutExt . '_' . time() . '.' . $extension;
        $path = $request->file('photo')->storeAs('images', $filename, 'public');

        // Suppression de l'ancienne photo
        if ($file_temp) {
            Storage::disk('public')->delete('images/' . basename($file_temp));
        }

        
        $input['photo'] = '/' . $path;
    }

    $recette->update($input);

    return response()->json([
        'status' => 'Success',
        'message' => 'Recette mise à jour avec succès',
        'data' => $recette,
    ]);
}


    public function destroy($id)
    {
        $recette = Recette::findOrFail($id);
        Storage::disk('public')->delete('images/' . basename($recette->photo));
        Recette::destroy($id);
        return response()->json(null, 204);
    }
}