<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickCook - {{ $recette->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        .recipe-hero {
            height: 70vh;
            min-height: 550px;
            max-height: 750px;
        }
        
        .recipe-tag {
            background-color: rgba(255, 255, 255, 0.92);
            color: #0d9488;
            transition: all 0.3s ease;
            backdrop-filter: blur(6px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .recipe-tag:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(13, 148, 136, 0.2);
        }
        
        .recipe-step-number {
            background: linear-gradient(135deg, #e2f5f3 0%, #a8f0e6 100%);
            color: #0d9488;
            font-weight: 600;
            box-shadow: 0 3px 6px rgba(13, 148, 136, 0.15);
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .recipe-section {
            background-color: white;
            border-radius: 18px;
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(226, 232, 240, 0.6);
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            overflow: hidden;
        }
        
        .recipe-section:hover {
            box-shadow: 0 12px 36px rgba(0, 0, 0, 0.1);
            transform: translateY(-6px);
        }
        
        .ingredient-item {
            transition: all 0.3s ease;
            padding: 10px 16px;
            border-radius: 10px;
            position: relative;
        }
        
        .ingredient-item:hover {
            background-color: #f8fafc;
            transform: translateX(6px);
        }
        
        .ingredient-item:before {
            content: "";
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 4px;
            background-color: #0d9488;
            border-radius: 50%;
            opacity: 0;
            transition: all 0.3s ease;
        }
        
        .ingredient-item:hover:before {
            opacity: 1;
            left: 8px;
        }
        
        .step-item {
            transition: all 0.3s ease;
            padding: 14px 18px;
            border-radius: 10px;
            position: relative;
        }
        
        .step-item:hover {
            background-color: #f8fafc;
            transform: translateX(6px);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #0d9488 0%, #2dd4bf 100%);
            transition: all 0.3s ease;
            border-radius: 12px;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(13, 148, 136, 0.35);
        }
        
        .btn-secondary {
            background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
            transition: all 0.3s ease;
            border-radius: 12px;
        }
        
        .btn-secondary:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(245, 158, 11, 0.35);
        }
        
        .prose {
            line-height: 1.8;
            font-size: 1.1rem;
        }
        
        .section-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
        }
        
        .hero-gradient {
            background: linear-gradient(to top, rgba(15, 23, 42, 0.8) 0%, rgba(15, 23, 42, 0.4) 50%, transparent 100%);
        }
    </style>
</head>

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
                    src="{{ $recette->image_path ? asset('storage/' . $recette->image_path) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c' }}"
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