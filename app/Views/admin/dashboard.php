<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin — CaféEase</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 flex min-h-screen text-sm">

    <aside class="w-60 bg-[#2D1B17] text-white flex flex-col p-5 fixed h-full shadow-xl">
        <h1 class="text-xl font-serif italic mb-10 text-[#EAD8C0] tracking-wider text-center">CaféEase</h1>
        
        <nav class="space-y-2 flex-1">
            <a href="<?= base_url('admin/dashboard') ?>" class="flex items-center gap-3 bg-[#617A55] px-4 py-3 rounded-xl shadow-md transition-all">
                <i class="fa-solid fa-file-invoice text-xs"></i>
                <span class="font-bold">Pesanan</span>
            </a>
            <a href="<?= base_url('admin/kelola_menu') ?>" class="flex items-center gap-3 text-gray-400 hover:text-white hover:bg-white/5 px-4 py-3 rounded-xl transition-all">
                <i class="fa-solid fa-utensils text-xs"></i>
                <span class="font-bold">Kelola Menu</span>
            </a>
        </nav>

        <a href="<?= base_url('admin/logout') ?>" class="flex items-center justify-center gap-2 text-red-400 text-[10px] font-black uppercase tracking-widest p-3 border border-red-900/50 rounded-xl hover:bg-red-500 hover:text-white transition-all">
            <i class="fa-solid fa-power-off"></i> Keluar
        </a>
    </aside>

    <main class="flex-1 ml-60 p-8">
        <header class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Daftar <span class="text-[#617A55]">Pesanan</span></h2>
            <p class="text-gray-400 text-xs mt-1">Pantau dan kelola pesanan pelanggan yang masuk secara real-time.</p>
        </header>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($orders as $o) : ?>
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">#<?= $o['id'] ?></span>
                                <h3 class="text-xl font-bold text-gray-800"><?= esc($o['nama_pelanggan']) ?></h3>
                                <p class="text-sm text-gray-500">Meja <?= esc($o['nomor_meja']) ?> • <?= date('H:i', strtotime($o['created_at'])) ?> WIB</p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase <?= $o['status'] == 'Selesai' ? 'bg-green-50 text-green-600' : 'bg-orange-50 text-orange-600' ?>">
                                <?= $o['status'] ?>
                            </span>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-2xl mb-4">
                            <p class="text-[10px] uppercase tracking-widest text-gray-400 mb-2 font-bold">Detail Pesanan:</p>
                            <ul class="text-sm text-gray-600 space-y-1">
                                <?php if (!empty($o['detail_item'])) : ?>
                                    <?php 
                                    $items = explode(', ', $o['detail_item']);
                                    foreach ($items as $item) : 
                                    ?>
                                        <li class="flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 bg-[#617A55] rounded-full"></span>
                                            <?= esc($item) ?>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <li class="text-gray-400 italic text-xs">Tidak ada detail</li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-4 border-t border-gray-50">
                        <span class="font-bold text-lg text-[#617A55]">Rp <?= number_format($o['total_harga'], 0, ',', '.') ?></span>
                        
                        <?php if ($o['status'] == 'Menunggu') : ?>
                            <form action="<?= base_url('admin/update_status/' . $o['id']) ?>" method="POST">
                                <button type="submit" class="bg-[#617A55] text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-[#4e6344] transition shadow-md shadow-[#617A55]/20">
                                    Tandai Selesai
                                </button>
                            </form>
                        <?php else : ?>
                            <div class="flex items-center gap-1 text-green-600 text-xs font-bold">
                                <i class="fa-solid fa-circle-check"></i>
                                Berhasil
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

</body>
</html>