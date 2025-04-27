@include('layouts.client.header')

<!-- Hero Section -->
<section class="relative py-16 bg-gradient-to-br from-brand-50 to-white">
    <!-- Grain overlay for texture -->
    <div class="grain-overlay"></div>
    
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -right-32 -top-32 w-64 h-64 rounded-full bg-brand-100/20 blur-3xl"></div>
        <div class="absolute -left-32 -bottom-32 w-64 h-64 rounded-full bg-accent-100/20 blur-3xl"></div>
    </div>
    
    <div class="container mx-auto px-4 relative">
        <div class="text-center max-w-3xl mx-auto fade-in">
            <h1 class="font-bold text-4xl sm:text-5xl text-slate-900 mb-6">
                Explorez nos <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-600 to-accent-500">recettes</span>
            </h1>
            <p class="text-xl text-slate-600 max-w-2xl mx-auto">
                Découvrez notre collection complète de recettes délicieuses et faciles à préparer. 
                Trouvez l'inspiration pour vos prochains repas !
            </p>
        </div>
    </div>
</section>

<!-- Search Section -->
<section class="py-8 bg-white">
    <div class="container mx-auto px-4">
        <div class="bg-glass rounded-2xl shadow-strong p-6 max-w-4xl mx-auto border border-slate-100">
            <form action="{{route('rechercheRecette')}}" method="POST" class="relative">
                @csrf
                <div class="flex flex-col md:flex-row gap-4 items-center">
                    <div class="relative w-full">
                        <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                        <input type="text" name="search" placeholder="Rechercher une recette..." 
                               class="w-full pl-12 pr-4 py-3 border border-slate-200 rounded-lg focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition">
                    </div>
                    <button type="submit" 
                            class="btn-hover w-full md:w-auto bg-gradient-to-r from-brand-500 to-brand-600 hover:from-brand-600 hover:to-brand-700 text-white font-medium px-6 py-3 rounded-lg shadow-md transition-all duration-300 flex items-center justify-center">
                        <span>Rechercher</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Recipes Grid Section -->
<section class="py-16 bg-slate-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($recettes as $recette)
            <div class="group relative fade-in">
                <div class="absolute -inset-1 rounded-xl bg-gradient-to-r from-brand-500/10 to-accent-500/10 opacity-0 group-hover:opacity-100 blur transition-all duration-300"></div>
                <div class="card-hover relative h-full bg-white rounded-xl overflow-hidden shadow-md border border-slate-100 hover:border-brand-100 transition-all duration-300">
                    <div class="relative h-56 overflow-hidden">
                        <img src="{{ asset('storage/' . $recette->image) }}" alt="{{ $recette->name }}" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/50 via-transparent to-transparent"></div>
                        <div class="absolute top-4 right-4">
                            <form action="{{route('favories', $recette->id)}}" method="POST">
                            @csrf
                                <button class="bg-white/90 p-2 rounded-full shadow-md hover:bg-accent-100 hover:text-accent-600 transition favorite-btn">
                                    <i class="{{ Auth::user()->recettes->contains($recette->id) ? 'fas text-accent-500' : 'far' }} fa-heart"></i>
                                </button>
                            </form>
                        </div>
                        <div class="absolute bottom-4 left-4">
                            <span class="inline-block bg-brand-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                {{ $recette->category }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-semibold text-xl text-slate-900 mb-2">{{$recette->name}}</h3>
                        <div class="flex items-center text-sm text-slate-500 mb-3">
                            <div class="flex items-center mr-4">
                                <i class="fas fa-clock mr-1.5"></i>
                                <span>{{ $recette->prepTime }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-utensils mr-1.5"></i>
                                <span>{{ $recette->difficulty }}</span>
                            </div>
                        </div>
                        <p class="text-slate-600 text-sm mb-4 line-clamp-2">{{$recette->description}}</p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach($recette->ingredients->take(3) as $ingredient)
                            <span class="text-xs bg-slate-100 text-slate-800 px-2.5 py-1 rounded-full">{{$ingredient->name}}</span>
                            @endforeach
                            @if($recette->ingredients->count() > 3)
                            <span class="text-xs bg-slate-100 text-slate-800 px-2.5 py-1 rounded-full">+{{$recette->ingredients->count() - 3}}</span>
                            @endif
                        </div>
                        <a href="{{ route('recettes.show', $recette->id) }}" 
                           class="inline-flex items-center text-brand-500 hover:text-brand-700 font-medium text-sm transition-colors">
                            Voir la recette
                            <i class="fas fa-arrow-right ml-1.5 text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            <nav class="inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                @if ($recettes->onFirstPage())
                    <span class="inline-flex items-center px-4 py-2 rounded-l-md border border-slate-200 bg-white text-slate-400 cursor-not-allowed">
                        &laquo;
                    </span>
                @else
                    <a href="{{ $recettes->previousPageUrl() }}" class="inline-flex items-center px-4 py-2 rounded-l-md border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 transition-colors">
                        &laquo;
                    </a>
                @endif

                @foreach ($recettes->getUrlRange(1, $recettes->lastPage()) as $page => $url)
                    @if ($page == $recettes->currentPage())
                        <span class="inline-flex items-center px-4 py-2 border border-brand-500 bg-brand-500 text-white">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" class="inline-flex items-center px-4 py-2 border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 transition-colors">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                @if ($recettes->hasMorePages())
                    <a href="{{ $recettes->nextPageUrl() }}" class="inline-flex items-center px-4 py-2 rounded-r-md border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 transition-colors">
                        &raquo;
                    </a>
                @else
                    <span class="inline-flex items-center px-4 py-2 rounded-r-md border border-slate-200 bg-white text-slate-400 cursor-not-allowed">
                        &raquo;
                    </span>
                @endif
            </nav>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-gradient-brand">
    <div class="container mx-auto px-4 text-center">
        <h2 class="font-bold text-3xl sm:text-4xl text-white mb-6 fade-in">
            Vous ne trouvez pas ce que vous cherchez ?
        </h2>
        <p class="text-xl text-white/90 max-w-2xl mx-auto mb-8 fade-in" style="animation-delay: 0.2s;">
            Essayez notre moteur de recherche avancé par ingrédients pour trouver des recettes adaptées à ce que vous avez déjà.
        </p>
        <a href="{{route('recettes.indexSearch')}}" 
           class="btn-hover inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-lg shadow-lg text-brand-700 bg-white hover:bg-slate-50 transition-colors duration-300 fade-in" 
           style="animation-delay: 0.4s;">
            Recherche par ingrédients
            <i class="fas fa-arrow-right ml-2"></i>
        </a>
    </div>
</section>

@include('layouts.client.footer')

<!-- Back to Top Button -->
<button id="back-to-top"
    class="fixed bottom-8 right-8 bg-brand-600 text-white w-12 h-12 rounded-full shadow-lg flex items-center justify-center transition-all duration-300 opacity-0 invisible hover:bg-brand-700">
    <i class="fas fa-arrow-up"></i>
</button>

<script>
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
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Animation on scroll
    const fadeElements = document.querySelectorAll('.fade-in');
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

    window.addEventListener('scroll', fadeInOnScroll);
    window.addEventListener('load', fadeInOnScroll);
</script>