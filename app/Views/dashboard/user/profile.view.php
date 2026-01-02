<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Espace VIP | BuyMatch</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../../../public/assets/css/navbar.css">

    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;400;500;600;700;800&display=swap');
        
        :root {
            --gold: #d4af37;
            --gold-light: #f4d03f;
            --bg-dark: #050505;
            --card-bg: rgba(20, 20, 20, 0.7);
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--bg-dark); 
            color: #ffffff;
            overflow-x: hidden;
        }

        /* Hide Scrollbar for Nav */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Animated Background Grid */
        .bg-grid {
            background-image: 
                linear-gradient(rgba(212, 175, 55, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(212, 175, 55, 0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            z-index: -1;
        }

        /* Glassmorphism Card */
        .glass-card {
            background: var(--card-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        /* Navigation Active State */
        .nav-link.active {
            background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%);
            color: #000;
            box-shadow: 0 0 15px rgba(212, 175, 55, 0.4);
        }
        
        .nav-link.active i { color: #000; }

        /* Gold Gradient Text */
        .text-gradient-gold {
            background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Entrance Animations */
        .animate-enter {
            animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        @keyframes fadeInUp {
            to { opacity: 1; transform: translateY(0); }
        }

        /* Toast Notification */
        .toast {
            visibility: hidden;
            min-width: 250px;
            background-color: #1a1a1a;
            border-left: 4px solid var(--gold);
            color: #fff;
            text-align: center;
            border-radius: 8px;
            padding: 16px;
            position: fixed;
            z-index: 100;
            right: 30px;
            bottom: 30px;
            font-size: 14px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            transform: translateY(100px);
            transition: transform 0.3s ease, visibility 0.3s;
        }
        
        .toast.show {
            visibility: visible;
            transform: translateY(0);
        }

        /* Sections Scroll Offset */
        section { scroll-margin-top: 140px; }
        
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        .delay-300 { animation-delay: 300ms; }
    </style>
</head>
<body class="pt-12 pb-12">
    <?php require_once __DIR__ . '/../../layouts/navbar.php'; ?>

    <!-- Background -->
    <div class="bg-grid"></div>

    <!-- Toast -->
    <div id="toast" class="toast flex items-center gap-3">
        <i class='bx bxs-check-circle text-[#d4af37] text-xl'></i>
        <span id="toast-message">Modifications enregistrées</span>
    </div>

    <!-- Main Container -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mt-20 mb-20">
        
        <!-- Header -->
        <div class="mb-8 text-center animate-enter">
            <h1 class="text-4xl md:text-5xl font-extrabold uppercase italic tracking-tighter">
                Espace <span class="text-gradient-gold">Membre</span>
            </h1>
            <p class="text-gray-400 text-sm mt-2 font-medium">Gérez votre profil BuyMatch</p>
        </div>

        <!-- NEW Horizontal Navigation (Sticky) -->
        <div class="sticky top-4 z-50 mb-10 animate-enter delay-100">
            <nav class="glass-card rounded-2xl p-2 mx-auto max-w-3xl overflow-x-auto scrollbar-hide">
                <div class="flex flex-nowrap md:justify-center gap-2 min-w-max px-2">
                    <a href="#profil" class="nav-link active flex items-center gap-2 px-5 py-3 text-xs md:text-sm font-bold text-gray-300 rounded-xl transition-all hover:bg-white/5 whitespace-nowrap">
                        <i class='bx bxs-user-circle text-lg'></i> Profil
                    </a>
                    <a href="#infos" class="nav-link flex items-center gap-2 px-5 py-3 text-xs md:text-sm font-bold text-gray-300 rounded-xl transition-all hover:bg-white/5 whitespace-nowrap">
                        <i class='bx bxs-id-card text-lg'></i> Infos
                    </a>
                    <a href="#teams" class="nav-link flex items-center gap-2 px-5 py-3 text-xs md:text-sm font-bold text-gray-300 rounded-xl transition-all hover:bg-white/5 whitespace-nowrap">
                        <i class='bx bxs-shirt text-lg'></i> Équipes
                    </a>
                    <a href="#stats" class="nav-link flex items-center gap-2 px-5 py-3 text-xs md:text-sm font-bold text-gray-300 rounded-xl transition-all hover:bg-white/5 whitespace-nowrap">
                        <i class='bx bxs-bar-chart-alt-2 text-lg'></i> Activité
                    </a>
                    <a href="#security" class="nav-link flex items-center gap-2 px-5 py-3 text-xs md:text-sm font-bold text-gray-300 rounded-xl transition-all hover:bg-white/5 whitespace-nowrap">
                        <i class='bx bxs-shield-alt-2 text-lg'></i> Sécurité
                    </a>
                </div>
            </nav>
        </div>

        <!-- Main Content (Full Width) -->
        <main class="space-y-8">

            <!-- Profile Card -->
            <section id="profil" class="glass-card rounded-3xl p-8 animate-enter delay-200 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-[#d4af37] opacity-5 blur-[100px] rounded-full pointer-events-none"></div>
                
                <div class="flex flex-col md:flex-row items-center gap-8 relative z-10">
                    <div class="relative">
                        <div class="w-32 h-32 rounded-full p-1 bg-gradient-to-br from-[#d4af37] to-[#f4d03f]">
                            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Youssef" alt="Profile" class="w-full h-full object-cover rounded-full border-4 border-[#111]">
                        </div>
                        <button class="absolute bottom-0 right-0 bg-[#d4af37] text-black p-2 rounded-full hover:scale-110 transition-transform shadow-lg">
                            <i class='bx bxs-camera'></i>
                        </button>
                    </div>
                    
                    <div class="text-center md:text-left flex-1">
                        <div class="flex flex-col md:flex-row items-center gap-3 mb-2 justify-center md:justify-start">
                            <h2 class="text-3xl font-bold text-white">Youssef Bennani</h2>
                            <span class="px-3 py-1 rounded-full bg-gradient-to-r from-[#d4af37] to-[#f4d03f] text-black text-[10px] font-black uppercase tracking-wider">
                                <i class='bx bxs-crown inline-block mr-1'></i> VIP Gold
                            </span>
                        </div>
                        <p class="text-gray-400 text-sm mb-6">Membre depuis 2023 • Casablanca, Maroc</p>
                        
                        <div class="flex items-center justify-center md:justify-start gap-8">
                            <div class="text-center">
                                <span class="block text-2xl font-black text-white">12</span>
                                <span class="text-[10px] uppercase tracking-widest text-gray-500">Matchs</span>
                            </div>
                            <div class="w-px h-8 bg-gray-800"></div>
                            <div class="text-center">
                                <span class="block text-2xl font-black text-[#d4af37]">3450</span>
                                <span class="text-[10px] uppercase tracking-widest text-gray-500">Points</span>
                            </div>
                            <div class="w-px h-8 bg-gray-800"></div>
                            <div class="text-center">
                                <span class="block text-2xl font-black text-white">4.8</span>
                                <span class="text-[10px] uppercase tracking-widest text-gray-500">Note</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Personal Info -->
            <section id="infos" class="glass-card rounded-3xl p-8 animate-enter delay-300">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="text-xl font-bold mb-1">Informations Personnelles</h3>
                        <p class="text-xs text-gray-500 uppercase tracking-widest">Coordonnées</p>
                    </div>
                    <button onclick="saveChanges()" class="bg-white text-black px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-[#d4af37] transition-all duration-300">
                        Sauvegarder
                    </button>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase text-gray-500 tracking-wider ml-1">Nom Complet</label>
                        <div class="relative">
                            <i class='bx bx-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-500'></i>
                            <input type="text" value="Youssef Bennani" class="w-full bg-[#0a0a0a] border border-[#222] rounded-xl py-3.5 pl-11 pr-4 text-sm focus:border-[#d4af37] focus:ring-1 focus:ring-[#d4af37] outline-none transition-all text-gray-200">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase text-gray-500 tracking-wider ml-1">Email</label>
                        <div class="relative">
                            <i class='bx bx-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-500'></i>
                            <input type="email" value="youssef.bennani@email.com" class="w-full bg-[#0a0a0a] border border-[#222] rounded-xl py-3.5 pl-11 pr-4 text-sm focus:border-[#d4af37] focus:ring-1 focus:ring-[#d4af37] outline-none transition-all text-gray-200">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase text-gray-500 tracking-wider ml-1">Téléphone</label>
                        <div class="relative">
                            <i class='bx bx-phone absolute left-4 top-1/2 -translate-y-1/2 text-gray-500'></i>
                            <input type="tel" value="+212 6 12 34 56 78" class="w-full bg-[#0a0a0a] border border-[#222] rounded-xl py-3.5 pl-11 pr-4 text-sm focus:border-[#d4af37] focus:ring-1 focus:ring-[#d4af37] outline-none transition-all text-gray-200">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase text-gray-500 tracking-wider ml-1">Ville</label>
                        <div class="relative">
                            <i class='bx bx-map absolute left-4 top-1/2 -translate-y-1/2 text-gray-500'></i>
                            <input type="text" value="Casablanca" class="w-full bg-[#0a0a0a] border border-[#222] rounded-xl py-3.5 pl-11 pr-4 text-sm focus:border-[#d4af37] focus:ring-1 focus:ring-[#d4af37] outline-none transition-all text-gray-200">
                        </div>
                    </div>
                </div>
            </section>

            <!-- Teams -->
            <section id="teams" class="glass-card rounded-3xl p-8 animate-enter delay-300">
                <div class="mb-8">
                    <h3 class="text-xl font-bold mb-1">Clubs Favoris</h3>
                    <p class="text-xs text-gray-500 uppercase tracking-widest">Gérez vos abonnements</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="group relative bg-gradient-to-b from-[#1a1a1a] to-[#0a0a0a] border border-[#d4af37] p-5 rounded-2xl cursor-pointer hover:shadow-[0_0_20px_rgba(212,175,55,0.15)] transition-all">
                        <div class="absolute top-3 right-3 text-[#d4af37]"><i class='bx bxs-star'></i></div>
                        <div class="h-12 w-12 bg-blue-900/20 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <i class='bx bxs-shield text-blue-500 text-2xl'></i>
                        </div>
                        <h4 class="font-bold text-sm">FC Barcelona</h4>
                        <p class="text-[10px] text-gray-500 uppercase mt-1">La Liga</p>
                    </div>
                    <div class="group relative bg-[#0c0c0c] border border-[#222] p-5 rounded-2xl cursor-pointer hover:border-gray-500 transition-all">
                        <div class="absolute top-3 right-3 text-gray-700 group-hover:text-white transition-colors"><i class='bx bx-star'></i></div>
                        <div class="h-12 w-12 bg-white/5 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <i class='bx bxs-crown text-white text-2xl'></i>
                        </div>
                        <h4 class="font-bold text-sm">Real Madrid</h4>
                        <p class="text-[10px] text-gray-500 uppercase mt-1">La Liga</p>
                    </div>
                    <div class="group relative bg-[#0c0c0c] border border-[#222] p-5 rounded-2xl cursor-pointer hover:border-red-500/50 transition-all">
                        <div class="absolute top-3 right-3 text-gray-700 group-hover:text-red-500 transition-colors"><i class='bx bx-star'></i></div>
                        <div class="h-12 w-12 bg-red-900/20 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <i class='bx bxs-star text-red-600 text-2xl'></i>
                        </div>
                        <h4 class="font-bold text-sm">WAC</h4>
                        <p class="text-[10px] text-gray-500 uppercase mt-1">Botola Pro</p>
                    </div>
                    <div class="border border-dashed border-[#333] p-5 rounded-2xl cursor-pointer hover:border-[#d4af37] hover:bg-[#d4af37]/5 transition-all flex flex-col items-center justify-center text-gray-500 hover:text-[#d4af37]">
                        <i class='bx bx-plus text-3xl mb-2'></i>
                        <span class="text-[10px] font-black uppercase tracking-widest">Ajouter</span>
                    </div>
                </div>
            </section>

            <!-- Grid 2 Colonnes Stats & Security -->
            <div class="grid md:grid-cols-2 gap-8">
                
                <!-- Stats -->
                <section id="stats" class="glass-card rounded-3xl p-8 animate-enter delay-300">
                    <div class="mb-6">
                        <h3 class="text-xl font-bold mb-1">Dernière Activité</h3>
                        <p class="text-xs text-gray-500 uppercase tracking-widest">Historique récent</p>
                    </div>
                    <div class="relative border-l border-gray-800 ml-3 space-y-8">
                        <div class="relative pl-8">
                            <div class="absolute -left-[5px] top-1 w-2.5 h-2.5 rounded-full bg-[#d4af37] shadow-[0_0_10px_#d4af37]"></div>
                            <p class="text-xs text-[#d4af37] font-bold mb-1">Aujourd'hui, 14:30</p>
                            <p class="text-sm font-medium">Billet acheté : <span class="text-white">WAC vs Raja</span></p>
                            <p class="text-xs text-gray-500 mt-1">Tribune VVIP • Siège B12</p>
                        </div>
                        <div class="relative pl-8">
                            <div class="absolute -left-[5px] top-1 w-2.5 h-2.5 rounded-full bg-gray-700"></div>
                            <p class="text-xs text-gray-500 font-bold mb-1">Hier</p>
                            <p class="text-sm font-medium">Badge débloqué : <span class="text-white">Fidèle Supporter</span></p>
                        </div>
                    </div>
                </section>

                <!-- Security -->
                <section id="security" class="glass-card rounded-3xl p-8 animate-enter delay-300">
                    <div class="mb-6">
                        <h3 class="text-xl font-bold mb-1">Sécurité</h3>
                        <p class="text-xs text-gray-500 uppercase tracking-widest">Contrôle du compte</p>
                    </div>
                    <div class="space-y-5">
                        <div class="flex items-center justify-between p-3 rounded-xl bg-[#0a0a0a] border border-[#222]">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-[#1a1a1a] rounded-lg text-[#d4af37]"><i class='bx bx-bell'></i></div>
                                <div class="text-sm font-medium">Notifications Email</div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer" onchange="toggleSetting('Notifications')">
                                <div class="w-11 h-6 bg-gray-800 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#d4af37]"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-xl bg-[#0a0a0a] border border-[#222]">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-[#1a1a1a] rounded-lg text-[#d4af37]"><i class='bx bx-lock-alt'></i></div>
                                <div class="text-sm font-medium">Double Auth (2FA)</div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" onchange="toggleSetting('2FA')">
                                <div class="w-11 h-6 bg-gray-800 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#d4af37]"></div>
                            </label>
                        </div>
                        <button class="w-full mt-4 p-3 border border-red-900/50 text-red-500 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-red-900/20 transition-all">
                            Supprimer le compte
                        </button>
                    </div>
                </section>
            </div>
        </main>
    </div>
            <?php require_once __DIR__ . '/../../layouts/footer.php'; ?>


    <script>
        function showToast(message) {
            const toast = document.getElementById("toast");
            const toastMsg = document.getElementById("toast-message");
            toastMsg.innerText = message;
            toast.className = "toast show flex items-center gap-3";
            setTimeout(() => { toast.className = toast.className.replace("show", ""); }, 3000);
        }

        function saveChanges() {
            const btn = event.target;
            const originalText = btn.innerText;
            btn.innerHTML = "<i class='bx bx-loader-alt bx-spin'></i>";
            setTimeout(() => {
                btn.innerText = originalText;
                showToast("Modifications enregistrées !");
            }, 1000);
        }

        function toggleSetting(name) { showToast(name + " modifié"); }

        // Active Link Highlighting
        const sections = document.querySelectorAll("section");
        const navLinks = document.querySelectorAll(".nav-link");

        window.onscroll = () => {
            let current = "";
            sections.forEach((section) => {
                const sectionTop = section.offsetTop;
                if (pageYOffset >= sectionTop - 150) {
                    current = section.getAttribute("id");
                }
            });
            navLinks.forEach((a) => {
                a.classList.remove("active");
                if (a.getAttribute("href").includes(current)) {
                    a.classList.add("active");
                }
            });
        };
    </script>
</body>
    <script src="../../../../public/assets/js/nabar.js"></script>

</html>