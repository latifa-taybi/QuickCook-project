<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickCook - Ajouter une recette</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand': {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                        },
                        'accent': {
                            500: '#8b5cf6',
                        },
                    },
                },
            },
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .grain-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.1'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 1;
        }

        .text-gradient {
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            background-image: linear-gradient(to right, #0ea5e9, #8b5cf6);
        }

        .bg-glass {
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
        }

        .shadow-strong {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
        }

        .btn-hover {
            transition: all 0.2s ease;
        }

        .btn-hover:hover {
            transform: translateY(-2px);
        }

        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col">
    @include('layouts.client.header')

    <!-- Page Title Section -->
    <section class="relative py-12 bg-gradient-to-br from-brand-50 to-white">
        <!-- Grain overlay for texture -->
        <div class="grain-overlay"></div>
        
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 fade-in">
                <div>
                    <h1 class="font-bold text-3xl md:text-4xl text-slate-900">
                        Créer une <span class="text-gradient">recette</span>
                    </h1>
                    <p class="text-slate-600 mt-2">
                        Partagez votre créativité culinaire avec la communauté
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content area -->
    <main class="flex-1 container mx-auto px-4 py-8">
        <div class="bg-white overflow-hidden shadow-sm rounded-xl mb-8 fade-in">
            <div class="p-6 bg-white border-b border-gray-200">
                <!-- Form -->
                <form id="recipeForm" class="mt-4 space-y-8" action="{{ route('recettes.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="recipeId" value="">

                    <!-- Section: Informations générales -->
                    <div class="space-y-6 bg-white">
                        <h3 class="text-lg font-semibold text-slate-800 border-b pb-2">
                            <i class="fas fa-info-circle text-brand-500 mr-2"></i> Informations générales
                        </h3>

                        <!-- Recipe Name and Category -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="recipeName" class="block text-sm font-semibold text-slate-700">Nom de la recette</label>
                                <input type="text" name="name" id="recipeName"
                                    class="mt-2 w-full py-2 px-4 border border-slate-200 rounded-lg shadow-sm focus:ring-brand-100 focus:border-brand-400 text-sm"
                                    required>
                            </div>
                            <div>
                                <label for="recipeCategory" class="block text-sm font-semibold text-slate-700">Catégorie</label>
                                <select id="recipeCategory" name="category"
                                    class="mt-2 w-full py-2 px-4 border border-slate-200 rounded-lg shadow-sm focus:ring-brand-100 focus:border-brand-400 text-sm"
                                    required>
                                    <option value="">Sélectionner une catégorie</option>
                                    <option value="entree">Entrée</option>
                                    <option value="plat"> Plat principal</option>
                                    <option value="dessert">Dessert</option>
                                    <option value="boisson">Boisson</option>
                                    <option value="aperitif">Apéritif</option>
                                </select>
                            </div>
                        </div>

                        <!-- Prep Time and Difficulty -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="prepTime" class="block text-sm font-semibold text-slate-700">Temps de préparation (min)</label>
                                <input type="number" name="prepTime" id="prepTime" min="0"
                                    class="mt-2 w-full py-2 px-4 border border-slate-200 rounded-lg shadow-sm focus:ring-brand-100 focus:border-brand-400 text-sm" 
                                    required>
                            </div>
                            <div>
                                <label for="difficulty" class="block text-sm font-semibold text-slate-700">Niveau de difficulté</label>
                                <select id="difficulty" name="difficulty"
                                    class="mt-2 w-full py-2 px-4 border border-slate-200 rounded-lg shadow-sm focus:ring-brand-100 focus:border-brand-400 text-sm"
                                    required>
                                    <option value="facile">Facile</option>
                                    <option value="moyen">Moyen</option>
                                    <option value="difficile">Difficile</option>
                                </select>
                            </div>
                        </div>

                        <!-- Recipe Description -->
                        <div>
                            <label for="recipeDescription" class="block text-sm font-semibold text-slate-700">Description</label>
                            <textarea id="recipeDescription" name="description" rows="4"
                                class="mt-2 w-full py-2 px-4 border border-slate-200 rounded-lg shadow-sm focus:ring-brand-100 focus:border-brand-400 text-sm"
                                required></textarea>
                        </div>

                        <!-- Dietary Restrictions -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700">Régimes alimentaires</label>
                            <div class="mt-3 flex flex-wrap gap-4">
                                @foreach ($regimes as $regime)
                                    <div class="flex items-center">
                                        <input type="checkbox"
                                            class="rounded border-slate-300 text-brand-600 shadow-sm focus:ring-brand-200"
                                            name="regimes[]" value="{{ $regime->id }}">
                                        <span class="ml-2 text-sm text-slate-700">{{ $regime->name }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Section: Ingrédients -->
                    <div class="space-y-6 bg-white pt-6">
                        <h3 class="text-lg font-semibold text-slate-800 border-b pb-2">
                            <i class="fas fa-carrot text-brand-500 mr-2"></i> Ingrédients
                        </h3>

                        <!-- Add Ingredient Form -->
                        <div class="flex items-center space-x-6">
                            <div class="flex-1">
                                <label for="ingredientName" class="block text-sm font-semibold text-slate-700">Ingrédient</label>
                                <select id="ingredient" name="nameIngredients" multiple placeholder="Entrer un ingrédient..."
                                    autocomplete="off"
                                    class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-100 outline-none transition">
                                    @foreach ($ingredients as $ingredient)
                                        <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-24">
                                <label for="ingredientUnit" class="block text-sm font-semibold text-slate-700">Unité</label>
                                <select id="ingredientUnit" name="unit"
                                    class="mt-2 w-full py-2 px-3 border border-slate-200 rounded-lg shadow-sm focus:ring-brand-100 focus:border-brand-400 text-sm bg-white"
                                    required>
                                    <option value="gramme">g</option>
                                    <option value="litre">l</option>
                                    <option value="pieces">pc</option>
                                    <option value="tasse">tasse</option>
                                </select>
                            </div>
                            <div class="w-24">
                                <label for="ingredientQuantity" class="block text-sm font-semibold text-slate-700">Quantité</label>
                                <input type="number" id="ingredientQuantity" name="quantite" min="0"
                                    step="0.01"
                                    class="mt-2 w-full py-2 px-4 border border-slate-200 rounded-lg shadow-sm focus:ring-brand-100 focus:border-brand-400 text-sm"
                                    placeholder="Quantité">
                            </div>
                            <div class="pt-4">
                                <button type="button" id="addIngredientToList"
                                    class="inline-flex items-center px-4 mt-2 py-3 text-sm font-medium text-white bg-gradient-to-r from-brand-500 to-brand-600 rounded-lg shadow-md hover:shadow-lg btn-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-400">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Ingredients List -->
                        <div class="bg-white rounded-lg border border-slate-100 shadow-md p-4">
                            <h4 class="text-sm font-semibold text-slate-700 mb-3">Liste des ingrédients</h4>
                            <table class="min-w-full divide-y divide-slate-200">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-slate-500">Nom</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-slate-500">Quantité</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-slate-500">Unité</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-slate-500">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="ingredientsTable" class="bg-white divide-y divide-slate-200">
                                    <!-- Les ingrédients seront ajoutés ici dynamiquement -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Section: Étapes de préparation -->
                    <div class="space-y-4 pt-6">
                        <h3 class="text-lg font-semibold text-slate-800 border-b pb-2">
                            <i class="fas fa-list-ul text-brand-500 mr-2"></i> Étapes de préparation
                        </h3>

                        <div class="flex items-start space-x-2">
                            <div class="flex-1">
                                <label for="stepDescription" class="block text-sm font-semibold text-slate-700">Description de l'étape</label>
                                <textarea id="stepDescription" rows="2" name="etape"
                                    class="mt-3 w-full px-4 border border-slate-200 rounded-lg shadow-sm focus:ring-brand-100 focus:border-brand-400 text-sm"></textarea>
                            </div>
                            <div class="pt-6">
                                <button type="button" id="addStepToList"
                                    class="inline-flex items-center px-3 mt-2 py-3 text-sm font-medium rounded-lg text-white bg-gradient-to-r from-brand-500 to-brand-600 shadow-md hover:shadow-lg btn-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-400">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="bg-white rounded-lg border border-slate-100 shadow-md p-4">
                            <h4 class="text-sm font-semibold text-slate-700 mb-2">Liste des étapes</h4>
                            <ol id="stepsList" class="space-y-2 list-decimal list-inside">
                                <!-- Les étapes seront ajoutées ici dynamiquement -->
                            </ol>
                        </div>
                    </div>

                    <!-- Section: Médias -->
                    <div class="space-y-4 pt-6">
                            
                            <h3 class="text-lg font-semibold text-slate-800 border-b pb-2">
                                <i class="fas fa-camera text-brand-500  mr-2"></i>Médias
                            </h3>

                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Photo principale</label>
                            <div class="border-2 border-dashed border-slate-200 rounded-lg p-6 text-center hover:border-brand-300 transition-colors">
                                <!-- Icône SVG simplifiée -->
                                <svg class="mx-auto h-12 w-12 text-slate-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <div class="mt-2">
                                    <!-- Bouton d'upload stylisé -->
                                    <label
                                        class="bg-white rounded-md font-medium text-brand-600 hover:text-brand-700 cursor-pointer transition">
                                        <span>Télécharger une image</span>
                                        <input type="file" name="image" accept="image/*"
                                            class="sr-only">
                                    </label>
                                    <p class="text-xs text-slate-500 mt-1">
                                        Formats acceptés : PNG, JPG, GIF (max 10MB)
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="videoUrl" class="block text-sm font-semibold text-slate-700">URL de vidéo (YouTube, Vimeo)</label>
                            <input type="url" id="videoUrl" name="videoUrl"
                                class="mt-2 w-full py-2 px-4 border border-slate-200 rounded-lg shadow-sm focus:ring-brand-100 focus:border-brand-400 text-sm"
                                placeholder="https://www.youtube.com/watch?v=...">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-6">
                        <button type="submit"
                            class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-brand-500 to-brand-600 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition btn-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-400">
                            Enregistrer la recette
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    @include('layouts.client.footer')

    <!-- Back to Top Button -->
    <button id="back-to-top"
        class="fixed bottom-8 right-8 bg-brand-600 text-white w-12 h-12 rounded-full shadow-lg flex items-center justify-center transition-all duration-300 opacity-0 invisible hover:bg-brand-700">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        new TomSelect("#ingredient", {
            maxItems: 1,
        });
        
        document.addEventListener('DOMContentLoaded', function() {
            // Ingredients management
            const addIngredientBtn = document.getElementById('addIngredientToList');
            const ingredientsTable = document.getElementById('ingredientsTable');

            addIngredientBtn.addEventListener('click', function() {
                const ingredientSelect = document.getElementById('ingredient');
                const quantityInput = document.getElementById('ingredientQuantity');
                const unitSelect = document.getElementById('ingredientUnit');

                if (ingredientSelect.value && quantityInput.value) {
                    const ingredientId = ingredientSelect.value;
                    const ingredientName = ingredientSelect.options[ingredientSelect.selectedIndex].text;
                    const quantity = quantityInput.value;
                    const unit = unitSelect.options[unitSelect.selectedIndex].text;

                    // Create table row
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-slate-800">${ingredientName}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-slate-800">${quantity}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-slate-800">${unit}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm">
                            <button type="button" class="text-red-600 hover:text-red-800 delete-ingredient bg-white p-1 rounded-full hover:bg-red-100 transition">
                                <i class="fas fa-trash"></i>
                            </button>
                            <input type="hidden" name="ingredients[${ingredientId}][nameIngredient]" value="${ingredientName}">
                            <input type="hidden" name="ingredients[${ingredientId}][quantity]" value="${quantity}">
                            <input type="hidden" name="ingredients[${ingredientId}][unite]" value="${unit}">
                        </td>
                    `;

                    ingredientsTable.appendChild(row);

                    // Clear inputs
                    quantityInput.value = '';
                }
            });

            // Delete ingredient event delegation
            ingredientsTable.addEventListener('click', function(e) {
                if (e.target.classList.contains('delete-ingredient') || e.target.closest('.delete-ingredient')) {
                    const row = e.target.closest('tr');
                    row.remove();
                }
            });

            // Steps management
            const addStepBtn = document.getElementById('addStepToList');
            const stepsList = document.getElementById('stepsList');

            addStepBtn.addEventListener('click', function() {
                const stepInput = document.getElementById('stepDescription');
                const description = stepInput.value.trim();
                if (description) {
                    const stepCount = stepsList.children.length + 1;

                    // Create list item
                    const li = document.createElement('li');
                    li.className = 'flex items-start py-2 border-b border-slate-100';
                    li.innerHTML = `
                        <div class="flex-1 text-slate-800">${stepCount}. ${stepInput.value}</div>
                        <div class="ml-2">
                            <input type="hidden" name="etapes[${stepCount}][desc]" value="${description}">
                            <input type="hidden" name="etapes[${stepCount}][order]" value="${stepCount}">
                            <button type="button" class="remove-step text-red-600 hover:text-red-800 bg-white p-1 rounded-full hover:bg-red-100 transition">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    `;

                    li.querySelector('.remove-step').addEventListener('click', () => {
                        li.remove();
                        // Met à jour les positions des étapes restantes
                        Array.from(stepsList.children).forEach((step, index) => {
                            // Fix: Use correct selector for the step content
                            const content = step.querySelector('.flex-1');
                            content.textContent = `${index + 1}. ${step.querySelectorAll('input')[0].value}`;
                            step.querySelectorAll('input')[1].value = index + 1;
                        });
                    });

                    stepsList.appendChild(li);

                    // Clear input
                    stepInput.value = '';
                }
            });

            // Back to top button
            const backToTopBtn = document.getElementById('back-to-top');

            window.addEventListener('scroll', () => {
                if (window.pageYOffset > 300) {
                    backToTopBtn.classList.remove('opacity-0', 'invisible');
                    backToTopBtn.classList.add('opacity-100', 'visible');
                } else {
                    backToTopBtn.classList.remove('opacity-100', 'visible');
                    backToTopBtn.classList.add('opacity-0', 'invisible');
                }
            });

            backToTopBtn.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Animation on scroll
            const fadeElements = document.querySelectorAll('.fade-in');
            const fadeInOnScroll = () => {
                fadeElements.forEach(element => {
                    const elementTop = element.getBoundingClientRect().top;
                    const windowHeight = window.innerHeight;

                    if (elementTop < windowHeight - 100) {
                        element.style.opacity = '1';
                        element.style.transform = 'translateY(0)';
                    }
                });
            };

            window.addEventListener('scroll', fadeInOnScroll);
            window.addEventListener('load', fadeInOnScroll);
        });
    </script>
</body>

</html>