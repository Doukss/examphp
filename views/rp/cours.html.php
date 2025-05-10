
 

    <nav class="">
         <!-- En-tête -->
         <div class="flex justify-between items-center">
                <h1 class="text-3xl font-bold">Dashboard Executive</h1>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input type="text" placeholder="Recherche..." class="glass-effect px-4 py-2 rounded-xl w-64 focus:outline-none focus:ring-2 focus:ring-[#b31822]">
                    </div>
                    <div class="w-10 h-10 rounded-full bg-[#b31822] flex items-center justify-center">
                        <span>AD</span>
                    </div>
                </div>
            </div>
        
    </nav>

    <main class="pt-2 pb-8 px-4 ">
        <!-- Interface Principale -->
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8">
            

            <!-- Panneau de Visualisation -->
            <div class="lg:col-span-3 space-y-6 ">
                <!-- En-tête Dynamique -->
                <div class="neon-card rounded-2xl p-3 flex flex-row justify-between ">
                    <div class="flex flex-wrap gap-4 items-center">
                        <input type="time" class="cyber-input p-3 rounded-xl flex-grow">
                        <input type="time" class="cyber-input p-3 rounded-xl flex-grow">
                        <button class="cyber-input px-6 py-3 rounded-xl hover:bg-[#b31822] transition-all">
                            🔍 Synthétiser
                        </button>
                        
                    </div>
                    <div class="flex  items-center">
                        <a href="<?= WEBROOT?>?controller=rp&page=ajoutCours" class="cyber-input px-6 py-3 mx-3 rounded-xl bg-[#b31822] text-white hover:bg-[#b31822] transition-all">
                                🔍 Planifier un cours
                        </a>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8 mt-5">
                  <!-- Liste Holographique -->
                <?php foreach ($cours as $c) { ?>
                    <div class="space-y-4">
                        <div class="neon-card rounded-2xl p-6 relative group hover:shadow-2xl transition-all cursor-pointer">
                            <div class="flex justify-between items-start ">
                                <div class="">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="w-2 h-2 bg-[#b31822] rounded-full animate-pulse"></div>
                                        <h3 class="text-lg font-bold">🌌 <?= $c["module"] ?></h3>
                                    </div>
                                    <div class="flex flex-wrap gap-2 items-center justify-between text-sm opacity-80">
                                        <div>
                                            <span>📅 <?= $c["date"] ?></span>
                                            <span>⏳ <?= substr($c["heure_debut"], 0, 5) ?> - <?= substr($c["heure_fin"], 0, 5) ?></span>
                                        </div>
                                        <div>
                                            <span class="px-2 py-1 bg-[#b31822]/20 rounded-full"><?= $c["semestre"] ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 flex-col">
                                   <div>
                                    <span class="px-2 py-1 bg-[#b31822]/20 rounded-full text-sm"><?= $c["nombre_classes"] ?>classes</span>
                                        <button class="text-[#b31822] hover:text-white">
                                            ▼
                                        </button>
                                   </div>
                                   <div>
                                       <a href="<?= WEBROOT?>?controller=rp&page=ajoutCours&id_cours=<?= $c["id_cours"] ?>">
                                           <span class="text-sm"><i class="ri-edit-line"></i> modifier</span>
                                       </a>
                                   </div>
                                </div>
                            </div>

                            <!-- Détails Interactifs -->
                            <div class="mt-4 pt-4 border-t border-[#b31822]/20 hidden group-hover:block">
                                <div class=" gap-4">
                                    <div>
                                        <h4 class="font-bold mb-2">🚀 Classes Associées</h4>
                                        <div class="space-y-2">
                                        <?php foreach (explode(', ', $c['classes']) as $classe) : ?>
                                            <div class="flex flex-row justify-between">
                                                <div class="flex items-center gap-2">
                                                    <div class="w-2 h-2 bg-[#b31822] rounded-full"></div>
                                                    <?= htmlspecialchars($classe) ?>
                                                </div>
                                                <div class="flex items-center">
                                                    <!-- <h4 class="font-bold mb-2">👥 Élèves Inscrits</h4> -->
                                                    <a href="<?= WEBROOT?>?controller=rp&page=listeEtudiant&id_classe=<?= $c["id_classe"] ?>"  class="text-[#b31822] hover:underline flex items-center gap-2 text-xs">
                                                        Afficher les <?= $c["nombre_etudiantsu"] = 2 ?>
                                                        étudiants →
                                                    </a>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                
            </div>
    </main>

    <!-- Panneau Étudiants -->
    <div class="fixed inset-y-0 right-0 w-96 bg-black/50 backdrop-blur-xl transform translate-x-full transition-transform">
        <div class="p-6 h-full overflow-y-auto">
            <div class="flex justify-between mb-6">
                <h3 class="text-xl font-bold">👥 Élèves - L1 Cyber</h3>
                <button class="text-[#b31822]">×</button>
            </div>
            <div class="grid gap-4">
                <div class="flex items-center gap-4 p-3 neon-card rounded-xl">
                    <div class="w-12 h-12 bg-[#b31822] rounded-full flex items-center justify-center">
                        <span>AD</span>
                    </div>
                    <div>
                        <h4 class="font-medium">Awa Diop</h4>
                        <p class="text-sm opacity-75">Matricule: CYB-3024-001</p>
                    </div>
                </div>
                <!-- Plus d'élèves -->
            </div>
        </div>
    </div>
