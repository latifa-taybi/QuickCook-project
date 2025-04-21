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
                <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between">




                        <!-- Contenu principal -->
                        <div class="bg-white">
                            <!-- Image avec overlay -->
                            <div class="relative h-72 w-full overflow-hidden">
                                <img class="w-full h-full object-cover"
                                    src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c"
                                    alt="Salade fraîcheur" id="viewRecipeImage">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent">
                                </div>
                                <div class="absolute bottom-0 left-0 right-0 p-6">
                                    <div class="flex flex-wrap gap-2 mb-2">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/90 text-brand-600 shadow-sm">
                                            hhhh
                                        </span>

                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/90 text-purple-600 shadow-sm">
                                            <i class="fas fa-utensils mr-1"></i> sxdcfvg
                                        </span>
                                    </div>
                                    <h3 class="text-3xl font-bold text-white" id="viewRecipeTitle">Salade
                                        fraîcheur</h3>
                                </div>
                            </div>

                            <!-- Détails de la recette -->
                            <div class="px-6 py-5">
                                <!-- Métadonnées -->
                                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-6">
                                    <div class="flex items-center">
                                        <i class="fas fa-clock mr-2 text-brand-500"></i>
                                        <span id="viewRecipeTime">15 min</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-utensils mr-2 text-brand-500"></i>
                                        <span id="viewRecipeDifficulty">Facile</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-users mr-2 text-brand-500"></i>
                                        <span id="viewRecipeServings">4 personnes</span>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="prose prose-sm max-w-none text-gray-600 mb-8" id="viewRecipeDescription">
                                    <p>Une salade légère et rafraîchissante parfaite pour l'été, avec des
                                        légumes croquants et
                                        une vinaigrette citronnée.</p>
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
                                            <li class="flex items-start">
                                                <i class="fas fa-circle text-[8px] text-brand-500 mt-2 mr-3"></i>
                                                <span class="flex-1">200g de laitue</span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-circle text-[8px] text-brand-500 mt-2 mr-3"></i>
                                                <span class="flex-1">2 tomates</span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-circle text-[8px] text-brand-500 mt-2 mr-3"></i>
                                                <span class="flex-1">1 concombre</span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-circle text-[8px] text-brand-500 mt-2 mr-3"></i>
                                                <span class="flex-1">1 poivron rouge</span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-circle text-[8px] text-brand-500 mt-2 mr-3"></i>
                                                <span class="flex-1">2 c. à soupe d'huile d'olive</span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-circle text-[8px] text-brand-500 mt-2 mr-3"></i>
                                                <span class="flex-1">1 c. à soupe de jus de citron</span>
                                            </li>
                                            <li class="flex items-start">
                                                <i class="fas fa-circle text-[8px] text-brand-500 mt-2 mr-3"></i>
                                                <span class="flex-1">Sel et poivre</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Préparation -->
                                    <div class="bg-gray-50 rounded-xl p-5">
                                        <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                            <i class="fas fa-list-ol mr-2 text-brand-500"></i>
                                            Préparation
                                        </h4>
                                        <ol class="space-y-4" id="viewRecipeSteps">
                                            <li class="flex">
                                                <span
                                                    class="flex-shrink-0 flex items-center justify-center bg-brand-100 text-brand-800 rounded-full w-6 h-6 mr-3 mt-0.5 text-sm font-medium">1</span>
                                                <span>Laver et couper tous les légumes.</span>
                                            </li>
                                            <li class="flex">
                                                <span
                                                    class="flex-shrink-0 flex items-center justify-center bg-brand-100 text-brand-800 rounded-full w-6 h-6 mr-3 mt-0.5 text-sm font-medium">2</span>
                                                <span>Mélanger l'huile d'olive, le jus de citron, le sel et le
                                                    poivre pour faire
                                                    la vinaigrette.</span>
                                            </li>
                                            <li class="flex">
                                                <span
                                                    class="flex-shrink-0 flex items-center justify-center bg-brand-100 text-brand-800 rounded-full w-6 h-6 mr-3 mt-0.5 text-sm font-medium">3</span>
                                                <span>Disposer les légumes dans un saladier.</span>
                                            </li>
                                            <li class="flex">
                                                <span
                                                    class="flex-shrink-0 flex items-center justify-center bg-brand-100 text-brand-800 rounded-full w-6 h-6 mr-3 mt-0.5 text-sm font-medium">4</span>
                                                <span>Verser la vinaigrette sur la salade et mélanger
                                                    délicatement.</span>
                                            </li>
                                            <li class="flex">
                                                <span
                                                    class="flex-shrink-0 flex items-center justify-center bg-brand-100 text-brand-800 rounded-full w-6 h-6 mr-3 mt-0.5 text-sm font-medium">5</span>
                                                <span>Servir immédiatement.</span>
                                            </li>
                                        </ol>
                                    </div>
                                </div>

                                <!-- Boutons d'action -->
                                <div class="mt-8 flex justify-end space-x-3">
                                    <button type="button"
                                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                                        <i class="fas fa-print mr-2"></i> Modifier
                                    </button>
                                </div>
                            </div>
                        </div>
            </main>
        </div>
    </div>
</body>

</html>
