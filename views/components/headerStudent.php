 <!-- Header -->
 <header class="bg-slate-800/90 backdrop-blur-lg border-b border-slate-700/50 p-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <button class="lg:hidden text-slate-300">
                            <i class="fas fa-bars"></i>
                        </button>
                        <div class="text-lg font-semibold text-slate-200">Tableau de Bord</div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="p-2 hover:bg-slate-700/30 rounded-full transition-colors">
                            <i class="fas fa-bell text-slate-300"></i>
                        </button>
                        <div class="flex items-center space-x-2">
                            <div class="student-avatar h-8 w-8 rounded-full flex items-center justify-center 
                                  bg-gradient-to-br from-indigo-500 to-blue-400 text-white font-bold 
                                  ring-2 ring-indigo-500/30 group-hover:ring-indigo-400/50 transition-all">
                                <?= substr($_SESSION['user']['prenom'], 0, 1) . substr($_SESSION['user']['nom'], 0, 1) ?>
                            </div>
                            <span class="text-slate-300"><?= $_SESSION['user']['prenom'] ?> <?= $_SESSION['user']['nom'] ?></span>
                        </div>
                    </div>
                </div>
            </header>