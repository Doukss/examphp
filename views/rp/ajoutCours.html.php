
    <div class="bg-gray-800 rounded-xl shadow-lg w-full  p-6 animate-slide-in-up">
        <h1 class="text-2xl font-bold text-[#b31822] mb-6 text-center">
            <i class="fas fa-calendar-alt mr-2"></i>Planifier un Cours
        </h1>

        <form class="space-y-4" method="POST">
            <!-- Module et Professeur -->
             <input type="hidden" name="controller" value="rp">
             <input type="hidden" name="page" value="ajoutCours">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-300 text-sm mb-2">Module</label>
                <select name="module" class="w-full bg-gray-700 border border-gray-600 rounded-lg p-2 text-white focus:ring-2 focus:ring-emerald-400">
                    <option value="" disabled selected> Sélectionner un module </option>
                    <?php foreach ($modules as $module): ?>
                        <option value="<?= htmlspecialchars($module['id_module']) ?>" 
                            <?= ((isset($_POST['module']) && $_POST['module'] == $module['id_module']) || 
                                (isset($cours['module_id']) && $cours['module_id'] == $module['id_module'])) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($module['libelle']) ?>
                        </option>

                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['module'])): ?>
                    <p class="text-red-600 text-sm"> <?= $errors['module'] ?> </p>
                <?php endif; ?>
            </div>

                                    
                <div>
                    <label class="block text-gray-300 text-sm mb-2">Professeur</label>
                    <select name="professeur" class="w-full bg-gray-700 border border-gray-600 rounded-lg p-2 text-white focus:ring-2 focus:ring-emerald-400">
                    <option value="" disabled selected> Sélectionner un professeur </option>
                        <?php foreach ($profs as $prof): ?>
                            <option value="<?= htmlspecialchars($prof['id']) ?>" 
                                <?= ((isset($_POST['professeur']) && $_POST['professeur'] == $prof['id']) || 
                                    (isset($cours['professeur_id']) && $cours['professeur_id'] == $prof['id'])) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($prof['prenom']) ?> <?= htmlspecialchars($prof['nom']) ?>
                            </option>

                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($errors['professeur'])): ?>
                        <p class="text-red-600 text-sm"> <?= $errors['professeur'] ?> </p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Date et Semestre -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label  class="block text-gray-300 text-sm mb-2">Date du cours</label>
                    <input type="date" name="date" value="<?= $date ?>" class="w-full bg-gray-700 border border-gray-600 rounded-lg p-2 text-white focus:ring-2 focus:ring-emerald-400">
                    <?php if (isset($errors['date'])): ?>
                        <p class="text-red-600 text-sm"> <?= $errors['date'] ?> </p>
                    <?php endif; ?>
                </div>
                
                <div>
                    <label class="block text-gray-300 text-sm mb-2">Semestre</label>
                    <select  name="semestre" class="w-full bg-gray-700 border border-gray-600 rounded-lg p-2 text-white focus:ring-2 focus:ring-emerald-400">
                        <option value="S1">Semestre 1</option>
                        <option value="S2">Semestre 2</option>
                    </select>
                    <?php if (isset($errors['semestre'])): ?>
                        <p class="text-red-600 text-sm"> <?= $errors['semestre'] ?> </p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Heures et Durée -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-gray-300 text-sm mb-2">Heure début</label>
                    <input type="time" name="heure_debut" value="<?= $heure_debut ?>" class="w-full bg-gray-700 border border-gray-600 rounded-lg p-2 text-white focus:ring-2 focus:ring-emerald-400">
                    <?php if (isset($errors['heure_debut'])): ?>
                        <p class="text-red-600 text-sm"> <?= $errors['heure_debut'] ?> </p>
                    <?php endif; ?>
                </div>
                
                <div>
                    <label class="block text-gray-300 text-sm mb-2">Heure fin</label>
                    <input type="time" name="heure_fin" value="<?= $heure_fin ?>" class="w-full bg-gray-700 border border-gray-600 rounded-lg p-2 text-white focus:ring-2 focus:ring-emerald-400">
                    <?php if (isset($errors['heure_fin'])): ?>
                        <p class="text-red-600 text-sm"> <?= $errors['heure_fin'] ?> </p>
                    <?php endif; ?>
                </div>
                
               
            </div>

            <!-- Classes concernées -->
            <div>
                <label class="block text-gray-300 text-sm mb-2">Classes concernées</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                    <?php foreach ($classes as $classe): ?>
                        <div class="flex items-center">
                            <input type="checkbox" name="classes[]" value="<?= htmlspecialchars($classe['id_classe']) ?>" 
                                class="text-emerald-400 border-gray-600 rounded bg-gray-700"
                                <?= in_array($classe['id_classe'], $classes_selected) ? 'checked' : '' ?>>
                            <label class="ml-2 text-gray-300 text-sm"><?= htmlspecialchars($classe['libelle']) ?></label>
                        </div>
                    <?php endforeach; ?>
                   
                </div>
                <?php if (isset($errors['classes'])): ?>
                        <p class="text-red-600 text-sm"> <?= $errors['classes'] ?> </p>
                    <?php endif; ?>
            </div>


            <!-- Bouton de soumission -->
            <button class="w-full bg-[#b31822] hover:[#b31822] text-white font-bold py-2 px-4 rounded-lg transition-colors mt-6">
                <i class="fas fa-save mr-2"></i>Enregistrer le cours
            </button>
        </form>
    </div>

    <style>
        @keyframes slide-in-up {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .animate-slide-in-up {
            animation: slide-in-up 0.4s ease-out;
        }
        input[type="checkbox"]:focus, select:focus, input:focus {
            ring-color: rgba(52, 211, 153, 0.5);
        }
    </style>
