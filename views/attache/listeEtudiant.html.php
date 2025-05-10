 

    <!-- Contenu principal -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- En-tête -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 space-y-4 md:space-y-0">
            <h2 class="text-2xl font-bold text-indigo-400 neon-effect"><?= $classe[0]['libelle'] ?> - Promotion <?= $annee ?></h2>
            <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                <input type="text" 
                       placeholder="Rechercher un étudiant..." 
                       class="px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg 
                              focus:outline-none focus:ring-2 focus:ring-indigo-500 
                              placeholder-gray-500 text-gray-100 transition-all">
                <a href="<?= WEBROOT?>?controller=attache&page=ajoutEtudiant&id_classe=<?= $classe[0]["id_classe"]?>">
                    <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 
                                flex items-center justify-center gap-2 transition-colors">
                        <svg class="w-5 h-5">
                            <use href="#icon-plus" />
                        </svg>
                        Nouvel Étudiant
                    </button>
                </a>
            </div>
        </div>

        <!-- Tableau -->
        <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden shadow-xl">
        <?php if ($students) : ?>
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-800">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-indigo-400">Matricule</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-indigo-400">Étudiant</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-indigo-400">Adresse</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-indigo-400">Absences</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-indigo-400">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    <?php foreach ($students as $student): ?>
                    <tr class="hover:bg-gray-750 transition-colors">
                        <td class="px-6 py-4">
                            <span class="font-mono text-indigo-300"><?= $student['matricule'] ?></span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full border-2 border-indigo-500/30" 
                                         src="https://i.pravatar.cc/50?img=10" 
                                         alt="<?= $student['prenom'] ?>">
                                </div>
                                <div>
                                    <div class="font-medium"><span><?= $student['prenom'] ?> <?= $student['prenom'] ?></span></div>
                                    <div class="text-sm text-gray-400"><?= $student['email'] ?></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-300"><?= $student['adresse'] ?></td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-1 text-xs font-medium rounded-full 
                                            <?=     $nbresAbsence = getNombreAbsences($_SESSION["user"]["id"], "student") > 5 ? 'bg-red-400/20 text-red-400' : 'bg-emerald-400/20 text-emerald-400' ?>">
                                    <?= getNombreAbsences($student["id"], "student") ?>h
                                </span>
                                <?php if(getNombreAbsences($_SESSION["user"]["id"], "student") > 5): ?>
                                <span class="animate-pulse text-red-400 text-xs">⚠️ Dépasse</span>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-3">
                                <a href="#" class="text-indigo-400 hover:text-indigo-300">
                                    <i class="ri-edit-line"></i>
                                </a>
                                <a href="#" class="text-red-400 hover:text-red-300 delete-btn">
                                 <i class="ri-chat-delete-line"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="bg-gray-850 px-6 py-4 border-t border-gray-700">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <span class="text-sm text-gray-400">
                        Affichage <span class="font-medium text-gray-200">1-10</span> sur 
                        <span class="font-medium text-indigo-400">50</span> étudiants
                    </span>
                    <div class="flex gap-2">
                        <button class="px-3 py-1 rounded-md bg-gray-800 border border-gray-700 
                                    text-gray-300 hover:bg-gray-750 transition-colors">
                            ← Précédent
                        </button>
                        <button class="px-3 py-1 rounded-md bg-indigo-600 text-white">1</button>
                        <button class="px-3 py-1 rounded-md bg-gray-800 border border-gray-700 
                                    text-gray-300 hover:bg-gray-750 transition-colors">
                            2
                        </button>
                        <button class="px-3 py-1 rounded-md bg-gray-800 border border-gray-700 
                                    text-gray-300 hover:bg-gray-750 transition-colors">
                            Suivant →
                        </button>
                    </div>
                </div>
            </div>
            <?php else: ?>
                <!-- État vide amélioré -->
                <div class="flex flex-col items-center justify-center w-full mt-12 gap-8">
                    <div class="relative w-64 h-64">
                        <img src="/image/notFound-removebg-preview.png" alt="Aucun étudiant" 
                            class="w-full h-full object-contain opacity-50">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent"></div>
                    </div>
                    <div class="text-center space-y-2">
                        <p class="text-xl font-semibold text-gray-300">Aucun etudiant trouvé</p>
                        <p class="text-sm text-gray-500 max-w-md">
                            Aucune résultat pour votre recherche. Vérifiez le libelle ou essayez un autre terme.
                        </p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Icônes SVG -->
    <svg xmlns="http://www.w3.org/2000/svg" class="hidden">
        <!-- Les mêmes icônes que précédemment mais avec stroke="currentColor" -->
        <symbol id="icon-plus" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </symbol>
        <!-- ... autres icônes ... -->
    </svg>