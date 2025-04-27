<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickCook - Trouvez des recettes avec vos ingrédients</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tom Select -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#F0FDFA',
                            100: '#CCFBF1',
                            200: '#99F6E4',
                            300: '#5EEAD4',
                            400: '#2DD4BF',
                            500: '#14B8A6',
                            600: '#0D9488',
                            700: '#0F766E',
                            800: '#115E59',
                            900: '#134E4A',
                        },
                        accent: {
                            50: '#FFFBEB',
                            100: '#FEF3C7',
                            200: '#FDE68A',
                            300: '#FCD34D',
                            400: '#FBBF24',
                            500: '#F59E0B',
                            600: '#D97706',
                            700: '#B45309',
                            800: '#92400E',
                            900: '#78350F',
                        },
                        slate: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                        },
                        dark: '#0f172a',
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    animation: {
                        'float': 'float 3s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
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
                        'gradient-brand': 'linear-gradient(135deg, #0D9488 0%, #115E59 100%)',
                    }
                }
            }
        }
    </script>
    
    <style>
        .grain-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIzMDAiIGhlaWdodD0iMzAwIj48ZmlsdGVyIGlkPSJhIiB4PSIwIiB5PSIwIj48ZmVUdXJidWxlbmNlIGJhc2VGcmVxdWVuY3k9Ii43NSIgc3RpdGNoVGlsZXM9InN0aXRjaCIgdHlwZT0iZnJhY3RhbE5vaXNlIi8+PGZlQ29sb3JNYXRyaXggdHlwZT0ic2F0dXJhdGUiIHZhbHVlcz0iMCIvPjwvZmlsdGVyPjxyZWN0IHdpZHRoPSIzMDAiIGhlaWdodD0iMzAwIiBmaWx0ZXI9InVybCgjYSkiIG9wYWNpdHk9Ii4wNSIvPjwvc3ZnPg==');
            pointer-events: none;
            z-index: 9999;
            opacity: 0.1;
        }
        
        .menu-item {
            position: relative;
        }
        
        .menu-item::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background-color: #0D9488;
            transition: width 0.3s ease;
        }
        
        .menu-item:hover::after,
        .menu-item.active::after {
            width: 100%;
        }
        
        .text-gradient {
            background: linear-gradient(90deg, #0D9488 0%, #F59E0B 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .bg-glass {
            background-color: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        .shadow-strong {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.2), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }
        
        .fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .btn-hover {
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .btn-hover:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
        }
        
        .btn-hover:before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            z-index: -1;
        }
        
        .btn-hover:hover:before {
            width: 100%;
        }
        
        .grain-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIzMDAiIGhlaWdodD0iMzAwIj48ZmlsdGVyIGlkPSJhIiB4PSIwIiB5PSIwIj48ZmVUdXJidWxlbmNlIGJhc2VGcmVxdWVuY3k9Ii43NSIgc3RpdGNoVGlsZXM9InN0aXRjaCIgdHlwZT0iZnJhY3RhbE5vaXNlIi8+PGZlQ29sb3JNYXRyaXggdHlwZT0ic2F0dXJhdGUiIHZhbHVlcz0iMCIvPjwvZmlsdGVyPjxyZWN0IHdpZHRoPSIzMDAiIGhlaWdodD0iMzAwIiBmaWx0ZXI9InVybCgjYSkiIG9wYWNpdHk9Ii4wNSIvPjwvc3ZnPg==');
            pointer-events: none;
            z-index: 9999;
            opacity: 0.4;
        }
        
        .bg-glass {
            background-color: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        
        .bg-glass-dark {
            background-color: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        
        .text-shadow {
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .shadow-strong {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.2), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }
        
        .bg-gradient-brand {
            background: linear-gradient(135deg, #0D9488 0%, #115E59 100%);
        }
        
        .fade-in {
            animation: fadeIn 0.8s ease-in-out forwards;
        }
        
        .fade-in-delay-1 {
            animation: fadeIn 0.8s ease-in-out 0.2s forwards;
            opacity: 0;
        }
        
        .fade-in-delay-2 {
            animation: fadeIn 0.8s ease-in-out 0.4s forwards;
            opacity: 0;
        }
        
        .fade-in-delay-3 {
            animation: fadeIn 0.8s ease-in-out 0.6s forwards;
            opacity: 0;
        }
        
        .fade-in-delay-4 {
            animation: fadeIn 0.8s ease-in-out 0.8s forwards;
            opacity: 0;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .card-hover {
            transition: all 0.3s ease-in-out;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .btn-hover {
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .btn-hover:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
        }
        
        .btn-hover:before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            z-index: -1;
        }
        
        .btn-hover:hover:before {
            width: 100%;
        }
        
        .menu-item {
            position: relative;
        }
        
        .menu-item::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background-color: #0D9488;
            transition: width 0.3s ease;
        }
        
        .menu-item:hover::after,
        .menu-item.active::after {
            width: 100%;
        }
        
        .recipe-step-number {
            background: linear-gradient(135deg, #0D9488 0%, #115E59 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-weight: 600;
            flex-shrink: 0;
        }
        
        .ingredient-badge {
            background-color: #F0FDFA;
            color: #0F766E;
            border: 1px solid #CCFBF1;
        }
        
        .time-badge {
            background-color: #FFFBEB;
            color: #B45309;
            border: 1px solid #FDE68A;
        }
        
        .difficulty-badge {
            background-color: #ECFDF5;
            color: #047857;
            border: 1px solid #A7F3D0;
        }
    </style>
</head>

<body class="bg-slate-50 font-sans text-slate-800 relative">
    <!-- Grain overlay for texture -->
    <div class="grain-overlay"></div>

    <!-- Header -->
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <span class="font-bold text-2xl md:text-3xl">
                        <span class="text-brand-500">Quick</span><span class="text-accent-500">Cook</span>
                    </span>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{route('recettes.indexSearch')}}" 
                       class="menu-item text-slate-800 hover:text-brand-500 text-sm font-medium {{request()->routeIs('recettes.indexSearch') ? 'active' : ''}}">
                        Accueil
                    </a>
                    <a href="{{route('client.recettes')}}" 
                       class="menu-item text-slate-800 hover:text-brand-500 text-sm font-medium {{request()->routeIs('client.recettes') ? 'active' : ''}}">
                        Recettes
                    </a>
                    <a href="{{route('mesRecettes')}}" 
                       class="menu-item text-slate-800 hover:text-brand-500 text-sm font-medium {{request()->routeIs('mesRecettes') ? 'active' : ''}}">
                        Mes Recettes
                    </a>
                    <a href="{{route('favoriesRecettes')}}" 
                       class="menu-item text-slate-800 hover:text-brand-500 text-sm font-medium">
                        Favoris
                    </a>
                </div>

                            <div class="flex items-center space-x-4">
                                <div class="relative">
                                    <button id="profile-btn" class="flex items-center justify-center w-10 h-10 rounded-full bg-brand-100 hover:bg-brand-200 transition">
                                        <i class="fas fa-user text-brand-600"></i>
                                    </button>
                                    <div id="profile-menu" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 hidden z-50 border border-slate-100">
                                        <a href="{{route('editProfile', Auth::id())}}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-brand-50">Mon Profil</a>
                                        <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-brand-50">Déconnexion</a>
                                    </div>
                                </div>
                                <button id="mobile-menu-btn" class="md:hidden text-slate-800 hover:text-brand-500">
                                    <i class="fas fa-bars text-xl"></i>
                                </button>
                            </div>
                        </div>
            
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden hidden bg-white border-t border-slate-100">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{route('recettes.indexSearch')}}" 
                   class="block px-3 py-2 rounded-md text-base font-medium text-slate-800 hover:bg-brand-50 hover:text-brand-500 transition">
                    Accueil
                </a>
                <a href="{{route('client.recettes')}}" 
                   class="block px-3 py-2 rounded-md text-base font-medium text-slate-800 hover:bg-brand-50 hover:text-brand-500 transition">
                    Recettes
                </a>
                <a href="{{route('mesRecettes')}}" 
                   class="block px-3 py-2 rounded-md text-base font-medium text-slate-800 hover:bg-brand-50 hover:text-brand-500 transition">
                    Mes Recettes
                </a>
                <a href="{{route('favoriesRecettes')}}" 
                   class="block px-3 py-2 rounded-md text-base font-medium text-slate-800 hover:bg-brand-50 hover:text-brand-500 transition">
                    Favoris
                </a>
            </div>
        </div>
    </header>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const profileBtn = document.getElementById('profile-btn');
            const profileMenu = document.getElementById('profile-menu');
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
    
            // Toggle profile menu
            profileBtn.addEventListener('click', () => {
                profileMenu.classList.toggle('hidden');
            });
    
            // Close profile menu when clicking outside
            document.addEventListener('click', (e) => {
                if (!profileBtn.contains(e.target) && !profileMenu.contains(e.target)) {
                    profileMenu.classList.add('hidden');
                }
            });
    
            // Toggle mobile menu
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        });
    </script>