 
    <div class="w-full flex justify-center mt-5">
    <div class="w-full max-w-5xl flex justify-center flex-col rounded-2xl shadow-xl border border-gray-700/50">
        <!-- En-tête -->
        <div class="p-6 border-b border-gray-700/50">
            <h2 class="text-2xl font-bold bg-gradient-to-r from-indigo-400 to-blue-300 bg-clip-text text-transparent">
                Nouvelle Inscription
            </h2>
            <p class="text-gray-400 mt-1">Formulaire d'inscription étudiant</p>
        </div>
        <?php if (isset($_SESSION['form_errors']['global'])) : ?>
            <div class="mt-4 p-3 bg-red-500/20 text-red-400 rounded-xl">
                <?= htmlspecialchars($_SESSION['form_errors']['global']) ?>
            </div>
        <?php endif; ?>

        <!-- Formulaire -->
        <form class="p-6 space-y-6" method="POST">
        <input type="hidden" name="controller" value="attache">
        <input type="hidden" name="page" value="ajoutEtudiant">
        <input type="hidden" name="id_classe" value="<?= $id_classe?>">
            <!-- Photo de profil -->
            <!-- <div class="flex flex-col items-center space-y-4">
                <div class="photo-upload relative w-32 h-32 rounded-full bg-gray-700/30 border-2 border-dashed border-gray-600 hover:border-indigo-500 cursor-pointer transition-all group">
                    <input type="file" name="photo" accept="image/*" class="opacity-0 absolute inset-0 w-full h-full cursor-pointer">
                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                        <svg class="upload-icon w-8 h-8 text-gray-400 group-hover:text-indigo-400 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
                <span class="text-sm text-gray-400">Photo de profil (JPEG/PNG)</span>
            </div> -->

            <!-- Informations personnelles -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Prénom *</label>
                    <input type="text" name="prenom"  
                           value="<?= htmlspecialchars($_SESSION['old_input']['prenom'] ?? '') ?>"
                           class="w-full px-4 py-2.5 bg-gray-700/30 border border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 text-gray-100 placeholder-gray-500 transition-all">
                    <?php if (isset($_SESSION['form_errors']['prenom'])) : ?>
                        <p class="text-red-400 text-sm mt-1"><?= htmlspecialchars($_SESSION['form_errors']['prenom']) ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Nom *</label>
                    <input type="text" name="nom"  
                            value="<?= htmlspecialchars($_SESSION['old_input']['nom'] ?? '') ?>"
                           class="w-full px-4 py-2.5 bg-gray-700/30 border border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 text-gray-100 placeholder-gray-500 transition-all">
                           <?php if (isset($_SESSION['form_errors']['nom'])) : ?>
                                <p class="text-red-400 text-sm mt-1"><?= htmlspecialchars($_SESSION['form_errors']['nom']) ?></p>
                            <?php endif; ?>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Matricule *</label>
                    <input type="text" name="matricule"  
                            value="<?= htmlspecialchars($_SESSION['old_input']['matricule'] ?? '') ?>"
                           class="w-full px-4 py-2.5 bg-gray-700/30 border border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 text-gray-100 placeholder-gray-500 transition-all"
                           >
                    <span class="text-xs text-gray-500">Format : ET2024-001</span>
                    <?php if (isset($_SESSION['form_errors']['matricule'])) : ?>
                        <p class="text-red-400 text-sm mt-1"><?= htmlspecialchars($_SESSION['form_errors']['matricule']) ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Coordonnées -->
            <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Email *</label>
                        <input type="email" name="email"  
                            value="<?= htmlspecialchars($_SESSION['old_input']['email'] ?? '') ?>"
                               class="w-full px-4 py-2.5 bg-gray-700/30 border border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 text-gray-100 placeholder-gray-500 transition-all">
                        <?php if (isset($_SESSION['form_errors']['email'])) : ?>
                            <p class="text-red-400 text-sm mt-1"><?= htmlspecialchars($_SESSION['form_errors']['email']) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-300 mb-1">Mot de passe *</label>
                        <input type="password" name="password"  
                               class="w-full px-4 py-2.5 bg-gray-700/30 border border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 text-gray-100 placeholder-gray-500 transition-all pr-12">
                        <button type="button" onclick="togglePasswordVisibility(this)" 
                                class="absolute password-eye text-gray-400 hover:text-indigo-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                        <?php if (isset($_SESSION['form_errors']['password'])) : ?>
                            <p class="text-red-400 text-sm mt-1"><?= htmlspecialchars($_SESSION['form_errors']['password']) ?></p>
                         <?php endif; ?>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Adresse *</label>
                    <textarea name="adresse" rows="2"  
                            value="<?= htmlspecialchars($_SESSION['old_input']['adresse'] ?? '') ?>"

                              class="w-full px-4 py-2.5 bg-gray-700/30 border border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 text-gray-100 placeholder-gray-500 transition-all"></textarea>
                    <?php if (isset($_SESSION['form_errors']['adresse'])) : ?>
                        <p class="text-red-400 text-sm mt-1"><?= htmlspecialchars($_SESSION['form_errors']['adresse']) ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-4 pt-6 border-t border-gray-700/50">
                <button type="button" class="px-6 py-2.5 text-gray-300 hover:text-gray-100 transition-colors">
                    Annuler
                </button>
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-blue-500 rounded-lg hover:from-indigo-500 hover:to-blue-400 transition-all flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
    </div>

<?php
// Nettoyage des données de session
unset($_SESSION['form_errors']);
unset($_SESSION['old_input']);
?>