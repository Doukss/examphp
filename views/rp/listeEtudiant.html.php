<div class="container mx-auto px-4 py-8">
    <!-- En-tête améliorée -->
    <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div class="space-y-1">
            <h1 class="text-3xl font-bold text-white bg-gradient-to-r from-[#b31822] to-[#e53e3e] bg-clip-text text-transparent">
                <?= $classe["libelle"] ?>
            </h1>
            <p class="text-gray-400 text-sm font-medium"><?= $totalStudents ?> étudiants inscrits</p>
        </div>

        <form action="" method="get" class="w-full md:max-w-md">
            <div class="flex gap-2">
                <div class="relative flex-1 group">
                    <input type="hidden" name="controller" value="rp">
                    <input type="hidden" name="page" value="listeEtudiant">
                    <input type="hidden" name="id_classe" value="<?= $classeId ?>">
                    <input 
                        type="text" 
                        placeholder="Rechercher par matricule..."
                        class="w-full pl-12 pr-4 py-3 bg-gray-800/70 border-2 border-gray-700 rounded-xl text-white 
                               focus:outline-none focus:border-[#b31822] focus:ring-2 focus:ring-[#b31822]/30
                               backdrop-blur-sm transition-all duration-300"
                        id="searchInput"
                        name="matricule"
                    >
                    <svg class="w-6 h-6 absolute left-3 top-3 text-gray-400 group-focus-within:text-[#b31822] transition-colors" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <button class="px-4 py-3 bg-[#b31822] hover:bg-[#d11a2a] border-2 border-[#b31822]/20 
                             rounded-xl text-white transition-all duration-300 hover:scale-[1.02]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                    </svg>
                </button>
            </div>
        </form>
    </div>

    <?php if ($etudiants) : ?>
        <!-- Grille d'étudiants améliorée -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="studentsGrid">
            <?php foreach ($etudiants as $e) : ?>
                <div class="group relative bg-gray-800/50 hover:bg-gray-800/70 border-2 border-gray-700/30 
                        rounded-2xl p-4 shadow-2xl hover:shadow-[#b31822]/10 backdrop-blur-sm 
                        transition-all duration-300 hover:-translate-y-1 cursor-pointer">
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="relative">
                                <img src="https://i.pravatar.cc/50?img=3" alt="Avatar" 
                                    class="w-12 h-12 rounded-xl border-2 border-[#b31822]/50">
                                <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-[#b31822] rounded-full 
                                        border-2 border-gray-900/80"></div>
                            </div>
                            <div class="space-y-0.5">
                                <h3 class="text-base font-semibold text-white">
                                    <?= $e["prenom"] ?> <?= $e["nom"] ?>
                                </h3>
                                <p class="text-xs font-mono text-gray-400"><?= $e["matricule"] ?></p>
                            </div>
                        </div>
                        <button class="opacity-0 group-hover:opacity-100 text-gray-400 hover:text-[#b31822] 
                                    transition-opacity duration-300 p-1 -mr-2">
                            <i class="ri-more-2-fill text-xl"></i>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- Après la grille d'étudiants -->
<?php if ($totalPages > 1) : ?>
<div class="mt-8 flex justify-center items-center gap-2">
    <?php if ($currentPage > 1) : ?>
        <a href="?controller=rp&page=listeEtudiant&id_classe=<?= $classeId ?>&page=<?= $currentPage - 1 ?><?= $searchMatricule ? '&matricule=' . urlencode($searchMatricule) : '' ?>"
           class="px-4 py-2 bg-gray-800 hover:bg-[#b31822] rounded-lg transition-colors">
            ← Précédent
        </a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
        <a href="?controller=rp&page=listeEtudiant&id_classe=<?= $classeId ?>&pageActuel=<?= $i ?><?= $searchMatricule ? '&matricule=' . urlencode($searchMatricule) : '' ?>"
           class="px-4 py-2 <?= $i === $currentPage ? 'bg-[#b31822] text-white' : 'bg-gray-800 hover:bg-gray-700' ?> rounded-lg transition-colors">
            <?= $i ?>
        </a>
    <?php endfor; ?>

    <?php if ($currentPage < $totalPages) : ?>
        <a href="?controller=rp&page=listeEtudiant&id_classe=<?= $classeId ?>&pageActuel=<?= $currentPage + 1 ?><?= $searchMatricule ? '&matricule=' . urlencode($searchMatricule) : '' ?>"
           class="px-4 py-2 bg-gray-800 hover:bg-[#b31822] rounded-lg transition-colors">
            Suivant →
        </a>
    <?php endif; ?>
</div>
<?php endif; ?>
    <?php else: ?>
    <!-- État vide amélioré -->
    <div class="flex flex-col items-center justify-center w-full mt-12 gap-8">
        <div class="relative w-64 h-64">
            <img src="/image/notFound-removebg-preview.png" alt="Aucun étudiant" 
                 class="w-full h-full object-contain opacity-50">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent"></div>
        </div>
        <div class="text-center space-y-2">
            <p class="text-xl font-semibold text-gray-300">Aucun étudiant trouvé</p>
            <p class="text-sm text-gray-500 max-w-md">
                Aucun résultat pour votre recherche. Vérifiez le matricule ou essayez un autre terme.
            </p>
        </div>
    </div>
    <?php endif; ?>
</div>