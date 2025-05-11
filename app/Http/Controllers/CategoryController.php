<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.gestionCategories', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        category::create($request->all());
        return redirect()->route('categories.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request)
    {
        $category = Category::find($request->id);
        $category->update($request->all());

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $category = Category::find($request->id);
        $category->delete();
        return redirect()->route('categories.index');
    }
    /**
     * Search for a category by name.
     */
    public function rechercheCategory(Request $request)
    {
        $categories = Category::where('name', 'like', '%' . $request->search . '%')->get();
        return response()->json($categories);
    }
}
