@include('layouts.header')


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
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Modifier la recette</h2>
                        <!-- Form -->
                        <form id="recipeForm" class="mt-4 space-y-8" action="{{ route('recettes.update', $recette->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="recipeId" value="">

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
                                            value="{{ old('name', $recette->name) }}" required>
                                    </div>
                                    <div>
                                        <label for="recipeCategory"
                                            class="block text-sm font-semibold text-gray-700">Catégorie</label>
                                        <select id="recipeCategory" name="category"
                                            class="mt-2 w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm"
                                            required>
                                            <option value="">Sélectionner une catégorie</option>
                                            <option value="entree"
                                                {{ old('category', $recette->category) == 'entree' ? 'selected' : '' }}>
                                                Entrée</option>
                                            <option value="plat"
                                                {{ old('category', $recette->category) == 'plat' ? 'selected' : '' }}>
                                                Plat principal</option>
                                            <option value="dessert"
                                                {{ old('category', $recette->category) == 'dessert' ? 'selected' : '' }}>
                                                Dessert</option>
                                            <option value="boisson"
                                                {{ old('category', $recette->category) == 'boisson' ? 'selected' : '' }}>
                                                Boisson</option>
                                            <option value="aperitif"
                                                {{ old('category', $recette->category) == 'aperitif' ? 'selected' : '' }}>
                                                Apéritif</option>
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
                                            value="{{ old('prepTime', $recette->prepTime) }}" required>
                                    </div>
                                    <div>
                                        <label for="difficulty" class="block text-sm font-semibold text-gray-700">Niveau
                                            de difficulté</label>
                                        <select id="difficulty" name="difficulty"
                                            class="mt-2 w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm"
                                            required>
                                            <option value="facile"
                                                {{ old('difficulty', $recette) == 'facile' ? 'selected' : '' }}>Facile
                                            </option>
                                            <option value="moyen"
                                                {{ old('difficulty', $recette) == 'moyen' ? 'selected' : '' }}>Moyen
                                            </option>
                                            <option value="difficile"
                                                {{ old('difficulty', $recette) == 'difficile' ? 'selected' : '' }}>
                                                Difficile</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Recipe Description -->
                                <div>
                                    <label for="recipeDescription"
                                        class="block text-sm font-semibold text-gray-700">Description</label>
                                    <textarea id="recipeDescription" name="description" rows="4"
                                        class="mt-2 w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm"
                                        required>{{ old('description', $recette->description) }}</textarea>
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
                                        <label for="ingredientName"
                                            class="block text-sm font-semibold text-gray-700">Ingrédient</label>
                                        <select id="ingredient" name="ingredient" placeholder="Commence à taper...">
                                            @foreach ($ingredients as $ingredient)
                                                <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="w-24">
                                        <label for="ingredientUnit"
                                            class="block text-sm font-semibold text-gray-700">Unité</label>
                                        <select id="ingredientUnit" name="unit"
                                            class="mt-2 w-full py-2 px-3 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm bg-white"
                                            required>
                                            <option value="gramme">g</option>
                                            <option value="litre">l</option>
                                            <option value="pieces">pc</option>
                                            <option value="tasse">tasse</option>
                                        </select>
                                    </div>
                                    <div class="w-24">
                                        <label for="ingredientQuantity"
                                            class="block text-sm font-semibold text-gray-700">Quantité</label>
                                        <input type="number" id="ingredientQuantity" name="quantite" min="0"
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
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Nom
                                                </th>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">
                                                    Quantité</th>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Unité
                                                </th>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">
                                                    Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="ingredientsTable" class="bg-white divide-y divide-gray-200">
                                            <!-- Les ingrédients seront ajoutés ici dynamiquement -->
                                            @foreach ($recette->ingredients as $ingredient)
                                                <tr>
                                                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">{{ $ingredient->name }}</td>
                                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">{{ $ingredient->pivot->quantity }}</td>
                                                <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-800">{{ $ingredient->pivot->unit }}</td>
                                                <td class="px-4 py-2 whitespace-nowrap text-sm">
                                                    <button type="button" class="text-red-600 hover:text-red-800 delete-ingredient">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    <input type="hidden" name="ingredients[{{ $ingredient->id }}][nameIngredient]" value="{{ $ingredient->name }}">
                                                    <input type="hidden" name="ingredients[{{ $ingredient->id }}][quantity]" value="{{ $ingredient->pivot->quantity }}">
                                                    <input type="hidden" name="ingredients[{{ $ingredient->id }}][unite]" value="{{ $ingredient->pivot->unit }}">
                                                </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Section: Étapes de préparation -->
                            <div class="space-y-4 pt-6">
                                <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">Étapes de préparation
                                </h3>

                                <div class="flex items-start space-x-2">
                                    <div class="flex-1">
                                        <label for="stepDescription"
                                            class="block text-sm font-medium text-gray-700">Description de
                                            l'étape</label>
                                        <textarea id="stepDescription" rows="2" name="etape"
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
                                        <!-- Les étapes seront ajoutées ici dynamiquement -->
                                        @foreach ($recette->etapes->sortBy('numero_etape') as $etape)
                                            <li class="flex items-start existLi">

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
                                                        class="remove-step text-red-600 hover:text-red-800">
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
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Photo
                                        principale</label>
                                    <div class="border-2 border-dashed border-gray-300 rounded-md p-4 text-center">
                                        @if($recette->image_path)
                                            <div class="mr-4">
                                                <img src="{{ asset('storage/' . $recette->image_path) }}" alt="Image de la recette"
                                                    class="h-24 w-24 object-cover rounded-md">
                                            </div>
                                        @endif
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
                                                <span>Télécharger une image</span>
                                                <input type="file" name="image" accept="image/*"
                                                    class="sr-only">
                                            </label>
                                            <p class="text-xs text-gray-500 mt-1">
                                                Formats acceptés : PNG, JPG, GIF (max 10MB)
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label for="videoUrl" class="block text-sm font-medium text-gray-700">URL de vidéo
                                        (YouTube, Vimeo)</label>
                                    <input type="url" id="videoUrl" name="videoUrl"
                                        value="{{ $recette->videoUrl }}"
                                        class="mt-2 w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm"
                                        placeholder="https://www.youtube.com/watch?v=...">
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-6">
                                <button type="submit"
                                    class="w-full sm:w-auto px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Enregistrer la recette
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gestion des ingrédients
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

                    // Création de la ligne du tableau
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

                    // Nettoyage des champs
                    quantityInput.value = '';
                }
            });

            // Suppression d'ingrédient par délégation d'événement
            ingredientsTable.addEventListener('click', function(e) {
                if (e.target.classList.contains('delete-ingredient') || e.target.closest(
                        '.delete-ingredient')) {
                    const row = e.target.closest('tr');
                    row.remove();
                }
            });

            // Gestion des étapes de préparation
            const addStepBtn = document.getElementById('addStepToList');
            const stepsList = document.getElementById('stepsList');

            // Gestionnaire pour les boutons de suppression existants
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

                    // Création de l'élément de liste
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

                    // Ajouter le gestionnaire d'événements directement à ce nouveau bouton
                    li.querySelector('.remove-step').addEventListener('click', function() {
                        li.remove();
                        updateStepNumbers();
                    });

                    stepsList.appendChild(li);

                    // Nettoyage du champ
                    stepInput.value = '';
                }
            });

            // Fonction pour mettre à jour les numéros d'étape
            function updateStepNumbers() {
                Array.from(stepsList.children).forEach((step, index) => {
                    const newNumber = index + 1;
                    // Mettre à jour le texte affiché
                    const textElement = step.querySelector('.flex-1');
                    if (textElement) {
                        const currentText = textElement.textContent;
                        const textWithoutNumber = currentText.replace(/^\d+\./, '').trim();
                        textElement.textContent = `${newNumber}. ${textWithoutNumber}`;
                    }

                    // Mettre à jour l'ordre dans les champs cachés
                    const orderInput = step.querySelector('input[name$="[order]"]');
                    if (orderInput) {
                        orderInput.value = newNumber;
                        // Mettre également à jour le nom du champ pour qu'il corresponde au nouvel index
                        const oldName = orderInput.name;
                        const newName = oldName.replace(/etapes\[\d+\]/, `etapes[${newNumber}]`);
                        orderInput.name = newName;
                    }

                    // Faire de même pour le champ de description
                    const descInput = step.querySelector('input[name$="[desc]"]');
                    if (descInput) {
                        const oldName = descInput.name;
                        const newName = oldName.replace(/etapes\[\d+\]/, `etapes[${newNumber}]`);
                        descInput.name = newName;
                    }
                });
            }
        });
        // Initialisation de TomSelect pour le champ d'ingrédient
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
