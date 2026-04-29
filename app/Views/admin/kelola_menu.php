<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Menu — CaféEase</title>
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
            <a href="<?= base_url('admin/dashboard') ?>" class="flex items-center gap-3 px-4 py-3 text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition-all">
                <i class="fa-solid fa-file-invoice text-xs"></i>
                <span class="font-bold">Pesanan</span>
            </a>
            <a href="<?= base_url('admin/kelola_menu') ?>" class="flex items-center gap-3 bg-[#D48C7C] px-4 py-3 rounded-xl shadow-md transition-all">
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
            <h2 class="text-2xl font-bold text-gray-800">Manajemen <span class="text-[#D48C7C]">Menu</span></h2>
            <p class="text-gray-400 text-xs mt-1">Tambah atau edit menu untuk memperbarui daftar hidangan.</p>
        </header>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-8">
            <h3 class="text-xs font-black uppercase tracking-widest text-gray-400 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-plus-circle text-[#D48C7C]"></i> Tambah Menu Baru
            </h3>
            
            <form action="<?= base_url('admin/simpan') ?>" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <input type="text" name="nama" placeholder="Nama Menu" class="bg-gray-50 p-3 rounded-xl text-xs outline-none border border-gray-100 focus:border-[#D48C7C] transition-all" required>
                <input type="number" name="harga" placeholder="Harga" class="bg-gray-50 p-3 rounded-xl text-xs outline-none border border-gray-100 focus:border-[#D48C7C] transition-all" required>
                
                <div class="relative">
                    <input type="file" name="icon" class="hidden" id="foto-input" accept="image/*" required>
                    <label for="foto-input" class="bg-gray-50 p-3 rounded-xl text-xs border border-dashed border-gray-300 text-gray-400 flex items-center justify-center gap-2 cursor-pointer hover:border-[#D48C7C] transition-all w-full h-full">
                        <i class="fa-solid fa-image"></i> Pilih Foto
                    </label>
                </div>

                <select name="kategori" class="bg-gray-50 p-3 rounded-xl text-xs outline-none border border-gray-100 focus:border-[#D48C7C] transition-all">
                    <option value="Makanan">Makanan</option>
                    <option value="Minuman">Minuman</option>
                    <option value="Dessert">Dessert</option>
                    <option value="Snack">Snack</option>
                </select>

                <div class="md:col-span-3">
                    <input type="text" name="deskripsi" placeholder="Deskripsi singkat menu..." class="w-full bg-gray-50 p-3 rounded-xl text-xs outline-none border border-gray-100 focus:border-[#D48C7C] transition-all">
                </div>

                <div class="flex items-center gap-4">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" name="is_unggulan" value="1" class="w-4 h-4 rounded border-gray-300 text-[#D48C7C] focus:ring-[#D48C7C]">
                        <span class="text-[10px] font-bold text-gray-400 group-hover:text-[#D48C7C] transition-all uppercase tracking-tighter">Set Unggulan</span>
                    </label>
                    <button type="submit" class="flex-1 bg-[#D48C7C] text-white py-3 rounded-xl text-xs font-bold shadow-lg shadow-[#D48C7C]/20 hover:bg-[#2D1B17] transition-all">
                        Simpan Menu
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 text-[10px] uppercase text-gray-400 font-black tracking-widest border-b border-gray-100">
                        <th class="p-5">Menu</th>
                        <th class="p-5">Kategori</th>
                        <th class="p-5">Harga</th>
                        <th class="p-5 text-center">Status Unggulan</th>
                        <th class="p-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php if(!empty($menus)): ?>
                        <?php foreach($menus as $m): ?>
                        <tr class="hover:bg-gray-50/50 transition-all group">
                            <td class="p-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 rounded-2xl overflow-hidden bg-gray-100 border border-gray-100 shadow-sm">
                                        <img src="<?= base_url('uploads/' . $m['icon']) ?>" class="w-full h-full object-cover group-hover:scale-110 transition-all duration-500" alt="<?= $m['nama'] ?>">
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800 text-sm"><?= $m['nama'] ?></p>
                                        <p class="text-[10px] text-gray-400 italic max-w-[200px] truncate"><?= $m['deskripsi'] ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-5">
                                <span class="bg-orange-50 text-orange-500 px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-tighter italic">
                                    <?= $m['kategori'] ?>
                                </span>
                            </td>
                            <td class="p-5 font-black text-gray-700">
                                Rp<?= number_format($m['harga'], 0, ',', '.') ?>
                            </td>
                            <td class="p-5 text-center">
                                <?php if($m['is_unggulan'] == 1): ?>
                                    <span class="bg-green-50 text-green-600 px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-tighter">
                                        ⭐ Unggulan
                                    </span>
                                <?php else: ?>
                                    <span class="text-gray-300 text-[9px] font-bold uppercase tracking-tighter">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="p-5 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="<?= base_url('admin/edit/'.$m['id']) ?>" 
                                       class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-blue-300 hover:bg-blue-50 hover:text-blue-500 transition-all">
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </a>
                                    <a href="<?= base_url('admin/hapus/'.$m['id']) ?>" 
                                       class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-red-300 hover:bg-red-50 hover:text-red-500 transition-all"
                                       onclick="return confirm('Hapus menu ini?')">
                                        <i class="fa-solid fa-trash-can text-xs"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="p-10 text-center text-gray-400 italic">Belum ada menu. Silakan tambah di atas.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <script>
        const fileInput = document.getElementById('foto-input');
        const label = document.querySelector('label[for="foto-input"]');
        
        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                label.innerHTML = `<i class="fa-solid fa-check-circle text-green-500"></i> ${this.files[0].name}`;
                label.classList.add('border-green-500', 'text-green-600');
            }
        });
    </script>
</body>
</html>