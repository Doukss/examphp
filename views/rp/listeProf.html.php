<?php if (isset($_GET['success']) && $_GET['success'] == 1) : ?>
    <!-- Message animé -->
<div x-data="{ show: true }" 
     x-show="show" 
     x-init="setTimeout(() => show = false, 3000)"
     class="mb-4 p-3 bg-green-500/20 text-green-400 rounded-xl flex items-center gap-2 transition-opacity duration-300"
     x-transition:leave="opacity-0 transition ease-in duration-300">
    <i class="ri-checkbox-circle-line"></i>
    Professeur ajouté avec succès !
</div>
<?php endif; ?>
    <div class="container mx-auto px-4 py-2">
        <!-- En-tête -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
            <div class="space-y-2">
                <h1 class="text-3xl font-bold bg-gradient-to-r from-[#b31822] to-orange-600 bg-clip-text text-transparent">
                    Gestion des Professeurs
                </h1>
                <p class="text-gray-400">Liste des enseignants et leurs spécialités</p>
            </div>

            <form method="get">
                <div class="w-full md:w-96 flex gap-2">
                    <div class="relative flex-1 group">
                        <input type="hidden" name="controller" value="rp">
                        <input type="hidden" name="page" value="prof">
                        <input 
                            name="serach_prof"
                            type="text" 
                            placeholder="Rechercher un professeur..."
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

        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-gray-800 p-6 rounded-2xl border-2 border-gray-700/30">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-[#b31822]/20 rounded-xl">
                        <i class="ri-user-3-line text-2xl text-[#b31822]"></i>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Total Professeurs</p>
                        <p class="text-2xl font-bold text-white">42</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-800 p-6 rounded-2xl border-2 border-gray-700/30">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-green-500/20 rounded-xl">
                        <i class="ri-checkbox-circle-line text-2xl text-green-500"></i>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Actifs</p>
                        <p class="text-2xl font-bold text-white">38</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-800 p-6 rounded-2xl border-2 border-gray-700/30">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-blue-500/20 rounded-xl">
                        <i class="ri-book-line text-2xl text-blue-500"></i>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Matières enseignées</p>
                        <p class="text-2xl font-bold text-white">15</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau des professeurs -->
        <div class="bg-gray-00 rounded-2xl border-2 border-gray-700/30 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-900/30">
                    <thead class="bg-gray-200">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Professeur</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Spécialité</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Grade</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Contact</th>
                            <th scope="col" class="px-6 py-4 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-00 divide-y divide-gray-700/30">
                        <?php if ($profs) : ?>
                            <?php foreach ($profs as $p) : ?>
                                <tr class="hover:bg-gray-700/20 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-lg border-2 border-[#b31822]/50" src="https://i.pravatar.cc/50?img=10" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-500">Pr. <?= $p["prenom"] ?> <?= $p["nom"] ?></div>
                                                <div class="text-xs text-gray-400"><?= $p["matricule"] ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-[#b31822] font-semibold"><?= $p["specialite"] ?></span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <i class="ri-star-fill text-yellow-400 mr-1"></i>
                                            <span class="text-sm text-gray-300"><?= $p["grade"] ?></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex flex-col">
                                            <a href="mailto:<?= $p["email"] ?>" class="text-sm text-gray-400 hover:text-white transition-colors">
                                                <i class="ri-mail-line mr-1"></i><?= $p["email"] ?>
                                            </a>
                                            <span class="text-xs text-gray-500 mt-1">
                                                <i class="ri-map-pin-3-line mr-1"></i><?= $p["adresse"] ?>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end gap-2">
                                            <a href="<?= WEBROOT?>?controller=rp&page=prof&id_prof=<?= $p["id"] ?>" class="text-[#b31822] hover:text-[#d11a2a] mr-3">
                                                <i class="ri-pencil-line"></i>
                                            </a>
                                            <a href="<?= WEBROOT?>?controller=rp&page=prof&id_prof_delete=<?= $p["id"] ?>" class="text-red-500 hover:text-red-400">
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
                                        <img src="/image/notFound-removebg-preview.png" alt="Aucun professeur" class="w-32 h-32 opacity-50 mb-4">
                                        <p class="text-lg font-semibold text-gray-300">Aucun professeur trouvé</p>
                                        <p class="text-sm text-gray-500 mt-1 max-w-md">
                                            Aucune résultat pour votre recherche. Vérifiez le libellé ou essayez un autre terme.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Bouton Ajout -->
        <div class="fixed bottom-8 right-8">
           <a href="<?= WEBROOT?>?controller=rp&page=ajoutProf">
            <button class="flex items-center gap-2 px-6 py-4 bg-gradient-to-r from-[#b31822] to-orange-600 
                            text-white rounded-2xl shadow-xl hover:scale-105 transition-transform">
                    <i class="ri-user-add-line text-xl"></i>
                    <span class="font-semibold">Nouveau Professeur</span>
                </button>
           </a>
        </div>
    </div>