@include('layouts.client.header')
    <!-- Search Section -->
    <section id="search-section" class="py-16 container mx-auto px-4 relative mt-5">
        <form action="{{ route('recettes.search') }}" method="POST"
            class="max-w-4xl mx-auto bg-white rounded-2xl shadow-strong p-6 md:p-8 fade-in">
            @csrf
            <div class="text-center mb-8 fade-in">
                <h2 class="font-display font-bold text-3xl md:text-4xl text-dark mb-4">
                    Quels <span class="text-gradient">ingrédients</span> avez-vous?
                </h2>
                <p class="text-gray-600">
                    Entrez les ingrédients que vous avez dans votre cuisine et nous vous proposerons des recettes
                    adaptées.
                </p>
            </div>

            <div class="flex flex-col md:flex-row gap-4 mb-6">
                <div class="flex-1 relative">
                    <select id="ingredient" name="ingredient" multiple placeholder="Entrer un ingrédient..."
                        autocomplete="off"
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition">
                        @foreach ($allIngredients as $ingredient)
                            <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button id="add-ingredient-btn" type="button"
                    class="bg-gradient-brand text-white font-semibold py-4 px-6 rounded-lg shadow-md hover:shadow-lg transition btn-hover">
                    Ajouter
                </button>
            </div>

            <div class="mb-8">
                <div class="text-sm text-gray-500 mb-3">Ingrédients sélectionnés:</div>
                <div id="containerTag" class="flex flex-wrap gap-2">

                </div>
            </div>
            <button type="submit"
                class="w-full bg-gradient-brand text-white font-semibold py-4 px-6 rounded-lg shadow-md hover:shadow-lg transition btn-hover">
                <i class="fas fa-utensils mr-2"></i> Rechercher des Recettes
            </button>
        </form>
    </section>

    <!-- Results Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8 fade-in">
                <h2 class="font-display font-semibold text-2xl md:text-3xl text-dark">
                    @if (isset($recettes) && $recettes->count() > 0)
                        Résultats <span class="text-brand-500">({{ $recettes->count() }} recettes)</span>
                    @else
                        Résultats <span class="text-brand-500">(0 recettes)</span>
                    @endif
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @if (isset($recettes) && $recettes->count() > 0)
                    @foreach ($recettes as $recette)
                        <div class="bg-white rounded-2xl shadow-md overflow-hidden card-hover fade-in-delay-2">
                            <div class="relative">
                                <img src="{{ asset('storage/' . $recette->image) }}" alt="{{ $recette->name }}"
                                    class="w-full h-48 object-cover">
                                <div class="absolute top-3 right-3">
                                    <button
                                        class="bg-white bg-opacity-90 p-2 rounded-full shadow-md hover:bg-accent-100 hover:text-accent-600 transition">
                                        <i class="fas fa-heart text-accent-500"></i>
                                    </button>
                                </div>
                                <div
                                    class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-dark to-transparent p-4">
                                    <span class="text-xs text-white bg-brand-500 py-1 px-2 rounded-full">Salade</span>
                                </div>
                            </div>
                            <div class="p-5">
                                <h3 class="font-display font-semibold text-xl mb-2">{{ $recette->name }}</h3>
                                <div class="flex items-center text-sm text-gray-500 mb-3">
                                    <i class="fas fa-clock mr-1"></i>
                                    <span class="mr-4">{{ $recette->prepTime }}</span>
                                    <i class="fas fa-utensils mr-1"></i>
                                    <span>{{ $recette->difficulty }}</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-4">{{ $recette->description }}</p>
                                <div class="flex justify-between items-center">
                                    <div class="flex -space-x-2">
                                        <img src="https://randomuser.me/api/portraits/men/22.jpg"
                                            class="w-8 h-8 rounded-full border-2 border-white" alt="User">
                                    </div>
                                    <a href="#"
                                        class="text-brand-500 hover:text-brand-700 font-medium text-sm">Voir
                                        la
                                        recette</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                        <div class="p-5 text-center">
                            <h3 class="font-display font-semibold text-xl mb-2">Aucune recette trouvée</h3>
                            <p class="text-gray-600 text-sm">Essayez d'ajouter des ingrédients pour trouver des
                                recettes
                                adaptées.</p>
                        </div>
                    </div>
                @endif
    </section>



    <!-- Edit Profile Modal -->
    <div id="edit-profile-modal"
        class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-2xl shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="sticky top-0 bg-white px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="font-display font-bold text-xl">Modifier mon profil</h3>
                <button id="close-edit-profile" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <div class="p-6">
                <form>
                    <div class="flex flex-col items-center mb-6">
                        <div class="relative mb-4">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg"
                                class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-md"
                                alt="Profile">
                            <button
                                class="absolute bottom-0 right-0 bg-brand-500 text-white p-2 rounded-full shadow-md hover:bg-brand-600 transition">
                                <i class="fas fa-camera"></i>
                            </button>
                        </div>
                        <button class="text-brand-500 hover:text-brand-700 font-medium">
                            Changer de photo
                        </button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Prénom</label>
                            <input type="text"
                                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition"
                                value="Sophie">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Nom</label>
                            <input type="text"
                                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition"
                                value="Martin">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Email</label>
                        <input type="email"
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition"
                            value="sophie.martin@example.com">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Bio</label>
                        <textarea
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition"
                            rows="3">Passionnée de cuisine depuis toujours, j'aime partager mes recettes et découvrir de nouvelles saveurs !</textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Préférences alimentaires</label>
                        <div class="flex flex-wrap gap-3">
                            <label class="inline-flex items-center">
                                <input type="checkbox"
                                    class="rounded border-gray-300 text-brand-500 focus:ring-brand-400" checked>
                                <span class="ml-2">Végétarien</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox"
                                    class="rounded border-gray-300 text-brand-500 focus:ring-brand-400">
                                <span class="ml-2">Végan</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox"
                                    class="rounded border-gray-300 text-brand-500 focus:ring-brand-400">
                                <span class="ml-2">Sans gluten</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox"
                                    class="rounded border-gray-300 text-brand-500 focus:ring-brand-400" checked>
                                <span class="ml-2">Sans lactose</span>
                            </label>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Changer de mot de passe</label>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-gray-600 text-sm mb-1">Mot de passe actuel</label>
                                <input type="password"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-gray-600 text-sm mb-1">Nouveau mot de passe</label>
                                <input type="password"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-gray-600 text-sm mb-1">Confirmer le nouveau mot de
                                    passe</label>
                                <input type="password"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-4 pt-4 border-t border-gray-200">
                        <button type="button" id="cancel-edit-profile"
                            class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-6 rounded-lg shadow-sm transition">
                            Annuler
                        </button>
                        <button type="submit"
                            class="bg-gradient-brand text-white font-semibold py-3 px-6 rounded-lg shadow-md hover:shadow-lg transition">
                            <i class="fas fa-save mr-2"></i> Enregistrer les modifications
                        </button>
                    </div>
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
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Conditions
                                d'utilisation</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Politique de
                                confidentialité</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Mentions légales</a>
                        </li>
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
        const selectElement = document.querySelector('#ingredient');
    
        const ts = new TomSelect(selectElement, {
            maxItems: 1,
        });
    
        const addButton = document.querySelector('#add-ingredient-btn');
        const tagContainer = document.querySelector('#containerTag');
    
        addButton.addEventListener('click', (e) => {
            e.preventDefault();
    
            const selectedOptions = ts.getValue();
    
            selectedOptions.forEach(id => {
                if (document.querySelector(`[data-id="${id}"]`)) return;
    
                const label = ts.options[id]?.text || '';
    
                const html = `
                    <div class="flex items-center gap-1 bg-brand-100 text-brand-700 px-3 py-1 rounded-full text-sm cursor-pointer transition hover:bg-brand-200" data-id="${id}">
                        <span>${label}</span>
                        <span class="ml-1 text-xs font-bold cursor-pointer remove-tag">❌</span>
                        <input type="hidden" name="ingredients[]" value="${label}" data-id="${id}">
                    </div>
                `;
    
                tagContainer.innerHTML += html;
            });
    
            ts.clear(); 
        });
    
        tagContainer.addEventListener('click', (e) => {
            if (e.target.classList.contains('remove-tag')) {
                const parent = e.target.closest('[data-id]');
                const id = parent.getAttribute('data-id');
                parent.remove();
                ts.removeItem(id);
            }
        });
    




        // Mobile menu toggle
        // const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        // const mobileMenu = document.getElementById('mobile-menu');

        // mobileMenuBtn.addEventListener('click', () => {
        //     mobileMenu.classList.toggle('hidden');
        // });




        // // Edit profile modal
        // const profileBtn = document.getElementById('profile-btn');
        // const editProfileModal = document.getElementById('edit-profile-modal');
        // const closeEditProfile = document.getElementById('close-edit-profile');
        // const cancelEditProfile = document.getElementById('cancel-edit-profile');

        // profileBtn.addEventListener('click', () => {
        //     editProfileModal.classList.remove('hidden');
        // });

        // closeEditProfile.addEventListener('click', () => {
        //     editProfileModal.classList.add('hidden');
        // });

        // cancelEditProfile.addEventListener('click', () => {
        //     editProfileModal.classList.add('hidden');
        // });

        // // Back to top button
        // const backToTopBtn = document.getElementById('back-to-top');

        // window.addEventListener('scroll', () => {
        //     if (window.pageYOffset > 300) {
        //         backToTopBtn.classList.remove('opacity-0', 'invisible');
        //         backToTopBtn.classList.add('opacity-100', 'visible');
        //     } else {
        //         backToTopBtn.classList.remove('opacity-100', 'visible');
        //         backToTopBtn.classList.add('opacity-0', 'invisible');
        //     }
        // });

        // backToTopBtn.addEventListener('click', () => {
        //     window.scrollTo({
        //         top: 0,
        //         behavior: 'smooth'
        //     });
        // });

        // // Smooth scrolling for anchor links
        // document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        //     anchor.addEventListener('click', function(e) {
        //         e.preventDefault();

        //         const targetId = this.getAttribute('href');
        //         if (targetId === '#') return;

        //         const targetElement = document.querySelector(targetId);
        //         if (targetElement) {
        //             targetElement.scrollIntoView({
        //                 behavior: 'smooth'
        //             });
        //         }
        //     });
        // });

        // // Animation on scroll
        // const fadeElements = document.querySelectorAll('.fade-in, .fade-in-delay-1, .fade-in-delay-2, .fade-in-delay-3');

        // const fadeInOnScroll = () => {
        //     fadeElements.forEach(element => {
        //         const elementTop = element.getBoundingClientRect().top;
        //         const windowHeight = window.innerHeight;

        //         if (elementTop < windowHeight - 100) {
        //             element.style.opacity = '1';
        //             element.style.transform = 'translateY(0)';
        //         }
        //     });
        // };

        // // Initialize elements as invisible
        // fadeElements.forEach(element => {
        //     element.style.opacity = '0';
        //     element.style.transform = 'translateY(20px)';
        //     element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        // });

        // window.addEventListener('scroll', fadeInOnScroll);
        // window.addEventListener('load', fadeInOnScroll);

        // // Ingredient tag removal
        // document.addEventListener('click', (e) => {
        //     if (e.target.classList.contains('fa-times') && e.target.closest('.ingredient-tag')) {
        //         e.target.closest('.ingredient-tag').remove();
        //     }
        // });

        // // Add ingredient functionality
        // const addIngredientInput = document.querySelector('#search-section input[type="text"]');
        // const addIngredientBtn = document.querySelector('#search-section button');
        // const ingredientsContainer = document.querySelector('#search-section .flex-wrap');

        // addIngredientBtn.addEventListener('click', (e) => {
        //     e.preventDefault();
        //     const ingredient = addIngredientInput.value.trim();

        //     if (ingredient) {
        //         const tag = document.createElement('span');
        //         tag.className =
        //             'ingredient-tag bg-brand-100 text-brand-700 px-3 py-1.5 rounded-full flex items-center';
        //         tag.innerHTML =
        //             `${ingredient} <i class="fas fa-times ml-2 cursor-pointer hover:text-brand-900"></i>
    //             <input type="hidden" name="ingredients[]" value="${ingredient}">`;
        //         ingredientsContainer.appendChild(tag);
        //         addIngredientInput.value = '';
        //     }
        // });



        // // Allow adding ingredient with Enter key
        // addIngredientInput.addEventListener('keypress', (e) => {
        //     if (e.key === 'Enter') {
        //         e.preventDefault();
        //         addIngredientBtn.click();
        //     }
        // });
    </script>
</body>

</html>
