<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIngredientRequest;
use App\Http\Requests\UpdateIngredientRequest;
use App\Models\Ingredient;
use App\Models\Category;
use App\Models\Unite;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    /**
     * Afficher tous les ingrédients avec leur catégorie.
     */
    public function index()
    {
        $ingredients = Ingredient::with('category')->get();
        $categories = Category::all();
        $unites = Unite::all();
        return view('admin.ingredients.gestionIngredients', compact('ingredients','unites', 'categories'));
    }

    /**
     * Ajouter un nouvel ingrédient.
     */
    public function store(StoreIngredientRequest $request)
    {

        Ingredient::create([
            'name' => $request->name,
            'photo' => $request->hasFile('photo') ? $request->file('photo')->store('photos', 'public') : null,
            'category_id' => $request->category_id,
            'description' => $request->description,
        ]);
        // dd($request->all());


        return redirect()->route('ingredients.index');
    }

    /**
     * Modifier un ingrédient existant.
     */
    public function update(UpdateIngredientRequest $request)
    {
        $ingredient = Ingredient::findOrFail($request->id);

        $ingredient->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'photo' => $request->hasFile('photo') ? $request->file('photo')->store('photos', 'public') : $ingredient->photo,
            'description' => $request->description,
        ]);

        return redirect()->route('ingredients.index');
    }
    /**
     * Supprimer un ingrédient.
     */
    public function destroy(Request $request)
    {
        $ingredient = Ingredient::find($request->id);
        // dd($ingredient);
        $ingredient->delete();
        return redirect()->route('ingredients.index');
    }
}
