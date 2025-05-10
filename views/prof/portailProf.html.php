
       

        <!-- Contenu principal -->
        <main class="flex-1 p-8 overflow-auto">
            <!-- En-tête -->
            <header class="flex justify-between items-center mb-12">
                <div>
                    <h2 class="text-2xl font-bold text-white">Bienvenue, <?= $_SESSION["user"]["prenom"] ?> <?= $_SESSION["user"]["nom"] ?></h2>
                    <p class="text-slate-400">Votre agenda du <?= $date_du_jours ?></p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-rose-600 to-purple-600"></div>
                </div>
            </header>

            <!-- Statistiques -->
            <div class="grid grid-cols-3 gap-6 mb-12">
                <div class="bg-slate-800/50 p-6 rounded-2xl border border-slate-700/50 hover:border-rose-500/30 transition-all">
                    <h3 class="text-slate-400 mb-2">Cours programmés</h3>
                    <p class="text-3xl font-bold text-rose-400"><?= $nbCours ?></p>
                </div>
                <div class="bg-slate-800/50 p-6 rounded-2xl border border-slate-700/50 hover:border-purple-500/30 transition-all">
                    <h3 class="text-slate-400 mb-2">Heures enseignées</h3>
                    <p class="text-3xl font-bold text-purple-400"><?= $heuresAujourdHui ?>h</p>
                </div>
                <div class="bg-slate-800/50 p-6 rounded-2xl border border-slate-700/50 hover:border-sky-500/30 transition-all">
                    <h3 class="text-slate-400 mb-2">Absences marquées</h3>
                    <p class="text-3xl font-bold text-sky-400"><?= $nbresAbsence ?></p>
                </div>
            </div>
            <?php if ($coursProf) : ?>

            <!-- Liste des cours -->
            <section class="mb-12">
                <h2 class="text-xl font-bold text-white mb-6">Prochains cours</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 ">
                    <!-- Carte de cours -->
                    <?php foreach ($coursProf as $c) : ?>
                    <div class="bg-slate-800/50 p-6 rounded-2xl border border-slate-700/50 hover:border-rose-500/30 transition-all group">
                        <div class="flex justify-between items-start">
                            <div>
                                <div class="flex items-center gap-3 mb-3">
                                    <span class="px-3 py-1 bg-rose-600/30 text-rose-400 rounded-full text-sm"><?= $c["heure_debut"] ?> - <?= $c["heure_fin"] ?></span>
                                    <span class="text-slate-400"><?= $c["salle"] ?></span>
                                </div>
                                <h3 class="text-xl font-bold text-white mb-2"><?= $c["libelle_module"] ?></h3>
                                <p class="text-slate-400">Classes : 
                                 <?php foreach (explode(', ', $c['classes']) as $classe) : ?>
                                    <?= htmlspecialchars($classe) ?> ,
                                <?php endforeach; ?>

                                </p>
                            </div>
                            <button class="p-2 rounded-lg bg-slate-700/50 hover:bg-rose-600/30 transition-colors">
                                <i class='bx bx-chevron-right text-xl text-slate-400 group-hover:text-rose-400'></i>
                            </button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    
                </div>
            </section>

            <!-- Marquage des absences -->
            <section class="bg-slate-800/50 p-6 rounded-2xl border border-slate-700/50">
                <h2 class="text-xl font-bold text-white mb-6">Marquer les absences</h2>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="text-slate-400 border-b border-slate-700/50">
                            <tr>
                                <th class="pb-3 text-left">Étudiant</th>
                                <th class="pb-3 text-left">Classe</th>
                                <th class="pb-3 text-center">Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="hover:bg-slate-700/20 transition-colors">
                                <td class="py-4">Mohamed Ali</td>
                                <td>L2-G1</td>
                                <td class="text-center">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" class="rounded border-slate-600 bg-slate-700 text-rose-500 focus:ring-rose-500">
                                    </label>
                                </td>
                            </tr>
                            <!-- Plus d'étudiants -->
                        </tbody>
                    </table>
                </div>
                
                <div class="flex justify-end gap-4 mt-6">
                    <button class="px-6 py-2 rounded-lg bg-slate-700/50 hover:bg-slate-600/50 transition-colors text-slate-300">
                        Annuler
                    </button>
                    <button class="px-6 py-2 rounded-lg bg-gradient-to-r from-rose-600 to-purple-600 hover:from-rose-500 hover:to-purple-500 transition-all text-white">
                        Enregistrer
                    </button>
                </div>
            </section>
            <?php else: ?>
                <!-- État vide amélioré -->
                <div class="flex flex-col items-center justify-center w-full mt-12 gap-8">
                    <div class="relative w-64 h-64">
                        <img src="/image/notFound-removebg-preview.png" alt="Aucun étudiant" 
                            class="w-full h-full object-contain opacity-50">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent"></div>
                    </div>
                    <div class="text-center space-y-2">
                        <p class="text-xl font-semibold text-gray-300">Aucun cours trouvé</p>
                        <p class="text-sm text-gray-500 max-w-md">
                            Aucune résultat pour votre recherche. Vérifiez le libelle ou essayez un autre terme.
                        </p>
                    </div>
                </div>
            <?php endif; ?>
        </main>

   
