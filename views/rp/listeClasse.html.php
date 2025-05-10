<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        <div class="space-y-2">
            <h1 class="text-3xl font-bold bg-gray-to-r from-[#b31822]  bg-clip-text text-transparent">
                Gestion des Classes
            </h1>
            <p class="text-gray-400">Explorez et gérez les classes de l'école</p>
        </div>

        <form action="" method="get">
            <div class="w-full md:w-96 flex gap-2">
                <div class="relative flex-1 group">
                    <input type="hidden" name="controller" value="rp">
                    <input type="hidden" name="page" value="classe">
                    <input 
                        name="searchClasse"
                        type="text" 
                        placeholder="Rechercher une classe..."
                        class="w-full pl-10 pr-4 py-3 bg-gray-800 border-2 border-gray-700 rounded-xl text-white 
                            focus:outline-none focus:border-[#b31822] focus:ring-2 focus:ring-[#b31822]/30
                            transition-all duration-300 placeholder-gray-500"
                    >
                    <i class="ri-search-line text-gray-400 absolute left-3 top-3.5 group-focus-within:text-[#b31822]"></i>
                </div>
                <button class="px-4 py-3 bg-[#b31822] hover:bg-[#d11a2a] rounded-xl text-white 
                            transition-all hover:scale-105">
                    <i class="ri-filter-line text-lg"></i>
                </button>
            </div>
        </form>
    </div>

    <!-- Tableau des Classes -->
    <div class="bg-gray-800 rounded-2xl border-2 border-gray-700/30 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700/30">
                <thead class="bg-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Classe</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Filière</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Niveau</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Statistiques</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-700/30">
                    <?php if ($classes) : ?>
                        
                        <?php foreach ($classes as $c) : ?>
                            <tr class="hover:bg-gray-700/20 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-lg font-bold text-gray-500"><?= $c["libelle"] ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 bg-[#b31822]/20 text-[#b31822] text-sm rounded-full">
                                        <?= $c["filiere"] ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 bg-blue-500/20 text-blue-400 text-sm rounded-full">
                                        <?= $c["niveau"] ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-4">
                                        <div class="flex items-center gap-2 text-gray-400 text-sm">
                                            <i class="ri-user-line"></i>
                                            <span><?= count(getEtudiantsByClasse($c["id_classe"])) ?> Étudiants</span>
                                        </div>
                                        <div class="flex items-center gap-2 text-gray-400 text-sm">
                                            <i class="ri-calendar-line"></i>
                                            <span><?= $annee_en_cours ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end gap-2">
                                        <a href="<?= WEBROOT?>?controller=rp&page=ajoutClasse&id_classe=<?= $c["id_classe"] ?>" class="text-[#b31822] hover:text-[#d11a2a] mr-3">
                                            <i class="ri-pencil-line"></i>
                                        </a>
                                        <a href="<?= WEBROOT?>?controller=rp&page=classe&id_classe_delete=<?= $c["id_classe"] ?>" class="text-red-500 hover:text-red-400">
                                            <i class="ri-delete-bin-line"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <img src="/image/notFound-removebg-preview.png" alt="Aucune classe" class="w-32 h-32 opacity-50 mb-4">
                                    <p class="text-lg font-semibold text-gray-300">Aucune classe trouvée</p>
                                    <p class="text-sm text-gray-500 mt-1 max-w-md">
                                        Aucun résultat pour votre recherche. Vérifiez le libellé ou essayez un autre terme.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bouton Ajout Classe -->
    <div class="fixed bottom-8 right-8">
        <a href="<?= WEBROOT?>?controller=rp&page=ajoutClasse">
            <button class="flex items-center gap-2 px-6 py-4 bg-gradient-to-r from-[#b31822] to-orange-600 
                            text-white rounded-2xl shadow-xl hover:scale-105 transition-transform">
                    <i class="ri-add-line text-xl"></i>
                    <span class="font-semibold">Nouvelle Classe</span>
            </button>
        </a>
    </div>
</div>