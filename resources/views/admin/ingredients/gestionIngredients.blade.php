<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickCook - Gestion des ingrédients</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body class="bg-light text-dark min-h-screen flex flex-col">
    @section('title', 'Gestion des ingrédients')

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
                        <h2 class="text-2xl font-display font-bold text-gray-900">Liste des ingrédients</h2>
                        <p class="mt-1 text-sm text-gray-500">Gérez tous les ingrédients disponibles pour vos recettes
                        </p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <button id="addIngredientBtn"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                            <i class="fas fa-plus mr-2"></i>
                            Ajouter un ingrédient
                        </button>
                    </div>
                </div>

                <!-- Search and Filters -->
                <div class="mb-6 bg-white rounded-xl shadow-md p-5">
                    <div class="flex flex-col md:flex-row gap-4 items-center">
                        <!-- Search Bar -->
                        <div class="flex-1 w-full relative">
                            <i
                                class="fas fa-search text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2"></i>
                            <input type="text" id="searchIngredient"
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-brand-500 focus:border-brand-500 text-sm"
                                placeholder="Rechercher un ingrédient...">
                        </div>

                        <!-- Category Filter -->
                        <div class="w-full md:w-48">
                            <select id="categoryFilter"
                                class="w-full py-2 px-3 border border-gray-300 rounded-lg focus:ring-brand-500 focus:border-brand-500 text-sm">
                                <option value="">Toutes les catégories</option>
                                <option value="fruits">Fruits</option>
                            </select>
                        </div>

                        <!-- Sorting Filter -->
                        <div class="w-full md:w-48">
                            <select id="sortIngredients"
                                class="w-full py-2 px-3 border border-gray-300 rounded-lg focus:ring-brand-500 focus:border-brand-500 text-sm">
                                <option value="name-asc">Nom (A-Z)</option>
                                <option value="name-desc">Nom (Z-A)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Ingredients table -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nom
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Photo
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Catégorie
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Description
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="ingredientsTableBody">
                                <!-- Exemple d'ingrédient -->
                                @foreach($ingredients as $ingredient)
                                <tr class="table-row">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{$ingredient->id}}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{$ingredient->name}}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <img src="{{ asset('storage/' . $ingredient->photo)}}" alt="{{ $ingredient->name }}" class="h-10 w-10 rounded-full object-cover">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800" >
                                            {{$ingredient->category->name}}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{$ingredient->description}}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-brand-600 hover:text-brand-900 mr-3 edit-ingredient">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-900 delete-ingredient">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal pour ajouter un ingrédient -->
    <div id="ingredientModal" class="modal hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Ajouter un ingrédient
                            </h3>
                            <div class="mt-2">
                                <form action="{{ route('ingredients.store' )}}" method="POST" id="ingredientForm" class="space-y-5 bg-white rounded-xl" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Ingredient Name -->
                                    <div>
                                        <label for="ingredientName"
                                            class="block text-sm font-semibold text-gray-700">Nom</label>
                                        <input type="text" name="name" id="ingredientName"
                                            class="mt-2 w-full py-2 px-3 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm"
                                            required>
                                    </div>

                                    <!-- Ingredient Image Upload -->
                                    <div>
                                        <label for="ingredientImage"
                                            class="block text-sm font-semibold text-gray-700">Image (optionnel)</label>
                                        <input type="file" id="photo" name="photo"
                                            class="mt-2 w-full py-2 px-3 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm bg-white">
                                    </div>

                                    <!-- Ingredient Category -->
                                    <div>
                                        <label for="ingredientCategory"
                                            class="block text-sm font-semibold text-gray-700">Catégorie</label>
                                        <select id="ingredientCategory" name="category_id"
                                            class="mt-2 w-full py-2 px-3 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm bg-white"
                                            required>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Ingredient Description -->
                                    <div>
                                        <label for="ingredientDescription"
                                            class="block text-sm font-semibold text-gray-700">Description
                                            (optionnel)</label>
                                        <textarea id="ingredientDescription" name="description" rows="3"
                                            class="mt-2 w-full py-2 px-3 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm"></textarea>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                        <button type="submit" id="saveIngredientBtn"
                                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-brand-600 text-base font-medium text-white hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 sm:ml-3 sm:w-auto sm:text-sm">
                                            Enregistrer
                                        </button>
                                        <button type="button" id="cancelIngredientBtn"
                                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                            Annuler
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Modal pour modifier un ingrédient -->
    <div id="editIngredientModal" class="modal hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="edit-modal-title"
    role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="edit-modal-title">
                            Modifier un ingrédient
                        </h3>
                        <div class="mt-2">
                            <form action="{{route('ingredients.update')}}" method="POST" id="editIngredientForm" class="space-y-5 bg-white rounded-xl">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" id="editIngredientId" value="">

                                <!-- Ingredient Name -->
                                <div>
                                    <label for="editIngredientName"
                                        class="block text-sm font-semibold text-gray-700">Nom</label>
                                    <input type="text" name="name" id="editIngredientName"
                                        class="mt-2 w-full py-2 px-3 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm"
                                        required>
                                </div>

                                <!-- Ingredient Image Upload -->
                                <div>
                                    <label for="editIngredientImage"
                                        class="block text-sm font-semibold text-gray-700">Image (optionnel)</label>
                                        <input type="file" id="photo" name="photo"
                                        class="mt-2 w-full py-2 px-3 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm bg-white">
                                    </div>

                                <!-- Ingredient Category -->
                                <div>
                                    <label for="editIngredientCategory"
                                        class="block text-sm font-semibold text-gray-700">Catégorie</label>
                                    <select id="editIngredientCategory" name="category_id"
                                        class="mt-2 w-full py-2 px-3 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm bg-white"
                                        required>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Ingredient Description -->
                                <div>
                                    <label for="editIngredientDescription"
                                        class="block text-sm font-semibold text-gray-700">Description
                                        (optionnel)</label>
                                    <textarea id="editIngredientDescription" name="description" rows="3"
                                        class="mt-2 w-full py-2 px-3 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm"></textarea>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button type="submit" id="saveEditIngredientBtn"
                                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-brand-600 text-base font-medium text-white hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 sm:ml-3 sm:w-auto sm:text-sm">
                                        Enregistrer
                                    </button>
                                    <button type="button" id="cancelEditIngredientBtn"
                                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                        Annuler
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

    <!-- Modal de confirmation de suppression -->
    <div id="deleteConfirmModal" class="modal hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <form action="{{route('ingredients.destroy')}}" method="POST">
            @csrf
            <input type="hidden" name="id" id="deleteIngredientId" value="">

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
                                Supprimer l'ingrédient
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Êtes-vous sûr de vouloir supprimer cet ingrédient ? Cette action est irréversible.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" id="confirmDeleteBtn"
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

    <script>

        // Gestion des modals
        const ingredientModal = document.getElementById('ingredientModal');
        const deleteConfirmModal = document.getElementById('deleteConfirmModal');
        const addIngredientBtn = document.getElementById('addIngredientBtn');
        const cancelIngredientBtn = document.getElementById('cancelIngredientBtn');
        const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        const ingredientForm = document.getElementById('ingredientForm');
        const editIngredient = document.querySelectorAll('.edit-ingredient');
        const editIngredientModal = document.getElementById('editIngredientModal');
        const cancelEditIngredientBtn = document.getElementById('cancelEditIngredientBtn');
        const deleteIngredient = document.querySelectorAll('.delete-ingredient');
        const editIngredientForm = document.getElementById('editIngredientForm');

        // Ouvrir le modal d'ajout d'ingrédient
        addIngredientBtn.addEventListener('click', () => {
            ingredientModal.classList.remove("hidden");
        });

        // Fermer le modal d'ingrédient
        cancelIngredientBtn.addEventListener('click', () => {
            ingredientModal.classList.add('hidden');
        });


        // Gérer les boutons de suppression
        deleteIngredient.forEach(button => {
            button.addEventListener('click', () => {
                const row = button.closest("tr");
                const idInput = deleteConfirmModal.querySelector("#deleteIngredientId");
                const id = row.querySelector('td:first-child').textContent.trim();
                idInput.value = id;
                deleteConfirmModal.classList.remove('hidden');
            });
        });

        function populateEditForm(row) {
            const idInput = editIngredientForm.querySelector("#editIngredientId");
            const nameInput = editIngredientForm.querySelector("#editIngredientName");
            const categorySelect = editIngredientForm.querySelector("#editIngredientCategory");
            const descriptionInput = editIngredientForm.querySelector("#editIngredientDescription");

            const id = row.querySelector('td:first-child').textContent.trim();
            const name = row.querySelector('td:nth-child(2)').textContent.trim();
            const category = row.querySelector('td:nth-child(4)').textContent.trim();
            const description = row.querySelector('td:nth-child(5)').textContent.trim();

            idInput.value = id;
            nameInput.value = name;
            for (let option of categorySelect.options) {
                if(option.textContent.trim() === category){
                    categorySelect.value = option.value;
                    break;
                }
            }
            descriptionInput.value = description;
        }

        // Gérer les boutons de modification
        editIngredient.forEach(button => {
            button.addEventListener('click', () => {
                let row = button.closest("tr");
                editIngredientModal.classList.remove("hidden");
                populateEditForm(row);
            });
        });

        // Fermer le modal de modification
        cancelEditIngredientBtn.addEventListener('click', () => {
            editIngredientModal.classList.add('hidden');
        });

        // Fermer le modal de confirmation de suppression
        cancelDeleteBtn.addEventListener('click', () => {
            deleteConfirmModal.classList.add('hidden');
        });
    </script>
</body>

</html>
