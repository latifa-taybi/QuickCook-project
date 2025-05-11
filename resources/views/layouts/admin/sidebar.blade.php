<aside id="sidebar"
    class="sidebar bg-gradient-to-b from-slate-800 to-slate-900 text-white w-64 flex-shrink-0 fixed inset-y-0 z-10 md:relative md:translate-x-0 backdrop-blur-lg border-r border-teal-900/30">
    <div class="flex flex-col h-full">
        <!-- Sidebar header -->
        <div class="p-5 border-b border-teal-700/30 bg-slate-800/50">
            <div class="flex items-center justify-between">
                <span class="font-display font-bold text-2xl">
                    <img src="{{asset('chef.png')}}" alt="Logo" class="h-10 w-10 inline-block ">
                    <span class="text-teal-400">Quick</span><span class="text-amber-400">Cook</span>
                </span>
                <button id="closeSidebarBtn" class="text-slate-300 hover:text-white transition-colors p-1 rounded-full hover:bg-slate-700/50">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <!-- User info -->
        <div class="p-5 border-b border-teal-700/30 bg-gradient-to-r from-slate-800/80 to-slate-800/30">
            <div class="flex items-center">
                <div class="flex-shrink-0 relative">
                    <img src="{{asset('avatar3.jpg')}}" alt="User"
                        class="h-12 w-12 rounded-full object-cover border-2 border-teal-500/50 shadow-lg shadow-teal-500/20">
                    <span
                        class="absolute bottom-0 right-0 h-3.5 w-3.5 rounded-full bg-emerald-500 border-2 border-slate-800"></span>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-white">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</p>
                    <p class="text-xs text-teal-300/70">Administrateur</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-3 py-5 space-y-1.5 overflow-y-auto scrollbar-thin scrollbar-thumb-teal-700/30 scrollbar-track-slate-800/30">
            <a href="{{route('statistique')}}"
                class="nav-item flex items-center {{request()->routeIs('statistique') ? 'bg-gradient-to-r from-teal-600/40 to-teal-600/10 text-white border-l-4 border-teal-400' : ''}} px-4 py-3.5 rounded-lg text-sm font-medium text-slate-300 hover:text-white hover:bg-slate-700/50 transition-all duration-200">
                <i class="fas fa-tachometer-alt mr-3 {{request()->routeIs('statistique') ? 'text-amber-400' : 'text-teal-400'}}"></i>
                Tableau de bord
            </a>
            <div class="pt-5 pb-2">
                <p class="px-4 text-xs font-semibold text-amber-400/80 uppercase tracking-wider">Administration</p>
            </div>
            <a href="{{route('recettes.index')}}" 
                class="nav-item flex items-center {{request()->routeIs('recettes.index') ? 'bg-gradient-to-r from-teal-600/40 to-teal-600/10 text-white border-l-4 border-teal-400' : ''}} px-4 py-3.5 rounded-lg text-sm font-medium text-slate-300 hover:text-white hover:bg-slate-700/50 transition-all duration-200">
                <i class="fas fa-utensils mr-3 {{request()->routeIs('recettes.index') ? 'text-amber-400' : 'text-teal-400'}}"></i>
                Gestion des recettes
            </a>
            <a href="{{route('ingredients.index')}}"
                class="nav-item flex items-center {{request()->routeIs('ingredients.index') ? 'bg-gradient-to-r from-teal-600/40 to-teal-600/10 text-white border-l-4 border-teal-400' : ''}} px-4 py-3.5 rounded-lg text-sm font-medium text-slate-300 hover:text-white hover:bg-slate-700/50 transition-all duration-200">
                <i class="fas fa-carrot mr-3 {{request()->routeIs('ingredients.index') ? 'text-amber-400' : 'text-teal-400'}}"></i>
                Gestion des ingrédients
            </a>
            <a href="{{route('categories.index')}}"
                class="nav-item flex items-center {{request()->routeIs('categories.index') ? 'bg-gradient-to-r from-teal-600/40 to-teal-600/10 text-white border-l-4 border-teal-400' : ''}} px-4 py-3.5 rounded-lg text-sm font-medium text-slate-300 hover:text-white hover:bg-slate-700/50 transition-all duration-200">
                <i class="fas fa-tags mr-3 {{request()->routeIs('categories.index') ? 'text-amber-400' : 'text-teal-400'}}"></i>
                Catégories d'ingrédients
            </a>
            <a href="{{route('regimes.index')}}"
                class="nav-item flex items-center {{request()->routeIs('regimes.index') ? 'bg-gradient-to-r from-teal-600/40 to-teal-600/10 text-white border-l-4 border-teal-400' : ''}} px-4 py-3.5 rounded-lg text-sm font-medium text-slate-300 hover:text-white hover:bg-slate-700/50 transition-all duration-200">
                <i class="fas fa-heartbeat mr-3 {{request()->routeIs('regimes.index') ? 'text-amber-400' : 'text-teal-400'}}"></i>
                Gestion des régimes
            </a>
            <a href="{{route('approveRecette')}}"
                class="nav-item flex items-center px-4 py-3.5 {{request()->routeIs('approveRecette') ? 'bg-gradient-to-r from-teal-600/40 to-teal-600/10 text-white border-l-4 border-teal-400' : ''}} rounded-lg text-sm font-medium text-slate-300 hover:text-white hover:bg-slate-700/50 transition-all duration-200">
                <i class="fas fa-check-circle mr-3 {{request()->routeIs('approveRecette') ? 'text-amber-400' : 'text-teal-400'}}"></i>
                Modération des recettes
            </a>
        </nav>

        <!-- Sidebar footer -->
        <div class="p-4 border-t border-teal-700/30 bg-slate-800/50">
            <a href="{{route('logout')}}"
                class="flex items-center px-4 py-3 text-sm font-medium rounded-xl text-slate-300 hover:bg-gradient-to-r hover:from-amber-600/30 hover:to-amber-600/10 hover:text-white transition-all duration-300 group">
                <i class="fas fa-sign-out-alt mr-3 group-hover:text-amber-400 transition-colors"></i>
                Retour au site
            </a>
        </div>
    </div>
</aside>