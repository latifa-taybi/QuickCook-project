<aside id="sidebar"
    class="sidebar glass-dark text-white w-64 flex-shrink-0 fixed inset-y-0 z-10 md:relative md:translate-x-0">
    <div class="flex flex-col h-full">
        <!-- Sidebar header -->
        <div class="p-4 border-b border-gray-700">
            <div class="flex items-center justify-between">
                <span class="font-display font-bold text-2xl">
                    <span class="text-brand-500">Quick</span><span class="text-accent-500">Cook</span>
                </span>
                <button id="closeSidebarBtn" class="text-white md:hidden">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <!-- User info -->
        <div class="p-4 border-b border-gray-700">
            <div class="flex items-center">
                <div class="flex-shrink-0 relative">
                    <img src="" alt="User"
                        class="h-10 w-10 rounded-full object-cover">
                    <span
                        class="absolute bottom-0 right-0 h-3 w-3 rounded-full bg-green-500 border-2 border-dark"></span>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-white">Latifa Taybi</p>
                    <p class="text-xs text-gray-400">Administrateur</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-2 py-4 space-y-1 overflow-y-auto">
            <a href="{{route('dashboard')}}"
                class="nav-item flex items-center {{request()->routeIs('dashboard') ? 'active' : ''}} px-4 py-3 text-sm font-medium text-gray-300 hover:text-white">
                <i class="fas fa-tachometer-alt mr-3 text-brand-400"></i>
                Tableau de bord
            </a>

            <div class="pt-4 pb-2">
                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Administration</p>
            </div>
            <a href="{{route('recettes.index')}}" 
                class="nav-item flex items-center {{request()->routeIs('recettes.index') ? 'active' : ''}} px-4 py-3 text-sm font-medium text-gray-300 hover:text-white">
                <i class="fas fa-utensils mr-3 text-brand-400"></i>
                Gestion des recettes
            </a>
            <a href="{{route('ingredients.index')}}"
                class="nav-item flex items-center {{request()->routeIs('ingredients.index') ? 'active' : ''}} px-4 py-3 text-sm font-medium text-gray-300 hover:text-white">
                <i class="fas fa-carrot mr-3 text-brand-400"></i>
                Gestion des ingrédients
            </a>
            <a href="{{route('categories.index')}}"
                class="nav-item flex items-center {{request()->routeIs('categories.index') ? 'active' : ''}} px-4 py-3 text-sm font-medium text-gray-300 hover:text-white">
                <i class="fas fa-tags mr-3 text-brand-400"></i>
                Catégories d'ingrédients
            </a>
            <a href="{{route('gestionUtilisateurs')}}"
                class="nav-item flex items-center px-4 py-3 {{request()->routeIs('gestionUtilisateurs') ? 'active' : ''}} text-sm font-medium text-gray-300 hover:text-white">
                <i class="fas fa-users mr-3 text-brand-400"></i>
                Gestion des utilisateurs
            </a>

        </nav>

        <!-- Sidebar footer -->
        <div class="p-4 border-t border-gray-700">
            <a href="#"
                class="flex items-center px-4 py-2 text-sm font-medium rounded-xl text-gray-300 hover:bg-gray-700 hover:text-white transition-colors duration-300">
                <i class="fas fa-sign-out-alt mr-3"></i>
                Retour au site
            </a>
        </div>
    </div>
</aside>
