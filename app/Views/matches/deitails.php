<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuyMatch | The Elite Experience</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;500;700&family=Outfit:wght@200;400;900&display=swap');
        
        body { font-family: 'Outfit', sans-serif; background: #000; color: white; overflow-x: hidden; }
        .font-space { font-family: 'Space Grotesk', sans-serif; }

        /* Animation Background Glow */
        .bg-glow {
            position: fixed; width: 40vw; height: 40vw; background: radial-gradient(circle, rgba(212, 175, 55, 0.08) 0%, transparent 70%);
            top: -10vw; right: -10vw; z-index: -1; animation: pulse 10s infinite alternate;
        }

        @keyframes pulse { from { transform: scale(1); opacity: 0.5; } to { transform: scale(1.2); opacity: 0.8; } }

        /* Hexagonal Seats Nadiyin */
        .seat {
            width: 35px; height: 40px; clip-path: polygon(25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%, 0% 50%);
            background: rgba(255, 255, 255, 0.03); cursor: pointer; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: 700;
            border: 1px solid rgba(255,255,255,0.05);
        }
        .seat:hover:not(.occupied) { background: #D4AF37; color: black; transform: scale(1.2) rotate(10deg); box-shadow: 0 0 20px #D4AF37; }
        .seat.selected { background: #D4AF37; color: black; box-shadow: 0 0 30px #D4AF37; transform: scale(1.1); }
        .seat.occupied { background: #111; opacity: 0.2; cursor: not-allowed; }

        /* Premium Ticket Glass */
        .ticket-glass {
            background: linear-gradient(145deg, rgba(255,255,255,0.05) 0%, rgba(255,255,255,0.01) 100%);
            backdrop-filter: blur(25px); border: 1px solid rgba(255, 255, 255, 0.07);
            position: relative;
        }
        .ticket-glass::after {
            content: ''; position: absolute; inset: 0; pointer-events: none;
            background: linear-gradient(90deg, transparent 0%, rgba(212, 175, 55, 0.03) 50%, transparent 100%);
        }

        .gold-shimmer {
            background: linear-gradient(90deg, #8E6D13, #D4AF37, #FCF6BA, #D4AF37, #8E6D13);
            background-size: 200% auto; -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            animation: shine 4s linear infinite;
        }
        @keyframes shine { to { background-position: 200% center; } }
    </style>
</head>
<body class="py-10">
    <div class="bg-glow"></div>

        <?php include_once __DIR__ . '/../layouts/navbar.php'; ?>

    <main class="max-w-6xl mx-auto px-6">
        
        <section class="mb-16 text-center">
            <div class="inline-flex items-center gap-4 bg-white/5 border border-white/10 px-4 py-1.5 rounded-full mb-8">
                <span class="w-2 h-2 bg-red-600 rounded-full animate-ping"></span>
                <span class="text-[10px] font-black uppercase tracking-[4px]">Live Selection Phase</span>
            </div>

            <?php
                $path_equipe_1= '../../public/uploads_logo_equipe/' . $equipe1Data->getLogo();
                $path_equipe_2= '../../public/uploads_logo_equipe/' . $equipe2Data->getLogo();
            ?>
            
            <div class="flex flex-col md:flex-row items-center justify-center gap-10 md:gap-24">
                <div class="flex flex-col items-center">
                    <img src="<?php echo htmlspecialchars($path_equipe_1); ?>" class="w-24 drop-shadow-[0_0_30px_rgba(255,0,0,0.2)]">
                    <h2 class="mt-4 font-black text-2xl tracking-tighter"><?php echo htmlspecialchars($equipe1Data->getNom()); ?></h2>
                </div>
                <div class="text-center">
                    <p class="font-space text-5xl font-black italic gold-shimmer tracking-tighter">V S</p>
                    <p class="text-[10px] text-gray-500 font-bold uppercase tracking-[5px] mt-2">Final 2026</p>
                </div>
                <div class="flex flex-col items-center">
                    <img src="<?php echo htmlspecialchars($path_equipe_2); ?>" class="w-24 drop-shadow-[0_0_30px_rgba(0,128,0,0.2)]">
                    <h2 class="mt-4 font-black text-2xl tracking-tighter"><?php echo htmlspecialchars($equipe2Data->getNom()); ?></h2>
                </div>
            </div>
        </section>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
            
            <div class="lg:col-span-8 space-y-8">
                <div class="ticket-glass rounded-[35px] p-8">
                    <h3 class="font-space text-[11px] font-black uppercase tracking-[3px] text-gold/60 mb-8">01. Select Category</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <?php foreach ($categories as $category): ?>
                            <button onclick="updateData('<?php echo htmlspecialchars($category->getId()); ?>','<?php echo htmlspecialchars($category->getNom()); ?>', '<?php echo htmlspecialchars($category->getPrice()); ?>', 'Zone A', this)" class="p-6 rounded-[25px] border border-gold/30 bg-gold/5 text-left transition-all active-cat">
                                <p class="text-[9px] font-black text-gold uppercase tracking-widest"><?php echo htmlspecialchars($category->getNom()); ?></p>
                                <p class="text-2xl font-black mt-1"><?php echo htmlspecialchars($category->getPrice()); ?> <span class="text-xs opacity-50">DH</span></p>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="ticket-glass rounded-[35px] p-8 relative">
                    <h3 class="font-space text-[11px] font-black uppercase tracking-[3px] text-gold/60 mb-8">02. Pick Your Seat</h3>
                    <div id="seat-map" class="grid grid-cols-6 md:grid-cols-10 gap-3 justify-items-center mb-10">
                        </div>
                    <div class="w-full h-px bg-gradient-to-r from-transparent via-gold/30 to-transparent"></div>
                    <p class="text-center text-[8px] font-black text-gold/30 uppercase tracking-[10px] mt-4 italic">Terrain / Pitch Side</p>
                </div>
            </div>

            <div class="lg:col-span-4 sticky top-10">
                <div class="ticket-glass rounded-[40px] p-10 border-gold/20">
                    <h4 class="font-space text-sm font-black italic tracking-widest mb-10">CHECKOUT RECAP</h4>
                    
                    <div class="space-y-6 mb-12">
                        <div class="flex justify-between items-center text-sm border-b border-white/5 pb-4">
                            <span class="text-gray-500 font-bold text-[10px] uppercase">Access</span>
                            <span id="res-cat" class="font-black uppercase"></span>
                        </div>
                        <div class="flex justify-between items-center text-sm border-b border-white/5 pb-4">
                            <span class="text-gray-500 font-bold text-[10px] uppercase">Seat</span>
                            <span id="res-seat" class="font-black text-gold">NOT SELECTED</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 font-bold text-[10px] uppercase">Price</span>
                            <span class="text-3xl font-black italic"><span id="res-price"></span><span class="text-sm ml-1 opacity-50 font-normal">DH</span></span>
                        </div>
                    </div>

                    <button onclick="sendData(<?= $eventId ?>)" class="w-full bg-white text-black py-5 rounded-2xl font-black uppercase text-[10px] tracking-[5px] hover:bg-gold transition-all shadow-2xl flex items-center justify-center gap-3 active:scale-95 group">
                        Confirm Purchase <i class='bx bxs-bolt-circle text-xl group-hover:rotate-180 transition-transform'></i>
                    </button>
                </div>
            </div>
        </div>

        <div id="final-ticket" class="mt-32 opacity-10 blur-xl transition-all duration-1000 transform translate-y-20">
            <p class="text-center text-[10px] font-black text-gray-600 uppercase tracking-[20px] mb-12 italic">Your Official Digital Pass</p>
            
            <div class="ticket-glass rounded-[60px] flex flex-col md:flex-row overflow-hidden border border-white/10 shadow-[0_0_100px_rgba(212,175,55,0.05)] relative">
                
                <div class="absolute inset-0 flex items-center justify-center opacity-[0.02] pointer-events-none">
                    <h1 class="text-9xl font-black italic">MATCH DAY</h1>
                </div>

                <div class="flex-[3] p-10 md:p-14 border-r border-dashed border-white/10 relative">
                    
                    <div class="absolute -top-10 -left-10 w-40 h-40 bg-gold/5 rounded-full blur-3xl"></div>
                    
                    <div class="flex flex-wrap justify-between items-center mb-12 gap-6">
                        <div class="flex items-center gap-4 bg-white/5 p-3 rounded-3xl border border-white/5">
                            <img src="<?php echo htmlspecialchars($path_equipe_1); ?>" class="w-10 h-10 object-contain">
                            <span class="font-black italic text-sm tracking-tighter"><?php echo htmlspecialchars($equipe1Data->getNom()); ?></span>
                            <span class="text-gold font-black mx-1 text-xs italic">VS</span>
                            <span class="font-black italic text-sm tracking-tighter"><?php echo htmlspecialchars($equipe2Data->getNom()); ?></span>
                            <img src="<?php echo htmlspecialchars($path_equipe_2); ?>" class="w-10 h-10 object-contain">
                        </div>
                        <div class="text-right">
                            <p class="text-[9px] font-black text-gold uppercase tracking-[4px]">28 JAN 2026</p>
                            <p class="text-[8px] text-gray-500 font-bold uppercase tracking-widest mt-1 italic">Stade Mohammed V</p>
                        </div>
                    </div>

                    <div class="mb-12">
                        <span class="bg-gold/10 text-gold border border-gold/20 px-4 py-1 rounded-full text-[8px] font-black uppercase tracking-widest mb-3 inline-block">Confirmed Access</span>
                        <h2 id="t-cat" class="font-space text-5xl md:text-7xl font-black gold-shimmer italic uppercase leading-none tracking-tighter"></h2>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 border-t border-white/10 pt-10">
                        <div>
                            <p class="text-[8px] text-gray-500 font-black uppercase mb-2 tracking-widest">Siège</p>
                            <p id="t-seat" class="font-black text-xl text-gold italic">--</p>
                        </div>
                        <div>
                            <p class="text-[8px] text-gray-500 font-black uppercase mb-2 tracking-widest">Zone</p>
                            <p id="t-zone" class="font-black text-sm uppercase italic">Zone A</p>
                        </div>
                        <div>
                            <p class="text-[8px] text-gray-500 font-black uppercase mb-2 tracking-widest">Porte</p>
                            <p id="t-gate" class="font-black text-sm uppercase italic">Gate 12/A</p>
                        </div>
                        <div>
                            <p class="text-[8px] text-gray-500 font-black uppercase mb-2 tracking-widest">Prix Total</p>
                            <p class="font-black text-xl italic"><span id="t-price">1200</span> <span class="text-[10px] opacity-50">DH</span></p>
                        </div>
                    </div>
                </div>

                <div class="flex-1 p-10 md:p-14 flex flex-col items-center justify-center bg-white/[0.02] relative">
                    <div class="absolute -top-5 left-[-20px] w-10 h-10 bg-[#000] rounded-full hidden md:block border-r border-white/10"></div>
                    <div class="absolute -bottom-5 left-[-20px] w-10 h-10 bg-[#000] rounded-full hidden md:block border-r border-white/10"></div>
                    
                    <div class="bg-white p-5 rounded-[35px] shadow-[0_0_50px_rgba(255,255,255,0.1)] mb-8 transform hover:scale-105 transition-transform duration-500">
                        <i class='bx bx-qr text-8xl text-black'></i>
                    </div>
                    <div class="text-center">
                        <p class="text-[9px] font-black text-gray-500 tracking-[5px] uppercase mb-1">Verify Entry</p>
                        <p class="text-[7px] font-mono opacity-30">REF: BM-<?php echo time(); ?>-XP</p>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <?php include_once __DIR__ . '/../layouts/footer.php'; ?>

    <script>
        const grid = document.getElementById('seat-map');

        let selectedCategoryId = null;



        function generateSeats() {
            grid.innerHTML = '';
            for(let i=1; i<=30; i++) {
                const isOcc = Math.random() < 0.2;
                const s = document.createElement('div');
                s.className = `seat ${isOcc ? 'occupied' : ''}`;
                s.innerText = i;
                if(!isOcc) s.onclick = () => selectSeat(i, s);
                grid.appendChild(s);
            }
        }

        function selectSeat(num, el) {
            document.querySelectorAll('.seat').forEach(s => s.classList.remove('selected'));
            el.classList.add('selected');
            
            document.getElementById('res-seat').innerText = `${num}`;
            document.getElementById('t-seat').innerText = num;

            // NADI ANIMATION FOR TICKET
            const ticket = document.getElementById('final-ticket');
            ticket.classList.remove('opacity-10', 'blur-xl', 'translate-y-20');
            ticket.classList.add('opacity-100', 'blur-0', 'translate-y-0');
        }

        function updateData(id, cat, price, zone, btn) {
                selectedCategoryId = id;

            document.querySelectorAll('button').forEach(b => {
                b.classList.add('opacity-40');
                b.classList.remove('border-gold/30', 'bg-gold/5');
            });
            btn.classList.remove('opacity-40');
            btn.classList.add('border-gold/30', 'bg-gold/5');

            document.getElementById('res-cat').innerText = cat;
            document.getElementById('res-price').innerText = price;
            document.getElementById('t-cat').innerText = cat;
            document.getElementById('t-price').innerText = price;
            document.getElementById('t-zone').innerText = zone;
            
            generateSeats();
        }

        generateSeats();


        function sendData(idEvents) {
            const category = document.getElementById('res-cat').innerText;
            const seat = document.getElementById('res-seat').innerText;
            const price = document.getElementById('res-price').innerText;


            // let idCategory;
            // if(category == "Standard") {
            //     idCategory = 5;
            // }else if(category == "VIP") {
            //     idCategory = 4;
            // }else if(category == "Premium") {
            //     idCategory = 6;
            // }

            if(seat === 'NOT SELECTED') {
                alert('is not select ');
                return;
            }
            console.log({ selectedCategoryId, seat, price });

            fetch('../api/Reserve.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({idEvents,selectedCategoryId, seat, price })
            }) 
            .then(response => response.json())
            .then(data => {
                console.log(data);
                })
            .catch(error => {
                console.log('Error', error);
            });
        }
    </script>
</body>
</html>