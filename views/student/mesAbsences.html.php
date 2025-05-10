<div class="flex-1 overflow-y-auto p-6 bg-slate-900/50">
<!-- En-tête -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-200">Mes Absences</h1>
                <p class="text-slate-400 mt-2">Historique complet de vos absences</p>
            </div>
            <button class="mt-4 md:mt-0 px-6 py-2 bg-gradient-to-br from-purple-500 to-pink-400 rounded-lg hover:opacity-90 transition-opacity">
                <i class="fas fa-plus mr-2"></i>Justifier une absence
            </button>
        </div>

        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-slate-800/50 p-4 rounded-xl border border-slate-700/30 backdrop-blur-lg">
                <div class="text-purple-400 text-2xl font-bold mb-1"><?= $nbreAbsence ?></div>
                <div class="text-sm text-slate-400">Absences totales</div>
            </div>
            <div class="bg-slate-800/50 p-4 rounded-xl border border-slate-700/30 backdrop-blur-lg">
                <div class="text-green-400 text-2xl font-bold mb-1"><?= $nbrAbsenceJustifier ?></div>
                <div class="text-sm text-slate-400">Justifiées</div>
            </div>
            <div class="bg-slate-800/50 p-4 rounded-xl border border-slate-700/30 backdrop-blur-lg">
                <div class="text-red-400 text-2xl font-bold mb-1"><?= $absenceHeure ?>h</div>
                <div class="text-sm text-slate-400">Heures manquées</div>
            </div>
            <div class="bg-slate-800/50 p-4 rounded-xl border border-slate-700/30 backdrop-blur-lg">
                <div class="text-yellow-400 text-2xl font-bold mb-1"><?= $nbreAbsenceAtente ?></div>
                <div class="text-sm text-slate-400">En attente</div>
            </div>
        </div>

        <!-- Filtres -->
        <div class="bg-slate-800/50 p-4 rounded-xl border border-slate-700/30 backdrop-blur-lg mb-6">
            <div class="flex flex-col md:flex-row gap-4">
                <select class="bg-slate-800/50 border border-slate-700/30 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400/30">
                    <option>Tous les statuts</option>
                    <option>Justifiées</option>
                    <option>Non justifiées</option>
                    <option>En attente</option>
                </select>
                
                <input type="date" class="bg-slate-800/50 border border-slate-700/30 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400/30">
                
                <input type="text" placeholder="Rechercher..." class="bg-slate-800/50 border border-slate-700/30 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400/30 flex-grow">
            </div>
        </div>

      <!-- Tableau des Absences -->
