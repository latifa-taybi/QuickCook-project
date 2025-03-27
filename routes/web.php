<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/gestionCategories', function () {
    return view('admin.categories.gestionCategories');
})->name('gestionCategories');

Route::get('/editCategorie', function () {
    return view('admin.categories.editCategorie');
})->name('editCategorie');

Route::get('/gestionIngredients', function () {
    return view('admin.ingredients.gestionIngredients');
})->name('gestionIngredients');

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
