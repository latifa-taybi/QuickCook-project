<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trouve Ta Recette - Recherche par ingrédients</title>
  
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
    
    .swiper-pagination-bullet {
      width: 12px;
      height: 12px;
      background: #00AAFF;
      opacity: 0.5;
    }
    
    .swiper-pagination-bullet-active {
      opacity: 1;
      background: #00AAFF;
    }
    
    .swiper-button-next,
    .swiper-button-prev {
      color: #00AAFF !important;
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
    
    .circle-1 {
      width: 300px;
      height: 300px;
      top: -150px;
      right: -100px;
    }
    
    .circle-2 {
      width: 500px;
      height: 500px;
      bottom: -250px;
      left: -200px;
    }
    
    .circle-3 {
      width: 200px;
      height: 200px;
      top: 40%;
      right: 10%;
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
    
    .fade-in-delay-4 {
      animation: fadeIn 0.5s ease 0.4s forwards;
      opacity: 0;
    }
    
    .fade-in-delay-5 {
      animation: fadeIn 0.5s ease 0.5s forwards;
      opacity: 0;
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

    /* Glassmorphism */
    .glass-dark {
      background: rgba(18, 24, 38, 0.8);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.08);
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

    /* Gradient text */
    .text-gradient {
      background: linear-gradient(90deg, #00AAFF 0%, #FF9800 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      color: transparent;
    }
  </style>
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 relative">
  
  <!-- Grain overlay -->
  <div class="grain-overlay"></div>
  
  <!-- Header -->
  <header class="relative bg-gradient-to-br from-brand-900 to-brand-700  flex pt-3">
    <div class="container mx-auto px-4 md:py-3">
      <nav class="flex justify-between items-center mb-12">
        <div class="flex items-center">
          <span class="font-display font-bold text-2xl md:text-3xl">
            <span class="text-brand-500">Quick</span><span class="text-accent-500">Cook</span>
          </span>        
        </div>
        <div class="hidden md:flex items-center space-x-8">
          <a href="#" class="text-white hover:text-accent-300 menu-item active">Accueil</a>
          <a href="#" class="text-white hover:text-accent-300 menu-item">Recettes</a>
          <a href="#" class="text-white hover:text-accent-300 menu-item">Favoris</a>
          <a href="#" class="text-white hover:text-accent-300 menu-item">À propos</a>
        </div>
        <div class="md:hidden">
          <button class="text-white">
            <i class="fas fa-bars text-xl"></i>
          </button>
        </div>
      </nav>
  </header>
  
  <!-- Search Section -->
  <section id="search-section" class="py-16 container mx-auto px-4 relative">
    <div class="text-center mb-12 fade-in">
      <h2 class="font-display font-bold text-3xl md:text-4xl text-dark mb-4">
        Quels <span class="text-gradient">ingrédients</span> avez-vous?
      </h2>
      <p class="text-gray-600 max-w-2xl mx-auto">
        Entrez les ingrédients que vous avez dans votre cuisine et nous vous proposerons des recettes adaptées.
      </p>
    </div>
    
    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-strong p-6 md:p-8 fade-in-delay-1">
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
      
      <button class="w-full bg-gradient-brand text-white font-semibold py-4 px-6 rounded-lg shadow-md hover:shadow-lg transition btn-hover">
        <i class="fas fa-utensils mr-2"></i> Rechercher des Recettes
      </button>
    </div>
  </section>
  
  <!-- Results Section -->
  <section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
      <div class="flex flex-col lg:flex-row gap-8">
        <!-- Filters -->
        <div class="lg:w-1/4 fade-in">
          <div class="bg-white rounded-2xl shadow-md p-6 sticky top-4">
            <div class="flex items-center justify-between mb-6">
              <h3 class="font-display font-semibold text-xl text-dark">Filtres</h3>
              <i class="fas fa-sliders-h text-brand-500"></i>
            </div>
            
            <div class="space-y-6">
              <div>
                <h4 class="font-medium mb-3 text-dark">Temps de préparation</h4>
                <div class="space-y-2">
                  <label class="flex items-center space-x-3 cursor-pointer">
                    <input type="checkbox" class="form-checkbox rounded text-brand-500 focus:ring-brand-400">
                    <span class="text-gray-700">Moins de 15 min</span>
                  </label>
                  <label class="flex items-center space-x-3 cursor-pointer">
                    <input type="checkbox" class="form-checkbox rounded text-brand-500 focus:ring-brand-400">
                    <span class="text-gray-700">Moins de 30 min</span>
                  </label>
                  <label class="flex items-center space-x-3 cursor-pointer">
                    <input type="checkbox" class="form-checkbox rounded text-brand-500 focus:ring-brand-400">
                    <span class="text-gray-700">Moins de 60 min</span>
                  </label>
                </div>
              </div>
              
              <div>
                <h4 class="font-medium mb-3 text-dark">Type de plat</h4>
                <div class="space-y-2">
                  <label class="flex items-center space-x-3 cursor-pointer">
                    <input type="checkbox" class="form-checkbox rounded text-brand-500 focus:ring-brand-400">
                    <span class="text-gray-700">Entrée</span>
                  </label>
                  <label class="flex items-center space-x-3 cursor-pointer">
                    <input type="checkbox" class="form-checkbox rounded text-brand-500 focus:ring-brand-400">
                    <span class="text-gray-700">Plat principal</span>
                  </label>
                  <label class="flex items-center space-x-3 cursor-pointer">
                    <input type="checkbox" class="form-checkbox rounded text-brand-500 focus:ring-brand-400">
                    <span class="text-gray-700">Dessert</span>
                  </label>
                </div>
              </div>
              
              <div>
                <h4 class="font-medium mb-3 text-dark">Régime alimentaire</h4>
                <div class="space-y-2">
                  <label class="flex items-center space-x-3 cursor-pointer">
                    <input type="checkbox" class="form-checkbox rounded text-brand-500 focus:ring-brand-400">
                    <span class="text-gray-700">Végétarien</span>
                  </label>
                  <label class="flex items-center space-x-3 cursor-pointer">
                    <input type="checkbox" class="form-checkbox rounded text-brand-500 focus:ring-brand-400">
                    <span class="text-gray-700">Végan</span>
                  </label>
                  <label class="flex items-center space-x-3 cursor-pointer">
                    <input type="checkbox" class="form-checkbox rounded text-brand-500 focus:ring-brand-400">
                    <span class="text-gray-700">Sans gluten</span>
                  </label>
                </div>
              </div>
            </div>
            
            <button class="w-full mt-6 bg-brand-500 text-white font-semibold py-3 px-6 rounded-lg shadow-md hover:shadow-lg transition btn-hover">
              Appliquer les filtres
            </button>
          </div>
        </div>
        
        <!-- Recipe Results -->
        <div class="lg:w-3/4">
          <div class="flex justify-between items-center mb-8 fade-in">
            <h2 class="font-display font-semibold text-2xl text-dark">
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
          
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Recipe Card 1 -->
            <div class="bg-white rounded-2xl shadow-md overflow-hidden card-hover fade-in-delay-1">
              <div class="relative">
                <img src="https://images.unsplash.com/photo-1513104890138-7c749659a591?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="Pizza Margherita" class="w-full h-48 object-cover">
                <button class="absolute top-3 right-3 bg-white rounded-full p-2 shadow-md text-accent-500">
                  <i class="fas fa-heart fill-current"></i>
                </button>
              </div>
              <div class="p-5">
                <h3 class="font-display font-semibold text-lg mb-2 text-dark">Pizza Margherita Maison</h3>
                <div class="flex gap-2 mb-3">
                  <span class="bg-brand-50 text-brand-700 text-xs px-2 py-1 rounded-full">30 min</span>
                  <span class="bg-accent-50 text-accent-700 text-xs px-2 py-1 rounded-full">Facile</span>
                </div>
                <div class="mb-4">
                  <p class="text-sm text-gray-500 mb-1">Ingrédients principaux:</p>
                  <div class="flex flex-wrap gap-1">
                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Tomates</span>
                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Mozzarella</span>
                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Basilic</span>
                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Pâte à pizza</span>
                  </div>
                </div>
                <button class="w-full bg-gradient-brand text-white font-semibold py-2 px-4 rounded-lg shadow-sm hover:shadow transition btn-hover">
                  Voir la recette
                </button>
              </div>
            </div>
            
            <!-- Recipe Card 2 -->
            <div class="bg-white rounded-2xl shadow-md overflow-hidden card-hover fade-in-delay-2">
              <div class="relative">
                <img src="https://images.unsplash.com/photo-1546793665-c74683f339c1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80" alt="Salade Caprese" class="w-full h-48 object-cover">
                <button class="absolute top-3 right-3 bg-white rounded-full p-2 shadow-md text-gray-400 hover:text-accent-500">
                  <i class="far fa-heart"></i>
                </button>
              </div>
              <div class="p-5">
                <h3 class="font-display font-semibold text-lg mb-2 text-dark">Salade Caprese</h3>
                <div class="flex gap-2 mb-3">
                  <span class="bg-brand-50 text-brand-700 text-xs px-2 py-1 rounded-full">15 min</span>
                  <span class="bg-accent-50 text-accent-700 text-xs px-2 py-1 rounded-full">Très facile</span>
                </div>
                <div class="mb-4">
                  <p class="text-sm text-gray-500 mb-1">Ingrédients principaux:</p>
                  <div class="flex flex-wrap gap-1">
                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Tomates</span>
                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Mozzarella</span>
                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Basilic</span>
                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Huile d'olive</span>
                  </div>
                </div>
                <button class="w-full bg-gradient-brand text-white font-semibold py-2 px-4 rounded-lg shadow-sm hover:shadow transition btn-hover">
                  Voir la recette
                </button>
              </div>
            </div>
            
            <!-- Recipe Card 3 -->
            <div class="bg-white rounded-2xl shadow-md overflow-hidden card-hover fade-in-delay-3">
              <div class="relative">
                <img src="https://images.unsplash.com/photo-1563379926898-05f4575a45d8?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="Sauce Tomate" class="w-full h-48 object-cover">
                <button class="absolute top-3 right-3 bg-white rounded-full p-2 shadow-md text-gray-400 hover:text-accent-500">
                  <i class="far fa-heart"></i>
                </button>
              </div>
              <div class="p-5">
                <h3 class="font-display font-semibold text-lg mb-2 text-dark">Sauce Tomate Maison</h3>
                <div class="flex gap-2 mb-3">
                  <span class="bg-brand-50 text-brand-700 text-xs px-2 py-1 rounded-full">45 min</span>
                  <span class="bg-accent-50 text-accent-700 text-xs px-2 py-1 rounded-full">Moyen</span>
                </div>
                <div class="mb-4">
                  <p class="text-sm text-gray-500 mb-1">Ingrédients principaux:</p>
                  <div class="flex flex-wrap gap-1">
                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Tomates</span>
                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Oignons</span>
                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Ail</span>
                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Basilic</span>
                  </div>
                </div>
                <button class="w-full bg-gradient-brand text-white font-semibold py-2 px-4 rounded-lg shadow-sm hover:shadow transition btn-hover">
                  Voir la recette
                </button>
              </div>
            </div>
            
            <!-- Recipe Card 4 -->
            <div class="bg-white rounded-2xl shadow-md overflow-hidden card-hover fade-in-delay-1">
              <div class="relative">
                <img src="https://images.unsplash.com/photo-1572695157366-5e585ab2b69f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1171&q=80" alt="Bruschetta" class="w-full h-48 object-cover">
                <button class="absolute top-3 right-3 bg-white rounded-full p-2 shadow-md text-gray-400 hover:text-accent-500">
                  <i class="far fa-heart"></i>
                </button>
              </div>
              <div class="p-5">
                <h3 class="font-display font-semibold text-lg mb-2 text-dark">Bruschetta à l'Italienne</h3>
                <div class="flex gap-2 mb-3">
                  <span class="bg-brand-50 text-brand-700 text-xs px-2 py-1 rounded-full">20 min</span>
                  <span class="bg-accent-50 text-accent-700 text-xs px-2 py-1 rounded-full">Facile</span>
                </div>
                <div class="mb-4">
                  <p class="text-sm text-gray-500 mb-1">Ingrédients principaux:</p>
                  <div class="flex flex-wrap gap-1">
                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Tomates</span>
                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Ail</span>
                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Basilic</span>
                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Pain</span>
                  </div>
                </div>
                <button class="w-full bg-gradient-brand text-white font-semibold py-2 px-4 rounded-lg shadow-sm hover:shadow transition btn-hover">
                  Voir la recette
                </button>
              </div>
            </div>
            
            <!-- Recipe Card 5 -->
            <div class="bg-white rounded-2xl shadow-md overflow-hidden card-hover fade-in-delay-2">
              <div class="relative">
                <img src="https://images.unsplash.com/photo-1455279032140-49a4bf46c0f1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1074&q=80" alt="Pâtes" class="w-full h-48 object-cover">
                <button class="absolute top-3 right-3 bg-white rounded-full p-2 shadow-md text-accent-500">
                  <i class="fas fa-heart fill-current"></i>
                </button>
              </div>
              <div class="p-5">
                <h3 class="font-display font-semibold text-lg mb-2 text-dark">Pâtes à la Sauce Tomate</h3>
                <div class="flex gap-2 mb-3">
                  <span class="bg-brand-50 text-brand-700 text-xs px-2 py-1 rounded-full">25 min</span>
                  <span class="bg-accent-50 text-accent-700 text-xs px-2 py-1 rounded-full">Facile</span>
                </div>
                <div class="mb-4">
                  <p class="text-sm text-gray-500 mb-1">Ingrédients principaux:</p>
                  <div class="flex flex-wrap gap-1">
                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Tomates</span>
                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Oignons</span>
                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Ail</span>
                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Pâtes</span>
                  </div>
                </div>
                <button class="w-full bg-gradient-brand text-white font-semibold py-2 px-4 rounded-lg shadow-sm hover:shadow transition btn-hover">
                  Voir la recette
                </button>
              </div>
            </div>
            
            <!-- Recipe Card 6 -->
            <div class="bg-white rounded-2xl shadow-md overflow-hidden card-hover fade-in-delay-3">
              <div class="relative">
                <img src="https://images.unsplash.com/photo-1510693206972-df098062cb71?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1098&q=80" alt="Omelette" class="w-full h-48 object-cover">
                <button class="absolute top-3 right-3 bg-white rounded-full p-2 shadow-md text-gray-400 hover:text-accent-500">
                  <i class="far fa-heart"></i>
                </button>
              </div>
              <div class="p-5">
                <h3 class="font-display font-semibold text-lg mb-2 text-dark">Omelette aux Herbes</h3>
                <div class="flex gap-2 mb-3">
                  <span class="bg-brand-50 text-brand-700 text-xs px-2 py-1 rounded-full">10 min</span>
                  <span class="bg-accent-50 text-accent-700 text-xs px-2 py-1 rounded-full">Très facile</span>
                </div>
                <div class="mb-4">
                  <p class="text-sm text-gray-500 mb-1">Ingrédients principaux:</p>
                  <div class="flex flex-wrap gap-1">
                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Oeufs</span>
                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Oignons</span>
                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Basilic</span>
                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">Fromage</span>
                  </div>
                </div>
                <button class="w-full bg-gradient-brand text-white font-semibold py-2 px-4 rounded-lg shadow-sm hover:shadow transition btn-hover">
                  Voir la recette
                </button>
              </div>
            </div>
          </div>
          
          <!-- Pagination -->
          <div class="flex justify-center mt-12 fade-in">
            <div class="flex items-center gap-2">
              <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg bg-white text-gray-500 shadow-sm hover:shadow transition">
                <i class="fas fa-chevron-left"></i>
              </a>
              <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg bg-brand-500 text-white shadow-sm hover:shadow transition">
                1
              </a>
              <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg bg-white text-gray-700 shadow-sm hover:shadow transition">
                2
              </a>
              <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg bg-white text-gray-700 shadow-sm hover:shadow transition">
                3
              </a>
              <span class="text-gray-500">...</span>
              <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg bg-white text-gray-700 shadow-sm hover:shadow transition">
                8
              </a>
              <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg bg-white text-gray-500 shadow-sm hover:shadow transition">
                <i class="fas fa-chevron-right"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Footer -->
  <footer class="bg-dark text-white py-12">
    <div class="container mx-auto px-4">
      <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <div class="mb-6 md:mb-0">
          <div class="font-display font-bold text-2xl mb-2">Trouve<span class="text-accent-400">Ta</span>Recette</div>
          <p class="text-gray-400 max-w-md">
            Découvrez des recettes délicieuses adaptées aux ingrédients que vous avez déjà dans votre cuisine.
          </p>
        </div>
        <div class="flex gap-4">
          <a href="#" class="bg-white bg-opacity-10 hover:bg-opacity-20 w-10 h-10 rounded-full flex items-center justify-center transition">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#" class="bg-white bg-opacity-10 hover:bg-opacity-20 w-10 h-10 rounded-full flex items-center justify-center transition">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" class="bg-white bg-opacity-10 hover:bg-opacity-20 w-10 h-10 rounded-full flex items-center justify-center transition">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="#" class="bg-white bg-opacity-10 hover:bg-opacity-20 w-10 h-10 rounded-full flex items-center justify-center transition">
            <i class="fab fa-pinterest"></i>
          </a>
        </div>
      </div>
      
      <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8 py-8 border-t border-b border-gray-800">
        <div>
          <h4 class="font-display font-semibold text-lg mb-4">Navigation</h4>
          <ul class="space-y-2">
            <li><a href="#" class="text-gray-400 hover:text-white transition">Accueil</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition">Recettes</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition">Favoris</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition">À propos</a></li>
          </ul>
        </div>
        <div>
          <h4 class="font-display font-semibold text-lg mb-4">Catégories</h4>
          <ul class="space-y-2">
            <li><a href="#" class="text-gray-400 hover:text-white transition">Entrées</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition">Plats principaux</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition">Desserts</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition">Boissons</a></li>
          </ul>
        </div>
        <div>
          <h4 class="font-display font-semibold text-lg mb-4">Régimes</h4>
          <ul class="space-y-2">
            <li><a href="#" class="text-gray-400 hover:text-white transition">Végétarien</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition">Végan</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition">Sans gluten</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white transition">Sans lactose</a></li>
          </ul>
        </div>
        <div>
          <h4 class="font-display font-semibold text-lg mb-4">Contact</h4>
          <ul class="space-y-2">
            <li class="flex items-center gap-2 text-gray-400">
              <i class="fas fa-envelope"></i>
              <span>contact@trouvetarecette.fr</span>
            </li>
            <li class="flex items-center gap-2 text-gray-400">
              <i class="fas fa-phone"></i>
              <span>+33 1 23 45 67 89</span>
            </li>
            <li class="flex items-center gap-2 text-gray-400">
              <i class="fas fa-map-marker-alt"></i>
              <span>Paris, France</span>
            </li>
          </ul>
        </div>
      </div>
      
      <div class="pt-8 text-center text-gray-500">
        <p>© 2024 TrouveTaRecette. Tous droits réservés.</p>
      </div>
    </div>
  </footer>
  
  <!-- Simple JavaScript for interactivity -->
  <script>
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        
        document.querySelector(this.getAttribute('href')).scrollIntoView({
          behavior: 'smooth'
        });
      });
    });
    
    // Favorite button toggle
    document.querySelectorAll('.fa-heart').forEach(heart => {
      heart.addEventListener('click', function() {
        this.classList.toggle('fas');
        this.classList.toggle('far');
        this.parentElement.classList.toggle('text-accent-500');
        this.parentElement.classList.toggle('text-gray-400');
      });
    });
  </script>
</body>
</html>