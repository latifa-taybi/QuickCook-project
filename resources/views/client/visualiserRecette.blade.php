@include('layouts.client.header')

<!-- Recipe Content -->
<main class="pt-20 pb-12">
    <!-- Recipe Hero Section -->
    <div class="relative">
        <!-- Recipe Image with improved overlay -->
            <div class="relative h-96 w-full overflow-hidden">
                <div class="relative mx-auto max-w-4xl h-full">
                    <img class="w-full h-full object-cover rounded-lg transition-transform duration-500 hover:scale-105"
                        src="{{ asset('storage/' . $recette->image)}}"
                        alt="{{ $recette->name }}" id="viewRecipeImage">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent rounded-lg"></div>
                    <!-- Recipe Title and Meta - Enhanced layout -->
                <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8">
                    <div class="flex flex-wrap gap-2 mb-3">
                        @foreach ($recette->regimes as $regime)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/90 text-brand-600 shadow-sm border border-white/20">
                            {{ $regime->name }}
                        </span>
                        @endforeach
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-white tracking-tight mb-2 drop-shadow-lg" id="viewRecipeTitle">
                        {{ $recette->name }}
                    </h1>
                    <div class="flex flex-wrap items-center gap-3 mt-4">
                        <div class="flex items-center bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full text-sm text-white border border-white/10">
                            <i class="fas fa-clock mr-2 text-amber-300"></i>
                            <span id="viewRecipeTime">{{ $recette->prepTime }}min</span>
                        </div>
                        <div class="flex items-center bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full text-sm text-white border border-white/10">
                            <i class="fas fa-utensils mr-2 text-teal-300"></i>
                            <span id="viewRecipeDifficulty">{{ $recette->difficulty }}</span>
                        </div>
                    </div>
                </div>
                <!-- Floating Action Buttons -->
                <div class="absolute top-4 right-4 z-10 flex gap-2">
                    <form action="{{route('favories', $recette->id)}}" method="POST">
                        @csrf
                        <button type="submit" class="bg-white/90 hover:bg-white text-slate-800 rounded-full p-3 shadow-lg transition-all duration-300 transform hover:scale-110">
                            <i class="{{ Auth::user()->recettes->contains($recette->id) ? 'fas text-accent-500' : 'far' }} fa-heart"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
    </div>

    <!-- Recipe Content - Improved spacing and cards -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
        <!-- Recipe Description - Enhanced card -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8 border border-slate-100">
            <h2 class="text-xl font-bold text-slate-800 mb-4 flex items-center">
                <div class="w-8 h-8 rounded-full bg-teal-100 flex items-center justify-center mr-3">
                    <i class="fas fa-align-left text-teal-600"></i>
                </div>
                Description
            </h2>
            <p class="text-slate-600 leading-relaxed" id="viewRecipeDescription">
                {{ $recette->description }}
            </p>
        </div>

        <!-- Recipe Grid - Improved card design -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Ingredients Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-slate-100">
                <div class="bg-gradient-to-r from-teal-500 to-teal-600 p-4 flex items-center">
                    <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center mr-3">
                        <i class="fas fa-shopping-basket text-white"></i>
                    </div>
                    <h2 class="text-xl font-bold text-white">
                        Ingrédients
                    </h2>
                </div>
                <div class="p-6">
                    <ul class="space-y-3" id="viewRecipeIngredients">
                        @foreach ($recette->ingredients as $ingredient)
                            <li class="flex items-start group">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-5 h-5 rounded-full bg-teal-100 flex items-center justify-center mr-3 group-hover:bg-teal-200 transition-colors">
                                        <i class="fas fa-circle text-[6px] text-teal-600"></i>
                                    </div>
                                </div>
                                <span class="flex-1 text-slate-700 group-hover:text-slate-900 transition-colors">
                                    {{ $ingredient->pivot->quantity }}{{ $ingredient->pivot->unite }} de {{ $ingredient->name }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Preparation Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-slate-100">
                <div class="bg-gradient-to-r from-amber-500 to-amber-600 p-4 flex items-center">
                    <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center mr-3">
                        <i class="fas fa-list-ol text-white"></i>
                    </div>
                    <h2 class="text-xl font-bold text-white">
                        Préparation
                    </h2>
                </div>
                <div class="p-6">
                    <ol class="space-y-4" id="viewRecipeSteps">
                        @foreach ($recette->etapes as $etape)
                        <li class="flex group">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center mr-4 font-medium text-amber-800 group-hover:bg-amber-200 transition-colors">
                                    {{ $etape->numero_etape }}
                                </div>
                            </div>
                            <span class="text-slate-700 group-hover:text-slate-900 transition-colors">{{ $etape->description }}</span>
                        </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>

        <!-- Notes Section - Enhanced design -->
        {{-- <form action="{{route('commentaire')}}" method="POST" class="bg-white rounded-xl shadow-lg p-6 mt-8 border border-slate-100">
            @csrf
            <h2 class="text-xl font-bold text-slate-800 mb-4 flex items-center">
                <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center mr-3">
                    <i class="fas fa-edit text-amber-600"></i>
                </div>
                Notes personnelles
            </h2>
            <textarea class="w-full border border-slate-200 rounded-lg p-4 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200" rows="4" placeholder="Ajoutez vos notes personnelles sur cette recette..."></textarea>
            <div class="flex justify-end mt-4">
                <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white py-2 px-6 rounded-lg transition-all duration-300 flex items-center">
                    <i class="fas fa-save mr-2"></i>
                    Enregistrer
                </button>
            </div>
        </form> --}}
    </div>
</main>

<!-- Footer - Enhanced design -->
<footer class="bg-slate-900 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="col-span-1 md:col-span-2">
                <span class="font-bold text-2xl inline-flex items-center">
                    <span class="text-teal-400">Quick</span><span class="text-amber-400">Cook</span>
                    <span class="ml-2 text-xs bg-slate-700 text-slate-300 px-2 py-1 rounded">v1.0</span>
                </span>
                <p class="mt-4 text-slate-300 leading-relaxed">
                    Cuisinez facilement avec les ingrédients que vous avez déjà chez vous. Réduisez le gaspillage alimentaire et découvrez de nouvelles recettes délicieuses.
                </p>
                <div class="mt-4 flex space-x-4">
                    <a href="#" class="text-slate-300 hover:text-white transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-slate-300 hover:text-white transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-slate-300 hover:text-white transition-colors">
                        <i class="fab fa-pinterest"></i>
                    </a>
                </div>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-slate-400 tracking-wider uppercase mb-4">Navigation</h3>
                <ul class="space-y-3">
                    <li><a href="#" class="text-base text-slate-300 hover:text-white transition-colors duration-300 flex items-center">
                        <i class="fas fa-chevron-right text-xs text-teal-400 mr-2"></i> Accueil</a></li>
                    <li><a href="#" class="text-base text-slate-300 hover:text-white transition-colors duration-300 flex items-center">
                        <i class="fas fa-chevron-right text-xs text-teal-400 mr-2"></i> Recettes</a></li>
                    <li><a href="#" class="text-base text-slate-300 hover:text-white transition-colors duration-300 flex items-center">
                        <i class="fas fa-chevron-right text-xs text-teal-400 mr-2"></i> Favoris</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-slate-400 tracking-wider uppercase mb-4">Contact</h3>
                <ul class="space-y-3">
                    <li class="flex items-center">
                        <div class="w-6 h-6 rounded-full bg-teal-500/20 flex items-center justify-center mr-2">
                            <i class="fas fa-envelope text-teal-400 text-xs"></i>
                        </div>
                        <span class="text-slate-300">contact@quickcook.com</span>
                    </li>
                    <li class="flex items-center">
                        <div class="w-6 h-6 rounded-full bg-teal-500/20 flex items-center justify-center mr-2">
                            <i class="fab fa-instagram text-teal-400 text-xs"></i>
                        </div>
                        <span class="text-slate-300">@quickcook</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="mt-12 border-t border-slate-800 pt-8">
            <p class="text-base text-slate-400 text-center">
                &copy; 2023 QuickCook. Tous droits réservés. | <a href="#" class="hover:text-teal-400 transition-colors">Politique de confidentialité</a>
            </p>
        </div>
    </div>
</footer>
</body>
</html>