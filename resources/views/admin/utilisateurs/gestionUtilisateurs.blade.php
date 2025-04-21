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
                    <h1 class="text-2xl font-bold text-gray-800">Détails de la recette</h1>
                </div>

                <!-- Contenu de la recette -->
                <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                    <!-- Image avec titre -->
                    <div class="relative h-72 w-full overflow-hidden">
                        <img class="w-full h-full object-cover"
                            src="{{ $recette->image ? asset('storage/' . $recette->image) : 'https://via.placeholder.com/800x400' }}"
                            alt="{{ $recette->name }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <div class="flex flex-wrap gap-2 mb-2">
                                @foreach ($recette->regimes as $regime)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/90 text-brand-600 shadow-sm">
                                        {{ $regime->name }}
                                    </span>
                                @endforeach
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/90 text-purple-600 shadow-sm">
                                    <i class="fas fa-utensils mr-1"></i> {{ $recette->category }}
                                </span>
                            </div>
                            <h3 class="text-3xl font-bold text-white">{{ $recette->name }}</h3>
                        </div>
                    </div>

                    <!-- Détails de la recette -->
                    <div class="px-6 py-5">
                        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-6">
                            <div class="flex items-center">
                                <i class="fas fa-clock mr-2 text-brand-500"></i>
                                <span>{{ $recette->prepTime }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-utensils mr-2 text-brand-500"></i>
                                <span>{{ $recette->difficulty }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-users mr-2 text-brand-500"></i>
                                <span>4 personnes</span>
                            </div>
                        </div>

                        <div class="prose prose-sm max-w-none text-gray-600 mb-8">
                            {!! nl2br(e($recette->description)) !!}
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Ingrédients -->
                            <div class="bg-gray-50 rounded-xl p-5">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                    <i class="fas fa-shopping-basket mr-2 text-brand-500"></i>
                                    Ingrédients
                                </h4>
                                <ul class="space-y-3">
                                    @foreach ($recette->ingredients as $ingredient)
                                        <li class="flex items-start">
                                            <i class="fas fa-circle text-[8px] text-brand-500 mt-2 mr-3"></i>
                                            <span class="flex-1">
                                                {{ $ingredient->pivot->quantity }} {{ $ingredient->pivot->unite }} de
                                                {{ $ingredient->name }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Étapes de préparation -->
                            <div class="bg-gray-50 rounded-xl p-5">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                    <i class="fas fa-list-ol mr-2 text-brand-500"></i>
                                    Préparation
                                </h4>
                                <ol class="space-y-4">
                                    @foreach ($recette->etapes->sortBy('numero_etape') as $etape)
                                        <li class="flex">
                                            <span
                                                class="flex-shrink-0 flex items-center justify-center bg-brand-100 text-brand-800 rounded-full w-6 h-6 mr-3 mt-0.5 text-sm font-medium">
                                                {{ $etape->numero_etape }}
                                            </span>
                                            <span>{{ $etape->description }}</span>
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>

                        <!-- Bouton Modifier (facultatif) -->
                        <div class="mt-8 flex justify-end space-x-3">
                            <a href="{{ route('recettes.edit', $recette->id) }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                <i class="fas fa-edit mr-2"></i> Modifier
                            </a>
                        </div>
                    </div>
                </div>
            </main>

        </div>
    </div>
</body>

</html>
