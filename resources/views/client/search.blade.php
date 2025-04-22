<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QuickCook - Trouvez des recettes avec vos ingrédients</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  
  <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
  
  <!-- Tailwind CSS CDN -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#F2FBFF',
                            100: '#E6F7FF',
                            200: '#BFEBFF',
                            300: '#99DEFF',
                            400: '#4DC4FF',
                            500: '#00AAFF',
                            600: '#0099E6',
                            700: '#006699',
                            800: '#004D73',
                            900: '#00334D',
                        },
                        accent: {
                            50: '#FFF9F0',
                            100: '#FFF3E0',
                            200: '#FFE0B2',
                            300: '#FFCC80',
                            400: '#FFA726',
                            500: '#FF9800',
                            600: '#FB8C00',
                            700: '#F57C00',
                            800: '#EF6C00',
                            900: '#E65100',
                        },
                        dark: '#121826',
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                        display: ['Clash Display', 'serif']
                    },
                    animation: {
                        'float': 'float 3s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'spin-slow': 'spin 8s linear infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0)'
                            },
                            '50%': {
                                transform: 'translateY(-10px)'
                            },
                        }
                    },
                    backgroundImage: {
                        'food-pattern': "url('https://images.unsplash.com/photo-1495195134817-aeb325a55b65?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1776&q=80')",
                        'texture': "url('https://www.transparenttextures.com/patterns/cubes.png')",
                    }
                }
            }
        }
    </script>


</head>

