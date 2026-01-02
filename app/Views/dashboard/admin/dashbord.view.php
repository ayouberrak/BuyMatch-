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
                <span class="ml-auto bg-[#d4af37] text-black text-[10px] px-2 py-0.5 rounded-full font-bold">3</span>
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
                        <tr class="border-b border-white/5 hover:bg-white/5 transition">
                            <td class="p-5 flex items-center gap-3">
                                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=User1" class="w-8 h-8 rounded-full">
                                <span class="font-bold">Youssef Bennani</span>
                            </td>
                            <td class="p-5 text-gray-400">Utilisateur</td>
                            <td class="p-5"><span id="status-1" class="status-badge status-active">Actif</span></td>
                            <td class="p-5 text-right">
                                <button onclick="toggleBan(1)" class="text-xs font-bold uppercase tracking-wider text-red-500 hover:text-red-400 border border-red-500/30 px-3 py-1.5 rounded-lg hover:bg-red-500/10 transition">
                                    <i class='bx bx-block'></i> Bannir
                                </button>
                            </td>
                        </tr>
                        <!-- User 2 (Organizer) -->
                        <tr class="border-b border-white/5 hover:bg-white/5 transition">
                            <td class="p-5 flex items-center gap-3">
                                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Org1" class="w-8 h-8 rounded-full border border-[#d4af37]">
                                <span class="font-bold">Atlas Events</span>
                            </td>
                            <td class="p-5 text-[#d4af37]">Organisateur</td>
                            <td class="p-5"><span id="status-2" class="status-badge status-active">Actif</span></td>
                            <td class="p-5 text-right">
                                <button onclick="toggleBan(2)" class="text-xs font-bold uppercase tracking-wider text-red-500 hover:text-red-400 border border-red-500/30 px-3 py-1.5 rounded-lg hover:bg-red-500/10 transition">
                                    <i class='bx bx-block'></i> Bannir
                                </button>
                            </td>
                        </tr>
                        <!-- User 3 (Banned) -->
                        <tr class="hover:bg-white/5 transition">
                            <td class="p-5 flex items-center gap-3">
                                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Spam" class="w-8 h-8 rounded-full grayscale opacity-50">
                                <span class="font-bold text-gray-500">Bot Spam</span>
                            </td>
                            <td class="p-5 text-gray-500">Utilisateur</td>
                            <td class="p-5"><span id="status-3" class="status-badge status-banned">Banni</span></td>
                            <td class="p-5 text-right">
                                <button onclick="toggleBan(3)" class="text-xs font-bold uppercase tracking-wider text-green-500 hover:text-green-400 border border-green-500/30 px-3 py-1.5 rounded-lg hover:bg-green-500/10 transition">
                                    <i class='bx bx-check-circle'></i> Activer
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- SECTION C: VALIDATION MATCHS (Accept/Reject) -->
        <div id="validations" class="section-content hidden fade-in">
            <h3 class="font-bold text-lg mb-6">Demandes en attente (3)</h3>
            
            <div class="grid gap-6">
                <!-- Request Item 1 -->
                <div id="request-1" class="glass-card p-6 rounded-2xl flex flex-col md:flex-row items-center justify-between gap-6 border-l-4 border-l-[#d4af37]">
                    <div class="flex items-center gap-6 w-full">
                        <div class="text-center min-w-[80px]">
                            <p class="text-xs font-bold text-gray-500 uppercase">Janvier</p>
                            <p class="text-2xl font-black text-white">28</p>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="bg-purple-500/20 text-purple-400 text-[9px] font-black uppercase px-2 py-0.5 rounded">Botola Pro</span>
                                <span class="text-gray-500 text-xs flex items-center gap-1"><i class='bx bxs-user'></i> Org: Atlas Events</span>
                            </div>
                            <h4 class="text-xl font-black uppercase italic">WAC <span class="text-[#d4af37]">vs</span> RAJA</h4>
                            <p class="text-sm text-gray-400">Stade Mohammed V • 20:00 GMT+1</p>
                        </div>
                    </div>
                    <div class="flex gap-3 w-full md:w-auto">
                        <button onclick="handleRequest('request-1', 'rejected')" class="flex-1 md:flex-none px-6 py-3 rounded-xl border border-red-500/30 text-red-500 font-bold uppercase text-xs hover:bg-red-500 hover:text-white transition">
                            Refuser
                        </button>
                        <button onclick="handleRequest('request-1', 'accepted')" class="flex-1 md:flex-none px-6 py-3 rounded-xl bg-[#d4af37] text-black font-bold uppercase text-xs hover:bg-white hover:shadow-[0_0_15px_#d4af37] transition">
                            Valider
                        </button>
                    </div>
                </div>

                <!-- Request Item 2 -->
                <div id="request-2" class="glass-card p-6 rounded-2xl flex flex-col md:flex-row items-center justify-between gap-6 border-l-4 border-l-[#d4af37]">
                    <div class="flex items-center gap-6 w-full">
                        <div class="text-center min-w-[80px]">
                            <p class="text-xs font-bold text-gray-500 uppercase">Février</p>
                            <p class="text-2xl font-black text-white">02</p>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="bg-blue-500/20 text-blue-400 text-[9px] font-black uppercase px-2 py-0.5 rounded">Coupe du Trône</span>
                                <span class="text-gray-500 text-xs flex items-center gap-1"><i class='bx bxs-user'></i> Org: Karim Event</span>
                            </div>
                            <h4 class="text-xl font-black uppercase italic">MAS <span class="text-[#d4af37]">vs</span> FAR</h4>
                            <p class="text-sm text-gray-400">Grand Stade de Fès • 18:00 GMT+1</p>
                        </div>
                    </div>
                    <div class="flex gap-3 w-full md:w-auto">
                        <button onclick="handleRequest('request-2', 'rejected')" class="flex-1 md:flex-none px-6 py-3 rounded-xl border border-red-500/30 text-red-500 font-bold uppercase text-xs hover:bg-red-500 hover:text-white transition">
                            Refuser
                        </button>
                        <button onclick="handleRequest('request-2', 'accepted')" class="flex-1 md:flex-none px-6 py-3 rounded-xl bg-[#d4af37] text-black font-bold uppercase text-xs hover:bg-white hover:shadow-[0_0_15px_#d4af37] transition">
                            Valider
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION D: COMMENTAIRES (Modération) -->
        <div id="comments" class="section-content hidden fade-in">
            <h3 class="font-bold text-lg mb-6">Modération des Commentaires</h3>
            
            <div class="space-y-4">
                <div id="comm-1" class="glass-card p-5 rounded-2xl border-l-4 border-red-500">
                    <div class="flex justify-between items-start">
                        <div class="flex items-center gap-3">
                            <span class="bg-red-500 text-white text-[9px] font-bold uppercase px-2 py-0.5 rounded">Signalé 5 fois</span>
                            <span class="text-gray-500 text-xs">Sur le match: WAC vs RAJA</span>
                        </div>
                        <span class="text-gray-600 text-[10px]">Il y a 20 min</span>
                    </div>
                    <p class="mt-3 text-sm text-gray-200 italic">"Site web nul, arnaque totale, ne pas acheter ici !!! [Lien Spam]"</p>
                    <div class="mt-4 flex gap-3 justify-end">
                        <button onclick="deleteComment('comm-1')" class="text-xs text-red-500 font-bold uppercase hover:underline flex items-center gap-1"><i class='bx bx-trash'></i> Supprimer</button>
                        <button onclick="ignoreComment('comm-1')" class="text-xs text-gray-500 font-bold uppercase hover:text-white flex items-center gap-1"><i class='bx bx-check'></i> Ignorer</button>
                    </div>
                </div>

                <div id="comm-2" class="glass-card p-5 rounded-2xl border-l-4 border-yellow-500">
                    <div class="flex justify-between items-start">
                        <div class="flex items-center gap-3">
                            <span class="bg-yellow-500 text-black text-[9px] font-bold uppercase px-2 py-0.5 rounded">Signalé 1 fois</span>
                            <span class="text-gray-500 text-xs">Sur le match: MAS vs FAR</span>
                        </div>
                        <span class="text-gray-600 text-[10px]">Il y a 1h</span>
                    </div>
                    <p class="mt-3 text-sm text-gray-200 italic">"Je revends mes billets VIP moins cher, contactez moi au 06..."</p>
                    <div class="mt-4 flex gap-3 justify-end">
                        <button onclick="deleteComment('comm-2')" class="text-xs text-red-500 font-bold uppercase hover:underline flex items-center gap-1"><i class='bx bx-trash'></i> Supprimer</button>
                        <button onclick="ignoreComment('comm-2')" class="text-xs text-gray-500 font-bold uppercase hover:text-white flex items-center gap-1"><i class='bx bx-check'></i> Ignorer</button>
                    </div>
                </div>
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
        }

        // Handle Match Request
        function handleRequest(id, action) {
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
        }

        // Moderate Comment
        function deleteComment(id) {
            const el = document.getElementById(id);
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 300);
        }

        function ignoreComment(id) {
            const el = document.getElementById(id);
            el.style.opacity = '0.5';
            setTimeout(() => el.remove(), 300);
        }
    </script>
</body>
</html>