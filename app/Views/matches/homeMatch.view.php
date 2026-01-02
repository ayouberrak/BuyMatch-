<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuyMatch | Match Center Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap');
        
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: #020202; 
            color: white; 
            overflow-x: hidden;
        }

        /* Glassmorphism */
        .glass-nav { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(15px); border: 1px solid rgba(255, 255, 255, 0.08); }
        .glass-panel { background: rgba(10, 10, 10, 0.6); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.08); }
        
        /* Match Card 3D Effect */
        .match-card {
            height: 550px;
            transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
            perspective: 1000px;
            transform-style: preserve-3d;
        }
        
        .match-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 30px 60px -15px rgba(212, 175, 55, 0.15);
            border-color: rgba(212, 175, 55, 0.4);
        }

        /* Gold Gradient Text */
        .gold-gradient {
            background: linear-gradient(135deg, #bf953f, #fcf6ba, #b38728, #fbf5b7, #aa771c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Animations */
        .reveal { opacity: 0; transform: translateY(30px); transition: all 0.8s ease-out; }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        /* Custom Scrollbar */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        /* Date Active State */
        .date-btn.active {
            background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%);
            color: black;
            box-shadow: 0 0 25px rgba(212, 175, 55, 0.4);
            transform: scale(1.05);
            border: none;
        }
        .date-btn.active span { opacity: 1; }
    </style>
</head>
<body class="bg-[#020202]">

    <?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

    <!-- Simuler des données (A REMPLACER PAR TA DB) -->
    <?php
    $matches = [
        [
            'teamA' => 'Real Madrid', 'logoA' => 'https://upload.wikimedia.org/wikipedia/en/thumb/5/56/Real_Madrid_CF.svg/1200px-Real_Madrid_CF.svg.png',
            'teamB' => 'Barcelona', 'logoB' => 'https://upload.wikimedia.org/wikipedia/en/thumb/4/47/FC_Barcelona_%28crest%29.svg/1200px-FC_Barcelona_%28crest%29.svg.png',
            'stade' => 'Bernabéu', 'time' => '21:00', 'price' => 850, 'status' => 'live', 'bg' => 'https://images.unsplash.com/photo-1510563800743-aed236490d08?q=80&w=1000'
        ],
        [
            'teamA' => 'Wydad AC', 'logoA' => 'https://upload.wikimedia.org/wikipedia/fr/thumb/d/d4/Wydad_Athletic_Club_logo.png/800px-Wydad_Athletic_Club_logo.png',
            'teamB' => 'Raja CA', 'logoB' => 'https://upload.wikimedia.org/wikipedia/en/thumb/8/81/Raja_Club_Athletic_Logo.svg/1200px-Raja_Club_Athletic_Logo.svg.png',
            'stade' => 'Mohammed V', 'time' => '20:00', 'price' => 450, 'status' => 'soon', 'bg' => 'https://images.unsplash.com/photo-1577223625816-7546f13df25d?q=80&w=1000'
        ],
        [
            'teamA' => 'PSG', 'logoA' => 'https://upload.wikimedia.org/wikipedia/en/thumb/a/a7/Paris_Saint-Germain_F.C..svg/1200px-Paris_Saint-Germain_F.C..svg.png',
            'teamB' => 'Man City', 'logoB' => 'https://upload.wikimedia.org/wikipedia/en/thumb/e/eb/Manchester_City_FC_badge.svg/1200px-Manchester_City_FC_badge.svg.png',
            'stade' => 'Parc des Princes', 'time' => '19:45', 'price' => 1200, 'status' => 'soon', 'bg' => 'https://images.unsplash.com/photo-1522778119026-d647f0565c6a?q=80&w=1000'
        ],
        [
            'teamA' => 'Bayern', 'logoA' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/FC_Bayern_M%C3%BCnchen_logo_%282017%29.svg/1200px-FC_Bayern_M%C3%BCnchen_logo_%282017%29.svg.png',
            'teamB' => 'Arsenal', 'logoB' => 'https://upload.wikimedia.org/wikipedia/en/thumb/5/53/Arsenal_FC.svg/1200px-Arsenal_FC.svg.png',
            'stade' => 'Allianz Arena', 'time' => '21:00', 'price' => 900, 'status' => 'soon', 'bg' => 'https://images.unsplash.com/photo-1504159506876-f8338247a14a?q=80&w=1000'
        ]
    ];
    ?>

    <main class="max-w-[1600px] mx-auto px-6 pt-32 pb-20">
        
        <!-- HEADER SECTION -->
        <section class="mb-16 reveal">
            <div class="flex flex-col xl:flex-row xl:items-end justify-between gap-10">
                <div class="space-y-4">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-[#d4af37]/30 bg-[#d4af37]/5 text-[#d4af37] text-[10px] font-bold uppercase tracking-[3px]">
                        <span class="w-2 h-2 rounded-full bg-[#d4af37] animate-pulse"></span> Match Center
                    </div>
                    <h1 class="text-5xl md:text-6xl font-black tracking-tighter uppercase italic leading-none">
                        Vivez <span class="gold-gradient">L'Intensité.</span>
                    </h1>
                </div>
                
                <!-- DATE PICKER DYNAMIQUE -->
                <div class="flex gap-4 overflow-x-auto no-scrollbar pb-4 px-2 w-full xl:w-auto">
                    <?php 
                    $date = new DateTime();
                    for($i=0; $i<7; $i++): 
                        $isActive = $i === 0 ? 'active' : '';
                        $dayNum = $date->format('d');
                        $month = strtoupper(substr($date->format('F'), 0, 3));
                    ?>
                    <button class="date-btn <?= $isActive ?> flex-shrink-0 w-20 h-24 md:w-24 md:h-28 rounded-[25px] glass-nav flex flex-col items-center justify-center border border-white/5 hover:border-[#d4af37]/50 transition-all duration-300 group">
                        <span class="text-[9px] font-bold uppercase opacity-50 group-hover:opacity-100 transition-opacity mb-1"><?= $month ?></span>
                        <span class="text-2xl md:text-3xl font-black italic"><?= $dayNum ?></span>
                        <?php if($i===0): ?> <span class="text-[8px] font-black uppercase text-[#d4af37] mt-1 tracking-widest bg-black/20 px-2 rounded-full">Auj</span> <?php endif; ?>
                    </button>
                    <?php $date->modify('+1 day'); endfor; ?>
                </div>
            </div>
        </section>

        <div class="flex flex-col lg:flex-row gap-12">
            
            <!-- SIDEBAR FILTRES -->
            <aside class="w-full lg:w-80 space-y-6 reveal" style="transition-delay: 100ms;">
                <div class="glass-panel rounded-[40px] p-8 sticky top-32">
                    <div class="flex justify-between items-center mb-8">
                        <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-[4px]">Filtres</h3>
                        <button class="text-[9px] text-[#d4af37] font-bold uppercase hover:underline">Reset</button>
                    </div>

                    <div class="relative mb-8 group">
                        <i class='bx bx-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 group-focus-within:text-[#d4af37] transition-colors'></i>
                        <input type="text" placeholder="Rechercher une équipe..." class="w-full bg-black/40 border border-white/10 rounded-2xl py-4 pl-12 pr-4 text-xs font-bold text-white placeholder-gray-600 focus:border-[#d4af37] focus:outline-none transition-all">
                    </div>

                    <nav class="space-y-3">
                        <p class="text-[9px] font-bold text-gray-600 uppercase tracking-widest mb-3 pl-2">Compétitions</p>
                        
                        <a href="#" class="flex items-center justify-between p-4 rounded-2xl bg-[#d4af37]/10 border border-[#d4af37]/30 group transition-all">
                            <div class="flex items-center gap-3">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/0f/LaLiga_logo_2023.svg/1200px-LaLiga_logo_2023.svg.png" class="w-5 h-5 object-contain grayscale group-hover:grayscale-0 transition-all" alt="Liga">
                                <span class="text-xs font-black uppercase tracking-widest text-white">La Liga</span>
                            </div>
                            <span class="text-[9px] bg-[#d4af37] text-black px-2 py-0.5 rounded font-black">12</span>
                        </a>

                        <a href="#" class="flex items-center justify-between p-4 rounded-2xl border border-transparent hover:bg-white/5 hover:border-white/10 group transition-all">
                            <div class="flex items-center gap-3">
                                <img src="https://upload.wikimedia.org/wikipedia/fr/thumb/f/f2/Logo_Botola_Pro_Inwi.png/1200px-Logo_Botola_Pro_Inwi.png" class="w-5 h-5 object-contain grayscale group-hover:grayscale-0 opacity-50 group-hover:opacity-100 transition-all" alt="Botola">
                                <span class="text-xs font-bold text-gray-400 group-hover:text-white uppercase tracking-widest transition-all">Botola Pro</span>
                            </div>
                            <span class="text-[9px] text-gray-600 font-bold group-hover:text-white">05</span>
                        </a>

                        <a href="#" class="flex items-center justify-between p-4 rounded-2xl border border-transparent hover:bg-white/5 hover:border-white/10 group transition-all">
                            <div class="flex items-center gap-3">
                                <img src="https://upload.wikimedia.org/wikipedia/en/thumb/f/f5/UEFA_Champions_League.svg/1200px-UEFA_Champions_League.svg.png" class="w-5 h-5 object-contain grayscale group-hover:grayscale-0 opacity-50 group-hover:opacity-100 transition-all" alt="UCL">
                                <span class="text-xs font-bold text-gray-400 group-hover:text-white uppercase tracking-widest transition-all">Champions League</span>
                            </div>
                            <span class="text-[9px] text-gray-600 font-bold group-hover:text-white">08</span>
                        </a>
                    </nav>
                </div>
            </aside>

            <!-- MATCH GRID -->
            <div class="flex-1 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                
                <?php foreach($matches as $index => $match): ?>
                <div class="reveal match-card group relative rounded-[40px] overflow-hidden border border-white/5 bg-[#050505]" style="transition-delay: <?= $index * 100 ?>ms;">
                    
                    <!-- Background Image -->
                    <div class="absolute inset-0 z-0">
                        <img src="<?= $match['bg'] ?>" class="w-full h-full object-cover transition-transform duration-[1.5s] group-hover:scale-110 grayscale group-hover:grayscale-0" alt="Stadium">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#020202] via-[#020202]/50 to-transparent opacity-90"></div>
                    </div>

                    <!-- Content -->
                    <div class="relative z-10 h-full p-6 flex flex-col justify-between">
                        
                        <!-- Top Bar -->
                        <div class="flex justify-between items-start">
                            <?php if($match['status'] === 'live'): ?>
                                <div class="flex items-center gap-2 bg-red-600/20 border border-red-500/50 backdrop-blur-md px-3 py-1.5 rounded-full">
                                    <span class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                                    <span class="text-[8px] font-black text-red-500 uppercase tracking-widest">En Direct</span>
                                </div>
                            <?php else: ?>
                                <span class="bg-black/40 border border-white/10 backdrop-blur-md text-gray-300 text-[8px] font-black px-3 py-1.5 rounded-full uppercase tracking-widest">Bientôt</span>
                            <?php endif; ?>

                            <button class="bg-black/20 backdrop-blur-md w-10 h-10 rounded-full border border-white/10 flex items-center justify-center hover:bg-[#d4af37] hover:border-[#d4af37] hover:text-black transition-all group/btn">
                                <i class='bx bx-bookmark text-lg group-hover/btn:scale-110 transition-transform'></i>
                            </button>
                        </div>

                        <!-- Teams Display -->
                        <div class="flex flex-col items-center justify-center group-hover:-translate-y-6 transition-transform duration-500">
                            <div class="flex items-center justify-between w-full px-2">
                                <!-- Team A -->
                                <div class="flex flex-col items-center gap-3 w-1/3">
                                    <div class="w-16 h-16 bg-white/5 backdrop-blur-xl rounded-2xl flex items-center justify-center border border-white/10 group-hover:border-[#d4af37]/30 shadow-2xl transition-all duration-500 group-hover:scale-110">
                                        <img src="<?= $match['logoA'] ?>" class="w-10 h-10 object-contain drop-shadow-lg" alt="<?= $match['teamA'] ?>">
                                    </div>
                                    <p class="text-[10px] font-black uppercase tracking-widest text-center leading-tight"><?= $match['teamA'] ?></p>
                                </div>

                                <!-- VS -->
                                <div class="flex flex-col items-center w-1/3">
                                    <span class="text-4xl font-black italic text-[#d4af37] opacity-20 group-hover:opacity-100 transition-opacity duration-500 tracking-tighter">VS</span>
                                    <span class="text-[9px] font-bold text-gray-500 uppercase mt-1 tracking-widest"><?= $match['time'] ?></span>
                                </div>

                                <!-- Team B -->
                                <div class="flex flex-col items-center gap-3 w-1/3">
                                    <div class="w-16 h-16 bg-white/5 backdrop-blur-xl rounded-2xl flex items-center justify-center border border-white/10 group-hover:border-[#d4af37]/30 shadow-2xl transition-all duration-500 group-hover:scale-110">
                                        <img src="<?= $match['logoB'] ?>" class="w-10 h-10 object-contain drop-shadow-lg" alt="<?= $match['teamB'] ?>">
                                    </div>
                                    <p class="text-[10px] font-black uppercase tracking-widest text-center leading-tight"><?= $match['teamB'] ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Bottom Panel -->
                        <div class="glass-panel rounded-[30px] p-5 border-white/5 group-hover:border-[#d4af37]/30 transition-all duration-500 translate-y-2 group-hover:translate-y-0">
                            <div class="flex items-center gap-2 mb-4 text-gray-400">
                                <i class='bx bxs-map text-[#d4af37]'></i>
                                <span class="text-[9px] font-bold uppercase tracking-widest truncate"><?= $match['stade'] ?></span>
                            </div>

                            <div class="flex items-center justify-between border-t border-white/5 pt-4">
                                <div class="flex flex-col">
                                    <span class="text-[8px] text-gray-500 font-bold uppercase tracking-wider">Prix Standard</span>
                                    <span class="text-xl font-black italic text-white tracking-tighter"><?= $match['price'] ?> <span class="text-[9px] text-[#d4af37] not-italic">DH</span></span>
                                </div>
                                <a href="reservation.php?id=<?= $index ?>" class="bg-white text-black h-10 px-6 rounded-xl text-[9px] font-black uppercase tracking-[2px] flex items-center hover:bg-[#d4af37] hover:scale-105 transition-all shadow-lg shadow-black/50">
                                    Réserver
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
                <?php endforeach; ?>
            </div>

        </div>
    </main>

    <?php require_once __DIR__ . '/../layouts/footer.php'; ?>

    <script>
        // Reveal Effect
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // Date Selection
        const dateBtns = document.querySelectorAll('.date-btn');
        dateBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                dateBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
            });
        });
    </script>

</body>
</html>