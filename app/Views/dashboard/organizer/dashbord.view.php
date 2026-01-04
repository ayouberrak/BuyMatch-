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
                <i class='bx bx-message-square-dots text-xl'></i> Modération <span class="ml-auto bg-red-500/20 text-red-500 text-[9px] px-2 py-0.5 rounded-full">3</span>
            </button>
        </nav>

        <div class="p-6 border-t border-white/5 bg-black/20">
            <div class="flex items-center gap-3">
                <img id="side-avatar" src="https://api.dicebear.com/7.x/avataaars/svg?seed=Organizer1" class="w-9 h-9 rounded-full border border-gray-700">
                <div class="flex-1"><p class="text-xs font-bold text-white">Atlas Events</p></div>
                <a href="logout.php" class="text-gray-500 hover:text-red-500 transition-colors"><i class='bx bx-log-out text-xl'></i></a>
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
                    <?php $path_image = '../../public/uploads/' . $organisateur->getPhoto();
                      ?>
                    <div class="glass-card rounded-[32px] p-8 text-center relative overflow-hidden">
                        <div class="relative inline-block group mb-6">
                            <img id="profile-preview" src="<?php echo htmlspecialchars($path_image); ?>" class="relative w-32 h-32 rounded-full border-4 border-[#151515] bg-[#151515] object-cover">
                            <label class="absolute bottom-1 right-1 bg-[#d4af37] text-black w-9 h-9 rounded-full flex items-center justify-center cursor-pointer shadow-lg hover:scale-110 transition">
                                <i class='bx bx-camera text-lg'></i>
                                <input type="file" class="hidden" accept="image/*" onchange="previewImage(event)">
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
                                    <input type="text" id="name" value="<?php echo htmlspecialchars($organisateur->getName()) ?>" class="input-dark w-full p-4 rounded-xl text-sm font-bold">
                                    <i class='bx bx-buildings input-icon'></i>
                                </div>
                                <div class="input-group relative">
                                    <label class="text-[9px] font-bold uppercase text-gray-500 mb-2 block">Email Pro</label>
                                    <input type="email" id="email" value="<?php echo htmlspecialchars($organisateur->getEmail()) ?>" class="input-dark w-full p-4 rounded-xl text-sm font-bold">
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
            <div class="glass-card rounded-[32px] p-8 max-w-4xl">
                <form class="space-y-8">
                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="space-y-4">
                            <label class="text-[10px] font-black uppercase text-[#d4af37] tracking-widest">Équipes</label>
                            <input type="text" placeholder="Équipe Domicile" class="input-dark w-full p-4 rounded-xl text-sm">
                            <input type="text" placeholder="Équipe Extérieur" class="input-dark w-full p-4 rounded-xl text-sm">
                        </div>
                        <div class="space-y-4">
                            <label class="text-[10px] font-black uppercase text-[#d4af37] tracking-widest">Détails</label>
                            <input type="date" class="input-dark w-full p-4 rounded-xl text-sm">
                            <input type="text" placeholder="Stade" class="input-dark w-full p-4 rounded-xl text-sm">
                        </div>
                    </div>
                    <button type="button" onclick="showStatus('Match soumis pour révision !')" class="w-full bg-white text-black font-black uppercase py-5 rounded-2xl hover:bg-[#d4af37] transition-all">Soumettre</button>
                </form>
            </div>
        </div>

        <div id="historique" class="section-content hidden fade-in">
            <div class="glass-card rounded-[32px] overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-black/40 text-[9px] uppercase text-gray-500 tracking-widest border-b border-white/5">
                        <tr><th class="p-6">Match</th><th class="p-6">Date</th><th class="p-6">Statut</th></tr>
                    </thead>
                    <tbody class="text-xs font-bold divide-y divide-white/5">
                        <tr class="hover:bg-white/5"><td class="p-6">WAC VS RAJA</td><td class="p-6">15/01/2026</td><td class="p-6 text-green-400 uppercase">Confirmé</td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="commentaires" class="section-content hidden fade-in">
            <div class="space-y-4 max-w-3xl">
                <div id="msg-1" class="glass-card p-5 rounded-2xl flex gap-4 items-center">
                    <img src="https://i.pravatar.cc/100?img=1" class="w-10 h-10 rounded-full">
                    <div class="flex-1"><h5 class="text-sm font-bold">Karim T.</h5><p class="text-xs text-gray-400">Accès parfait !</p></div>
                    <button onclick="this.parentElement.remove()" class="text-red-500"><i class='bx bx-trash text-xl'></i></button>
                </div>
            </div>
        </div>

    </main>

    <script>
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

        function showStatus(msg, isError = false) {
            const alertBox = document.getElementById('status-alert');
            const iconBox = document.getElementById('alert-icon-box');
            const icon = document.getElementById('alert-icon');
            const message = document.getElementById('alert-message');

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

        function handleUpdate(e) {
            e.preventDefault();
            const btn = document.getElementById('submit-btn');
            btn.textContent = 'CHARGEMENT...';
            btn.disabled = true;

            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            fetch('../api/updateProfile.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ name, email, password })
            })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success') showStatus('Profil mis à jour !', false);
                else showStatus(data.message, true);
            })
            .catch(() => showStatus('Serveur injoignable.', true))
            .finally(() => {
                btn.textContent = 'Enregistrer';
                btn.disabled = false;
            });
        }

        function confirmDelete() {
            if(confirm('Êtes-vous sûr de vouloir désactiver votre compte ? Cette action est irréversible.')) {
                fetch('../api/deleteAccount.php',
                 { method: 'DELETE' })
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

        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                document.getElementById('profile-preview').src = reader.result;
                document.getElementById('side-avatar').src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>