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
                <div class="ml-3 relative">
                    <div>
                        <button id="userMenuBtn"
                            class="flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                            <span class="sr-only">Ouvrir le menu utilisateur</span>
                            <img class="h-8 w-8 rounded-full object-cover"
                                src="{{asset('avatar3.jpg')}}" alt="User">
                        </button>
                    </div>
                    <div id="userDropdown"
                        class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-xl shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-20">
                        <a href="{{route('logout')}}" class="dropdown-item block px-4 py-2 text-sm text-gray-700">Se déconnecter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Toggle user dropdown
        document.getElementById('userMenuBtn').addEventListener('click', function(e) {
            e.stopPropagation();
            document.getElementById('userDropdown').classList.toggle('hidden');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function() {
            document.getElementById('userDropdown').classList.add('hidden');
        });
    </script>
</header>
