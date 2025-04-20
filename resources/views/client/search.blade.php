<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QuickCook - Trouvez des recettes avec vos ingrédients</title>
  
  <!-- Tailwind CSS CDN -->
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
              '0%, 100%': { transform: 'translateY(0)' },
              '50%': { transform: 'translateY(-10px)' },
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
  
  <!-- Custom Styles -->
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    @import url('https://api.fontshare.com/v2/css?f[]=clash-display@400;500;600;700&display=swap');
    
    html {
      scroll-behavior: smooth;
      scroll-padding-top: 5rem;
    }
    
    body {
      font-family: 'Poppins', sans-serif;
      overflow-x: hidden;
    }
    
    .font-display {
      font-family: 'Clash Display', serif;
    }
    
    .clip-path-slant {
      clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
    }
    
    .clip-path-wave {
      clip-path: polygon(0% 0%, 100% 0%, 100% 85%, 75% 90%, 50% 85%, 25% 90%, 0% 85%);
    }
    
    .bg-blur {
      backdrop-filter: blur(8px);
    }
    
    .text-shadow {
      text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .card-hover {
      transition: all 0.3s ease;
    }
    
    .card-hover:hover {
      transform: translateY(-8px);
    }
    
    .ingredient-tag {
      transition: all 0.3s ease;
    }
    
    .ingredient-tag:hover {
      transform: translateY(-3px) scale(1.05);
    }
    
    .btn-hover {
      position: relative;
      overflow: hidden;
      z-index: 1;
    }
    
    .btn-hover::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(255, 255, 255, 0.2);
      transform: scaleX(0);
      transform-origin: right;
      transition: transform 0.5s ease;
      z-index: -1;
    }
    
    .btn-hover:hover::after {
      transform: scaleX(1);
      transform-origin: left;
    }
    
    .hero-mask {
      mask-image: linear-gradient(to bottom, rgba(0,0,0,1) 80%, rgba(0,0,0,0));
      -webkit-mask-image: linear-gradient(to bottom, rgba(0,0,0,1) 80%, rgba(0,0,0,0));
    }
    
    .menu-item {
      position: relative;
    }
    
    .menu-item::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 0;
      height: 2px;
      background: linear-gradient(90deg, #00AAFF 0%, #FF9800 100%);
      transition: width 0.3s ease;
    }
    
    .menu-item:hover::after,
    .menu-item.active::after {
      width: 100%;
    }
    
    .circle-bg {
      position: absolute;
      border-radius: 50%;
      background: rgba(0, 170, 255, 0.1);
      z-index: -1;
    }
    
    .grain-overlay {
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      width: 100%;
      pointer-events: none;
      z-index: 100;
      opacity: 0.03;
      background-image: url('data:image/png;base64,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');
    }

    .shadow-strong {
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
    }

    .bg-gradient-brand {
      background: linear-gradient(135deg, #00AAFF 0%, #0099E6 100%);
    }

    .bg-gradient-accent {
      background: linear-gradient(135deg, #FF9800 0%, #F57C00 100%);
    }

    .bg-gradient-mix {
      background: linear-gradient(135deg, #00AAFF 0%, #FF9800 100%);
    }

    .text-gradient {
      background: linear-gradient(90deg, #00AAFF 0%, #FF9800 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      color: transparent;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    .fade-in {
      animation: fadeIn 0.5s ease forwards;
    }
    
    .fade-in-delay-1 {
      animation: fadeIn 0.5s ease 0.1s forwards;
      opacity: 0;
    }
    
    .fade-in-delay-2 {
      animation: fadeIn 0.5s ease 0.2s forwards;
      opacity: 0;
    }
    
    .fade-in-delay-3 {
      animation: fadeIn 0.5s ease 0.3s forwards;
      opacity: 0;
    }
  </style>
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
          <button id="add-recipe-btn" class="hidden md:flex items-center gap-2 bg-gradient-brand text-white py-2 px-4 rounded-lg shadow-sm hover:shadow transition btn-hover">
            <i class="fas fa-plus"></i>
            <span>Ajouter une recette</span>
          </button>
          
          <div class="relative group">
            <button id="profile-btn" class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-200 hover:bg-gray-300 transition">
              <i class="fas fa-user text-gray-600"></i>
            </button>
            
            <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 hidden group-hover:block">
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
        <button class="flex items-center gap-2 w-full bg-gradient-brand text-white py-2 px-4 rounded-lg shadow-sm hover:shadow transition btn-hover">
          <i class="fas fa-plus"></i>
          <span>Ajouter une recette</span>
        </button>
      </div>
    </div>
  </header>

  <!-- Search Section -->
  <section id="search-section" class="py-16 container mx-auto px-4 relative mt-5">
    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-strong p-6 md:p-8 fade-in">
      <div class="text-center mb-8 fade-in">
        <h2 class="font-display font-bold text-3xl md:text-4xl text-dark mb-4">
          Quels <span class="text-gradient">ingrédients</span> avez-vous?
        </h2>
        <p class="text-gray-600">
          Entrez les ingrédients que vous avez dans votre cuisine et nous vous proposerons des recettes adaptées.
        </p>
      </div>
      
      <div class="flex flex-col md:flex-row gap-4 mb-6">
        <div class="flex-1 relative">
          <input type="text" placeholder="Entrez un ingrédient (ex: tomate, poulet, riz...)" class="w-full pl-12 pr-4 py-4 rounded-lg border border-gray-200 focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition">
          <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
        </div>
        <button class="bg-gradient-brand text-white font-semibold py-4 px-6 rounded-lg shadow-md hover:shadow-lg transition btn-hover">
          Ajouter
        </button>
      </div>
      
      <div class="mb-8">
        <div class="text-sm text-gray-500 mb-3">Ingrédients sélectionnés:</div>
        <div class="flex flex-wrap gap-2">
          <span class="ingredient-tag bg-brand-100 text-brand-700 px-3 py-1.5 rounded-full flex items-center">
            Tomates
            <i class="fas fa-times ml-2 cursor-pointer hover:text-brand-900"></i>
          </span>
          <span class="ingredient-tag bg-brand-100 text-brand-700 px-3 py-1.5 rounded-full flex items-center">
            Oignons
            <i class="fas fa-times ml-2 cursor-pointer hover:text-brand-900"></i>
          </span>
          <span class="ingredient-tag bg-brand-100 text-brand-700 px-3 py-1.5 rounded-full flex items-center">
            Ail
            <i class="fas fa-times ml-2 cursor-pointer hover:text-brand-900"></i>
          </span>
          <span class="ingredient-tag bg-brand-100 text-brand-700 px-3 py-1.5 rounded-full flex items-center">
            Basilic
            <i class="fas fa-times ml-2 cursor-pointer hover:text-brand-900"></i>
          </span>
          <span class="ingredient-tag bg-brand-100 text-brand-700 px-3 py-1.5 rounded-full flex items-center">
            Mozzarella
            <i class="fas fa-times ml-2 cursor-pointer hover:text-brand-900"></i>
          </span>
        </div>
      </div>
      
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="flex items-center gap-2">
          <span class="text-sm text-gray-600 whitespace-nowrap">Temps:</span>
          <select class="flex-1 px-3 py-2 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition">
            <option>Tous</option>
            <option>Moins de 15 min</option>
            <option>Moins de 30 min</option>
            <option>Moins de 60 min</option>
          </select>
        </div>
        
        <div class="flex items-center gap-2">
          <span class="text-sm text-gray-600 whitespace-nowrap">Type:</span>
          <select class="flex-1 px-3 py-2 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition">
            <option>Tous</option>
            <option>Entrée</option>
            <option>Plat principal</option>
            <option>Dessert</option>
          </select>
        </div>
        
        <div class="flex items-center gap-2">
          <span class="text-sm text-gray-600 whitespace-nowrap">Régime:</span>
          <select class="flex-1 px-3 py-2 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition">
            <option>Tous</option>
            <option>Végétarien</option>
            <option>Végan</option>
            <option>Sans gluten</option>
          </select>
        </div>
      </div>
      
      <button class="w-full bg-gradient-brand text-white font-semibold py-4 px-6 rounded-lg shadow-md hover:shadow-lg transition btn-hover">
        <i class="fas fa-utensils mr-2"></i> Rechercher des Recettes
      </button>
    </div>
  </section>
  
  <!-- Results Section -->
  <section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
      <div class="flex justify-between items-center mb-8 fade-in">
        <h2 class="font-display font-semibold text-2xl md:text-3xl text-dark">
          Résultats <span class="text-brand-500">(12 recettes)</span>
        </h2>
        <div class="flex items-center gap-2">
          <button class="flex items-center gap-1 bg-white text-gray-700 py-2 px-4 rounded-lg shadow-sm hover:shadow transition">
            <i class="fas fa-heart text-accent-500"></i>
            <span class="hidden sm:inline">Favoris</span>
          </button>
          <button class="flex items-center gap-1 bg-white text-gray-700 py-2 px-4 rounded-lg shadow-sm hover:shadow transition">
            <i class="fas fa-sort-amount-down text-brand-500"></i>
            <span class="hidden sm:inline">Trier par</span>
          </button>
        </div>
      </div>
      
      <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <!-- Recipe Card 1 -->
        <div class="bg-white rounded-2xl shadow-md overflow-hidden card-hover fade-in-delay-1">
          <div class="relative">
            <img src="https://images.unsplash.com/photo-1514-1513185527?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="Pizza Margherita" class="w-full h-48 object-cover">
            <div class="absolute top-3 right-3">
              <button class="bg-white bg-opacity-90 p-2 rounded-full shadow-md hover:bg-accent-100 hover:text-accent-600 transition">
                <i class="fas fa-heart text-gray-400 hover:text-accent-500"></i>
              </button>
            </div>
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-dark to-transparent p-4">
              <span class="text-xs text-white bg-brand-500 py-1 px-2 rounded-full">Italien</span>
            </div>
          </div>
          <div class="p-5">
            <h3 class="font-display font-semibold text-xl mb-2">Pizza Margherita</h3>
            <div class="flex items-center text-sm text-gray-500 mb-3">
              <i class="fas fa-clock mr-1"></i>
              <span class="mr-4">25 min</span>
              <i class="fas fa-utensils mr-1"></i>
              <span>Facile</span>
            </div>
            <p class="text-gray-600 text-sm mb-4">Une délicieuse pizza traditionnelle avec tomate, mozzarella et basilic.</p>
            <div class="flex justify-between items-center">
              <div class="flex -space-x-2">
                <img src="https://randomuser.me/api/portraits/women/32.jpg" class="w-8 h-8 rounded-full border-2 border-white" alt="User">
                <img src="https://randomuser.me/api/portraits/men/75.jpg" class="w-8 h-8 rounded-full border-2 border-white" alt="User">
              </div>
              <a href="#" class="text-brand-500 hover:text-brand-700 font-medium text-sm">Voir la recette</a>
            </div>
          </div>
        </div>
        
        <!-- Recipe Card 2 -->
        <div class="bg-white rounded-2xl shadow-md overflow-hidden card-hover fade-in-delay-2">
          <div class="relative">
            <img src="https://images.unsplash.com/photo-1547592180-85f173990554?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="Salade César" class="w-full h-48 object-cover">
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
            <h3 class="font-display font-semibold text-xl mb-2">Salade César</h3>
            <div class="flex items-center text-sm text-gray-500 mb-3">
              <i class="fas fa-clock mr-1"></i>
              <span class="mr-4">15 min</span>
              <i class="fas fa-utensils mr-1"></i>
              <span>Facile</span>
            </div>
            <p class="text-gray-600 text-sm mb-4">Une salade fraîche avec poulet grillé, croûtons et sauce césar maison.</p>
            <div class="flex justify-between items-center">
              <div class="flex -space-x-2">
                <img src="https://randomuser.me/api/portraits/men/22.jpg" class="w-8 h-8 rounded-full border-2 border-white" alt="User">
              </div>
              <a href="#" class="text-brand-500 hover:text-brand-700 font-medium text-sm">Voir la recette</a>
            </div>
          </div>
        </div>
        
        <!-- Recipe Card 3 -->
        <div class="bg-white rounded-2xl shadow-md overflow-hidden card-hover fade-in-delay-3">
          <div class="relative">
            <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="Bowl végétarien" class="w-full h-48 object-cover">
            <div class="absolute top-3 right-3">
              <button class="bg-white bg-opacity-90 p-2 rounded-full shadow-md hover:bg-accent-100 hover:text-accent-600 transition">
                <i class="fas fa-heart text-gray-400 hover:text-accent-500"></i>
              </button>
            </div>
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-dark to-transparent p-4">
              <span class="text-xs text-white bg-accent-500 py-1 px-2 rounded-full">Végétarien</span>
            </div>
          </div>
          <div class="p-5">
            <h3 class="font-display font-semibold text-xl mb-2">Bowl végétarien</h3>
            <div class="flex items-center text-sm text-gray-500 mb-3">
              <i class="fas fa-clock mr-1"></i>
              <span class="mr-4">20 min</span>
              <i class="fas fa-utensils mr-1"></i>
              <span>Moyen</span>
            </div>
            <p class="text-gray-600 text-sm mb-4">Un bowl coloré avec quinoa, avocat, légumes rôtis et sauce tahini.</p>
            <div class="flex justify-between items-center">
              <div class="flex -space-x-2">
                <img src="https://randomuser.me/api/portraits/women/65.jpg" class="w-8 h-8 rounded-full border-2 border-white" alt="User">
                <img src="https://randomuser.me/api/portraits/women/43.jpg" class="w-8 h-8 rounded-full border-2 border-white" alt="User">
              </div>
              <a href="#" class="text-brand-500 hover:text-brand-700 font-medium text-sm">Voir la recette</a>
            </div>
          </div>
        </div>
        
        <!-- Recipe Card 4 -->
        <div class="bg-white rounded-2xl shadow-md overflow-hidden card-hover fade-in">
          <div class="relative">
            <img src="https://images.unsplash.com/photo-1481931098730-318b6f776db0?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="Pâtes carbonara" class="w-full h-48 object-cover">
            <div class="absolute top-3 right-3">
              <button class="bg-white bg-opacity-90 p-2 rounded-full shadow-md hover:bg-accent-100 hover:text-accent-600 transition">
                <i class="fas fa-heart text-gray-400 hover:text-accent-500"></i>
              </button>
            </div>
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-dark to-transparent p-4">
              <span class="text-xs text-white bg-brand-500 py-1 px-2 rounded-full">Italien</span>
            </div>
          </div>
          <div class="p-5">
            <h3 class="font-display font-semibold text-xl mb-2">Pâtes carbonara</h3>
            <div class="flex items-center text-sm text-gray-500 mb-3">
              <i class="fas fa-clock mr-1"></i>
              <span class="mr-4">30 min</span>
              <i class="fas fa-utensils mr-1"></i>
              <span>Moyen</span>
            </div>
            <p class="text-gray-600 text-sm mb-4">Des pâtes crémeuses avec lardons, œuf et parmesan, un classique italien.</p>
            <div class="flex justify-between items-center">
              <div class="flex -space-x-2">
                <img src="https://randomuser.me/api/portraits/men/36.jpg" class="w-8 h-8 rounded-full border-2 border-white" alt="User">
              </div>
              <a href="#" class="text-brand-500 hover:text-brand-700 font-medium text-sm">Voir la recette</a>
            </div>
          </div>
        </div>
      </div>
      
      <div class="text-center mt-10">
        <button class="inline-flex items-center gap-2 bg-white text-dark font-semibold py-3 px-6 rounded-lg shadow-md hover:shadow-lg transition btn-hover border border-gray-200">
          <span>Voir plus de recettes</span>
          <i class="fas fa-arrow-down"></i>
        </button>
      </div>
    </div>
  </section>
  
  <!-- Add Recipe Modal -->
  <div id="add-recipe-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-2xl shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
      <div class="sticky top-0 bg-white px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        <h3 class="font-display font-bold text-xl">Ajouter une nouvelle recette</h3>
        <button id="close-add-recipe" class="text-gray-500 hover:text-gray-700">
          <i class="fas fa-times text-xl"></i>
        </button>
      </div>
      
      <div class="p-6">
        <form>
          <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-2">Nom de la recette</label>
            <input type="text" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition" placeholder="Ex: Pizza Margherita">
          </div>
          
          <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-2">Description</label>
            <textarea class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition" rows="3" placeholder="Décrivez brièvement votre recette"></textarea>
          </div>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
              <label class="block text-gray-700 font-medium mb-2">Temps de préparation (min)</label>
              <input type="number" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition" placeholder="Ex: 30">
            </div>
            <div>
              <label class="block text-gray-700 font-medium mb-2">Difficulté</label>
              <select class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition">
                <option>Facile</option>
                <option>Moyen</option>
                <option>Difficile</option>
              </select>
            </div>
          </div>
          
          <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-2">Type de plat</label>
            <div class="flex flex-wrap gap-2">
              <label class="inline-flex items-center">
                <input type="checkbox" class="rounded border-gray-300 text-brand-500 focus:ring-brand-400">
                <span class="ml-2">Entrée</span>
              </label>
              <label class="inline-flex items-center">
                <input type="checkbox" class="rounded border-gray-300 text-brand-500 focus:ring-brand-400">
                <span class="ml-2">Plat principal</span>
              </label>
              <label class="inline-flex items-center">
                <input type="checkbox" class="rounded border-gray-300 text-brand-500 focus:ring-brand-400">
                <span class="ml-2">Dessert</span>
              </label>
              <label class="inline-flex items-center">
                <input type="checkbox" class="rounded border-gray-300 text-brand-500 focus:ring-brand-400">
                <span class="ml-2">Végétarien</span>
              </label>
              <label class="inline-flex items-center">
                <input type="checkbox" class="rounded border-gray-300 text-brand-500 focus:ring-brand-400">
                <span class="ml-2">Végan</span>
              </label>
            </div>
          </div>
          
          <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-2">Ingrédients</label>
            <div class="flex flex-col md:flex-row gap-4 mb-4">
              <div class="flex-1 relative">
                <input type="text" placeholder="Ajouter un ingrédient" class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition">
                <i class="fas fa-carrot absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
              </div>
              <button class="bg-brand-500 text-white font-semibold py-3 px-6 rounded-lg shadow-sm hover:bg-brand-600 transition">
                Ajouter
              </button>
            </div>
            <div class="flex flex-wrap gap-2">
              <span class="ingredient-tag bg-brand-100 text-brand-700 px-3 py-1.5 rounded-full flex items-center">
                Tomates (2)
                <i class="fas fa-times ml-2 cursor-pointer hover:text-brand-900"></i>
              </span>
              <span class="ingredient-tag bg-brand-100 text-brand-700 px-3 py-1.5 rounded-full flex items-center">
                Mozzarella (200g)
                <i class="fas fa-times ml-2 cursor-pointer hover:text-brand-900"></i>
              </span>
              <span class="ingredient-tag bg-brand-100 text-brand-700 px-3 py-1.5 rounded-full flex items-center">
                Basilic frais
                <i class="fas fa-times ml-2 cursor-pointer hover:text-brand-900"></i>
              </span>
            </div>
          </div>
          
          <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-2">Étapes de préparation</label>
            <div class="space-y-4">
              <div class="flex gap-4">
                <span class="bg-brand-500 text-white font-bold rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0">1</span>
                <textarea class="flex-1 px-4 py-3 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition" rows="2" placeholder="Décrivez l'étape..."></textarea>
              </div>
              <div class="flex gap-4">
                <span class="bg-brand-500 text-white font-bold rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0">2</span>
                <textarea class="flex-1 px-4 py-3 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition" rows="2" placeholder="Décrivez l'étape..."></textarea>
              </div>
              <button class="flex items-center gap-2 text-brand-500 hover:text-brand-700 font-medium">
                <i class="fas fa-plus"></i>
                <span>Ajouter une étape</span>
              </button>
            </div>
          </div>
          
          <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-2">Photo de la recette</label>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
              <i class="fas fa-camera text-4xl text-gray-400 mb-3"></i>
              <p class="text-gray-500 mb-3">Glissez-déposez une image ou cliquez pour sélectionner</p>
              <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-lg transition">
                Choisir une image
              </button>
            </div>
          </div>
          
          <div class="flex justify-end gap-4 pt-4 border-t border-gray-200">
            <button type="button" id="cancel-add-recipe" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-6 rounded-lg shadow-sm transition">
              Annuler
            </button>
            <button type="submit" class="bg-gradient-brand text-white font-semibold py-3 px-6 rounded-lg shadow-md hover:shadow-lg transition">
              <i class="fas fa-save mr-2"></i> Enregistrer la recette
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  <!-- Edit Profile Modal -->
  <div id="edit-profile-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
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
              <img src="https://randomuser.me/api/portraits/women/44.jpg" class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-md" alt="Profile">
              <button class="absolute bottom-0 right-0 bg-brand-500 text-white p-2 rounded-full shadow-md hover:bg-brand-600 transition">
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
              <input type="text" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition" value="Sophie">
            </div>
            <div>
              <label class="block text-gray-700 font-medium mb-2">Nom</label>
              <input type="text" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition" value="Martin">
            </div>
          </div>
          
          <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-2">Email</label>
            <input type="email" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition" value="sophie.martin@example.com">
          </div>
          
          <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-2">Bio</label>
            <textarea class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition" rows="3">Passionnée de cuisine depuis toujours, j'aime partager mes recettes et découvrir de nouvelles saveurs !</textarea>
          </div>
          
          <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-2">Préférences alimentaires</label>
            <div class="flex flex-wrap gap-3">
              <label class="inline-flex items-center">
                <input type="checkbox" class="rounded border-gray-300 text-brand-500 focus:ring-brand-400" checked>
                <span class="ml-2">Végétarien</span>
              </label>
              <label class="inline-flex items-center">
                <input type="checkbox" class="rounded border-gray-300 text-brand-500 focus:ring-brand-400">
                <span class="ml-2">Végan</span>
              </label>
              <label class="inline-flex items-center">
                <input type="checkbox" class="rounded border-gray-300 text-brand-500 focus:ring-brand-400">
                <span class="ml-2">Sans gluten</span>
              </label>
              <label class="inline-flex items-center">
                <input type="checkbox" class="rounded border-gray-300 text-brand-500 focus:ring-brand-400" checked>
                <span class="ml-2">Sans lactose</span>
              </label>
            </div>
          </div>
          
          <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-2">Changer de mot de passe</label>
            <div class="space-y-4">
              <div>
                <label class="block text-gray-600 text-sm mb-1">Mot de passe actuel</label>
                <input type="password" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition">
              </div>
              <div>
                <label class="block text-gray-600 text-sm mb-1">Nouveau mot de passe</label>
                <input type="password" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition">
              </div>
              <div>
                <label class="block text-gray-600 text-sm mb-1">Confirmer le nouveau mot de passe</label>
                <input type="password" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-200 outline-none transition">
              </div>
            </div>
          </div>
          
          <div class="flex justify-end gap-4 pt-4 border-t border-gray-200">
            <button type="button" id="cancel-edit-profile" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-6 rounded-lg shadow-sm transition">
              Annuler
            </button>
            <button type="submit" class="bg-gradient-brand text-white font-semibold py-3 px-6 rounded-lg shadow-md hover:shadow-lg transition">
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
  <button id="back-to-top" class="fixed bottom-8 right-8 bg-brand-500 text-white w-12 h-12 rounded-full shadow-lg flex items-center justify-center transition opacity-0 invisible hover:bg-brand-600">
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

    // Add recipe modal
    const addRecipeBtn = document.getElementById('add-recipe-btn');
    const addRecipeModal = document.getElementById('add-recipe-modal');
    const closeAddRecipe = document.getElementById('close-add-recipe');
    const cancelAddRecipe = document.getElementById('cancel-add-recipe');
    
    addRecipeBtn.addEventListener('click', () => {
      addRecipeModal.classList.remove('hidden');
    });
    
    closeAddRecipe.addEventListener('click', () => {
      addRecipeModal.classList.add('hidden');
    });
    
    cancelAddRecipe.addEventListener('click', () => {
      addRecipeModal.classList.add('hidden');
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
      window.scrollTo({ top: 0, behavior: 'smooth' });
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
        tag.className = 'ingredient-tag bg-brand-100 text-brand-700 px-3 py-1.5 rounded-full flex items-center';
        tag.innerHTML = `${ingredient} <i class="fas fa-times ml-2 cursor-pointer hover:text-brand-900"></i>`;
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
  </script>
</body>
</html>