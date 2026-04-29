<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Identitas — Café Nula</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F7F3EE] min-h-screen flex items-center justify-center p-4 font-sans">
    <div class="bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl overflow-hidden">
        <div class="bg-gradient-to-br from-[#617A55] to-[#4a5e3f] p-10 text-center text-white">
            <h1 class="text-3xl font-serif italic">Café Nula</h1>
            <p class="text-xs opacity-70 mt-2">Lengkapi data diri untuk mulai memesan</p>
        </div>
        <form action="/simpan-identitas" method="POST" class="p-8 space-y-6">
            <div class="bg-[#F0F5ED] py-3 rounded-xl text-center text-[#617A55] font-bold text-sm">🪑 Meja Nomor: <?= $mejaAktif ?></div>
            <div>
                <label class="text-[10px] uppercase font-bold text-gray-400 block mb-2 tracking-widest italic">👤 Nama Pelanggan</label>
                <input type="text" name="nama" required placeholder="Contoh: Budi Santoso" class="w-full border border-gray-100 rounded-xl p-4 outline-none focus:ring-2 ring-[#617A55]/20 text-gray-700 transition">
            </div>
            <div>
                <label class="text-[10px] uppercase font-bold text-gray-400 block mb-2 tracking-widest italic">📱 Nomor WhatsApp</label>
                <input type="number" name="hp" required placeholder="Contoh: 081234..." class="w-full border border-gray-100 rounded-xl p-4 outline-none focus:ring-2 ring-[#617A55]/20 text-gray-700 transition">
            </div>
            <button type="submit" class="w-full bg-[#4A3F35] text-white py-4 rounded-xl font-bold shadow-lg hover:bg-black transition-all">Lanjut ke Menu →</button>
            <p class="text-[9px] text-center text-gray-400 leading-relaxed">🔒 Data kamu aman, hanya digunakan untuk memproses pesanan.</p>
        </form>
    </div>
</body>
</html>