<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | BuyMatch</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        
        :root {
            --gold: #d4af37;
            --bg-dark: #050505;
            --glass-bg: rgba(20, 20, 20, 0.85);
            --border-color: rgba(255, 255, 255, 0.08);
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--bg-dark); 
            color: white; 
            overflow-x: hidden;
        }

        /* Animated Background */
        .bg-grid {
            position: fixed; top: 0; left: 0; w: 100%; h: 100%; z-index: -1;
            background-image: 
                radial-gradient(circle at 15% 50%, rgba(212, 175, 55, 0.05), transparent 25%), 
                radial-gradient(circle at 85% 30%, rgba(212, 175, 55, 0.05), transparent 25%);
        }

        /* Sidebar Styling */
        .sidebar-glass {
            background: rgba(10, 10, 10, 0.95);
            backdrop-filter: blur(10px);
            border-right: 1px solid var(--border-color);
        }

        .sidebar-link {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-left: 3px solid transparent;
        }
        .sidebar-link:hover, .sidebar-link.active {
            background: linear-gradient(90deg, rgba(212, 175, 55, 0.15) 0%, transparent 100%);
            color: var(--gold);
            border-left-color: var(--gold);
        }

        /* Card Styling */
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            border: 1px solid var(--border-color);
            transition: transform 0.3s ease;
        }
        .glass-card:hover { border-color: rgba(212, 175, 55, 0.3); }

        /* Status Badges */
        .status-badge { padding: 4px 10px; border-radius: 20px; font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; }
        .status-active { background: rgba(34, 197, 94, 0.15); color: #4ade80; border: 1px solid rgba(34, 197, 94, 0.3); }
        .status-banned { background: rgba(239, 68, 68, 0.15); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.3); }
        .status-pending { background: rgba(234, 179, 8, 0.15); color: #facc15; border: 1px solid rgba(234, 179, 8, 0.3); }

        /* Animation */
        .fade-in { animation: fadeIn 0.4s ease-out forwards; opacity: 0; transform: translateY(10px); }
        @keyframes fadeIn { to { opacity: 1; transform: translateY(0); } }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-thumb { background: #333; border-radius: 3px; }
    </style>
</head>
<body class="flex h-screen">

    <div class="bg-grid"></div>

    <!-- 1. SIDEBAR -->
    <aside class="w-72 sidebar-glass flex flex-col fixed h-full z-50">
        <!-- Logo -->
        <div class="p-8 flex items-center gap-3">
            <i class='bx bxs-shield-quarter text-[#d4af37] text-3xl animate-pulse'></i>
            <div>
                <h1 class="font-black text-xl italic tracking-tighter uppercase leading-none text-white">BUY<span class="text-[#d4af37]">MATCH</span></h1>
                <span class="text-[9px] uppercase tracking-[3px] text-red-500 font-bold">Admin Panel</span>
            </div>
        </div>

        <!-- Retour Accueil -->
        <div class="px-6 mb-6">
            <a href="/" class="group flex items-center justify-center gap-2 w-full py-3 rounded-xl bg-white/5 border border-white/5 text-gray-300 font-bold uppercase text-[10px] tracking-widest hover:bg-[#d4af37] hover:text-black hover:border-[#d4af37] hover:shadow-[0_0_20px_rgba(212,175,55,0.4)] transition-all duration-300">
                <i class='bx bx-left-arrow-alt text-lg group-hover:-translate-x-1 transition-transform'></i>
                Site Public
            </a>
        </div>

        <!-- Menu -->
        <nav class="flex-1 px-4 space-y-2 overflow-y-auto">
            <button onclick="showSection('dashboard')" class="sidebar-link active w-full flex items-center gap-4 px-4 py-3.5 text-sm font-bold text-gray-400 rounded-r-xl">
                <i class='bx bxs-dashboard'></i> Vue Globale
            </button>
            <button onclick="showSection('users')" class="sidebar-link w-full flex items-center gap-4 px-4 py-3.5 text-sm font-bold text-gray-400 rounded-r-xl">
                <i class='bx bxs-user-detail'></i> Utilisateurs
            </button>
            <button onclick="showSection('validations')" class="sidebar-link w-full flex items-center gap-4 px-4 py-3.5 text-sm font-bold text-gray-400 rounded-r-xl">
                <i class='bx bxs-check-shield'></i> Validations Matchs
                <span class="ml-auto bg-[#d4af37] text-black text-[10px] px-2 py-0.5 rounded-full font-bold"><?= count($eventsEnatente) ?></span>
            </button>
            <button onclick="showSection('comments')" class="sidebar-link w-full flex items-center gap-4 px-4 py-3.5 text-sm font-bold text-gray-400 rounded-r-xl">
                <i class='bx bxs-message-rounded-error'></i> Modération
            </button>
        </nav>

        <!-- Admin Profile -->
        <div class="p-6 border-t border-white/5 bg-black/20">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-red-900/30 border border-red-500 flex items-center justify-center text-red-500">
                    <i class='bx bx-crown text-xl'></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs font-bold text-white">Super Admin</p>
                    <p class="text-[9px] text-gray-500">Accès Total</p>
                </div>
                <button class="text-gray-500 hover:text-white"><i class='bx bx-log-out text-xl'></i></button>
            </div>
        </div>
    </aside>

    <!-- 2. MAIN CONTENT -->
    <main class="flex-1 ml-72 p-10 overflow-y-auto">
        
        <!-- Header -->
        <header class="flex justify-between items-end mb-10 fade-in">
            <div>
                <h2 id="page-title" class="text-3xl font-black uppercase italic text-white">Vue <span class="text-[#d4af37]">Globale</span></h2>
                <p class="text-gray-500 text-xs mt-1">Aperçu des performances de la plateforme</p>
            </div>
            <div class="flex gap-3">
                <button class="w-10 h-10 rounded-full bg-white/5 hover:bg-white/10 flex items-center justify-center text-white transition">
                    <i class='bx bx-search'></i>
                </button>
                <button class="w-10 h-10 rounded-full bg-white/5 hover:bg-white/10 flex items-center justify-center text-white transition relative">
                    <i class='bx bx-bell'></i>
                    <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>
            </div>
        </header>

        <!-- SECTION A: DASHBOARD STATS -->
        <div id="dashboard" class="section-content fade-in">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Card 1 -->
                <div class="glass-card p-6 rounded-2xl relative overflow-hidden group">
                    <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <i class='bx bxs-user-account text-6xl text-[#d4af37]'></i>
                    </div>
                    <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-2">Utilisateurs Totaux</p>
                    <h3 class="text-3xl font-black text-white">24,592</h3>
                    <p class="text-green-400 text-xs mt-2 flex items-center gap-1"><i class='bx bx-up-arrow-alt'></i> +12% ce mois</p>
                </div>

                <!-- Card 2 -->
                <div class="glass-card p-6 rounded-2xl relative overflow-hidden group">
                    <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <i class='bx bxs-ball text-6xl text-blue-500'></i>
                    </div>
                    <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-2">Matchs Organisés</p>
                    <h3 class="text-3xl font-black text-white">156</h3>
                    <p class="text-blue-400 text-xs mt-2 flex items-center gap-1">5 en attente</p>
                </div>

                <!-- Card 3 -->
                <div class="glass-card p-6 rounded-2xl relative overflow-hidden group">
                    <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <i class='bx bxs-bank text-6xl text-green-500'></i>
                    </div>
                    <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-2">Revenus Totaux</p>
                    <h3 class="text-3xl font-black text-white">1.2M <span class="text-sm text-gray-500">DH</span></h3>
                    <p class="text-green-400 text-xs mt-2 flex items-center gap-1"><i class='bx bx-up-arrow-alt'></i> +8% ce mois</p>
                </div>

                <!-- Card 4 -->
                <div class="glass-card p-6 rounded-2xl relative overflow-hidden group">
                    <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <i class='bx bxs-report text-6xl text-red-500'></i>
                    </div>
                    <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-2">Signalements</p>
                    <h3 class="text-3xl font-black text-white">12</h3>
                    <p class="text-red-400 text-xs mt-2 flex items-center gap-1">À traiter urgemment</p>
                </div>
            </div>

            <!-- Fake Chart -->
            <div class="glass-card p-8 rounded-3xl">
                <h3 class="font-bold text-lg mb-6">Activité de la plateforme</h3>
                <div class="flex items-end justify-between gap-2 h-64 w-full">
                    <!-- Generating bars via simple divs -->
                    <div class="w-full bg-[#1a1a1a] rounded-t-lg relative group h-[40%] hover:bg-[#d4af37] transition-all"><span class="opacity-0 group-hover:opacity-100 absolute -top-6 left-1/2 -translate-x-1/2 text-xs">40%</span></div>
                    <div class="w-full bg-[#1a1a1a] rounded-t-lg relative group h-[60%] hover:bg-[#d4af37] transition-all"><span class="opacity-0 group-hover:opacity-100 absolute -top-6 left-1/2 -translate-x-1/2 text-xs">60%</span></div>
                    <div class="w-full bg-[#1a1a1a] rounded-t-lg relative group h-[30%] hover:bg-[#d4af37] transition-all"><span class="opacity-0 group-hover:opacity-100 absolute -top-6 left-1/2 -translate-x-1/2 text-xs">30%</span></div>
                    <div class="w-full bg-[#1a1a1a] rounded-t-lg relative group h-[80%] hover:bg-[#d4af37] transition-all"><span class="opacity-0 group-hover:opacity-100 absolute -top-6 left-1/2 -translate-x-1/2 text-xs">80%</span></div>
                    <div class="w-full bg-[#1a1a1a] rounded-t-lg relative group h-[55%] hover:bg-[#d4af37] transition-all"><span class="opacity-0 group-hover:opacity-100 absolute -top-6 left-1/2 -translate-x-1/2 text-xs">55%</span></div>
                    <div class="w-full bg-[#1a1a1a] rounded-t-lg relative group h-[90%] hover:bg-[#d4af37] transition-all"><span class="opacity-0 group-hover:opacity-100 absolute -top-6 left-1/2 -translate-x-1/2 text-xs">90%</span></div>
                    <div class="w-full bg-[#1a1a1a] rounded-t-lg relative group h-[70%] hover:bg-[#d4af37] transition-all"><span class="opacity-0 group-hover:opacity-100 absolute -top-6 left-1/2 -translate-x-1/2 text-xs">70%</span></div>
                </div>
                <div class="flex justify-between mt-4 text-xs text-gray-500 font-bold uppercase tracking-widest">
                    <span>Lun</span><span>Mar</span><span>Mer</span><span>Jeu</span><span>Ven</span><span>Sam</span><span>Dim</span>
                </div>
            </div>
        </div>

        <!-- SECTION B: UTILISATEURS (Active/Ban) -->
        <div id="users" class="section-content hidden fade-in">
            <div class="glass-card rounded-3xl overflow-hidden">
                <div class="p-6 border-b border-white/5 flex justify-between items-center">
                    <h3 class="font-bold text-lg">Gestion des Utilisateurs</h3>
                    <input type="text" placeholder="Rechercher..." class="bg-black/30 border border-white/10 rounded-full px-4 py-2 text-xs text-white focus:border-[#d4af37] outline-none">
                </div>
                <table class="w-full text-left">
                    <thead class="bg-black/30 text-[10px] uppercase text-gray-400 font-black tracking-widest">
                        <tr>
                            <th class="p-5">Utilisateur</th>
                            <th class="p-5">Rôle</th>
                            <th class="p-5">Statut</th>
                            <th class="p-5 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        <!-- User 1 -->
                        <?php foreach ($allUsers as $user):
                            $path_image = '../../public/uploads/'. $user->getPhoto();
                            ?>
                            <tr class="border-b border-white/5 hover:bg-white/5 transition">
                                <td class="p-5 flex items-center gap-3">
                                    <img src="<?= htmlspecialchars($path_image) ?>" class="w-8 h-8 rounded-full">
                                    <span class="font-bold"><?= htmlspecialchars($user->getName()) ?></span>
                                </td>
                                <td class="p-5 text-gray-400"><?= htmlspecialchars($user->getRole()) ?></td>
                                <td class="p-5"><span id="status-<?= htmlspecialchars($user->getId()) ?>" class="status-badge status-active"><?= htmlspecialchars($user->getStatus()) ?></span></td>
                                <td class="p-5 text-right">
                                    <button onclick="toggleBan(<?= htmlspecialchars($user->getId()) ?>)" class="text-xs font-bold uppercase tracking-wider text-red-500 hover:text-red-400 border border-red-500/30 px-3 py-1.5 rounded-lg hover:bg-red-500/10 transition">
                                        <i class='bx bx-block'></i> Bannir
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- SECTION C: VALIDATION MATCHS (Accept/Reject) -->
        <div id="validations" class="section-content hidden fade-in">
            <h3 class="font-bold text-lg mb-6">Demandes en attente (<?= count($eventsEnatente) ?>)</h3>
            
            <div class="grid gap-6">
                <!-- Request Item 1 -->
                <?php foreach ($eventsEnatente as $event):
                    $path_logo1 = '../../public/uploads_logo_equipe/'. $event['equipe1']->getLogo();
                    $path_logo2 = '../../public/uploads_logo_equipe/'. $event['equipe2']->getLogo();
                    $dateEvent = new DateTime($event['event']->getDateEvent());
                    $heureEvent = new DateTime($event['event']->getDateEvent());
                    $dateFormated  = $dateEvent->format('d/m/Y'); // 10/10/1111
                    $heureFormated = $heureEvent->format('H:i');  // 20:20

                     ?>
                   <div id="<?= $event['event']->getId() ?>" class="group relative overflow-hidden glass-card rounded-[32px] flex flex-col xl:flex-row items-stretch border-none transition-all duration-500 hover:scale-[1.01] hover:shadow-[0_20px_50px_rgba(0,0,0,0.5)]">
    
                <div class="relative min-w-[300px] bg-gradient-to-br from-[#1a1a1a] to-[#050505] p-8 flex flex-col justify-center items-center border-r border-dashed border-white/10">
                    <div class="absolute inset-0 opacity-10 pointer-events-none flex items-center justify-center font-black italic text-8xl uppercase tracking-tighter text-white">VS</div>
                    
                    <div class="relative z-10 flex items-center gap-6">
                        <div class="text-center">
                            <img src="<?php echo $path_logo1; ?>" class="w-16 h-16 object-contain drop-shadow-[0_0_15px_rgba(255,255,255,0.2)]" alt="WAC">
                            <p class="text-[10px] font-black text-gray-500 mt-2 uppercase"><?php echo $event['equipe1']->getNom(); ?></p>
                        </div>
                        
                        <div class="flex flex-col items-center">
                            <span class="text-2xl font-black italic text-[#d4af37]">VS</span>
                            <span class="bg-[#d4af37]/10 text-[#d4af37] text-[8px] px-2 py-0.5 rounded-full font-bold mt-1 uppercase">CHOC</span>
                        </div>

                        <div class="text-center">
                            <img src="<?php echo $path_logo2; ?>" class="w-16 h-16 object-contain drop-shadow-[0_0_15px_rgba(255,255,255,0.2)]" alt="RCA">
                            <p class="text-[10px] font-black text-gray-500 mt-2 uppercase"><?php echo $event['equipe2']->getNom(); ?></p>
                        </div>
                    </div>

                    <div class="absolute -top-4 -right-4 w-8 h-8 bg-[#050505] rounded-full z-20"></div>
                    <div class="absolute -bottom-4 -right-4 w-8 h-8 bg-[#050505] rounded-full z-20"></div>
                </div>

                <div class="flex-1 p-8 flex flex-col justify-center gap-4">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="bg-white/5 border border-white/10 text-white text-[9px] font-black uppercase px-3 py-1 rounded-lg tracking-widest">Botola Pro Inwi</span>
                        <span class="flex items-center gap-1 text-[#d4af37] text-[10px] font-bold uppercase"><i class='bx bxs-award'></i> Match Certifié</span>
                    </div>

                    <div>
                        <h4 class="text-3xl font-black uppercase italic leading-tight text-white mb-1">
                            <?php echo $event['event']->getTitre(); ?> 
                        </h4>
                        <div class="flex flex-wrap gap-x-6 gap-y-2">
                            <p class="text-sm text-gray-400 flex items-center gap-2"><i class='bx bxs-calendar text-[#d4af37]'></i><?php echo $dateFormated; ?></p>
                            <p class="text-sm text-gray-400 flex items-center gap-2"><i class='bx bxs-time-five text-[#d4af37]'></i> <?php echo $heureFormated; ?></p>
                            <p class="text-sm text-gray-400 flex items-center gap-2"><i class='bx bxs-map text-[#d4af37]'></i> <?php echo $event['event']->getLieu(); ?></p>
                        </div>
                    </div>
                </div>

                <div class="p-8 flex flex-row xl:flex-col justify-center gap-4 bg-white/[0.02] border-l border-white/5 min-w-[220px]">
                    <button onclick="handleRequest('<?= $event['event']->getId() ?>', 'accepted')" class="flex-1 xl:flex-none order-2 xl:order-1 flex items-center justify-center gap-2 bg-[#d4af37] text-black font-black uppercase text-xs py-4 px-6 rounded-2xl hover:bg-white transition-all shadow-[0_10px_20px_rgba(212,175,55,0.2)] hover:shadow-[0_10px_30px_rgba(255,255,255,0.3)] group/btn">
                        <i class='bx bx-check-double text-xl'></i>
                        <span>Valider</span>
                    </button>
                    
                    <button onclick="handleRequest('<?= $event['event']->getId() ?>', 'rejected')" class="flex-1 xl:flex-none order-1 xl:order-2 flex items-center justify-center gap-2 bg-transparent border border-white/10 text-gray-400 font-black uppercase text-xs py-4 px-6 rounded-2xl hover:bg-red-500 hover:text-white hover:border-red-500 transition-all">
                        <i class='bx bx-x text-xl'></i>
                        <span>Refuser</span>
                    </button>
                </div>
            </div>
                <?php endforeach; ?>

            </div>
        </div>

        <!-- SECTION D: COMMENTAIRES (Modération) -->
        <div id="comments" class="section-content hidden fade-in">
            <h3 class="font-bold text-lg mb-6">Modération des Commentaires</h3>
            
            <div class="space-y-4">
            
                <?php foreach ($allComments as $comment): 
                        $note =$comment['note'];
                        $datePost = isset($comment['date_commentaire']) ? $comment['date_commentaire'] : date('d/m/Y');
                    ?>
                    <div id="comm-<?= $comment['id'] ?>" class="glass-card p-6 rounded-[24px] border-l-4 border-[#d4af37] group hover:bg-white/[0.02] transition-all duration-300">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex flex-col gap-2">
                                <div class="flex items-center gap-3">
                                    <span class="bg-[#d4af37] text-black text-[10px] font-black uppercase px-2.5 py-1 rounded-lg shadow-sm">
                                        <?= htmlspecialchars($comment['user']->getName()) ?>
                                    </span>
                                    <span class="text-gray-400 text-[10px] font-bold uppercase tracking-widest flex items-center gap-1">
                                        <i class='bx bx-football text-[#d4af37]'></i> <?= htmlspecialchars($comment['match']) ?>
                                    </span>
                                </div>
                                
                                <div class="flex text-[#d4af37] text-xs">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <i class='bx <?= $i <= $note ? 'bxs-star' : 'bx-star text-gray-700' ?>'></i>
                                    <?php endfor; ?>
                                    <span class="ml-2 text-[10px] text-gray-500 font-bold">(<?= $note ?>/5)</span>
                                </div>
                            </div>

                            <div class="flex flex-col items-end">
                                <span class="text-gray-500 text-[10px] font-bold uppercase tracking-tighter">
                                    <i class='bx bx-calendar-alt'></i> <?= htmlspecialchars($comment['date_commentaire']) ?>
                                </span>
                                <span class="text-[9px] text-gray-700 font-bold uppercase">Publié</span>
                            </div>
                        </div>

                        <div class="relative pl-4 border-l border-white/5">
                            <p class="text-sm text-gray-300 italic leading-relaxed font-medium">
                                "<?= htmlspecialchars($comment['contenu']) ?>"
                            </p>
                        </div>

                        <div class="mt-5 flex gap-4 justify-end border-t border-white/5 pt-4">
                            <button onclick="ignoreComment('comm-<?= $comment['id'] ?>')" class="text-[10px] text-gray-500 font-black uppercase tracking-widest hover:text-white transition flex items-center gap-1.5 px-3 py-1.5 rounded-lg hover:bg-white/5">
                                <i class='bx bx-check-circle text-lg text-green-500'></i> Ignorer
                            </button>
                            <button onclick="deleteComment('comm-<?= $comment['id'] ?>')" class="text-[10px] text-red-500 font-black uppercase tracking-widest hover:bg-red-500 hover:text-white transition flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-red-500/20 shadow-lg shadow-red-500/5">
                                <i class='bx bx-trash text-lg'></i> Supprimer
                            </button>
                        </div>
                    </div>
                    <?php endforeach; ?>


            </div>
        </div>

    </main>

    <!-- JS Logic -->
    <script>
        // Section Switching
        function showSection(id) {
            document.querySelectorAll('.section-content').forEach(el => el.classList.add('hidden'));
            document.getElementById(id).classList.remove('hidden');
            
            document.querySelectorAll('.sidebar-link').forEach(el => el.classList.remove('active'));
            event.currentTarget.classList.add('active');

            const titles = {
                'dashboard': 'Vue <span class="text-[#d4af37]">Globale</span>',
                'users': 'Gestion <span class="text-[#d4af37]">Utilisateurs</span>',
                'validations': 'Validation <span class="text-[#d4af37]">Matchs</span>',
                'comments': 'Modération <span class="text-[#d4af37]">Comm.</span>'
            };
            document.getElementById('page-title').innerHTML = titles[id];
        }

        // Toggle Ban User
        function toggleBan(id) {
            const statusBadge = document.getElementById(`status-${id}`);
            const btn = event.currentTarget;
            
            if (statusBadge.classList.contains('status-active')) {
                // Ban action
                statusBadge.className = 'status-badge status-banned';
                statusBadge.innerText = 'Banni';
                btn.innerHTML = "<i class='bx bx-check-circle'></i> Activer";
                btn.classList.replace('text-red-500', 'text-green-500');
                btn.classList.replace('hover:text-red-400', 'hover:text-green-400');
                btn.classList.replace('border-red-500/30', 'border-green-500/30');
                btn.classList.replace('hover:bg-red-500/10', 'hover:bg-green-500/10');
            } else {
                // Activate action
                statusBadge.className = 'status-badge status-active';
                statusBadge.innerText = 'Actif';
                btn.innerHTML = "<i class='bx bx-block'></i> Bannir";
                btn.classList.replace('text-green-500', 'text-red-500');
                btn.classList.replace('hover:text-green-400', 'hover:text-red-400');
                btn.classList.replace('border-green-500/30', 'border-red-500/30');
                btn.classList.replace('hover:bg-green-500/10', 'hover:bg-red-500/10');
            }


            fetch('../api/UpdateStatus.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ userId: id })
            })
            // .then(response => response.json())
            // .then(data => { console.log('Success:', data) })
            .catch((error) => console.error('Error:', error));
        }

        // Handle Match Request
        function  handleRequest(id, action) {
            const card = document.getElementById(id);
            const content = card.innerHTML;
            
            if(action === 'accepted') {
                card.style.borderColor = '#4ade80'; // Green
                card.innerHTML = `<div class="w-full text-center py-8 text-green-500 font-bold uppercase tracking-widest animate-pulse"><i class='bx bx-check-circle text-3xl mb-2'></i><br>Match Validé et Publié</div>`;
            } else {
                card.style.borderColor = '#f87171'; // Red
                card.innerHTML = `<div class="w-full text-center py-8 text-red-500 font-bold uppercase tracking-widest"><i class='bx bx-x-circle text-3xl mb-2'></i><br>Demande Refusée</div>`;
            }

            setTimeout(() => {
                card.style.opacity = '0';
                setTimeout(() => card.remove(), 500);
            }, 2000);

            fetch('../api/handleRequest.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ requestId: id, action: action })
            })
            .catch((error) => console.error('Error:', error));

        }

        // Moderate Comment
        function deleteComment(id) {
            const el = document.getElementById(id);
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 300);

            fetch('../api/deleteComment.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ commentId: id.split('-')[1] })
            })
            .catch((error) => console.error('Error:', error));
        }

        function ignoreComment(id) {
            const el = document.getElementById(id);
            el.style.opacity = '0.5';
            setTimeout(() => el.remove(), 300);
        }
    </script>
</body>
</html>