<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IngredientController;
use Illuminate\Support\Facades\Route;



Route::get('/gestionRecettes', function () {
    return view('admin.recettes.gestionRecettes');
})->name('gestionRecettes');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::get('/gestionUtilisateurs', function () {
    return view('admin.utilisateurs.gestionUtilisateurs');
})->name('gestionUtilisateurs');

Route::get('/home', function () {
    return view('client.home');
})->name('home');

Route::get('/search', function () {
    return view('client.search');
})->name('search');



Route::get('/categories',[CategoryController::class,'index'])->name('categories.index');
Route::post('/categories',[CategoryController::class,'store'])->name('categories.store');
Route::put('/categories',[CategoryController::class,'update'])->name('categories.update');
Route::post('/categories/destroy',[CategoryController::class,'destroy'])->name('categories.destroy');


Route::get('/ingredients',[IngredientController::class,'index'])->name('ingredients.index');
Route::post('/ingredients',[IngredientController::class,'store'])->name('ingredients.store');
Route::put('/ingredients',[IngredientController::class,'update'])->name('ingredients.update');
Route::post('/ingredients/destroy',[IngredientController::class,'destroy'])->name('ingredients.destroy');