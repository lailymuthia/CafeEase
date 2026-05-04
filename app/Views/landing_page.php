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
        
        /* Gradasi Pastel Matcha ke Pink Pastel */
        .bg-gradasi-nula { 
            background: linear-gradient(135deg, #B7D1A3 0%, #F4CFDF 100%); 
        }
        
        .card-shadow { box-shadow: 0 20px 50px -12px rgba(0,0,0,0.05); }

        #foto-meja { display: none; }
        #foto-meja.show { display: block; }
    </style>
</head>
<body class="bg-[#FDFBF7]">

    <section class="relative pt-24 pb-12 flex flex-col items-center justify-center text-white px-6 bg-gradasi-nula">
        <nav class="absolute top-0 w-full max-w-7xl p-8 flex justify-between items-center z-20">
            <h1 class="text-2xl font-serif text-gray-800">Café <span class="italic font-light opacity-80">Nula</span></h1>
            <div class="flex items-center space-x-6 text-[10px] uppercase tracking-widest font-semibold text-gray-700">
                <a href="<?= base_url('keranjang') ?>" class="bg-white/40 backdrop-blur-sm border border-white/20 px-4 py-2 rounded-full flex items-center gap-2">
                    🛒 <span>Keranjang</span>
                </a>
            </div>
        </nav>

        <div class="text-center z-10 space-y-4">
            <p class="uppercase tracking-[0.4em] text-[10px] text-gray-600 font-light">✦ Experience ✦</p>
            <h2 class="text-6xl md:text-7xl font-serif text-gray-800">Café <span class="italic font-light opacity-60">Nula</span></h2>
            <p class="italic text-lg text-gray-700 opacity-80">Beautiful & Comfortable Caffe</p>
        </div>
    </section>

    <section class="py-16 max-w-6xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
            
            <div>
                <div class="text-left mb-8">
                    <p class="text-[10px] uppercase tracking-[0.4em] text-gray-400 mb-2">✦ Our Place ✦</p>
                    <h3 class="text-3xl font-serif">Suasana <span class="italic text-[#617A55]">Café Kami</span></h3>
                </div>
                <div class="rounded-[2.5rem] overflow-hidden card-shadow">
                    <img src="<?= base_url('uploads/meja/cafe.jpg') ?>" class="w-full h-80 object-cover" alt="Foto Cafe">
                </div>
            </div>

            <div>
                <div class="text-left mb-8">
                    <p class="text-[10px] uppercase tracking-[0.4em] text-gray-400 mb-2">✦ Top Picks ✦</p>
                    <h3 class="text-3xl font-serif">Menu <span class="italic text-[#617A55]">Favorit</span></h3>
                </div>
                
                <div class="space-y-4">
                    <?php if(!empty($menus)): ?>
                        <?php foreach(array_slice($menus, 0, 3) as $m): ?>
                        <div class="flex items-center gap-4 bg-white p-4 rounded-3xl card-shadow border border-gray-50">
                            <img src="<?= base_url('uploads/' . $m['icon']) ?>" class="w-20 h-20 rounded-2xl object-cover" alt="<?= esc($m['nama']) ?>">
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-800"><?= esc($m['nama']) ?></h4>
                                <p class="text-xs text-[#617A55] font-bold">Rp<?= number_format($m['harga'], 0, ',', '.') ?></p>
                            </div>
                            <div class="text-[10px] bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full font-bold">⭐ TOP</div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-[#F5F0E8]">
        <div class="max-w-md mx-auto px-6 text-center">
            <div class="mb-8">
                <p class="text-[10px] uppercase tracking-[0.4em] text-gray-400 mb-2">✦ Booking ✦</p>
                <h3 class="text-3xl font-serif">Input <span class="italic text-[#617A55]">Nomor Meja</span></h3>
            </div>

            <div class="bg-white p-8 rounded-[2.5rem] card-shadow border border-gray-100">
                <?php if (empty($mejaAktif)): ?>
                    <form action="<?= base_url('/') ?>" method="GET" class="space-y-4">
                        <input type="number" name="table" id="input-meja" required min="1" placeholder="Nomor Meja"
                               class="bg-gray-50 border-none rounded-2xl p-5 w-full outline-none text-center text-gray-800 text-xl font-bold focus:ring-2 focus:ring-[#B7D1A3] transition-all">
                        
                        <div id="foto-meja" class="rounded-2xl overflow-hidden border border-gray-100 w-full mb-4">
                            <img id="img-meja" src="" alt="Foto Meja" class="w-full h-44 object-cover">
                            <div class="bg-[#B7D1A3] py-2 text-[10px] uppercase tracking-widest text-white font-bold">
                                🪑 Lokasi Meja <span id="label-nomor"></span>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-[#D48C7C] hover:bg-[#C07B6C] text-white px-6 py-4 rounded-2xl font-bold transition-all shadow-lg">
                            Konfirmasi Meja →
                        </button>
                    </form>
                <?php else: ?>
                    <div class="text-center">
                        <p class="text-xs uppercase tracking-widest font-bold text-gray-400 mb-2">Meja Aktif</p>
                        <h4 class="text-4xl font-serif mb-6 text-[#617A55]">Meja <?= esc($mejaAktif) ?></h4>
                        <a href="<?= base_url('identitas') ?>" class="block w-full bg-[#B7D1A3] text-white py-4 rounded-2xl font-bold shadow-lg mb-3">Lanjut Pesan</a>
                        <a href="<?= base_url('reset-meja') ?>" class="text-xs text-gray-400 underline">Ganti Meja</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="py-24 bg-[#FDFBF7] px-6">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16">
                <p class="text-[10px] uppercase tracking-[0.4em] text-gray-400 mb-2">✦ Gallery ✦</p>
                <h3 class="text-4xl font-serif">Pilihan <span class="italic text-[#617A55]">Area Meja</span></h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <div class="bg-white rounded-[2.5rem] overflow-hidden card-shadow group">
                    <div class="h-56 overflow-hidden">
                        <img src="<?= base_url('uploads/meja/meja1.jpg') ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="p-5 text-center">
                        <h4 class="text-lg font-bold text-[#2D2424]">Meja 1-5</h4>
                        <p class="text-gray-400 italic text-xs mt-1">Area Indoor Klasik</p>
                    </div>
                </div>

                <div class="bg-white rounded-[2.5rem] overflow-hidden card-shadow group">
                    <div class="h-56 overflow-hidden">
                        <img src="<?= base_url('uploads/meja/meja2.jpg') ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="p-5 text-center">
                        <h4 class="text-lg font-bold text-[#2D2424]">Meja 6-10</h4>
                        <p class="text-gray-400 italic text-xs mt-1">Area Semi-Outdoor Sejuk</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-[#2D2424] text-[#EAD8C0]/30 py-12 text-center">
        <h1 class="text-xl font-serif text-[#EAD8C0]">Café <span class="italic">Nula</span></h1>
        <p class="text-[10px] tracking-widest uppercase italic mt-2">A signature of taste © 2026</p>
    </footer>

    <script>
        const inputMeja  = document.getElementById('input-meja');
        const fotoPrev   = document.getElementById('foto-meja');
        const imgMeja    = document.getElementById('img-meja');
        const labelNomor = document.getElementById('label-nomor');

        if (inputMeja) {
            inputMeja.addEventListener('input', function () {
                const nomor = parseInt(this.value.trim());
                if (nomor && nomor > 0) {
                    let namaFile = (nomor >= 1 && nomor <= 5) ? 'meja1.jpg' : 'meja2.jpg';
                    imgMeja.src = `<?= base_url('uploads/meja/') ?>${namaFile}`;
                    labelNomor.textContent = nomor;
                    imgMeja.onload = () => fotoPrev.classList.add('show');
                } else {
                    fotoPrev.classList.remove('show');
                }
            });
        }
    </script>
</body>
</html>