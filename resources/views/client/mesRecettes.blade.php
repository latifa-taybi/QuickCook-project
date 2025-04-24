@include('layouts.client.header')

    <!-- Page Title Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                <div>
                    <h1 class="font-display font-bold text-3xl md:text-4xl text-dark">
                        Mes <span class="text-gradient">recettes</span>
                    </h1>
                    <p class="text-gray-600 mt-2">
                        Gérez vos créations culinaires personnelles
                    </p>
                </div>
                <a href="{{route('recettes.create')}}"><button id="create-recipe-btn" class="mt-4 md:mt-0 flex items-center gap-2 bg-gradient-brand text-white py-3 px-6 rounded-lg shadow-md hover:shadow-lg transition btn-hover">
                    <i class="fas fa-plus"></i>
                    <span>Créer une nouvelle recette</span>
                </button></a>
            </div>

            <!-- Stats Cards -->
            {{-- <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
                <div class="bg-white rounded-xl shadow-md p-6 flex items-center">
                    <div class="rounded-full bg-brand-100 p-3 mr-4">
                        <i class="fas fa-utensils text-brand-500 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Recettes créées</p>
                        <p class="font-bold text-2xl">8</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-md p-6 flex items-center">
                    <div class="rounded-full bg-green-100 p-3 mr-4">
                        <i class="fas fa-heart text-green-500 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Favoris reçus</p>
                        <p class="font-bold text-2xl">87</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-md p-6 flex items-center">
                    <div class="rounded-full bg-purple-100 p-3 mr-4">
                        <i class="fas fa-comment text-purple-500 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Commentaires</p>
                        <p class="font-bold text-2xl">32</p>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>

    <!-- Filters Section -->
    <section class="py-6 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="bg-white rounded-xl shadow-md p-4 md:p-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 w-full">
                    <div class="flex flex-col md:flex-row gap-4 md:items-center w-full">
                      <div class="relative w-full">
                        <input type="text" placeholder="Rechercher une recette..." class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                      </div>
                      <div class="flex gap-2 flex-wrap w-full">
                        <select class="w-full md:w-auto px-4 py-2 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition flex-grow">
                          <option value="">Catégorie</option>
                          <option value="entree">Entrée</option>
                          <option value="plat">Plat principal</option>
                          <option value="dessert">Dessert</option>
                          <option value="boisson">Boisson</option>
                        </select>
                        <select class="w-full md:w-auto px-4 py-2 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition flex-grow">
                          <option value="">Difficulté</option>
                          <option value="facile">Facile</option>
                          <option value="moyen">Moyen</option>
                          <option value="difficile">Difficile</option>
                        </select>
                        <select class="px-4 py-2 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition">
                            <option value="">Statut</option>
                            <option value="published">Publiée</option>
                            <option value="draft">Brouillon</option>
                            <option value="archived">Archivée</option>
                        </select>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </section>

    <!-- Recipes Grid Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Recipe Card 1 -->
                @foreach($recettes as $recette)
                 <div class="bg-white rounded-2xl shadow-md overflow-hidden card-hover">
                    <div class="relative">
                        <img src="{{ asset('storage/' . $recette->image) }}" 
                            alt="{{$recette->name}}" class="w-full h-48 object-cover">
                        <div class="absolute top-3 right-3 flex space-x-2">
                            <a href="{{ route('recettes.edit', $recette->id) }}"><button type="button" class="bg-white p-2 rounded-full shadow-md hover:bg-brand-100 hover:text-brand-600 transition">
                                <i class="fas fa-edit text-brand-500"></i>
                            </button></a>
                            <button onclick="deleteModal({{ $recette->id }})" class="delete-recipe bg-white p-2 rounded-full shadow-md hover:bg-red-100 hover:text-red-600 transition" >
                                <i class="fas fa-trash-alt text-red-500"></i>
                            </button>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-dark to-transparent p-4">
                            <span class="text-xs text-white bg-green-500 py-1 px-2 rounded-full ml-2">Publiée</span>
                        </div>
                    </div>
                    <div class="p-5">
                        <h3 class="font-display font-semibold text-xl mb-2">{{$recette->name}}</h3>
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <i class="fas fa-clock mr-1"></i>
                            <span class="mr-4">{{$recette->prepTime}} min</span>
                            <i class="fas fa-utensils mr-1"></i>
                            <span>Facile</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">{{$recette->description}}</p>
                        <div class="flex justify-between items-center">
                            <a href="#" class="text-brand-500 hover:text-brand-700 font-medium text-sm">Voir la recette</a>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Recipe Card 8 - New Recipe Card -->
                <a href="{{route('recettes.create')}}" class="h-full">
                    <div class="bg-white rounded-2xl border-2 border-dashed border-gray-300 overflow-hidden flex flex-col items-center justify-center p-8 hover:border-brand-400 transition cursor-pointer h-full" id="new-recipe-card">
                    <div class="rounded-full bg-brand-100 p-4 mb-4">
                        <i class="fas fa-plus text-brand-500 text-2xl"></i>
                    </div>
                    <h3 class="font-display font-semibold text-xl mb-2 text-center">Ajouter une nouvelle recette</h3>
                    <p class="text-gray-500 text-sm text-center">Partagez votre créativité culinaire avec la communauté</p>
                </div></a>
            </div>
        </div>
    </section>

    <!-- Pagination -->
    <section class="py-8 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-center">
                <nav class="flex items-center space-x-2">
                    {{ $recettes->links() }}
                </nav>
            </div>
        </div>
    </section>

    <!-- Delete Confirmation Modal -->
    <div id="deleteConfirmModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden modal">
        <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-6">
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-red-100 mb-4">
                    <i class="fas fa-exclamation-triangle text-red-500 text-2xl"></i>
                </div>
                <h3 class="font-display font-bold text-xl mb-2">Supprimer cette recette ?</h3>
                <p class="text-gray-600">Êtes-vous sûr de vouloir supprimer cette recette ? Cette action est irréversible.</p>
            </div>
            <div class="flex gap-4">
                <button id="cancel-delete" class="flex-1 py-3 px-4 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition">
                    Annuler
                </button>
                <form action="" method="POST" id="deleteRecipeForm">
                    @csrf
                    @method('DELETE')
                    <button id="confirm-delete" class="flex-1 py-3 px-4 bg-red-500 hover:bg-red-600 text-white font-medium rounded-lg transition">
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>



    <!-- Footer -->
    <footer class="bg-dark text-white pt-16 pb-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <div>
                    <h4 class="font-display font-bold text-xl mb-4">
                        <span class="text-brand-400">Quick</span><span class="text-accent-400">Cook</span>
                    </h4>
                    <p class="text-gray-400 mb-4">
                        La solution intelligente pour cuisiner avec ce que vous avez, sans gaspillage et avec plaisir.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-pinterest-p"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h5 class="font-display font-semibold text-lg mb-4">Navigation</h5>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Accueil</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Recettes</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Favoris</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">À propos</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="font-display font-semibold text-lg mb-4">Légal</h5>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Conditions d'utilisation</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Politique de confidentialité</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Mentions légales</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Cookies</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="font-display font-semibold text-lg mb-4">Contact</h5>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-400">
                            <i class="fas fa-map-marker-alt mr-3"></i>
                            <span>123 Rue de la Cuisine, Paris</span>
                        </li>
                        <li class="flex items-center text-gray-400">
                            <i class="fas fa-phone-alt mr-3"></i>
                            <span>+33 1 23 45 67 89</span>
                        </li>
                        <li class="flex items-center text-gray-400">
                            <i class="fas fa-envelope mr-3"></i>
                            <span>contact@quickcook.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-500 text-sm mb-4 md:mb-0">
                    &copy; 2023 QuickCook. Tous droits réservés.
                </p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-500 hover:text-white text-sm transition">FAQ</a>
                    <a href="#" class="text-gray-500 hover:text-white text-sm transition">Support</a>
                    <a href="#" class="text-gray-500 hover:text-white text-sm transition">Carrières</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="back-to-top"
        class="fixed bottom-8 right-8 bg-brand-500 text-white w-12 h-12 rounded-full shadow-lg flex items-center justify-center transition opacity-0 invisible hover:bg-brand-600">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Scripts -->
    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
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

        const deleteConfirmModal = document.getElementById('deleteConfirmModal');
        function deleteModal(id) {
            deleteConfirmModal.classList.remove('hidden');
            let form = document.getElementById('deleteRecipeForm'); 
            form.action = `{{ route('recettes.destroy', ':id') }}`.replace(':id', id);
        }

        function closeModal() {
            deleteConfirmModal.classList.add('hidden');
        }



        // Animation on scroll
        const fadeElements = document.querySelectorAll('.card-hover');

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

        // Initialize elements as invisible
        fadeElements.forEach(element => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(20px)';
            element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        });

        window.addEventListener('scroll', fadeInOnScroll);
        window.addEventListener('load', fadeInOnScroll);
    </script>
</body>

</html>