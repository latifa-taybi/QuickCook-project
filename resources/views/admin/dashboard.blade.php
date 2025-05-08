<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickCook - Tableau de bord</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        slate: {
                            850: '#17212e',
                            900: '#0f172a',
                            950: '#020617'
                        },
                        teal: {
                            150: '#a8f0e6',
                            250: '#80e5d8',
                            400: '#2dd4bf',
                            500: '#14b8a6',
                            600: '#0d9488'
                        },
                        amber: {
                            400: '#f59e0b',
                            500: '#f59e0b'
                        }
                    },
                    fontFamily: {
                        sans: ['"Inter"', 'sans-serif'],
                        display: ['"Poppins"', 'sans-serif']
                    },
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        .btn-primary {
            background: linear-gradient(90deg, #0d9488 0%, #2dd4bf 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(90deg, #0f766e 0%, #14b8a6 100%);
        }
        
        .btn-secondary {
            background: linear-gradient(90deg, #f59e0b 0%, #fbbf24 100%);
        }
        
        .btn-secondary:hover {
            background: linear-gradient(90deg, #d97706 0%, #f59e0b 100%);
        }
        
        .stat-card-icon {
            background: rgba(13, 148, 136, 0.1);
        }
        
        .stat-card-icon.green {
            background: rgba(34, 197, 94, 0.1);
        }
        
        .stat-card-icon.amber {
            background: rgba(245, 158, 11, 0.1);
        }
        
        .stat-card-icon.purple {
            background: rgba(168, 85, 247, 0.1);
        }
    </style>
</head>

<body class="bg-slate-50 font-sans text-slate-800 min-h-screen flex">
    <!-- Sidebar -->
    @include('layouts.sidebar')
    
    <!-- Main content -->
    <div class="flex-1 flex flex-col ml-0">
        <!-- Top navbar -->
        @include('layouts.nav')
        
        <!-- Main content area -->
        <main class="flex-1 overflow-y-auto p-6">
            <!-- Page header with actions -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h2 class="text-2xl font-display font-bold text-slate-800">Bibliothèque de recettes</h2>
                        <p class="mt-2 text-slate-600">Gérez toutes vos recettes en un seul endroit</p>
                    </div>
                </div>
            </div>

            <!-- Stats cards -->
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">
                <!-- Recettes -->
                <div class="bg-white shadow rounded-lg overflow-hidden border border-slate-200">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 stat-card-icon rounded-lg p-3">
                                <i class="fas fa-book text-teal-600 text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-slate-500 truncate">Total des recettes</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-slate-900">{{ $recettes->count() }}</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Régimes -->
                <div class="bg-white shadow rounded-lg overflow-hidden border border-slate-200">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 stat-card-icon green rounded-lg p-3">
                                <i class="fas fa-heartbeat text-green-600 text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-slate-500 truncate">Régimes alimentaires</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-slate-900">{{$regimes->count()}}</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ingrédients -->
                <div class="bg-white shadow rounded-lg overflow-hidden border border-slate-200">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 stat-card-icon amber rounded-lg p-3">
                                <i class="fas fa-carrot text-amber-500 text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-slate-500 truncate">Ingrédients</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-slate-900">{{$ingredients->count()}}</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Utilisateurs -->
                <div class="bg-white shadow rounded-lg overflow-hidden border border-slate-200">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 stat-card-icon purple rounded-lg p-3">
                                <i class="fas fa-users text-purple-500 text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-slate-500 truncate">Utilisateurs</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-slate-900">{{$users->count()}}</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="mb-8">
                <h3 class="text-lg font-display font-medium text-slate-800 mb-4">Tableau de bord analytique</h3>
                <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
                    <!-- Chart 1: Ratio des éléments principaux -->
                    <div class="bg-white shadow rounded-lg overflow-hidden border border-slate-200">
                        <div class="px-4 py-5 sm:p-6">
                            <h4 class="text-base font-medium text-slate-700 mb-4">Distribution de contenu</h4>
                            <div class="h-64">
                                <canvas id="distributionChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Chart 2: Activité utilisateurs vs recettes -->
                    <div class="bg-white shadow rounded-lg overflow-hidden border border-slate-200">
                        <div class="px-4 py-5 sm:p-6">
                            <h4 class="text-base font-medium text-slate-700 mb-4">Nombre de recettes par utilisateur</h4>
                            <div class="h-64">
                                <canvas id="userRecipesChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Script pour les charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Configuration des couleurs
            const chartColors = [
                'rgba(13, 148, 136, 0.7)',  // teal-600
                'rgba(34, 197, 94, 0.7)',   // green-500
                'rgba(245, 158, 11, 0.7)',  // amber-500
                'rgba(168, 85, 247, 0.7)',  // purple-500
            ];

            // Chart 1: Distribution du contenu
            const ctxDistribution = document.getElementById('distributionChart').getContext('2d');
            const distributionData = {
                labels: ['Recettes', 'Régimes', 'Ingrédients', 'Utilisateurs'],
                datasets: [{
                    label: 'Nombre',
                    data: [
                        {{ $recettes->count() }},
                        {{ $regimes->count() }},
                        {{ $ingredients->count() }},
                        {{ $users->count() }}
                    ],
                    backgroundColor: chartColors,
                    borderWidth: 1,
                    borderColor: '#fff'
                }]
            };
            new Chart(ctxDistribution, {
                type: 'doughnut',
                data: distributionData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                color: '#64748b' // slate-500
                            }
                        }
                    },
                    cutout: '70%'
                }
            });

            // Chart 2: Recettes par utilisateur
            const userRecipesCtx = document.getElementById('userRecipesChart').getContext('2d');
            const userData = {
                labels: @json($userNames),
                datasets: [{
                    label: 'Nombre de recettes',
                    data: @json($recipeCounts),
                    backgroundColor: 'rgba(13, 148, 136, 0.7)',
                    borderColor: 'rgba(13, 148, 136, 1)',
                    borderWidth: 1
                }]
            };
            
            new Chart(userRecipesCtx, {
                type: 'bar',
                data: userData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Nombre de recettes',
                                color: '#64748b' // slate-500
                            },
                            ticks: {
                                precision: 0,
                                color: '#64748b' // slate-500
                            },
                            grid: {
                                color: 'rgba(226, 232, 240, 0.5)' // slate-200
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Utilisateurs',
                                color: '#64748b' // slate-500
                            },
                            ticks: {
                                color: '#64748b' // slate-500
                            },
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y + ' recettes';
                                }
                            }
                        },
                        legend: {
                            labels: {
                                color: '#64748b' // slate-500
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>