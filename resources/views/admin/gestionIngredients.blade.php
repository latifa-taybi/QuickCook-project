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
            <!-- Page header with actions -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h2 class="text-2xl font-display font-bold text-slate-800">Liste des ingrédients</h2>
                        <p class="mt-2 text-slate-600">Gérez tous les ingrédients disponibles pour vos recettes</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <button id="addIngredientBtn"
                            class="btn-primary inline-flex items-center px-4 py-2.5 rounded-lg shadow text-sm font-medium text-white">
                            <i class="fas fa-plus mr-2"></i>
                            Ajouter un ingrédient
                        </button>
                    </div>
                </div>
            </div>
{{-- 
            <!-- Search section -->
            <div class="mb-8">
                <div class="bg-white rounded-xl shadow-sm p-4 border border-slate-200">
                    <form id="searchFormIngredients">
                        @csrf
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="relative flex-grow">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-slate-400"></i>
                                </div>
                                <input type="text" id="search" name="search" placeholder="Rechercher un ingrédient..." 
                                    class="w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-lg focus:border-teal-300 focus:ring-2 focus:ring-teal-100 outline-none transition duration-200">
                            </div>
                        </div>
                    </form>
                </div>
            </div> --}}

            <!-- Ingredients table -->
            <div class="bg-white shadow rounded-lg overflow-hidden border border-slate-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Nom
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Photo
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Catégorie
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200" id="ingredientsTableBody">
                            @foreach ($ingredients as $ingredient)
                                <tr class="table-row transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-slate-500">{{ $ingredient->id }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-slate-900">{{ $ingredient->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <img src="{{ asset('storage/' . $ingredient->photo) }}" 
                                             alt="{{ $ingredient->name }}"
                                             class="h-10 w-10 rounded-full object-cover border border-slate-200">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full badge-category">
                                            {{ $ingredient->category->name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-slate-500">{{ $ingredient->description }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="edit-ingredient text-teal-600 hover:text-teal-800 mr-4">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="delete-ingredient text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-10 flex flex-col sm:flex-row items-center justify-center">
                <nav class="flex items-center space-x-1">
                    @if ($ingredients->onFirstPage())
                        <span class="px-3 py-1 rounded-lg bg-slate-100 text-slate-400 cursor-not-allowed">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                    @else
                        <a href="{{ $ingredients->previousPageUrl() }}" class="px-3 py-1 rounded-lg bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 transition-colors duration-200">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    @endif
                    
                    @foreach ($ingredients->getUrlRange(1, $ingredients->lastPage()) as $page => $url)
                        @if ($page == $ingredients->currentPage())
                            <span class="px-3 py-1 rounded-lg bg-gradient-to-r from-teal-500 to-amber-400 text-white">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-3 py-1 rounded-lg bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 transition-colors duration-200">{{ $page }}</a>
                        @endif
                    @endforeach
                    
                    @if ($ingredients->hasMorePages())
                        <a href="{{ $ingredients->nextPageUrl() }}" class="px-3 py-1 rounded-lg bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 transition-colors duration-200">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <span class="px-3 py-1 rounded-lg bg-slate-100 text-slate-400 cursor-not-allowed">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    @endif
                </nav>
            </div>

        </main>

    </div>

    <!-- Modal pour ajouter un ingrédient -->
    <div id="ingredientModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-500 bg-opacity-75 transition-opacity"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-slate-900">
                                Ajouter un ingrédient
                            </h3>
                            <div class="mt-2">
                                <form action="{{ route('ingredients.store') }}" method="POST" id="ingredientForm" class="space-y-5" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Ingredient Name -->
                                    <div>
                                        <label for="ingredientName" class="block text-sm font-medium text-slate-700">Nom</label>
                                        <input type="text" name="name" id="ingredientName"
                                            class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
                                            required>
                                    </div>

                                    <!-- Ingredient Image Upload -->
                                    <div>
                                        <label for="ingredientImage" class="block text-sm font-medium text-slate-700">Image</label>
                                        <input type="file" id="photo" name="photo"
                                            class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm bg-white">
                                    </div>

                                    <!-- Ingredient Category -->
                                    <div>
                                        <label for="ingredientCategory" class="block text-sm font-medium text-slate-700">Catégorie</label>
                                        <select id="ingredientCategory" name="category_id"
                                            class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm bg-white"
                                            required>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Ingredient Description -->
                                    <div>
                                        <label for="ingredientDescription" class="block text-sm font-medium text-slate-700">Description</label>
                                        <textarea id="ingredientDescription" name="description" rows="3"
                                            class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"></textarea>
                                    </div>
                                    <div class="bg-slate-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                        <button type="submit" id="saveIngredientBtn"
                                            class="btn-primary w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 text-sm font-medium text-white sm:ml-3 sm:w-auto">
                                            Enregistrer
                                        </button>
                                        <button type="button" id="cancelIngredientBtn"
                                            class="mt-3 w-full inline-flex justify-center rounded-md border border-slate-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-slate-700 hover:bg-slate-50 sm:mt-0 sm:ml-3 sm:w-auto">
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
    <div id="editIngredientModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-500 bg-opacity-75 transition-opacity"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-slate-900">
                                Modifier un ingrédient
                            </h3>
                            <div class="mt-2">
                                <form action="{{ route('ingredients.update') }}" method="POST" id="editIngredientForm" class="space-y-5" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" id="editIngredientId" value="">

                                    <!-- Ingredient Name -->
                                    <div>
                                        <label for="editIngredientName" class="block text-sm font-medium text-slate-700">Nom</label>
                                        <input type="text" name="name" id="editIngredientName"
                                            class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
                                            required>
                                    </div>

                                    <!-- Ingredient Image Upload -->
                                    <div>
                                        <label for="editIngredientImage" class="block text-sm font-medium text-slate-700">Image</label>
                                        <input type="file" id="photo" name="photo"
                                            class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm bg-white">
                                    </div>

                                    <!-- Ingredient Category -->
                                    <div>
                                        <label for="editIngredientCategory" class="block text-sm font-medium text-slate-700">Catégorie</label>
                                        <select id="editIngredientCategory" name="category_id"
                                            class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm bg-white"
                                            required>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Ingredient Description -->
                                    <div>
                                        <label for="editIngredientDescription" class="block text-sm font-medium text-slate-700">Description</label>
                                        <textarea id="editIngredientDescription" name="description" rows="3"
                                            class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"></textarea>
                                    </div>
                                    <div class="bg-slate-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                        <button type="submit" id="saveEditIngredientBtn"
                                            class="btn-primary w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 text-sm font-medium text-white sm:ml-3 sm:w-auto">
                                            Enregistrer
                                        </button>
                                        <button type="button" id="cancelEditIngredientBtn"
                                            class="mt-3 w-full inline-flex justify-center rounded-md border border-slate-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-slate-700 hover:bg-slate-50 sm:mt-0 sm:ml-3 sm:w-auto">
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
    <div id="deleteConfirmModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-500 bg-opacity-75 transition-opacity"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form action="{{ route('ingredients.destroy') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="deleteIngredientId" value="">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <i class="fas fa-exclamation-triangle text-red-600"></i>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-slate-900">
                                    Supprimer l'ingrédient
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-slate-500">
                                        Êtes-vous sûr de vouloir supprimer cet ingrédient ? Cette action est irréversible.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" id="confirmDeleteBtn"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-sm font-medium text-white hover:bg-red-700 sm:ml-3 sm:w-auto">
                            Supprimer
                        </button>
                        <button type="button" id="cancelDeleteBtn"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-slate-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-slate-700 hover:bg-slate-50 sm:mt-0 sm:ml-3 sm:w-auto">
                            Annuler
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <script>
        // Recuperation des elements des modals
        const ingredientModal = document.getElementById('ingredientModal');
        const deleteConfirmModal = document.getElementById('deleteConfirmModal');
        const addIngredientBtn = document.getElementById('addIngredientBtn');
        const cancelIngredientBtn = document.getElementById('cancelIngredientBtn');
        const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
        const ingredientForm = document.getElementById('ingredientForm');
        const editIngredient = document.querySelectorAll('.edit-ingredient');
        const editIngredientModal = document.getElementById('editIngredientModal');
        const cancelEditIngredientBtn = document.getElementById('cancelEditIngredientBtn');
        const deleteIngredient = document.querySelectorAll('.delete-ingredient');
        const editIngredientForm = document.getElementById('editIngredientForm');

        // afficher le modal d'ajout
        addIngredientBtn.addEventListener('click', () => {
            ingredientModal.classList.remove("hidden");
        });

        // fermer le modal d'ajout
        cancelIngredientBtn.addEventListener('click', () => {
            ingredientModal.classList.add('hidden');
        });

        // afficher le modal de suppression
        deleteIngredient.forEach(button => {
            button.addEventListener('click', () => {
                const row = button.closest("tr");
                const idInput = deleteConfirmModal.querySelector("#deleteIngredientId");
                const id = row.querySelector('td:first-child').textContent.trim();
                idInput.value = id;
                deleteConfirmModal.classList.remove('hidden');
            });
        });
        
        // fermer le modal de suppression
        cancelDeleteBtn.addEventListener('click', () => {
            deleteConfirmModal.classList.add('hidden');
        });

        // remplir le formulaire de modification avec les donnees de cette ingredient
        function populateEditForm(row) {
            const idInput = editIngredientForm.querySelector("#editIngredientId");
            const nameInput = editIngredientForm.querySelector("#editIngredientName");
            const categorySelect = editIngredientForm.querySelector("#editIngredientCategory");
            const descriptionInput = editIngredientForm.querySelector("#editIngredientDescription");

            const id = row.querySelector('td:first-child').textContent.trim();
            const name = row.querySelector('td:nth-child(2)').textContent.trim();
            const category = row.querySelector('td:nth-child(4) span').textContent.trim();
            const description = row.querySelector('td:nth-child(5) div').textContent.trim();

            idInput.value = id;
            nameInput.value = name;
            for (let option of categorySelect.options) {
                if (option.textContent.trim() === category) {
                    categorySelect.value = option.value;
                    break;
                }
            }
            descriptionInput.value = description;
        }

        // afficher le modal de modification
        editIngredient.forEach(button => {
            button.addEventListener('click', () => {
                let row = button.closest("tr");
                editIngredientModal.classList.remove("hidden");
                populateEditForm(row);
            });
        });

        // fermer le modal de modification
        cancelEditIngredientBtn.addEventListener('click', () => {
            editIngredientModal.classList.add('hidden');
        });




        
    </script>
</body>
</html>