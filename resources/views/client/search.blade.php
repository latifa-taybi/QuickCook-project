<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickCook - Trouvez des recettes avec vos ingrédients</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />
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
                        success: {
                            50: '#F0FFF4',
                            100: '#DCFCE7',
                            200: '#BBF7D0',
                            300: '#86EFAC',
                            400: '#4ADE80',
                            500: '#22C55E',
                            600: '#16A34A',
                            700: '#15803D',
                            800: '#166534',
                            900: '#14532D',
                        },
                        dark: '#121826',
                        light: '#F9FAFB'
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                        display: ['Clash Display', 'sans-serif'],
                        mono: ['Space Mono', 'monospace']
                    },
                    boxShadow: {
                        'glass': '0 8px 32px 0 rgba(31, 38, 135, 0.37)',
                        'neu': '20px 20px 60px #d9d9d9, -20px -20px 60px #ffffff',
                        'neu-dark': '20px 20px 60px #0f1420, -20px -20px 60px #151c2c'
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'float-slow': 'float 8s ease-in-out infinite',
                        'float-fast': 'float 4s ease-in-out infinite',
                        'pulse-slow': 'pulse 6s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'spin-slow': 'spin 8s linear infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        }
                    },
                    backgroundImage: {
                        'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
                        'gradient-conic': 'conic-gradient(from 180deg at 50% 50%, var(--tw-gradient-stops))',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap');
        @import url('https://api.fontshare.com/v2/css?f[]=clash-display@400;500;600;700&display=swap');
        
        html {
            scroll-behavior: smooth;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }
        
        .font-display {
            font-family: 'Clash Display', sans-serif;
        }
        
        .font-mono {
            font-family: 'Space Mono', monospace;
        }
        
        /* Glassmorphism */
        .glass {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        
        .glass-dark {
            background: rgba(18, 24, 38, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        
        /* Neumorphism */
        .neu-shadow {
            box-shadow: 12px 12px 24px #d1d5db, -12px -12px 24px #ffffff;
        }
        
        .neu-shadow-dark {
            box-shadow: 8px 8px 16px #0a0e17, -8px -8px 16px #1a2235;
        }
        
        .neu-inset {
            box-shadow: inset 5px 5px 10px #d1d5db, inset -5px -5px 10px #ffffff;
        }
        
        /* Custom animations */
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-20px);
            }
        }
        
        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }
        
        .rotate-animation {
            animation: rotate 20s linear infinite;
        }
        
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        .float-animation-slow {
            animation: float 8s ease-in-out infinite;
        }
        
        .float-animation-fast {
            animation: float 4s ease-in-out infinite;
        }
        
        /* Gradient text */
        .text-gradient {
            background: linear-gradient(90deg, #00AAFF 0%, #FF9800 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            color: transparent;
        }
        
        /* Gradient backgrounds */
        .bg-gradient-brand {
            background: linear-gradient(135deg, #00AAFF 0%, #0099E6 100%);
        }
        
        .bg-gradient-accent {
            background: linear-gradient(135deg, #FF9800 0%, #F57C00 100%);
        }
        
        .bg-gradient-mix {
            background: linear-gradient(135deg, #00AAFF 0%, #FF9800 100%);
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #00AAFF;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #0099E6;
        }
        
        /* Ingredient tag */
        .ingredient-tag {
            transition: all 0.3s ease;
        }
        
        .ingredient-tag:hover {
            transform: translateY(-2px);
        }
        
        /* Recipe card */
        .recipe-card {
            transition: all 0.3s ease;
        }
        
        .recipe-card:hover {
            transform: translateY(-5px);
        }
        
        .recipe-image {
            transition: all 0.5s ease;
        }
        
        .recipe-card:hover .recipe-image {
            transform: scale(1.05);
        }
        
        /* Animated button */
        .btn-animated {
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .btn-animated::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.2) 50%, rgba(255,255,255,0) 100%);
            transition: all 0.6s ease;
            z-index: -1;
        }
        
        .btn-animated:hover::before {
            left: 100%;
        }
        
        /* 3D Card effect */
        .card-3d {
            transform-style: preserve-3d;
            transition: all 0.5s ease;
        }
        
        .card-3d:hover {
            transform: rotateY(5deg) rotateX(5deg);
        }
        
        .card-3d::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
            z-index: 2;
            transition: all 0.5s ease;
            opacity: 0;
            border-radius: inherit;
        }
        
        .card-3d:hover::before {
            opacity: 1;
        }
        
        /* Pulse animation */
        .pulse-animation {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }
        
        /* Shimmer effect */
        .shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }
        
        @keyframes shimmer {
            0% {
                background-position: -200% 0;
            }
            100% {
                background-position: 200% 0;
            }
        }
        
        /* Drag and drop area */
        .drag-area {
            border: 2px dashed #00AAFF;
            transition: all 0.3s ease;
        }
        
        .drag-area.active {
            border-color: #FF9800;
            background-color: rgba(255, 152, 0, 0.05);
        }
        
        /* Custom checkbox */
        .custom-checkbox {
            position: relative;
            padding-left: 35px;
            cursor: pointer;
            user-select: none;
        }
        
        .custom-checkbox input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }
        
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #eee;
            border-radius: 4px;
            transition: all 0.3s ease;
        }
        
        .custom-checkbox:hover input ~ .checkmark {
            background-color: #ccc;
        }
        
        .custom-checkbox input:checked ~ .checkmark {
            background-color: #00AAFF;
        }
        
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }
        
        .custom-checkbox input:checked ~ .checkmark:after {
            display: block;
        }
        
        .custom-checkbox .checkmark:after {
            left: 9px;
            top: 5px;
            width: 7px;
            height: 12px;
            border: solid white;
            border-width: 0 3px 3px 0;
            transform: rotate(45deg);
        }
    </style>
