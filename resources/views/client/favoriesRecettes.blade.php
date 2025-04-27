@include('layouts.client.header')

    <!-- Page Title Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                <div>
                    <h1 class="font-display font-bold text-3xl md:text-4xl text-dark">
                        Mes <span class="text-gradient">recettes favories</span>
                    </h1>
                    <p class="text-gray-600 mt-2">
                        Consulter vos recettes préferées
                    </p>
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
                            <a href="{{route('recette.show', $recette)}}    " class="text-brand-500 hover:text-brand-700 font-medium text-sm">Voir la recette</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Pagination -->
    <section class="py-8 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-center">
                <nav class="flex items-center space-x-2">
                    <ul class="pagination flex items-center space-x-2">
                        @if ($recettes->onFirstPage())
                            <li class="disabled">
                                <span class="px-4 py-2 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed">&laquo;</span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $recettes->previousPageUrl() }}" class="px-4 py-2 bg-brand-500 text-white rounded-lg hover:bg-brand-600">&laquo;</a>
                            </li>
                        @endif

                        @foreach ($recettes->getUrlRange(1, $recettes->lastPage()) as $page => $url)
                            @if ($page == $recettes->currentPage())
                                <li>
                                    <span class="px-4 py-2 bg-brand-500 text-white rounded-lg">{{ $page }}</span>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $url }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        @if ($recettes->hasMorePages())
                            <li>
                                <a href="{{ $recettes->nextPageUrl() }}" class="px-4 py-2 bg-brand-500 text-white rounded-lg hover:bg-brand-600">&raquo;</a>
                            </li>
                        @else
                            <li class="disabled">
                                <span class="px-4 py-2 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed">&raquo;</span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </section>





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