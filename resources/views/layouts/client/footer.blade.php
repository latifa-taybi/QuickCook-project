<footer class="bg-slate-900 text-white pt-16 pb-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
            <div class="md:col-span-2">
                <h4 class="text-xl font-bold mb-4">
                    <span class="text-brand-400">Quick</span><span class="text-accent-400">Cook</span>
                </h4>
                <p class="text-slate-400 mb-4">
                    La solution intelligente pour cuisiner avec ce que vous avez, sans gaspillage et avec plaisir.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-slate-400 hover:text-white transition">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-slate-400 hover:text-white transition">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-slate-400 hover:text-white transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-slate-400 hover:text-white transition">
                        <i class="fab fa-pinterest-p"></i>
                    </a>
                </div>
            </div>

            <div>
                <h5 class="font-semibold text-lg mb-4">Navigation</h5>
                <ul class="space-y-2">
                    <li><a href="{{route('recettes.indexSearch')}}" class="text-slate-400 hover:text-white transition">Accueil</a></li>
                    <li><a href="{{route('client.recettes')}}" class="text-slate-400 hover:text-white transition">Recettes</a></li>
                    <li><a href="{{route('mesRecettes')}}" class="text-slate-400 hover:text-white transition">Mes Recettes</a></li>
                    <li><a href="{{route('favoriesRecettes')}}" class="text-slate-400 hover:text-white transition">Favoris</a></li>
                </ul>
            </div>

            <div>
                <h5 class="font-semibold text-lg mb-4">Contact</h5>
                <ul class="space-y-3">
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt mt-1 mr-3 text-brand-400"></i>
                        <span class="text-slate-400">123 Rue de la Cuisine, Paris</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-phone-alt mr-3 text-brand-400"></i>
                        <span class="text-slate-400">+33 1 23 45 67 89</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-envelope mr-3 text-brand-400"></i>
                        <span class="text-slate-400">contact@quickcook.com</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-slate-500 text-sm mb-4 md:mb-0">
                &copy; 2023 QuickCook. Tous droits réservés.
            </p>
            <div class="flex space-x-6">
                <a href="#" class="text-slate-500 hover:text-white text-sm transition">Confidentialité</a>
                <a href="#" class="text-slate-500 hover:text-white text-sm transition">Conditions</a>
                <a href="#" class="text-slate-500 hover:text-white text-sm transition">Cookies</a>
            </div>
        </div>
    </div>
</footer>