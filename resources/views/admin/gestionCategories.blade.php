<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickCook - Gestion des catégories d'ingrédients</title>
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
    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }
        
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
        
        .table-row:hover {
            background-color: #f8fafc;
        }
    </style>
</head>

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
                        <h2 class="text-2xl font-display font-bold text-slate-800">Catégories d'ingrédients</h2>
                        <p class="mt-2 text-slate-600">Gérez les catégories pour organiser vos ingrédients</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <button id="addCategoryBtn"
                            class="btn-primary inline-flex items-center px-4 py-2.5 rounded-lg shadow text-sm font-medium text-white">
                            <i class="fas fa-plus mr-2"></i>
                            Ajouter une catégorie
                        </button>
                    </div>
                </div>
            </div>

            <!-- Search section -->
            <div class="mb-8">
                <div class="bg-white rounded-xl shadow-sm p-4 border border-slate-200">
                    <form id="searchForm">
                        @csrf
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="relative flex-grow">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-slate-400"></i>
                                </div>
                                <input type="text" id="search" name="search" placeholder="Rechercher une catégorie..."
                                    class="w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-lg focus:border-teal-300 focus:ring-2 focus:ring-teal-100 outline-none transition duration-200">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Categories table -->
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
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200" id="categoriesTableBody">
                            @foreach ($categories as $category)
                                <tr class="table-row transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-slate-500">{{ $category->id }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-slate-900">{{ $category->name }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-slate-500">{{ $category->description }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="editCategorie text-teal-600 hover:text-teal-800 mr-4">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="deleteCategorie text-red-600 hover:text-red-800">
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

    <!-- Modal pour ajouter une catégorie -->
    <div id="categoryModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-500 bg-opacity-75 transition-opacity"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-slate-900">
                                Ajouter une catégorie
                            </h3>
                            <div class="mt-2">
                                <form action="{{ route('categories.store') }}" method="POST" id="categoryForm" class="space-y-5">
                                    @csrf
                                    <!-- Category Name -->
                                    <div>
                                        <label for="categoryName" class="block text-sm font-medium text-slate-700">Nom</label>
                                        <input type="text" name="name" id="categoryName"
                                            class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
                                            required>
                                    </div>
                                    <!-- Category Description -->
                                    <div>
                                        <label for="categoryDescription" class="block text-sm font-medium text-slate-700">Description</label>
                                        <textarea id="categoryDescription" name="description" rows="3"
                                            class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"></textarea>
                                    </div>
                                    <div class="bg-slate-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                        <button type="submit" class="btn-primary w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 text-sm font-medium text-white sm:ml-3 sm:w-auto">
                                            Enregistrer
                                        </button>
                                        <button type="button" id="cancelCategoryBtn"
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

    <!-- Modal pour modifier une catégorie -->
    <div id="categoryModalEdit" class="hidden fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-500 bg-opacity-75 transition-opacity"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-slate-900">
                                Modifier la catégorie
                            </h3>
                            <div class="mt-2">
                                <form id="categoryEditForm" action="{{ route('categories.update') }}" method="POST" class="space-y-5">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name='id' id="categoryId" value="">

                                    <!-- Category Name -->
                                    <div>
                                        <label for="categoryName" class="block text-sm font-medium text-slate-700">Nom</label>
                                        <input type="text" name="name" id="categoryName"
                                            class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
                                            required>
                                    </div>
                                    <!-- Category Description -->
                                    <div>
                                        <label for="categoryDescription" class="block text-sm font-medium text-slate-700">Description</label>
                                        <textarea id="categoryDescription" name="description" rows="3"
                                            class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"></textarea>
                                    </div>
                                    <div class="bg-slate-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                        <button type="submit" id="saveEditCategoryBtn"
                                            class="btn-primary w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 text-sm font-medium text-white sm:ml-3 sm:w-auto">
                                            Enregistrer
                                        </button>
                                        <button type="button" id="cancelEditCategoryBtn"
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
                <form action="{{ route('categories.destroy') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="deleteCategoryId" value="">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <i class="fas fa-exclamation-triangle text-red-600"></i>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-slate-900">
                                    Supprimer la catégorie
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-slate-500">
                                        Êtes-vous sûr de vouloir supprimer cette catégorie ? Cette action est irréversible.
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
        const addCategoryBtn = document.getElementById("addCategoryBtn");
        const categoryModal = document.getElementById("categoryModal");
        const cancelCategoryBtn = document.getElementById("cancelCategoryBtn");
        const categoryForm = document.getElementById("categoryForm");
        const deleteConfirmModal = document.getElementById("deleteConfirmModal");

        const editCategoryBtns = document.querySelectorAll(".editCategorie");
        const categoryModalEdit = document.getElementById("categoryModalEdit");
        const cancelEditCategoryBtn = document.getElementById("cancelEditCategoryBtn");
        const categoryEditForm = document.getElementById("categoryEditForm");
        const categoryDelete = document.querySelectorAll(".deleteCategorie");
        const cancelDeleteBtn = document.getElementById("cancelDeleteBtn");

        // afficher le modal d'ajout
        addCategoryBtn.addEventListener("click", function() {
            categoryModal.classList.remove("hidden");
        });

        // fermer le modal d'ajout
        cancelCategoryBtn.addEventListener("click", function() {
            categoryModal.classList.add("hidden");
            categoryForm.reset();
        });

        // afficher le modal de suppression
        categoryDelete.forEach(button => {
            button.addEventListener("click", () => {
                const row = button.closest("tr");
                const idInput = deleteConfirmModal.querySelector("#deleteCategoryId");
                const id = row.querySelector('td:first-child').textContent.trim();
                idInput.value = id;
                deleteConfirmModal.classList.remove("hidden");
            });
        });
        
        // fermer le modal de suppression
        cancelDeleteBtn.addEventListener("click", function() {
            deleteConfirmModal.classList.add("hidden");
        });

        // remplir le formulaire de modification avec les donnees de cette categorie
        function populateEditForm(row) {
            const idInput = categoryEditForm.querySelector("#categoryId");
            const nameInput = categoryEditForm.querySelector("#categoryName");
            const descriptionInput = categoryEditForm.querySelector("#categoryDescription");

            const id = row.querySelector('td:first-child').textContent.trim();
            const name = row.querySelector('td:nth-child(2)').textContent.trim();
            const description = row.querySelector('td:nth-child(3)').textContent.trim();

            idInput.value = id;
            nameInput.value = name;
            descriptionInput.value = description;
        }

        // afficher le modal de modification
        editCategoryBtns.forEach(button => {
            button.addEventListener("click", () => {
                const row = button.closest("tr");
                categoryModalEdit.classList.remove("hidden");
                populateEditForm(row);
            });
        });
        
        // fermer le modal de modification
        cancelEditCategoryBtn.addEventListener("click", function() {
            categoryModalEdit.classList.add("hidden");
            categoryEditForm.reset();
        });

        // traitement de recherche des categories
        document.getElementById('search').addEventListener('input', async function() {
            const searchValue = this.value;
            try {
                const response = await fetch(`/categories/recherche?search=${encodeURIComponent(searchValue)}`, {
                });
                const data = await response.json();
                const tbody = document.getElementById('categoriesTableBody');
                tbody.innerHTML = '';

                if (data.length > 0) {
                    for (let categorie of data) {
                        const row = document.createElement('tr');
                        row.classList.add('table-row', 'transition-colors', 'duration-150');

                        row.innerHTML = `
                            <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm text-slate-500">${categorie.id}</div></td>
                            <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm font-medium text-slate-900">${categorie.name}</div></td>
                            <td class="px-6 py-4"><div class="text-sm text-slate-500">${categorie.description}</div></td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="editCategorie text-teal-600 hover:text-teal-800 mr-4">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="deleteCategorie text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        `;
                        tbody.appendChild(row);
                    }
                } else {
                    const noResultsRow = document.createElement('tr');
                    noResultsRow.innerHTML = '<td colspan="4" class="text-center text-slate-500 py-4">Aucune catégorie trouvée</td>';
                    tbody.appendChild(noResultsRow);
                }

            } catch (error) {
                console.error('Erreur de recherche:', error);
            }
        });

    </script>
</body>
</html>