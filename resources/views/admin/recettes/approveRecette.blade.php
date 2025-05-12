@include('layouts.admin.header')

<body class="bg-slate-50 font-sans text-slate-800 min-h-screen">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        @include('layouts.admin.sidebar')

        <!-- Main content -->
        <div class="flex-1 flex flex-col">
            <!-- Top navbar -->
            @include('layouts.admin.nav')
            
            <!-- Main content area -->
            <main class="flex-1 overflow-y-auto bg-slate-50 p-6">
                <!-- Page header -->
                <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-slate-800">Modération des recettes</h1>
                        <p class="mt-2 text-slate-500">Approuvez ou refusez les recettes proposées par les utilisateurs.</p>
                    </div>
                </div>

                <!-- Recipes grid -->
                @if ($recettes->isEmpty())
                    <div class="text-center py-10">
                        <h2 class="text-2xl font-semibold text-slate-800">Aucune recette à modérer</h2>
                        <p class="mt-2 text-slate-500">Il n'y a actuellement aucune recette en attente de modération.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mb-12">
                        @foreach ($recettes as $recette)
                            <!-- Recipe card -->
                            <div class="group bg-white rounded-xl shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md hover:-translate-y-1 border border-slate-100">
                                <div class="relative h-48">
                                    <img class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" 
                                         src="{{ asset('storage/' . $recette->image) }}" 
                                         alt="{{ $recette->name }}">
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent"></div>
                                    <div class="absolute top-3 right-3 flex flex-wrap gap-2">
                                        @foreach ($recette->regimes as $regime)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-white/90 text-teal-600 shadow-sm">
                                                {{ $regime->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                    <div class="absolute bottom-0 left-0 right-0 p-4">
                                        <h3 class="text-lg font-semibold text-white">{{ $recette->name }}</h3>
                                    </div>
                                </div>
                                <div class="p-5">
                                    <div class="flex items-center text-sm text-slate-500 mb-3">
                                        <span class="flex items-center mr-4">
                                            <i class="fas fa-clock mr-1.5 text-teal-500"></i> 
                                            {{ $recette->prepTime }} min
                                        </span>
                                        <span class="flex items-center">
                                            <i class="fas fa-utensils mr-1.5 text-teal-500"></i> 
                                            {{ ucfirst($recette->difficulty) }}
                                        </span>
                                    </div>
                                    <p class="text-slate-600 text-sm mb-4 line-clamp-2">{{ $recette->description }}</p>
                                    <div class="flex justify-between items-center pt-3 border-t border-slate-100">
                                        <div class="flex items-center">
                                            <span class="text-xs text-slate-500">{{ $recette->created_at->diffForHumans() }}</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('recettes.show', $recette->id) }}" 
                                               class="text-slate-400 hover:text-teal-600 p-2 rounded-full hover:bg-slate-100 transition-colors"
                                               title="Voir la recette">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            
                                            @if($recette->status === 'en_attente')
                                            <div class="flex space-x-2">
                                                <form action="{{ route('recettes.approve', $recette->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="text-xs bg-gradient-to-r from-teal-600 to-teal-500 hover:from-teal-700 hover:to-teal-600 text-white px-3 py-1.5 rounded-lg transition-all"
                                                            title="Approuver la recette">
                                                        Accepter
                                                    </button>
                                                </form>
                                                <form action="{{ route('recettes.reject', $recette->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="text-xs bg-gradient-to-r from-amber-500 to-amber-400 hover:from-amber-600 hover:to-amber-500 text-white px-3 py-1.5 rounded-lg transition-all"
                                                            title="Rejeter la recette">
                                                        Refuser
                                                    </button>
                                                </form>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                <div class="mt-10 flex flex-col sm:flex-row items-center justify-center">
                    <nav class="flex items-center space-x-1">
                        @if ($recettes->onFirstPage())
                            <span class="px-3 py-1 rounded-lg bg-slate-100 text-slate-400 cursor-not-allowed">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        @else
                            <a href="{{ $recettes->previousPageUrl() }}" class="px-3 py-1 rounded-lg bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 transition-colors duration-200">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        @endif
                        
                        @foreach ($recettes->getUrlRange(1, $recettes->lastPage()) as $page => $url)
                            @if ($page == $recettes->currentPage())
                                <span class="px-3 py-1 rounded-lg bg-gradient-to-r from-teal-500 to-amber-400 text-white">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="px-3 py-1 rounded-lg bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 transition-colors duration-200">{{ $page }}</a>
                            @endif
                        @endforeach
                        
                        @if ($recettes->hasMorePages())
                            <a href="{{ $recettes->nextPageUrl() }}" class="px-3 py-1 rounded-lg bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 transition-colors duration-200">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        @else
                            <span class="px-3 py-1 rounded-lg bg-slate-100 text-slate-400 cursor-not-allowed">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        @endif
                    </nav>
                </div>
            </main>
        </div>
    </div>
</body>

</html>