<body class="bg-gray-50 relative">

    <!-- Grain overlay -->
    <div class="grain-overlay"></div>

    <!-- Header -->
    <header class="sticky top-0 z-50 bg-white shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-3">
                <div class="flex items-center">
                    <span class="font-display font-bold text-2xl md:text-3xl">
                        <span class="text-brand-500">Quick</span><span class="text-accent-500">Cook</span>
                    </span>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-dark hover:text-brand-500 menu-item active">Accueil</a>
                    <a href="#" class="text-dark hover:text-brand-500 menu-item">Recettes</a>
                    <a href="#" class="text-dark hover:text-brand-500 menu-item">Favoris</a>
                    <a href="#" class="text-dark hover:text-brand-500 menu-item">À propos</a>
                </div>

                <div class="flex items-center space-x-3">
                    <button id="add-recipe-btn"
                        class="hidden md:flex items-center gap-2 bg-gradient-brand text-white py-2 px-4 rounded-lg shadow-sm hover:shadow transition btn-hover">
                        <i class="fas fa-plus"></i>
                        <span>Ajouter une recette</span>
                    </button>

                    <div class="relative group">
                        <button id="profile-btn"
                            class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-200 hover:bg-gray-300 transition">
                            <i class="fas fa-user text-gray-600"></i>
                        </button>

                        <div
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 hidden group-hover:block">
                            <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition">
                                <i class="fas fa-user-circle mr-2"></i> Mon Profil
                            </a>
                            <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition">
                                <i class="fas fa-cog mr-2"></i> Paramètres
                            </a>
                            <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition">
                                <i class="fas fa-heart mr-2"></i> Mes Favoris
                            </a>
                            <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition">
                                <i class="fas fa-utensils mr-2"></i> Mes Recettes
                            </a>
                            <div class="border-t border-gray-200 my-1"></div>
                            <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition">
                                <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
                            </a>
                        </div>
                    </div>

                    <button id="mobile-menu-btn" class="md:hidden text-dark hover:text-brand-500">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-200 py-4">
            <div class="container mx-auto px-4 space-y-4">
                <a href="#" class="block text-dark hover:text-brand-500 py-2">Accueil</a>
                <a href="#" class="block text-dark hover:text-brand-500 py-2">Recettes</a>
                <a href="#" class="block text-dark hover:text-brand-500 py-2">Favoris</a>
                <a href="#" class="block text-dark hover:text-brand-500 py-2">À propos</a>
                <button
                    class="flex items-center gap-2 w-full bg-gradient-brand text-white py-2 px-4 rounded-lg shadow-sm hover:shadow transition btn-hover">
                    <i class="fas fa-plus"></i>
                    <span>Ajouter une recette</span>
                </button>
            </div>
        </div>
    </header>

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
                    <input type="text" name="ingredient"
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition"
                        placeholder="Ex: Tomate, Poulet, Pâtes">                       
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <button
                    class="bg-gradient-brand text-white font-semibold py-4 px-6 rounded-lg shadow-md hover:shadow-lg transition btn-hover">
                    Ajouter
                </button>
            </div>

            <div class="mb-8">
                <div class="text-sm text-gray-500 mb-3">Ingrédients sélectionnés:</div>
                <div class="flex flex-wrap gap-2">


                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="flex items-center gap-2">
                    <span class="text-sm text-gray-600 whitespace-nowrap">Temps:</span>
                    <select
                        class="flex-1 px-3 py-2 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition">
                        <option>Tous</option>
                        <option>Moins de 15 min</option>
                        <option>Moins de 30 min</option>
                        <option>Moins de 60 min</option>
                    </select>
                </div>

                <div class="flex items-center gap-2">
                    <span class="text-sm text-gray-600 whitespace-nowrap">Type:</span>
                    <select
                        class="flex-1 px-3 py-2 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition">
                        <option>Tous</option>
                        <option>Entrée</option>
                        <option>Plat principal</option>
                        <option>Dessert</option>
                    </select>
                </div>

                <div class="flex items-center gap-2">
                    <span class="text-sm text-gray-600 whitespace-nowrap">Régime:</span>
                    <select
                        class="flex-1 px-3 py-2 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition">
                        <option>Tous</option>
                        <option>Végétarien</option>
                        <option>Végan</option>
                        <option>Sans gluten</option>
                    </select>
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
                <div class="flex items-center gap-2">
                    <button
                        class="flex items-center gap-1 bg-white text-gray-700 py-2 px-4 rounded-lg shadow-sm hover:shadow transition">
                        <i class="fas fa-heart text-accent-500"></i>
                        <span class="hidden sm:inline">Favoris</span>
                    </button>
                    <button
                        class="flex items-center gap-1 bg-white text-gray-700 py-2 px-4 rounded-lg shadow-sm hover:shadow transition">
                        <i class="fas fa-sort-amount-down text-brand-500"></i>
                        <span class="hidden sm:inline">Trier par</span>
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">

              @if (isset($recettes) && $recettes->count() > 0)
                @foreach ($recettes as $recette)
                  <div class="bg-white rounded-2xl shadow-md overflow-hidden card-hover fade-in-delay-2">
                    <div class="relative">
                      <img src="{{ asset('storage/' . $recette->image) }}" alt="{{$recette->name}}"
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
                        <a href="#" class="text-brand-500 hover:text-brand-700 font-medium text-sm">Voir
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
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });




        // Edit profile modal
        const profileBtn = document.getElementById('profile-btn');
        const editProfileModal = document.getElementById('edit-profile-modal');
        const closeEditProfile = document.getElementById('close-edit-profile');
        const cancelEditProfile = document.getElementById('cancel-edit-profile');

        profileBtn.addEventListener('click', () => {
            editProfileModal.classList.remove('hidden');
        });

        closeEditProfile.addEventListener('click', () => {
            editProfileModal.classList.add('hidden');
        });

        cancelEditProfile.addEventListener('click', () => {
            editProfileModal.classList.add('hidden');
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

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Animation on scroll
        const fadeElements = document.querySelectorAll('.fade-in, .fade-in-delay-1, .fade-in-delay-2, .fade-in-delay-3');

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

        // Ingredient tag removal
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('fa-times') && e.target.closest('.ingredient-tag')) {
                e.target.closest('.ingredient-tag').remove();
            }
        });

        // Add ingredient functionality
        const addIngredientInput = document.querySelector('#search-section input[type="text"]');
        const addIngredientBtn = document.querySelector('#search-section button');
        const ingredientsContainer = document.querySelector('#search-section .flex-wrap');

        addIngredientBtn.addEventListener('click', (e) => {
            e.preventDefault();
            const ingredient = addIngredientInput.value.trim();

            if (ingredient) {
                const tag = document.createElement('span');
                tag.className =
                    'ingredient-tag bg-brand-100 text-brand-700 px-3 py-1.5 rounded-full flex items-center';
                tag.innerHTML =
                    `${ingredient} <i class="fas fa-times ml-2 cursor-pointer hover:text-brand-900"></i>
                    <input type="hidden" name="ingredients[]" value="${ingredient}">`;
                ingredientsContainer.appendChild(tag);
                addIngredientInput.value = '';
            }
        });

        // Allow adding ingredient with Enter key
        addIngredientInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                addIngredientBtn.click();
            }
        });

          new TomSelect("#ingredient",{
            maxItems: 3
          });
    </script>
</body>

</html>
