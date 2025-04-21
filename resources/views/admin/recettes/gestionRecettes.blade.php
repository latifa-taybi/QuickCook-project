<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickCook - Gestion des recettes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body class="bg-light text-dark min-h-screen flex flex-col">
    @section('title', 'Gestion des recettes')

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main content -->
        <div class="flex-1 flex flex-col">
            <!-- Top navbar -->
            @include('layouts.nav')
            <!-- Main content area -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-4 md:p-6">
                <!-- Page header with actions -->
                <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h2 class="text-2xl font-display font-bold text-gray-900">Bibliothèque de recettes</h2>
                        <p class="mt-1 text-sm text-gray-500">Gérez toutes vos recettes en un seul endroit</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <button id="addRecipeBtn"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                            <i class="fas fa-plus mr-2"></i>
                            Ajouter une recette
                        </button>
                    </div>
                </div>

                <!-- Search and filters -->
                <div class="mb-6 bg-white rounded-xl shadow p-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Search Bar -->
                        <div class="relative col-span-1 md:col-span-2">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="text" id="searchRecipe"
                                class="focus:ring-brand-500 focus:border-brand-500 block w-full pl-10 pr-4 py-2 text-sm border-gray-300 rounded-lg shadow-sm"
                                placeholder="Rechercher une recette...">
                        </div>

                        <!-- Diet Filter -->
                        <div>
                            <select id="dietFilter"
                                class="block w-full pl-3 pr-10 py-2 text-sm border-gray-300 focus:outline-none focus:ring-brand-500 focus:border-brand-500 rounded-lg shadow-sm">
                                <option value="">Tous les régimes</option>
                                <option value="vegetarien">Végétarien</option>
                                <option value="vegan">Vegan</option>
                                <option value="sans-gluten">Sans gluten</option>
                                <option value="sans-lactose">Sans lactose</option>
                            </select>
                        </div>

                        <!-- Sorting Filter -->
                        <div>
                            <select id="sortRecipes"
                                class="block w-full pl-3 pr-10 py-2 text-sm border-gray-300 focus:outline-none focus:ring-brand-500 focus:border-brand-500 rounded-lg shadow-sm">
                                <option value="recent">Plus récentes</option>
                                <option value="popular">Plus populaires</option>
                                <option value="time-asc">Temps (croissant)</option>
                                <option value="time-desc">Temps (décroissant)</option>
                                <option value="name-asc">Nom (A-Z)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Recipes grid -->
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mb-8">
                    <!-- Recipe card 1 -->
                    <div class="recipe-card bg-white rounded-lg shadow overflow-hidden">
                        <div class="relative">
                            <img class="h-48 w-full object-cover"
                                src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c"
                                alt="Salade fraîcheur">
                            <div class="absolute top-0 right-0 m-2">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-leaf mr-1"></i> Végétarien
                                </span>
                            </div>
                            <div
                                class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-4">
                                <h3 class="text-lg font-medium text-white">Salade fraîcheur</h3>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center text-sm text-gray-500 mb-2">
                                <i class="fas fa-clock mr-1"></i> 15 min
                                <span class="mx-2">•</span>
                                <i class="fas fa-utensils mr-1"></i> Facile
                            </div>
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">Une salade légère et rafraîchissante
                                parfaite pour l'été, avec des légumes croquants et une vinaigrette citronnée.</p>
                            <div class="flex justify-between items-center">
                                <div class="flex -space-x-2">
                                    <img class="h-6 w-6 rounded-full ring-2 ring-white"
                                        src="https://randomuser.me/api/portraits/women/32.jpg" alt="Utilisateur">
                                    <img class="h-6 w-6 rounded-full ring-2 ring-white"
                                        src="https://randomuser.me/api/portraits/men/44.jpg" alt="Utilisateur">
                                    <img class="h-6 w-6 rounded-full ring-2 ring-white"
                                        src="https://randomuser.me/api/portraits/women/55.jpg" alt="Utilisateur">
                                </div>
                                <div class="flex space-x-1">
                                    <button class="text-gray-400 hover:text-brand-500 view-recipe" data-id="1">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="text-gray-400 hover:text-brand-500 edit-recipe" data-id="1">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-gray-400 hover:text-red-500 delete-recipe" data-id="1">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
            </main>
        </div>
    </div>

    <!-- Modal pour ajouter/modifier une recette -->
    <div id="recipeModal" class="modal fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Ajouter une recette
                            </h3>
                            <div class="mt-4">
                                <!-- Tabs -->
                                <div class="border-b border-gray-200">
                                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                                        <button
                                            class="tab-button active whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                                            data-tab="info">
                                            Informations générales
                                        </button>
                                        <button
                                            class="tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm text-gray-500"
                                            data-tab="ingredients">
                                            Ingrédients
                                        </button>
                                        <button
                                            class="tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm text-gray-500"
                                            data-tab="steps">
                                            Étapes de préparation
                                        </button>
                                        <button
                                            class="tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm text-gray-500"
                                            data-tab="media">
                                            Médias
                                        </button>
                                    </nav>
                                </div>

                                <form id="recipeForm" class="mt-4">
                                    <input type="hidden" id="recipeId" value="">

                                    <!-- Tab 1: Informations générales -->
                                    <div id="tab-info" class="tab-content active space-y-6 bg-white ">
                                        <!-- Recipe Name and Category -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div>
                                                <label for="recipeName" class="block text-sm font-semibold text-gray-700">Nom de la recette</label>
                                                <input type="text" name="recipeName" id="recipeName"
                                                    class="mt-2 w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm"
                                                    required>
                                            </div>
                                            <div>
                                                <label for="recipeCategory" class="block text-sm font-semibold text-gray-700">Catégorie</label>
                                                <select id="recipeCategory" name="recipeCategory"
                                                    class="mt-2 w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm"
                                                    required>
                                                    <option value="">Sélectionner une catégorie</option>
                                                    <option value="entree">Entrée</option>
                                                    <option value="plat">Plat principal</option>
                                                    <option value="dessert">Dessert</option>
                                                    <option value="boisson">Boisson</option>
                                                    <option value="aperitif">Apéritif</option>
                                                </select>
                                            </div>
                                        </div>
                                    
                                        <!-- Prep Time, Cook Time -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div>
                                                <label for="prepTime" class="block text-sm font-semibold text-gray-700">Temps de préparation (min)</label>
                                                <input type="number" name="prepTime" id="prepTime" min="0"
                                                    class="mt-2 w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm"
                                                    required>
                                            </div>
                                            <div>

                                                <label for="difficulty" class="block text-sm font-semibold text-gray-700">Niveau de difficulté</label>
                                                <select id="difficulty" name="difficulty"
                                                    class="mt-2 w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm"
                                                    required>
                                                    <option value="facile">Facile</option>
                                                    <option value="moyen">Moyen</option>
                                                    <option value="difficile">Difficile</option>
                                                </select>
                                            </div>
                                        </div>
                                    
                                        <!-- Recipe Description -->
                                        <div>
                                            <label for="recipeDescription" class="block text-sm font-semibold text-gray-700">Description</label>
                                            <textarea id="recipeDescription" name="recipeDescription" rows="4"
                                                class="mt-2 w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm"
                                                required></textarea>
                                        </div>
                                    
                                        <!-- Dietary Restrictions -->
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700">Régimes alimentaires</label>
                                            <div class="mt-3 flex flex-wrap gap-4">
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" class="rounded border-gray-300 text-brand-600 shadow-sm focus:ring-brand-200"
                                                        name="diet" value="vegetarien">
                                                    <span class="ml-2 text-sm text-gray-700">Végétarien</span>
                                                </label>
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" class="rounded border-gray-300 text-brand-600 shadow-sm focus:ring-brand-200"
                                                        name="diet" value="vegan">
                                                    <span class="ml-2 text-sm text-gray-700">Vegan</span>
                                                </label>
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" class="rounded border-gray-300 text-brand-600 shadow-sm focus:ring-brand-200"
                                                        name="diet" value="sans-gluten">
                                                    <span class="ml-2 text-sm text-gray-700">Sans gluten</span>
                                                </label>
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" class="rounded border-gray-300 text-brand-600 shadow-sm focus:ring-brand-200"
                                                        name="diet" value="sans-lactose">
                                                    <span class="ml-2 text-sm text-gray-700">Sans lactose</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    

                                    <!-- Tab 2: Ingrédients -->
                                    <div id="tab-ingredients" class="tab-content space-y-6 bg-white">
                                        <!-- Add Ingredient Form -->
                                        <div class="flex items-center space-x-6">
                                            <div class="flex-1">
                                                <label for="ingredientName" class="block text-sm font-semibold text-gray-700">Ingrédient</label>
                                                <input type="text" id="ingredientName"
                                                    class="mt-2 w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm"
                                                    placeholder="Nom de l'ingrédient">
                                            </div>
                                            <div class="w-24">
                                                <label for="ingredientQuantity" class="block text-sm font-semibold text-gray-700">Quantité</label>
                                                <input type="number" id="ingredientQuantity" min="0" step="0.01"
                                                    class="mt-2 w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm"
                                                    placeholder="Quantité">
                                            </div>
                                            <div class="w-24">
                                                <label for="ingredientUnit" class="block text-sm font-semibold text-gray-700">Unité</label>
                                                <select id="ingredientUnit"
                                                    class="mt-2 w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm">
                                                    <option value="g">g</option>
                                                    <option value="kg">kg</option>
                                                    <option value="ml">ml</option>
                                                    <option value="l">l</option>
                                                    <option value="c. à soupe">c. à soupe</option>
                                                    <option value="c. à café">c. à café</option>
                                                    <option value="pièce">pièce(s)</option>
                                                </select>
                                            </div>
                                            <div class="pt-4">
                                                <button type="button" id="addIngredientToList"
                                                    class="inline-flex items-center px-4 mt-2 py-3 text-sm font-medium text-white bg-brand-600 hover:bg-brand-700 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    
                                        <!-- Ingredients List -->
                                        <div class="bg-gray-50 rounded-lg p-4">
                                            <h4 class="text-sm font-semibold text-gray-700 mb-3">Liste des ingrédients</h4>
                                            <ul id="ingredientsList" class="space-y-3">
                                                <li class="ingredient-item flex justify-between items-center p-3 rounded-lg bg-white shadow-sm hover:bg-gray-100">
                                                    <span class="text-sm text-gray-800">200g de farine</span>
                                                    <button type="button" class="text-red-500 hover:text-red-700">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </li>
                                                <li class="ingredient-item flex justify-between items-center p-3 rounded-lg bg-white shadow-sm hover:bg-gray-100">
                                                    <span class="text-sm text-gray-800">3 œufs</span>
                                                    <button type="button" class="text-red-500 hover:text-red-700">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </li>
                                                <li class="ingredient-item flex justify-between items-center p-3 rounded-lg bg-white shadow-sm hover:bg-gray-100">
                                                    <span class="text-sm text-gray-800">100g de sucre</span>
                                                    <button type="button" class="text-red-500 hover:text-red-700">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>                                    

                                    <!-- Tab 3: Étapes de préparation -->
                                    <div id="tab-steps" class="tab-content space-y-4">
                                        <div class="flex items-start space-x-2">
                                            <div class="flex-1">
                                                <label for="stepDescription"
                                                    class="block text-sm font-medium text-gray-700">Description de
                                                    l'étape</label>
                                                <textarea id="stepDescription" rows="2"
                                                    class="mt-3 w-full px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm"></textarea>
                                            </div>
                                            <div class="pt-6">
                                                <button type="button" id="addStepToList"
                                                    class="inline-flex items-center px-3 mt-2 py-3 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="bg-gray-50 rounded-lg p-4">
                                            <h4 class="text-sm font-medium text-gray-700 mb-2">Liste des étapes</h4>
                                            <ol id="stepsList" class="space-y-2 list-decimal list-inside">
                                                <li
                                                    class="step-item flex justify-between items-center p-2 rounded-md bg-white">
                                                    <span>Préchauffer le four à 180°C.</span>
                                                    <button type="button" class="text-red-500 hover:text-red-700">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </li>
                                                <li
                                                    class="step-item flex justify-between items-center p-2 rounded-md bg-white">
                                                    <span>Mélanger les ingrédients secs dans un saladier.</span>
                                                    <button type="button" class="text-red-500 hover:text-red-700">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </li>
                                                <li
                                                    class="step-item flex justify-between items-center p-2 rounded-md bg-white">
                                                    <span>Incorporer les œufs un à un en mélangeant bien entre chaque
                                                        ajout.</span>
                                                    <button type="button" class="text-red-500 hover:text-red-700">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </li>
                                            </ol>
                                        </div>
                                    </div>

                                    <!-- Tab 4: Médias -->
                                    <div id="tab-media" class="tab-content space-y-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Photo
                                                principale</label>
                                            <div
                                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                                <div class="space-y-1 text-center">
                                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                                        fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                        <path
                                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                    <div class="flex text-sm text-gray-600">
                                                        <label for="file-upload"
                                                            class="relative cursor-pointer bg-white rounded-md font-medium text-brand-600 hover:text-brand-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-brand-500">
                                                            <span>Télécharger une image</span>
                                                            <input id="file-upload" name="file-upload" type="file"
                                                                class="sr-only" accept="image/*">
                                                        </label>
                                                        <p class="pl-1">ou glisser-déposer</p>
                                                    </div>
                                                    <p class="text-xs text-gray-500">
                                                        PNG, JPG, GIF jusqu'à 10MB
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Photos
                                                supplémentaires</label>
                                            <div
                                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                                <div class="space-y-1 text-center">
                                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                                        fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                        <path
                                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                    <div class="flex text-sm text-gray-600">
                                                        <label for="files-upload"
                                                            class="relative cursor-pointer bg-white rounded-md font-medium text-brand-600 hover:text-brand-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-brand-500">
                                                            <span>Télécharger des images</span>
                                                            <input id="files-upload" name="files-upload"
                                                                type="file" class="sr-only" multiple
                                                                accept="image/*">
                                                        </label>
                                                        <p class="pl-1">ou glisser-déposer</p>
                                                    </div>
                                                    <p class="text-xs text-gray-500">
                                                        PNG, JPG, GIF jusqu'à 10MB
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <label for="videoUrl" class="block text-sm font-medium text-gray-700">URL
                                                de vidéo (YouTube, Vimeo)</label>
                                            <input type="url" id="videoUrl" name="videoUrl"
                                                class="mt-2 w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm"
                                                placeholder="https://www.youtube.com/watch?v=...">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" id="saveRecipeBtn"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-brand-600 text-base font-medium text-white hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 sm:ml-3 sm:w-auto sm:text-sm">
                        suivant
                    </button>
                    <button type="button" id="cancelRecipeBtn"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmation de suppression -->
    <div id="deleteConfirmModal" class="modal fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fas fa-exclamation-triangle text-red-600"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Supprimer la recette
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Êtes-vous sûr de vouloir supprimer cette recette ? Cette action est irréversible.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" id="confirmDeleteBtn"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Supprimer
                    </button>
                    <button type="button" id="cancelDeleteBtn"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de visualisation de recette -->
    <div id="viewRecipeModal" class="modal fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="bg-white">
                    <div class="relative">
                        <img class="w-full h-64 object-cover"
                            src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c" alt="Salade fraîcheur"
                            id="viewRecipeImage">
                        <button type="button" id="closeViewRecipeBtn"
                            class="absolute top-2 right-2 bg-white rounded-full p-2 shadow-md text-gray-500 hover:text-gray-700">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2" id="viewRecipeTitle">Salade fraîcheur</h3>

                        <div class="flex flex-wrap gap-2 mb-4">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-leaf mr-1"></i> Végétarien
                            </span>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                <i class="fas fa-utensils mr-1"></i> Entrée
                            </span>
                        </div>

                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <div class="flex items-center mr-4">
                                <i class="fas fa-clock mr-1"></i>
                                <span id="viewRecipeTime">15 min</span>
                            </div>
                            <div class="flex items-center mr-4">
                                <i class="fas fa-utensils mr-1"></i>
                                <span id="viewRecipeDifficulty">Facile</span>
                            </div>
                            <div class="flex items-center mr-4">
                                <i class="fas fa-users mr-1"></i>
                                <span id="viewRecipeServings">4 personnes</span>
                            </div>
                        </div>

                        <p class="text-gray-600 mb-6" id="viewRecipeDescription">Une salade légère et rafraîchissante
                            parfaite pour l'été, avec des légumes croquants et une vinaigrette citronnée.</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <h4 class="text-lg font-medium text-gray-900 mb-3">Ingrédients</h4>
                                <ul class="space-y-2" id="viewRecipeIngredients">
                                    <li class="flex items-center">
                                        <i class="fas fa-circle text-xs text-brand-500 mr-2"></i>
                                        <span>200g de laitue</span>
                                    </li>
                                    <li class="flex items-center">
                                        <i class="fas fa-circle text-xs text-brand-500 mr-2"></i>
                                        <span>2 tomates</span>
                                    </li>
                                    <li class="flex items-center">
                                        <i class="fas fa-circle text-xs text-brand-500 mr-2"></i>
                                        <span>1 concombre</span>
                                    </li>
                                    <li class="flex items-center">
                                        <i class="fas fa-circle text-xs text-brand-500 mr-2"></i>
                                        <span>1 poivron rouge</span>
                                    </li>
                                    <li class="flex items-center">
                                        <i class="fas fa-circle text-xs text-brand-500 mr-2"></i>
                                        <span>2 c. à soupe d'huile d'olive</span>
                                    </li>
                                    <li class="flex items-center">
                                        <i class="fas fa-circle text-xs text-brand-500 mr-2"></i>
                                        <span>1 c. à soupe de jus de citron</span>
                                    </li>
                                    <li class="flex items-center">
                                        <i class="fas fa-circle text-xs text-brand-500 mr-2"></i>
                                        <span>Sel et poivre</span>
                                    </li>
                                </ul>
                            </div>

                            <div>
                                <h4 class="text-lg font-medium text-gray-900 mb-3">Préparation</h4>
                                <ol class="space-y-3 list-decimal list-inside" id="viewRecipeSteps">
                                    <li class="pl-2">
                                        <span>Laver et couper tous les légumes.</span>
                                    </li>
                                    <li class="pl-2">
                                        <span>Mélanger l'huile d'olive, le jus de citron, le sel et le poivre pour faire
                                            la vinaigrette.</span>
                                    </li>
                                    <li class="pl-2">
                                        <span>Disposer les légumes dans un saladier.</span>
                                    </li>
                                    <li class="pl-2">
                                        <span>Verser la vinaigrette sur la salade et mélanger délicatement.</span>
                                    </li>
                                    <li class="pl-2">
                                        <span>Servir immédiatement.</span>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Gestion du sidebar mobile
        const sidebar = document.getElementById('sidebar');
        const openSidebarBtn = document.getElementById('openSidebarBtn');
        const closeSidebarBtn = document.getElementById('closeSidebarBtn');

        openSidebarBtn.addEventListener('click', () => {
            sidebar.classList.add('open');
        });

        closeSidebarBtn.addEventListener('click', () => {
            sidebar.classList.remove('open');
        });

        // Gestion du menu utilisateur
        const userMenuBtn = document.getElementById('userMenuBtn');
        const userDropdown = document.getElementById('userDropdown');

        userMenuBtn.addEventListener('click', () => {
            userDropdown.classList.toggle('hidden');
        });

        // Fermer le dropdown quand on clique ailleurs
        document.addEventListener('click', (event) => {
            if (!userMenuBtn.contains(event.target) && !userDropdown.contains(event.target)) {
                userDropdown.classList.add('hidden');
            }
        });

        // Gestion des onglets dans le modal de recette
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                const tabId = button.getAttribute('data-tab');

                // Désactiver tous les onglets
                tabButtons.forEach(btn => btn.classList.remove('active', 'text-brand-600',
                    'border-brand-500'));
                tabButtons.forEach(btn => btn.classList.add('text-gray-500', 'border-transparent'));
                tabContents.forEach(content => content.classList.remove('active'));

                // Activer l'onglet sélectionné
                button.classList.add('active', 'text-brand-600', 'border-brand-500');
                button.classList.remove('text-gray-500', 'border-transparent');
                document.getElementById(`tab-${tabId}`).classList.add('active');
            });
        });

        // Gestion des modals
        const recipeModal = document.getElementById('recipeModal');
        const deleteConfirmModal = document.getElementById('deleteConfirmModal');
        const viewRecipeModal = document.getElementById('viewRecipeModal');
        const addRecipeBtn = document.getElementById('addRecipeBtn');
        const cancelRecipeBtn = document.getElementById('cancelRecipeBtn');
        const saveRecipeBtn = document.getElementById('saveRecipeBtn');
        const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        const closeViewRecipeBtn = document.getElementById('closeViewRecipeBtn');
        const recipeForm = document.getElementById('recipeForm');
        const modalTitle = document.getElementById('modal-title');

        let currentRecipeId = null;

        // Ouvrir le modal d'ajout de recette
        addRecipeBtn.addEventListener('click', () => {
            modalTitle.textContent = 'Ajouter une recette';
            recipeForm.reset();
            document.getElementById('recipeId').value = '';
            recipeModal.classList.add('active');
        });

        // Fermer le modal de recette
        cancelRecipeBtn.addEventListener('click', () => {
            recipeModal.classList.remove('active');
        });

        // Fermer le modal de confirmation de suppression
        cancelDeleteBtn.addEventListener('click', () => {
            deleteConfirmModal.classList.remove('active');
        });

        // Fermer le modal de visualisation de recette
        closeViewRecipeBtn.addEventListener('click', () => {
            viewRecipeModal.classList.remove('active');
        });

        // Gérer les boutons d'édition
        document.querySelectorAll('.edit-recipe').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                modalTitle.textContent = 'Modifier la recette';

                // Simuler le chargement des données de la recette
                // Dans une application réelle, vous feriez un appel API ici
                const mockData = getMockRecipeData(id);

                // Remplir le formulaire avec les données
                document.getElementById('recipeId').value = id;
                document.getElementById('recipeName').value = mockData.name;
                document.getElementById('recipeCategory').value = mockData.category;
                document.getElementById('prepTime').value = mockData.prepTime;
                document.getElementById('cookTime').value = mockData.cookTime;
                document.getElementById('servings').value = mockData.servings;
                document.getElementById('difficulty').value = mockData.difficulty;
                document.getElementById('recipeDescription').value = mockData.description;

                // Réinitialiser les onglets
                tabButtons[0].click();

                recipeModal.classList.add('active');
            });
        });

        view-recipe = document.querySelectorAll('.view-recipe');
        view-recipe.addEventListener('click', () => {
            viewRecipeModal.classList.add('active');
        })
        // Gérer les boutons de visualisation
        document.querySelectorAll('.view-recipe').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');

                // Simuler le chargement des données de la recette
                // Dans une application réelle, vous feriez un appel API ici
                const mockData = getMockRecipeData(id);

                // Remplir le modal avec les données
                document.getElementById('viewRecipeTitle').textContent = mockData.name;
                document.getElementById('viewRecipeTime').textContent =
                    `${parseInt(mockData.prepTime) + parseInt(mockData.cookTime)} min`;
                document.getElementById('viewRecipeDifficulty').textContent = mockData.difficulty ===
                    'facile' ? 'Facile' : mockData.difficulty === 'moyen' ? 'Moyen' : 'Difficile';
                document.getElementById('viewRecipeServings').textContent =
                    `${mockData.servings} personne${mockData.servings > 1 ? 's' : ''}`;
                document.getElementById('viewRecipeDescription').textContent = mockData.description;

                
            });
        });

        // Gérer les boutons de suppression
        document.querySelectorAll('.delete-recipe').forEach(button => {
            button.addEventListener('click', () => {
                currentRecipeId = button.getAttribute('data-id');
                deleteConfirmModal.classList.add('active');
            });
        });

        // Simuler l'ajout d'un ingrédient à la liste
        const addIngredientToList = document.getElementById('addIngredientToList');
        const ingredientsList = document.getElementById('ingredientsList');

        addIngredientToList.addEventListener('click', () => {
            const name = document.getElementById('ingredientName').value;
            const quantity = document.getElementById('ingredientQuantity').value;
            const unit = document.getElementById('ingredientUnit').value;

            if (name && quantity) {
                const li = document.createElement('li');
                li.className = 'ingredient-item flex justify-between items-center p-2 rounded-md bg-white';
                li.innerHTML = `
                    <span>${quantity}${unit} de ${name}</span>
                    <button type="button" class="text-red-500 hover:text-red-700">
                        <i class="fas fa-times"></i>
                    </button>
                `;

                // Ajouter l'événement de suppression
                li.querySelector('button').addEventListener('click', () => {
                    li.remove();
                });

                ingredientsList.appendChild(li);

                // Réinitialiser les champs
                document.getElementById('ingredientName').value = '';
                document.getElementById('ingredientQuantity').value = '';
            }
        });

        // Simuler l'ajout d'une étape à la liste
        const addStepToList = document.getElementById('addStepToList');
        const stepsList = document.getElementById('stepsList');

        addStepToList.addEventListener('click', () => {
            const description = document.getElementById('stepDescription').value;

            if (description) {
                const li = document.createElement('li');
                li.className = 'step-item flex justify-between items-center p-2 rounded-md bg-white';
                li.innerHTML = `
                    <span>${description}</span>
                    <button type="button" class="text-red-500 hover:text-red-700">
                        <i class="fas fa-times"></i>
                    </button>
                `;

                // Ajouter l'événement de suppression
                li.querySelector('button').addEventListener('click', () => {
                    li.remove();
                });

                stepsList.appendChild(li);

                // Réinitialiser le champ
                document.getElementById('stepDescription').value = '';
            }
        });

        // Simuler l'enregistrement d'une recette
        saveRecipeBtn.addEventListener('click', () => {
            // Vérifier la validité du formulaire
            if (recipeForm.checkValidity()) {
                // Dans une application réelle, vous enverriez les données à une API
                alert('Recette enregistrée avec succès !');
                recipeModal.classList.remove('active');

                // Simuler un rechargement de la page ou mise à jour du tableau
                // Dans une application réelle, vous mettriez à jour le DOM ou rechargeriez les données
            } else {
                // Déclencher la validation native du formulaire
                recipeForm.reportValidity();
            }
        });
    </script>
</body>
</html>
