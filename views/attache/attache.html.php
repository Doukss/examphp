
    

    <!-- Contenu principal -->
    <main class="max-w-7xl mx-auto px-6 py-8">
        <!-- En-tête -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <div class="space-y-2">
                <h2 class="text-3xl font-bold text-gray-100">Liste des Classes</h2>
                <p class="text-indigo-300 font-medium">Année scolaire 2023/2024</p>
            </div>
            <button class="flex items-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 rounded-lg transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nouvelle Classe
            </button>
        </div>

        <!-- Filtres -->
        <div class="flex flex-wrap gap-4 mb-8">
            <div class="relative flex-1 min-w-[300px]">
                <input type="text" 
                       placeholder="Rechercher une classe..." 
                       class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg 
                              focus:ring-2 focus:ring-indigo-500 text-gray-100 placeholder-gray-500">
            </div>
            <select class="bg-gray-800 border border-gray-700 text-gray-100 px-4 py-2 rounded-lg">
                <option class="bg-gray-800">Toutes les filières</option>
                <option class="bg-gray-800">Développement Web</option>
                <option class="bg-gray-800">Data Science</option>
            </select>
        </div>

        <!-- Grille des classes -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($classes as $class): ?>
            <article class="class-card group relative rounded-xl p-6 border border-gray-800 hover:border-indigo-500/30">
                <!-- Élément décoratif -->
                <div class="absolute top-0 right-0 w-px h-32 bg-gradient-to-b from-indigo-500/0 via-indigo-500/40 to-indigo-500/0"></div>

                <div class="flex flex-col h-full">
                    <!-- En-tête de la carte -->
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-100 mb-1"><?= $class['libelle'] ?></h3>
                            <div class="flex items-center gap-2 text-sm text-indigo-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                                <span><?= $class['filiere'] ?></span>
                            </div>
                        </div>
                        <span class="stats-badge px-3 py-1 rounded-full text-xs font-medium">
                            <?= getNombreEtudiantsParClasse($class['id_classe'], $anneeScolaire) ?> Étudiants
                        </span>
                    </div>

                    <!-- Corps de la carte -->
                    <div class="flex-1 space-y-4">
                        <!-- Niveau -->
        <div class="flex items-center gap-3">
            <div class="p-2 bg-gray-800 rounded-lg">
                <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-400">Niveau</p>
                <p class="text-gray-100 font-medium"><?= $class['niveau'] ?></p>
            </div>
        </div>

        <!-- Statistiques d'absences -->
        <div class="space-y-2">
            <div class="flex justify-between text-sm">
                <span class="text-gray-400">Nombres de cours</span>
                <span class=" font-medium">
                    <?= getNombreCoursParClasse($class['id_classe']) ?> cours
                </span>
            </div>
            
        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-6 flex items-center justify-between border-t border-gray-800 pt-4">
                        <a href="<?= WEBROOT?>?controller=attache&page=listeEtudiant&id_classe=<?= $class["id_classe"] ?>" class="flex items-center text-indigo-400 hover:text-indigo-300 text-sm">
                            Voir les étudiants
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                        <div class="flex gap-2 text-gray-400">
                            <button class="p-2 hover:bg-gray-800 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </main>
