<div class="min-h-screen  flex items-center justify-center p-4">
    <!-- Carte principale simplifiée -->
    <div class="relative bg-white w-full max-w-md rounded-2xl  shadow-xl overflow-hidden">
        <!-- En-tête -->
        <div class=" p-8 text-center"> 
            <h1 class="text-3xl font-bold text-gray-500">Connexion à la plateforme</h1>
        </div>

        <!-- Formulaire -->
        <form class="px-8 py-8 space-y-6" method="POST">
            <?php if (!empty($errors)) : ?>
                <div class="bg-rose-100 border-l-4 border-rose-500 text-rose-700 p-4 rounded">
                    <?php foreach ($errors as $error) : ?>
                        <p class="flex items-start">
                            <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                            </svg>
                            <span><?= $error ?></span>
                        </p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="space-y-5">
                <!-- Champ Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-300 mb-1">Identifiant académique</label>
                    <input 
                        type="email" 
                        id="email"
                        class="w-full  border border-slate-600 rounded-lg px-4 py-3 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="email..."
                        name="email"
                        value="<?= htmlspecialchars($email) ?>"
                    />
                </div>

                <!-- Champ Mot de passe -->
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-300 mb-1">Mot de passe</label>
                    <input 
                        type="password" 
                        id="password"
                        class="w-full border border-slate-600 rounded-lg px-4 py-3 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="••••••••"
                        name="password"
                    />
                </div>
            </div>

            <!-- Bouton de connexion -->
            <button 
                type="submit"
                class="w-full bg-gradient-to-r from-blue-600 to-gray-600 text-white font-medium py-3 px-6 rounded-lg hover:opacity-90 transition-opacity focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 focus:ring-offset-slate-800"
            >
            Se connecter
            </button>

            <!-- Liens secondaires -->
           
    
</div>