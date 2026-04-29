<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu — CaféEase</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-800 p-6 md:p-12">

    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <a href="<?= base_url('admin/kelola_menu') ?>" class="text-slate-400 hover:text-slate-600 text-sm flex items-center gap-2 mb-2">
                ← Kembali ke Kelola Menu
            </a>
            <h1 class="text-3xl font-bold text-slate-900">Edit Menu</h1>
            <p class="text-slate-500">Perbarui informasi menu "<?= esc($menu['nama']) ?>"</p>
        </div>

        <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200">
            <form action="<?= base_url('admin/update/' . $menu['id']) ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                
                <div>
                    <label class="block text-sm font-semibold mb-2">Nama Menu</label>
                    <input type="text" name="nama" value="<?= esc($menu['nama']) ?>" required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-400 focus:outline-none transition">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold mb-2">Harga (Rp)</label>
                        <input type="number" name="harga" value="<?= esc($menu['harga']) ?>" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-400 focus:outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2">Kategori</label>
                        <select name="kategori" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-400 focus:outline-none transition">
                            <option value="Makanan" <?= $menu['kategori'] == 'Makanan' ? 'selected' : '' ?>>Makanan</option>
                            <option value="Minuman" <?= $menu['kategori'] == 'Minuman' ? 'selected' : '' ?>>Minuman</option>
                            <option value="Dessert" <?= $menu['kategori'] == 'Dessert' ? 'selected' : '' ?>>Dessert</option>
                            <option value="Snack" <?= $menu['kategori'] == 'Snack' ? 'selected' : '' ?>>Snack</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2">Deskripsi Singkat</label>
                    <textarea name="deskripsi" rows="3" 
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-orange-400 focus:outline-none transition"><?= esc($menu['deskripsi']) ?></textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2">Foto Menu</label>
                    <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-2xl border border-dashed border-slate-300">
                        <img src="<?= base_url('uploads/' . $menu['icon']) ?>" class="w-20 h-20 object-cover rounded-xl shadow-sm">
                        <div class="flex-1">
                            <input type="file" name="icon" class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-orange-50 file:text-orange-600 hover:file:bg-orange-100">
                            <p class="text-[10px] text-slate-400 mt-2">*Biarkan kosong jika tidak ingin mengganti foto</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3 bg-orange-50 p-4 rounded-2xl">
                    <input type="checkbox" name="is_unggulan" id="unggulan" value="1" <?= $menu['is_unggulan'] ? 'checked' : '' ?>
                        class="w-5 h-5 accent-orange-500">
                    <label for="unggulan" class="text-sm font-medium text-orange-800">Tampilkan sebagai Menu Unggulan di depan</label>
                </div>

                <div class="flex gap-3 pt-4 border-t border-slate-100">
                    <button type="submit" class="flex-1 bg-orange-500 text-white py-4 rounded-2xl font-bold shadow-lg shadow-orange-200 hover:bg-orange-600 transition">
                        Simpan Perubahan
                    </button>
                    <a href="<?= base_url('admin/kelola_menu') ?>" class="px-8 py-4 bg-slate-100 text-slate-500 rounded-2xl font-bold hover:bg-slate-200 transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>