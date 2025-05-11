@include('layouts.client.header')

    <!-- Search Section -->
    <section id="search-section" class="py-16 bg-gradient-to-br from-brand-50 to-white">
        <div class="container mx-auto px-4">
            <form action="{{ route('recettes.search') }}" method="POST" 
                  class="max-w-4xl mx-auto bg-white rounded-2xl shadow-strong p-8 backdrop-blur-sm bg-white/90 border border-slate-100">
                @csrf
                <div class="text-center mb-8 fade-in">
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">
                        Quels <span class="text-gradient">ingrédients</span> avez-vous ?
                    </h2>
                    <p class="text-slate-600">
                        Entrez les ingrédients que vous avez dans votre cuisine et nous vous proposerons des recettes adaptées.
                    </p>
                </div>

                <div class="flex flex-col md:flex-row gap-4 mb-6">
                    <div class="flex-1 relative">
                        <select id="ingredient" name="ingredient" multiple placeholder="Rechercher un ingrédient..."
                                autocomplete="off"
                                class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:border-brand-400 focus:ring-2 focus:ring-brand-100 outline-none transition">
                            @foreach ($allIngredients as $ingredient)
                                <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button id="add-ingredient-btn" type="button"
                            class="btn-hover bg-gradient-to-r from-brand-500 to-brand-600 text-white font-semibold py-3 px-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 hover:from-brand-600 hover:to-brand-700">
                        Ajouter
                    </button>
                </div>

                <div class="mb-8">
                    <div class="text-sm text-slate-500 mb-3">Ingrédients sélectionnés :</div>
                    <div id="containerTag" class="flex flex-wrap gap-2"></div>
                </div>
                
                <button type="submit"
                        class="w-full btn-hover bg-gradient-to-r from-accent-500 to-accent-600 text-white font-semibold py-4 px-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 hover:from-accent-600 hover:to-accent-700">
                    <i class="fas fa-utensils mr-2"></i> Trouver des recettes
                </button>
            </form>
        </div>
    </section>

    <!-- Results Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl md:text-3xl font-semibold text-slate-900">
                    @if (isset($recettes) && $recettes->count() > 0)
                        <span class="text-brand-600">{{ $recettes->count() }}</span> recettes trouvées
                    @else
                        Aucune recette trouvée
                    @endif
                </h2>
            </div>

            @if (isset($recettes) && $recettes->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($recettes as $recette)
                        <div class="card-hover bg-white rounded-2xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-1 border border-slate-100">
                            <div class="relative h-64 overflow-hidden">
                                <img src="{{ asset('storage/' . $recette->image) }}" alt="{{ $recette->name }}"
                                     class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/70 via-transparent to-transparent"></div>
                                <div class="absolute top-4 right-4">
                                    <form action="{{route('favories', $recette->id)}}" method="POST">
                                        @csrf
                                        <button class="bg-white/90 p-2 rounded-full shadow-md hover:bg-accent-100 hover:text-accent-600 transition">
                                            <i class="{{ Auth::user()->recettes->contains($recette->id) ? 'fas text-accent-500' : 'far' }} fa-heart"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="absolute bottom-4 left-4">
                                    <span class="inline-block bg-brand-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                        {{ $recette->category}}
                                    </span>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-slate-900 mb-2">{{ $recette->name }}</h3>
                                <div class="flex items-center text-sm text-slate-500 mb-4">
                                    <div class="flex items-center mr-4">
                                        <i class="fas fa-clock mr-1.5"></i>
                                        <span>{{ $recette->prepTime }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-utensils mr-1.5"></i>
                                        <span>{{ $recette->difficulty }}</span>
                                    </div>
                                </div>
                                <p class="text-slate-600 text-sm mb-4 line-clamp-2">{{ $recette->description }}</p>
                                <a href="{{ route('recettes.show', $recette->id) }}"
                                   class="inline-flex items-center text-brand-500 hover:text-brand-700 font-medium text-sm transition-colors">
                                    Voir la recette
                                    <i class="fas fa-arrow-right ml-1.5 text-xs"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-2xl shadow-md overflow-hidden text-center py-12 border border-slate-100">
                    <div class="max-w-md mx-auto">
                        <i class="fas fa-utensils text-5xl text-slate-300 mb-4"></i>
                        <h3 class="text-xl font-semibold text-slate-900 mb-2">Aucune recette trouvée</h3>
                        <p class="text-slate-600 mb-6">Essayez d'ajouter plus d'ingrédients pour élargir votre recherche.</p>
                        <a href="#search-section"
                           class="inline-flex items-center bg-brand-500 text-white font-medium py-2 px-6 rounded-lg shadow-sm hover:bg-brand-600 transition">
                            Nouvelle recherche
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    @include('layouts.client.footer')

    <!-- Back to Top Button -->
    <button id="back-to-top"
            class="fixed bottom-8 right-8 bg-brand-500 text-white w-12 h-12 rounded-full shadow-lg flex items-center justify-center transition opacity-0 invisible hover:bg-brand-600">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
    <script>

        const selectElement = document.querySelector('#ingredient');
        const ts = new TomSelect(selectElement, {
            maxItems: 1,
            placeholder: 'Rechercher un ingrédient...',
        });

        const addButton = document.querySelector('#add-ingredient-btn');
        const tagContainer = document.querySelector('#containerTag');

        addButton.addEventListener('click', (e) => {
            e.preventDefault();
            const selectedOptions = ts.getValue();

            selectedOptions.forEach(id => {
                if (document.querySelector(`[data-id="${id}"]`)) return;

                const label = ts.options[id]?.text || '';
                const html = `
                    <div class="flex items-center gap-1 bg-brand-100 text-brand-700 px-3 py-1 rounded-full text-sm cursor-pointer transition hover:bg-brand-200" data-id="${id}">
                        <span>${label}</span>
                        <span class="ml-1 text-xs font-bold cursor-pointer remove-tag">✕</span>
                        <input type="hidden" name="ingredients[]" value="${label}">
                    </div>
                `;
                tagContainer.innerHTML += html;
            });

            ts.clear();
        });

        tagContainer.addEventListener('click', (e) => {
            if (e.target.classList.contains('remove-tag')) {
                const parent = e.target.closest('[data-id]');
                const id = parent.getAttribute('data-id');
                parent.remove();
                ts.removeItem(id);
            }
        });

        // Menu mobile
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
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
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Animation au scroll
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
</body>

</html>