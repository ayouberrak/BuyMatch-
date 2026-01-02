<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 | Hors Jeu - BuyMatch</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: #020202; 
            color: white; 
            overflow: hidden;
        }

        .bg-ambiance {
            background-image: url('https://images.unsplash.com/photo-1508098682722-e99c43a406b2?q=80&w=1000');
            background-size: cover;
            background-position: center;
            opacity: 0.1;
            position: absolute;
            inset: 0;
            z-index: -1;
        }

        .error-code {
            font-size: clamp(8rem, 20vw, 15rem);
            line-height: 1;
            background: linear-gradient(180deg, rgba(212, 175, 55, 0.2) 0%, rgba(212, 175, 55, 0) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 900;
            letter-spacing: -10px;
        }

        .btn-gold {
            background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .animate-enter { 
            animation: fadeInUp 1s cubic-bezier(0.16, 1, 0.3, 1) forwards; 
            opacity: 0; 
            transform: translateY(40px); 
        }
        @keyframes fadeInUp { to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center relative px-6">

    <div class="bg-ambiance"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-[#020202] via-transparent to-[#020202] z-[-1]"></div>

    <div class="max-w-2xl w-full text-center relative">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 error-code select-none opacity-50 animate-float">
            404
        </div>

        <div class="relative z-10 animate-enter">
            <div class="inline-block mb-6 px-4 py-1.5 rounded-full border border-[#d4af37]/30 bg-[#d4af37]/10">
                <h4 class="text-[#d4af37] text-[10px] font-black uppercase tracking-[5px]">Hors Jeu</h4>
            </div>
            
            <h1 class="text-5xl md:text-7xl font-black italic uppercase tracking-tighter mb-6 leading-none">
                C'est un <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#d4af37] to-[#f4d03f]">Faux Rebond</span>
            </h1>

            <p class="text-gray-400 text-sm md:text-base font-medium max-w-md mx-auto mb-10 leading-relaxed uppercase tracking-widest opacity-80">
                La page que vous cherchez a quitté le terrain ou n'a jamais été convoquée pour le match.
            </p>

            <div class="flex flex-col md:flex-row items-center justify-center gap-4">
                <a href="index.php" class="btn-gold px-10 py-4 rounded-2xl font-black uppercase text-[11px] tracking-[3px] text-black shadow-2xl hover:scale-105 active:scale-95 w-full md:w-auto">
                    Retour au Terrain
                </a>
                
                <a href="contact.php" class="px-10 py-4 rounded-2xl border border-white/10 bg-white/5 font-black uppercase text-[11px] tracking-[3px] text-white hover:bg-white/10 transition-all w-full md:w-auto">
                    Signaler une faute
                </a>
            </div>
        </div>

        <div class="absolute -bottom-32 left-1/2 -translate-x-1/2 w-full opacity-20 animate-enter" style="animation-delay: 300ms;">
            <p class="text-[10px] font-black uppercase tracking-[10px] text-gray-500">BuyMatch Elite Ticketing</p>
        </div>
    </div>

</body>
</html>