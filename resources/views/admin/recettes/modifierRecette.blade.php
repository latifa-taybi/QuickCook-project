@include('layouts.admin.header')

<body class="bg-slate-50 font-sans text-slate-800 min-h-screen flex">
    <!-- Sidebar -->
    @include('layouts.admin.sidebar')
    
    <!-- Main content -->
    <div class="flex-1 flex flex-col ml-0">
        <!-- Top navbar -->
        @include('layouts.admin.nav')
        
        <!-- Main content area -->
        <main class="flex-1 overflow-y-auto p-6">
            <!-- Page header -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h2 class="text-2xl font-display font-bold text-slate-800">Modifier la recette</h2>
                        <p class="mt-2 text-slate-600">Modifiez les détails de votre recette</p>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <form id="recipeForm" class="space-y-6" action="{{ route('recettes.update', $recette->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="recipeId" value="{{ $recette->id }}">

                <!-- Section: Informations générales -->
                <div class="form-section">
                    <h3 class="form-section-title">Informations générales</h3>

                    <!-- Recipe Name and Category -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="recipeName" class="form-label">Nom de la recette</label>
                            <input type="text" name="name" id="recipeName" class="form-input" 
                                   value="{{ old('name', $recette->name) }}" required>
                        </div>
                        <div>
                            <label for="recipeCategory" class="form-label">Catégorie</label>
                            <select id="recipeCategory" name="category" class="form-input" required>
                                <option value="">Sélectionner une catégorie</option>
                                <option value="entree" {{ old('category', $recette->category) == 'entree' ? 'selected' : '' }}>Entrée</option>
                                <option value="plat" {{ old('category', $recette->category) == 'plat' ? 'selected' : '' }}>Plat principal</option>
                                <option value="dessert" {{ old('category', $recette->category) == 'dessert' ? 'selected' : '' }}>Dessert</option>
                                <option value="boisson" {{ old('category', $recette->category) == 'boisson' ? 'selected' : '' }}>Boisson</option>
                                <option value="aperitif" {{ old('category', $recette->category) == 'aperitif' ? 'selected' : '' }}>Apéritif</option>
                            </select>
                        </div>
                    </div>

                    <!-- Prep Time and Difficulty -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="prepTime" class="form-label">Temps de préparation (min)</label>
                            <input type="number" name="prepTime" id="prepTime" min="0" class="form-input" 
                                   value="{{ old('prepTime', $recette->prepTime) }}" required>
                        </div>
                        <div>
                            <label for="difficulty" class="form-label">Niveau de difficulté</label>
                            <select id="difficulty" name="difficulty" class="form-input" required>
                                <option value="facile" {{ old('difficulty', $recette->difficulty) == 'facile' ? 'selected' : '' }}>Facile</option>
                                <option value="moyen" {{ old('difficulty', $recette->difficulty) == 'moyen' ? 'selected' : '' }}>Moyen</option>
                                <option value="difficile" {{ old('difficulty', $recette->difficulty) == 'difficile' ? 'selected' : '' }}>Difficile</option>
                            </select>
                        </div>
                    </div>

                    <!-- Recipe Description -->
                    <div class="mb-6">
                        <label for="recipeDescription" class="form-label">Description</label>
                        <textarea id="recipeDescription" name="description" rows="4" class="form-input" required>{{ old('description', $recette->description) }}</textarea>
                    </div>

                    <!-- Dietary Restrictions -->
                    <div>
                        <label class="form-label">Régimes alimentaires</label>
                        <div class="mt-3 flex flex-wrap gap-4">
                            @foreach ($regimes as $regime)
                                <div class="flex items-center">
                                    <input type="checkbox" class="rounded border-gray-300 text-teal-600 shadow-sm focus:ring-teal-200" 
                                           name="regimes[]" value="{{ $regime->id }}"
                                           {{ $recette->regimes->contains($regime->id) ? 'checked' : '' }}>
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
                            <select id="ingredient" name="nameIngredients" placeholder="Sélectionner un ingrédient..." autocomplete="off">
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
                                    @foreach ($recette->ingredients as $ingredient)
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
                            @foreach ($recette->etapes->sortBy('numero_etape') as $etape)
                                <li class="flex items-start">
                                    <div class="flex-1">{{ $etape->numero_etape }}. {{ $etape->description }}</div>
                                    <div class="ml-2">
                                        <input type="hidden" name="etapes[{{ $etape->numero_etape }}][desc]" value="{{ $etape->description }}">
                                        <input type="hidden" name="etapes[{{ $etape->numero_etape }}][order]" value="{{ $etape->numero_etape }}">
                                        <button type="button" class="remove-step text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </li>
                            @endforeach
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
                                    <input type="file" name="image" accept="image/*" class="sr-only" id="imageInput">
                                </label>
                                <p class="text-xs text-slate-500 mt-1">Formats acceptés : PNG, JPG, GIF (max 10MB)</p>
                            </div>
                            <div class="mt-4" id="imagePreviewContainer" style="display:block;">
                                <img id="imagePreview" src="{{asset('/storage/' . $recette->image)}}" alt="Aperçu de l'image" class="mx-auto max-h-48 rounded-md shadow-md" />
                            </div>   
                        </div>
                    </div>

                    <div>
                        <label for="videoUrl" class="form-label">URL de vidéo (YouTube, Vimeo)</label>
                        <input type="url" id="videoUrl" name="videoUrl" class="form-input" 
                               value="{{ old('videoUrl', $recette->videoUrl) }}"
                               placeholder="https://www.youtube.com/watch?v=...">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end gap-4">
                    <a href="{{ route('recettes.index') }}" class="btn-secondary inline-flex items-center px-6 py-3 rounded-lg shadow text-sm font-medium text-white">
                        <i class="fas fa-times mr-2"></i>
                        Annuler
                    </a>
                    <button type="submit" 
                            class="btn-primary inline-flex items-center px-6 py-3 rounded-lg shadow text-sm font-medium text-white">
                        <i class="fas fa-save mr-2"></i>
                        Enregistrer les modifications
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

                    // Check if ingredient already exists
                    const existingRow = document.querySelector(`input[name="ingredients[${ingredientId}][nameIngredient]"]`);
                    if (existingRow) {
                        alert('Cet ingrédient est déjà dans la liste');
                        return;
                    }

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
                if (e.target.classList.contains('delete-ingredient') || e.target.closest('.delete-ingredient')) {
                    const row = e.target.closest('tr');
                    row.remove();
                }
            });

            // Steps management
            const addStepBtn = document.getElementById('addStepToList');
            const stepsList = document.getElementById('stepsList');

            // Add event listeners to existing delete buttons
            document.querySelectorAll('.remove-step').forEach(button => {
                button.addEventListener('click', function() {
                    const li = this.closest('li');
                    li.remove();
                    updateStepNumbers();
                });
            });

            addStepBtn.addEventListener('click', function() {
                const stepInput = document.getElementById('stepDescription');
                const description = stepInput.value.trim();
                if (description) {
                    const stepCount = stepsList.children.length + 1;

                    // Create list item
                    const li = document.createElement('li');
                    li.className = 'flex items-start';
                    li.innerHTML = `
                        <div class="flex-1">${stepCount}. ${description}</div>
                        <div class="ml-2">
                            <input type="hidden" name="etapes[${stepCount}][desc]" value="${description}">
                            <input type="hidden" name="etapes[${stepCount}][order]" value="${stepCount}">
                            <button type="button" class="remove-step text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    `;

                    li.querySelector('.remove-step').addEventListener('click', function() {
                        li.remove();
                        updateStepNumbers();
                    });

                    stepsList.appendChild(li);

                    // Clear input
                    stepInput.value = '';
                }
            });

            // Function to update step numbers
            function updateStepNumbers() {
                Array.from(stepsList.children).forEach((step, index) => {
                    const newNumber = index + 1;
                    // Update displayed text
                    const textElement = step.querySelector('.flex-1');
                    if (textElement) {
                        const currentText = textElement.textContent;
                        const textWithoutNumber = currentText.replace(/^\d+\./, '').trim();
                        textElement.textContent = `${newNumber}. ${textWithoutNumber}`;
                    }

                    // Update hidden inputs
                    const orderInput = step.querySelector('input[name$="[order]"]');
                    if (orderInput) {
                        orderInput.value = newNumber;
                        // Update field name to match new index
                        const oldName = orderInput.name;
                        const newName = oldName.replace(/etapes\[\d+\]/, `etapes[${newNumber}]`);
                        orderInput.name = newName;
                    }

                    // Do the same for description field
                    const descInput = step.querySelector('input[name$="[desc]"]');
                    if (descInput) {
                        const oldName = descInput.name;
                        const newName = oldName.replace(/etapes\[\d+\]/, `etapes[${newNumber}]`);
                        descInput.name = newName;
                    }
                });
            }
        });

        function afficherApercu() {
            const input = document.getElementById('imageInput');
            const apercu = document.getElementById('imagePreview');
            const conteneur = document.getElementById('imagePreviewContainer');
            
            const fichier = input.files[0];

            if (fichier && fichier.type.startsWith('image/')) {
                apercu.src = URL.createObjectURL(fichier);
                conteneur.style.display = 'block';
            }
        }

        document.getElementById('imageInput').addEventListener('change', afficherApercu);


        // Initialize TomSelect for ingredient field
        new TomSelect("#ingredient", {
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });
    </script>
</body>
</html>