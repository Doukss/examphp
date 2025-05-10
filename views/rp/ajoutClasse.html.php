
    <div class="container mx-auto px-4 py-2 max-w-2xl">
        <!-- En-tête -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-[#b31822] to-orange-600 bg-clip-text text-transparent">
                Créer une nouvelle classe
            </h1>
            <p class="mt-2 text-gray-400">Renseignez les informations de la classe</p>
        </div>

        <!-- Formulaire -->
        <form class="space-y-6" method="POST">
            <!-- Carte du formulaire -->
            <div class="bg-gray-800 rounded-2xl p-6 shadow-2xl border border-gray-700/30">
                <!-- Nom de la classe -->
                <input type="hidden" name="controller" value="rp">
                <input type="hidden" name="page" value="ajoutClasse">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-300 flex items-center gap-2">
                        <i class="ri-building-2-line text-[#b31822]"></i>
                        Nom de la classe
                    </label>
                    <input 
                        type="text"
                        class="w-full px-4 py-3 bg-gray-700/30 border-2 border-gray-600 rounded-xl text-white 
                            focus:outline-none focus:border-[#b31822] focus:ring-2 focus:ring-[#b31822]/30
                            placeholder-gray-500 transition-all"
                        placeholder="Ex: B1 Développement"
                        name="libelle"
                        value="<?= isset($_POST['libelle']) ? htmlspecialchars($_POST['libelle']) : (isset($classe['libelle']) ? htmlspecialchars($classe['libelle']) : '') ?>"
                    >

                    <?php if (isset($errors['libelle'])): ?>
                        <p class="text-red-600 text-sm"> <?= $errors['libelle'] ?> </p>
                    <?php endif; ?>
                </div>

                <!-- Filière et Niveau -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-300 flex items-center gap-2">
                            <i class="ri-flow-chart text-[#b31822]"></i>
                            Filière
                        </label>
                        <select name="filliere"
                                class="w-full px-4 py-3 bg-gray-700/30 border-2 border-gray-600 rounded-xl text-white 
                                    focus:outline-none focus:border-[#b31822] focus:ring-2 focus:ring-[#b31822]/30
                                    appearance-none transition-all">
                            <option value="">Sélectionnez une filière</option>
                            
                            <?php
                            $filieres = ["Développement Web", "Réseaux Informatiques", "Design Digital"];
                            $selectedFiliere = isset($_POST['filliere']) ? $_POST['filliere'] : (isset($classe['filiere']) ? $classe['filiere'] : '');
                            
                            foreach ($filieres as $filiere) {
                                $selected = ($selectedFiliere === $filiere) ? 'selected' : '';
                                echo "<option value=\"$filiere\" $selected>$filiere</option>";
                            }
                            ?>
                        </select>

                        <?php if (isset($errors['filliere'])): ?>
                             <p class="text-red-600 text-sm"> <?= $errors['filliere'] ?> </p>
                        <?php endif; ?>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-300 flex items-center gap-2">
                            <i class="ri-stack-line text-[#b31822]"></i>
                            Niveau
                        </label>
                        <select name="niveau"
                                class="w-full px-4 py-3 bg-gray-700/30 border-2 border-gray-600 rounded-xl text-white 
                                    focus:outline-none focus:border-[#b31822] focus:ring-2 focus:ring-[#b31822]/30
                                    appearance-none transition-all">
                            <option value="">Sélectionnez un niveau</option>
                            
                            <?php
                            $niveaux = ["Licence 1", "Licence 2", "Licence 3"];
                            $selectedNiveau = isset($_POST['niveau']) ? $_POST['niveau'] : (isset($classe['niveau']) ? $classe['niveau'] : '');
                            
                            foreach ($niveaux as $niveau) {
                                $selected = ($selectedNiveau === $niveau) ? 'selected' : '';
                                echo "<option value=\"$niveau\" $selected>$niveau</option>";
                            }
                            ?>
                        </select>

                        <?php if (isset($errors['niveau'])): ?>
                             <p class="text-red-600 text-sm"> <?= $errors['niveau'] ?> </p>
                        <?php endif; ?>
                    </div>
                </div>

              
            </div>

            <!-- Actions -->
            <div class="flex flex-col-reverse md:flex-row gap-4 justify-end">
                <a href="#" class="px-6 py-3 bg-gray-700 hover:bg-gray-600 rounded-xl text-white transition-colors text-center">
                    Annuler
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-gradient-to-r from-[#b31822] to-orange-600 hover:from-[#d11a2a] hover:to-orange-700 
                               text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all">
                    <i class="ri-add-line mr-2"></i>Créer la classe
                </button>
            </div>
        </form>
    </div>
