<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use App\Http\Requests\StoreRecetteRequest;
use App\Http\Requests\UpdateRecetteRequest;
use App\Models\Etape;
use App\Models\Ingredient;
use App\Models\Regime;
use App\Models\User;
use Illuminate\Http\Request;

class RecetteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recettes = Recette::with(['ingredients', 'regimes', 'etapes'])->get();
        // dd($recettes);
        $regimes = Regime::all();
        $ingredients = Ingredient::all();
        $etapes = Etape::all();
        return view('admin.recettes.gestionRecettes', compact('regimes', 'ingredients', 'etapes', 'recettes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regimes = Regime::all();
        $ingredients = Ingredient::all();
        return view('admin.recettes.ajoutRecette', compact('regimes', 'ingredients'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreRecetteRequest $request)
    {

        $recette = Recette::create([
            'name' => $request->name,
            'category' => $request->category,
            'prepTime' => $request->prepTime,
            'difficulty' => $request->difficulty,
            'description' => $request->description,
            'image' => $request->hasFile('image') ? $request->file('image')->store('photos', 'public') : null,
            'videoUrl' => $request->videoUrl
        ]);


        $recette->regimes()->attach($request->regimes);

        // dd($request->ingredients);

        foreach ($request->ingredients as $item) {

            // dd($item['name']);
            // dd($item);
            // dd($item['unite']);

            $ingredient = Ingredient::firstOrCreate([
                'name' => $item['name']
            ]);

            $recette->ingredients()->attach($ingredient->id, [
                'quantity' => $item['quantity'],
                'unite' => $item['unite'],
            ]);
        }


        foreach ($request->etapes as $item) {
            Etape::create([
                'description' => $item['desc'],
                'numero_etape' => $item['order'],
                'recette_id' => $recette->id

            ]);
        }
        return redirect()->route('recettes.index');
    }



    /**
     * Display the specified resource.
     */
    public function show(Recette $recette) 
    {
        $recette = Recette::with(['ingredients', 'regimes', 'etapes'])->find($recette->id);
        return view('admin.recettes.visualiserRecette', compact('recette'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recette $recette)
    {
        $regimes = Regime::all();
        $ingredients = Ingredient::all();
        return view('admin.recettes.modifierRecette', compact('recette', 'regimes', 'ingredients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecetteRequest $request, Recette $recette)
    {

        $recette->etapes()->delete();

        $recette->update([
            'name' => $request->name,
            'category' => $request->category,
            'prepTime' => $request->prepTime,
            'difficulty' => $request->difficulty,
            'description' => $request->description,
            'image' => $request->hasFile('image') ? $request->file('image')->store('photos', 'public') : $recette->image,
            'videoUrl' => $request->videoUrl 
        ]);

        foreach ($request->etapes as $item) {
            Etape::create([
                'description' => $item['desc'],
                'numero_etape' => $item['order'],
                'recette_id' => $recette->id
            ]);
        }

        
        foreach ($request->ingredients as $item) {
            $ingredient = Ingredient::firstOrCreate([
                'name' => $item['name']
            ]);
            
            $recette->ingredients()->attach($ingredient->id, [
                'quantity' => $item['quantity'],
                'unite' => $item['unite'],
            ]);
        }


        // $recette->regimes()->sync($request->regimes);

        // $recette->ingredients()->detach();
        // foreach ($request->ingredients as $item) {
        //     $ingredient = Ingredient::firstOrCreate([
        //         'name' => $item['name']
        //     ]);

        //     $recette->ingredients()->attach($ingredient->id, [
        //         'quantity' => $item['quantity'],
        //         'unite' => $item['unite'],
        //     ]);
        // }

        

        // return redirect()->route('recettes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recette $recette)
    {
        $recette->ingredients()->detach();
        $recette->regimes()->detach();
        $recette->etapes()->delete();
        $recette->delete();

        return redirect()->route('recettes.index');
    }

    public function home(){
        $recettes = Recette::with(['ingredients', 'regimes', 'etapes'])->inRandomOrder()->limit(3)->get();
        $regimes = Regime::all();
        $ingredients = Ingredient::all();
        return view('client.home', compact('regimes', 'ingredients', 'recettes'));
    }

    public function statistique()
    {
        $recettes = Recette::with(['ingredients', 'regimes', 'etapes'])->get();
        $regimes = Regime::all();
        $ingredients = Ingredient::all();
        $users = User::all();
        return view('admin.dashboard', compact('regimes', 'ingredients', 'users', 'recettes'));
    }



    public function indexSearch(){
        $allIngredients = Ingredient::all();
        return view('client.search', compact('allIngredients'));
    }

    /**
     * Search for a recipe based on ingredients.
     */

    public function search(Request $request)
    {
        $allIngredients = Ingredient::all();

        $ingredients = $request->ingredients;
        // dd($ingredients);

        $recettes = Recette::whereHas('ingredients', function ($query) use ($ingredients) {
            $query->whereIn('name', $ingredients);
        })->with(['ingredients', 'regimes', 'etapes'])->get();

        // dd($recettes);

        return view('client.search', compact('recettes','allIngredients'));
        }
}
