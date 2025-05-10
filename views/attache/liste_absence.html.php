
   

    <div class="max-w-7xl mx-auto px-6 py-8 flex gap-8">
    <?php require_once ROOT_PATH . "/views/components/absenceSide.php"; ?>

        <!-- Contenu principal -->
        <main class="flex-1">
            <!-- En-tête -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <div>
                    <h2 class="text-2xl font-bold">Historique des Absences</h2>
                    <p class="text-gray-400"><?= date('d M Y') ?></p>
                </div>
                <div class="flex gap-4">
                    <input type="date" class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2">
                    <select class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2">
                        <option>Toutes les classes</option>
                        <?php foreach($classes as $class): ?>
                        <option value="<?= $class['id'] ?>"><?= $class['libelle'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Liste des absences -->
            <div class="absence-card rounded-xl border border-gray-700 overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-800">
                        <tr>
                            <th class="px-6 py-4 text-left">Étudiant</th>
                            <th class="px-6 py-4 text-left">Nbre heures</th>
                            <th class="px-6 py-4 text-left">Cours</th>
                            <th class="px-6 py-4 text-left">Statut</th>
                            <th class="px-6 py-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        <?php foreach($absences as $absence): ?>
                        <tr class="hover:bg-gray-800/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 rounded-full bg-gray-700 flex items-center justify-center">
                                        <?= substr($absence['etudiant_nom'], 0, 1) ?>
                                    </div>
                                    <div>
                                        <div class="font-medium"><?= $absence['etudiant_nom'] ?></div>
                                        <div class="text-sm text-gray-400"><?= $absence['etudiant_prenom'] ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4"><?= round($absence['heures_absence'], 2) . ' h'; ?></td>
                            <td class="px-6 py-4">
                                <div class="text-indigo-400"><?= $absence['module'] ?></div>
                                <div class="text-sm text-gray-400"><?= $absence['professeur_prenom'] ?> <?= $absence['professeur_nom'] ?></div>
                            </td>
                            <td class="px-6 py-4">
                                <?php if($absence['statut'] === 'justified'): ?>
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-green-900/20 text-green-400">
                                    <span class="status-dot w-2 h-2 rounded-full bg-green-400"></span>
                                    Justifiée
                                </span>
                                <?php elseif($absence['statut'] === 'pending'): ?>
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-yellow-900/20 text-yellow-400">
                                    <span class="status-dot w-2 h-2 rounded-full bg-yellow-400"></span>
                                    En attente
                                </span>
                                <?php else: ?>
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-red-900/20 text-red-400">
                                    <span class="status-dot w-2 h-2 rounded-full bg-red-400"></span>
                                    Non justifiée
                                </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <?php if($absence['statut'] !== 'justified'): ?>
                                    <button class="hover-scale p-2 rounded-lg bg-indigo-600 hover:bg-indigo-700">
                                        <svg class="w-5 h-5">
                                            <use href="#icon-document-text" />
                                        </svg>
                                    </button>
                                    <?php endif; ?>
                                    <button class="hover-scale p-2 rounded-lg bg-gray-700 hover:bg-gray-600 delete-btn">
                                        <svg class="w-5 h-5">
                                            <use href="#icon-trash" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="bg-gray-800 px-6 py-4 border-t border-gray-700">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400">Page 1 sur 5</span>
                        <div class="flex gap-2">
                            <button class="px-3 py-1 rounded-lg bg-gray-700 hover:bg-gray-600">Précédent</button>
                            <button class="px-3 py-1 rounded-lg bg-indigo-600 hover:bg-indigo-700">1</button>
                            <button class="px-3 py-1 rounded-lg bg-gray-700 hover:bg-gray-600">2</button>
                            <button class="px-3 py-1 rounded-lg bg-gray-700 hover:bg-gray-600">Suivant</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

