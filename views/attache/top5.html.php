<div class="max-w-7xl mx-auto px-6 py-8 flex gap-8">
<?php require_once ROOT_PATH . "/views/components/absenceSide.php"; ?>

    <div class="bg-gray-800 rounded-2xl shadow-2xl overflow-hidden border border-gray-700/50 w-full">
        <!-- En-tête néon -->
        <div class="bg-gradient-to-r from-indigo-800/80 to-blue-700/80 p-6 border-b border-indigo-500/30">
            <h2 class="text-2xl font-bold text-white flex items-center gap-3 neon-text">
                <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
                <span class="bg-gradient-to-r from-indigo-300 to-blue-200 bg-clip-text text-transparent">
                    Classement d'absentéisme <?= date('Y') ?>
                </span>
            </h2>
            <p class="text-indigo-300/80 mt-2 text-sm">Seuil d'alerte : <span class="font-semibold text-red-400">25h/an</span></p>
        </div>

        <!-- Corps du tableau -->
        <div class="px-6 py-4 space-y-2">
            <!-- En-têtes -->
            <div class="grid grid-cols-12 gap-4 text-gray-400 text-sm mb-4 px-4 border-b border-gray-700/50 pb-3">
                <div class="col-span-1"></div>
                <div class="col-span-4">Étudiant</div>
                <div class="col-span-3 text-center">Occurrences</div>
                <div class="col-span-3 text-center">Heures</div>
                <div class="col-span-1"></div>
            </div>

            <?php foreach ($students as $index => $student): ?>
            <div class="group relative grid grid-cols-12 gap-4 items-center p-4 rounded-xl transition-all duration-300 
                      hover:bg-gray-700/20 hover:shadow-lg border border-transparent hover:border-indigo-500/30
                      <?= $student['heures_absence'] > 25 ? 'border-l-4 border-red-500/80 bg-red-900/10' : '' ?>">
                
                <!-- Effet de lueur au survol -->
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>

                <!-- Numéro de classement -->
                <div class="col-span-1 text-center">
                    <span class="text-xl font-bold text-indigo-400/60 group-hover:text-indigo-300 transition-colors">
                        #<?= $index + 1 ?>
                    </span>
                </div>

                <!-- Avatar et nom -->
                <div class="col-span-4 flex items-center gap-4">
                    <div class="relative">
                        <div class="student-avatar h-12 w-12 rounded-full flex items-center justify-center 
                                  bg-gradient-to-br from-indigo-500 to-blue-400 text-white font-bold text-lg
                                  ring-2 ring-indigo-500/30 group-hover:ring-indigo-400/50 transition-all">
                            <?= substr($student['prenom'], 0, 1) . substr($student['nom'], 0, 1) ?>
                        </div>
                        <?php if($student['heures_absence'] > 25): ?>
                        <div class="absolute -top-1 -right-1 h-5 w-5 bg-red-500 rounded-full flex items-center justify-center 
                                  ring-2 ring-red-900/50 animate-pulse">
                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <div class="font-semibold text-gray-100">
                            <?= $student['prenom'] ?> <?= $student['nom'] ?>
                        </div>
                        <div class="text-sm text-gray-400">
                            <?= $student['classe_nom'] ?? 'Toutes classes' ?>
                        </div>
                    </div>
                </div>

                <!-- Statistiques d'absences -->
                <div class="col-span-3 text-center">
                    <div class="inline-flex flex-col items-center gap-1">
                        <span class="text-xl font-bold <?= $student['heures_absence'] > 25 ? 'text-red-400' : 'text-indigo-400' ?>">
                            <?= $student['total_absences'] ?>
                        </span>
                        <span class="text-xs text-gray-500">occurrences</span>
                    </div>
                </div>

                <!-- Barre de progression -->
                <div class="col-span-3">
                    <div class="relative pt-2">
                        <div class="flex justify-between text-xs mb-2 font-medium text-gray-400">
                            <span><?= number_format($student['heures_absence'], 1) ?>h</span>
                            <span>25h</span>
                        </div>
                        <div class="h-2 bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-red-500 to-orange-400 rounded-full shadow-[0_0_8px_rgba(239,68,68,0.3)]" 
                                 style="width: <?= min(($student['heures_absence'] / 25) * 100, 100) ?>%"></div>
                        </div>
                    </div>
                </div>

                <!-- Icône alerte -->
                <div class="col-span-1 text-center">
                    <?php if($student['heures_absence'] > 25): ?>
                    <div class="animate-bounce">
                        <svg class="w-6 h-6 text-red-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                  d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126z"/>
                        </svg>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Pied de page -->
        <div class="bg-gray-800/50 px-6 py-3 border-t border-gray-700/50">
            <div class="flex items-center justify-between text-xs text-gray-400">
                <span>🔄 Dernière mise à jour : <?= date('d/m/Y H:i') ?></span>
                <div class="flex items-center gap-2">
                    <span class="h-2 w-2 bg-red-500 rounded-full animate-pulse"></span>
                    <span>Dépassement de seuil</span>
                </div>
            </div>
        </div>
    </div>
</div>

