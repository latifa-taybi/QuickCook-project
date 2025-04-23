@include('layouts.client.header')
    <!-- Page Title Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="font-display font-bold text-3xl md:text-4xl text-dark mb-4">
                Toutes nos <span class="text-gradient">recettes</span>
            </h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Découvrez notre collection complète de recettes délicieuses et faciles à préparer. 
                Trouvez l'inspiration pour vos prochains repas !
            </p>
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
                        <select class="w-full md:w-auto px-4 py-2 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition flex-grow">
                          <option value="">Temps de préparation</option>
                          <option value="15">< 15 min</option>
                          <option value="30">< 30 min</option>
                          <option value="60">< 60 min</option>
                          <option value="more">> 60 min</option>
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
                <div class="bg-white rounded-2xl shadow-md overflow-hidden card-hover">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1760&q=80" 
                            alt="Salade fraîcheur" class="w-full h-48 object-cover">
                        <div class="absolute top-3 right-3">
                            <button class="bg-white bg-opacity-90 p-2 rounded-full shadow-md hover:bg-accent-100 hover:text-accent-600 transition">
                                <i class="fas fa-heart text-accent-500"></i>
                            </button>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-dark to-transparent p-4">
                            <span class="text-xs text-white bg-brand-500 py-1 px-2 rounded-full">Salade</span>
                        </div>
                    </div>
                    <div class="p-5">
                        <h3 class="font-display font-semibold text-xl mb-2">Salade fraîcheur estivale</h3>
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <i class="fas fa-clock mr-1"></i>
                            <span class="mr-4">15 min</span>
                            <i class="fas fa-utensils mr-1"></i>
                            <span>Facile</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">Une salade légère et rafraîchissante parfaite pour l'été avec des légumes de saison.</p>
                        <div class="flex justify-between items-center">
                            <div class="flex -space-x-2">
                                <img src="https://randomuser.me/api/portraits/women/44.jpg" class="w-8 h-8 rounded-full border-2 border-white" alt="User">
                            </div>
                            <a href="#" class="text-brand-500 hover:text-brand-700 font-medium text-sm">Voir la recette</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pagination -->
    <section class="py-8 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-center">
                <nav class="flex items-center space-x-2">
                    <a href="#" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 transition">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                    <a href="#" class="px-4 py-2 rounded-lg bg-brand-500 text-white">1</a>
                    <a href="#" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 transition">2</a>
                    <a href="#" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 transition">3</a>
                    <span class="px-2 text-gray-500">...</span>
                    <a href="#" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 transition">10</a>
                    <a href="#" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 transition">
                        <i class="fas fa-chevron-right"></i>
                    </a>
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

        // Favorite toggle
        document.querySelectorAll('.fa-heart').forEach(heart => {
            heart.addEventListener('click', function() {
                if (this.classList.contains('far')) {
                    this.classList.remove('far', 'text-gray-400');
                    this.classList.add('fas', 'text-accent-500');
                } else {
                    this.classList.remove('fas', 'text-accent-500');
                    this.classList.add('far', 'text-gray-400');
                }
            });
        });

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