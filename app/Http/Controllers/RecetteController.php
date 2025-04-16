<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use App\Http\Requests\StoreRecetteRequest;
use App\Http\Requests\UpdateRecetteRequest;
use App\Models\Ingredient;
use App\Models\Regime;
use App\Models\Unite;
use Illuminate\Http\Request;

class RecetteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recettes = Recette::with(['ingredients', 'regimes', 'unites'])->get();
        $regimes = Regime::all();
        $ingredients = Ingredient::all();
        return view('admin.recettes.gestionRecettes', compact('recettes','regimes', 'ingredients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
        
    public function store(StoreRecetteRequest $request)
    {
        $validated = $request->validated();
        $recette = new Recette();
        $recette->name = $validated['name'];
        $recette->description = $validated['description'];
        $recette->prepTime = $validated['prepTime'];
        $recette->difficulty = $validated['difficulty'];
        $recette->category = $validated['category'];
        $recette->videoUrl = $validated['videoUrl'] ?? null;
        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/recettes');
            $recette->image = str_replace('public/', 'storage/', $path);
        }
        
        $recette->save();
        
        if (isset($validated['regimes'])) {
            $recette->regimes()->sync($validated['regimes']);
        }
        
        dd($recette->name);


        // return redirect()->route('recettes.index')->with('success', 'Recette créée avec succès');
    }

    

    /**
     * Display the specified resource.
     */
    public function show(Recette $recette)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recette $recette)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecetteRequest $request, Recette $recette)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recette $recette)
    {
        //
    }
}
