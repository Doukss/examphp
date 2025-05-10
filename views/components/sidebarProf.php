 <!-- Sidebar -->
 <aside class="w-72 bg-slate-800/50 backdrop-blur-lg p-6 border-r border-slate-700/50">
            <div class="flex items-center gap-4 mb-12">
                <div class="w-12 h-12 bg-gradient-to-r from-rose-600 to-purple-600 rounded-xl rotate-45 flex items-center justify-center">
                    <div class="-rotate-45 text-white font-bold text-xl">221</div>
                </div>
                <h1 class="text-2xl font-bold bg-gradient-to-r from-rose-400 to-purple-300 bg-clip-text text-transparent">
                    DIGITAL CAMPUS
                </h1>
            </div>

            <nav class="space-y-2">
                <a href="#" class="flex items-center gap-3 p-3 rounded-xl bg-rose-600/20 text-rose-400 hover:bg-rose-600/30 transition-all group">
                    <i class='bx bxs-dashboard text-xl'></i>
                    Tableau de bord
                </a>
                <a href="#" class="flex items-center gap-3 p-3 rounded-xl text-slate-300 hover:bg-slate-700/30 hover:text-white transition-all group">
                    <i class='bx bxs-calendar text-xl'></i>
                    Mes cours
                </a>
                <a href="#" class="flex items-center gap-3 p-3 rounded-xl text-slate-300 hover:bg-slate-700/30 hover:text-white transition-all group">
                    <i class='bx bxs-user-x text-xl'></i>
                    Absences
                </a>
            </nav>
             <!-- Bouton Déconnexion -->
             <a href="<?= WEBROOT?>?controller=security&page=logout" 
               class="flex items-center p-3 rounded-xl bg-red-500/20 hover:bg-red-500/30 text-red-400 hover:text-red-300 transition-all mt-2">
                <i class="ri-logout-box-r-line text-xl mr-3"></i>
                <span class="font-medium">Déconnexion</span>
            </a>
        </aside>