<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Organisateur | BuyMatch</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        
        :root {
            --gold: #d4af37;
            --gold-glow: rgba(212, 175, 55, 0.5);
            --bg-dark: #050505;
            --glass-bg: rgba(20, 20, 20, 0.7);
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
            background-image: linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
        }

        /* Sidebar Styling */
        .sidebar-glass {
            background: rgba(10, 10, 10, 0.95);
            backdrop-filter: blur(10px);
            border-right: 1px solid var(--border-color);
        }

        .sidebar-link {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        .sidebar-link:hover, .sidebar-link.active {
            background: linear-gradient(90deg, rgba(212, 175, 55, 0.15) 0%, transparent 100%);
            color: var(--gold);
        }
        .sidebar-link.active::before {
            content: ''; position: absolute; left: 0; top: 0; height: 100%; width: 3px;
            background: var(--gold); box-shadow: 0 0 10px var(--gold);
        }

        /* Card Styling */
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease, border-color 0.3s ease;
        }
        .glass-card:hover {
            border-color: rgba(212, 175, 55, 0.3);
        }

        /* Inputs */
        .input-group { position: relative; }
        .input-icon { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #666; transition: color 0.3s; }
        .input-dark {
            background-color: #0c0c0c;
            border: 1px solid #2a2a2a;
            color: white;
            padding-left: 48px; /* Space for icon */
            transition: all 0.3s;
        }
        .input-dark:focus {
            border-color: var(--gold);
            background-color: #111;
            box-shadow: 0 0 0 1px var(--gold), 0 0 15px rgba(212, 175, 55, 0.1);
        }
        .input-dark:focus + .input-icon { color: var(--gold); }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-thumb { background: #333; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--gold); }

        /* Animation Classes */
        .fade-in { animation: fadeIn 0.5s ease-out forwards; opacity: 0; transform: translateY(10px); }
        @keyframes fadeIn { to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="flex h-screen">

    <!-- Background Pattern -->
    <div class="bg-grid"></div>

    <!-- 1. SIDEBAR -->
    <aside class="w-72 sidebar-glass flex flex-col fixed h-full z-50">
        <!-- Logo -->
        <div class="p-8 flex items-center gap-3">
            <div class="w-10 h-10 bg-gradient-to-br from-[#d4af37] to-[#f4d03f] rounded-lg flex items-center justify-center text-black shadow-[0_0_15px_rgba(212,175,55,0.4)]">
                <i class='bx bxs-zap text-2xl'></i>
            </div>
            <div>
                <h1 class="font-black text-xl italic tracking-tighter uppercase leading-none text-white">BUY<span class="text-[#d4af37]">MATCH</span></h1>
                <span class="text-[9px] uppercase tracking-[3px] text-gray-500 font-bold">Organizer Panel</span>
            </div>
        </div>

        <!-- Bouton Retour Accueil (Nouveau) -->
        <div class="px-6 mb-6">
            <a href="/" class="group flex items-center justify-center gap-2 w-full py-3 rounded-xl bg-white/5 border border-white/5 text-gray-300 font-bold uppercase text-[10px] tracking-widest hover:bg-[#d4af37] hover:text-black hover:border-[#d4af37] hover:shadow-[0_0_20px_rgba(212,175,55,0.4)] transition-all duration-300">
                <i class='bx bx-left-arrow-alt text-lg group-hover:-translate-x-1 transition-transform'></i>
                Retour à l'accueil
            </a>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
            <p class="px-4 text-[10px] font-black text-gray-600 uppercase tracking-widest mb-2 mt-2">Menu Principal</p>
            
            <button onclick="showSection('profil')" class="sidebar-link active w-full flex items-center gap-4 px-4 py-3.5 text-sm font-bold text-gray-400 rounded-xl">
                <i class='bx bx-user-circle'></i> Mon Profil
            </button>
            <button onclick="showSection('organiser')" class="sidebar-link w-full flex items-center gap-4 px-4 py-3.5 text-sm font-bold text-gray-400 rounded-xl">
                <i class='bx bx-plus-circle'></i> Créer un Match
            </button>
            <button onclick="showSection('historique')" class="sidebar-link w-full flex items-center gap-4 px-4 py-3.5 text-sm font-bold text-gray-400 rounded-xl">
                <i class='bx bx-history'></i> Mes Événements
            </button>
            
            <p class="px-4 text-[10px] font-black text-gray-600 uppercase tracking-widest mb-2 mt-6">Gestion</p>
            
            <button onclick="showSection('commentaires')" class="sidebar-link w-full flex items-center gap-4 px-4 py-3.5 text-sm font-bold text-gray-400 rounded-xl">
                <i class='bx bx-message-square-dots'></i> Modération <span class="ml-auto bg-red-500/20 text-red-500 text-[9px] px-2 py-0.5 rounded-full">3</span>
            </button>
            <button onclick="showSection('parametres')" class="sidebar-link w-full flex items-center gap-4 px-4 py-3.5 text-sm font-bold text-gray-400 rounded-xl">
                <i class='bx bx-cog'></i> Paramètres
            </button>
        </nav>

        <!-- Logout -->
        <div class="p-6 border-t border-white/5 bg-black/20">
            <button class="flex items-center gap-3 w-full text-left group">
                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Organizer1" class="w-9 h-9 rounded-full border border-gray-600 group-hover:border-[#d4af37] transition-colors">
                <div class="flex-1">
                    <p class="text-xs font-bold text-white group-hover:text-[#d4af37] transition-colors">Déconnexion</p>
                    <p class="text-[9px] text-gray-500">Fermer la session</p>
                </div>
                <i class='bx bx-log-out text-gray-500 group-hover:text-red-500 transition-colors'></i>
            </button>
        </div>
    </aside>

    <!-- 2. MAIN CONTENT -->
    <main class="flex-1 ml-72 p-10 overflow-y-auto">
        
        <!-- Top Bar -->
        <header class="flex justify-between items-end mb-12 fade-in" style="animation-delay: 0.1s">
            <div>
                <p class="text-[#d4af37] text-xs font-black uppercase tracking-[3px] mb-1">Espace Organisateur</p>
                <h2 id="page-title" class="text-4xl font-black uppercase italic text-white leading-tight">Mon <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#d4af37] to-[#f4d03f]">Profil</span></h2>
            </div>
            <div class="flex items-center gap-4">
                <div class="glass-card px-4 py-2 rounded-full flex items-center gap-2 text-xs font-bold text-green-400">
                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span> Compte Vérifié
                </div>
            </div>
        </header>

        <!-- SECTIONS -->
        
        <!-- A. SECTION PROFIL -->
        <div id="profil" class="fade-in section-content" style="animation-delay: 0.2s">
            <div class="glass-card rounded-3xl p-8 relative overflow-hidden">
                <!-- Decorative BG -->
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-[#d4af37] opacity-10 blur-[80px] rounded-full pointer-events-none"></div>

                <div class="flex flex-col lg:flex-row items-center gap-10">
                    <!-- Photo -->
                    <div class="relative group">
                        <div class="absolute -inset-1 bg-gradient-to-br from-[#d4af37] to-[#f4d03f] rounded-full opacity-70 blur group-hover:opacity-100 transition duration-500"></div>
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Organizer1" class="relative w-40 h-40 rounded-full border-4 border-[#151515] bg-[#151515] object-cover">
                        <button class="absolute bottom-2 right-2 bg-[#d4af37] text-black w-10 h-10 rounded-full flex items-center justify-center hover:scale-110 transition shadow-lg z-10">
                            <i class='bx bx-camera text-xl'></i>
                        </button>
                    </div>

                    <!-- Infos & Stats -->
                    <div class="flex-1 w-full">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
                            <div>
                                <h3 class="text-3xl font-bold text-white mb-1">Atlas Events Pro</h3>
                                <p class="text-gray-400 text-sm flex items-center gap-2">
                                    <i class='bx bx-id-card text-[#d4af37]'></i> ID: ORG-8821
                                    <span class="text-gray-600">•</span>
                                    <i class='bx bx-map text-[#d4af37]'></i> Casablanca, Maroc
                                </p>
                            </div>
                            <button onclick="saveData()" class="px-6 py-3 bg-[#d4af37] text-black text-xs font-black uppercase tracking-widest rounded-xl hover:bg-[#fff] hover:shadow-[0_0_20px_rgba(212,175,55,0.4)] transition-all">
                                Sauvegarder
                            </button>
                        </div>

                        <!-- Stats Grid -->
                        <div class="grid grid-cols-3 gap-4 mb-8">
                            <div class="bg-black/30 border border-white/5 p-4 rounded-2xl text-center">
                                <i class='bx bx-calendar-check text-[#d4af37] text-2xl mb-2'></i>
                                <span class="block text-2xl font-black text-white">15</span>
                                <span class="text-[9px] text-gray-500 uppercase tracking-widest">Matchs</span>
                            </div>
                            <div class="bg-black/30 border border-white/5 p-4 rounded-2xl text-center">
                                <i class='bx bx-group text-blue-400 text-2xl mb-2'></i>
                                <span class="block text-2xl font-black text-white">12k</span>
                                <span class="text-[9px] text-gray-500 uppercase tracking-widest">Tickets</span>
                            </div>
                            <div class="bg-black/30 border border-white/5 p-4 rounded-2xl text-center">
                                <i class='bx bxs-star text-yellow-400 text-2xl mb-2'></i>
                                <span class="block text-2xl font-black text-white">4.9</span>
                                <span class="text-[9px] text-gray-500 uppercase tracking-widest">Note</span>
                            </div>
                        </div>

                        <!-- Form Inputs -->
                        <div class="grid md:grid-cols-2 gap-5">
                            <div class="input-group">
                                <input type="email" value="contact@atlasevents.ma" class="input-dark w-full p-3.5 rounded-xl text-sm font-medium">
                                <i class='bx bx-envelope input-icon'></i>
                            </div>
                            <div class="input-group">
                                <input type="tel" value="+212 6 61 12 34 56" class="input-dark w-full p-3.5 rounded-xl text-sm font-medium">
                                <i class='bx bx-phone input-icon'></i>
                            </div>
                            <div class="input-group md:col-span-2">
                                <input type="url" value="https://www.atlasevents.ma" class="input-dark w-full p-3.5 rounded-xl text-sm font-medium">
                                <i class='bx bx-globe input-icon'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- B. SECTION ORGANISER (Créer Match) -->
        <div id="organiser" class="hidden fade-in section-content" style="animation-delay: 0.2s">
            <div class="glass-card rounded-3xl p-8">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-12 h-12 rounded-full bg-[#d4af37]/10 flex items-center justify-center text-[#d4af37]">
                        <i class='bx bx-list-plus text-2xl'></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold">Nouvelle Demande</h3>
                        <p class="text-gray-500 text-xs">Soumettre un match à la validation</p>
                    </div>
                </div>

                <form onsubmit="submitMatch(event)" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="input-group">
                            <label class="text-[10px] font-bold uppercase text-gray-500 tracking-wider mb-2 block ml-1">Équipe Domicile</label>
                            <div class="relative">
                                <input type="text" placeholder="Ex: WAC" class="input-dark w-full p-3.5 rounded-xl text-sm">
                                <i class='bx bx-shield-alt-2 input-icon'></i>
                            </div>
                        </div>
                        <div class="input-group">
                            <label class="text-[10px] font-bold uppercase text-gray-500 tracking-wider mb-2 block ml-1">Équipe Extérieur</label>
                            <div class="relative">
                                <input type="text" placeholder="Ex: Raja" class="input-dark w-full p-3.5 rounded-xl text-sm">
                                <i class='bx bx-shield-alt-2 input-icon'></i>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="input-group">
                            <label class="text-[10px] font-bold uppercase text-gray-500 tracking-wider mb-2 block ml-1">Date</label>
                            <div class="relative">
                                <input type="date" class="input-dark w-full p-3.5 rounded-xl text-sm">
                                <i class='bx bx-calendar input-icon'></i>
                            </div>
                        </div>
                        <div class="input-group">
                            <label class="text-[10px] font-bold uppercase text-gray-500 tracking-wider mb-2 block ml-1">Heure</label>
                            <div class="relative">
                                <input type="time" class="input-dark w-full p-3.5 rounded-xl text-sm">
                                <i class='bx bx-time input-icon'></i>
                            </div>
                        </div>
                        <div class="input-group">
                            <label class="text-[10px] font-bold uppercase text-gray-500 tracking-wider mb-2 block ml-1">Stade</label>
                            <div class="relative">
                                <select class="input-dark w-full p-3.5 rounded-xl text-sm appearance-none">
                                    <option>Stade Mohammed V</option>
                                    <option>Grand Stade de Marrakech</option>
                                </select>
                                <i class='bx bx-map-pin input-icon'></i>
                                <i class='bx bx-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-500'></i>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-white/5 pt-6 flex justify-end">
                        <button type="submit" class="bg-gradient-to-r from-[#d4af37] to-[#f4d03f] text-black font-bold uppercase text-xs tracking-widest px-8 py-4 rounded-xl hover:shadow-[0_0_20px_rgba(212,175,55,0.4)] hover:-translate-y-1 transition-all flex items-center gap-2">
                            <span>Soumettre la demande</span>
                            <i class='bx bx-right-arrow-alt text-lg'></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- C. SECTION HISTORIQUE -->
        <div id="historique" class="hidden fade-in section-content" style="animation-delay: 0.2s">
            <div class="glass-card rounded-3xl overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-black/40 text-[10px] uppercase text-gray-400 border-b border-white/5">
                            <th class="p-5 font-black tracking-widest">Match</th>
                            <th class="p-5 font-black tracking-widest">Date & Lieu</th>
                            <th class="p-5 font-black tracking-widest">Tickets Vendus</th>
                            <th class="p-5 font-black tracking-widest">Statut</th>
                            <th class="p-5 text-right font-black tracking-widest">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                            <td class="p-5">
                                <div class="flex items-center gap-3">
                                    <div class="flex -space-x-2">
                                        <div class="w-8 h-8 rounded-full bg-red-600 border border-black flex items-center justify-center text-[8px] font-bold">WAC</div>
                                        <div class="w-8 h-8 rounded-full bg-green-600 border border-black flex items-center justify-center text-[8px] font-bold">RCA</div>
                                    </div>
                                    <span class="font-bold">Derby Casablanca</span>
                                </div>
                            </td>
                            <td class="p-5 text-gray-400">
                                <div class="font-bold text-white">12 Jan 2026</div>
                                <div class="text-xs">Mohammed V</div>
                            </td>
                            <td class="p-5">
                                <div class="w-full bg-gray-800 rounded-full h-1.5 mb-1 max-w-[100px]">
                                    <div class="bg-[#d4af37] h-1.5 rounded-full" style="width: 85%"></div>
                                </div>
                                <span class="text-xs text-[#d4af37]">85% Sold</span>
                            </td>
                            <td class="p-5">
                                <span class="bg-green-500/10 text-green-400 border border-green-500/20 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Validé</span>
                            </td>
                            <td class="p-5 text-right">
                                <button class="w-8 h-8 rounded-lg bg-white/5 hover:bg-[#d4af37] hover:text-black transition-all flex items-center justify-center ml-auto">
                                    <i class='bx bx-dots-vertical-rounded'></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- D. SECTION COMMENTAIRES -->
        <div id="commentaires" class="hidden fade-in section-content" style="animation-delay: 0.2s">
            <div class="grid lg:grid-cols-3 gap-6">
                <!-- Sidebar selection -->
                <div class="glass-card rounded-2xl p-4 h-fit">
                    <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-4">Filtrer par Match</p>
                    <button class="w-full text-left p-4 rounded-xl bg-[#d4af37] text-black font-bold text-xs shadow-lg mb-2 flex justify-between items-center">
                        <span>WAC vs RAJA</span>
                        <span class="bg-black/20 px-2 py-0.5 rounded-md text-[10px]">12</span>
                    </button>
                    <button class="w-full text-left p-4 rounded-xl bg-white/5 hover:bg-white/10 text-gray-400 text-xs transition flex justify-between items-center">
                        <span>MAS vs FAR</span>
                        <span class="bg-white/10 px-2 py-0.5 rounded-md text-[10px]">3</span>
                    </button>
                </div>

                <!-- Chat Area -->
                <div class="lg:col-span-2 glass-card rounded-2xl p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold">Derniers Commentaires</h3>
                        <button class="text-xs text-red-400 hover:text-red-300 font-bold uppercase tracking-widest flex items-center gap-1">
                            <i class='bx bx-trash'></i> Tout supprimer
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div id="comment-1" class="group flex gap-4 p-4 rounded-xl bg-black/40 border border-white/5 hover:border-[#d4af37]/30 transition-all">
                            <img src="https://i.pravatar.cc/100?img=3" class="w-10 h-10 rounded-full border border-gray-700">
                            <div class="flex-1">
                                <div class="flex justify-between items-start mb-1">
                                    <h5 class="text-sm font-bold text-white">Ahmed Tazi</h5>
                                    <span class="text-[10px] text-gray-500">2h</span>
                                </div>
                                <p class="text-xs text-gray-400">Organisation au top ! Bravo pour la gestion des entrées.</p>
                            </div>
                            <button onclick="deleteComment('comment-1')" class="opacity-0 group-hover:opacity-100 text-gray-500 hover:text-red-500 transition-all p-2 bg-white/5 rounded-lg">
                                <i class='bx bx-trash'></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- E. SECTION PARAMETRES -->
        <div id="parametres" class="hidden fade-in section-content" style="animation-delay: 0.2s">
            <div class="max-w-2xl glass-card rounded-3xl p-8">
                <h3 class="text-xl font-bold mb-8">Sécurité & Compte</h3>
                
                <div class="space-y-6">
                    <div class="input-group">
                        <label class="text-[10px] font-bold uppercase text-gray-500 tracking-wider mb-2 block ml-1">Mot de passe actuel</label>
                        <div class="relative">
                            <input type="password" class="input-dark w-full p-3.5 rounded-xl text-sm">
                            <i class='bx bx-lock-alt input-icon'></i>
                        </div>
                    </div>
                    
                    <div class="pt-6 border-t border-white/5">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="font-bold text-sm">Alertes Critiques</p>
                                <p class="text-[10px] text-gray-500">Recevoir un SMS en cas de problème urgent</p>
                            </div>
                            <div class="w-12 h-6 bg-[#d4af37] rounded-full relative cursor-pointer">
                                <div class="absolute right-1 top-1 w-4 h-4 bg-black rounded-full"></div>
                            </div>
                        </div>
                    </div>

                    <button class="w-full bg-white text-black font-bold uppercase text-xs tracking-widest px-6 py-4 rounded-xl hover:bg-[#d4af37] transition-colors mt-4">
                        Mettre à jour le profil
                    </button>
                </div>
            </div>
        </div>

    </main>

    <!-- JS Logic -->
    <script>
        function showSection(sectionId) {
            document.querySelectorAll('.section-content').forEach(el => el.classList.add('hidden'));
            document.getElementById(sectionId).classList.remove('hidden');
            
            document.querySelectorAll('.sidebar-link').forEach(el => el.classList.remove('active'));
            // Find button that calls this function and add active class (Simplified)
            event.currentTarget.classList.add('active');

            const titles = {
                'profil': 'Mon <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#d4af37] to-[#f4d03f]">Profil</span>',
                'organiser': 'Créer <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#d4af37] to-[#f4d03f]">Match</span>',
                'historique': 'Mes <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#d4af37] to-[#f4d03f]">Events</span>',
                'commentaires': 'Modération <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#d4af37] to-[#f4d03f]">Chat</span>',
                'parametres': 'Mes <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#d4af37] to-[#f4d03f]">Paramètres</span>'
            };
            document.getElementById('page-title').innerHTML = titles[sectionId];
        }

        function deleteComment(id) {
            const el = document.getElementById(id);
            el.style.transform = 'translateX(20px)';
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 300);
        }

        function saveData() {
            // Simulation
            const btn = event.target;
            const original = btn.innerText;
            btn.innerText = "Enregistré !";
            btn.classList.add('bg-green-500', 'text-white');
            setTimeout(() => {
                btn.innerText = original;
                btn.classList.remove('bg-green-500', 'text-white');
            }, 2000);
        }
        
        function submitMatch(e) {
            e.preventDefault();
            alert("Match soumis à validation !");
        }
    </script>
</body>
</html>