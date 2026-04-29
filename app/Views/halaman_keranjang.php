<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Saya — Café Nula</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FDFBF7] p-6 font-sans">
    <div class="max-w-xl mx-auto">
        <header class="mb-10 flex items-center justify-between">
            <a href="/menu" class="text-[#617A55] font-bold text-sm">← Kembali ke Menu</a>
            <h1 class="text-2xl font-serif italic text-gray-800">Keranjang <span class="text-[#617A55]">Pesanan</span></h1>
        </header>

        <div class="bg-white rounded-[2rem] shadow-xl overflow-hidden">
            <div class="p-8 border-b bg-[#F0F5ED]">
                <p class="text-xs text-gray-500 uppercase tracking-widest">Detail Pemesan</p>
                <h3 class="font-bold text-gray-800"><?= $nama ?> — Meja <?= $meja ?></h3>
            </div>

            <div class="p-8 space-y-6">
                <?php 
                $totalSemua = 0;
                if(empty($keranjang)): ?>
                    <p class="text-center text-gray-400 italic">Keranjang masih kosong...</p>
                <?php else: 
                    foreach($keranjang as $item): 
                        $subtotal = $item['harga'] * $item['qty'];
                        $totalSemua += $subtotal;
                ?>
                <div class="flex justify-between items-center border-b border-gray-50 pb-4">
                    <div>
                        <h4 class="font-bold text-gray-800"><?= $item['nama'] ?></h4>
                        <p class="text-xs text-gray-400">Rp <?= number_format($item['harga'], 0, ',', '.') ?> x <?= $item['qty'] ?></p>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="font-bold text-[#617A55]">Rp <?= number_format($subtotal, 0, ',', '.') ?></span>
                        <form action="/keranjang/hapus" method="POST">
                            <input type="hidden" name="nama" value="<?= $item['nama'] ?>">
                            <button type="submit" class="text-red-300 hover:text-red-500 text-sm">✕</button>
                        </form>
                    </div>
                </div>
                <?php endforeach; endif; ?>

                <div class="pt-4 border-t-2 border-dashed border-gray-100 flex justify-between items-center">
                    <span class="text-lg font-serif">Total Bayar</span>
                    <span class="text-2xl font-bold text-[#617A55]">Rp <?= number_format($totalSemua, 0, ',', '.') ?></span>
                </div>

                <?php if(!empty($keranjang)): ?>
                    <a href="/checkout" class="block w-full bg-[#4A3F35] text-white text-center py-4 rounded-2xl font-bold shadow-lg hover:bg-black transition-all">
                        Checkout Pesanan Sekarang
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
