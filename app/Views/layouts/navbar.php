<?php
$isLoggedIn = isset($_SESSION['user_id']);
$role = $isLoggedIn ? $_SESSION['role'] : null;
?>

<nav class="fixed top-0 w-full bg-black/60 backdrop-blur-xl border-b border-white/5 z-[100]">
    <div class="max-w-7xl mx-auto px-6 lg:px-20 py-5 flex items-center justify-between">
        
        <a href="/" class="text-2xl font-black tracking-tighter flex items-center gap-2 group">
            <div class="w-8 h-8 bg-gold rounded-lg flex items-center justify-center text-black group-hover:rotate-12 transition-transform">B</div>
            BUY<span class="gold-shine uppercase italic">MATCH</span>
        </a>

        <div class="hidden md:flex items-center gap-10">
            <a href="homePageControllers.php" class="text-[10px] font-black tracking-[3px] uppercase hover:text-gold transition-colors">Aceuile</a>
            <a href="EventsControllers.php" class="text-[10px] font-black tracking-[3px] uppercase hover:text-gold transition-colors">Matches</a>
            <a href="#about" class="text-[10px] font-black tracking-[3px] uppercase hover:text-gold transition-colors">About</a>
            
            <?php if ($isLoggedIn): ?>
                <?php if ($role === 'admin'): ?>
                    <a href="AdminControllers.php" class="text-[10px] font-black tracking-[3px] uppercase text-gold border-b border-gold pb-1 italic">
                        <i class='bx bxs-dashboard'></i> Espace Admin
                    </a>
                <?php elseif ($role === 'organisateur'): ?>
                    <a href="OrganisateurController.php" class="text-[10px] font-black tracking-[3px] uppercase text-gold border-b border-gold pb-1 italic">
                        <i class='bx bxs-megaphone'></i> Espace Organisateur
                    </a>
                <?php elseif ($role === 'acheteur'): ?>
                    <a href="UserController.php" class="text-[10px] font-black tracking-[3px] uppercase text-gold border-b border-gold pb-1 italic">
                        <i class='bx bxs-user-circle'></i> Mon Espace
                    </a>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="flex items-center gap-4">
            <?php if (!$isLoggedIn): ?>
                <a href="LoginController.php" class="text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-white transition">Connexion</a>
                <a href="SignupController.php" class="px-6 py-2.5 bg-gold text-black font-black rounded-full text-[10px] uppercase tracking-widest hover:bg-white transition-all shadow-[0_0_20px_rgba(212,175,55,0.2)]">
                    Inscription
                </a>
            <?php else: ?>
                <div class="flex items-center gap-4 border-l border-white/10 pl-6">
                    <span class="text-[9px] font-bold text-gray-500 uppercase tracking-tighter">Connecté en tant que <br> <b class="text-white"><?= ucfirst($role) ?></b></span>
                    <a href="?action=logout" class="w-10 h-10 rounded-full border border-red-500/30 flex items-center justify-center text-red-500 hover:bg-red-500 hover:text-white transition-all" title="Déconnexion">
                        <i class='bx bx-log-out-circle text-xl'></i>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</nav>

