@include('layouts.header')
<body class="bg-slate-50 font-sans text-slate-800 min-h-screen flex">
    <!-- Sidebar -->
    @include('layouts.sidebar')
    
    <!-- Main content -->
    <div class="flex-1 flex flex-col ml-0">
        <!-- Top navbar -->
        @include('layouts.nav')
        
        <!-- Main content area -->
        <main class="p-10 flex-1 overflow-y-auto">
            <!-- Recipe Hero Section -->
            <div class="relative recipe-hero w-full overflow-hidden">
                <div class="absolute inset-0 hero-gradient z-10"></div>
                <img class="w-full h-full object-cover object-center transform hover:scale-105 transition-transform duration-1000"
                    src="{{ asset('storage/' . $recette->image)  }}"
                    alt="{{ $recette->name }}">
                <div class="absolute bottom-0 left-0 right-0 p-8 pb-16 z-20">
                    <div class="max-w-6xl mx-auto">
                        <div class="flex flex-wrap gap-3 mb-6">
                            @foreach ($recette->regimes as $regime)
                                <span class="recipe-tag inline-flex items-center px-5 py-2 rounded-full text-sm font-medium shadow-lg">
                                    {{ $regime->name }} 
                                </span>
                            @endforeach
                        </div>
                        <h3 class="text-5xl md:text-5xl font-display font-bold text-white mb-4 leading-tight">{{ $recette->name }}</h3>
                        <div class="flex flex-wrap items-center gap-6 text-gray-200 text-base">
                            <span class="flex items-center font-medium">
                                <i class="fas fa-clock mr-3 text-teal-300"></i>
                                {{ $recette->prepTime }} min
                            </span>
                            <span class="flex items-center font-medium">
                                <i class="fas fa-utensils mr-3 text-teal-300"></i>
                                {{ ucfirst($recette->difficulty) }}
                            </span>
                            <span class="flex items-center font-medium">
                                <i class="fas fa-layer-group mr-3 text-teal-300"></i>
                                {{ ucfirst($recette->category) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recipe Content -->
            <div class="max-w-5xl mx-auto py-10">
                <!-- Description -->
                <div class="mb-16 text-center">
                    <div class="prose max-w-3xl mx-auto text-slate-600">
                        <p class="text-xl">{{ $recette->description }}</p>
                    </div>
                </div>

                <!-- Ingredients and Steps -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mb-16">
                    <!-- Ingredients -->
                    <div class="recipe-section p-10">
                        <div class="flex items-center mb-10">
                            <div class="section-icon bg-teal-100 mr-5">
                                <i class="fas fa-shopping-basket text-teal-600 text-2xl"></i>
                            </div>
                            <h2 class="text-3xl font-display font-semibold text-slate-800">Ingrédients</h2>
                        </div>
                        <ul class="space-y-4">
                            @foreach ($recette->ingredients as $ingredient)
                                <li class="ingredient-item flex items-start pl-6">
                                    <span class="flex-shrink-0 w-2 h-2 bg-teal-500 rounded-full mt-3 mr-4"></span>
                                    <span class="text-slate-700">
                                        <span class="font-medium text-slate-800">{{ $ingredient->pivot->quantity }} {{ $ingredient->pivot->unite }}</span>
                                        <span class="text-slate-600"> de {{ $ingredient->name }}</span>
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Preparation Steps -->
                    <div class="recipe-section p-10">
                        <div class="flex items-center mb-10">
                            <div class="section-icon bg-teal-100 mr-5">
                                <i class="fas fa-list-ol text-teal-600 text-2xl"></i>
                            </div>
                            <h2 class="text-3xl font-display font-semibold text-slate-800">Préparation</h2>
                        </div>
                        <ol class="space-y-8">
                            @foreach ($recette->etapes->sortBy('numero_etape') as $etape)
                                <li class="step-item flex items-start">
                                    <span class="recipe-step-number flex-shrink-0 mr-5">
                                        {{ $etape->numero_etape }}
                                    </span>
                                    <span class="text-slate-700">{{ $etape->description }}</span>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-wrap justify-center gap-6 pt-12 border-t border-slate-200">
                    <a href="{{ route('recettes.index') }}" class="btn-secondary inline-flex items-center px-8 py-4 rounded-xl shadow-lg text-base font-medium text-white">
                        <i class="fas fa-arrow-left mr-3"></i>
                        Retour aux recettes
                    </a>
                    <a href="{{ route('recettes.edit', $recette->id) }}" class="btn-primary inline-flex items-center px-8 py-4 rounded-xl shadow-lg text-base font-medium text-white">
                        <i class="fas fa-edit mr-3"></i>
                        Modifier la recette
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>

</html>