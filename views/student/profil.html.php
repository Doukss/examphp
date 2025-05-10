
    <!-- Container Principal -->
    <div class="flex-1 overflow-y-auto p-6 bg-slate-900/50">
        <!-- En-tête Profil -->
        <div class="text-center mb-8">
            <div class="relative inline-block">
                <div class="w-32 h-32 bg-gradient-to-br from-purple-500 to-pink-400 rounded-full shadow-2xl overflow-hidden text-5xl flex items-center justify-center">
                <?= substr($_SESSION['user']['prenom'], 0, 1) . substr($_SESSION['user']['nom'], 0, 1) ?>
                </div>
                <button class="absolute bottom-0 right-0 bg-slate-800 p-2 rounded-full border-2 border-slate-700 hover:bg-slate-700 transition-colors">
                    <i class="fas fa-camera text-purple-400 text-sm"></i>
                </button>
            </div>
            <h1 class="text-3xl font-bold text-slate-200 mt-4"><?= $_SESSION['user']['prenom'] ?> <?= $_SESSION['user']['nom'] ?></h1>
            <p class="text-slate-400"><?= $classe['libelle'] ?> - Promotion <?= getAnneeEnCours() ?></p>
        </div>

        <!-- Statistiques -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-slate-800/50 p-4 rounded-xl border border-slate-700/30 backdrop-blur-lg">
                <div class="text-purple-400 text-xl font-bold mb-1">148h</div>
                <div class="text-sm text-slate-400">Heures validées</div>
            </div>
            <div class="bg-slate-800/50 p-4 rounded-xl border border-slate-700/30 backdrop-blur-lg">
                <div class="text-pink-400 text-xl font-bold mb-1">94%</div>
                <div class="text-sm text-slate-400">Présence</div>
            </div>
            <div class="bg-slate-800/50 p-4 rounded-xl border border-slate-700/30 backdrop-blur-lg">
                <div class="text-green-400 text-xl font-bold mb-1">4.2</div>
                <div class="text-sm text-slate-400">Moyenne</div>
            </div>
            <div class="bg-slate-800/50 p-4 rounded-xl border border-slate-700/30 backdrop-blur-lg">
                <div class="text-blue-400 text-xl font-bold mb-1">12</div>
                <div class="text-sm text-slate-400">Projets</div>
            </div>
        </div>

        <!-- Contenu Principal -->
        <div class="bg-slate-800/50 rounded-2xl border border-slate-700/30 backdrop-blur-lg p-6">
            <!-- Navigation Onglets -->
            <div class="flex space-x-4 mb-6 border-b border-slate-700/50 pb-4">
                <button class="px-4 py-2 text-purple-400 border-b-2 border-purple-400">Informations</button>
                <button class="px-4 py-2 text-slate-400 hover:text-purple-400 transition-colors">Sécurité</button>
                <button class="px-4 py-2 text-slate-400 hover:text-purple-400 transition-colors">Notifications</button>
            </div>

            <!-- Formulaire Profil -->
            <form method="POST" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-slate-300 mb-2">Nom complet</label>
                        <input type="text" 
                            value="<?= $_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom'] ?>"
                            class="w-full bg-slate-800/50 border border-slate-700/30 rounded-lg px-4 py-3 
                                    focus:outline-none focus:ring-2 focus:ring-purple-400/30 transition-all">
                    </div>
                    <div>
                        <label class="block text-slate-300 mb-2">Email</label>
                        <input type="email" 
                            value="<?= $_SESSION['user']['email'] ?>"
                            class="w-full bg-slate-800/50 border border-slate-700/30 rounded-lg px-4 py-3 
                                    focus:outline-none focus:ring-2 focus:ring-purple-400/30 transition-all">
                    </div>
                    <div>
                        <label class="block text-slate-300 mb-2">Matricule</label>
                        <input type="tel" 
                            value="<?= $_SESSION['user']['matricule'] ?>"
                            class="w-full bg-slate-800/50 border border-slate-700/30 rounded-lg px-4 py-3 
                                    focus:outline-none focus:ring-2 focus:ring-purple-400/30 transition-all" readonly>
                    </div>
                    <div>
                        <label class="block text-slate-300 mb-2">Adresse</label>
                        <input type="text" 
                            value="<?= $_SESSION['user']['adresse'] ?>"
                            class="w-full bg-slate-800/50 border border-slate-700/30 rounded-lg px-4 py-3 
                                    focus:outline-none focus:ring-2 focus:ring-purple-400/30 transition-all">
                    </div>
                </div>


                <!-- Section Sécurité -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-slate-700/20 rounded-lg">
                        <div>
                            <div class="text-slate-200 font-medium">Authentification à deux facteurs</div>
                            <div class="text-slate-400 text-sm">Protégez votre compte avec une couche supplémentaire de sécurité</div>
                        </div>
                        <button class="px-4 py-2 bg-purple-400/10 text-purple-400 rounded-lg hover:bg-purple-400/20 transition-colors">
                            Activer
                        </button>
                    </div>
                </div>

                <!-- Boutons Action -->
                <div class="flex justify-end space-x-4 pt-6">
                    <button class="px-6 py-2 border border-slate-700/50 rounded-lg hover:bg-slate-700/30 transition-colors">
                        Annuler
                    </button>
                    <button class="px-6 py-2 bg-gradient-to-br from-purple-500 to-pink-400 rounded-lg hover:opacity-90 transition-opacity">
                        Sauvegarder
                    </button>
                </div>
            </form>
        </div>
    </div>
