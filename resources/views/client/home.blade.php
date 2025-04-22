<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickCook - Cuisine créative avec vos ingrédients</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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

<body class="bg-gray-50 text-gray-900 relative">
    <!-- Grain overlay for texture -->
    <div class="grain-overlay"></div>

    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-white/90 backdrop-blur-md shadow-md transition-all duration-300" id="navbar">
        <div class="mx-auto px-4">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <span class="font-display font-bold text-2xl md:text-3xl">
                            <span class="text-brand-600">Quick</span><span class="text-accent-600">Cook</span>
                        </span>
                    </div>
                    <div class="hidden md:ml-10 md:flex md:space-x-8">
                        <a href="{{route ('home')}}"
                            class="menu-item active text-brand-600 inline-flex items-center px-1 pt-1 text-sm font-medium">
                            Accueil
                        </a>
                        <a href="#processus"
                            class="menu-item text-gray-700 hover:text-brand-600 inline-flex items-center px-1 pt-1 text-sm font-medium">
                            Processus
                        </a>
                        <a href="#services"
                            class="menu-item text-gray-700 hover:text-brand-600 inline-flex items-center px-1 pt-1 text-sm font-medium">
                            Services
                        </a>
                        <a href="#recettes"
                            class="menu-item text-gray-700 hover:text-brand-600 inline-flex items-center px-1 pt-1 text-sm font-medium">
                            Recettes
                        </a>
                        <a href="#avis"
                            class="menu-item text-gray-700 hover:text-brand-600 inline-flex items-center px-1 pt-1 text-sm font-medium">
                            Avis
                        </a>
                    </div>
                </div>
                <div class="hidden md:ml-6 md:flex md:items-center">
                    <div class="ml-3 relative">
                        <button id="loginBtn"
                            class="group bg-white p-1 rounded-full text-gray-600 hover:text-brand-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 transition-all duration-300">
                            <span class="sr-only">Se connecter</span>
                            <div class="relative">
                                <i class="fas fa-user-circle text-xl"></i>
                                <span>Connexion</span>
                            </div>
                        </button>
                    </div>
                    <div class="-mr-2 flex items-center md:hidden">
                        <button id="mobileMenuBtn"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-brand-500 transition-all duration-300">
                            <span class="sr-only">Ouvrir le menu</span>
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div class="bg-white md:hidden hidden" id="mobileMenu">
                <div class="pt-2 pb-3 space-y-1">
                    <a href="{{route ('home')}}"
                        class="bg-brand-50 border-l-4 border-brand-500 text-brand-700 block pl-3 pr-4 py-2 text-base font-medium">
                        Accueil
                    </a>
                </div>
                <div class="pt-4 pb-3 border-t border-gray-200">
                    <div class="flex items-center px-4" id="mobileUserMenu">
                        <button id="mobileLoginBtn"
                            class="flex-shrink-0 text-brand-600 hover:text-brand-800 transition-colors duration-300">
                            Se connecter <i class="fas fa-sign-in-alt ml-1"></i>
                        </button>
                    </div>
                </div>
            </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-brand-900 to-brand-700 min-h-screen flex items-center">
        <div class="absolute inset-0 bg-food-pattern opacity-10 mix-blend-overlay"></div>
        <div class="absolute inset-0 bg-texture opacity-5"></div>

        <div class="container mx-auto px-4 py-32 sm:py-40 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="text-white">
                    <h1
                        class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold leading-tight text-shadow fade-in">
                        Transformez vos <span class="text-accent-400">ingrédients</span> en délicieux repas
                    </h1>
                    <p class="mt-6 text-xl text-white/90 max-w-xl fade-in-delay-1">
                        QuickCook vous aide à préparer des repas délicieux avec les ingrédients que vous avez déjà chez
                        vous. Réduisez le gaspillage alimentaire et découvrez de nouvelles recettes.
                    </p>
                    <div class="mt-10 flex flex-col sm:flex-row gap-4 fade-in-delay-2">
                        <button id="startBtn"
                            class="btn-hover inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-full shadow-lg text-white bg-accent-600 hover:bg-accent-700 transition-all duration-300">
                            Commencer maintenant
                            <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                        <a href="#processus"
                            class="inline-flex items-center justify-center px-8 py-3 border border-white/30 text-base font-medium rounded-full shadow-lg text-white hover:bg-white/10 transition-all duration-300">
                            Comment ça marche
                            <i class="fas fa-question-circle ml-2"></i>
                        </a>
                    </div>

                    <div class="mt-12 fade-in-delay-3">
                        <p class="text-white/70 mb-3 text-sm font-medium">Utilisé par plus de 10,000 personnes</p>
                        <div class="flex -space-x-2">
                            <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white"
                                src="https://randomuser.me/api/portraits/women/42.jpg" alt="">
                            <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white"
                                src="https://randomuser.me/api/portraits/men/32.jpg" alt="">
                            <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white"
                                src="https://randomuser.me/api/portraits/women/68.jpg" alt="">
                            <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white"
                                src="https://randomuser.me/api/portraits/men/43.jpg" alt="">
                            <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white"
                                src="https://randomuser.me/api/portraits/women/24.jpg" alt="">
                            <span
                                class="flex items-center justify-center h-10 w-10 rounded-full bg-brand-500 text-white text-xs font-medium ring-2 ring-white">+5k</span>
                        </div>
                    </div>
                </div>

                <div class="relative fade-in-delay-4">
                    <div
                        class="absolute -top-10 -left-10 w-40 h-40 bg-accent-500 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse-slow">
                    </div>
                    <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-brand-500 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse-slow"
                        style="animation-delay: 1s;"></div>

                    <div class="relative bg-white rounded-2xl shadow-2xl overflow-hidden p-2">
                        <div class="aspect-w-4 aspect-h-3 rounded-xl overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1606787366850-de6330128bfc?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80"
                                alt="Cuisine créative" class="w-full h-full object-cover">
                        </div>

                        <!-- Floating elements -->
                        <div
                            class="absolute top-5 -right-6 bg-white rounded-lg shadow-lg p-3 transform rotate-6 animate-float">
                            <div class="flex items-center space-x-2">
                                <div
                                    class="w-8 h-8 rounded-full bg-accent-100 flex items-center justify-center text-accent-600">
                                    <i class="fas fa-utensils"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-900">Recette trouvée !</p>
                                    <p class="text-xs text-gray-500">Poulet au curry</p>
                                </div>
                            </div>
                        </div>

                        <div class="absolute -bottom-6 -left-6 bg-white rounded-lg shadow-lg p-3 transform -rotate-6 animate-float"
                            style="animation-delay: 0.5s;">
                            <div class="flex items-center space-x-2">
                                <div
                                    class="w-8 h-8 rounded-full bg-brand-100 flex items-center justify-center text-brand-600">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-900">Prêt en 20 min</p>
                                    <p class="text-xs text-gray-500">Facile à préparer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 w-full overflow-hidden">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                preserveAspectRatio="none" class="w-full h-24 text-gray-50" fill="currentColor">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z">
                </path>
            </svg>
        </div>
    </div>

    <!-- How it works -->
    <section id="processus" class="py-5 bg-gray-50 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-display font-bold text-gray-900 sm:text-4xl">
                    Comment <span class="text-brand-600">ça fonctionne</span>
                </h2>
                <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                    Trois étapes simples pour transformer vos ingrédients en délicieux repas.
                </p>
            </div>

            <div class="mt-20">
                <div class="relative">
                    <!-- Timeline line -->
                    <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 h-full w-1 bg-brand-200">
                    </div>

                    <!-- Step 1 -->
                    <div class="relative md:flex md:items-center mb-16 md:mb-32">
                        <div class="md:w-1/2 md:pr-8 md:text-right">
                            <div class="card-hover bg-white p-6 rounded-xl shadow-lg md:ml-auto md:mr-8 max-w-md">
                                <div
                                    class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-brand-100 text-brand-600 mb-4">
                                    <i class="fas fa-search text-xl"></i>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-3">Saisissez vos ingrédients</h3>
                                <p class="text-gray-600">
                                    Listez simplement les ingrédients que vous avez dans votre cuisine. Notre système
                                    intelligent les reconnaîtra instantanément et vous suggérera des options.
                                </p>
                            </div>
                        </div>
                        <div
                            class="hidden md:flex items-center justify-center absolute left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                            <div
                                class="h-12 w-12 rounded-full bg-brand-500 text-white flex items-center justify-center text-xl font-bold border-4 border-white">
                                1</div>
                        </div>
                        <div class="md:w-1/2 md:pl-8">
                            <div
                                class="relative w-full h-64 rounded-xl overflow-hidden shadow-lg mt-6 md:mt-0 md:mr-8">
                                <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1074&q=80"
                                    alt="Ingrédients"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative md:flex md:items-center mb-16 md:mb-32">
                        <div class="md:w-1/2 md:pr-8">
                            <div
                                class="relative w-full h-64 rounded-xl overflow-hidden shadow-lg mt-6 md:mt-0 md:mr-8">
                                <img src="https://images.unsplash.com/photo-1556911220-e15b29be8c8f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80"
                                    alt="Recettes"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                            </div>
                        </div>
                        <div
                            class="hidden md:flex items-center justify-center absolute left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                            <div
                                class="h-12 w-12 rounded-full bg-brand-500 text-white flex items-center justify-center text-xl font-bold border-4 border-white">
                                2</div>
                        </div>
                        <div class="md:w-1/2 md:pl-8 md:text-left">
                            <div class="card-hover bg-white p-6 rounded-xl shadow-lg md:ml-8 max-w-md">
                                <div
                                    class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-brand-100 text-brand-600 mb-4">
                                    <i class="fas fa-lightbulb text-xl"></i>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-3">Découvrez des recettes</h3>
                                <p class="text-gray-600">
                                    Notre algorithme avancé trouve instantanément les meilleures recettes adaptées à vos
                                    ingrédients disponibles, en tenant compte de vos préférences.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative md:flex md:items-center">
                        <div class="md:w-1/2 md:pr-8 md:text-right">
                            <div class="card-hover bg-white p-6 rounded-xl shadow-lg md:ml-auto md:mr-8 max-w-md">
                                <div
                                    class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-brand-100 text-brand-600 mb-4">
                                    <i class="fas fa-utensils text-xl"></i>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-3">Cuisinez et savourez</h3>
                                <p class="text-gray-600">
                                    Suivez les instructions détaillées et dégustez votre délicieux repas fait maison en
                                    toute simplicité. Partagez vos créations avec la communauté.
                                </p>
                            </div>
                        </div>
                        <div
                            class="hidden md:flex items-center justify-center absolute left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                            <div
                                class="h-12 w-12 rounded-full bg-brand-500 text-white flex items-center justify-center text-xl font-bold border-4 border-white">
                                3</div>
                        </div>
                        <div class="md:w-1/2 md:pl-8">
                            <div
                                class="relative w-full h-64 rounded-xl overflow-hidden shadow-lg mt-6 md:mt-0 md:mr-8">
                                <img src="https://images.unsplash.com/photo-1547592180-85f173990554?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80"
                                    alt="Cuisiner"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="services" class="py-5 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-display font-bold text-gray-900 sm:text-4xl">
                    Nos <span class="text-brand-600">fonctionnalités</span>
                </h2>
                <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                    Découvrez tout ce que QuickCook peut faire pour vous.
                </p>
            </div>

            <div class="mt-20">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <!-- Feature 1 -->
                    <div class="card-hover bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                        <div
                            class="text-brand-500 text-4xl mb-6 bg-brand-50 h-16 w-16 rounded-full flex items-center justify-center">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Recherche intelligente</h3>
                        <p class="text-gray-600">
                            Notre algorithme avancé trouve les meilleures recettes en fonction de vos ingrédients
                            disponibles, en tenant compte de vos préférences culinaires.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="card-hover bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                        <div
                            class="text-brand-500 text-4xl mb-6 bg-brand-50 h-16 w-16 rounded-full flex items-center justify-center">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Favoris personnalisés</h3>
                        <p class="text-gray-600">
                            Enregistrez vos recettes préférées dans votre collection personnelle pour y accéder
                            facilement plus tard, même hors ligne.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="card-hover bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                        <div
                            class="text-brand-500 text-4xl mb-6 bg-brand-50 h-16 w-16 rounded-full flex items-center justify-center">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Rapide et efficace</h3>
                        <p class="text-gray-600">
                            Obtenez des résultats en moins de 2 secondes pour commencer à cuisiner rapidement, sans
                            perdre de temps à chercher des recettes.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Recipes -->
    <section id="recettes" class="py-5 bg-gray-50 relative">
        <div class="max-w-7xl mx-auto">
            <div class="text-center">
                <h2 class="text-3xl font-display font-bold text-gray-900 sm:text-4xl">
                    Recettes <span class="text-brand-600">populaires</span>
                </h2>
                <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                    Découvrez les recettes les plus appréciées par notre communauté.
                </p>
            </div>

            <div class="mt-16 relative">
                <!-- Swiper container -->
                <div class="swiper-container recipe-swiper">
                    <div class="swiper-wrapper pb-5">
                        <!-- Recipe 1 -->
                        @foreach($recettes as $recette)
                        <div class="swiper-slide p-4">
                            <div class="card-hover bg-white rounded-xl shadow-lg overflow-hidden">
                                <div class="relative overflow-hidden h-48">
                                    <img src="{{ asset('storage/' . $recette->image) }}"
                                        alt="{{$recette->name}}"
                                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end">
                                        <div class="p-4 text-white">
                                            <div class="flex items-center text-sm">
                                                <i class="fas fa-clock mr-1"></i> {{$recette->prepTime}}
                                                <span class="mx-2">•</span>
                                                <span>{{$recette->difficulty}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="p-5">
                                    <h3 class="text-lg font-bold text-gray-900 mb-2">{{$recette->name}}</h3>
                                    {{-- <div class="flex items-center mb-4">
                                        <div class="flex text-accent-500">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </div>
                                        <span class="ml-1 text-sm text-gray-500">(4.5)</span>
                                    </div> --}}
                                    <div class="flex flex-wrap gap-1 mb-4">
                                        @foreach($recette->ingredients as $ingredient)
                                        <span
                                            class="bg-brand-50 text-brand-700 px-2 py-0.5 rounded-full text-xs">{{$ingredient->name}}</span>
                                        @endforeach
                                    </div>
                                    <button
                                        class="w-full bg-brand-600 text-white py-2 px-4 rounded-lg hover:bg-brand-700 transition-all duration-300 flex items-center justify-center">
                                        <i class="fas fa-eye mr-2"></i> Voir la recette
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
            </div>
        </div>

        <!-- Testimonials -->
        <section id="avis" class="py-5 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-display font-bold text-gray-900 sm:text-4xl">
                        Ce que nos <span class="text-brand-600">utilisateurs</span> disent
                    </h2>
                    <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                        Découvrez comment QuickCook transforme l'expérience culinaire de nos utilisateurs.
                    </p>
                </div>

                <div class="mt-2">
                    <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                        <!-- Testimonial 1 -->
                        <div class="card-hover bg-white rounded-xl shadow-lg p-8 border border-gray-100">
                            <div class="flex items-center mb-4">
                                <div class="flex text-accent-500">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span class="ml-2 text-sm text-gray-500">(5.0)</span>
                            </div>
                            <p class="text-gray-600 mb-6">
                                "QuickCook a complètement changé ma façon de cuisiner. Je ne jette plus rien et je
                                découvre de nouvelles recettes délicieuses chaque semaine. C'est vraiment une
                                application indispensable !"
                            </p>
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full"
                                        src="https://randomuser.me/api/portraits/women/42.jpg" alt="Sophie Martin">
                                </div>
                                <div class="ml-3">
                                    <h4 class="text-sm font-medium text-gray-900">Sophie Martin</h4>
                                    <p class="text-xs text-gray-500">Utilisatrice depuis 6 mois</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Footer -->
        <footer class="bg-dark text-white">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="col-span-1 md:col-span-2">
                        <span class="font-display font-bold text-2xl md:text-3xl">
                            <span class="text-brand-500">Quick</span><span class="text-accent-500">Cook</span>
                        </span>
                        <p class="mt-4 text-gray-300">
                            Cuisinez facilement avec les ingrédients que vous avez déjà chez vous. Réduisez le
                            gaspillage alimentaire et découvrez de nouvelles recettes délicieuses.
                        </p>
                        <div class="mt-6 flex space-x-6">
                            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Navigation</h3>
                        <ul class="mt-4 space-y-4">
                            <li><a href="{{route('home')}}"
                                    class="text-base text-gray-300 hover:text-white transition-colors duration-300">Accueil</a>
                            </li>
                            <li><a href="#Processus"
                                    class="text-base text-gray-300 hover:text-white transition-colors duration-300">Processus</a>
                            </li>
                            <li><a href="#Services"
                                    class="text-base text-gray-300 hover:text-white transition-colors duration-300">Services</a>
                            </li>
                            <li><a href="#Recettes"
                                    class="text-base text-gray-300 hover:text-white transition-colors duration-300">Recettes</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Légal</h3>
                        <ul class="mt-4 space-y-4">
                            <li><a href="#"
                                    class="text-base text-gray-300 hover:text-white transition-colors duration-300">Confidentialité</a>
                            </li>
                            <li><a href="#"
                                    class="text-base text-gray-300 hover:text-white transition-colors duration-300">Conditions
                                    d'utilisation</a></li>
                            <li><a href="#"
                                    class="text-base text-gray-300 hover:text-white transition-colors duration-300">Cookies</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mt-12 border-t border-gray-700 pt-8">
                    <p class="text-base text-gray-400 text-center">
                        &copy; 2023 QuickCook. Tous droits réservés.
                    </p>
                </div>
            </div>
        </footer>

        <!-- Login Modal -->
        <div id="loginModal" class="fixed inset-0 z-50 overflow-y-auto hidden">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div
                    class="inline-block align-bottom glass-dark rounded-2xl text-left overflow-hidden shadow-strong transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-bold text-white" id="modal-title">
                                    Connexion
                                </h3>
                                <div class="mt-2">
                                    <form id="loginForm" action="{{route('login')}}" method="POST" class="space-y-6">
                                        @csrf
                                        <div>
                                            <label for="email" class="block text-sm font-medium text-gray-300">
                                                Email
                                            </label>
                                            <div class="mt-1">
                                                <input id="email" name="email" type="email"
                                                    autocomplete="email" required
                                                    class="appearance-none block w-full px-3 py-2 bg-dark/50 border border-gray-600 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-brand-500 focus:border-brand-500 sm:text-sm text-white">
                                            </div>
                                        </div>

                                        <div>
                                            <label for="password" class="block text-sm font-medium text-gray-300">
                                                Mot de passe
                                            </label>
                                            <div class="mt-1">
                                                <input id="password" name="password" type="password"
                                                    autocomplete="current-password" required
                                                    class="appearance-none block w-full px-3 py-2 bg-dark/50 border border-gray-600 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-brand-500 focus:border-brand-500 sm:text-sm text-white">
                                            </div>
                                        </div>

                                        <div class="flex items-center justify-between">
                                            <div class="text-sm">
                                                <a href="#"
                                                    class="font-medium text-brand-400 hover:text-brand-300">
                                                    Mot de passe oublié?
                                                </a>
                                            </div>
                                        </div>

                                        <div>
                                            <button type="submit"
                                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-brand hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 transition-all duration-300">
                                                Se connecter
                                            </button>
                                        </div>
                                    </form>
                                    <div class="mt-6">
                                        <div class="relative">
                                            <div class="absolute inset-0 flex items-center">
                                                <div class="w-full border-t border-gray-600"></div>
                                            </div>
                                            <div class="relative flex justify-center text-sm">
                                                <span class="px-2 bg-dark text-gray-400">
                                                    Ou continuer avec
                                                </span>
                                            </div>
                                        </div>

                                        <div class="mt-6 grid grid-cols-3 gap-3">
                                            <div>
                                                <a href="#"
                                                    class="w-full inline-flex justify-center py-2 px-4 border border-gray-600 rounded-lg shadow-sm bg-dark/50 text-sm font-medium text-gray-400 hover:bg-dark/80 transition-all duration-300">
                                                    <i class="fab fa-google"></i>
                                                </a>
                                            </div>

                                            <div>
                                                <a href="#"
                                                    class="w-full inline-flex justify-center py-2 px-4 border border-gray-600 rounded-lg shadow-sm bg-dark/50 text-sm font-medium text-gray-400 hover:bg-dark/80 transition-all duration-300">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </div>

                                            <div>
                                                <a href="#"
                                                    class="w-full inline-flex justify-center py-2 px-4 border border-gray-600 rounded-lg shadow-sm bg-dark/50 text-sm font-medium text-gray-400 hover:bg-dark/80 transition-all duration-300">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-sm text-center mt-6">
                                        <p class="text-gray-400">
                                            Pas encore de compte?
                                            <button id="showRegisterForm"
                                                class="font-medium text-brand-400 hover:text-brand-300">
                                                S'inscrire
                                            </button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-dark/50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" id="closeLoginModal"
                            class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-600 shadow-sm px-4 py-2 bg-dark/50 text-base font-medium text-gray-300 hover:bg-dark/80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-all duration-300">
                            Fermer
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Register Modal -->
        <div id="registerModal" class="fixed inset-0 z-50 overflow-y-auto hidden">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div
                    class="inline-block align-bottom glass-dark rounded-2xl text-left overflow-hidden shadow-strong transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-bold text-white" id="modal-title">
                                    Inscription
                                </h3>
                                <div class="mt-2">
                                    <form id="registerForm" action="{{ route('register') }}" method="POST" class="space-y-6">
                                        @csrf
                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <label for="firstName"
                                                    class="block text-sm font-medium text-gray-300">
                                                    Prénom
                                                </label>
                                                <div class="mt-1">
                                                    <input id="firstName" name="firstName" type="text" required
                                                        class="appearance-none block w-full px-3 py-2 bg-dark/50 border border-gray-600 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-brand-500 focus:border-brand-500 sm:text-sm text-white">
                                                </div>
                                            </div>
                                            <div>
                                                <label for="lastName" class="block text-sm font-medium text-gray-300">
                                                    Nom
                                                </label>
                                                <div class="mt-1">
                                                    <input id="lastName" name="lastName" type="text" required
                                                        class="appearance-none block w-full px-3 py-2 bg-dark/50 border border-gray-600 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-brand-500 focus:border-brand-500 sm:text-sm text-white">
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <label for="registerEmail"
                                                class="block text-sm font-medium text-gray-300">
                                                Email
                                            </label>
                                            <div class="mt-1">
                                                <input id="registerEmail" name="email" type="email"
                                                    autocomplete="email" required
                                                    class="appearance-none block w-full px-3 py-2 bg-dark/50 border border-gray-600 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-brand-500 focus:border-brand-500 sm:text-sm text-white">
                                            </div>
                                        </div>

                                        <div>
                                            <label for="registerPassword"
                                                class="block text-sm font-medium text-gray-300">
                                                Mot de passe
                                            </label>
                                            <div class="mt-1">
                                                <input id="registerPassword" name="password" type="password" required
                                                    class="appearance-none block w-full px-3 py-2 bg-dark/50 border border-gray-600 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-brand-500 focus:border-brand-500 sm:text-sm text-white">
                                            </div>
                                        </div>


                                        <div class="flex items-center">
                                            <input id="terms" name="terms" type="checkbox" required
                                                class="h-4 w-4 text-brand-600 focus:ring-brand-500 border-gray-600 rounded bg-dark/50">
                                            <label for="terms" class="ml-2 block text-sm text-gray-300">
                                                J'accepte les <a href="#" class="text-brand-400">conditions
                                                    d'utilisation</a> et la <a href="#"
                                                    class="text-brand-400">politique de confidentialité</a>
                                            </label>
                                        </div>

                                        <div>
                                            <button type="submit"
                                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-brand hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 transition-all duration-300">
                                                S'inscrire
                                            </button>
                                        </div>
                                    </form>
                                    <div class="text-sm text-center mt-6">
                                        <p class="text-gray-400">
                                            Déjà inscrit?
                                            <button id="showLoginForm"
                                                class="font-medium text-brand-400 hover:text-brand-300">
                                                Se connecter
                                            </button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-dark/50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" id="closeRegisterModal"
                            class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-600 shadow-sm px-4 py-2 bg-dark/50 text-base font-medium text-gray-300 hover:bg-dark/80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-all duration-300">
                            Fermer
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <script>
            // Initialize Swiper
            const swiper = new Swiper('.recipe-swiper', {
                slidesPerView: 1,
                spaceBetween: 10,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                }
            });

            // Shrink navbar on scroll
            const navbar = document.getElementById('navbar');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    navbar.classList.add('h-16');
                    navbar.classList.remove('h-20');
                } else {
                    navbar.classList.add('h-20');
                    navbar.classList.remove('h-16');
                }
            });

            // Mobile menu toggle
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mobileMenu = document.getElementById('mobileMenu');
            const closeSidebarBtn = document.getElementById('closeSidebarBtn');

            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });

            // User menu toggle
            const userMenuBtn = document.getElementById('userMenuBtn');
            const userDropdown = document.getElementById('userDropdown');

            if (userMenuBtn) {
                userMenuBtn.addEventListener('click', () => {
                    userDropdown.classList.toggle('hidden');
                });
            }

            // Login modal
            const loginBtn = document.getElementById('loginBtn');
            const mobileLoginBtn = document.getElementById('mobileLoginBtn');
            const loginModal = document.getElementById('loginModal');
            const closeLoginModal = document.getElementById('closeLoginModal');
            const showRegisterForm = document.getElementById('showRegisterForm');
            const startBtn = document.getElementById('startBtn');

            startBtn.addEventListener('click', openLoginModal);

            function openLoginModal() {
                loginModal.classList.remove('hidden');
                registerModal.classList.add('hidden');
            }

            function closeLoginModalFn() {
                loginModal.classList.add('hidden');
            }

            loginBtn.addEventListener('click', openLoginModal);
            if (mobileLoginBtn) {
                mobileLoginBtn.addEventListener('click', openLoginModal);
            }
            closeLoginModal.addEventListener('click', closeLoginModalFn);

            // Register modal
            const registerModal = document.getElementById('registerModal');
            const closeRegisterModal = document.getElementById('closeRegisterModal');
            const showLoginForm = document.getElementById('showLoginForm');

            function openRegisterModal() {
                registerModal.classList.remove('hidden');
                loginModal.classList.add('hidden');
            }

            function closeRegisterModalFn() {
                registerModal.classList.add('hidden');
            }

            showRegisterForm.addEventListener('click', openRegisterModal);
            closeRegisterModal.addEventListener('click', closeRegisterModalFn);
            showLoginForm.addEventListener('click', openLoginModal);

            // Login form submission
            const loginForm = document.getElementById('loginForm');
           

            

            // Logout functionality
            const logoutBtn = document.getElementById('logoutBtn');
            const mobileLogoutBtn = document.getElementById('mobileLogoutBtn');

            function logout() {
                // In a real app, you would handle logout on the server
                document.getElementById('loginBtn').classList.remove('hidden');
                document.getElementById('userMenu').classList.add('hidden');

                if (document.getElementById('mobileLoginBtn')) {
                    document.getElementById('mobileLoginBtn').classList.remove('hidden');
                    document.getElementById('mobileUserLoggedIn').classList.add('hidden');
                }

                userDropdown.classList.add('hidden');
            }

            if (logoutBtn) {
                logoutBtn.addEventListener('click', logout);
            }

            if (mobileLogoutBtn) {
                mobileLogoutBtn.addEventListener('click', logout);
            }

            // Close dropdowns when clicking outside
            window.addEventListener('click', function(e) {
                if (userDropdown && !userDropdown.classList.contains('hidden') && !e.target.closest('#userMenuBtn')) {
                    userDropdown.classList.add('hidden');
                }
            });
        </script>
</body>

</html>