</head>
<body class="bg-light text-dark min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="bg-white/95 backdrop-blur-md shadow-md sticky top-0 z-50 transition-all duration-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <span class="font-display font-bold text-2xl md:text-3xl">
                            <span class="text-brand-500">Quick</span><span class="text-accent-500">Cook</span>
                        </span>
                    </div>
                    <div class="hidden md:ml-10 md:flex md:space-x-8">
                        <a href="index.html" class="text-dark inline-flex items-center px-1 pt-1 text-sm font-medium">
                            Accueil
                        </a>
                        <a href="#" class="text-brand-500 border-b-2 border-brand-500 inline-flex items-center px-1 pt-1 text-sm font-medium">
                            Ingrédients
                        </a>
                        <a href="#" class="text-dark inline-flex items-center px-1 pt-1 text-sm font-medium">
                            Recettes
                        </a>
                    </div>
                </div>
                <div class="hidden md:ml-6 md:flex md:items-center">
                    <div class="ml-3 relative">
                        <button id="loginBtn" class="group glass px-3 py-1.5 rounded-full text-dark hover:bg-brand-500 hover:text-white transition-all duration-300 flex items-center">
                            <i class="fas fa-user-circle mr-2"></i>
                            <span>Connexion</span>
                        </button>
                    </div>
                    <a href="dashboard.html" class="ml-6 btn-animated glass bg-gradient-brand text-white px-6 py-2 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 flex items-center">
                        <span>Tableau de bord</span>
                        <i class="fas fa-chart-bar ml-2"></i>
                    </a>
                </div>
                <div class="-mr-2 flex items-center md:hidden">
                    <button id="mobileMenuBtn" class="glass inline-flex items-center justify-center p-2 rounded-full text-dark hover:bg-brand-500 hover:text-white focus:outline-none transition-all duration-300">
                        <span class="sr-only">Ouvrir le menu</span>
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div class="md:hidden hidden glass-dark absolute w-full" id="mobileMenu">
            <div class="pt-2 pb-3 space-y-1">
                <a href="index.html" class="text-gray-300 hover:text-white block pl-3 pr-4 py-2 text-base font-medium border-l-4 border-transparent hover:border-accent-300">
                    Accueil
                </a>
                <a href="#" class="text-white block pl-3 pr-4 py-2 text-base font-medium border-l-4 border-accent-500">
                    Ingrédients
                </a>
                <a href="#" class="text-gray-300 hover:text-white block pl-3 pr-4 py-2 text-base font-medium border-l-4 border-transparent hover:border-accent-300">
                    Recettes
                </a>
            </div>
            <div class="pt-4 pb-3 border-t border-gray-700">
                <div class="flex items-center px-4">
                    <button id="mobileLoginBtn" class="flex-shrink-0 text-white hover:text-accent-300 transition-colors duration-300">
                        <i class="fas fa-user-circle mr-2"></i> Se connecter
                    </button>
                </div>
                <div class="mt-3 px-4">
                    <a href="dashboard.html" class="block text-center w-full bg-gradient-accent text-white px-4 py-2 rounded-full shadow-lg hover:shadow-xl transition-all duration-300">
                        Tableau de bord
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow">
        <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
            <!-- Page header -->
            <div class="mb-12" data-aos="fade-up" data-aos-duration="1000">
                <h1 class="text-4xl font-display font-bold text-dark">Trouvez des <span class="text-gradient">recettes</span> avec vos ingrédients</h1>
                <p class="mt-4 text-xl text-gray-600 max-w-3xl">
                    Saisissez les ingrédients que vous avez à disposition et notre IA trouvera les meilleures recettes adaptées à votre cuisine.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Ingredients section -->
                <div class="col-span-1 card-3d bg-white rounded-2xl shadow-lg p-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                    <h2 class="text-2xl font-display font-bold text-dark mb-6 flex items-center">
                        <span class="w-10 h-10 rounded-full bg-gradient-brand text-white flex items-center justify-center mr-3">
                            <i class="fas fa-carrot"></i>
                        </span>
                        Vos ingrédients
                    </h2>
                    
                    <!-- Ingredient search -->
                    <div class="relative mb-6">
                        <input type="text" id="ingredientInput" placeholder="Ajouter un ingrédient..." class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all duration-300">
                        <button id="addIngredientBtn" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-brand-500 hover:text-brand-700 transition-colors duration-300">
                            <i class="fas fa-plus-circle text-xl"></i>
                        </button>
                    </div>
                    
                    <!-- Drag and drop area -->
                    <div class="drag-area rounded-xl p-4 mb-6 text-center" id="dragArea">
                        <i class="fas fa-cloud-upload-alt text-3xl text-brand-400 mb-2"></i>
                        <p class="text-gray-500 text-sm">Glissez et déposez une photo de votre frigo</p>
                        <p class="text-gray-400 text-xs mt-1">Notre IA détectera automatiquement vos ingrédients</p>
                    </div>
                    
                    <!-- Popular ingredients -->
                    <div class="mb-6">
                        <h3 class="text-sm font-medium text-gray-500 mb-3 flex items-center">
                            <i class="fas fa-fire-alt text-accent-500 mr-2"></i>
                            Ingrédients populaires
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            <span class="ingredient-tag bg-brand-50 text-brand-700 px-3 py-1.5 rounded-full text-sm cursor-pointer hover:bg-brand-100 transition-colors duration-300 flex items-center">
                                <i class="fas fa-drumstick-bite mr-1.5 text-brand-500"></i>Poulet
                            </span>
                            <span class="ingredient-tag bg-brand-50 text-brand-700 px-3 py-1.5 rounded-full text-sm cursor-pointer hover:bg-brand-100 transition-colors duration-300 flex items-center">
                                <i class="fas fa-apple-alt mr-1.5 text-brand-500"></i>Tomate
                            </span>
                            <span class="ingredient-tag bg-brand-50 text-brand-700 px-3 py-1.5 rounded-full text-sm cursor-pointer hover:bg-brand-100 transition-colors duration-300 flex items-center">
                                <i class="fas fa-seedling mr-1.5 text-brand-500"></i>Oignon
                            </span>
                            <span class="ingredient-tag bg-brand-50 text-brand-700 px-3 py-1.5 rounded-full text-sm cursor-pointer hover:bg-brand-100 transition-colors duration-300 flex items-center">
                                <i class="fas fa-seedling mr-1.5 text-brand-500"></i>Riz
                            </span>
                            <span class="ingredient-tag bg-brand-50 text-brand-700 px-3 py-1.5 rounded-full text-sm cursor-pointer hover:bg-brand-100 transition-colors duration-300 flex items-center">
                                <i class="fas fa-seedling mr-1.5 text-brand-500"></i>Ail
                            </span>
                            <span class="ingredient-tag bg-brand-50 text-brand-700 px-3 py-1.5 rounded-full text-sm cursor-pointer hover:bg-brand-100 transition-colors duration-300 flex items-center">
                                <i class="fas fa-drumstick-bite mr-1.5 text-brand-500"></i>Bœuf
                            </span>
                            <span class="ingredient-tag bg-brand-50 text-brand-700 px-3 py-1.5 rounded-full text-sm cursor-pointer hover:bg-brand-100 transition-colors duration-300 flex items-center">
                                <i class="fas fa-carrot mr-1.5 text-brand-500"></i>Carotte
                            </span>
                            <span class="ingredient-tag bg-brand-50 text-brand-700 px-3 py-1.5 rounded-full text-sm cursor-pointer hover:bg-brand-100 transition-colors duration-300 flex items-center">
                                <i class="fas fa-pepper-hot mr-1.5 text-brand-500"></i>Poivron
                            </span>
                        </div>
                    </div>
                    
                    <!-- Selected ingredients -->
                    <div class="mb-6">
                        <h3 class="text-sm font-medium text-gray-500 mb-3 flex items-center">
                            <i class="fas fa-check-circle text-success-500 mr-2"></i>
                            Ingrédients sélectionnés
                        </h3>
                        <div id="selectedIngredients" class="flex flex-wrap gap-2 min-h-[100px] border border-dashed border-gray-300 rounded-xl p-4 bg-gray-50">
                            <!-- Selected ingredients will be added here dynamically -->
                            <div class="flex items-center w-full h-full justify-center text-gray-400 text-sm" id="emptyIngredientsMessage">
                                <i class="fas fa-info-circle mr-2"></i> Ajoutez des ingrédients pour commencer
                            </div>
                        </div>
                    </div>
                    
                    <!-- Find recipes button -->
                    <button id="findRecipesBtn" class="w-full btn-animated bg-gradient-brand text-white py-3 px-4 rounded-xl hover:shadow-lg transition-all duration-300 flex items-center justify-center font-medium">
                        <i class="fas fa-search mr-2"></i> Trouver des recettes
                    </button>
                </div>
                
                <!-- Recipes section -->
                <div class="col-span-1 lg:col-span-2">
                    <!-- Filters -->
                    <div class="card-3d bg-white rounded-2xl shadow-lg p-6 mb-8" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                        <h2 class="text-2xl font-display font-bold text-dark mb-6 flex items-center">
                            <span class="w-10 h-10 rounded-full bg-gradient-accent text-white flex items-center justify-center mr-3">
                                <i class="fas fa-filter"></i>
                            </span>
                            Filtres avancés
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Meal type filter -->
                            <div>
                                <label for="mealType" class="block text-sm font-medium text-gray-700 mb-2">Type de plat</label>
                                <div class="relative">
                                    <select id="mealType" class="w-full px-4 py-3 border border-gray-300 rounded-xl appearance-none focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all duration-300">
                                        <option value="">Tous les types</option>
                                        <option value="entree">Entrée</option>
                                        <option value="plat">Plat principal</option>
                                        <option value="dessert">Dessert</option>
                                        <option value="snack">Snack</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Preparation time filter -->
                            <div>
                                <label for="prepTime" class="block text-sm font-medium text-gray-700 mb-2">Temps de préparation</label>
                                <div class="relative">
                                    <select id="prepTime" class="w-full px-4 py-3 border border-gray-300 rounded-xl appearance-none focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all duration-300">
                                        <option value="">Tous les temps</option>
                                        <option value="15">Moins de 15 min</option>
                                        <option value="30">Moins de 30 min</option>
                                        <option value="60">Moins de 1h</option>
                                        <option value="120">Moins de 2h</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Diet filter -->
                            <div>
                                <label for="diet" class="block text-sm font-medium text-gray-700 mb-2">Régime alimentaire</label>
                                <div class="relative">
                                    <select id="diet" class="w-full px-4 py-3 border border-gray-300 rounded-xl appearance-none focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all duration-300">
                                        <option value="">Tous les régimes</option>
                                        <option value="vegetarian">Végétarien</option>
                                        <option value="vegan">Végétalien</option>
                                        <option value="glutenFree">Sans gluten</option>
                                        <option value="dairyFree">Sans lactose</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Advanced filters toggle -->
                        <div class="mt-6">
                            <button id="advancedFiltersToggle" class="text-brand-500 hover:text-brand-700 text-sm font-medium flex items-center">
                                <i class="fas fa-sliders-h mr-2"></i>
                                Filtres supplémentaires
                                <i class="fas fa-chevron-down ml-2 transition-transform duration-300"></i>
                            </button>
                            
                            <div id="advancedFiltersPanel" class="hidden mt-4 pt-4 border-t border-gray-200">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Difficulty filter -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Niveau de difficulté</label>
                                        <div class="flex flex-wrap gap-3">
                                            <label class="custom-checkbox">
                                                Facile
                                                <input type="checkbox" checked="checked">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="custom-checkbox">
                                                Moyen
                                                <input type="checkbox" checked="checked">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="custom-checkbox">
                                                Difficile
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <!-- Cuisine type filter -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Type de cuisine</label>
                                        <div class="flex flex-wrap gap-3">
                                            <label class="custom-checkbox">
                                                Française
                                                <input type="checkbox" checked="checked">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="custom-checkbox">
                                                Italienne
                                                <input type="checkbox" checked="checked">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="custom-checkbox">
                                                Asiatique
                                                <input type="checkbox" checked="checked">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="custom-checkbox">
                                                Mexicaine
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Recipe results -->
                    <div id="recipeResults" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Recipe cards will be added here dynamically -->
                    </div>
                    
                    <!-- Empty state -->
                    <div id="emptyState" class="card-3d bg-white rounded-2xl shadow-lg p-10 text-center" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                        <div class="relative w-32 h-32 mx-auto">
                            <div class="absolute inset-0 bg-gradient-radial from-brand-200 to-transparent rounded-full"></div>
                            <img src="https://cdn-icons-png.flaticon.com/512/1147/1147805.png" alt="Empty state" class="w-full h-full relative z-10 opacity-50">
                        </div>
                        <h3 class="mt-6 text-2xl font-display font-bold text-dark">Aucune recette trouvée</h3>
                        <p class="mt-3 text-gray-500 max-w-md mx-auto">
                            Ajoutez des ingrédients et cliquez sur "Trouver des recettes" pour découvrir des plats délicieux adaptés à ce que vous avez dans votre cuisine.
                        </p>
                        <button class="mt-6 btn-animated bg-gradient-accent text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center mx-auto">
                            <i class="fas fa-lightbulb mr-2"></i> Suggestions d'ingrédients
                        </button>
                    </div>
                    
                    <!-- Loading state -->
                    <div id="loadingState" class="hidden card-3d bg-white rounded-2xl shadow-lg p-10 text-center">
                        <div class="flex flex-col items-center">
                            <div class="relative">
                                <div class="w-20 h-20 border-4 border-brand-200 border-t-brand-500 rounded-full animate-spin"></div>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <i class="fas fa-utensils text-brand-500 animate-pulse"></i>
                                </div>
                            </div>
                            <p class="mt-6 text-xl font-display font-medium text-dark">Recherche de recettes en cours...</p>
                            <p class="mt-2 text-gray-500">Notre IA trouve les meilleures recettes pour vos ingrédients</p>
                            
                            <!-- Loading progress -->
                            <div class="w-full max-w-md mt-6 bg-gray-200 rounded-full h-2.5">
                                <div class="bg-gradient-brand h-2.5 rounded-full animate-pulse" style="width: 70%"></div>
                            </div>
                            <p class="mt-2 text-sm text-gray-400 font-mono">Analyse des combinaisons de saveurs...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Recipe Modal -->
    <div id="recipeModal" class="fixed inset-0 z-50 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom glass-dark rounded-2xl text-left overflow-hidden shadow-strong transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
                <div id="recipeModalContent" class="p-6">
                    <!-- Recipe details will be added here dynamically -->
                </div>
                <div class="bg-dark/50 px-6 py-4 sm:flex sm:flex-row-reverse">
                    <button type="button" id="closeRecipeModal" class="w-full inline-flex justify-center rounded-xl border border-gray-600 shadow-sm px-4 py-2 bg-dark/50 text-base font-medium text-gray-300 hover:bg-dark/80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-all duration-300">
                        Fermer
                    </button>
                    <button type="button" id="saveRecipeBtn" class="mt-3 w-full btn-animated inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-gradient-brand text-base font-medium text-white hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-all duration-300">
                        <i class="fas fa-heart mr-2"></i> Sauvegarder
                    </button>
                    <button type="button" id="printRecipeBtn" class="mt-3 w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-accent-600 text-base font-medium text-white hover:bg-accent-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-all duration-300">
                        <i class="fas fa-print mr-2"></i> Imprimer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white mt-auto">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <span class="font-display font-bold text-2xl md:text-3xl">
                        <span class="text-brand-500">Quick</span><span class="text-accent-500">Cook</span>
                    </span>
                    <p class="mt-4 text-gray-300">
                        Cuisinez facilement avec les ingrédients que vous avez déjà chez vous. Réduisez le gaspillage alimentaire et découvrez de nouvelles recettes délicieuses.
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
                        <li><a href="index.html" class="text-base text-gray-300 hover:text-white transition-colors duration-300">Accueil</a></li>
                        <li><a href="ingredients.html" class="text-base text-gray-300 hover:text-white transition-colors duration-300">Ingrédients</a></li>
                        <li><a href="#" class="text-base text-gray-300 hover:text-white transition-colors duration-300">Recettes</a></li>
                        <li><a href="#" class="text-base text-gray-300 hover:text-white transition-colors duration-300">À propos</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Légal</h3>
                    <ul class="mt-4 space-y-4">
                        <li><a href="#" class="text-base text-gray-300 hover:text-white transition-colors duration-300">Confidentialité</a></li>
                        <li><a href="#" class="text-base text-gray-300 hover:text-white transition-colors duration-300">Conditions d'utilisation</a></li>
                        <li><a href="#" class="text-base text-gray-300 hover:text-white transition-colors duration-300">Cookies</a></li>
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
            <div class="inline-block align-bottom glass-dark rounded-2xl text-left overflow-hidden shadow-strong transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-display font-bold text-white" id="modal-title">
                                Connexion
                            </h3>
                            <div class="mt-2">
                                <form id="loginForm" class="space-y-6">
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-300">
                                            Email
                                        </label>
                                        <div class="mt-1">
                                            <input id="email" name="email" type="email" autocomplete="email" required class="appearance-none block w-full px-3 py-2 bg-dark/50 border border-gray-600 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-brand-500 focus:border-brand-500 sm:text-sm text-white">
                                        </div>
                                    </div>

                                    <div>
                                        <label for="password" class="block text-sm font-medium text-gray-300">
                                            Mot de passe
                                        </label>
                                        <div class="mt-1">
                                            <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none block w-full px-3 py-2 bg-dark/50 border border-gray-600 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-brand-500 focus:border-brand-500 sm:text-sm text-white">
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-brand-600 focus:ring-brand-500 border-gray-600 rounded bg-dark/50">
                                            <label for="remember-me" class="ml-2 block text-sm text-gray-300">
                                                Se souvenir de moi
                                            </label>
                                        </div>

                                        <div class="text-sm">
                                            <a href="#" class="font-medium text-brand-400 hover:text-brand-300">
                                                Mot de passe oublié?
                                            </a>
                                        </div>
                                    </div>

                                    <div>
                                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-brand hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 transition-all duration-300">
                                            Se connecter
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-dark/50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" id="closeLoginModal" class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-600 shadow-sm px-4 py-2 bg-dark/50 text-base font-medium text-gray-300 hover:bg-dark/80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-all duration-300">
                        Fermer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            once: false,
            disable: 'mobile'
        });
        
    </script>
</body>
</html>

