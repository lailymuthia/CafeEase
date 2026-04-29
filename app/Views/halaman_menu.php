<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu — Café Nula</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;1,400&family=Plus+Jakarta+Sans:wght@300;400;600&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; scroll-behavior: smooth; }
        .font-serif { font-family: 'Playfair Display', serif; }
        
        /* Style untuk tombol kategori yang aktif */
        .category-btn.active {
            background-color: #617A55;
            color: white;
            border-color: #617A55;
        }
    </style>
</head>
<body class="bg-[#FDFBF7] p-6 md:p-12 text-slate-800">

    <div class="max-w-2xl mx-auto">
        <header class="flex justify-between items-end mb-8">
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-[0.2em]">Selamat Memilih, <?= esc($nama) ?>!</p>
                <h2 class="text-4xl font-serif italic text-gray-800">Menu <span class="text-[#617A55]">Café Nula</span></h2>
            </div>
            
            <a href="<?= base_url('keranjang') ?>" class="bg-[#617A55] hover:bg-[#4a5e3f] text-white px-5 py-2 rounded-full text-xs font-bold shadow-lg flex items-center gap-2 transition-all active:scale-95">
                🛒 Keranjang (<span id="cart-count"><?= session()->get('keranjang') ? count(session()->get('keranjang')) : 0 ?></span>)
            </a>
        </header>

        <div class="flex flex-wrap gap-2 mb-10 overflow-x-auto pb-2 scrollbar-hide">
            <button onclick="filterSelection('all')" class="category-btn active px-5 py-2 rounded-full border border-gray-200 text-[10px] font-bold uppercase tracking-widest transition-all whitespace-nowrap">Semua</button>
            <button onclick="filterSelection('Makanan')" class="category-btn px-5 py-2 rounded-full border border-gray-200 text-[10px] font-bold uppercase tracking-widest transition-all whitespace-nowrap">Makanan</button>
            <button onclick="filterSelection('Minuman')" class="category-btn px-5 py-2 rounded-full border border-gray-200 text-[10px] font-bold uppercase tracking-widest transition-all whitespace-nowrap">Minuman</button>
            <button onclick="filterSelection('Dessert')" class="category-btn px-5 py-2 rounded-full border border-gray-200 text-[10px] font-bold uppercase tracking-widest transition-all whitespace-nowrap">Dessert</button>
            <button onclick="filterSelection('Snack')" class="category-btn px-5 py-2 rounded-full border border-gray-200 text-[10px] font-bold uppercase tracking-widest transition-all whitespace-nowrap">Snack</button>
        </div>

        <div class="grid gap-6" id="menu-list">
            <?php foreach($menus as $m): ?>
            <div class="menu-card bg-white p-5 rounded-[2.5rem] shadow-sm border border-gray-100 flex items-center justify-between group hover:shadow-xl transition-all duration-500" data-category="<?= esc($m['kategori']) ?>">
                <div class="flex items-center gap-5">
                    <div class="w-20 h-20 rounded-[1.5rem] overflow-hidden bg-gray-50 border border-gray-50">
                        <img src="<?= base_url('uploads/' . $m['icon']) ?>" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" 
                             alt="<?= esc($m['nama']) ?>">
                    </div>
                    
                    <div>
                        <h4 class="font-bold text-gray-800 text-base"><?= esc($m['nama']) ?></h4>
                        <p class="text-[10px] text-gray-400 italic mt-1 leading-relaxed max-w-[180px]"><?= esc($m['deskripsi']) ?></p>
                        <span class="inline-block mt-2 text-[8px] font-bold text-[#617A55] bg-[#617A55]/5 px-2 py-0.5 rounded-md uppercase tracking-tighter"><?= esc($m['kategori']) ?></span>
                    </div>
                </div>
                
                <div class="text-right">
                    <p class="font-black text-[#617A55] text-sm mb-2">Rp<?= number_format($m['harga'], 0, ',', '.') ?></p>
                    <button 
                        onclick="tambahKeKeranjang('<?= esc($m['nama']) ?>', '<?= $m['harga'] ?>')"
                        class="bg-[#D48C7C] text-white w-10 h-10 rounded-2xl font-bold shadow-lg shadow-[#D48C7C]/20 hover:bg-[#2D1B17] hover:scale-110 active:scale-95 transition-all">
                        +
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <footer class="mt-24 text-center space-y-4">
            <div class="inline-block bg-[#617A55]/5 px-6 py-2 rounded-full">
                <p class="text-[#617A55] font-bold text-[10px] uppercase tracking-widest">📍 Meja Nomor: <?= esc($meja) ?></p>
            </div>
            <br>
            <a href="<?= base_url('reset') ?>" class="inline-block text-[10px] uppercase tracking-widest text-gray-300 hover:text-red-400 transition border-b border-transparent hover:border-red-400">
                Ganti Meja / Keluar
            </a>
        </footer>
    </div>

    <script>
        // Fungsi untuk Filter Kategori
        function filterSelection(category) {
            const cards = document.getElementsByClassName("menu-card");
            const btns = document.getElementsByClassName("category-btn");

            // Update tombol aktif
            for (let btn of btns) {
                btn.classList.remove("active");
                if (btn.innerText.toLowerCase() === category.toLowerCase() || (category === 'all' && btn.innerText.toLowerCase() === 'semua')) {
                    btn.classList.add("active");
                }
            }

            // Filter kartu menu
            for (let card of cards) {
                if (category === "all") {
                    card.style.display = "flex";
                } else {
                    if (card.getAttribute("data-category") === category) {
                        card.style.display = "flex";
                    } else {
                        card.style.display = "none";
                    }
                }
            }
        }

        // Fungsi Tambah Ke Keranjang (Tetap)
        function tambahKeKeranjang(namaMenu, hargaMenu) {
            const formData = new FormData();
            formData.append('nama', namaMenu);
            formData.append('harga', hargaMenu);

            fetch('<?= base_url('tambah-keranjang') ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === 'success') {
                    document.getElementById('cart-count').innerText = data.total_item;
                    
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true
                    });
                    Toast.fire({
                        icon: 'success',
                        title: namaMenu + ' masuk keranjang'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>

</body>
</html>