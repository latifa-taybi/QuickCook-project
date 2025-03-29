<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIngredientRequest;
use App\Http\Requests\UpdateIngredientRequest;
use App\Models\Ingredient;
use App\Models\Category;
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
        return view('admin.ingredients.gestionIngredients', compact('ingredients', 'categories'));
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
            'photo' => $request->hasFile('photo') ? $request->file('photo')->store('photos') : $ingredient->photo,
            'description' => $request->description,
        ]);

        return redirect()->route('ingredients.index');
    }

    /**
     * Supprimer un ingrédient.
     */
    public function destroy(Request $request)
    {
        $ingredient = Ingredient::findOrFail($request->id);
        $ingredient->delete();

        return redirect()->route('ingredients.index');
    }
}
