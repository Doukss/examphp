<?php date_default_timezone_set('Africa/Dakar'); ?>

<!-- Main Content -->
<div class="pt-12 pb-8 px-4 sm:px-6 lg:px-8 max-w-7xl ">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 space-y-4 md:space-y-0">
        <div>
            <h1 class="text-3xl font-bold text-slate-200">Vos Cours</h1>
            <p class="text-slate-400 mt-2">Semestre en cours : S3</p>
        </div>
        <div class="flex space-x-3">
            <form method="GET" class="flex items-center space-x-3">
                <input type="hidden" name="controller" value="student">
                <input type="hidden" name="page" value="mesCours">
                <input type="date" name="date" value="<?= $dateFiltre ?>" class="px-4 py-2 bg-slate-800/50 rounded-xl border border-slate-700/50 text-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-400/30">
                <button type="submit" class="px-4 py-2 bg-slate-800/50 hover:bg-slate-700/30 rounded-xl border border-slate-700/50 transition-all text-slate-300">
                    <i class="fas fa-filter text-emerald-400 mr-2"></i>
                    Filtrer
                </button>
            </form>
        </div>
    </div>

    <?php if ($coursEtudiant) : ?>
        <!-- Course Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($coursEtudiant as $cours) : 
                $heureFin = strtotime($cours['heure_fin']);
                $now = time();
                $statut = $now > $heureFin ? 'Terminé' : 'En cours';
                $color = $now > $heureFin ? 'cyan' : 'emerald';
            ?>
                <div class="group relative bg-slate-800/50 backdrop-blur-lg rounded-2xl border border-slate-700/30 hover:border-<?= $color ?>-400/30 transition-all duration-300 hover:-translate-y-1 shadow-xl">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div class="bg-<?= $color ?>-400/10 px-3 py-1 rounded-full text-<?= $color ?>-400 text-sm">
                                <?= $statut ?>
                            </div>
                            <i class="fas <?= $now > $heureFin ? 'fa-check-circle' : 'fa-book-open' ?> text-slate-400 group-hover:text-<?= $color ?>-400 transition-colors"></i>
                        </div>
                        
                        <h3 class="text-xl font-bold text-slate-200 mb-2"><?= htmlspecialchars($cours['module_libelle']) ?></h3>
                        
                        <div class="space-y-3 text-slate-400">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-chalkboard-teacher"></i>
                                <span><?= htmlspecialchars($cours['professeur_prenom']) ?> <?= htmlspecialchars($cours['professeur_nom']) ?></span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-clock"></i>
                                <span><?= htmlspecialchars($cours['date']) ?> • <?= $cours['heure_debut'] ?>-<?= $cours['heure_fin'] ?></span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-map-marker-alt"></i>
                                <span><?= htmlspecialchars($cours['salle']) ?></span>
                            </div>
                        </div>
                        
                        <!-- <div class="mt-6">
                            <div class="flex justify-between text-sm mb-2">
                                <span class="text-<?= $color ?>-400">Progression</span>
                                <span class="text-slate-400"><?= $cours['progression'] ?>%</span>
                            </div>
                            <div class="h-2 bg-slate-700/50 rounded-full overflow-hidden">
                                <div class="w-[<?= $cours['progression'] ?>%] h-full bg-gradient-to-r from-<?= $color ?>-400 to-cyan-500"></div>
                            </div>
                        </div> -->
                    </div>

                    <div class="absolute inset-0 bg-gradient-to-b from-<?= $color ?>-400/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl flex items-center justify-center">
                        <button class="px-6 py-2 bg-<?= $color ?>-400/10 backdrop-blur-sm border border-<?= $color ?>-400/30 rounded-xl text-<?= $color ?>-400 hover:bg-<?= $color ?>-400/20 transition-colors">
                            Voir le détail
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex justify-center space-x-2">
            <button class="w-10 h-10 bg-slate-800/50 hover:bg-slate-700/30 rounded-lg text-slate-400 transition-colors">1</button>
            <button class="w-10 h-10 bg-emerald-400/10 text-emerald-400 rounded-lg">2</button>
            <button class="w-10 h-10 bg-slate-800/50 hover:bg-slate-700/30 rounded-lg text-slate-400 transition-colors">3</button>
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
                <p class="text-xl font-semibold text-gray-300">Aucun cours trouvé</p>
                <p class="text-sm text-gray-500 max-w-md">
                    Aucun résultat pour votre recherche. Vérifiez le libelle ou essayez un autre terme.
                </p>
            </div>
        </div>
    <?php endif; ?>
</div>
