 <!-- Sidebar -->
 <aside class="w-64 space-y-6">
            <!-- Statistiques rapides -->
            <div class="absence-card p-6 rounded-xl border border-gray-700">
                <h3 class="text-lg font-semibold mb-4">Statistiques</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400">Total absences</span>
                        <span class="text-indigo-400 font-medium"><?= $totalAbsences ?></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400">Justifiées</span>
                        <span class="text-green-400 font-medium"><?= $justifiedAbsences ?></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400">En attente</span>
                        <span class="text-yellow-400 font-medium"><?= $pendingAbsences ?></span>
                    </div>
                </div>
            </div>

            <!-- Filtres rapides -->
            <div class="absence-card p-6 rounded-xl border border-gray-700">
                <h3 class="text-lg font-semibold mb-4">Filtres rapides</h3>
                <div class="space-y-2">
                    <button class="w-full text-left px-3 py-2 rounded-lg hover:bg-gray-800">Aujourd'hui</button>
                    <a href="<?= WEBROOT?>?controller=attache&page=listeAbsence&filtre=top5">
                        <button class="w-full text-left px-3 py-2 rounded-lg hover:bg-gray-800">5 absenteiste</button>                   
                    </a>
                    <button class="w-full text-left px-3 py-2 rounded-lg hover:bg-gray-800">Non justifiées</button>
                </div>
            </div>
        </aside>