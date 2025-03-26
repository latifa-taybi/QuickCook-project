<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickCook - Gestion des catégories d'ingrédients</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body class="bg-light text-dark min-h-screen flex flex-col">
    @section('title', 'Gestion des catégories d\'ingrédients')

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
                        <h2 class="text-2xl font-display font-bold text-gray-900">Catégories d'ingrédients</h2>
                        <p class="mt-1 text-sm text-gray-500">Gérez les catégories pour organiser vos ingrédients</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <button id="addCategoryBtn"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                            <i class="fas fa-plus mr-2"></i>
                            Ajouter une catégorie
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
                            <input type="text" id="searchCategory"
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-brand-500 focus:border-brand-500 text-sm"
                                placeholder="Rechercher une catégorie...">
                        </div>

                        <!-- Sorting Filter -->
                        <div class="w-full md:w-48">
                            <select id="sortCategories"
                                class="w-full py-2 px-3 border border-gray-300 rounded-lg focus:ring-brand-500 focus:border-brand-500 text-sm">
                                <option value="name-asc">Nom (A-Z)</option>
                                <option value="name-desc">Nom (Z-A)</option>
                            </select>
                        </div>
                    </div>
                </div>

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
                                    <tr class="table-row">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500">rdtf</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">gybh</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                gvbh</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <button class="editCategorie text-brand-600 hover:text-brand-900 mr-3"
                                                >
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-600 hover:text-red-900"
                                               >
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal pour ajouter une catégorie -->
    <div id="categoryModal" class="modal fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
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
                                Ajouter une catégorie
                            </h3>
                            <div class="mt-2">
                                <form action="" method="POST" id="categoryForm"
                                    class="space-y-5 bg-white rounded-xl">
                                    @csrf
                                    <input type="hidden" id="categoryId" value="">

                                    <!-- Category Name -->
                                    <div>
                                        <label for="categoryName"
                                            class="block text-sm font-semibold text-gray-700">Nom</label>
                                        <input type="text" name="name" id="categoryName"
                                            class="mt-2 w-full py-2 px-3 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm"
                                            required>
                                    </div>
                                    <!-- Category Description -->
                                    <div>
                                        <label for="categoryDescription"
                                            class="block text-sm font-semibold text-gray-700">Description
                                            (optionnel)</label>
                                        <textarea id="categoryDescription" name="description" rows="3"
                                            class="mt-2 w-full py-2 px-3 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm"></textarea>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                        <button type="submit" id="saveCategoryBtn"
                                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-brand-600 text-base font-medium text-white hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 sm:ml-3 sm:w-auto sm:text-sm">
                                            Enregistrer
                                        </button>
                                        <button type="button" id="cancelCategoryBtn"
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

    <!-- Modal pour modifier une catégorie -->
    <div id="categoryModalEdit" class="modal fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
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
                                Modifier la catégorie
                            </h3>
                            <div class="mt-2">
                                <form id="categoryEditForm" class="space-y-5 bg-white rounded-xl">
                                    <input type="hidden" id="categoryId" value="">

                                    <!-- Category Name -->
                                    <div>
                                        <label for="categoryName"
                                            class="block text-sm font-semibold text-gray-700">Nom</label>
                                        <input type="text" name="name" id="categoryName"
                                            class="mt-2 w-full py-2 px-3 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm"
                                            required>
                                    </div>
                                    <!-- Category Description -->
                                    <div>
                                        <label for="categoryDescription"
                                            class="block text-sm font-semibold text-gray-700">Description
                                            (optionnel)</label>
                                        <textarea id="categoryDescription" name="description" rows="3"
                                            class="mt-2 w-full py-2 px-3 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-500 focus:border-brand-500 text-sm"></textarea>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" id="saveEditCategoryBtn"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-brand-600 text-base font-medium text-white hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Enregistrer
                    </button>
                    <button type="button" id="cancelEditCategoryBtn"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>


  

    <script>
        // Gestion du sidebar mobile
        const sidebar = document.getElementById('sidebar');
        const openSidebarBtn = document.getElementById('openSidebarBtn');
        const closeSidebarBtn = document.getElementById('closeSidebarBtn');

        openSidebarBtn.addEventListener('click', () => {
            sidebar.classList.add('open');
        });

        closeSidebarBtn.addEventListener('click', () => {
            sidebar.classList.remove('open');
        });

        // Gestion du menu utilisateur
        const userMenuBtn = document.getElementById('userMenuBtn');
        const userDropdown = document.getElementById('userDropdown');

        userMenuBtn.addEventListener('click', () => {
            userDropdown.classList.toggle('hidden');
        });

        // Fermer le dropdown quand on clique ailleurs
        document.addEventListener('click', (event) => {
            if (!userMenuBtn.contains(event.target) && !userDropdown.contains(event.target)) {
            userDropdown.classList.add('hidden');
            }
        });

        // Gestion des modals
        const categoryModal = document.getElementById('categoryModal');
        const categoryModalEdit = document.getElementById('categoryModalEdit');
        const deleteConfirmModal = document.getElementById('deleteConfirmModal');
        const addCategoryBtn = document.getElementById('addCategoryBtn');
        const cancelCategoryBtn = document.getElementById('cancelCategoryBtn');
        const cancelEditCategoryBtn = document.getElementById('cancelEditCategoryBtn');
        const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        const categoryForm = document.getElementById('categoryForm');
        const modalTitle = document.getElementById('modal-title');

        let currentCategoryId = null;

        // Ouvrir le modal d'ajout de catégorie
        addCategoryBtn.addEventListener('click', () => {
            categoryModal.classList.add('active');
        });

        // Fermer le modal de catégorie
        cancelCategoryBtn.addEventListener('click', () => {
            categoryModal.classList.remove('active');
        });

        // Fermer le modal d'édition de catégorie
        cancelEditCategoryBtn.addEventListener('click', () => {
            categoryModalEdit.classList.remove('active');
        });

        // Fermer le modal de confirmation de suppression
        cancelDeleteBtn.addEventListener('click', () => {
            deleteConfirmModal.classList.remove('active');
        });

        // Ouvrir le modal d'édition de catégorie
        document.addEventListener("click", function(event) {
            if (event.target.closest(".editCategorie")) {
            let button = event.target.closest(".editCategorie");
            let categoryId = button.getAttribute("data-id");

            categoryModalEdit.classList.add("active");

            // Remplir la modale avec les infos de la catégorie
            fetch(`/categories/${categoryId}`)
                .then(response => response.json())
                .then(data => {
                document.querySelector('#categoryModalEdit #categoryId').value = data.id;
                document.querySelector('#categoryModalEdit #categoryName').value = data.name;
                document.querySelector('#categoryModalEdit #categoryDescription').value = data.description;
                })
                .catch(error => console.error('Erreur:', error));
            }
        });

    </script>
</body>

</html>
