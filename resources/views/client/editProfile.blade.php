<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickCook - Modifier le profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand': {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                        },
                        'accent': {
                            500: '#8b5cf6',
                        },
                    },
                },
            },
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .grain-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.1'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 1;
        }

        .text-gradient {
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            background-image: linear-gradient(to right, #0ea5e9, #8b5cf6);
        }

        .bg-glass {
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
        }

        .shadow-strong {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
        }

        .btn-hover {
            transition: all 0.2s ease;
        }

        .btn-hover:hover {
            transform: translateY(-2px);
        }

        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        
        .avatar-upload {
            position: relative;
            display: inline-block;
        }
        
        .avatar-edit {
            position: absolute;
            right: 10px;
            bottom: 10px;
            z-index: 1;
        }
        
        .avatar-edit input {
            display: none;
        }
        
        .avatar-edit label {
            display: inline-block;
            width: 36px;
            height: 36px;
            margin-bottom: 0;
            border-radius: 50%;
            background: #FFFFFF;
            border: 2px solid #e0f2fe;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            font-weight: normal;
            transition: all 0.2s ease-in-out;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0ea5e9;
        }
        
        .avatar-edit label:hover {
            background: #f0f9ff;
            border-color: #bae6fd;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col">
    @include('layouts.client.header')

    <!-- Page Title Section -->
    <section class="relative py-12 bg-gradient-to-br from-brand-50 to-white">
        <!-- Grain overlay for texture -->
        <div class="grain-overlay"></div>
        
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 fade-in">
                <div>
                    <h1 class="font-bold text-3xl md:text-4xl text-slate-900">
                        Modifier mon <span class="text-gradient">profil</span>
                    </h1>
                    <p class="text-slate-600 mt-2">
                        Personnalisez votre profil et vos préférences
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content area -->
    <main class="flex-1 container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm rounded-xl mb-8 fade-in">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Form -->
                    <form id="profileForm" class="mt-4 space-y-8" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Section: Photo de profil -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-slate-800 border-b pb-2">
                                <i class="fas fa-user-circle text-brand-500 mr-2"></i> Photo de profil
                            </h3>
                            
                            <div class="flex flex-col items-center md:flex-row md:items-start space-y-6 md:space-y-0 md:space-x-8">
                                <div class="avatar-upload">
                                    <div class="avatar-preview rounded-full w-32 h-32 bg-slate-100 overflow-hidden border-4 border-white shadow-md">
                                        <img id="imagePreview" src="{{ asset('images/default-avatar.jpg') }}" alt="Photo de profil" class="w-full h-full object-cover">
                                    </div>
                                    <div class="avatar-edit">
                                        <input type="file" id="avatarUpload" name="avatar" accept="image/*" class="hidden">
                                        <label for="avatarUpload" class="btn-hover">
                                            <i class="fas fa-camera"></i>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="flex-1">
                                    <p class="text-sm text-slate-600">
                                        Téléchargez une nouvelle photo de profil. Utilisez une image carrée pour de meilleurs résultats.
                                        <br>Formats acceptés : JPG, PNG (max 2MB)
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Section: Informations personnelles -->
                        <div class="space-y-6 pt-6">
                            <h3 class="text-lg font-semibold text-slate-800 border-b pb-2">
                                <i class="fas fa-id-card text-brand-500 mr-2"></i> Informations personnelles
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="firstName" class="block text-sm font-semibold text-slate-700">Prénom</label>
                                    <input type="text" name="first_name" id="firstName" value="{{ old('first_name', $user->first_name) }}"
                                        class="mt-2 w-full py-2 px-4 border border-slate-200 rounded-lg shadow-sm focus:ring-brand-100 focus:border-brand-400 text-sm"
                                        required>
                                </div>
                                <div>
                                    <label for="lastName" class="block text-sm font-semibold text-slate-700">Nom</label>
                                    <input type="text" name="last_name" id="lastName" value="{{ old('last_name', $user->last_name) }}"
                                        class="mt-2 w-full py-2 px-4 border border-slate-200 rounded-lg shadow-sm focus:ring-brand-100 focus:border-brand-400 text-sm"
                                        required>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="email" class="block text-sm font-semibold text-slate-700">Adresse email</label>
                                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                        class="mt-2 w-full py-2 px-4 border border-slate-200 rounded-lg shadow-sm focus:ring-brand-100 focus:border-brand-400 text-sm"
                                        required>
                                </div>
                                <div>
                                    <label for="phone" class="block text-sm font-semibold text-slate-700">Téléphone (optionnel)</label>
                                    <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                                        class="mt-2 w-full py-2 px-4 border border-slate-200 rounded-lg shadow-sm focus:ring-brand-100 focus:border-brand-400 text-sm">
                                </div>
                            </div>

                            <div>
                                <label for="bio" class="block text-sm font-semibold text-slate-700">Bio (optionnel)</label>
                                <textarea id="bio" name="bio" rows="3"
                                    class="mt-2 w-full py-2 px-4 border border-slate-200 rounded-lg shadow-sm focus:ring-brand-100 focus:border-brand-400 text-sm"
                                    placeholder="Décrivez-vous en quelques mots...">{{ old('bio', $user->bio) }}</textarea>
                            </div>
                        </div>

                        

                        <!-- Section: Sécurité -->
                        <div class="space-y-6 pt-6">
                            <h3 class="text-lg font-semibold text-slate-800 border-b pb-2">
                                <i class="fas fa-lock text-brand-500 mr-2"></i> Sécurité
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="currentPassword" class="block text-sm font-semibold text-slate-700">Mot de passe actuel</label>
                                    <input type="password" name="current_password" id="currentPassword"
                                        class="mt-2 w-full py-2 px-4 border border-slate-200 rounded-lg shadow-sm focus:ring-brand-100 focus:border-brand-400 text-sm"
                                        placeholder="••••••••">
                                    <p class="text-xs text-slate-500 mt-1">Nécessaire uniquement pour changer le mot de passe</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="newPassword" class="block text-sm font-semibold text-slate-700">Nouveau mot de passe</label>
                                    <input type="password" name="password" id="newPassword"
                                        class="mt-2 w-full py-2 px-4 border border-slate-200 rounded-lg shadow-sm focus:ring-brand-100 focus:border-brand-400 text-sm"
                                        placeholder="••••••••">
                                </div>
                                <div>
                                    <label for="confirmPassword" class="block text-sm font-semibold text-slate-700">Confirmer le mot de passe</label>
                                    <input type="password" name="password_confirmation" id="confirmPassword"
                                        class="mt-2 w-full py-2 px-4 border border-slate-200 rounded-lg shadow-sm focus:ring-brand-100 focus:border-brand-400 text-sm"
                                        placeholder="••••••••">
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="pt-6 flex flex-col sm:flex-row justify-end gap-4">
                            <button type="button"
                                class="px-6 py-3 border border-slate-200 text-slate-700 font-medium rounded-lg shadow-sm hover:bg-slate-50 transition btn-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-400">
                                Annuler
                            </button>
                            <button type="submit"
                                class="px-6 py-3 bg-gradient-to-r from-brand-500 to-brand-600 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition btn-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-400">
                                Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    @include('layouts.client.footer')

    <!-- Back to Top Button -->
    <button id="back-to-top"
        class="fixed bottom-8 right-8 bg-brand-600 text-white w-12 h-12 rounded-full shadow-lg flex items-center justify-center transition-all duration-300 opacity-0 invisible hover:bg-brand-700">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Avatar preview
            const avatarUpload = document.getElementById('avatarUpload');
            const imagePreview = document.getElementById('imagePreview');
            
            avatarUpload.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
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
        });
    </script>
</body>

</html>