
  
      

       
           

            <!-- Contenu -->
            <main class="flex-1 overflow-y-auto p-6 bg-slate-900/50">
                <!-- Cartes Statistiques -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-gradient-to-br from-indigo-500/20 to-purple-600/20 p-6 rounded-2xl border border-slate-700/30 backdrop-blur-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm text-slate-400 mb-1">Cours programés</div>
                                <div class="text-2xl font-bold text-slate-200"><?= $nbrCoursEtudiant ?> cours</div>
                            </div>
                            <i class="fas fa-clock text-3xl text-indigo-400"></i>
                        </div>
                        <div class="mt-4">
                            <div class="h-1 bg-slate-700/50 rounded-full">
                                <div class="w-3/4 h-full bg-indigo-400 rounded-full"></div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-pink-500/20 to-orange-600/20 p-6 rounded-2xl border border-slate-700/30 backdrop-blur-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm text-slate-400 mb-1">heures absenté </div>
                                <div class="text-2xl font-bold text-slate-200"><?= $absence ?> heures</div>
                            </div>
                            <i class="fas fa-check-circle text-3xl text-pink-400"></i>
                        </div>
                        <div class="mt-4 text-sm text-pink-400 flex items-center">
                            <i class="fas fa-arrow-up mr-2"></i>
                            +2.4% vs dernier mois
                        </div>
                    </div>

                    <!-- Ajouter d'autres cartes similaires -->
                </div>

                <!-- Graphique et Calendrier -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                    <!-- Graphique -->
                    <div class="lg:col-span-2 bg-slate-800/50 p-6 rounded-2xl border border-slate-700/30 backdrop-blur-lg">
                         <!-- Dernières Activités -->
                <div class="bg-slate-800/50 p-6 rounded-2xl border border-slate-700/30 backdrop-blur-lg">
                    <h3 class="text-lg font-semibold text-slate-200 mb-4">Activités Récentes</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php foreach ($justifications as $j) : ?>
                        <div class="p-4 bg-slate-700/20 rounded-xl">
                            <div class="flex items-center justify-between mb-2">
                                <div class="text-sm text-slate-300">Justification soumise</div>
                                <div class="text-xs text-slate-400">2h ago</div>
                            </div>
                            <div class="text-sm text-slate-400">Absence du 15/09 - Algorithmique</div>
                            <div class="mt-2">
                                <span class="px-2 py-1 bg-yellow-400/10 text-yellow-400 text-xs rounded-full">En attente</span>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    </div>
                </div>
                    </div>

                    <!-- Prochains Cours -->
                    <div class="bg-slate-800/50 p-6 rounded-2xl border border-slate-700/30 backdrop-blur-lg">
                        <h3 class="text-lg font-semibold text-slate-200 mb-4">Prochaines Séances</h3>
                        <div class="space-y-4">
                        <?php foreach ($coursEtudiant as $c) : ?>
                            <div class="flex items-center p-3 hover:bg-slate-700/30 rounded-xl transition-colors">
                                <div class="w-10 h-10 bg-indigo-400/10 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-code text-indigo-400"></i>
                                </div>
                                <div>
                                    <div class="font-medium text-slate-200"><?= $c["module_libelle"] ?></div>
                                    <div class="text-sm text-slate-400"><?= $c["heure_debut"] ?> - <?= $c["salle"] ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                            <!-- Ajouter d'autres cours -->
                        </div>
                    </div>
                </div>

               
            </main>

    <!-- Bouton Flottant -->
    <button class="fixed bottom-8 right-8 w-12 h-12 bg-gradient-to-br from-indigo-400 to-purple-600 rounded-xl shadow-2xl flex items-center justify-center hover:scale-105 transition-transform">
        <i class="fas fa-plus text-white"></i>
    </button>
