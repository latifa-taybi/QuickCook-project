@include('layouts.client.header')

<!-- Page Title Section -->
<section class="relative py-12 bg-gradient-to-br from-brand-50 to-white">
    <!-- Grain overlay for texture -->
    <div class="grain-overlay"></div>
    
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 fade-in">
            <div>
                <h1 class="font-bold text-3xl md:text-4xl text-slate-900">
                    Mes <span class="text-gradient">recettes</span>
                </h1>
                <p class="text-slate-600 mt-2">
                    Gérez vos créations culinaires personnelles
                </p>
            </div>
            <a href="{{route('recettes.create')}}" class="mt-4 md:mt-0">
                <button id="create-recipe-btn" class="flex items-center gap-2 bg-gradient-to-r from-brand-500 to-brand-600 text-white py-3 px-6 rounded-lg shadow-md hover:shadow-lg transition btn-hover">
                    <i class="fas fa-plus"></i>
                    <span>Créer une recette</span>
                </button>
            </a>
        </div>
    </div>
</section>

<!-- Filters Section -->
<section class="py-6 bg-white">
    <div class="container mx-auto px-4">
        <div class="bg-glass rounded-2xl shadow-strong p-6 border border-slate-100">
            <form action="{{route('rechercheRecette')}}" method="POST">
                @csrf
                <div class="flex flex-col md:flex-row md:items-center gap-4 w-full">
                    <div class="relative w-full">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                        <input type="text" name="search" placeholder="Rechercher une recette..." 
                               class="w-full pl-10 pr-4 py-2 border border-slate-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-100 outline-none transition">
                    </div>
                    <button type="submit" class="btn-hover bg-gradient-to-r from-brand-500 to-brand-600 text-white px-6 py-3 rounded-lg shadow-sm hover:shadow transition">
                        Rechercher
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Recipes Grid Section -->
<section class="py-12 bg-slate-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($recettes as $recette)
            <div class="group relative fade-in">
                <div class="absolute -inset-1 rounded-xl bg-gradient-to-r from-brand-500/10 to-accent-500/10 opacity-0 group-hover:opacity-100 blur transition-all duration-300"></div>
                <div class="card-hover relative h-full bg-white rounded-xl overflow-hidden shadow-md border border-slate-100 hover:border-brand-100 transition-all duration-300">
                    <div class="relative h-56 overflow-hidden">
                        <img src="{{ asset('storage/' . $recette->image) }}" 
                             alt="{{$recette->name}}" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/50 via-transparent to-transparent"></div>
                        <div class="absolute top-4 right-4 flex space-x-2">
                            <a href="{{ route('recettes.edit', $recette->id) }}">
                                <button type="button" class="bg-white/90 p-2 rounded-full shadow-md hover:bg-brand-100 hover:text-brand-600 transition">
                                    <i class="fas fa-edit text-brand-500"></i>
                                </button>
                            </a>
                            <button onclick="deleteModal({{ $recette->id }})" class="delete-recipe bg-white/90 p-2 rounded-full shadow-md hover:bg-red-100 hover:text-red-600 transition">
                                <i class="fas fa-trash-alt text-red-500"></i>
                            </button>
                        </div>
                        <div class="absolute bottom-4 left-4">
                            @if($recette->status == 'en_attente')
                                <span class="inline-block bg-amber-500 text-white text-xs font-semibold px-3 py-1 rounded-full">En attente</span>
                            @elseif($recette->status == 'publiée')
                                <span class="inline-block bg-green-500 text-white text-xs font-semibold px-3 py-1 rounded-full">Publiée</span>
                            @endif
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-semibold text-xl text-slate-900 mb-2">{{$recette->name}}</h3>
                        <div class="flex items-center text-sm text-slate-500 mb-3">
                            <i class="fas fa-clock mr-1.5"></i>
                            <span class="mr-4">{{$recette->prepTime}} min</span>
                            <i class="fas fa-utensils mr-1.5"></i>
                            <span>{{$recette->difficulty}}</span>
                        </div>
                        <p class="text-slate-600 text-sm mb-4 line-clamp-2">{{$recette->description}}</p>
                        <a href="{{route('recette.show', $recette)}}" 
                           class="inline-flex items-center text-brand-500 hover:text-brand-700 font-medium text-sm transition-colors">
                            Voir la recette
                            <i class="fas fa-arrow-right ml-1.5 text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- New Recipe Card -->
            <a href="{{route('recettes.create')}}" class="h-full fade-in">
                <div class="card-hover relative h-full bg-white rounded-xl overflow-hidden shadow-md border-2 border-dashed border-slate-200 hover:border-brand-300 flex flex-col items-center justify-center p-8 transition-all duration-300">
                    <div class="rounded-full bg-brand-100 p-4 mb-4">
                        <i class="fas fa-plus text-brand-500 text-2xl"></i>
                    </div>
                    <h3 class="font-semibold text-xl mb-2 text-center text-slate-900">Nouvelle recette</h3>
                    <p class="text-slate-500 text-sm text-center">Partagez votre créativité culinaire</p>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- Pagination -->
