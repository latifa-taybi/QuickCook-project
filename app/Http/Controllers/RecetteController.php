<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use App\Http\Requests\StoreRecetteRequest;
use App\Http\Requests\UpdateRecetteRequest;
use App\Models\Etape;
use App\Models\Ingredient;
use App\Models\Regime;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Exception;

class RecetteController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::allows('is-admin')) {
            $recettes = Recette::with(['ingredients', 'regimes', 'etapes'])->paginate(8);
            $regimes = Regime::all();
            $ingredients = Ingredient::all();
            $etapes = Etape::all();
            return view('admin.recettes.gestionRecettes', compact('regimes', 'ingredients', 'etapes', 'recettes'));
        } else {
            $recettes = Recette::with(['ingredients', 'regimes', 'etapes'])->paginate(8);
            return view('client.recettes', compact('recettes'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regimes = Regime::all();
        $ingredients = Ingredient::all();

        if (Gate::allows('is-admin')) {
            return view('admin.recettes.ajoutRecette', compact('regimes', 'ingredients'));
        } else {
            return view('client.ajoutRecette', compact('regimes', 'ingredients'));
        }
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
            'user_id' => Auth::user()->id,
            'image' => $request->hasFile('image') ? $request->file('image')->store('photos', 'public') : null,
            'videoUrl' => $request->videoUrl,
        ]);

        $recette->regimes()->attach($request->regimes);

        foreach ($request->ingredients as $item) {

            $ingredient = Ingredient::firstOrCreate([
                'name' => $item['nameIngredient'],
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
        if (Gate::allows('is-admin')) {
            return redirect()->route('recettes.index');
        } else {
            return redirect()->route('mesRecettes');
        }
    
    }


    /**
     * Display the specified resource.
     */
    public function show(Recette $recette)
    {
        $recette = Recette::with(['ingredients', 'regimes', 'etapes'])->find($recette->id);
        if (Gate::allows('is-admin')) {
            return view('admin.recettes.visualiserRecette', compact('recette'));
        } else {
            return view('client.visualiserRecette', compact('recette'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recette $recette)
    {
        $this->authorize('update', $recette);
        $regimes = Regime::all();
        $ingredients = Ingredient::all();
        if (Gate::allows('is-admin')) {
            return view('admin.recettes.modifierRecette', compact('recette', 'regimes', 'ingredients'));
        } else {
            return view('client.modifierRecette', compact('recette', 'regimes', 'ingredients'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecetteRequest $request, Recette $recette)
    {
            
        $recette->ingredients()->detach();
        foreach ($request->ingredients as $item) {
            $ingredient = Ingredient::firstOrCreate([
                'name' => $item['nameIngredient'],
            ]);
            
            $recette->ingredients()->attach($ingredient->id, [
                'quantity' => $item['quantity'],
                'unite' => $item['unite'],
            ]);
        }
        $recette->etapes()->delete();   
        $recette->update([
            'name' => $request->name,
            'category' => $request->category,
            'prepTime' => $request->prepTime,
            'difficulty' => $request->difficulty,
            'description' => $request->description,
            'user_id' => Auth::user()->id,
            'image' => $request->hasFile('image') ? $request->file('image')->store('photos', 'public') : $recette->image,
            'videoUrl' => $request->videoUrl,
        ]);

        foreach ($request->etapes as $item) {
            Etape::create([
                'description' => $item['desc'],
                'numero_etape' => $item['order'],
                'recette_id' => $recette->id
            ]);
        }

        

        $recette->regimes()->sync($request->regimes);

        
        if (Gate::allows('is-admin')) {
            return redirect()->route('recettes.index');
        } else {
            return redirect()->route('mesRecettes');
        }
       
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

        if (Gate::allows('is-admin')) {
            return redirect()->route('recettes.index');
        } else {
            return redirect()->route('mesRecettes');
        }
    }

    public function home()
    {
        $recettes = Recette::with(['ingredients', 'regimes', 'etapes'])->inRandomOrder()->limit(3)->get();
        $regimes = Regime::all();
        $ingredients = Ingredient::all();
        return view('client.home', compact('regimes', 'ingredients', 'recettes'));
    }

    public function statistique()
    {
        $recettes = Recette::with(['ingredients', 'regimes', 'etapes'])->paginate(8);
        $regimes = Regime::all();
        $ingredients = Ingredient::all();
        $users = User::all();
        return view('admin.dashboard', compact('regimes', 'ingredients', 'users', 'recettes'));
    }

    public function indexSearch()
    {
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

        $recettes = Recette::whereHas('ingredients', function ($query) use ($ingredients) {
            $query->whereIn('name', $ingredients);
        })->with(['ingredients', 'regimes', 'etapes'])->paginate(8);

        return view('client.search', compact('recettes', 'allIngredients'));
    }

    public function mesRecettes()
    {
        $recettes = Recette::with(['ingredients', 'regimes', 'etapes'])->where('user_id', Auth::user()->id)->paginate(8);
        return view('client.mesRecettes', compact('recettes'));
    }

    public function favories($id)
    {
        $user = Auth::user();
        // dd($user);
        if (!$user->favoritesRecette()->where('recette_id', $id)->exists()) {
            $user->favoritesRecette()->attach($id);
        }else{
            $user->favoritesRecette()->detach($id);
        }

        return redirect()->back();
    }
}