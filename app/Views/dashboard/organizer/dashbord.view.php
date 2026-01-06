<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Organisateur | BuyMatch Élite</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        
        :root {
            --gold: #d4af37;
            --bg-dark: #050505;
            --glass-bg: rgba(20, 20, 20, 0.7);
            --border-color: rgba(255, 255, 255, 0.08);
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--bg-dark); 
            color: white; 
            overflow: hidden;
        }

        .bg-grid {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1;
            background-image: linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        .sidebar-glass {
            background: rgba(10, 10, 10, 0.95);
            backdrop-filter: blur(10px);
            border-right: 1px solid var(--border-color);
        }

        .sidebar-link { transition: all 0.3s ease; position: relative; }
        .sidebar-link:hover, .sidebar-link.active {
            background: linear-gradient(90deg, rgba(212, 175, 55, 0.1) 0%, transparent 100%);
            color: var(--gold);
        }
        .sidebar-link.active::before {
            content: ''; position: absolute; left: 0; top: 20%; height: 60%; width: 3px;
            background: var(--gold); box-shadow: 0 0 10px var(--gold);
        }

        .glass-card { background: var(--glass-bg); backdrop-filter: blur(12px); border: 1px solid var(--border-color); }

        .input-dark {
            background-color: #0c0c0c; border: 1px solid #2a2a2a; color: white;
            padding-left: 48px; transition: all 0.3s;
        }
        .input-dark:focus { border-color: var(--gold); background-color: #111; outline: none; }
        .input-icon { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #666; transition: color 0.3s; }
        .input-group:focus-within .input-icon { color: var(--gold); }

        .fade-in { animation: fadeIn 0.4s ease-out forwards; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        #status-alert {
            display: none;
            animation: slideDown 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        @keyframes slideDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }

        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-thumb { background: #222; border-radius: 10px; }
    </style>
</head>
<body class="flex h-screen">

    <div class="bg-grid"></div>

    <aside class="w-72 sidebar-glass flex flex-col fixed h-full z-50">
        <div class="p-8 flex items-center gap-3">
            <div class="w-10 h-10 bg-gradient-to-br from-[#d4af37] to-[#f4d03f] rounded-lg flex items-center justify-center text-black shadow-lg">
                <i class='bx bxs-zap text-2xl'></i>
            </div>
            <div>
                <h1 class="font-black text-xl italic tracking-tighter uppercase leading-none text-white">BUY<span class="text-[#d4af37]">MATCH</span></h1>
                <span class="text-[9px] uppercase tracking-[3px] text-gray-500 font-bold">Organizer Panel</span>
            </div>
        </div>

        <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
            <p class="px-4 text-[10px] font-black text-gray-600 uppercase tracking-widest mb-2">Compte</p>
            <button onclick="showSection('profil')" class="nav-btn sidebar-link active w-full flex items-center gap-4 px-4 py-3.5 text-sm font-bold text-gray-400 rounded-xl">
                <i class='bx bx-user-circle text-xl'></i> Mon Profil
            </button>
            <button onclick="showSection('organiser')" class="nav-btn sidebar-link w-full flex items-center gap-4 px-4 py-3.5 text-sm font-bold text-gray-400 rounded-xl">
                <i class='bx bx-plus-circle text-xl'></i> Créer un Match
            </button>
            <button onclick="showSection('historique')" class="nav-btn sidebar-link w-full flex items-center gap-4 px-4 py-3.5 text-sm font-bold text-gray-400 rounded-xl">
                <i class='bx bx-calendar-event text-xl'></i> Mes Événements
            </button>
            <p class="px-4 text-[10px] font-black text-gray-600 uppercase tracking-widest mb-2 mt-6">Social</p>
            <button onclick="showSection('commentaires')" class="nav-btn sidebar-link w-full flex items-center gap-4 px-4 py-3.5 text-sm font-bold text-gray-400 rounded-xl">
                <i class='bx bx-message-square-dots text-xl'></i> Modération <span class="ml-auto bg-red-500/20 text-red-500 text-[9px] px-2 py-0.5 rounded-full"><?= count($comments) ?></span>
            </button>
        </nav>

        <div class="p-6 border-t border-white/5 bg-black/20">
            <div class="flex items-center gap-3">
                <?php   
                    $photoPath = isset($organisateur) ? '../../public/uploads/' . $organisateur->getPhoto() : 'https://api.dicebear.com/7.x/avataaars/svg?seed=Organizer1';
                ?>
                <img id="side-avatar" src="<?php echo htmlspecialchars($photoPath); ?>" class="w-9 h-9 rounded-full border border-gray-700 object-cover">
                <div class="flex-1"><p class="text-xs font-bold text-white"><?= htmlspecialchars($organisateur->getName()) ?></p></div>
                <a href="?action=logout" class="text-gray-500 hover:text-red-500 transition-colors"><i class='bx bx-log-out text-xl'></i></a>
            </div>
        </div>
    </aside>

    <main class="flex-1 ml-72 p-10 overflow-y-auto">
        
        <header class="flex justify-between items-end mb-8 fade-in">
            <div>
                <p class="text-[#d4af37] text-xs font-black uppercase tracking-[3px] mb-1">Espace Certifié</p>
                <h2 id="page-title" class="text-4xl font-black uppercase italic text-white leading-tight">Mon <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#d4af37] to-[#f4d03f]">Profil</span></h2>
            </div>
        </header>

        <div id="status-alert" class="mb-8 rounded-2xl p-4 flex items-center gap-4 border backdrop-blur-md">
            <div id="alert-icon-box" class="w-10 h-10 rounded-xl flex items-center justify-center text-xl">
                <i id="alert-icon" class='bx'></i>
            </div>
            <div class="flex-1 text-xs font-black uppercase tracking-widest" id="alert-message"></div>
            <button onclick="this.parentElement.style.display='none'" class="text-white/20 hover:text-white"><i class='bx bx-x text-2xl'></i></button>
        </div>

        <div id="profil" class="section-content fade-in">
            <div class="grid lg:grid-cols-3 gap-8">
                <div class="lg:col-span-1">
                    <div class="glass-card rounded-[32px] p-8 text-center relative overflow-hidden">
                        <div class="relative inline-block group mb-6">
                            <img id="profile-preview-db" src="<?php echo htmlspecialchars($photoPath); ?>" class="relative w-32 h-32 rounded-full border-4 border-[#151515] bg-[#151515] object-cover">
                            <label class="absolute bottom-1 right-1 bg-[#d4af37] text-black w-9 h-9 rounded-full flex items-center justify-center cursor-pointer shadow-lg hover:scale-110 transition">
                                <i class='bx bx-camera text-lg'></i>
                                <input type="file" id="profile-upload" class="hidden" accept="image/*" onchange="previewProfileImage(event)">
                            </label>
                        </div>
                        <h3 class="text-xl font-bold">Atlas Events Pro</h3>
                        <p class="text-[10px] font-black text-[#d4af37] uppercase tracking-[3px]">Organisateur Certifié</p>
                    </div>
                </div>

                <div class="lg:col-span-2 space-y-6">
                    <div class="glass-card rounded-[32px] p-8">
                        <form onsubmit="handleUpdate(event)" class="space-y-6">
                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="input-group relative">
                                    <label class="text-[9px] font-bold uppercase text-gray-500 mb-2 block">Nom Complet</label>
                                    <input type="text" id="name" value="<?php echo isset($organisateur) ? htmlspecialchars($organisateur->getName()) : 'Nom par défaut'; ?>" class="input-dark w-full p-4 rounded-xl text-sm font-bold">
                                    <i class='bx bx-buildings input-icon'></i>
                                </div>
                                <div class="input-group relative">
                                    <label class="text-[9px] font-bold uppercase text-gray-500 mb-2 block">Email Pro</label>
                                    <input type="email" id="email" value="<?php echo isset($organisateur) ? htmlspecialchars($organisateur->getEmail()) : 'email@defaut.com'; ?>" class="input-dark w-full p-4 rounded-xl text-sm font-bold">
                                    <i class='bx bx-envelope input-icon'></i>
                                </div>
                                <div class="input-group relative md:col-span-2">
                                    <label class="text-[9px] font-bold uppercase text-gray-500 mb-2 block">Nouveau mot de passe</label>
                                    <input type="password" id="password" placeholder="••••••••" class="input-dark w-full p-4 rounded-xl text-sm">
                                    <i class='bx bx-lock-alt input-icon'></i>
                                </div>
                            </div>
                            <button type="submit" id="submit-btn" class="bg-[#d4af37] text-black font-black uppercase text-[10px] tracking-widest px-8 py-4 rounded-xl hover:bg-white transition-all shadow-lg">Enregistrer</button>
                        </form>
                    </div>

                    <div class="glass-card rounded-[32px] p-8 border-red-500/20 bg-red-500/5 flex flex-col md:flex-row items-center justify-between gap-4">
                        <div>
                            <h4 class="text-xs font-black uppercase tracking-widest text-red-500 mb-1">Zone Critique</h4>
                            <p class="text-[10px] text-gray-500 font-bold uppercase">Suppression irréversible du compte</p>
                        </div>
                        <button onclick="confirmDelete()" class="px-6 py-3 border border-red-500/30 text-red-500 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-red-500 hover:text-white transition-all">
                            Désactiver mon compte
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div id="organiser" class="section-content hidden fade-in">
            <div class="grid xl:grid-cols-2 gap-8">
                
                <div class="glass-card rounded-[32px] p-8">
                    <h3 class="text-xl font-black italic uppercase mb-6 flex items-center gap-2">
                        <i class='bx bx-edit text-[#d4af37]'></i> Configuration du Match
                    </h3>
                    
                    <form class="space-y-6" onsubmit="handleAddEvent(event)" enctype="multipart/form-data">
                        <div class="grid md:grid-cols-2 gap-5">
                            <div class="relative input-group">
                                <label class="text-[9px] font-black uppercase text-[#d4af37] tracking-widest mb-2 block">Titre de l'événement</label>
                                <input type="text" id="input-titre" name="titre" placeholder="ex: Derby Casablanca" class="input-dark w-full p-3 rounded-xl text-sm font-bold" oninput="updatePreviewText('input-titre', 'preview-titre', 'TITRE DU MATCH')">
                                <i class='bx bx-tag input-icon'></i>
                            </div>
                            <div class="relative input-group">
                                <label class="text-[9px] font-black uppercase text-[#d4af37] tracking-widest mb-2 block">Date & Heure</label>
                                <input type="datetime-local" id="input-date" name="date_event" class="input-dark w-full p-3 rounded-xl text-sm text-gray-400" oninput="updatePreviewText('input-date', 'preview-date', 'JJ/MM/AAAA --:--')">
                            </div>
                        </div>

                        <div class="border-t border-white/5 my-4"></div>

                        <div class="space-y-3">
                            <label class="text-[9px] font-black uppercase text-gray-500 tracking-widest block">Équipe Domicile (1)</label>
                            <div class="flex gap-3">
                                <div class="relative flex-1 input-group">
                                    <input type="text" id="input-team1" name="equipe1_nom" placeholder="Nom Équipe 1"  class="input-dark w-full p-3 rounded-xl text-sm font-bold" oninput="updatePreviewText('input-team1', 'preview-team1', 'ÉQUIPE 1')">
                                    <i class='bx bx-shield input-icon'></i>
                                </div>
                                <label class="w-12 h-12 bg-[#151515] border border-white/10 rounded-xl flex items-center justify-center cursor-pointer hover:border-[#d4af37] transition text-gray-400 hover:text-[#d4af37]">
                                    <i class='bx bx-upload text-xl'></i>
                                    <input type="file" id="input-logo1" name="equipe1_logo" class="hidden" accept="image/*" onchange="updatePreviewImage('input-logo1', 'preview-logo1')">
                                </label>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <label class="text-[9px] font-black uppercase text-gray-500 tracking-widest block">Équipe Extérieur (2)</label>
                            <div class="flex gap-3">
                                <div class="relative flex-1 input-group">
                                    <input type="text" id="input-team2" name="equipe2_nom" placeholder="Nom Équipe 2" class="input-dark w-full p-3 rounded-xl text-sm font-bold" oninput="updatePreviewText('input-team2', 'preview-team2', 'ÉQUIPE 2')">
                                    <i class='bx bx-shield-alt-2 input-icon'></i>
                                </div>
                                <label class="w-12 h-12 bg-[#151515] border border-white/10 rounded-xl flex items-center justify-center cursor-pointer hover:border-[#d4af37] transition text-gray-400 hover:text-[#d4af37]">
                                    <i class='bx bx-upload text-xl'></i>
                                    <input type="file" id="input-logo2" name="equipe2_logo" class="hidden" accept="image/*" onchange="updatePreviewImage('input-logo2', 'preview-logo2')">
                                </label>
                            </div>
                        </div>

                        <div class="border-t border-white/5 my-4"></div>

                        <div class="grid md:grid-cols-2 gap-5">
                            <div class="relative input-group">
                                <label class="text-[9px] font-black uppercase text-[#d4af37] tracking-widest mb-2 block">Stade / Lieu</label>
                                <input type="text" id="input-lieu" placeholder="ex: Stade Med V" name="lieu" class="input-dark w-full p-3 rounded-xl text-sm font-bold" oninput="updatePreviewText('input-lieu', 'preview-lieu', 'Lieu du match')">
                                <i class='bx bx-map-pin input-icon'></i>
                            </div>
                            <div class="relative">
                                <label class="text-[9px] font-black uppercase text-[#d4af37] tracking-widest mb-2 block">Miniature (Cover)</label>
                                <label class="flex items-center gap-3 w-full p-3 rounded-xl bg-[#0c0c0c] border border-[#2a2a2a] cursor-pointer hover:border-[#d4af37] transition group">
                                    <div class="w-8 h-8 bg-[#151515] rounded-lg flex items-center justify-center text-gray-500 group-hover:text-[#d4af37]"><i class='bx bx-image'></i></div>
                                    <span class="text-xs font-bold text-gray-400">Choisir une image...</span>
                                    <input type="file" id="input-miniature" name="mignature" class="hidden" accept="image/*" onchange="updatePreviewImage('input-miniature', 'preview-miniature')">
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-[#d4af37] to-[#f4d03f] text-black font-black uppercase text-[11px] py-4 rounded-xl shadow-[0_0_20px_rgba(212,175,55,0.3)] hover:shadow-[0_0_30px_rgba(212,175,55,0.5)] hover:scale-[1.02] transition-all transform mt-4">
                            Publier le Match
                        </button>
                    </form>
                </div>

                <div class="relative">
                    <div class="sticky top-10">
                        <div class="flex items-center justify-between mb-4 px-2">
                            <span class="text-[10px] font-black uppercase tracking-[3px] text-gray-500 animate-pulse">Live Preview</span>
                            <div class="flex gap-1">
                                <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                                <span class="w-2 h-2 rounded-full bg-green-500"></span>
                            </div>
                        </div>

                        <div class="group relative w-full aspect-[4/5] md:aspect-[16/9] xl:aspect-[3/4] rounded-[32px] overflow-hidden border border-white/10 shadow-2xl bg-[#050505]">
                            
                            <img id="preview-miniature" src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=2693&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-105 transition-transform duration-700">
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>
                            
                            <div class="absolute inset-0 p-6 flex flex-col justify-between">
                                
                                <div class="flex justify-between items-start">
                                    <div class="bg-black/60 backdrop-blur-md border border-white/10 px-4 py-2 rounded-full flex items-center gap-2">
                                        <i class='bx bx-calendar text-[#d4af37]'></i>
                                        <span id="preview-date" class="text-[10px] font-black uppercase text-white tracking-wider">JJ/MM/AAAA --:--</span>
                                    </div>
                                    <div class="bg-[#d4af37] text-black text-[10px] font-black uppercase px-3 py-1 rounded-md">
                                        Prochainement
                                    </div>
                                </div>

                                <div class="flex flex-col items-center gap-4">
                                    <div class="flex items-center justify-center gap-6 w-full">
                                        <div class="flex flex-col items-center gap-2 flex-1">
                                            <div class="w-16 h-16 md:w-20 md:h-20 rounded-full bg-white/5 border border-white/10 backdrop-blur-sm p-3 flex items-center justify-center shadow-[0_0_15px_rgba(0,0,0,0.5)]">
                                                <img id="preview-logo1" src="https://cdn-icons-png.flaticon.com/512/10542/10542549.png" class="w-full h-full object-contain drop-shadow-lg">
                                            </div>
                                            <span id="preview-team1" class="text-xs md:text-sm font-black uppercase text-center leading-tight drop-shadow-md">Équipe 1</span>
                                        </div>

                                        <div class="relative">
                                            <div class="absolute -inset-2 bg-[#d4af37] rounded-full blur opacity-20 animate-pulse"></div>
                                            <span class="relative z-10 text-2xl md:text-4xl font-black italic text-[#d4af37] drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]">VS</span>
                                        </div>

                                        <div class="flex flex-col items-center gap-2 flex-1">
                                            <div class="w-16 h-16 md:w-20 md:h-20 rounded-full bg-white/5 border border-white/10 backdrop-blur-sm p-3 flex items-center justify-center shadow-[0_0_15px_rgba(0,0,0,0.5)]">
                                                <img id="preview-logo2" src="https://cdn-icons-png.flaticon.com/512/10542/10542549.png" class="w-full h-full object-contain drop-shadow-lg">
                                            </div>
                                            <span id="preview-team2" class="text-xs md:text-sm font-black uppercase text-center leading-tight drop-shadow-md">Équipe 2</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-1">
                                    <h2 id="preview-titre" class="text-2xl md:text-3xl font-black uppercase italic text-white leading-none drop-shadow-lg truncate">TITRE DU MATCH</h2>
                                    <div class="flex items-center gap-2 text-gray-300">
                                        <i class='bx bx-map-pin text-[#d4af37]'></i>
                                        <span id="preview-lieu" class="text-xs font-bold uppercase tracking-wider">Lieu du match</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6 p-4 rounded-xl border border-white/5 bg-white/5 backdrop-blur-sm flex items-center gap-3">
                            <i class='bx bx-info-circle text-2xl text-[#d4af37]'></i>
                            <p class="text-[10px] text-gray-400 leading-relaxed">
                                C'est un aperçu en temps réel. Assurez-vous que les images sont de haute qualité (PNG transparent pour les logos) pour un rendu optimal sur l'application utilisateur.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div id="historique" class="section-content hidden fade-in">
            <div class="glass-card rounded-[32px] overflow-hidden">
                <div class="p-8 border-b border-white/5 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-white">Historique des Matchs</h3>
                    <div class="flex gap-2">
                        <button class="w-8 h-8 rounded-lg bg-white/5 hover:bg-[#d4af37] hover:text-black flex items-center justify-center transition"><i class='bx bx-filter'></i></button>
                        <button class="w-8 h-8 rounded-lg bg-white/5 hover:bg-[#d4af37] hover:text-black flex items-center justify-center transition"><i class='bx bx-download'></i></button>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-black/40 text-[9px] uppercase text-gray-500 tracking-widest border-b border-white/5">
                            <tr>
                                <th class="p-6">Événement</th>
                                <th class="p-6">Lieu & Date</th>
                                <th class="p-6">Tickets</th>
                                <th class="p-6">Statut</th>
                            </tr>
                        </thead>
                        <tbody class="text-xs font-bold divide-y divide-white/5">
                            <?php
                                $events = isset($organisateur) ? (new EventServices())->getEventsByOrganisateur($organisateur->getId()) : [];
                                
                                if (empty($events)) {
                                    echo '<tr><td colspan="5" class="p-6 text-center text-gray-500">Aucun événement trouvé.</td></tr>';
                                } else {
                                    foreach ($events as $event) {

                                        $equipeNom1 = $event['equipe1']->getNom();
                                        $equipeNom2 = $event['equipe2']->getNom();
                                        $pathLogo1 = '../../public/uploads_logo_equipe/' . $event['equipe1']->getLogo();
                                        $pathLogo2 = '../../public/uploads_logo_equipe/' . $event['equipe2']->getLogo();
                                        $dateEvent = date('d M Y', strtotime($event['event']->getDateEvent()));
                                        $timeEvent = date('H:i', strtotime($event['event']->getDateEvent()));
                                        $lieuEvent = $event['event']->getLieu();
                                        $statusEvent = $event['event']->getStatus();

                                ?>
                            <tr class="group hover:bg-white/[0.02] transition-colors">
                                <td class="p-6">
                                    <div class="flex items-center gap-4">
                                        <div class="flex flex-col items-center gap-1 w-12">
                                            <img src="<?= $pathLogo1 ?>" class="w-8 h-8 object-contain drop-shadow-lg" alt="WAC">
                                            <span class="text-[9px] text-gray-400"><?= $equipeNom1 ?></span>
                                        </div>
                                        
                                        <div class="text-[#d4af37] font-black italic text-lg">VS</div>
                                        
                                        <div class="flex flex-col items-center gap-1 w-12">
                                            <img src="<?= $pathLogo2 ?>" class="w-8 h-8 object-contain drop-shadow-lg" alt="RCA">
                                            <span class="text-[9px] text-gray-400"><?= $equipeNom2 ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-6">
                                    <div class="flex flex-col gap-1">
                                        <span class="text-white text-sm font-bold"><?= $dateEvent ?></span>
                                        <span class="text-[10px] text-gray-500 flex items-center gap-1">
                                            <i class='bx bx-time'></i> <?= $timeEvent ?>
                                        </span>
                                        <span class="text-[10px] text-[#d4af37] flex items-center gap-1 mt-1">
                                            <i class='bx bx-map'></i> <?= $lieuEvent ?>
                                        </span>
                                    </div>
                                </td>
                                <td class="p-6">
                                    <div class="w-full bg-white/10 rounded-full h-1.5 w-24 mb-1">
                                        <div class="bg-green-500 h-1.5 rounded-full" style="width: 85%"></div>
                                    </div>
                                    <span class="text-[9px] text-gray-400">85% Vendu</span>
                                </td>
                                <td class="p-6">
                                    <span  id="textStatus" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-green-500/10 text-green-400 border border-green-500/20 text-[10px] uppercase tracking-wide">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                                        <?= htmlspecialchars($statusEvent) ?>
                                    </span>
                                </td>
                                
                            </tr>
                            <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="commentaires" class="section-content hidden fade-in">
            <div class="space-y-4 max-w-4xl">
                <div class="flex items-center justify-between mb-6 px-4">
                    <h3 class="text-xl font-black uppercase italic text-white">Modération des <span class="text-[#d4af37]">Avis</span></h3>
                    <span class="text-[10px] bg-white/5 border border-white/10 px-3 py-1 rounded-full text-gray-400 font-bold uppercase tracking-widest">
                             Commentaires
                    </span>
                </div>

                <?php foreach ($comments as $comment) {
                    $path_image = '../../public/uploads/' . $comment->getUserPhoto();
                    $note = $comment->getNote(); 
                    $eventTitle =$comment->getEventTitle();
                ?>
                <div class="glass-card p-6 rounded-[24px] flex flex-col md:flex-row gap-6 items-start md:items-center group hover:border-[#d4af37]/30 transition-all duration-300">
                    
                    <div class="flex items-center gap-4 min-w-[200px]">
                        <div class="relative">
                            <img src="<?= $path_image ?>" class="w-12 h-12 rounded-full border-2 border-[#d4af37]/20 object-cover">
                            <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 border-2 border-[#050505] rounded-full"></div>
                        </div>
                        <div>
                            <h5 class="text-sm font-black text-white uppercase tracking-tight"><?= htmlspecialchars($comment->getUserName()) ?></h5>
                        </div>
                    </div>

                    <div class="flex-1 space-y-2 border-l border-white/5 md:pl-6">
                        <div class="flex flex-wrap items-center gap-3">
                            <span class="text-[9px] font-black uppercase px-2 py-0.5 bg-[#d4af37]/10 text-[#d4af37] border border-[#d4af37]/20 rounded-md">
                                <i class='bx bx-football mr-1'></i> <?= htmlspecialchars($eventTitle) ?>
                            </span>
                            <div class="flex text-[#d4af37] text-xs">
                                <?php for($i=1; $i<=5; $i++): ?>
                                    <i class='bx <?= $i <= $note ? 'bxs-star' : 'bx-star' ?>'></i>
                                <?php endfor; ?>
                            </div>
                        </div>
                        
                        <p class="text-xs text-gray-300 leading-relaxed font-medium italic">
                            "<?= htmlspecialchars($comment->getContenu()) ?>"
                        </p>
                        
                        <div class="flex items-center gap-4 mt-2">
                            <span class="text-[9px] text-gray-600 font-bold uppercase tracking-widest">Posté <?= htmlspecialchars($comment->getDateCommentaire()) ?></span>
                        </div>
                    </div>

                    <div class="flex gap-2 self-end md:self-center">
                        <button title="Répondre" class="w-9 h-9 rounded-xl bg-white/5 flex items-center justify-center text-gray-400 hover:bg-[#d4af37] hover:text-black transition-all">
                            <i class='bx bx-reply text-lg'></i>
                        </button>
                        <button onclick="confirmDeleteComment(this)" title="Supprimer" class="w-9 h-9 rounded-xl bg-red-500/5 flex items-center justify-center text-red-500 border border-red-500/10 hover:bg-red-500 hover:text-white transition-all">
                            <i class='bx bx-trash text-lg'></i>
                        </button>
                    </div>
                </div>
                <?php } ?>

                <?php if(empty($comments)): ?>
                    <div class="glass-card p-12 rounded-[32px] text-center">
                        <i class='bx bx-message-square-x text-5xl text-gray-700 mb-4'></i>
                        <p class="text-gray-500 font-bold uppercase tracking-widest text-xs">Aucun commentaire pour le moment</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </main>

    <script>
        let textStatus = document.getElementById('textStatus');
        if(textStatus.innerText.trim() === 'refuse'){
            textStatus.className = "inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-500/10 text-red-400 border border-red-500/20 text-[10px] uppercase tracking-wide";
            textStatus.innerHTML = "<span class='w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse'></span> refuse";
        }else if(textStatus.innerText.trim() === 'en_attente'){
            textStatus.className = "inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-yellow-500/10 text-yellow-400 border border-yellow-500/20 text-[10px] uppercase tracking-wide";
            textStatus.innerHTML = "<span class='w-1.5 h-1.5 rounded-full bg-yellow-500 animate-pulse'></span>en_attente";
        }else if(textStatus.innerText.trim() === 'valide'){
            textStatus.className = "inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-gray-500/10 text-gray-400 border border-gray-500/20 text-[10px] uppercase tracking-wide";
            textStatus.innerHTML = "<span class='w-1.5 h-1.5 rounded-full bg-gray-500'></span> valide";
        }

        // --- NAVIGATION ---
        function showSection(id) {
            document.querySelectorAll('.section-content').forEach(s => s.classList.add('hidden'));
            document.getElementById(id).classList.remove('hidden');
            document.querySelectorAll('.nav-btn').forEach(b => b.classList.remove('active'));
            event.currentTarget.classList.add('active');
            
            const titles = {
                'profil': 'Mon <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#d4af37] to-[#f4d03f]">Profil</span>',
                'organiser': 'Créer <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#d4af37] to-[#f4d03f]">Match</span>',
                'historique': 'Mes <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#d4af37] to-[#f4d03f]">Events</span>',
                'commentaires': 'Modération <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#d4af37] to-[#f4d03f]">Chat</span>'
            };
            document.getElementById('page-title').innerHTML = titles[id];
        }

        // --- ALERTES ---
        function showStatus(msg, isError = false) {
            const alertBox = document.getElementById('status-alert');
            const iconBox = document.getElementById('alert-icon-box');
            const message = document.getElementById('alert-message');
            const icon = document.getElementById('alert-icon');

            alertBox.style.display = 'flex';
            message.textContent = msg;

            if (isError) {
                alertBox.className = "mb-8 rounded-2xl p-4 flex items-center gap-4 border border-red-500/30 bg-red-500/10 text-red-500 backdrop-blur-md";
                iconBox.className = "w-10 h-10 rounded-xl flex items-center justify-center text-xl bg-red-500 text-white shadow-lg";
                icon.className = "bx bx-error-circle";
            } else {
                alertBox.className = "mb-8 rounded-2xl p-4 flex items-center gap-4 border border-green-500/30 bg-green-500/10 text-green-400 backdrop-blur-md";
                iconBox.className = "w-10 h-10 rounded-xl flex items-center justify-center text-xl bg-green-500 text-black shadow-lg";
                icon.className = "bx bx-check-double";
            }
        }

        // --- LIVE PREVIEW (MATCH) ---
        function updatePreviewText(inputId, previewId, defaultText) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);
            
            if(inputId === 'input-date' && input.value) {
                const d = new Date(input.value);
                preview.textContent = d.toLocaleDateString('fr-FR') + ' ' + d.toLocaleTimeString('fr-FR', {hour: '2-digit', minute:'2-digit'});
            } else {
                preview.textContent = input.value || defaultText;
            }
        }

        function updatePreviewImage(inputId, previewId) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // --- GESTION PROFIL (UPDATE + PHOTO) ---
        function handleUpdate(e) {
            e.preventDefault();
            const btn = document.getElementById('submit-btn');
            btn.textContent = 'CHARGEMENT...';
            btn.disabled = true;

            const formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('password', document.getElementById('password').value);
            
            const imageInput = document.getElementById('profile-upload');
            if (imageInput.files[0]) {
                formData.append('photo', imageInput.files[0]);
            }

            fetch('../api/updateProfile.php', {
                method: 'POST',
                body: formData 
            })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success') {
                    showStatus('Profil mis à jour !', false);
                    if(data.new_photo) {
                         document.getElementById('profile-preview-db').src = data.new_photo;
                         document.getElementById('side-avatar').src = data.new_photo;
                    }
                } else {
                    showStatus(data.message || 'Erreur inconnue', true);
                }
            })
            .catch(() => showStatus('Serveur injoignable.', true))
            .finally(() => {
                btn.textContent = 'Enregistrer';
                btn.disabled = false;
            });
        }

        function previewProfileImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                document.getElementById('profile-preview-db').src = reader.result;
                document.getElementById('side-avatar').src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function confirmDelete() {
            if(confirm('Êtes-vous sûr de vouloir désactiver votre compte ? Cette action est irréversible.')) {
                fetch('../api/deleteAccount.php', { method: 'DELETE' })
                .then(res => res.json())
                .then(data => {
                    if(data.status === 'success') {
                        alert('Votre compte a été désactivé. Vous allez être déconnecté.');
                        window.location.href = '../logout.php';
                    } else {
                        showStatus(data.message, true);
                    }
                })
                .catch(() => showStatus('Serveur injoignable.', true));
            }
        }

        function handleAddEvent(e) {
            e.preventDefault();
            const btn = e.target.querySelector('button[type="submit"]');
            btn.textContent = 'PUBLICATION...';
            btn.disabled = true;
            const formData = new FormData();
            formData.append('titre', document.getElementById('input-titre').value);
            formData.append('date_event', document.getElementById('input-date').value);
            formData.append('equipe1_nom', document.getElementById('input-team1').value);
            formData.append('equipe2_nom', document.getElementById('input-team2').value);
            formData.append('lieu', document.getElementById('input-lieu').value);
            const logo1 = document.getElementById('input-logo1');
            const logo2 = document.getElementById('input-logo2');
            const miniature = document.getElementById('input-miniature');
            if (logo1.files[0]) formData.append('equipe1_logo', logo1.files[0]);
            if (logo2.files[0]) formData.append('equipe2_logo', logo2.files[0]);
            if (miniature.files[0]) formData.append('mignature', miniature.files[0]);
            fetch('/BuyMatch-/app/api/addEvent.php', {
                method: 'POST',
                body: formData 
            })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success') {
                    showStatus('Match créé avec succès !', false);
                    e.target.reset();
                    console.log(data);
                    console.log('date suses ');

                    document.getElementById('preview-titre').textContent = 'TITRE DU MATCH';
                    document.getElementById('preview-date').textContent = 'JJ/MM/AAAA --:--';
                    document.getElementById('preview-team1').textContent = 'ÉQUIPE 1';
                    document.getElementById('preview-team2').textContent = 'ÉQUIPE 2';
                    document.getElementById('preview-lieu').textContent = 'Lieu du match';
                    document.getElementById('preview-logo1').src = 'https://cdn-icons-png.flaticon.com/512/10542/10542549.png';
                    document.getElementById('preview-logo2').src = 'https://cdn-icons-png.flaticon.com/512/10542/10542549.png';
                    document.getElementById('preview-miniature').src = 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=2693&auto=format&fit=crop'; 

                } else {
                    showStatus(data.message, true);
                }
            })
            .catch((err) => {
                console.error('FETCH ERROR:', err);
                showStatus('Serveur injoignable.', true);
            })
            .finally(() => {
                btn.textContent = 'Publier le Match';
                btn.disabled = false;
            });
        }
    
        
    </script>
</body>
</html>