  <!-- Sidebar -->
  <aside class="w-64 bg-slate-800/90 backdrop-blur-lg border-r border-slate-700/50 p-4 hidden lg:block">
            <div class="mb-8">
                <div class="text-2xl font-bold bg-gradient-to-r from-indigo-400 to-purple-600 bg-clip-text text-transparent">
                    École 221
                </div>
            </div>
            <nav class="space-y-2">
                <a href="<?= WEBROOT?>?controller=student&page=student" class="flex items-center space-x-3 p-3 rounded-xl bg-indigo-400/10 text-indigo-400">
                    <i class="fas fa-chart-line w-5"></i>
                    <span>Dashboard</span>
                </a>
                <a href="<?= WEBROOT?>?controller=student&page=mesCours" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-slate-700/30 text-slate-300 transition-colors">
                    <i class="fas fa-book-open w-5"></i>
                    <span>Mes Cours</span>
                </a>
                <a href="<?= WEBROOT?>?controller=student&page=mesAbsences" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-slate-700/30 text-slate-300 transition-colors">
                    <i class="fas fa-calendar-times w-5"></i>
                    <span>Absences</span>
                </a>
                <a href="<?= WEBROOT?>?controller=student&page=profil" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-slate-700/30 text-slate-300 transition-colors">
                    <i class="fas fa-user-graduate w-5"></i>
                    <span>Profil</span>
                </a>
            </nav>
        </aside>