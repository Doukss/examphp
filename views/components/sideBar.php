<!-- Sidebar Futuriste Améliorée -->
<aside class="glass-effect backdrop-blur-lg bg-gray-900/80 w-72 min-h-screen p-6 space-y-8 fixed h-full border-r border-gray-700/30 z-50">
    <!-- Logo -->
    <div class="flex items-center gap-3 pb-6 border-b border-gray-700/30">
        <div class="p-2 bg-gradient-to-br from-[#b31822] to-orange-600 rounded-xl">
            <i class="ri-school-line text-2xl text-white"></i>
        </div>
        <h2 class="text-xl font-bold bg-gradient-to-r from-[#b31822] to-orange-600 bg-clip-text text-transparent">
            ECOLE 221
        </h2>
    </div>

    <!-- Navigation -->
    <nav class="space-y-1">
        <a href="<?= WEBROOT?>?controller=rp&page=dashboard" 
           class="flex items-center p-3 rounded-xl hover:bg-gray-800/50 transition-all group relative
                  <?= $currentPage === 'dashboard' ? 'bg-gray-800/50 border-l-4 border-[#b31822]' : '' ?>">
            <i class="ri-dashboard-line text-xl mr-3 text-gray-400 group-hover:text-[#b31822] transition-all"></i>
            <span class="font-medium">Tableau de bord</span>
            <div class="absolute right-3 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-opacity">
                <div class="w-2 h-2 bg-[#b31822] rounded-full animate-pulse"></div>
            </div>
        </a>

        <a href="<?= WEBROOT?>?controller=rp&page=classe" 
           class="flex items-center p-3 rounded-xl hover:bg-gray-800/50 transition-all group relative
                  <?= $currentPage === 'classe' ? 'bg-gray-800/50 border-l-4 border-[#b31822]' : '' ?>">
            <i class="ri-team-line text-xl mr-3 text-gray-400 group-hover:text-[#b31822] transition-all"></i>
            <span class="font-medium">Classes</span>
        </a>

        <a href="<?= WEBROOT?>?controller=rp&page=prof" 
           class="flex items-center p-3 rounded-xl hover:bg-gray-800/50 transition-all group relative
                  <?= $currentPage === 'prof' ? 'bg-gray-800/50 border-l-4 border-[#b31822]' : '' ?>">
            <i class="ri-user-star-line text-xl mr-3 text-gray-400 group-hover:text-[#b31822] transition-all"></i>
            <span class="font-medium">Professeurs</span>
        </a>

        <a href="<?= WEBROOT?>?controller=rp&page=cours" 
           class="flex items-center p-3 rounded-xl hover:bg-gray-800/50 transition-all group relative
                  <?= $currentPage === 'cours' ? 'bg-gray-800/50 border-l-4 border-[#b31822]' : '' ?>">
            <i class="ri-book-open-line text-xl mr-3 text-gray-400 group-hover:text-[#b31822] transition-all"></i>
            <span class="font-medium">Cours</span>
        </a>
    </nav>

    <!-- Section Utilisateur + Déconnexion -->
    <div class="absolute bottom-6 left-0 right-0 px-6">
        <div class="pt-4 border-t border-gray-700/30">
            <!-- Profil -->
            <div class="flex items-center gap-3 group cursor-pointer p-3 rounded-xl hover:bg-gray-800/50 transition-all">
                <img src="https://i.pravatar.cc/40" 
                     class="rounded-full w-10 h-10 border-2 border-[#b31822]/50 hover:border-[#b31822] transition-colors">
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium truncate"><?= $_SESSION["user"]["prenom"] ?> <?= $_SESSION["user"]["nom"] ?></p>
                    <p class="text-xs text-gray-400 truncate">Responsable Pédagogique</p>
                </div>
            </div>

            <!-- Bouton Déconnexion -->
            <a href="<?= WEBROOT?>?controller=security&page=logout" 
               class="flex items-center p-3 rounded-xl bg-red-500/20 hover:bg-red-500/30 text-red-400 hover:text-red-300 transition-all mt-2">
                <i class="ri-logout-box-r-line text-xl mr-3"></i>
                <span class="font-medium">Déconnexion</span>
            </a>
        </div>
    </div>
</aside>

