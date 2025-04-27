<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickCook | Gestion des recettes</title>
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
                            250: '#80e5d8'
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
        .sidebar {
            background: linear-gradient(180deg, #0f172a 0%, #020617 100%);
        }
        
        .nav-item.active {
            background: linear-gradient(90deg, rgba(6, 148, 162, 0.2) 0%, rgba(6, 148, 162, 0.05) 100%);
            border-left: 4px solid #2dd4bf;
        }
        
        .recipe-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
        }
        
        .recipe-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .btn-primary {
            background: linear-gradient(90deg, #0d9488 0%, #2dd4bf 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(90deg, #0f766e 0%, #14b8a6 100%);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }
        
        .text-gradient {
            background: linear-gradient(90deg, #2dd4bf 0%, #f59e0b 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .scrollbar-thin {
            scrollbar-width: thin;
            scrollbar-color: #0d9488 transparent;
        }
        
        .scrollbar-thin::-webkit-scrollbar {
            width: 6px;
        }
        
        .scrollbar-thin::-webkit-scrollbar-thumb {
            background-color: #0d9488;
            border-radius: 3px;
        }
    </style>
</head>

<body class="bg-slate-50 font-sans text-slate-800 min-h-screen flex">
    <!-- Sidebar (version originale conservée) -->
    @include('layouts.sidebar')

    <!-- Main content -->
    <div class="flex-1 flex flex-col ml-0 ">
        <!-- Top navbar -->
       @include('layouts.nav')
        
        <!-- Main content area -->
        <main class="flex-1 overflow-y-auto bg-slate-50 p-6">
            <!-- Page header with actions -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h2 class="text-2xl font-display font-bold text-slate-800">Bibliothèque de recettes</h2>
                        <p class="mt-2 text-slate-600">Gérez et organisez toutes vos recettes</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <a href="{{ route('recettes.create') }}" class="group relative inline-block">
                            <button class="btn-primary inline-flex items-center px-4 py-2.5 rounded-lg shadow text-sm font-medium text-white">
                                <i class="fas fa-plus mr-2"></i>
                                Ajouter une recette
                                <span class="absolute inset-0 rounded-lg opacity-0 group-hover:opacity-100 bg-gradient-to-r from-teal-600 to-amber-500 -z-10 blur transition duration-200"></span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Search section -->
            <div class="mb-8">
                <div class="bg-white rounded-xl shadow-sm p-4 border border-slate-200">
                    <form action="{{route('rechercheRecette')}}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                            <div class="md:col-span-4">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-search text-slate-400"></i>
                                    </div>
                                    <input type="text" name="search" placeholder="Rechercher une recette..." 
                                        class="w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-lg focus:border-teal-300 focus:ring-2 focus:ring-teal-100 outline-none transition duration-200">
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2.5 rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-amber-500 to-amber-400 hover:from-amber-600 hover:to-amber-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-all duration-200">
                                    <i class="fas fa-search mr-2"></i>
                                    Rechercher
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Recipes grid -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($recettes as $recette)
                    <!-- Recipe card -->
                    <div class="recipe-card rounded-xl overflow-hidden">
                        <div class="relative overflow-hidden">
                            <img class="h-48 w-full object-cover transition-transform duration-500" src="{{ asset('storage/' . $recette->image) }}" alt="{{ $recette->name }}">
                            <div class="absolute top-3 right-3 flex flex-wrap gap-1">
                                @foreach ($recette->regimes as $regime)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-white text-teal-600 shadow-sm border border-slate-200">
                                        {{ $regime->name }}
                                    </span>
                                @endforeach
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                                <h3 class="text-lg font-display font-semibold text-white">{{ $recette->name }}</h3>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center text-sm text-slate-500 mb-3">
                                <i class="fas fa-clock mr-1.5 text-teal-500"></i> 
                                <span>{{ $recette->prepTime }}min</span>
                                <span class="mx-2 text-slate-300">•</span>
                                <i class="fas fa-utensils mr-1.5 text-amber-500"></i> 
                                <span>{{ $recette->difficulty }}</span>
                            </div>
                            <p class="text-sm text-slate-600 mb-4 line-clamp-2">{{ $recette->description }}</p>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <div class="h-6 w-6 rounded-full bg-teal-100 flex items-center justify-center text-teal-600 text-xs mr-2">
                                        LT
                                    </div>
                                    <span class="text-xs text-slate-500">{{ $recette->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="flex space-x-2  group-hover:opacity-100 transition-opacity duration-200">
                                    <a href="{{ route('recettes.show', $recette->id) }}" class="p-1.5 text-teal-500 rounded-full hover:bg-teal-50" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('recettes.edit', $recette->id) }}" class="p-1.5 text-amber-500 rounded-full hover:bg-amber-50" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="deleteModal({{ $recette->id }})" class="p-1.5  text-red-500 rounded-full hover:bg-red-50" title="Supprimer">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="mt-10 flex flex-col sm:flex-row items-center justify-center">
                <nav class="flex items-center space-x-1">
                    @if ($recettes->onFirstPage())
                        <span class="px-3 py-1 rounded-lg bg-slate-100 text-slate-400 cursor-not-allowed">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                    @else
                        <a href="{{ $recettes->previousPageUrl() }}" class="px-3 py-1 rounded-lg bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 transition-colors duration-200">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    @endif
                    
                    @foreach ($recettes->getUrlRange(1, $recettes->lastPage()) as $page => $url)
                        @if ($page == $recettes->currentPage())
                            <span class="px-3 py-1 rounded-lg bg-gradient-to-r from-teal-500 to-amber-400 text-white">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-3 py-1 rounded-lg bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 transition-colors duration-200">{{ $page }}</a>
                        @endif
                    @endforeach
                    
                    @if ($recettes->hasMorePages())
                        <a href="{{ $recettes->nextPageUrl() }}" class="px-3 py-1 rounded-lg bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 transition-colors duration-200">
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

    <!-- Delete Confirmation Modal -->
    <div id="deleteConfirmModal" class="fixed z-50 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fas fa-exclamation-triangle text-red-600"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-slate-900" id="modal-title">
                                Confirmer la suppression
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-slate-500">
                                    Êtes-vous sûr de vouloir supprimer définitivement cette recette ? Cette action ne peut pas être annulée.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form action="" method="POST" id="deleteRecipeForm">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-200">
                            Supprimer définitivement
                        </button>
                    </form>
                    <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-slate-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-200">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle mobile sidebar
        document.getElementById('openSidebarBtn').addEventListener('click', function() {
            document.getElementById('sidebar').classList.remove('-translate-x-full');
        });
        
        document.getElementById('closeSidebarBtn').addEventListener('click', function() {
            document.getElementById('sidebar').classList.add('-translate-x-full');
        });
        
        // Toggle user dropdown
        document.getElementById('userMenuBtn').addEventListener('click', function(e) {
            e.stopPropagation();
            document.getElementById('userDropdown').classList.toggle('hidden');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function() {
            document.getElementById('userDropdown').classList.add('hidden');
        });
        
        // Delete modal functions
        const deleteConfirmModal = document.getElementById('deleteConfirmModal');
        
        function deleteModal(id) {
            deleteConfirmModal.classList.remove('hidden');
            let form = document.getElementById('deleteRecipeForm'); 
            form.action = `{{ route('recettes.destroy', ':id') }}`.replace(':id', id);
        }
        
        function closeModal() {
            deleteConfirmModal.classList.add('hidden');
        }
        
        // Prevent form from closing modal
        document.getElementById('deleteRecipeForm').addEventListener('click', function(e) {
            e.stopPropagation();
        });
    </script>
</body>
</html>