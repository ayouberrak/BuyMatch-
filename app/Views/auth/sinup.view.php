<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuyMatch | Inscription Élite</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: #020202; 
            color: white; 
            overflow-x: hidden;
        }

        .bg-ambiance {
            background-image: url('https://images.unsplash.com/photo-1489944440615-453fc2b6a9a9?q=80&w=1000');
            background-size: cover;
            background-position: center;
            opacity: 0.1;
            position: absolute;
            inset: 0;
            z-index: -1;
            filter: grayscale(100%) contrast(120%);
        }

        .glass-card {
            background: rgba(10, 10, 10, 0.6);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .input-group:focus-within {
            border-color: #d4af37;
            box-shadow: 0 0 0 1px #d4af37;
        }

        .btn-gold {
            background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .animate-enter { 
            animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; 
            opacity: 0; 
            transform: translateY(20px); 
        }
        @keyframes fadeInUp { to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="flex flex-col min-h-screen relative">

    <div class="bg-ambiance"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-[#020202] via-[#020202]/90 to-transparent z-[-1]"></div>

    <div class="fixed top-8 left-8 z-50 animate-enter">
        <a href="index.php" class="group flex items-center gap-3 px-4 py-2 rounded-full border border-white/10 bg-white/5 hover:bg-white/10 hover:border-[#d4af37]/50 transition-all">
            <i class='bx bx-left-arrow-alt text-xl text-gray-400 group-hover:text-[#d4af37] transition-colors'></i>
            <span class="text-[10px] font-black uppercase tracking-[2px] text-gray-400 group-hover:text-white transition-colors">Menu Principal</span>
        </a>
    </div>

    <main class="flex-grow flex items-center justify-center pt-28 pb-20 px-4">
        <div class="w-full max-w-[650px]">
            
            <div class="text-center mb-8 animate-enter">
                <div class="inline-block mb-3 px-3 py-1 rounded-full border border-[#d4af37]/30 bg-[#d4af37]/10">
                    <h4 class="text-[#d4af37] text-[9px] font-black uppercase tracking-[4px]">Nouveau Compte</h4>
                </div>
                <h1 class="text-4xl md:text-5xl font-black italic tracking-tighter uppercase leading-tight">
                    Rejoindre <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#d4af37] to-[#f4d03f]">L'élite</span>
                </h1>
            </div>

            <div class="glass-card rounded-[40px] p-8 md:p-12 animate-enter" style="animation-delay: 100ms;">
                <form action="" method="POST" enctype="multipart/form-data" class="space-y-8">
                    
                    <div class="flex justify-center">
                        <label class="relative group cursor-pointer">
                            <div class="w-24 h-24 rounded-3xl border-2 border-dashed border-gray-600 flex flex-col items-center justify-center bg-white/5 group-hover:border-[#d4af37] group-hover:bg-[#d4af37]/5 transition-all">
                                <i class='bx bx-cloud-upload text-2xl text-gray-500 group-hover:text-[#d4af37]'></i>
                                <span class="text-[8px] font-bold text-gray-500 uppercase mt-1">Photo</span>
                            </div>
                            <input type="file" name="avatar" class="hidden" accept="image/*">
                        </label>
                    </div>

                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="role" value="acheteur" class="peer hidden" checked>
                                <div class="h-28 rounded-2xl border border-white/10 bg-white/5 flex flex-col items-center justify-center text-center p-4 transition-all peer-checked:border-[#d4af37] peer-checked:bg-[#d4af37]/10">
                                    <i class='bx bx-user-circle text-2xl mb-2 text-gray-500 peer-checked:text-[#d4af37]'></i>
                                    <h3 class="text-[10px] font-black uppercase tracking-widest">Supporter</h3>
                                    <i class='bx bxs-check-circle absolute top-3 right-3 text-[#d4af37] opacity-0 peer-checked:opacity-100 transition-opacity'></i>
                                </div>
                            </label>

                            <label class="relative cursor-pointer group">
                                <input type="radio" name="role" value="organisateur" class="peer hidden">
                                <div class="h-28 rounded-2xl border border-white/10 bg-white/5 flex flex-col items-center justify-center text-center p-4 transition-all peer-checked:border-[#d4af37] peer-checked:bg-[#d4af37]/10">
                                    <i class='bx bx-trophy text-2xl mb-2 text-gray-500 peer-checked:text-[#d4af37]'></i>
                                    <h3 class="text-[10px] font-black uppercase tracking-widest">Organisateur</h3>
                                    <i class='bx bxs-check-circle absolute top-3 right-3 text-[#d4af37] opacity-0 peer-checked:opacity-100 transition-opacity'></i>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="space-y-5">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest ml-1">Nom Complet</label>
                            <div class="input-group bg-black/40 border border-white/10 flex items-center gap-4 px-4 py-3.5 rounded-xl transition-all">
                                <i class='bx bx-user text-gray-500'></i>
                                <input type="text" name="name" placeholder="Ex: Karim Ben" required class="bg-transparent w-full text-sm font-bold outline-none placeholder-white/10">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest ml-1">Email</label>
                            <div class="input-group bg-black/40 border border-white/10 flex items-center gap-4 px-4 py-3.5 rounded-xl transition-all">
                                <i class='bx bx-envelope text-gray-500'></i>
                                <input type="email" name="email" placeholder="votre@email.com" required class="bg-transparent w-full text-sm font-bold outline-none placeholder-white/10">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest ml-1">Mot de passe</label>
                            <div class="input-group bg-black/40 border border-white/10 flex items-center gap-4 px-4 py-3.5 rounded-xl transition-all">
                                <i class='bx bx-lock-alt text-gray-500'></i>
                                <input type="password" name="password" placeholder="••••••••" required class="bg-transparent w-full text-sm font-bold outline-none placeholder-white/10">
                            </div>
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="btn-gold w-full py-4 rounded-2xl font-black uppercase text-[11px] tracking-[3px] text-black shadow-xl hover:scale-[1.01] active:scale-95">
                            Créer mon compte
                        </button>
                    </div>

                    <div class="text-center">
                        <p class="text-gray-500 text-[10px] font-bold uppercase tracking-[2px]">
                            Déjà inscrit ? <a href="LoginController.php" class="text-white hover:text-[#d4af37] ml-1">Se connecter</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </main>

</body>
</html>