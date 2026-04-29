<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesanan Berhasil — Café Nula</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,400&display=swap'); 
        .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#617A55] min-h-screen flex items-center justify-center p-6 text-white text-center">
    
    <div class="max-w-md w-full space-y-8">
        <div class="text-6xl animate-bounce">☕</div>
        
        <div class="space-y-2">
            <h1 class="text-4xl font-serif italic text-[#EAD8C0]">Terima Kasih, <?= $nama ?>!</h1>
            <p class="text-xs tracking-[0.3em] opacity-70 uppercase">Pesanan Telah Kami Terima</p>
        </div>

        <div class="bg-white/10 backdrop-blur-md border border-white/20 p-8 rounded-[2.5rem] shadow-2xl">
            <h2 class="text-xl font-bold">Segera diantar ke <span class="text-[#EAD8C0]">Meja <?= $meja ?></span></h2>
            <p class="text-sm italic opacity-70 mt-4 leading-relaxed">
                Silahkan duduk manis, hidangan spesialmu sedang kami siapkan.
            </p>
        </div>

        <div class="flex flex-col gap-3">
            <a href="<?= base_url('menu') ?>" class="bg-[#D48C7C] py-4 rounded-2xl font-bold shadow-lg hover:scale-105 transition">
                Pesan Lagi?
            </a>
            
            <a href="<?= base_url('reset-meja') ?>" class="py-4 text-[11px] uppercase tracking-[0.3em] opacity-50 hover:opacity-100 transition font-bold">
                Selesai & Keluar
            </a>
        </div>

        <footer class="pt-10 opacity-30 text-[9px] uppercase tracking-widest">
            A signature of taste, by Café Nula
        </footer>
    </div>

</body>
</html>