<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuyMatch | Réservation Exclusive</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/assets/css/home.css">
    <link rel="stylesheet" href="../../../public/assets/css/navbar.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: #020202; 
            color: white; 
            overflow-x: hidden;
        }

        /* Glassmorphism */
        .glass-panel { 
            background: rgba(10, 10, 10, 0.6); 
            backdrop-filter: blur(20px); 
            -webkit-backdrop-filter: blur(20px); 
            border: 1px solid rgba(255, 255, 255, 0.08); 
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        /* Gold Gradient Text */
        .gold-text {
            background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Interactive Stadium Map */
        .stadium-path {
            fill: rgba(255, 255, 255, 0.05);
            stroke: rgba(255, 255, 255, 0.1);
            stroke-width: 1.5;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }
        
        .stadium-path:hover {
            fill: rgba(212, 175, 55, 0.3);
            stroke: #d4af37;
            filter: drop-shadow(0 0 15px rgba(212, 175, 55, 0.4));
        }

        .stadium-path.selected {
            fill: #d4af37;
            stroke: white;
            filter: drop-shadow(0 0 20px rgba(212, 175, 55, 0.6));
        }

        /* Custom Quantity Selector */
        .qty-btn {
            width: 32px; height: 32px;
            border-radius: 8px;
            background: rgba(255,255,255,0.05);
            display: flex; align-items: center; justify-content: center;
            transition: all 0.2s;
        }
        .qty-btn:hover { background: #d4af37; color: black; }

        /* Animations */
        .fade-in-up { animation: fadeInUp 0.8s ease-out forwards; opacity: 0; transform: translateY(20px); }
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        
        @keyframes fadeInUp { to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="pb-20 bg-[#020202]">

    <?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

    <!-- Données du Match (Simulées) -->
    <?php
        $match_data = [
            'teamA' => 'Real Madrid',
            'logoA' => 'https://upload.wikimedia.org/wikipedia/en/thumb/5/56/Real_Madrid_CF.svg/1200px-Real_Madrid_CF.svg.png',
            'teamB' => 'Wydad AC',
            'logoB' => 'https://upload.wikimedia.org/wikipedia/fr/thumb/d/d4/Wydad_Athletic_Club_logo.png/800px-Wydad_Athletic_Club_logo.png',
            'date' => '15 Jan 2026',
            'time' => '20:45',
            'stadium' => 'Grand Stade de Marrakech',
            'weather' => '18°C',
            'bg_image' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?q=80&w=2000'
        ];
    ?>

    <!-- HERO HEADER -->
    <header class="relative h-[60vh] w-full overflow-hidden flex items-center justify-center mt-0">
        <div class="absolute inset-0 z-0">
            <img src="<?= $match_data['bg_image'] ?>" class="w-full h-full object-cover opacity-30 scale-105 animate-[pulse_10s_ease-in-out_infinite]" alt="Stadium">
            <div class="absolute inset-0 bg-gradient-to-t from-[#020202] via-[#020202]/50 to-transparent"></div>
        </div>
        
        <div class="relative z-10 text-center px-4 w-full max-w-5xl fade-in-up">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-[#d4af37]/30 bg-[#d4af37]/10 mb-8 backdrop-blur-md">
                <span class="w-2 h-2 rounded-full bg-[#d4af37] animate-pulse"></span>
                <span class="text-[9px] font-black tracking-[3px] text-[#d4af37] uppercase">Match de la semaine</span>
            </div>

            <div class="flex flex-col md:flex-row items-center justify-center gap-8 md:gap-16">
                <!-- Team A -->
                <div class="flex flex-col items-center group">
                    <img src="<?= $match_data['logoA'] ?>" class="w-24 md:w-36 drop-shadow-[0_0_40px_rgba(255,255,255,0.15)] group-hover:scale-110 transition-transform duration-500" alt="<?= $match_data['teamA'] ?>">
                    <h2 class="mt-4 font-black text-xl md:text-3xl tracking-tighter uppercase"><?= $match_data['teamA'] ?></h2>
                </div>
                
                <!-- VS -->
                <div class="flex flex-col items-center">
                    <span class="text-5xl md:text-7xl font-black italic text-white/10 select-none leading-none">VS</span>
                    <div class="mt-[-15px] bg-white/5 border border-white/10 px-5 py-1.5 rounded-xl backdrop-blur-xl">
                        <span class="gold-text font-black tracking-[4px] text-sm">FINAL 2026</span>
                    </div>
                </div>

                <!-- Team B -->
                <div class="flex flex-col items-center group">
                    <img src="<?= $match_data['logoB'] ?>" class="w-24 md:w-36 drop-shadow-[0_0_40px_rgba(255,255,255,0.15)] group-hover:scale-110 transition-transform duration-500" alt="<?= $match_data['teamB'] ?>">
                    <h2 class="mt-4 font-black text-xl md:text-3xl tracking-tighter uppercase"><?= $match_data['teamB'] ?></h2>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 -mt-16 relative z-20 mb-20">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- LEFT COLUMN: INFO & MAP -->
            <div class="lg:col-span-2 space-y-6 fade-in-up delay-100">
                
                <!-- Match Info Bar -->
                <div class="glass-panel rounded-[30px] p-6 grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="border-r border-white/5 pr-4">
                        <p class="text-gray-500 text-[9px] font-black uppercase tracking-widest mb-1">Coup d'envoi</p>
                        <p class="text-white font-bold text-lg flex items-center gap-1"><i class='bx bx-time text-[#d4af37]'></i> <?= $match_data['time'] ?></p>
                    </div>
                    <div class="border-r border-white/5 pr-4 md:pl-4">
                        <p class="text-gray-500 text-[9px] font-black uppercase tracking-widest mb-1">Date</p>
                        <p class="text-white font-bold text-lg"><?= $match_data['date'] ?></p>
                    </div>
                    <div class="border-r border-white/5 pr-4 md:pl-4">
                        <p class="text-gray-500 text-[9px] font-black uppercase tracking-widest mb-1">Stade</p>
                        <p class="text-white font-bold text-lg truncate">Marrakech</p>
                    </div>
                    <div class="md:pl-4">
                        <p class="text-gray-500 text-[9px] font-black uppercase tracking-widest mb-1">Météo</p>
                        <p class="text-white font-bold text-lg flex items-center gap-1"><i class='bx bx-sun text-[#d4af37]'></i> <?= $match_data['weather'] ?></p>
                    </div>
                </div>

                <!-- Interactive Stadium Map -->
                <div class="glass-panel rounded-[40px] p-8 md:p-10 relative overflow-hidden group">
                    <div class="flex justify-between items-end mb-8 relative z-10">
                        <div>
                            <h3 class="text-2xl font-black uppercase tracking-tighter">Plan du <span class="gold-text italic">Stade</span></h3>
                            <p class="text-gray-500 text-xs font-bold uppercase tracking-widest mt-1">Cliquez sur une zone pour réserver</p>
                        </div>
                        
                        <!-- Legend -->
                        <div class="flex gap-4">
                            <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-[#d4af37]"></span><span class="text-[9px] font-bold text-gray-400 uppercase">VIP</span></div>
                            <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-white/20"></span><span class="text-[9px] font-bold text-gray-400 uppercase">Standard</span></div>
                        </div>
                    </div>

                    <!-- SVG Map -->
                    <div class="relative w-full aspect-video mx-auto bg-[#0a0a0a] rounded-[30px] border border-white/5 p-4 shadow-inner">
                        <svg viewBox="0 0 800 500" class="w-full h-full drop-shadow-2xl">
                            <!-- Pitch -->
                            <rect x="220" y="160" width="360" height="180" rx="8" fill="#1a1a1a" stroke="rgba(255,255,255,0.05)" stroke-width="2"/>
                            <line x1="400" y1="160" x2="400" y2="340" stroke="rgba(255,255,255,0.05)" stroke-width="2"/>
                            <circle cx="400" cy="250" r="40" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="2"/>
                            
                            <!-- Zones -->
                            <!-- VIP North -->
                            <path d="M 220 140 L 580 140 L 600 80 L 200 80 Z" 
                                  class="stadium-path" data-name="VIP Prestige Nord" data-price="2500" />
                            
                            <!-- Standard East -->
                            <path d="M 600 160 L 600 340 L 720 380 L 720 120 Z" 
                                  class="stadium-path" data-name="Tribune Est - Fan Zone" data-price="450" />
                            
                            <!-- Standard West -->
                            <path d="M 200 160 L 200 340 L 80 380 L 80 120 Z" 
                                  class="stadium-path" data-name="Tribune Ouest" data-price="600" />
                            
                            <!-- VVIP South -->
                            <path d="M 220 360 L 580 360 L 600 420 L 200 420 Z" 
                                  class="stadium-path selected" data-name="VVIP South Box" data-price="3500" />
                        </svg>

                        <!-- Tooltip Flottant -->
                        <div id="tooltip" class="absolute hidden top-0 left-0 bg-black/80 backdrop-blur-md border border-[#d4af37] px-4 py-2 rounded-xl pointer-events-none transform -translate-x-1/2 -translate-y-full mb-2 z-50">
                            <p id="tooltip-name" class="text-[9px] font-black uppercase text-[#d4af37] tracking-widest"></p>
                            <p id="tooltip-price" class="text-white font-bold"></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: BOOKING FORM (Sticky) -->
            <aside class="relative fade-in-up delay-200">
                <div class="glass-panel rounded-[40px] p-8 sticky top-28 border-[#d4af37]/20 shadow-[0_0_50px_rgba(0,0,0,0.5)]">
                    
                    <div class="mb-8">
                        <h3 class="text-2xl font-black uppercase tracking-tighter">Réserver <span class="gold-text italic">Maintenant</span></h3>
                        <p class="text-gray-500 text-[10px] font-bold uppercase tracking-widest mt-1">Finalisation sécurisée</p>
                    </div>
                    
                    <form action="process_booking.php" method="POST" class="space-y-6">
                        
                        <!-- Zone Selection Display -->
                        <div class="bg-white/5 rounded-2xl p-4 border border-white/5">
                            <p class="text-[9px] font-bold text-gray-500 uppercase tracking-widest mb-1">Zone Sélectionnée</p>
                            <div class="flex justify-between items-center">
                                <span id="selected-zone-name" class="font-black text-white uppercase text-sm">VVIP South Box</span>
                                <i class='bx bxs-check-circle text-[#d4af37]'></i>
                            </div>
                        </div>

                        <!-- Quantity Selector -->
                        <div class="space-y-2">
                            <p class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Nombre de billets</p>
                            <div class="flex items-center justify-between bg-black/40 rounded-2xl p-2 border border-white/10">
                                <button type="button" onclick="updateQty(-1)" class="qty-btn"><i class='bx bx-minus'></i></button>
                                <span id="qty-display" class="font-black text-xl w-10 text-center">1</span>
                                <button type="button" onclick="updateQty(1)" class="qty-btn"><i class='bx bx-plus'></i></button>
                                <input type="hidden" name="quantity" id="qty-input" value="1">
                            </div>
                        </div>

                        <!-- Total Price -->
                        <div class="pt-6 border-t border-white/10">
                            <div class="flex justify-between items-end">
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Total Estimé</span>
                                <div class="text-right">
                                    <span id="total-price" class="text-4xl font-black text-white italic tracking-tighter">3500</span>
                                    <span class="text-[10px] font-black text-[#d4af37] uppercase ml-1">MAD</span>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full bg-white text-black py-4 rounded-2xl font-black uppercase text-[11px] tracking-[3px] hover:bg-[#d4af37] hover:scale-[1.02] transition-all duration-300 shadow-xl group flex items-center justify-center gap-2">
                            <span>Payer la commande</span>
                            <i class='bx bx-right-arrow-alt text-lg group-hover:translate-x-1 transition-transform'></i>
                        </button>

                        <div class="flex justify-center gap-4 opacity-50 grayscale hover:grayscale-0 transition-all duration-500">
                            <i class='bx bxl-visa text-2xl'></i>
                            <i class='bx bxl-mastercard text-2xl'></i>
                            <i class='bx bxs-bank text-2xl'></i>
                        </div>
                    </form>
                </div>
            </aside>

        </div>
    </main>

    <?php require_once __DIR__ . '/../layouts/footer.php'; ?>

    <!-- INTERACTIVE SCRIPT -->
    <script>
        // State
        let currentPrice = 3500;
        let quantity = 1;

        // Elements
        const paths = document.querySelectorAll('.stadium-path');
        const tooltip = document.getElementById('tooltip');
        const tName = document.getElementById('tooltip-name');
        const tPrice = document.getElementById('tooltip-price');
        const zoneNameDisplay = document.getElementById('selected-zone-name');
        const priceDisplay = document.getElementById('total-price');
        const qtyDisplay = document.getElementById('qty-display');
        const qtyInput = document.getElementById('qty-input');

        // Update Total Logic
        function updateTotal() {
            const total = currentPrice * quantity;
            // Animation Number
            animateValue(priceDisplay, parseInt(priceDisplay.innerText), total, 300);
        }

        function animateValue(obj, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                obj.innerHTML = Math.floor(progress * (end - start) + start);
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        }

        // Quantity Logic
        window.updateQty = (change) => {
            let newQty = quantity + change;
            if(newQty >= 1 && newQty <= 10) {
                quantity = newQty;
                qtyDisplay.innerText = quantity;
                qtyInput.value = quantity;
                updateTotal();
            }
        };

        // Stadium Map Interaction
        paths.forEach(path => {
            // Hover Tooltip
            path.addEventListener('mousemove', (e) => {
                tooltip.classList.remove('hidden');
                tooltip.style.left = e.pageX + 'px';
                tooltip.style.top = e.pageY - 20 + 'px'; // Offset
                tName.innerText = path.getAttribute('data-name');
                tPrice.innerText = path.getAttribute('data-price') + ' MAD';
            });

            path.addEventListener('mouseleave', () => {
                tooltip.classList.add('hidden');
            });

            // Click Selection
            path.addEventListener('click', function() {
                // Remove active class from all
                paths.forEach(p => p.classList.remove('selected'));
                // Add to current
                this.classList.add('selected');
                
                // Update Data
                currentPrice = parseInt(this.getAttribute('data-price'));
                zoneNameDisplay.innerText = this.getAttribute('data-name');
                
                // Flash animation on zone name
                zoneNameDisplay.parentElement.classList.add('bg-white/10');
                setTimeout(() => zoneNameDisplay.parentElement.classList.remove('bg-white/10'), 200);

                updateTotal();
            });
        });
    </script>
    <script src="../../../public/assets/js/home.js"></script>
    <script src="../../../public/assets/js/nabar.js"></script>

</body>
</html>