<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use App\Http\Requests\StoreRecetteRequest;
use App\Http\Requests\UpdateRecetteRequest;
use App\Models\Ingredient;
use App\Models\Regime;
use App\Models\Unite;

class RecetteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regimes = Regime::all();
        $ingredients = Ingredient::all();
        $unites = Unite::all();
        return view('admin.recettes.gestionRecettes', compact('regimes', 'ingredients', 'unites'));
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
        $validatedData = $request->validated();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:entree,plat,dessert,boisson,aperitif',
            'prepTime' => 'required|integer|min:0',
            'difficulty' => 'required|in:facile,moyen,difficile',
            'description' => 'required|string',
            
            
            
        ]);

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
