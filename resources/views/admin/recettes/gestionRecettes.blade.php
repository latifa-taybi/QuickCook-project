@include('layouts.header')

<body class="bg-light text-dark min-h-screen flex flex-col">
    @section('title', 'Gestion des recettes')

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
                    <div>
                        <h2 class="text-2xl font-display font-bold text-gray-900">Bibliothèque de recettes</h2>
                        <p class="mt-1 text-sm text-gray-500">Gérez toutes vos recettes en un seul endroit</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <a href="{{route('recettes.create')}}"><button id="addRecipeBtn"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                            <i class="fas fa-plus mr-2"></i>
                            Ajouter une recette
                        </button></a>
                    </div>
                </div>

                <!-- Search and filters -->
                <div class="mb-6 bg-white rounded-xl shadow p-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Search Bar -->
                        <div class="relative col-span-1 md:col-span-2">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="text" id="searchRecipe"
                                class="focus:ring-brand-500 focus:border-brand-500 block w-full pl-10 pr-4 py-2 text-sm border-gray-300 rounded-lg shadow-sm"
                                placeholder="Rechercher une recette...">
                        </div>

                        <!-- Diet Filter -->
                        <div>
                            <select id="dietFilter"
                                class="block w-full pl-3 pr-10 py-2 text-sm border-gray-300 focus:outline-none focus:ring-brand-500 focus:border-brand-500 rounded-lg shadow-sm">
                                <option value="">Tous les régimes</option>
                                <option value="vegetarien">Végétarien</option>
                            </select>
                        </div>

                        <!-- Sorting Filter -->
                        <div>
                            <select id="sortRecipes"
                                class="block w-full pl-3 pr-10 py-2 text-sm border-gray-300 focus:outline-none focus:ring-brand-500 focus:border-brand-500 rounded-lg shadow-sm">
                                <option value="time-asc">Temps (croissant)</option>
                                <option value="time-desc">Temps (décroissant)</option>
                                <option value="name-asc">Nom (A-Z)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Recipes grid -->
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mb-8">
                    @foreach ($recettes as $recette)
                        <!-- Recipe card 1 -->
                        <div class="recipe-card bg-white rounded-lg shadow overflow-hidden">
                            <div class="relative">
                                <img class="h-48 w-full object-cover" src="{{ asset('storage/' . $recette->image) }}"
                                    alt="{{ $recette->name }}">
                                <div class="absolute top-0 right-0 m-2">
                                    @foreach ($recette->regimes as $regime)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{ $regime->name }}
                                        </span>
                                    @endforeach
                                </div>
                                <div
                                    class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-4">
                                    <h3 class="text-lg font-medium text-white">{{ $recette->name }}</h3>
                                </div>
                            </div>
                            <div class="p-4">
                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                    <i class="fas fa-clock mr-1"></i> {{ $recette->prepTime }}
                                    <span class="mx-2">•</span>
                                    <i class="fas fa-utensils mr-1"></i> {{ $recette->difficulty }}
                                </div>
                                <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $recette->description }}</p>
                                <div class="flex justify-between items-center">
                                    <div class="flex -space-x-2">
                                        <img class="h-6 w-6 rounded-full ring-2 ring-white"
                                            src="https://randomuser.me/api/portraits/women/32.jpg" alt="Utilisateur">
                                    </div>
                                    <div class="flex space-x-1">
                                        <a href="{{ route('recettes.show', $recette->id)}}"><button class="text-gray-400 hover:text-brand-500 view-recipe">
                                            <i class="fas fa-eye"></i>
                                        </button></a>
                                        <a href="{{ route('recettes.edit', $recette->id) }}">
                                            <button class="text-gray-400 hover:text-brand-500 edit-recipe">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </a>
                                        <button class="text-gray-400 hover:text-red-500 delete-recipe"
                                            data-id="{{ $recette->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Pagination -->
            </main>
        </div>
    </div>




    <!-- Modal de confirmation de suppression -->
    <div id="deleteConfirmModal" class="modal hidden fixed inset-0 z-50 overflow-y-auto"
        aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fas fa-exclamation-triangle text-red-600"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Supprimer la recette
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Êtes-vous sûr de vouloir supprimer cette recette ? Cette action est irréversible.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" id="confirmDeleteBtn"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Supprimer
                    </button>
                    <button type="button" id="cancelDeleteBtn"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de visualisation de recette -->
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sélection des éléments du DOM
            
            const recipeModal = document.getElementById('recipeModal');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const saveRecipeBtn = document.getElementById('saveRecipeBtn');
            const nextRecipeBtn = document.getElementById('nextRecipeBtn');
            const previousBtn = document.getElementById('previousBtn');
            const deleteConfirmModal = document.getElementById('deleteConfirmModal');
            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
            const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
            const viewRecipeModal = document.getElementById('viewRecipeModal');
            const closeViewRecipeBtn = document.getElementById('closeViewRecipeBtn');
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabContents = document.querySelectorAll('.tab-content');
            const addIngredientToList = document.getElementById('addIngredientToList');
            const addStepToList = document.getElementById('addStepToList');
            const deleteRecipeButtons = document.querySelectorAll('.delete-recipe');
            const viewRecipeButtons = document.querySelectorAll('.view-recipe');
            const editRecipeButtons = document.querySelectorAll('.edit-recipe');

            // Variables pour suivre la navigation dans les onglets
            let currentTabIndex = 0;
            const totalTabs = tabButtons.length;

            // Fonctions pour la gestion des modales
            function openModal(modal) {
                modal.classList.remove('hidden');
            }

            function closeModal(modal) {
                modal.classList.add('hidden');
            }

            // Fonctions pour la gestion des onglets
            function showTab(tabId) {
                // Cacher tous les contenus d'onglets
                tabContents.forEach(content => {
                    content.classList.remove('active');
                });

                // Supprimer la classe active de tous les boutons d'onglets
                tabButtons.forEach(button => {
                    button.classList.remove('active', 'border-brand-500', 'text-brand-600');
                    button.classList.add('text-gray-500', 'border-transparent');
                });

                // Afficher le contenu de l'onglet sélectionné
                const selectedTab = document.getElementById('tab-' + tabId);
                if (selectedTab) {
                    selectedTab.classList.add('active');
                }

                // Mettre en évidence le bouton d'onglet sélectionné
                const selectedButton = document.querySelector(`.tab-button[data-tab="${tabId}"]`);
                if (selectedButton) {
                    selectedButton.classList.remove('text-gray-500', 'border-transparent');
                    selectedButton.classList.add('active', 'border-brand-500', 'text-brand-600');

                    // Mettre à jour l'index de l'onglet actuel
                    currentTabIndex = Array.from(tabButtons).indexOf(selectedButton);
                }

                // Mettre à jour le texte du bouton "suivant/enregistrer" selon l'onglet
                if (currentTabIndex === totalTabs - 1) {
                    nextRecipeBtn.classList.add('hidden');
                    saveRecipeBtn.classList.remove('hidden');
                } else {
                    nextRecipeBtn.classList.remove('hidden');
                    saveRecipeBtn.classList.add('hidden');
                }

                // Afficher/masquer le bouton Précédent
                if (previousBtn) {
                    if (currentTabIndex === 0) {
                        previousBtn.style.display = 'none';
                    } else {
                        previousBtn.style.display = 'inline-flex';
                    }
                }
            }

            

            // Gestion des événements pour le bouton de fermeture de la modal
            if (closeModalBtn) {
                closeModalBtn.addEventListener('click', function() {
                    closeModal(recipeModal);
                    // Réinitialiser le formulaire si nécessaire
                    document.getElementById('recipeForm').reset();
                });
            }

            // Gestion des événements pour les boutons d'onglets
            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const tabId = this.getAttribute('data-tab');
                    showTab(tabId);
                });
            });

            // Gestion des événements pour le bouton suivant/enregistrer
            if (nextRecipeBtn) {
                nextRecipeBtn.addEventListener('click', function() {
                    if (currentTabIndex < totalTabs - 1) {
                        // Passer à l'onglet suivant
                        const nextTabButton = tabButtons[currentTabIndex + 1];
                        const nextTabId = nextTabButton.getAttribute('data-tab');
                        showTab(nextTabId);
                    } else {
                        // Sur le dernier onglet, enregistrer la recette
                        // Ici, vous pouvez ajouter le code pour enregistrer la recette
                        console.log('Enregistrement de la recette...');
                        closeModal(recipeModal);
                        // Réinitialiser le formulaire après l'enregistrement
                        document.getElementById('recipeForm').reset();
                    }
                });
            }

            // Gestion des événements pour le bouton précédent
            if (previousBtn) {
                previousBtn.addEventListener('click', function() {
                    if (currentTabIndex > 0) {
                        // Revenir à l'onglet précédent
                        const prevTabButton = tabButtons[currentTabIndex - 1];
                        const prevTabId = prevTabButton.getAttribute('data-tab');
                        showTab(prevTabId);
                    }
                });
            }


            document.getElementById('addIngredientToList').addEventListener('click', function() {
                const selectElement = document.getElementById('ingredient');
                const tomSelect = selectElement.tomselect;
                const selectedId = tomSelect.items[0];
                const selectedOption = tomSelect.options[selectedId];

                const ingredientName = selectedOption.text;
                const unitInput = document.getElementById('ingredientUnit').value;
                const quantityInput = document.getElementById('ingredientQuantity').value;

                const tableBody = document.getElementById('ingredientsTable');
                const newRow = document.createElement('tr');
                newRow.className = 'ingredient-row';
                newRow.innerHTML = `
                                    <td class="px-4 py-2">${ingredientName}</td>
                                    <td class="px-4 py-2">${quantityInput}</td>
                                    <td class="px-4 py-2">${unitInput}</td>
                                    <td class="px-4 py-2">
                                        <button class="text-red-500 hover:text-red-700 remove-ingredient">
                                            <i class="fas fa-times"></i>
                                        </button>
                                         <input type="hidden" name="ingredients[${selectedId}][id]" value="${selectedId}">
                                        <input type="hidden" name="ingredients[${ingredientName}][name]" value="${ingredientName}">
                                        <input type="hidden" name="ingredients[${unitInput}][unite]" value="${unitInput}">
                                        <input type="hidden" name="ingredients[${quantityInput}][quantity]" value="${quantityInput}">
                                    </td>
                                `;

                const deleteButton = newRow.querySelector('.remove-ingredient');
                deleteButton.addEventListener('click', function() {
                    newRow.remove();
                });

                tableBody.appendChild(newRow);
                // Réinitialiser les champs
                quantityInput.value = '';

            });





            // Gestion des événements pour le bouton d'ajout d'étape

            if (addStepToList) {
                const stepsList = document.getElementById('stepsList');
                const stepInput = document.getElementById('stepDescription');

                addStepToList.addEventListener('click', () => {
                    const description = stepInput.value.trim();

                    if (description) {
                        const position = stepsList.children.length + 1;
                        const li = document.createElement('li');
                        li.className =
                            "step-item flex justify-between items-center p-2 rounded-md bg-white shadow-sm border border-gray-200";

                        li.innerHTML = `
                <span>${position}. ${description}</span>
                <input type="hidden" name="etapes[${position}][desc]" value="${description}">
                <input type="hidden" name="etapes[${position}][order]" value="${position}">
                <button type="button" class="remove-step text-red-500 hover:text-red-700">
                    ×
                </button>
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
                        stepInput.value = '';
                    }
                });
            }

            // Gestion des événements pour les boutons de suppression de recette
            deleteRecipeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const recipeId = this.getAttribute('data-id');
                    // Stocker l'ID de la recette pour l'utiliser lors de la confirmation
                    confirmDeleteBtn.setAttribute('data-id', recipeId);
                    openModal(deleteConfirmModal);
                });
            });

            // Gestion des événements pour le bouton de confirmation de suppression
            if (confirmDeleteBtn) {
                confirmDeleteBtn.addEventListener('click', function() {
                    const recipeId = this.getAttribute('data-id');
                    console.log('Suppression de la recette ID:', recipeId);
                    // Ici, vous pouvez ajouter le code pour supprimer la recette
                    closeModal(deleteConfirmModal);
                });
            }

            // Gestion des événements pour le bouton d'annulation de suppression
            if (cancelDeleteBtn) {
                cancelDeleteBtn.addEventListener('click', function() {
                    closeModal(deleteConfirmModal);
                });
            }

            // Gestion des événements pour les boutons de visualisation de recette
            viewRecipeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const recipeId = this.getAttribute('data-id');
                    console.log('Voir la recette ID:', recipeId);
                    // Ici, vous pouvez ajouter le code pour charger les détails de la recette
                    openModal(viewRecipeModal);
                });
            });

            // Gestion des événements pour le bouton de fermeture de visualisation de recette
            if (closeViewRecipeBtn) {
                closeViewRecipeBtn.addEventListener('click', function() {
                    closeModal(viewRecipeModal);
                });
            }


            // Gestion des événements pour les boutons d'édition de recette
            // editRecipeButtons.forEach(button => {
            //     button.addEventListener('click', function() {
            //         const recipeId = this.getAttribute('data-id');
            //         const editrecipeForm = document.getElementById("editrecipeModal-"+recipeId);
            //         // console.log('Édition de la recette ID:', recipeId);
            //         // Ici, vous pouvez ajouter le code pour charger les données de la recette dans le formulaire
            //         // document.getElementById('recipeId').value = recipeId;
            //         editrecipeForm.classList.remove('hidden');
            //         // openModal(recipeModal);
            //         // showTab('info'); // Afficher le premier onglet

            //     });
            // });

            // Initialiser l'affichage du premier onglet
            showTab('info');
        });

        //recuperer l'id de recette lorsque je clique sur view-recipe

        viewRecipeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const recipeId = this.getAttribute('data-id');
                // console.log('ID de la recette sélectionnée:', recipeId);
                // Vous pouvez utiliser l'ID pour effectuer une requête AJAX ou mettre à jour l'interface utilisateur
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
