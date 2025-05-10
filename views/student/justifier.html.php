<?php
// Récupération et nettoyage des erreurs et anciennes valeurs
$formErrors = $_SESSION['form_errors'] ?? [];
$oldInput = $_SESSION['old_input'] ?? [];
?>

<div class="flex-1 overflow-y-auto p-6 bg-slate-900/50">
    <div class="max-w-3xl mx-auto space-y-8">
        <!-- En-tête -->
        <div class="text-center">
            <h1 class="text-4xl font-bold bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent">
                Justifier une absence
            </h1>
            <p class="mt-2 text-slate-400">Veuillez fournir les détails de votre justification</p>
        </div>

        <!-- Carte du formulaire -->
        <div class="bg-slate-800/60 backdrop-blur-lg rounded-2xl border border-slate-700/30 shadow-xl p-8">
            <!-- Détails de l'absence -->
            <div class="mb-8 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-400 mb-2">Date de l'absence</label>
                        <div class="p-3 bg-slate-700/20 rounded-lg text-slate-300">
                            <?= date('d F Y', strtotime($absence['date'])) ?>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-400 mb-2">Module concerné</label>
                        <div class="p-3 bg-slate-700/20 rounded-lg text-slate-300">
                            <?= htmlspecialchars($absence['libelle']) ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulaire de justification -->
            <form method="POST" enctype="multipart/form-data" class="space-y-6">
                <input type="hidden" name="controller" value="student">
                <input type="hidden" name="page" value="justification">
                <input type="hidden" name="id" value="<?= $id_absence ?>">

                <!-- Champ message -->
                <div>
                    <label for="message" class="block text-sm font-medium text-slate-300 mb-2">
                        Message de justification
                        <span class="text-red-400">*</span>
                    </label>
                    <textarea 
                        id="message" 
                        name="motif" 
                        rows="5"
                        class="w-full bg-slate-700/20 border border-slate-700/30 rounded-lg px-4 py-3 text-slate-300 placeholder-slate-500 focus:ring-2 focus:ring-purple-400/50 focus:border-transparent transition-all"
                        placeholder="Décrivez les raisons de votre absence..."
                    ><?= htmlspecialchars($oldInput['motif'] ?? '') ?></textarea>
                    <?php if (!empty($formErrors['motif'])): ?>
                        <p class="mt-1 text-sm text-red-400"><?= htmlspecialchars($formErrors['motif']) ?></p>
                    <?php endif; ?>
                    <p class="mt-2 text-sm text-slate-500 text-right">500 caractères maximum</p>
                </div>

                <!-- Upload de fichier -->
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">
                        Pièce jointe (optionnel)
                    </label>
                    <div class="flex items-center justify-center w-full">
                        <label class="flex flex-col w-full cursor-pointer">
                            <div class="group border-2 border-dashed border-slate-700/50 hover:border-purple-400/30 rounded-xl p-8 text-center transition-all duration-200">
                                <div class="flex flex-col items-center space-y-2">
                                    <svg class="w-12 h-12 text-slate-600 group-hover:text-purple-400/50 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                    <p class="text-slate-400 group-hover:text-slate-300">
                                        <span class="font-medium">Glissez votre fichier ici ou</span>
                                        <span class="text-purple-400">cliquez pour uploader</span>
                                    </p>
                                    <p class="text-xs text-slate-500">PDF, JPG, PNG (Max. 5MB)</p>
                                </div>
                                <input type="file" name="piece_jointe" class="hidden" accept=".pdf,.jpg,.jpeg,.png"/>
                            </div>
                        </label>
                    </div>
                    <?php if (!empty($formErrors['piece_jointe'])): ?>
                        <p class="mt-1 text-sm text-red-400"><?= htmlspecialchars($formErrors['piece_jointe']) ?></p>
                    <?php endif; ?>
                </div>

                <!-- Actions -->
                <div class="flex justify-end gap-4 pt-8">
                    <a href="absences.php"
                       class="px-6 py-2.5 bg-slate-700/30 hover:bg-slate-700/40 text-slate-300 rounded-lg transition-all duration-200">
                        Annuler
                    </a>
                    <button type="submit"
                            class="px-6 py-2.5 bg-purple-400/10 hover:bg-purple-400/20 text-purple-400 rounded-lg font-medium flex items-center gap-2 transition-all duration-200 hover:scale-[1.02]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Envoyer la justification
                    </button>
                </div>

                <!-- Message global d'erreur s'il existe -->
                <?php if (isset($error)): ?>
                    <div class="mt-4 p-4 bg-red-400/10 text-red-400 rounded-lg border border-red-400/20 flex items-center gap-3">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <span><?= htmlspecialchars($error) ?></span>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>
<?php
// Nettoyage des données de session
unset($_SESSION['form_errors']);
unset($_SESSION['old_input']);
?>