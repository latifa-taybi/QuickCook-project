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
                        slate: {
                            850: '#17212e',
                            900: '#0f172a',
                            950: '#020617'
                        },
                        teal: {
                            150: '#a8f0e6',
                            250: '#80e5d8',
                            400: '#2dd4bf',
                            500: '#14b8a6',
                            600: '#0d9488'
                        },
                        amber: {
                            400: '#f59e0b',
                            500: '#f59e0b'
                        }
                    },
                    fontFamily: {
                        sans: ['"Inter"', 'sans-serif'],
                        display: ['"Poppins"', 'sans-serif']
                    },
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
    <style>
        .btn-primary {
            background: linear-gradient(90deg, #0d9488 0%, #2dd4bf 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(90deg, #0f766e 0%, #14b8a6 100%);
        }
        
        .btn-secondary {
            background: linear-gradient(90deg, #f59e0b 0%, #fbbf24 100%);
        }
        
        .btn-secondary:hover {
            background: linear-gradient(90deg, #d97706 0%, #f59e0b 100%);
        }
        
        .form-section {
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid #e2e8f0;
        }
        
        .form-section-title {
            color: #1e293b;
            font-weight: 600;
            font-size: 1.125rem;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .form-input {
            border: 1px solid #e2e8f0;
            border-radius: 0.375rem;
            padding: 0.5rem 0.75rem;
            width: 100%;
            transition: all 0.2s ease;
        }
        
        .form-input:focus {
            border-color: #0d9488;
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.1);
            outline: none;
        }
        
        .form-label {
            display: block;
            font-weight: 500;
            color: #334155;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }
        
        .ingredient-table th {
            background-color: #f8fafc;
            color: #64748b;
            font-weight: 500;
            text-align: left;
            padding: 0.5rem 1rem;
            font-size: 0.75rem;
            text-transform: uppercase;
        }
        
        .ingredient-table td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #e2e8f0;
            color: #334155;
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
        <main class="flex-1 overflow-y-auto p-6">
            <!-- Page header -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h2 class="text-2xl font-display font-bold text-slate-800">Ajouter une nouvelle recette</h2>
                        <p class="mt-2 text-slate-600">Remplissez les détails de votre recette</p>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <form id="recipeForm" class="space-y-6" action="{{ route('recettes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="recipeId" value="">

                <!-- Section: Informations générales -->
                <div class="form-section">
                    <h3 class="form-section-title">Informations générales</h3>

                    <!-- Recipe Name and Category -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="recipeName" class="form-label">Nom de la recette</label>
                            <input type="text" name="name" id="recipeName" class="form-input" required>
                        </div>
                        <div>
                            <label for="recipeCategory" class="form-label">Catégorie</label>
                            <select id="recipeCategory" name="category" class="form-input" required>
                                <option value="">Sélectionner une catégorie</option>
                                <option value="entree">Entrée</option>
                                <option value="plat">Plat principal</option>
                                <option value="dessert">Dessert</option>
                                <option value="boisson">Boisson</option>
                                <option value="aperitif">Apéritif</option>
                            </select>
                        </div>
                    </div>

                    <!-- Prep Time and Difficulty -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="prepTime" class="form-label">Temps de préparation (min)</label>
                            <input type="number" name="prepTime" id="prepTime" min="0" class="form-input" required>
                        </div>
                        <div>
                            <label for="difficulty" class="form-label">Niveau de difficulté</label>
                            <select id="difficulty" name="difficulty" class="form-input" required>
                                <option value="facile">Facile</option>
                                <option value="moyen">Moyen</option>
                                <option value="difficile">Difficile</option>
                            </select>
                        </div>
                    </div>

                    <!-- Recipe Description -->
                    <div class="mb-6">
                        <label for="recipeDescription" class="form-label">Description</label>
                        <textarea id="recipeDescription" name="description" rows="4" class="form-input" required></textarea>
                    </div>

                    <!-- Dietary Restrictions -->
                    <div>
                        <label class="form-label">Régimes alimentaires</label>
                        <div class="mt-3 flex flex-wrap gap-4">
                            @foreach ($regimes as $regime)
                                <div class="flex items-center">
                                    <input type="checkbox" class="rounded border-gray-300 text-teal-600 shadow-sm focus:ring-teal-200" 
                                           name="regimes[]" value="{{ $regime->id }}">
                                    <span class="ml-2 text-sm text-slate-700">{{ $regime->name }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Section: Ingrédients -->
                <div class="form-section">
                    <h3 class="form-section-title">Ingrédients</h3>
                    <!-- Add Ingredient Form -->
                    <div class="flex items-end gap-4 mb-6">
                        <div class="flex-1">
                            <label for="ingredient" class="form-label">Ingrédient</label>
                            <select id="ingredient" name="nameIngredients" placeholder="Selectionner un ingrédient..." autocomplete="off">
                                @foreach ($ingredients as $ingredient)
                                    <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-24">
                            <label for="ingredientQuantity" class="form-label">Quantité</label>
                            <input type="number" id="ingredientQuantity" name="quantite" min="0" step="0.01" 
                                   class="form-input" placeholder="0">
                        </div>
                        <div class="w-24">
                            <label for="ingredientUnit" class="form-label">Unité</label>
                            <select id="ingredientUnit" name="unit" class="form-input">
                                <option value="gramme">g</option>
                                <option value="litre">l</option>
                                <option value="pieces">pc</option>
                                <option value="tasse">tasse</option>
                            </select>
                        </div>
                        <div>
                            <button type="button" id="addIngredientToList" 
                                    class="btn-primary inline-flex items-center px-4 py-3 rounded-lg shadow text-sm font-medium text-white">
                                <i class="fas fa-plus mr-2"></i>
                                Ajouter
                            </button>
                        </div>
                    </div>

                    <!-- Ingredients List -->
                    <div>
                        <h4 class="form-label">Liste des ingrédients</h4>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-slate-200 ingredient-table">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2">Nom</th>
                                        <th class="px-4 py-2">Quantité</th>
                                        <th class="px-4 py-2">Unité</th>
                                        <th class="px-4 py-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="ingredientsTable" class="bg-white divide-y divide-slate-200">
                                    <!-- Les ingrédients seront ajoutés ici dynamiquement -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Section: Étapes de préparation -->
                <div class="form-section">
                    <h3 class="form-section-title">Étapes de préparation</h3>

                    <div class="flex items-start gap-4 mb-6">
                        <div class="flex-1">
                            <label for="stepDescription" class="form-label">Description de l'étape</label>
                            <textarea id="stepDescription" rows="3" name="etape" class="form-input"></textarea>
                        </div>
                        <div>
                            <button type="button" id="addStepToList" 
                                    class="btn-primary inline-flex items-center px-4 py-3 rounded-lg shadow text-sm font-medium text-white mt-7">
                                <i class="fas fa-plus mr-2"></i>
                                Ajouter
                            </button>
                        </div>
                    </div>

                    <div>
                        <h4 class="form-label">Liste des étapes</h4>
                        <ol id="stepsList" class="space-y-4 list-decimal list-inside pl-5">
                            <!-- Les étapes seront ajoutées ici dynamiquement -->
                        </ol>
                    </div>
                </div>

                <!-- Section: Médias -->
                <div class="form-section">
                    <h3 class="form-section-title">Médias</h3>

                    <div class="mb-6">
                        <label class="form-label">Photo principale</label>
                        <div class="mt-2 border-2 border-dashed border-slate-300 rounded-lg p-6 text-center">
                            <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <div class="mt-4">
                                <label class="cursor-pointer">
                                    <span class="text-teal-600 hover:text-teal-500 font-medium">Télécharger une image</span>
                                    <input type="file" name="image" accept="image/*" class="sr-only">
                                </label>
                                <p class="text-xs text-slate-500 mt-1">Formats acceptés : PNG, JPG, GIF (max 10MB)</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="videoUrl" class="form-label">URL de vidéo (YouTube, Vimeo)</label>
                        <input type="url" id="videoUrl" name="videoUrl" class="form-input" 
                               placeholder="https://www.youtube.com/watch?v=...">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" 
                            class="btn-primary inline-flex items-center px-6 py-3 rounded-lg shadow text-sm font-medium text-white">
                        <i class="fas fa-save mr-2"></i>
                        Enregistrer la recette
                    </button>
                </div>
            </form>
        </main>
    </div>

    <script>
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
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">${ingredientName}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">${quantity}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">${unit}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm">
                            <button type="button" class="text-red-600 hover:text-red-800 delete-ingredient">
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
                if (e.target.classList.contains('delete-ingredient') || e.target.closest(
                        '.delete-ingredient')) {
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
                    li.className = 'flex items-start';
                    li.innerHTML = `
                        <div class="flex-1">${stepCount}. ${stepInput.value}</div>
                        <div class="ml-2">
                            <input type="hidden" name="etapes[${stepCount}][desc]" value="${description}">
                            <input type="hidden" name="etapes[${stepCount}][order]" value="${stepCount}">
                            <button type="button" class="remove-step text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    `;

                    li.querySelector('.remove-step').addEventListener('click', () => {
                            li.remove();
                            // Met à jour les positions des étapes restantes
                            Array.from(stepsList.children).forEach((step, index) => {
                                step.querySelector('span').textContent =
                                    `${index + 1}. ${step.querySelector('input').value}`;
                                step.querySelectorAll('input')[1].value = index + 1;
                            });
                        });

                    stepsList.appendChild(li);

                    // Clear input
                    stepInput.value = '';
                }
            });

            // Delete step event delegation
            stepsList.addEventListener('click', function(e) {
                if (e.target.classList.contains('delete-step') || e.target.closest('.delete-step')) {
                    const li = e.target.closest('li');
                    li.remove();
                }
            });
        });

        new TomSelect("#ingredient",{
	create: true,
	sortField: {
		field: "text",
		direction: "asc"
	}
});
    </script>
</body>
</html>