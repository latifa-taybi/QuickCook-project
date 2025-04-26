<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RecetteController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegimeController;



Route::get('/', [RecetteController::class,'home'])->name('home');
Route::get('/statistique', [RecetteController::class,'statistique'])->name('statistique');

Route::get('/categories',[CategoryController::class,'index'])->name('categories.index');
Route::post('/categories',[CategoryController::class,'store'])->name('categories.store');
Route::put('/categories',[CategoryController::class,'update'])->name('categories.update');
Route::post('/categories/destroy',[CategoryController::class,'destroy'])->name('categories.destroy');


Route::get('/ingredients',[IngredientController::class,'index'])->name('ingredients.index');
Route::post('/ingredients',[IngredientController::class,'store'])->name('ingredients.store');
Route::put('/ingredients',[IngredientController::class,'update'])->name('ingredients.update');
Route::post('/ingredients/destroy',[IngredientController::class,'destroy'])->name('ingredients.destroy');

Route::get('/recettes',[RecetteController::class,'index'])->name('recettes.index');
Route::get('/recettes/create',[RecetteController::class,'create'])->name('recettes.create');
Route::post('/recettes',[RecetteController::class,'store'])->name('recettes.store');
Route::get('/recettes/{recette}',[RecetteController::class,'show'])->name('recettes.show');
Route::get('/recettes/edit/{recette}',[RecetteController::class,'edit'])->name('recettes.edit');
Route::put('/recettes/update/{recette}',[RecetteController::class,'update'])->name('recettes.update');
Route::delete('/recettes/destroy/{recette}',[RecetteController::class,'destroy'])->name('recettes.destroy');

Route::post('/register',[AuthController::class,'register'])->name('register');
Route::post('/login',[AuthController::class,'login'])->name('login');


Route::get('/search',[RecetteController::class,'indexSearch'])->name('recettes.indexSearch');
Route::post('/search',[RecetteController::class,'search'])->name('recettes.search');

Route::get('/mesRecettes',[RecetteController::class,'mesRecettes'])->name('mesRecettes');
Route::get('/client/recettes',[RecetteController::class,'index'])->name('client.recettes');
Route::post('/favories/{id}',[RecetteController::class,'favories'])->name('favories');

Route::get('/regimes', [RegimeController::class, 'index'])->name('regimes.index');
Route::post('/regimes', [RegimeController::class, 'store'])->name('regimes.store');
Route::put('/regimes', [RegimeController::class, 'update'])->name('regimes.update');
Route::delete('/regimes/destroy', [RegimeController::class, 'destroy'])->name('regimes.destroy');

Route::get('/ingredients/filtrer', [IngredientController::class, 'filtrer']);

Route::get('approveRecette', [RecetteController::class, 'approveRecette'])->name('approveRecette');

Route::post('/recettes/approve/{recette}', [RecetteController::class, 'approve'])->name('recettes.approve');
Route::post('/recettes/reject/{recette}', [RecetteController::class, 'reject'])->name('recettes.reject');



