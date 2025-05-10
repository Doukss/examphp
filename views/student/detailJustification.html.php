<?php
// Récupérer les données de la justification ($justification)
// Vérifier les autorisations
?>

<div class="flex-1 overflow-y-auto p-6 bg-slate-900/50">
    <div class="max-w-4xl mx-auto space-y-8">
        <!-- En-tête -->
        <div class="text-center">
            <h1 class="text-4xl font-bold bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent">
                Détails de la justification
            </h1>
            <p class="mt-2 text-slate-400">Consultation de la justification soumise</p>
        </div>

        <!-- Carte principale -->
        <div class="bg-slate-800/60 backdrop-blur-lg rounded-2xl border border-slate-700/30 shadow-xl p-8">
            <!-- Métadonnées -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Carte Statut -->
                <div class="p-4 bg-slate-700/20 rounded-xl border border-slate-700/30">
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-400">Statut de la demande</span>
                            <?php
                                $statusColors = [
                                    'En_attente' => 'text-amber-400 bg-amber-400/15 ring-amber-400/20',
                                    'Acceptée' => 'text-emerald-400 bg-emerald-400/15 ring-emerald-400/20',
                                    'Refusée' => 'text-rose-400 bg-rose-400/15 ring-rose-400/20',
                                    'en_cours' => 'text-amber-400 bg-amber-400/15 ring-amber-400/20'
                                ];
                            ?>
                            <span class="px-2.5 py-1 <?= $statusColors[$justification['statut']] ?> rounded-full text-xs font-medium ring-1 ring-inset">
                                <?= str_replace('_', ' ', $justification['statut']) ?>
                            </span>
                        </div>
                        <div class="text-lg font-semibold text-slate-300">
                            <?= date('d F Y à H:i', strtotime($justification['created_at'])) ?>
                        </div>
                        <div class="text-sm text-slate-500">Soumise par <?= htmlspecialchars($_SESSION['user']['prenom']) ?></div>
                    </div>
                </div>

                <!-- Carte Absence -->
                <div class="p-4 bg-slate-700/20 rounded-xl border border-slate-700/30">
                    <div class="space-y-3">
                        <div class="flex items-center gap-2">
                            <div class="size-2 bg-purple-400 rounded-full animate-pulse"></div>
                            <h3 class="text-slate-300 font-medium">Absence du</h3>
                        </div>
                        <dl class="space-y-2">
                            <div>
                                <dt class="text-sm text-slate-400">Date</dt>
                                <dd class="text-slate-300"><?= date('d/m/Y', strtotime($justification['date'])) ?></dd>
                            </div>
                            <div>
                                <dt class="text-sm text-slate-400">Module</dt>
                                <dd class="text-slate-300"><?= htmlspecialchars($justification['module']) ?></dd>
                            </div>
                            <!-- <div>
                                <dt class="text-sm text-slate-400">Durée</dt>
                                <dd class="text-slate-300"><?= $justification['duree'] ?> heures</dd>
                            </div> -->
                        </dl>
                    </div>
                </div>
            </div>

            <!-- Contenu de la justification -->
            <div class="space-y-6">
                <!-- Message -->
                <div>
                    <h3 class="text-lg font-semibold text-slate-300 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                        </svg>
                        Message de justification
                    </h3>
                    <div class="prose prose-invert bg-slate-700/20 rounded-xl p-6 border border-slate-700/30">
                        <?= nl2br(htmlspecialchars($justification['motif'])) ?>
                    </div>
                </div>

                <!-- Pièce jointe -->
                <?php if($justification['piece_jointe']): ?>
                <div>
                    <h3 class="text-lg font-semibold text-slate-300 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Fichier joint
                    </h3>
                    <div class="flex items-center justify-between bg-slate-700/20 rounded-xl p-4 border border-slate-700/30">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-slate-600/20 rounded-lg">
                                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-slate-300"><?= htmlspecialchars($justification['nom_fichier']) ?></div>
                                <div class="text-sm text-slate-500"><?= $justification['type_fichier'] ?> • <?= formatFileSize($justification['taille_fichier']) ?></div>
                            </div>
                        </div>
                        <a href="uploads/<?= $justification['fichier_joint'] ?>" 
                           download
                           class="px-4 py-2 bg-purple-400/10 hover:bg-purple-400/20 text-purple-400 rounded-lg flex items-center gap-2 transition-all duration-200 hover:scale-[1.02]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            Télécharger
                        </a>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Commentaires (optionnel) -->
                <?php if(!empty($justification['commentaires'])): ?>
                <div>
                    <h3 class="text-lg font-semibold text-slate-300 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                        </svg>
                        Feedback
                    </h3>
                    <div class="space-y-4">
                        <?php foreach($justification['commentaires'] as $commentaire): ?>
                        <div class="p-4 bg-slate-700/20 rounded-xl border border-slate-700/30">
                            <div class="flex items-start gap-3">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-purple-400/10 rounded-full flex items-center justify-center">
                                        <span class="text-purple-400 text-sm"><?= strtoupper(substr($commentaire['auteur'], 0, 1)) ?></span>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-sm font-medium text-slate-300"><?= htmlspecialchars($commentaire['auteur']) ?></span>
                                        <span class="text-xs text-slate-500">• <?= date('d/m/Y H:i', strtotime($commentaire['date'])) ?></span>
                                    </div>
                                    <div class="text-slate-400 prose prose-invert"><?= nl2br(htmlspecialchars($commentaire['contenu'])) ?></div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Actions -->
            <div class="mt-8 flex justify-end gap-4 border-t border-slate-700/30 pt-8">
                <a href="<?= WEBROOT?>?controller=student&page=mesAbsences" 
                   class="px-6 py-2.5 bg-slate-700/30 hover:bg-slate-700/40 text-slate-300 rounded-lg transition-all duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Retour aux absences
                </a>
            </div>
        </div>
    </div>
</div>