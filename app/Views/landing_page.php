<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Café Nula — Selamat Datang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; scroll-behavior: smooth; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .bg-nula { background-color: #617A55; }
        
        .card-shadow {
            box-shadow: 0 20px 50px -12px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body class="bg-[#FDFBF7]">

    <section class="relative min-h-screen flex flex-col items-center justify-center text-white px-6 bg-nula">
        
        <nav class="absolute top-0 w-full max-w-7xl p-8 flex justify-between items-center z-20">
            <h1 class="text-2xl font-serif">Café <span class="italic font-light opacity-80">Nula</span></h1>
            <div class="flex items-center space-x-6 text-[10px] uppercase tracking-widest font-semibold">
                <a href="#menu-section" class="hover:opacity-70 transition">Menu</a>
                <a href="<?= base_url('keranjang') ?>" class="bg-white/10 border border-white/20 px-4 py-2 rounded-full flex items-center gap-2">
                    🛒 <span>Keranjang</span>
                </a>
            </div>
        </nav>

        <div class="absolute inset-0 overflow-hidden opacity-20 pointer-events-none">
            <div class="absolute top-1/4 left-10 w-40 h-64 bg-white/20 rounded-full blur-3xl transform -rotate-45"></div>
            <div class="absolute bottom-1/4 right-10 w-40 h-64 bg-white/20 rounded-full blur-3xl transform rotate-45"></div>
        </div>

        <div class="text-center z-10 space-y-4">
            <p class="uppercase tracking-[0.4em] text-[10px] opacity-70 font-light">✦ Selamat Datang Di ✦</p>
            <h2 class="text-7xl md:text-8xl font-serif">Café <span class="italic font-light opacity-80 text-[#EAD8C0]">Nula</span></h2>
            <p class="italic text-lg opacity-80">Refined taste, timeless moments</p>
            
            <div class="w-16 h-[1px] bg-white/30 mx-auto my-6 relative">
                <div class="absolute -top-[5px] left-1/2 -translate-x-1/2 text-[10px]">✦</div>
            </div>

            <div class="mt-10 bg-white/10 backdrop-blur-md p-8 rounded-[2rem] border border-white/20 w-full max-w-md mx-auto shadow-2xl">
                
                <?php if (empty($mejaAktif)): ?>
                    <p class="text-[10px] uppercase mb-4 tracking-widest">🪑 Masukkan Nomor Meja Untuk Mulai</p>
                    <form action="<?= base_url('/') ?>" method="GET" class="flex gap-2">
                        <input type="number" name="table" required placeholder="Meja" 
                               class="bg-white/20 border-none rounded-xl p-4 w-full placeholder:text-white/40 outline-none text-center text-white transition-all focus:bg-white/30">
                        <button type="submit" class="bg-[#D48C7C] hover:bg-[#C07B6C] px-6 py-4 rounded-xl font-bold transition-all transform active:scale-95">
                            Mulai
                        </button>
                    </form>

                <?php else: ?>
                    <p class="text-[11px] uppercase mb-4 tracking-[0.2em] font-bold text-[#EAD8C0]">🪑 MEJA <?= esc($mejaAktif) ?></p>
                    <div class="space-y-3">
                        <a href="<?= base_url('identitas') ?>" class="block w-full bg-[#D48C7C] hover:bg-[#C07B6C] py-4 rounded-xl font-bold text-center transition-all shadow-lg">
                            🔮 Lanjut ke Menu →
                        </a>
                        <a href="<?= base_url('reset-meja') ?>" class="block w-full bg-white/10 hover:bg-white/20 py-3 rounded-xl text-[10px] uppercase tracking-widest text-center border border-white/10 transition-all opacity-80">
                            🔄 Pindah Meja
                        </a>
                    </div>
                <?php endif; ?>

            </div>
        </div>

        <div class="absolute bottom-8 text-[10px] tracking-[0.5em] opacity-40 uppercase animate-bounce">Scroll</div>
    </section>

    <section id="menu-section" class="py-24 max-w-6xl mx-auto px-6">
        <div class="text-center mb-16">
            <p class="text-[10px] uppercase tracking-[0.4em] text-gray-400 mb-2">✦ Pilihan Kami ✦</p>
            <h3 class="text-4xl font-serif">Menu <span class="italic text-[#617A55]">Unggulan</span></h3>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
            <?php if(!empty($menus)): ?>
                <?php foreach($menus as $m): ?>
                <div class="bg-white rounded-[2.5rem] p-5 card-shadow border border-gray-50 group hover:-translate-y-3 transition-all duration-500">
                    
                    <div class="relative h-64 w-full mb-6 overflow-hidden rounded-[2rem]">
                        <img src="<?= base_url('uploads/' . $m['icon']) ?>" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" 
                             alt="<?= esc($m['nama']) ?>">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-tighter text-[#617A55]">
                            ⭐ Top Pick
                        </div>
                    </div>
                    
                    <div class="px-2 pb-2">
                        <div class="flex justify-between items-start mb-2">
                            <h4 class="text-xl font-bold text-[#2D2424]"><?= esc($m['nama']) ?></h4>
                            <span class="text-[#617A55] font-black text-sm">Rp<?= number_format($m['harga'], 0, ',', '.') ?></span>
                        </div>
                        
                        <p class="text-gray-400 italic text-xs leading-relaxed mb-6 line-clamp-2">
                            <?= esc($m['deskripsi']) ?>
                        </p>
                        
                        <a href="<?= base_url('identitas') ?>" class="block w-full text-center py-3 rounded-2xl bg-gray-50 text-[10px] font-bold uppercase tracking-widest text-gray-400 group-hover:bg-[#617A55] group-hover:text-white transition-all">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-20 bg-gray-50 rounded-[3rem] border-2 border-dashed border-gray-100">
                    <p class="text-gray-400 italic">Belum ada menu unggulan yang ditampilkan.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <footer class="bg-[#2D2424] text-[#EAD8C0]/30 py-12 px-8 text-center md:flex md:justify-between items-center">
        <div class="mb-6 md:mb-0">
            <h1 class="text-xl font-serif text-[#EAD8C0] mb-1">Café <span class="italic">Nula</span></h1>
            <p class="text-[9px] tracking-[0.3em] uppercase opacity-50 font-light italic">Semarang, Indonesia</p>
        </div>
        <p class="text-[10px] tracking-widest uppercase italic">A signature of taste, by Café Nula © 2026</p>
    </footer>

</body>
</html>