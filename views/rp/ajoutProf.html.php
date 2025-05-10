
<div class="container mx-auto px-4 py-3">
    <!-- En-tête -->
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold bg-gradient-to-r from-[#b31822] to-orange-600 bg-clip-text text-transparent">
            Ajouter un Professeur
        </h1>
        <p class="mt-2 text-gray-400">Renseignez les informations du nouvel enseignant</p>
        
        <?php if (isset($_SESSION['form_errors']['global'])) : ?>
            <div class="mt-4 p-3 bg-red-500/20 text-red-400 rounded-xl">
                <?= htmlspecialchars($_SESSION['form_errors']['global']) ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Formulaire -->
    <form class="space-y-6" method="POST">
        <div class="bg-gray-800 rounded-2xl p-6 shadow-2xl border border-gray-700/30">
            <input type="hidden" name="controller" value="rp">
            <input type="hidden" name="page" value="ajoutProf">
            <!-- Nom et Prénom -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-300 flex items-center gap-2">
                        <i class="ri-user-line text-[#b31822]"></i>
                        Prénom
                    </label>
                    <input 
                        name="prenom"
                        type="text"
                        class="w-full px-4 py-3 bg-gray-700/30 border-2 <?= isset($_SESSION['form_errors']['prenom']) ? 'border-red-500' : 'border-gray-600' ?> rounded-xl text-white focus:outline-none focus:border-[#b31822] focus:ring-2 focus:ring-[#b31822]/30 placeholder-gray-500 transition-all"
                        placeholder="Aminata"
                        value="<?= htmlspecialchars($_SESSION['old_input']['prenom'] ?? '') ?>"
                        
                    >
                    <?php if (isset($_SESSION['form_errors']['prenom'])) : ?>
                        <p class="text-red-400 text-sm mt-1"><?= htmlspecialchars($_SESSION['form_errors']['prenom']) ?></p>
                    <?php endif; ?>
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-300 flex items-center gap-2">
                        <i class="ri-user-line text-[#b31822]"></i>
                        Nom
                    </label>
                    <input 
                        name="nom"
                        type="text"
                        class="w-full px-4 py-3 bg-gray-700/30 border-2 <?= isset($_SESSION['form_errors']['nom']) ? 'border-red-500' : 'border-gray-600' ?> rounded-xl text-white focus:outline-none focus:border-[#b31822] focus:ring-2 focus:ring-[#b31822]/30 placeholder-gray-500 transition-all"
                        placeholder="Ndiaye"
                        value="<?= htmlspecialchars($_SESSION['old_input']['nom'] ?? '') ?>"
                        
                    >
                    <?php if (isset($_SESSION['form_errors']['nom'])) : ?>
                        <p class="text-red-400 text-sm mt-1"><?= htmlspecialchars($_SESSION['form_errors']['nom']) ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Email et Spécialité -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-300 flex items-center gap-2">
                        <i class="ri-mail-line text-[#b31822]"></i>
                        Email
                    </label>
                    <input 
                        name="email"
                        type="email"
                        class="w-full px-4 py-3 bg-gray-700/30 border-2 <?= isset($_SESSION['form_errors']['email']) ? 'border-red-500' : 'border-gray-600' ?> rounded-xl text-white focus:outline-none focus:border-[#b31822] focus:ring-2 focus:ring-[#b31822]/30 placeholder-gray-500 transition-all"
                        placeholder="andiaye@ecole221.sn"
                        value="<?= htmlspecialchars($_SESSION['old_input']['email'] ?? '') ?>"
                        
                    >
                    <?php if (isset($_SESSION['form_errors']['email'])) : ?>
                        <p class="text-red-400 text-sm mt-1"><?= htmlspecialchars($_SESSION['form_errors']['email']) ?></p>
                    <?php endif; ?>
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-300 flex items-center gap-2">
                        <i class="ri-book-2-line text-[#b31822]"></i>
                        Spécialité
                    </label>
                    <select 
                        name="specialite"
                        class="w-full px-4 py-3 bg-gray-700/30 border-2 <?= isset($_SESSION['form_errors']['specialite']) ? 'border-red-500' : 'border-gray-600' ?> rounded-xl text-white focus:outline-none focus:border-[#b31822] focus:ring-2 focus:ring-[#b31822]/30 appearance-none transition-all"
                        
                    >
                        <option value="" disabled selected>Choisir une spécialité</option>
                        <option <?= (isset($_SESSION['old_input']['specialite']) && $_SESSION['old_input']['specialite'] === 'Développement Web') ? 'selected' : '' ?>>Développement Web</option>
                        <option <?= (isset($_SESSION['old_input']['specialite']) && $_SESSION['old_input']['specialite'] === 'Réseaux Informatiques') ? 'selected' : '' ?>>Réseaux Informatiques</option>
                        <option <?= (isset($_SESSION['old_input']['specialite']) && $_SESSION['old_input']['specialite'] === 'Base de données') ? 'selected' : '' ?>>Base de données</option>
                    </select>
                    <?php if (isset($_SESSION['form_errors']['specialite'])) : ?>
                        <p class="text-red-400 text-sm mt-1"><?= htmlspecialchars($_SESSION['form_errors']['specialite']) ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Matricule et Grade -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-300 flex items-center gap-2">
                        <i class="ri-id-card-line text-[#b31822]"></i>
                        Matricule
                    </label>
                    <input 
                        name="matricule"
                        type="text"
                        class="w-full px-4 py-3 bg-gray-700/30 border-2 <?= isset($_SESSION['form_errors']['matricule']) ? 'border-red-500' : 'border-gray-600' ?> rounded-xl text-white focus:outline-none focus:border-[#b31822] focus:ring-2 focus:ring-[#b31822]/30 placeholder-gray-500 transition-all"
                        placeholder="PROF-2024-001"
                        value="<?= htmlspecialchars($_SESSION['old_input']['matricule'] ?? '') ?>"
                        
                    >
                    <?php if (isset($_SESSION['form_errors']['matricule'])) : ?>
                        <p class="text-red-400 text-sm mt-1"><?= htmlspecialchars($_SESSION['form_errors']['matricule']) ?></p>
                    <?php endif; ?>
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-300 flex items-center gap-2">
                        <i class="ri-award-line text-[#b31822]"></i>
                        Grade
                    </label>
                    <select 
                        name="grade"
                        class="w-full px-4 py-3 bg-gray-700/30 border-2 <?= isset($_SESSION['form_errors']['grade']) ? 'border-red-500' : 'border-gray-600' ?> rounded-xl text-white focus:outline-none focus:border-[#b31822] focus:ring-2 focus:ring-[#b31822]/30 appearance-none transition-all"
                        
                    >
                        <option value="" disabled selected>Choisir un grade</option>
                        <option <?= (isset($_SESSION['old_input']['grade']) && $_SESSION['old_input']['grade'] === 'Docteur') ? 'selected' : '' ?>>Docteur</option>
                        <option <?= (isset($_SESSION['old_input']['grade']) && $_SESSION['old_input']['grade'] === 'Maitre') ? 'selected' : '' ?>>Maitre</option>
                        <option <?= (isset($_SESSION['old_input']['grade']) && $_SESSION['old_input']['grade'] === 'Debutant') ? 'selected' : '' ?>>Debutant</option>
                    </select>
                    <?php if (isset($_SESSION['form_errors']['grade'])) : ?>
                        <p class="text-red-400 text-sm mt-1"><?= htmlspecialchars($_SESSION['form_errors']['grade']) ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Mot de passe -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-300 flex items-center gap-2">
                        <i class="ri-lock-password-line text-[#b31822]"></i>
                        Mot de passe
                    </label>
                    <input 
                        name="password"
                        type="password"
                        class="w-full px-4 py-3 bg-gray-700/30 border-2 <?= isset($_SESSION['form_errors']['password']) ? 'border-red-500' : 'border-gray-600' ?> rounded-xl text-white focus:outline-none focus:border-[#b31822] focus:ring-2 focus:ring-[#b31822]/30 placeholder-gray-500 transition-all"
                        placeholder="••••••••"
                        
                    >
                    <?php if (isset($_SESSION['form_errors']['password'])) : ?>
                        <p class="text-red-400 text-sm mt-1"><?= htmlspecialchars($_SESSION['form_errors']['password']) ?></p>
                    <?php endif; ?>
                </div>
                
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-300 flex items-center gap-2">
                        <i class="ri-lock-password-line text-[#b31822]"></i>
                        Confirmation
                    </label>
                    <input 
                        name="password_confirm"
                        type="password"
                        class="w-full px-4 py-3 bg-gray-700/30 border-2 <?= isset($_SESSION['form_errors']['password_confirm']) ? 'border-red-500' : 'border-gray-600' ?> rounded-xl text-white focus:outline-none focus:border-[#b31822] focus:ring-2 focus:ring-[#b31822]/30 placeholder-gray-500 transition-all"
                        placeholder="••••••••"
                        
                    >
                    <?php if (isset($_SESSION['form_errors']['password_confirm'])) : ?>
                        <p class="text-red-400 text-sm mt-1"><?= htmlspecialchars($_SESSION['form_errors']['password_confirm']) ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Adresse -->
            <div class="mt-4 space-y-2">
                <label class="text-sm font-medium text-gray-300 flex items-center gap-2">
                    <i class="ri-map-pin-line text-[#b31822]"></i>
                    Adresse
                </label>
                <input 
                    name="adresse"
                    type="text"
                    class="w-full px-4 py-3 bg-gray-700/30 border-2 <?= isset($_SESSION['form_errors']['adresse']) ? 'border-red-500' : 'border-gray-600' ?> rounded-xl text-white focus:outline-none focus:border-[#b31822] focus:ring-2 focus:ring-[#b31822]/30 placeholder-gray-500 transition-all"
                    placeholder="Dakar, Sicap"
                    value="<?= htmlspecialchars($_SESSION['old_input']['adresse'] ?? '') ?>"
                    
                >
                <?php if (isset($_SESSION['form_errors']['adresse'])) : ?>
                    <p class="text-red-400 text-sm mt-1"><?= htmlspecialchars($_SESSION['form_errors']['adresse']) ?></p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex flex-col-reverse md:flex-row gap-4 justify-end">
            <a href="/professeurs" class="px-6 py-3 bg-gray-700 hover:bg-gray-600 rounded-xl text-white transition-colors text-center">
                Annuler
            </a>
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-[#b31822] to-orange-600 hover:from-[#d11a2a] hover:to-orange-700 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all">
                <i class="ri-user-add-line mr-2"></i>Enregistrer
            </button>
        </div>
    </form>
</div>

<?php
// Nettoyage des données de session
unset($_SESSION['form_errors']);
unset($_SESSION['old_input']);
?>