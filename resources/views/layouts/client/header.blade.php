<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickCook - Trouvez des recettes avec vos ingrédients</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

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
                    <a href="{{route('recettes.indexSearch')}}" class="text-dark hover:text-brand-500 menu-item {{request()->routeIs('recettes.indexSearch') ? 'active' : ''}}">Accueil</a>
                    <a href="{{route('client.recettes')}}" class="text-dark hover:text-brand-500 menu-item {{request()->routeIs('client.recettes') ? 'active' : ''}}">Recettes</a>
                    <a href="{{route('mesRecettes')}}" class="text-dark hover:text-brand-500 menu-item {{request()->routeIs('mesRecettes') ? 'active' : ''}}">Mes Recettes</a>
                    <a href="#" class="text-dark hover:text-brand-500 menu-item">Favoris</a>
                </div>

                <div class="flex items-center space-x-3">
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