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
    @section('title', 'Gestion des utilisateurs')

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

                <!-- Contenu principal -->
                <div class="bg-white">
                    <!-- Image avec overlay -->
                    <div class="relative h-72 w-full overflow-hidden">
                        <img class="w-full h-full object-cover"
                            src="{{ $recette->image ? asset('storage/' . $recette->image) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c' }}"
                            alt="Salade fraîcheur" id="viewRecipeImage">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent">
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <div class="flex flex-wrap gap-2 mb-2">
                                @foreach ($recette->regimes as $regime)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/90 text-brand-600 shadow-sm">
                                        {{ $regime->name }}
                                    </span>
                                @endforeach

                            </div>
                            <h3 class="text-3xl font-bold text-white" id="viewRecipeTitle">{{ $recette->name }}</h3>
                        </div>
                    </div>

                    <!-- Détails de la recette -->
                    <div class="px-6 py-5">
                        <!-- Métadonnées -->
                        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-6">
                            <div class="flex items-center">
                                <i class="fas fa-clock mr-2 text-brand-500"></i>
                                <span id="viewRecipeTime">{{ $recette->prepTime }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-utensils mr-2 text-brand-500"></i>
                                <span id="viewRecipeDifficulty">{{ $recette->difficulty }}</span>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="prose prose-sm max-w-none text-gray-600 mb-8" id="viewRecipeDescription">
                            <p>{{ $recette->description }}</p>
                        </div>

                        <!-- Grille ingrédients/préparation -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Ingrédients -->
                            <div class="bg-gray-50 rounded-xl p-5">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                    <i class="fas fa-shopping-basket mr-2 text-brand-500"></i>
                                    Ingrédients
                                </h4>
                                <ul class="space-y-3" id="viewRecipeIngredients">
                                    @foreach ($recette->ingredients as $ingredient)
                                        <li class="flex items-start">
                                            <i class="fas fa-circle text-[8px] text-brand-500 mt-2 mr-3"></i>
                                            <span class="flex-1"> {{ $ingredient->quantity }} {{ $ingredient->unit }} de
                                                {{ $ingredient->name }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Préparation -->
                            <div class="bg-gray-50 rounded-xl p-5">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                    <i class="fas fa-list-ol mr-2 text-brand-500"></i>
                                    Préparation
                                </h4>
                                <ol class="space-y-4" id="viewRecipeSteps">
                                    @foreach ($recette->etapes as $etape)
                                        <li class="flex">
                                            <span
                                                class="flex-shrink-0 flex items-center justify-center bg-brand-100 text-brand-800 rounded-full w-6 h-6 mr-3 mt-0.5 text-sm font-medium">{{ $etape->numero_etape }}</span>
                                            <span>{{ $etape->description }}</span>
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="mt-8 flex justify-end space-x-3">
                            <button type="button"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                                Modifier
                            </button>
                        </div>
                    </div>
            </main>
        </div>
    </div>
</body>

</html>
