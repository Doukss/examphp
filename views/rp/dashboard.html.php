<div class="min-h-screen bg-gray-50 p-6">
    <!-- En-tête -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Dashboard Executive</h1>
            <p class="text-gray-500">Aperçu global du campus</p>
        </div>
        <div class="flex items-center space-x-4 w-full md:w-auto">
            <div class="relative flex-1 md:flex-none">
                <input type="text" placeholder="Recherche..." 
                       class="w-full md:w-64 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
            </div>
            <div class="w-10 h-10 rounded-full bg-red-600 flex items-center justify-center text-white font-medium">
                AD
            </div>
        </div>
    </div>

    <!-- Cartes Statistiques -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Carte Classes -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
            <div class="text-3xl font-bold text-gray-900 mb-2"><?= $totalClasses ?></div>
            <div class="text-gray-600">Classes Actives</div>
            <div class="mt-4 h-2 bg-gray-200 rounded-full">
                <div class="h-full bg-red-600 rounded-full" style="width: 75%"></div>
            </div>
        </div>
        
        <!-- Carte Professeurs -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
            <div class="text-3xl font-bold text-gray-900 mb-2"><?= $totalProfs ?></div>
            <div class="text-gray-600">Enseignants</div>
            <div class="mt-4 h-2 bg-gray-200 rounded-full">
                <div class="h-full bg-red-600 rounded-full" style="width: 75%"></div>
            </div>
        </div>
        
        <!-- Carte Étudiants -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
            <div class="text-3xl font-bold text-gray-900 mb-2"><?= $totalEtudiants ?></div>
            <div class="text-gray-600">Étudiants</div>
            <div class="mt-4 h-2 bg-gray-200 rounded-full">
                <div class="h-full bg-red-600 rounded-full" style="width: 75%"></div>
            </div>
        </div>
        
        <!-- Carte Cours -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
            <div class="text-3xl font-bold text-gray-900 mb-2"><?= $totalCours ?></div>
            <div class="text-gray-600">Cours dispensés</div>
            <div class="mt-4 h-2 bg-gray-200 rounded-full">
                <div class="h-full bg-red-600 rounded-full" style="width: 75%"></div>
            </div>
        </div>
    </div>

    <!-- Section Graphiques -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Calendrier académique -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Calendrier académique</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 rounded-lg bg-red-50 hover:bg-red-100 transition">
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-red-600 rounded-full"></div>
                        <span class="text-gray-700">Rentrée scolaire</span>
                    </div>
                    <span class="text-gray-500">01 Sept</span>
                </div>
                <!-- Ajouter d'autres événements -->
            </div>
        </div>
        
        <!-- Étudiants à risque -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-900">Étudiants à risque</h3>
                <span class="text-sm text-red-600 font-medium">28h+ d'absence</span>
            </div>
            
            <div class="space-y-3 max-h-80 overflow-y-auto pr-2">
                <!-- Étudiant 1 -->
                <div class="bg-gray-50 px-4 py-3 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 rounded-full bg-red-600 flex items-center justify-center text-white font-medium">
                            AD
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-semibold text-gray-900 truncate">Awa Diop</h4>
                            <p class="text-sm text-gray-500 truncate">L1 Informatique</p>
                        </div>
                        <div class="flex items-center">
                            <span class="text-red-600 text-sm font-medium mr-2">28h</span>
                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-medium">
                                Critique
                            </span>
                        </div>
                    </div>
                </div>
                
                <!-- Étudiant 2 -->
                <div class="bg-gray-50 px-4 py-3 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 rounded-full bg-red-600 flex items-center justify-center text-white font-medium">
                            MB
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-semibold text-gray-900 truncate">Moussa Ba</h4>
                            <p class="text-sm text-gray-500 truncate">L2 Mathématiques</p>
                        </div>
                        <div class="flex items-center">
                            <span class="text-red-600 text-sm font-medium mr-2">25h</span>
                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-medium">
                                Critique
                            </span>
                        </div>
                    </div>
                </div>
                
                <!-- Étudiant 3 -->
                <div class="bg-gray-50 px-4 py-3 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 rounded-full bg-orange-500 flex items-center justify-center text-white font-medium">
                            SK
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-semibold text-gray-900 truncate">Sokhna Kane</h4>
                            <p class="text-sm text-gray-500 truncate">L3 Physique</p>
                        </div>
                        <div class="flex items-center">
                            <span class="text-orange-600 text-sm font-medium mr-2">22h</span>
                            <span class="px-2 py-1 bg-orange-100 text-orange-800 rounded-full text-xs font-medium">
                                Élevé
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Légende -->
            <div class="mt-6 pt-4 border-t border-gray-200">
                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 rounded-full bg-red-600"></div>
                        <span>Critique (25h+)</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 rounded-full bg-orange-500"></div>
                        <span>Élevé (20-24h)</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                        <span>Modéré (15-19h)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>