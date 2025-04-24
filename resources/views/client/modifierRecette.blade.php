<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickCook - Modifier une recette</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="bg-light text-dark min-h-screen flex flex-col">
    <div class="flex min-h-screen">
        <!-- Main content -->
        <div class="flex-1 flex flex-col">
            <!-- Main content area -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-4 md:p-6">
                <!-- Page header with actions -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Modifier la recette</h2>

                        <!-- Form -->
                        <form id="recipeForm" class="mt-4 space-y-8" action="{{ route('recettes.update', $recette->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="recipeId" value="{{ $recette->id }}">

                            <!-- Section: Informations générales -->
                            <div class="space-y-6 bg-white">
                                <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">Informations générales
                                </h3>

                                <!-- Recipe Name and Category -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="recipeName" class="block text-sm font-semibold text-gray-700">Nom de
                                            la recette</label>
                                        <input type="text" name="name" id="recipeName"
                                            class="mt-2 w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm"
                                            value="{{ $recette->name }}" required>
                                    </div>
                                    <div>
                                        <label for="recipeCategory"
                                            class="block text-sm font-semibold text-gray-700">Catégorie</label>
                                        <select id="recipeCategory" name="category"
                                            class="mt-2 w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm"
                                            required>
                                            <option value="">Sélectionner une catégorie</option>
                                            <option value="entree" {{ $recette->category == 'entree' ? 'selected' : '' }}>Entrée</option>
                                            <option value="plat" {{ $recette->category == 'plat' ? 'selected' : '' }}> Plat principal</option>
                                            <option value="dessert" {{ $recette->category == 'dessert' ? 'selected' : '' }}>Dessert</option>
                                            <option value="boisson" {{ $recette->category == 'boisson' ? 'selected' : '' }}>Boisson</option>
                                            <option value="aperitif" {{ $recette->category == 'aperitif' ? 'selected' : '' }}>Apéritif</option>
                                        </select>
                                    </div>
                                </div>


                                <!-- Prep Time and Difficulty -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="prepTime" class="block text-sm font-semibold text-gray-700">Temps de
                                            préparation (min)</label>
                                        <input type="number" name="prepTime" id="prepTime" min="0"
                                            class="mt-2 w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm"
                                            value="{{ $recette->prepTime }}" required>
                                    </div>
                                    <div>
                                        <label for="difficulty" class="block text-sm font-semibold text-gray-700">Niveau
                                            de difficulté</label>
                                        <select id="difficulty" name="difficulty"
                                            class="mt-2 w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm"
                                            required>
                                            <option value="facile" {{ $recette->difficulty == 'facile' ? 'selected' : '' }}>Facile</option>
                                            <option value="moyen" {{ $recette->difficulty == 'moyen' ? 'selected' : '' }}>Moyen</option>
                                            <option value="difficile" {{ $recette->difficulty == 'difficile' ? 'selected' : '' }}>Difficile</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Recipe Description -->
                                <div>
                                    <label for="recipeDescription"
                                        class="block text-sm font-semibold text-gray-700">Description</label>
                                    <textarea id="recipeDescription" name="description" rows="4"
                                        class="mt-2 w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm"
                                        required>{{ $recette->description }}</textarea>
                                </div>

                                <!-- Dietary Restrictions -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700">Régimes
                                        alimentaires</label>
                                    <div class="mt-3 flex flex-wrap gap-4">
                                        @foreach ($regimes as $regime)
                                            <div class="flex items-center">
                                                <input type="checkbox"
                                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-200"
                                                    name="regimes[]" value="{{ $regime->id }}"
                                                    {{ $recette->regimes->contains($regime->id) ? 'checked' : '' }}>
                                                <span class="ml-2 text-sm text-gray-700">{{ $regime->name }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Section: Ingrédients -->
                            <div class="space-y-6 bg-white pt-6">
                                <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">Ingrédients</h3>

                                <!-- Add Ingredient Form -->
                                <div class="flex items-center space-x-6">
                                    <div class="flex-1">
                                        <label for="ingredient"
                                            class="block text-sm font-semibold text-gray-700">Ingrédient</label>
                                            <select id="ingredient" placeholder="Entrer un ingrédient..."
                                                autocomplete="off"
                                                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition">
                                                @foreach ($ingredients as $ingredient)
                                                    <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="w-24">
                                        <label for="ingredientUnit"
                                            class="block text-sm font-semibold text-gray-700">Unité</label>
                                        <select id="ingredientUnit"
                                            class="mt-2 w-full py-2 px-3 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm bg-white">
                                            <option value="gramme">g</option>
                                            <option value="litre">l</option>
                                            <option value="pieces">pc</option>
                                            <option value="tasse">tasse</option>
                                        </select>
                                    </div>
                                    <div class="w-24">
                                        <label for="ingredientQuantity"
                                            class="block text-sm font-semibold text-gray-700">Quantité</label>
                                        <input type="number" id="ingredientQuantity" min="0"
                                            step="0.01"
                                            class="mt-2 w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm"
                                            placeholder="Quantité">
                                    </div>
                                    <div class="pt-4">
                                        <button type="button" id="addIngredientToList"
                                            class="inline-flex items-center px-4 mt-2 py-3 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Ingredients List -->
                                <div class="bg-white rounded-lg shadow-sm p-4">
                                    <h4 class="text-sm font-semibold text-gray-700 mb-3">Liste des ingrédients</h4>
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead>
                                            <tr>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Nom</th>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Quantité</th>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Unité</th>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="ingredientsTable" class="bg-white divide-y divide-gray-200">
                                            <!-- Existing ingredients from the database -->
                                            @foreach($recette->ingredients as $ingredient)
                                            <tr>
                                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">{{ $ingredient->name }}</td>
                                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">{{ $ingredient->pivot->quantity }}</td>
                                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">{{ $ingredient->pivot->unite }}</td>
                                                <td class="px-4 py-2 whitespace-nowrap text-sm">
                                                    <button type="button" class="text-red-600 hover:text-red-800 delete-ingredient">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    <input type="hidden" name="ingredients[{{ $ingredient->id }}][nameIngredient]" value="{{ $ingredient->name }}">
                                                    <input type="hidden" name="ingredients[{{ $ingredient->id }}][quantity]" value="{{ $ingredient->pivot->quantity }}">
                                                    <input type="hidden" name="ingredients[{{ $ingredient->id }}][unite]" value="{{ $ingredient->pivot->unite }}">
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Section: Étapes de préparation -->
                            <div class="space-y-4 pt-6">
                                <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">Étapes de préparation</h3>

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
                                            class="inline-flex items-center px-3 mt-2 py-3 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h4 class="text-sm font-medium text-gray-700 mb-2">Liste des étapes</h4>
                                    <ol id="stepsList" class="space-y-2 list-decimal list-inside">
                                        <!-- Existing steps from the database -->
                                        @foreach($recette->etapes->sortBy('numero_etape') as $etape)
                                        <li class="flex items-start" data-step-id="{{ $etape->id }}">
                                            <div class="flex-1">{{ $etape->numero_etape . '.' }} 
                                                {{ $etape->description }}</div>
                                            <div class="ml-2">
                                                <input type="hidden"
                                                    name="etapes[{{ $etape->numero_etape }}][desc]"
                                                    value="{{ $etape->description }}">
                                                <input type="hidden"
                                                    name="etapes[{{ $etape->numero_etape }}][order]"
                                                    value="{{ $etape->numero_etape }}">
                                                <button type="button"
                                                    class="delete-step text-red-600 hover:text-red-800">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ol>
                                </div>
                            </div>

                            <!-- Section: Médias -->
                            <div class="space-y-4 pt-6">
                                <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">Médias</h3>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Photo principale</label>
                                    <div class="flex items-center">
                                    @if($recette->image_path)
                                        <div class="mr-4">
                                            <img src="{{ asset('storage/' . $recette->image_path) }}" alt="Image de la recette"
                                                class="h-24 w-24 object-cover rounded-md">
                                        </div>
                                    @endif
                                    <div class="border-2 border-dashed border-gray-300 rounded-md p-4 text-center flex-1">
                                        <!-- Icône SVG simplifiée -->
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <div class="mt-2">
                                            <!-- Bouton d'upload stylisé -->
                                            <label
                                                class="bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">
                                                <span>Changer l'image</span>
                                                <input type="file" name="image" accept="image/*"
                                                    class="sr-only">
                                            </label>
                                            <p class="text-xs text-gray-500 mt-1">
                                                Formats acceptés : PNG, JPG, GIF (max 10MB)
                                            </p>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                                <div>
                                    <label for="videoUrl" class="block text-sm font-medium text-gray-700">URL de vidéo
                                        (YouTube, Vimeo)</label>
                                    <input type="url" id="videoUrl" name="videoUrl"
                                        class="mt-2 w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm"
                                        placeholder="https://www.youtube.com/watch?v=..."
                                        value="{{ $recette->videoUrl }}">
                                </div>
                            </div>

                            <!-- Submit and Cancel Buttons -->
                            <div class="pt-6 flex space-x-4">
                                <button type="submit"
                                    class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Enregistrer les modifications
                                </button>
                                <a href="{{ route('recettes.show', $recette->id) }}"
                                    class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                    Annuler
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialiser Tom Select pour l'ingrédient
            const ingredientSelect = new TomSelect("#ingredient", {
                maxItems: 1,
                closeAfterSelect: true
            });

            // Gestion des ingrédients
            const addIngredientBtn = document.getElementById('addIngredientToList');
            const ingredientsTable = document.getElementById('ingredientsTable');

            addIngredientBtn.addEventListener('click', function() {
                const ingredientId = ingredientSelect.getValue();
                const ingredientName = ingredientSelect.getItem(ingredientId).textContent;
                const quantityInput = document.getElementById('ingredientQuantity');
                const unitSelect = document.getElementById('ingredientUnit');

                if (ingredientId && quantityInput.value) {
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
                    ingredientSelect.clear();
                    quantityInput.value = '';
                }
            });

            // Delete ingredient event delegation
            ingredientsTable.addEventListener('click', function(e) {
                const deleteButton = e.target.closest('.delete-ingredient');
                if (deleteButton) {
                    const row = deleteButton.closest('tr');
                    row.remove();
                }
            });

            // Gestion des étapes
            const addStepBtn = document.getElementById('addStepToList');
            const stepsList = document.getElementById('stepsList');
            const stepInput = document.getElementById('stepDescription');

            function updateStepNumbers() {
                const steps = stepsList.querySelectorAll('li');
                steps.forEach((step, index) => {
                    const order = index + 1;
                    const descriptionEl = step.querySelector('.flex-1');
                    const description = descriptionEl.textContent.substring(descriptionEl.textContent.indexOf('.') + 2);
                    
                    descriptionEl.textContent = `${order}. ${description}`;
                    
                    const orderInput = step.querySelector('input[name$="[order]"]');
                    orderInput.value = order;
                    
                    // Update the name attributes to reflect the new order
                    const inputs = step.querySelectorAll('input');
                    inputs.forEach(input => {
                        const name = input.name;
                        input.name = name.replace(/etapes\[\d+\]/, `etapes[${order}]`);
                    });
                });
            }

            addStepBtn.addEventListener('click', function() {
                const description = stepInput.value.trim();
                if (description) {
                    const order = stepsList.children.length + 1;

                    // Create list item
                    const li = document.createElement('li');
                    li.className = 'flex items-start';
                    li.innerHTML = `
                        <div class="flex-1">${order}. ${description}</div>
                        <div class="ml-2">
                            <input type="hidden" name="etapes[${order}][desc]" value="${description}">
                            <input type="hidden" name="etapes[${order}][order]" value="${order}">
                            <button type="button" class="delete-step text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    `;

                    stepsList.appendChild(li);

                    // Clear input
                    stepInput.value = '';
                }
            });

            // Delete step event delegation
            stepsList.addEventListener('click', function(e) {
                const deleteButton = e.target.closest('.delete-step');
                if (deleteButton) {
                    const li = deleteButton.closest('li');
                    li.remove();
                    updateStepNumbers();
                }
            });

            // Preview image when new file selected
            const imageInput = document.querySelector('input[name="image"]');
            if (imageInput) {
                imageInput.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const imgContainer = document.querySelector('.mr-4');
                        if (imgContainer) {
                            const img = imgContainer.querySelector('img');
                            img.src = URL.createObjectURL(file);
                        } else {
                            const newImg = document.createElement('div');
                            newImg.className = 'mr-4';
                            newImg.innerHTML = `<img src="${URL.createObjectURL(file)}" alt="Image de la recette" class="h-24 w-24 object-cover rounded-md">`;
                            
                            const uploadContainer = this.closest('.flex.items-center');
                            uploadContainer.insertBefore(newImg, uploadContainer.firstChild);
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>