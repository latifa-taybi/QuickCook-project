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
                        <a href="{{ route('recettes.create') }}"><button id="addRecipeBtn"
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
                                @foreach ($regimes as $regime)
                                    <option value="{{ $regime->id }}">{{ $regime->name }}</option>
                                @endforeach
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
                                        <a href="{{ route('recettes.show', $recette->id) }}"><button
                                                class="text-gray-400 hover:text-brand-500 view-recipe">
                                                <i class="fas fa-eye"></i>
                                            </button></a>
                                        <a href="{{ route('recettes.edit', $recette->id) }}">
                                            <button class="text-gray-400 hover:text-brand-500 edit-recipe">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </a>
                                        <button class="text-gray-400 hover:text-red-500 delete-recipe"
                                            onclick="deleteModal({{ $recette->id }})">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Pagination -->
                <section class="py-8 bg-gray-50">
                    <div class="container mx-auto px-4">
                        <div class="flex justify-center">
                            <nav class="flex items-center space-x-2">
                                {{$recettes->links()}}
                            </nav>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>



    <!-- Modal de confirmation de suppression -->
    <div id="deleteConfirmModal" class="modal hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
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
                                    Êtes-vous sûr de vouloir supprimer cette recette ? Cette action
                                    est irréversible.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form action="" method="POST" id="deleteRecipeForm">
                        @csrf
                        @method('DELETE')
                        <button type="submit" id="confirmDeleteBtn"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Supprimer
                        </button>
                    </form>

                    <button type="button" id="cancelDeleteBtn" onclick="closeModal()"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>


    <script>
        const deleteConfirmModal = document.getElementById('deleteConfirmModal');
        function deleteModal(id) {
            deleteConfirmModal.classList.remove('hidden');
            let form = document.getElementById('deleteRecipeForm'); 
            form.action = `{{ route('recettes.destroy', ':id') }}`.replace(':id', id);
        }

        function closeModal() {
            deleteConfirmModal.classList.add('hidden');
        }

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