<div class="bg-gradient-to-br from-slate-800/60 to-slate-900/40 rounded-2xl border border-slate-700/30 backdrop-blur-xl shadow-2xl shadow-slate-900/30 overflow-x-auto">
    <table class="w-full">
        <thead class="border-b border-slate-700/50">
            <tr class="text-left [&>th]:font-semibold">
                <th class="p-4 text-slate-400/90 font-medium">DATE</th>
                <th class="p-4 text-slate-400/90 font-medium">MODULE</th>
                <th class="p-4 text-slate-400/90 font-medium">STATUT</th>
                <th class="p-4 text-slate-400/90 font-medium text-right">HEURES</th>
                <th class="p-4 text-slate-400/90 font-medium text-center">ACTIONS</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-700/30">
        <?php foreach($absences as $absence): ?>
            <tr class="group hover:bg-slate-700/10 transition-colors duration-200">
                <td class="p-4 font-medium text-slate-300/90"><?= date('d/m/Y', strtotime($absence['date'])) ?></td>
                <td class="p-4">
                    <div class="flex items-center gap-2">
                        <div class="size-2 bg-purple-400/80 rounded-full shadow-pulse"></div>
                        <?= htmlspecialchars($absence['libelle']) ?>
                    </div>
                </td>
                <td class="p-4">
                    <?php
                        $colorConfig = [
                            'En_attente' => 'bg-amber-400/15 text-amber-400 ring-amber-400/20',
                            'Acceptée' => 'bg-emerald-400/15 text-emerald-400 ring-emerald-400/20',
                            'Refusée' => 'bg-rose-400/15 text-rose-400 ring-rose-400/20'
                        ];
                        $colorClass = $colorConfig[$absence['statut']] ?? 'bg-slate-600/15 text-slate-300';
                    ?>
                    <div class="flex">
                        <span class="px-3 py-1.5 <?= $colorClass ?> rounded-full text-sm font-medium ring-1 ring-inset leading-none">
                            <?= str_replace('_', ' ', htmlspecialchars($absence['statut'])) ?>
                        </span>
                    </div>
                </td>
                <td class="p-4 text-right text-slate-300/80 font-mono"><?= $absence['duree'] ?>h</td>
                <td class="p-4">
                    <div class="flex justify-center gap-2">
                        <?php if ($absence['statut'] === 'En_attente') : ?>
                            <a href="<?= WEBROOT?>?controller=student&page=justification&id=<?= $absence['id'] ?>" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-400/10 hover:bg-amber-400/20 text-amber-400 rounded-lg text-sm font-medium transition-all duration-200 hover:scale-[1.02]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Justifier
                            </a>
                        <?php else : ?>
                            <a href="<?= WEBROOT?>?controller=student&page=detailJustification&id=<?= $absence['id'] ?>" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-600/10 hover:bg-slate-600/20 text-slate-300 rounded-lg text-sm font-medium transition-all duration-200 hover:scale-[1.02]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 12s3-7.5 10-7.5S22 12 22 12s-3 7.5-10 7.5S2 12 2 12z"/>
                                </svg>
                                Détails
                            </a>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="mt-6 flex justify-between items-center">
    <span class="text-sm text-slate-400/80">Page 2 sur 8</span>
    <div class="flex gap-1">
        <button class="size-9 flex items-center justify-center bg-slate-800/50 hover:bg-slate-700/30 rounded-lg text-slate-400 transition-all duration-200 hover:text-purple-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        <button class="size-9 bg-slate-800/50 text-slate-300">1</button>
        <button class="size-9 bg-purple-400/10 text-purple-400 font-semibold">2</button>
        <button class="size-9 bg-slate-800/50 hover:bg-slate-700/30 text-slate-400">3</button>
        <button class="size-9 flex items-center justify-center bg-slate-800/50 hover:bg-slate-700/30 rounded-lg text-slate-400 transition-all duration-200 hover:text-purple-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
    </div>
</div>
    </div>

    <!-- Modal Justification -->
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center hidden">
        <div class="bg-slate-800/90 backdrop-blur-lg rounded-2xl border border-slate-700/30 p-6 w-full max-w-lg">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-slate-200">Justifier une absence</h3>
                <button class="text-slate-400 hover:text-slate-300">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form class="space-y-4">
                <div>
                    <label class="block text-slate-300 mb-2">Sélectionner l'absence</label>
                    <select class="w-full bg-slate-800/50 border border-slate-700/30 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400/30">
                        <option>15/09/2023 - Algorithmique</option>
                        <option>12/09/2023 - Développement Web</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-slate-300 mb-2">Motif</label>
                    <textarea class="w-full bg-slate-800/50 border border-slate-700/30 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400/30 h-32"></textarea>
                </div>
                
                <div>
                    <label class="block text-slate-300 mb-2">Pièce jointe</label>
                    <div class="flex items-center space-x-2">
                        <input type="file" class="hidden">
                        <button class="px-4 py-2 bg-slate-700/50 rounded-lg hover:bg-slate-700/30 transition-colors">
                            <i class="fas fa-paperclip mr-2"></i>Choisir un fichier
                        </button>
                        <span class="text-slate-400 text-sm">PDF, JPG ou PNG</span>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-4">
                    <button class="px-6 py-2 border border-slate-700/50 rounded-lg hover:bg-slate-700/30 transition-colors">
                        Annuler
                    </button>
                    <button class="px-6 py-2 bg-gradient-to-br from-purple-500 to-pink-400 rounded-lg hover:opacity-90 transition-opacity">
                        Envoyer
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>