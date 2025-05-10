<div class="min-h-screen bg-gradient-to-br from-slate-900 to-slate-800 p-8">
    <div class="max-w-7xl mx-auto space-y-8">
        <!-- En-tête -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent">
                    Gestion des Justifications
                </h1>
                <p class="mt-1 text-slate-400">Validation des justifications d'absence</p>
            </div>
            <div class="flex gap-3">
                <div class="relative">
                    <select class="pl-10 pr-4 py-2 bg-slate-800/50 border border-slate-700/30 rounded-lg text-slate-300 appearance-none focus:ring-2 focus:ring-purple-400/50">
                        <option>Toutes</option>
                        <option>En attente</option>
                        <option>Acceptées</option>
                        <option>Refusées</option>
                    </select>
                    <svg class="w-5 h-5 absolute left-3 top-2.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                </div>
                <input type="text" placeholder="Rechercher..." class="px-4 py-2 bg-slate-800/50 border border-slate-700/30 rounded-lg text-slate-300 focus:ring-2 focus:ring-purple-400/50 w-64">
            </div>
        </div>

        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-slate-800/50 backdrop-blur-lg p-4 rounded-xl border border-slate-700/30">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-purple-400/10 rounded-lg">
                        <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-2xl font-semibold text-slate-300">152</div>
                        <div class="text-sm text-slate-500">En attente</div>
                    </div>
                </div>
            </div>
            <!-- Ajouter d'autres cartes de stats ici -->
        </div>

        <!-- Tableau -->
        <div class="bg-slate-800/50 backdrop-blur-lg rounded-xl border border-slate-700/30 overflow-x-auto">
            <table class="w-full">
                <thead class="border-b border-slate-700/30">
                    <tr class="text-left [&>th]:font-semibold">
                        <th class="p-4 text-slate-400/90">Étudiant</th>
                        <th class="p-4 text-slate-400/90">Date absence</th>
                        <th class="p-4 text-slate-400/90">Cours</th>
                        <th class="p-4 text-slate-400/90">Statut</th>
                        <th class="p-4 text-slate-400/90 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/30">
                    <?php foreach($justifications as $justif): ?>
                    <tr class="hover:bg-slate-700/10 transition-colors">
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-purple-400/10 rounded-full flex items-center justify-center">
                                        <span class="text-purple-400 text-sm"><?= strtoupper(substr($justif['etudiant'], 0, 1)) ?></span>
                                    </div>
                                </div>
                                <div>
                                    <div class="font-medium text-slate-300"><?= $justif['etudiant'] ?></div>
                                    <div class="text-sm text-slate-500"><?= $justif['classe'] ?></div>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 text-slate-300"><?= date('d/m/Y H:i', strtotime($justif['date'])) ?></td>
                        <td class="p-4">
                            <div class="flex items-center gap-2">
                                <div class="size-2 bg-purple-400/80 rounded-full"></div>
                                <?= $justif['module'] ?>
                            </div>
                        </td>
                        <td class="p-4">
                            <?php
                                $statusColors = [
                                    'En_attente' => 'bg-amber-400/15 text-amber-400 ring-amber-400/20',
                                    'accepte' => 'bg-emerald-400/15 text-emerald-400 ring-emerald-400/20',
                                    'refuse' => 'bg-rose-400/15 text-rose-400 ring-rose-400/20',
                                    'en_cours' => 'bg-amber-400/15 text-amber-400 ring-amber-400/20',
                                ];
                            ?>
                            <span class="px-2.5 py-1 <?= $statusColors[$justif['statut']] ?> rounded-full text-sm font-medium ring-1 ring-inset">
                                <?= str_replace('_', ' ', $justif['statut']) ?>
                            </span>
                        </td>
                        <td class="p-4">
                            <div class="flex justify-end gap-2">
                                <?php if($justif['statut'] === 'en_cours'): ?>
                                <a href="<?= WEBROOT?>?controller=attache&page=justification&id_justif_accepte=<?= $justif["justification_id"] ?>">
                                    <button class="p-2 hover:bg-emerald-400/10 rounded-lg text-emerald-400 hover:text-emerald-300 transition-colors tooltip" data-tooltip="Accepter">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </button>
                                </a>
                                <a href="<?= WEBROOT?>?controller=attache&page=justification&id_justif_refuser=<?= $justif["justification_id"] ?>">
                                    <button class="p-2 hover:bg-rose-400/10 rounded-lg text-rose-400 hover:text-rose-300 transition-colors tooltip" data-tooltip="Refuser">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </a>
                                <?php endif; ?>
                                <button class="p-2 hover:bg-slate-600/10 rounded-lg text-slate-400 hover:text-slate-300 transition-colors tooltip" data-tooltip="Détails">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-between items-center text-slate-400">
            <span>Affichage de 1-10 sur 152 résultats</span>
            <div class="flex gap-1">
                <button class="size-9 flex items-center justify-center bg-slate-800/50 hover:bg-slate-700/30 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button class="size-9 bg-purple-400/10 text-purple-400 rounded-lg">1</button>
                <button class="size-9 bg-slate-800/50 hover:bg-slate-700/30 rounded-lg">2</button>
                <button class="size-9 bg-slate-800/50 hover:bg-slate-700/30 rounded-lg">3</button>
                <button class="size-9 flex items-center justify-center bg-slate-800/50 hover:bg-slate-700/30 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>