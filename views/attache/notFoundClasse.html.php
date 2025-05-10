<!-- État vide amélioré -->
<div class="flex flex-col items-center justify-center w-full mt-12 gap-8">
                    <div class="relative w-64 h-64">
                        <img src="/image/notFound-removebg-preview.png" alt="Aucun étudiant" 
                            class="w-full h-full object-contain opacity-50">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent"></div>
                    </div>
                    <div class="text-center space-y-2">
                        <p class="text-xl font-semibold text-gray-300">Aucune Classe n'est selectionner</p>
                        <p class="text-sm text-gray-500 max-w-md">
                            Veuillez selectionner une classe pour voir ses étudiant.
                            <a href="<?= WEBROOT?>?controller=attache" class="text-indigo-400 neon-effect">Retour au menu </a>
                        </p>
                    </div>
                </div>