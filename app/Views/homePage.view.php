<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuyMatch | Premium Ticket Experience</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/assets/css/home.css">
    <link rel="stylesheet" href="../../public/assets/css/navbar.css">
    <style>
        /* Configuration des couleurs personnalisées */
        :root { --gold: #d4af37; }
        .text-gold { color: var(--gold); }
        .bg-gold { background-color: var(--gold); }
        .gold-shine {
            background: linear-gradient(to right, #bf953f, #fcf6ba, #b38728, #fbf5b7, #aa771c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .reveal-on-scroll { opacity: 0; transform: translateY(30px); transition: all 1s ease-out; }
        .reveal-visible { opacity: 1; transform: translateY(0); }
    </style>
</head>

<?php require_once __DIR__ . '/layouts/navbar.php'; ?>

<body class="bg-[#020202] text-white overflow-x-hidden font-sans">

    <!-- HERO SECTION AMÉLIORÉE -->
    <header class="relative min-h-screen flex items-center justify-center overflow-hidden">
        
        <!-- Background Image avec Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="../../public/assets/image/stade.jpeg" alt="Stadium Atmosphere" class="w-full h-full object-cover opacity-40 scale-105 animate-[pulse_10s_ease-in-out_infinite]">
            <div class="absolute inset-0 bg-gradient-to-t from-[#020202] via-[#020202]/80 to-transparent"></div>
        </div>

        <div class="relative z-10 max-w-5xl text-center space-y-8 px-4 reveal-on-scroll">
            <div class="inline-flex items-center gap-3 px-5 py-2 rounded-full border border-[#d4af37]/30 bg-black/50 backdrop-blur-md text-[#d4af37] text-[10px] font-bold uppercase tracking-[4px]">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inset-0 rounded-full bg-[#d4af37] opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-[#d4af37]"></span>
                </span>
                Saison 2026 • Billetterie Ouverte
            </div>
            
            <h1 class="text-6xl md:text-8xl lg:text-9xl font-black tracking-tighter leading-none drop-shadow-2xl">
                PRESTIGE <br> 
                <span class="gold-shine italic uppercase">BuyMatch</span>
            </h1>
            
            <p class="text-gray-400 text-sm md:text-base tracking-[6px] uppercase max-w-2xl mx-auto font-light border-t border-white/10 pt-6 mt-6">
                L'élite du sport à portée de main.
            </p>
            
            <div class="pt-8">
                <a href="#matches" class="bg-[#d4af37] text-black px-8 py-4 rounded-full font-black uppercase tracking-widest hover:bg-white transition-all duration-300 shadow-[0_0_30px_rgba(212,175,55,0.3)]">
                    Réserver maintenant
                </a>
            </div>
        </div>

        <!-- Scroll Down Indicator -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 animate-bounce">
            <span class="text-[10px] uppercase tracking-widest text-gray-500">Scroll</span>
            <i class='bx bx-chevron-down text-[#d4af37] text-2xl'></i>
        </div>
    </header>

    <!-- ABOUT SECTION -->
    <section id="about" class="py-32 px-6 lg:px-20 relative overflow-hidden bg-[#020202]">
        <div class="absolute top-20 right-[-5%] text-[10rem] md:text-[15rem] font-black opacity-[0.02] select-none pointer-events-none tracking-tighter italic text-white">
            HISTORY
        </div>

        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center gap-16 lg:gap-24">
            
            <div class="w-full lg:w-1/2 relative reveal-on-scroll">
                <div class="absolute -top-6 -left-6 w-32 h-32 border-t-2 border-l-2 border-[#d4af37]/30 z-0"></div>
                
                <div class="relative z-10 rounded-[40px] overflow-hidden group border border-white/5 shadow-2xl h-[500px]">
                    <img src="https://images.unsplash.com/photo-1510563800743-aed236490d08?q=80&w=1000" 
                        class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-1000 scale-110 group-hover:scale-100" 
                        alt="BuyMatch Experience">
                    
                    <div class="absolute bottom-8 left-8 bg-[#d4af37]/90 backdrop-blur-sm p-6 rounded-2xl shadow-2xl transform group-hover:-translate-y-2 transition-transform border border-white/20">
                        <p class="text-black font-black text-3xl leading-none">10Y</p>
                        <p class="text-black text-[9px] font-bold uppercase tracking-widest mt-1">D'Excellence</p>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/2 space-y-10 reveal-on-scroll">
                <div class="space-y-4">
                    <h4 class="text-[#d4af37] text-xs font-bold uppercase tracking-[8px] flex items-center gap-4">
                        <span class="w-12 h-[1px] bg-[#d4af37]"></span> Notre Vision
                    </h4>
                    <h2 class="text-4xl md:text-6xl font-black tracking-tighter leading-tight uppercase">
                        Plus qu'un Ticket, <br> <span class="gold-shine italic">Une Légende.</span>
                    </h2>
                </div>

                <p class="text-gray-400 text-lg font-light leading-relaxed border-l-2 border-[#d4af37]/20 pl-8 italic">
                    "Nous avons créé BuyMatch pour ceux qui ne se contentent pas de regarder le match, mais qui veulent le vivre avec privilège, confort et exclusivité."
                </p>

                <div class="grid grid-cols-2 gap-12 pt-4 border-t border-white/5 mt-8">
                    <div class="group cursor-default">
                        <div class="w-12 h-12 rounded-full bg-[#d4af37]/10 flex items-center justify-center mb-4 group-hover:bg-[#d4af37] transition-colors duration-300">
                            <i class='bx bxs-badge-check text-2xl text-[#d4af37] group-hover:text-black transition-colors'></i>
                        </div>
                        <h5 class="text-white font-bold text-sm uppercase tracking-widest mb-2">Sécurité Elite</h5>
                        <p class="text-gray-500 text-xs leading-relaxed uppercase tracking-wider">Billets 100% garantis et cryptés.</p>
                    </div>
                    <div class="group cursor-default">
                        <div class="w-12 h-12 rounded-full bg-[#d4af37]/10 flex items-center justify-center mb-4 group-hover:bg-[#d4af37] transition-colors duration-300">
                            <i class='bx bxs-diamond text-2xl text-[#d4af37] group-hover:text-black transition-colors'></i>
                        </div>
                        <h5 class="text-white font-bold text-sm uppercase tracking-widest mb-2">Service VIP</h5>
                        <p class="text-gray-500 text-xs leading-relaxed uppercase tracking-wider">Accès salons et conciergerie.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- MATCHES SECTION (DYNAMIQUE PHP) -->
    <section id="matches" class="bg-[#010101] py-32 px-6 border-t border-white/5">
        <div class="max-w-7xl mx-auto mb-16 text-center">
            <h2 class="text-4xl md:text-5xl font-black uppercase tracking-tighter text-white mb-4">Prochains <span class="text-[#d4af37] italic">Chocs</span></h2>
            <div class="w-24 h-1 bg-[#d4af37] mx-auto"></div>
        </div>

        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <?php
            // Données simulées (Normalement venant de la base de données)
            $matches = [
                [
                    'team1' => 'Real Madrid',
                    'logo1' => 'https://upload.wikimedia.org/wikipedia/en/thumb/5/56/Real_Madrid_CF.svg/1200px-Real_Madrid_CF.svg.png',
                    'team2' => 'Wydad AC',
                    'logo2' => 'https://upload.wikimedia.org/wikipedia/fr/thumb/d/d4/Wydad_Athletic_Club_logo.png/800px-Wydad_Athletic_Club_logo.png',
                    'date' => '15 Jan',
                    'time' => '20:45',
                    'city' => 'Marrakech',
                    'price' => 450,
                    'image_bg' => '../../public/assets/image/stade.jpeg'
                ],
                [
                    'team1' => 'FC Barcelona',
                    'logo1' => 'https://upload.wikimedia.org/wikipedia/en/thumb/4/47/FC_Barcelona_%28crest%29.svg/1200px-FC_Barcelona_%28crest%29.svg.png',
                    'team2' => 'Raja CA',
                    'logo2' => 'https://upload.wikimedia.org/wikipedia/en/thumb/8/81/Raja_Club_Athletic_Logo.svg/1200px-Raja_Club_Athletic_Logo.svg.png',
                    'date' => '22 Jan',
                    'time' => '19:00',
                    'city' => 'Casablanca',
                    'price' => 300,
                    'image_bg' => 'https://images.unsplash.com/photo-1577223625816-7546f13df25d?q=80&w=1000'
                ],
                [
                    'team1' => 'PSG',
                    'logo1' => 'https://upload.wikimedia.org/wikipedia/en/thumb/a/a7/Paris_Saint-Germain_F.C..svg/1200px-Paris_Saint-Germain_F.C..svg.png',
                    'team2' => 'AS FAR',
                    'logo2' => 'https://upload.wikimedia.org/wikipedia/en/thumb/6/66/AS_FAR_Logo.svg/1200px-AS_FAR_Logo.svg.png',
                    'date' => '05 Fev',
                    'time' => '21:00',
                    'city' => 'Rabat',
                    'price' => 250,
                    'image_bg' => 'https://images.unsplash.com/photo-1522778119026-d647f0565c6a?q=80&w=1000'
                ]
            ];

            // Boucle pour générer les cartes
            foreach ($matches as $match): ?>
                
                <div class="relative group h-[500px] w-full rounded-[40px] overflow-hidden border border-white/10 transition-all duration-700 hover:border-[#d4af37]/50 hover:shadow-[0_0_40px_rgba(212,175,55,0.1)] reveal-on-scroll">
                    
                    <!-- Background Image -->
                    <div class="absolute inset-0 z-0">
                        <img src="<?= $match['image_bg'] ?>" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110 grayscale group-hover:grayscale-0" alt="Stadium">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/60 to-black/20 opacity-90"></div>
                    </div>

                    <!-- Content -->
                    <div class="relative z-10 h-full p-8 flex flex-col justify-between">
                        
                        <!-- Top Info -->
                        <div class="flex justify-between items-start">
                            <span class="bg-[#d4af37] text-black text-[9px] font-black px-3 py-1 rounded-full tracking-widest shadow-lg">VIP</span>
                            <div class="flex items-center gap-2 text-white/80 text-[10px] font-bold tracking-widest uppercase bg-black/40 px-3 py-1 rounded-full backdrop-blur-md border border-white/10">
                                <i class='bx bxs-calendar text-[#d4af37]'></i>
                                <?= $match['date'] ?> • <?= $match['time'] ?>
                            </div>
                        </div>

                        <!-- Teams -->
                        <div class="flex items-center justify-between py-6">
                            <div class="text-center w-1/3 group-hover:-translate-x-2 transition-transform duration-500">
                                <img src="<?= $match['logo1'] ?>" class="w-16 h-16 mx-auto object-contain drop-shadow-2xl" alt="<?= $match['team1'] ?>">
                                <h3 class="mt-3 text-[10px] font-black tracking-widest uppercase text-white"><?= $match['team1'] ?></h3>
                            </div>

                            <div class="flex flex-col items-center justify-center w-1/3">
                                <div class="text-4xl font-black italic text-[#d4af37] tracking-tighter">VS</div>
                                <span class="text-[8px] uppercase tracking-widest text-gray-400 mt-1"><?= $match['city'] ?></span>
                            </div>

                            <div class="text-center w-1/3 group-hover:translate-x-2 transition-transform duration-500">
                                <img src="<?= $match['logo2'] ?>" class="w-16 h-16 mx-auto object-contain drop-shadow-2xl" alt="<?= $match['team2'] ?>">
                                <h3 class="mt-3 text-[10px] font-black tracking-widest uppercase text-white"><?= $match['team2'] ?></h3>
                            </div>
                        </div>

                        <!-- Footer / Price -->
                        <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-[25px] p-5 flex items-center justify-between group-hover:bg-[#d4af37] group-hover:border-[#d4af37] transition-all duration-300">
                            <div class="flex flex-col group-hover:text-black">
                                <span class="text-[8px] text-gray-400 group-hover:text-black/60 font-bold uppercase tracking-widest">À partir de</span>
                                <span class="text-xl font-black text-white group-hover:text-black italic tracking-tighter"><?= $match['price'] ?> <small class="text-[9px]">MAD</small></span>
                            </div>
                            <button class="w-10 h-10 bg-white text-black rounded-full flex items-center justify-center hover:scale-110 transition-transform">
                                <i class='bx bx-right-arrow-alt text-xl'></i>
                            </button>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>
    </section>

    <?php require_once __DIR__ . '/layouts/footer.php'; ?>

    <script src="../../public/assets/js/home.js"></script>
    <script src="../../public/assets/js/nabar.js"></script>
    
    <!-- Script simple pour l'animation au scroll -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('reveal-visible');
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.reveal-on-scroll').forEach((el) => observer.observe(el));
        });
    </script>
</body>
</html>