<section class="py-8 bg-slate-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-center">
            <nav class="inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                @if ($recettes->onFirstPage())
                    <span class="inline-flex items-center px-4 py-2 rounded-l-md border border-slate-200 bg-white text-slate-400 cursor-not-allowed">
                        &laquo;
                    </span>
                @else
                    <a href="{{ $recettes->previousPageUrl() }}" class="inline-flex items-center px-4 py-2 rounded-l-md border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 transition-colors">
                        &laquo;
                    </a>
                @endif

                @foreach ($recettes->getUrlRange(1, $recettes->lastPage()) as $page => $url)
                    @if ($page == $recettes->currentPage())
                        <span class="inline-flex items-center px-4 py-2 border border-brand-500 bg-brand-500 text-white">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" class="inline-flex items-center px-4 py-2 border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 transition-colors">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                @if ($recettes->hasMorePages())
                    <a href="{{ $recettes->nextPageUrl() }}" class="inline-flex items-center px-4 py-2 rounded-r-md border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 transition-colors">
                        &raquo;
                    </a>
                @else
                    <span class="inline-flex items-center px-4 py-2 rounded-r-md border border-slate-200 bg-white text-slate-400 cursor-not-allowed">
                        &raquo;
                    </span>
                @endif
            </nav>
        </div>
    </div>
</section>

<!-- Delete Confirmation Modal -->
<div id="deleteConfirmModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden modal">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-6 fade-in">
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-red-100 mb-4">
                <i class="fas fa-exclamation-triangle text-red-500 text-2xl"></i>
            </div>
            <h3 class="font-bold text-xl mb-2 text-slate-900">Supprimer cette recette ?</h3>
            <p class="text-slate-600">Êtes-vous sûr de vouloir supprimer cette recette ? Cette action est irréversible.</p>
        </div>
        <div class="flex gap-4">
            <button id="cancel-delete" onclick="closeModal()" class="flex-1 py-3 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium rounded-lg transition btn-hover">
                Annuler
            </button>
            <form action="" method="POST" id="deleteRecipeForm">
                @csrf
                @method('DELETE')
                <button type="submit" class="flex-1 py-3 px-4 bg-red-500 hover:bg-red-600 text-white font-medium rounded-lg transition btn-hover">
                    Supprimer
                </button>
            </form>
        </div>
    </div>
</div>

@include('layouts.client.footer')

<!-- Back to Top Button -->
<button id="back-to-top"
    class="fixed bottom-8 right-8 bg-brand-600 text-white w-12 h-12 rounded-full shadow-lg flex items-center justify-center transition-all duration-300 opacity-0 invisible hover:bg-brand-700">
    <i class="fas fa-arrow-up"></i>
</button>

<script>
    // Delete Modal Functions
    const deleteConfirmModal = document.getElementById('deleteConfirmModal');
    
    function deleteModal(id) {
        deleteConfirmModal.classList.remove('hidden');
        let form = document.getElementById('deleteRecipeForm'); 
        form.action = `{{ route('recettes.destroy', ':id') }}`.replace(':id', id);
    }

    function closeModal() {
        deleteConfirmModal.classList.add('hidden');
    }

    // Close modal when clicking outside
    deleteConfirmModal.addEventListener('click', (e) => {
        if (e.target === deleteConfirmModal) {
            closeModal();
        }
    });

    // Back to top button
    const backToTopBtn = document.getElementById('back-to-top');

    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            backToTopBtn.classList.remove('opacity-0', 'invisible');
            backToTopBtn.classList.add('opacity-100', 'visible');
        } else {
            backToTopBtn.classList.remove('opacity-100', 'visible');
            backToTopBtn.classList.add('opacity-0', 'invisible');
        }
    });

    backToTopBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Animation on scroll
    const fadeElements = document.querySelectorAll('.fade-in');
    const fadeInOnScroll = () => {
        fadeElements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;

            if (elementTop < windowHeight - 100) {
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }
        });
    };

    window.addEventListener('scroll', fadeInOnScroll);
    window.addEventListener('load', fadeInOnScroll);
</script>