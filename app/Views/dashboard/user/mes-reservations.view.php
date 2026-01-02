<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Réservations | BuyMatch</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../../public/assets/css/navbar.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;400;700;800&display=swap');
        
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #000000; 
            color: #ffffff;
        }

        /* Reservation Card */
        .reservation-card {
            background: #080808;
            border: 1px solid #151515;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .reservation-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: #d4af37;
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .reservation-card:hover {
            border-color: #d4af37;
            background: #0c0c0c;
        }

        .reservation-card:hover::before {
            opacity: 1;
        }

        /* Team Logo */
        .team-logo {
            width: 40px;
            height: 40px;
            background: #0c0c0c;
            border: 1px solid #1a1a1a;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        /* Button Styles */
        .btn-primary {
            background: #ffffff;
            color: #000000;
            font-weight: 800;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #d4af37;
            transform: scale(1.02);
        }

        .btn-outline {
            border: 1px solid #ffffff20;
            color: #ffffff;
            font-weight: 800;
            transition: all 0.3s ease;
        }

        .btn-outline:hover {
            background: #ffffff;
            color: #000000;
        }

        /* Gold Accent */
        .gold-dot {
            width: 8px;
            height: 8px;
            background: #d4af37;
            border-radius: 50%;
        }

        /* Status Badge */
        .status-completed {
            background: #d4af37;
            color: #000000;
        }

        .status-upcoming {
            background: #3b82f6;
            color: #ffffff;
        }

        .status-cancelled {
            background: #ef4444;
            color: #ffffff;
        }

        /* VS Divider */
        .vs-text {
            font-size: 9px;
            font-weight: 800;
            color: #d4af37;
            letter-spacing: 0.2em;
        }

        /* Modal */
        .modal-overlay {
            backdrop-filter: blur(8px);
        }
    </style>
</head>
<body class="pt-32 ">
    <?php require_once __DIR__ . '/../../layouts/navbar.php'; ?>

    <!-- Hero Section -->
    <div class="max-w-5xl mx-auto px-6 mb-16">
        <div class="mb-12">
            <div class="flex items-center gap-3 mb-4">
                <div class="gold-dot"></div>
                <span class="text-[9px] font-black uppercase text-[#d4af37] tracking-widest">Mon Historique</span>
            </div>
            <h1 class="text-6xl md:text-7xl font-extrabold tracking-tighter uppercase italic">
                Réservations<span class="text-[#d4af37]">.</span>
            </h1>
            <p class="text-gray-500 text-xs font-bold uppercase tracking-[4px] mt-3">
                Vos tickets et expériences
            </p>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-3 gap-4 mb-16">
            <div class="bg-[#080808] border border-[#151515] rounded-2xl p-6 text-center">
                <p class="text-3xl font-black italic text-[#d4af37]">8</p>
                <p class="text-[9px] font-black uppercase text-gray-600 tracking-widest mt-1">Total</p>
            </div>
            <div class="bg-[#080808] border border-[#151515] rounded-2xl p-6 text-center">
                <p class="text-3xl font-black italic text-blue-500">3</p>
                <p class="text-[9px] font-black uppercase text-gray-600 tracking-widest mt-1">À venir</p>
            </div>
            <div class="bg-[#080808] border border-[#151515] rounded-2xl p-6 text-center">
                <p class="text-3xl font-black italic text-white">5</p>
                <p class="text-[9px] font-black uppercase text-gray-600 tracking-widest mt-1">Terminés</p>
            </div>
        </div>
    </div>

    <!-- Reservations List -->
    <div class="max-w-5xl mx-auto px-6 mb-20">
        <div class="space-y-4">

            <!-- Completed Match - Can Comment -->
            <div class="reservation-card rounded-3xl p-8">
                <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                    
                    <!-- Match Info -->
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="text-[9px] font-black uppercase text-[#d4af37] tracking-widest">La Liga</span>
                            <span class="status-completed px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest">
                                Terminé
                            </span>
                        </div>
                        
                        <div class="flex items-center gap-4 mb-3">
                            <div class="team-logo">
                                <i class='bx bxs-shield text-blue-400'></i>
                            </div>
                            <h3 class="text-2xl font-black uppercase italic tracking-tight">Barcelona</h3>
                            <span class="vs-text">VS</span>
                            <h3 class="text-2xl font-black uppercase italic tracking-tight">Real Madrid</h3>
                            <div class="team-logo">
                                <i class='bx bxs-crown text-yellow-300'></i>
                            </div>
                        </div>

                        <p class="text-gray-500 text-[11px] font-bold mb-3">
                            12 JAN 2024 — CAMP NOU • 21:00
                        </p>

                        <div class="flex items-center gap-6">
                            <div>
                                <p class="text-gray-600 text-[9px] font-black uppercase tracking-widest">Place</p>
                                <p class="text-white text-sm font-bold">BLOC 4 • RANG 12 • #45</p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-[9px] font-black uppercase tracking-widest">Prix payé</p>
                                <p class="text-white text-sm font-bold italic">320 MAD</p>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-3">
                        <button class="btn-outline px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest">
                            <i class='bx bx-download mr-2'></i>Ticket
                        </button>
                        <button onclick="openCommentModal('Barcelona vs Real Madrid')" class="btn-primary px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest">
                            <i class='bx bx-message-square-dots mr-2'></i>Commenter
                        </button>
                    </div>
                </div>
            </div>

            <!-- Upcoming Match -->
            <div class="reservation-card rounded-3xl p-8">
                <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                    
                    <!-- Match Info -->
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="text-[9px] font-black uppercase text-gray-600 tracking-widest">Botola Pro</span>
                            <span class="status-upcoming px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest">
                                À Venir
                            </span>
                        </div>
                        
                        <div class="flex items-center gap-4 mb-3">
                            <div class="team-logo">
                                <i class='bx bxs-star text-red-600'></i>
                            </div>
                            <h3 class="text-2xl font-black uppercase italic tracking-tight">WAC</h3>
                            <span class="vs-text">VS</span>
                            <h3 class="text-2xl font-black uppercase italic tracking-tight">Raja</h3>
                            <div class="team-logo">
                                <i class='bx bxs-flag-alt text-green-500'></i>
                            </div>
                        </div>

                        <p class="text-gray-500 text-[11px] font-bold mb-3">
                            28 JAN 2024 — MOHAMMED V • 20:00
                        </p>

                        <div class="flex items-center gap-6">
                            <div>
                                <p class="text-gray-600 text-[9px] font-black uppercase tracking-widest">Place</p>
                                <p class="text-white text-sm font-bold">TRIBUNE SUD • RANG 8 • #23</p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-[9px] font-black uppercase tracking-widest">Prix payé</p>
                                <p class="text-white text-sm font-bold italic">150 MAD</p>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-3">
                        <button class="btn-primary px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest">
                            <i class='bx bx-qr mr-2'></i>E-Ticket
                        </button>
                    </div>
                </div>
            </div>

            <!-- Completed Match with Comment -->
            <div class="reservation-card rounded-3xl p-8">
                <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                    
                    <!-- Match Info -->
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="text-[9px] font-black uppercase text-gray-600 tracking-widest">Premier League</span>
                            <span class="status-completed px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest">
                                Terminé
                            </span>
                            <span class="text-[9px] font-black uppercase text-green-500 tracking-widest">
                                <i class='bx bx-check-circle'></i> Commenté
                            </span>
                        </div>
                        
                        <div class="flex items-center gap-4 mb-3">
                            <div class="team-logo">
                                <i class='bx bxs-circle text-cyan-400'></i>
                            </div>
                            <h3 class="text-2xl font-black uppercase italic tracking-tight">Man City</h3>
                            <span class="vs-text">VS</span>
                            <h3 class="text-2xl font-black uppercase italic tracking-tight">Liverpool</h3>
                            <div class="team-logo">
                                <i class='bx bxs-heart text-red-500'></i>
                            </div>
                        </div>

                        <p class="text-gray-500 text-[11px] font-bold mb-3">
                            05 JAN 2024 — ETIHAD • 17:30
                        </p>

                        <div class="flex items-center gap-6">
                            <div>
                                <p class="text-gray-600 text-[9px] font-black uppercase tracking-widest">Place</p>
                                <p class="text-white text-sm font-bold">BLOC 3 • RANG 15 • #89</p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-[9px] font-black uppercase tracking-widest">Prix payé</p>
                                <p class="text-white text-sm font-bold italic">450 MAD</p>
                            </div>
                        </div>

                        <!-- User Comment Preview -->
                        <div class="mt-4 p-4 bg-[#0c0c0c] border border-[#1a1a1a] rounded-xl">
                            <p class="text-[9px] font-black uppercase text-[#d4af37] tracking-widest mb-2">Votre avis</p>
                            <p class="text-sm text-gray-300">Match incroyable ! L'ambiance était exceptionnelle et le jeu très intense. Une expérience inoubliable au stade.</p>
                            <div class="flex items-center gap-2 mt-3">
                                <span class="text-[#d4af37]">★★★★★</span>
                                <span class="text-[9px] text-gray-600">5/5</span>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-3">
                        <button class="btn-outline px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest">
                            <i class='bx bx-download mr-2'></i>Ticket
                        </button>
                    </div>
                </div>
            </div>

            <!-- Cancelled Match -->
            <div class="reservation-card rounded-3xl p-8 opacity-50">
                <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                    
                    <!-- Match Info -->
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="text-[9px] font-black uppercase text-gray-600 tracking-widest">Serie A</span>
                            <span class="status-cancelled px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest">
                                Annulé
                            </span>
                        </div>
                        
                        <div class="flex items-center gap-4 mb-3">
                            <div class="team-logo">
                                <i class='bx bxs-bolt text-blue-500'></i>
                            </div>
                            <h3 class="text-2xl font-black uppercase italic tracking-tight">Inter</h3>
                            <span class="vs-text text-gray-700">VS</span>
                            <h3 class="text-2xl font-black uppercase italic tracking-tight">Juventus</h3>
                            <div class="team-logo">
                                <i class='bx bxs-diamond text-gray-400'></i>
                            </div>
                        </div>

                        <p class="text-gray-500 text-[11px] font-bold mb-3">
                            20 DÉC 2023 — SAN SIRO • 20:45
                        </p>

                        <div class="flex items-center gap-6">
                            <div>
                                <p class="text-gray-600 text-[9px] font-black uppercase tracking-widest">Remboursement</p>
                                <p class="text-green-500 text-sm font-bold">380 MAD • Effectué</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Comment Modal -->
    <div id="modal-comment" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/95 modal-overlay px-6  ">
        <div class="w-full max-w-xl">
            <div class="bg-[#080808] border border-[#151515] rounded-3xl p-10">
                
                <div class="text-center mb-8">
                    <div class="gold-dot mx-auto mb-4"></div>
                    <h3 class="text-4xl font-black italic uppercase tracking-tighter mb-2">
                        Votre Avis<span class="text-[#d4af37]">.</span>
                    </h3>
                    <p id="match-title" class="text-gray-600 text-[10px] font-black uppercase tracking-widest"></p>
                </div>
                
                <form class="space-y-6">
                    <!-- Rating -->
                    <div>
                        <label class="text-[9px] font-black uppercase text-gray-600 tracking-widest block mb-3">Note</label>
                        <div class="flex items-center gap-2 justify-center">
                            <button type="button" class="text-3xl text-gray-700 hover:text-[#d4af37] transition-colors">★</button>
                            <button type="button" class="text-3xl text-gray-700 hover:text-[#d4af37] transition-colors">★</button>
                            <button type="button" class="text-3xl text-gray-700 hover:text-[#d4af37] transition-colors">★</button>
                            <button type="button" class="text-3xl text-gray-700 hover:text-[#d4af37] transition-colors">★</button>
                            <button type="button" class="text-3xl text-gray-700 hover:text-[#d4af37] transition-colors">★</button>
                        </div>
                    </div>

                    <!-- Comment -->
                    <div>
                        <label class="text-[9px] font-black uppercase text-gray-600 tracking-widest block mb-3">Commentaire</label>
                        <textarea 
                            rows="5" 
                            placeholder="Partagez votre expérience du match..."
                            class="w-full bg-[#0c0c0c] border border-[#1a1a1a] p-6 text-sm text-white focus:border-[#d4af37] outline-none rounded-2xl resize-none"
                        ></textarea>
                    </div>
                    
                    <!-- Buttons -->
                    <div class="grid grid-cols-2 gap-4 pt-4">
                        <button type="button" onclick="closeCommentModal()" class="btn-outline py-4 rounded-xl text-[10px] font-black uppercase tracking-widest">
                            Annuler
                        </button>
                        <button type="submit" class="btn-primary py-4 rounded-xl text-[10px] font-black uppercase tracking-widest">
                            Publier
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

        <?php require_once __DIR__ . '/../../layouts/footer.php'; ?>


    <script>
        function openCommentModal(matchTitle) {
            const modal = document.getElementById('modal-comment');
            document.getElementById('match-title').textContent = matchTitle;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeCommentModal() {
            const modal = document.getElementById('modal-comment');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Star rating
        const stars = document.querySelectorAll('#modal-comment button[type="button"]');
        let currentRating = 0;

        stars.forEach((star, index) => {
            star.addEventListener('click', () => {
                currentRating = index + 1;
                updateStars();
            });

            star.addEventListener('mouseenter', () => {
                highlightStars(index + 1);
            });
        });

        document.querySelector('#modal-comment form').addEventListener('mouseleave', () => {
            updateStars();
        });

        function highlightStars(rating) {
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.add('text-[#d4af37]');
                    star.classList.remove('text-gray-700');
                } else {
                    star.classList.add('text-gray-700');
                    star.classList.remove('text-[#d4af37]');
                }
            });
        }

        function updateStars() {
            highlightStars(currentRating);
        }
    </script>
    <script src="../../../../public/assets/js/nabar.js"></script>
</body>
</html>