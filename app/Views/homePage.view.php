<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuyMatch | Premium Ticket Experience</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --gold: #d4af37;
            --dark: #020202;
            --darker: #010101;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: var(--dark);
            color: white;
            font-family: 'Geist', system-ui, sans-serif;
            overflow-x: hidden;
        }
        
        .gold-text {
            color: var(--gold);
        }
        
        .gold-shine {
            background: linear-gradient(to right, #bf953f, #fcf6ba, #b38728, #fbf5b7, #aa771c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: all 1s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .reveal-visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        .glow-gold {
            box-shadow: 0 0 30px rgba(212, 175, 55, 0.3);
        }
        
        .card-hover {
            transition: all 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .card-hover:hover {
            border-color: rgba(212, 175, 55, 0.5);
            box-shadow: 0 0 40px rgba(212, 175, 55, 0.1);
        }
        
        .card-hover:hover img {
            filter: grayscale(0%);
            transform: scale(1);
        }
        
        .card-hover img {
            transition: all 1s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            filter: grayscale(100%);
            transform: scale(1.1);
        }
        
        .ping {
            animation: ping 2s cubic-bezier(0, 0, 0.2, 1) infinite;
        }
        
        @keyframes ping {
            75%, 100% {
                transform: scale(2);
                opacity: 0;
            }
        }
        
        .pulse-slow {
            animation: pulse 10s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }
        
        .bounce {
            animation: bounce 2s infinite;
        }
        
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body>
    <!-- NAVBAR -->


    <?php require __DIR__ . '/layouts/navbar.php'; ?>

    <!-- HERO SECTION -->
    <header class="relative min-h-screen flex items-center justify-center overflow-hidden pt-20">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1459749411175-04bf5292ceea?q=80&w=1500&h=900&fit=crop" 
                 alt="Stadium" 
                 class="w-full h-full object-cover opacity-30 pulse-slow">
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/80 to-transparent"></div>
        </div>

        <div class="relative z-10 max-w-5xl text-center space-y-8 px-4 reveal-on-scroll">
            <div class="inline-flex items-center gap-3 px-5 py-2 rounded-full border border-gold/30 bg-black/50 backdrop-blur-md text-gold text-xs font-bold uppercase tracking-widest">
                <span class="relative flex h-2 w-2">
                    <span class="ping absolute inset-0 rounded-full bg-gold opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-gold"></span>
                </span>
                Saison 2026 • Billetterie Ouverte
            </div>
            
            <h1 class="text-6xl md:text-8xl font-black tracking-tighter leading-none drop-shadow-2xl">
                PRESTIGE<br>
                <span class="gold-shine italic">BuyMatch</span>
            </h1>
            
            <p class="text-gray-400 text-sm md:text-base tracking-widest uppercase max-w-2xl mx-auto font-light border-t border-white/10 pt-6">
                L'élite du sport à portée de main
            </p>
            
            <div class="pt-8">
                <a href="#matches" class="inline-block bg-gold text-black px-8 py-4 rounded-full font-black uppercase tracking-widest hover:bg-white transition-all duration-300 glow-gold">
                    Réserver Maintenant
                </a>
            </div>
        </div>

        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 bounce">
            <span class="text-xs uppercase tracking-widest text-gray-500">Scroll</span>
            <i class="fas fa-chevron-down text-gold text-2xl"></i>
        </div>
    </header>

    <!-- ABOUT SECTION -->
    <section id="about" class="py-32 px-6 lg:px-20 relative overflow-hidden bg-black">
        <div class="absolute top-20 right-[-5%] text-9xl md:text-[200px] font-black opacity-[0.02] select-none pointer-events-none tracking-tighter italic text-white">
            HISTORY
        </div>

        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center gap-16 lg:gap-24">
            <div class="w-full lg:w-1/2 relative reveal-on-scroll">
                <div class="absolute -top-6 -left-6 w-32 h-32 border-t-2 border-l-2 border-gold/30 z-0"></div>
                
                <div class="relative z-10 rounded-3xl overflow-hidden group border border-white/5 shadow-2xl h-96">
                    <img src="https://images.unsplash.com/photo-1510563800743-aed236490d08?q=80&w=800" 
                        class="w-full h-full object-cover"
                        alt="BuyMatch Experience">
                    
                    <div class="absolute bottom-8 left-8 bg-gold/90 backdrop-blur-sm p-6 rounded-2xl shadow-2xl transform group-hover:-translate-y-2 transition-transform border border-white/20">
                        <p class="text-black font-black text-3xl leading-none">10Y</p>
                        <p class="text-black text-xs font-bold uppercase tracking-widest mt-1">D'Excellence</p>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/2 space-y-10 reveal-on-scroll">
                <div class="space-y-4">
                    <h4 class="text-gold text-xs font-bold uppercase tracking-widest flex items-center gap-4">
                        <span class="w-12 h-px bg-gold"></span> Notre Vision
                    </h4>
                    <h2 class="text-4xl md:text-5xl font-black tracking-tighter leading-tight uppercase">
                        Plus qu'un Ticket,<br><span class="gold-shine italic">Une Légende</span>
                    </h2>
                </div>

                <p class="text-gray-400 text-lg font-light leading-relaxed border-l-2 border-gold/20 pl-8 italic">
                    "Nous avons créé BuyMatch pour ceux qui ne se contentent pas de regarder le match, mais qui veulent le vivre avec privilège, confort et exclusivité."
                </p>

                <div class="grid grid-cols-2 gap-12 pt-4 border-t border-white/5 mt-8">
                    <div class="group cursor-default">
                        <div class="w-12 h-12 rounded-full bg-gold/10 flex items-center justify-center mb-4 group-hover:bg-gold transition-colors duration-300">
                            <i class="fas fa-check text-2xl gold-text group-hover:text-black transition-colors"></i>
                        </div>
                        <h5 class="text-white font-bold text-sm uppercase tracking-widest mb-2">Sécurité Elite</h5>
                        <p class="text-gray-500 text-xs leading-relaxed uppercase tracking-wider">Billets 100% garantis</p>
                    </div>
                    <div class="group cursor-default">
                        <div class="w-12 h-12 rounded-full bg-gold/10 flex items-center justify-center mb-4 group-hover:bg-gold transition-colors duration-300">
                            <i class="fas fa-gem text-2xl gold-text group-hover:text-black transition-colors"></i>
                        </div>
                        <h5 class="text-white font-bold text-sm uppercase tracking-widest mb-2">Service VIP</h5>
                        <p class="text-gray-500 text-xs leading-relaxed uppercase tracking-wider">Accès salons premium</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- MATCHES SECTION -->
    <section id="matches" class="bg-black py-32 px-6 border-t border-white/5">
        <div class="max-w-7xl mx-auto mb-16 text-center">
            <h2 class="text-4xl md:text-5xl font-black uppercase tracking-tighter text-white mb-4">
                Prochains <span class="gold-text italic">Chocs</span>
            </h2>
            <div class="w-24 h-1 bg-gold mx-auto"></div>
        </div>

        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">


            <!-- Match Card 3 -->
             <?php foreach ($events as $event): 

                $path_mignature= '../../public/uploads_mignature/' . $event['event']->getMignature();   
                $path_equipe_1= '../../public/uploads_logo_equipe/' . $event['equipe1']->getLogo();
                $path_equipe_2= '../../public/uploads_logo_equipe/' . $event['equipe2']->getLogo();
                $date_event = new DateTime($event['event']->getDateEvent());
                $formatted_date = $date_event->format('d M Y');
                $formatted_time = $date_event->format('H:i');
                ?>
                <div class="relative group h-[500px] w-full rounded-[40px] overflow-hidden border border-white/5 card-hover reveal-on-scroll transition-all duration-700 hover:border-gold/30">
                    <img src="<?php echo $path_mignature; ?>"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110 grayscale-[0.3] group-hover:grayscale-0"
                        alt="Stadium">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-[#020202] via-[#020202]/70 to-transparent opacity-95"></div>

                    <div class="relative z-10 h-full p-10 flex flex-col justify-between">
                        <div class="flex justify-between items-start">
                            <span class="bg-gold/10 backdrop-blur-md text-gold text-[9px] font-black px-4 py-1.5 rounded-full tracking-[3px] border border-gold/20 uppercase">
                                UCL Matchday
                            </span>
                            <div class="flex flex-col items-end gap-1">
                                <div class="flex items-center gap-2 text-white text-xs font-black tracking-widest uppercase">
                                    <i class="bx bxs-calendar text-gold"></i>
                                    <?= $formatted_date; ?>
                                </div>
                                <span class="text-[10px] text-gray-400 font-bold tracking-widest uppercase"><?= $formatted_time; ?> GMT+1</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between py-10 relative">
                            <div class="text-center w-1/3 transition-all duration-500 group-hover:-translate-x-3">
                                <div class="relative mb-4 inline-block">
                                    <div class="absolute inset-0 bg-gold/20 blur-xl rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    <img src="<?php echo $path_equipe_1; ?>" 
                                        class="w-20 h-20 object-contain relative z-10 drop-shadow-2xl" alt="PSG">
                                </div>
                                <h3 class="text-sm font-black tracking-[4px] uppercase text-white"><?= $event['equipe1']->getNom(); ?></h3>
                            </div>

                            <div class="flex flex-col items-center justify-center w-1/3">
                                <div class="h-[1px] w-full bg-gradient-to-r from-transparent via-gold/50 to-transparent mb-2"></div>
                                <div class="text-4xl font-black italic gold-gradient tracking-tighter">VS</div>
                                <div class="h-[1px] w-full bg-gradient-to-r from-transparent via-gold/50 to-transparent mt-2"></div>
                                <span class="text-[9px] uppercase tracking-[4px] text-gray-500 font-black mt-4"><?= $event['event']->getLieu(); ?></span>
                            </div>

                            <div class="text-center w-1/3 transition-all duration-500 group-hover:translate-x-3">
                                <div class="relative mb-4 inline-block">
                                    <div class="absolute inset-0 bg-gold/20 blur-xl rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    <img src="<?php echo $path_equipe_1; ?>" 
                                        class="w-20 h-20 object-contain relative z-10 drop-shadow-2xl" alt="AS FAR">
                                </div>
                                <h3 class="text-sm font-black tracking-[4px] uppercase text-white"><?= $event['equipe2']->getNom(); ?></h3>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-white/5">
                            <a href="EventDetailsController.php?id=<?= $event['event']->getId(); ?>       ">
                                <button class="w-full group/btn relative overflow-hidden bg-white/5 backdrop-blur-md border border-white/10 py-5 rounded-[20px] transition-all duration-500 hover:border-gold/50">
                                    <div class="absolute inset-0 bg-gold translate-y-[100%] group-hover/btn:translate-y-0 transition-transform duration-500"></div>
                                    
                                    <div class="relative z-10 flex items-center justify-center gap-3">
                                        <span class="text-[11px] font-black uppercase tracking-[4px] text-white group-hover/btn:text-black transition-colors">
                                            View Match Details
                                        </span>
                                        <i class='bx bx-right-top-arrow-circle text-xl text-gold group-hover/btn:text-black transition-colors'></i>
                                    </div>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- CONTACT SECTION -->
    <section id="contact" class="py-32 px-6 lg:px-20 bg-black border-t border-white/5">
        <div class="max-w-7xl mx-auto text-center space-y-16">
            <div class="space-y-4">
                <h2 class="text-4xl md:text-5xl font-black uppercase tracking-tighter">
                    Prêt à Réserver? <span class="gold-shine italic">Commencez</span>
                </h2>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                    Rejoignez des milliers de supporters qui vivent l'expérience VIP avec BuyMatch
                </p>
            </div>

            <button class="bg-gold text-black px-10 py-5 rounded-full font-black uppercase tracking-widest text-lg hover:bg-white transition-all duration-300 glow-gold reveal-on-scroll">
                S'Enregistrer Maintenant
            </button>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-black border-t border-white/5 py-16 px-6 lg:px-20">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
            <div>
                <h3 class="text-xl font-black tracking-tighter mb-6">BUYMATCH</h3>
                <p class="text-gray-500 text-sm">L'élite du sport à portée de main.</p>
            </div>
            <div>
                <h4 class="font-bold uppercase tracking-widest mb-4 text-gold">Liens</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="#" class="hover:gold-text transition">Accueil</a></li>
                    <li><a href="#matches" class="hover:gold-text transition">Matches</a></li>
                    <li><a href="#about" class="hover:gold-text transition">À Propos</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold uppercase tracking-widest mb-4 text-gold">Legal</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="#" class="hover:gold-text transition">Conditions</a></li>
                    <li><a href="#" class="hover:gold-text transition">Confidentialité</a></li>
                    <li><a href="#" class="hover:gold-text transition">Cookies</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold uppercase tracking-widest mb-4 text-gold">Contact</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li>Email: info@buymatch.com</li>
                    <li>Tel: +212 5XX XXX XXX</li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto border-t border-white/10 mt-12 pt-8 text-center text-gray-500 text-sm">
            <p>&copy; 2026 BuyMatch. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Scroll reveal animation
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('reveal-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal-on-scroll').forEach(el => observer.observe(el));

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add scroll effect to navbar
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('nav');
            if (window.scrollY > 0) {
                navbar.style.borderColor = 'rgba(212, 175, 55, 0.2)';
            } else {
                navbar.style.borderColor = 'rgba(255, 255, 255, 0.1)';
            }
        });
    </script>
</body>
</html>
        