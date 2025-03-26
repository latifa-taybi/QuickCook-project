<header class="bg-white shadow-sm z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <button id="openSidebarBtn"
                    class="px-4 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-brand-500 md:hidden">
                    <span class="sr-only">Ouvrir le menu</span>
                    <i class="fas fa-bars"></i>
                </button>
                <div class="flex-shrink-0 flex items-center">
                    <h1 class="text-xl font-display font-bold text-dark">@yield('title')</h1>
                </div>
            </div>
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <button
                        class="p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 relative tooltip"
                        data-tooltip="Notifications">
                        <span class="sr-only">Voir les notifications</span>
                        <i class="fas fa-bell"></i>
                        <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-brand-500"></span>
                    </button>
                </div>
                <div class="flex-shrink-0 ml-4">
                    <button
                        class="p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 tooltip"
                        data-tooltip="Messages">
                        <span class="sr-only">Voir les messages</span>
                        <i class="fas fa-envelope"></i>
                    </button>
                </div>
                <div class="ml-3 relative">
                    <div>
                        <button id="userMenuBtn"
                            class="flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                            <span class="sr-only">Ouvrir le menu utilisateur</span>
                            <img class="h-8 w-8 rounded-full object-cover"
                                src="https://randomuser.me/api/portraits/men/32.jpg" alt="User">
                        </button>
                    </div>
                    <div id="userDropdown"
                        class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-xl shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-20">
                        <a href="#" class="dropdown-item block px-4 py-2 text-sm text-gray-700">Votre
                            profil</a>
                        <a href="#"
                            class="dropdown-item block px-4 py-2 text-sm text-gray-700">Paramètres</a>
                        <a href="#" class="dropdown-item block px-4 py-2 text-sm text-gray-700">Se
                            déconnecter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
