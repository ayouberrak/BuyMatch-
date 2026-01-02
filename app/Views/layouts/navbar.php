<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700;800&display=swap');
        
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #050505; }

        /* Glassmorphism */
        .nav-glass {
            background: rgba(15, 15, 15, 0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        }

        /* Gold Text */
        .gold-text {
            /* background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%); */
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Link Animation */
        .nav-link { position: relative; transition: color 0.3s ease; }
        .nav-link::after {
            content: ''; position: absolute; bottom: -4px; left: 0; width: 0; height: 2px;
            /* background: #d4af37; transition: width 0.3s ease; */
        }
        .nav-link:hover::after, .nav-link.active::after { width: 100%; }
        .nav-link:hover, .nav-link.active { color: #000000ff; }
    </style>
</head>
<body class="pt-32">

    <!-- NAVBAR -->
    <nav id="navbar-component" class="fixed top-6 left-1/2 -translate-x-1/2 w-[95%] max-w-7xl z-[999] nav-glass rounded-full px-6 py-3 md:px-8 md:py-4 flex justify-between items-center transition-all duration-500">
        
        <!-- LOGO -->
        <a href="/" class="flex items-center gap-2 group shrink-0">
            <i class='bx bxs-zap text-[#d4af37] text-2xl group-hover:animate-pulse'></i>
            <span class="text-xl font-black italic tracking-tighter uppercase text-white">
                BUY<span class="gold-text">MATCH</span>
            </span>
        </a>

        <!-- LINKS (Middle) -->
        <ul id="nav-links-container" class="hidden lg:flex items-center gap-6 text-[10px] font-extrabold uppercase tracking-[2px] text-gray-300">
            <!-- Injecté par JS -->
        </ul>

        <!-- ACTIONS (Right) -->
        <div id="nav-actions-container" class="flex items-center gap-4 shrink-0">
            <!-- Injecté par JS -->
        </div>

    </nav>


    <!-- JS LOGIC -->
    <script>
        const NavbarManager = {
            roles: {
                // 1. GUEST (Non connecté)
                guest: {
                    links: [
                        { label: "Accueil", href: "#home", icon: "bx-home-alt-2" },
                        { label: "Matchs", href: "#matches", icon: "bx-football" },
                        { label: "Support", href: "#support", icon: "bx-headphone" }
                    ],
                    htmlRight: `
                        <a href="/signup" class="hidden sm:block text-white hover:text-[#d4af37] text-[10px] font-bold uppercase tracking-widest transition-colors mr-2">
                            Inscription
                        </a>
                        <a href="/login" class="bg-white text-black px-6 py-2.5 rounded-full text-[10px] font-black uppercase tracking-widest  hover:text-black transition-all shadow-lg">
                            Connexion
                        </a>
                    `
                },

                // 2. USER (Connecté)
                user: {
                    links: [
                        { label: "Accueil", href: "#home", icon: "bx-home-alt-2" },
                        { label: "Matchs", href: "#matches", icon: "bx-football" },
                        { label: "Mes Réservations", href: "#my-tickets", icon: "bx-ticket" }
                    ],
                    htmlRight: `
                        <div class="flex items-center gap-3 pl-4 border-l border-white/10">
                            <a href="#profile" class="flex items-center gap-2 bg-white/5 pr-4 pl-1 py-1 rounded-full border border-white/10 hover:border-[#d4af37] transition-all group">
                                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Yassine" class="w-8 h-8 rounded-full border border-[#d4af37]" alt="Avatar">
                                <span class="text-[10px] font-bold uppercase tracking-widest group-hover:text-[#d4af37]">Profil</span>
                            </a>
                            <button onclick="NavbarManager.logout()" class="w-9 h-9 rounded-full flex items-center justify-center text-gray-400 hover:text-red-500 hover:bg-red-500/10 transition-all">
                                <i class='bx bx-log-out text-xl'></i>
                            </button>
                        </div>
                    `
                },

                // 3. ORGANISATEUR (A maintenant Accueil + Matchs)
                organisateur: {
                    links: [
                        { label: "Accueil", href: "#home", icon: "bx-home-alt-2" },
                        { label: "Matchs", href: "#matches", icon: "bx-football" },
                        { label: "Tableau de bord", href: "#dashboard-org", icon: "bx-grid-alt" }, // Spécifique
                        { label: "Événements", href: "#events", icon: "bx-calendar-event" }     // Spécifique
                    ],
                    htmlRight: `
                        <div class="flex items-center gap-3">
                            <span class="px-3 py-1.5 bg-purple-500/10 text-purple-400 border border-purple-500/30 rounded-lg text-[9px] font-black uppercase tracking-widest">
                                Organisateur
                            </span>
                            <button onclick="NavbarManager.logout()" class="text-gray-400 hover:text-white transition-colors text-xs font-bold uppercase tracking-widest flex items-center gap-1">
                                <i class='bx bx-log-out'></i>
                            </button>
                        </div>
                    `
                },

                // 4. ADMIN (A maintenant Accueil + Matchs)
                admin: {
                    links: [
                        { label: "Accueil", href: "#home", icon: "bx-home-alt-2" },
                        { label: "Matchs", href: "#matches", icon: "bx-football" },
                        { label: "Admin Panel", href: "#admin-panel", icon: "bx-shield-quarter" }, // Spécifique
                        { label: "Utilisateurs", href: "#users", icon: "bx-group" }                // Spécifique
                    ],
                    htmlRight: `
                        <div class="flex items-center gap-3">
                            <span class="px-3 py-1.5 bg-red-500/10 text-red-500 border border-red-500/30 rounded-lg text-[9px] font-black uppercase tracking-widest animate-pulse">
                                ● Admin
                            </span>
                            <button onclick="NavbarManager.logout()" class="w-9 h-9 rounded-full bg-red-600 text-white flex items-center justify-center hover:bg-red-700 transition-all shadow-lg shadow-red-900/50">
                                <i class='bx bx-power-off'></i>
                            </button>
                        </div>
                    `
                }
            },

            init: function(userRole) {
                const config = this.roles[userRole] || this.roles.guest;
                
                // Remplir Liens
                document.getElementById('nav-links-container').innerHTML = config.links.map(link => `
                    <li>
                        <a href="${link.href}" class="nav-link flex items-center gap-1.5 hover:text-white">
                            <i class='bx ${link.icon} text-sm mb-0.5'></i> ${link.label}
                        </a>
                    </li>
                `).join('');

                // Remplir Actions
                document.getElementById('nav-actions-container').innerHTML = config.htmlRight;
            },

            logout: function() {
                console.log("Logout...");
                this.init('guest'); // Pour tester
            }
        };

        // --- TEST ZONE ---
        // Change ici pour tester : 'guest', 'user', 'organisateur', 'admin'
        NavbarManager.init('organisateur'); 

    </script>
</body>
</html>