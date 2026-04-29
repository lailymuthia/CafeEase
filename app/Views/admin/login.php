<!DOCTYPE html>
<html>
<head>
    <title>CaféEase — Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-[#4A5D45] to-[#2C3328] min-h-screen flex items-center justify-center p-6">
    <div class="bg-[#FDFBF7] p-10 rounded-[2.5rem] shadow-2xl w-full max-w-md text-center">
        <h1 class="text-3xl font-serif italic font-bold text-[#4A5D45]">Café<span class="text-[#D48C7C]">Ease</span></h1>
        <p class="text-[10px] tracking-[0.3em] uppercase text-gray-400 mt-1 mb-8">Admin Panel</p>
        
        <form action="<?= base_url('admin/auth') ?>" method="POST" class="space-y-5">
            <div class="text-left">
                <label class="text-xs font-bold ml-2">Username</label>
                <input type="text" name="username" class="w-full mt-1 p-4 rounded-2xl bg-gray-50 border-none outline-none ring-1 ring-gray-200 focus:ring-2 focus:ring-[#4A5D45]" placeholder="admin">
            </div>
            <div class="text-left">
                <label class="text-xs font-bold ml-2">Password</label>
                <input type="password" name="password" class="w-full mt-1 p-4 rounded-2xl bg-gray-50 border-none outline-none ring-1 ring-gray-200 focus:ring-2 focus:ring-[#4A5D45]" placeholder="••••••">
            </div>
            <button class="w-full bg-[#4A5D45] text-white py-4 rounded-2xl font-bold hover:bg-[#3d4d38] transition-all shadow-lg shadow-[#4A5D45]/30">Masuk ke Dashboard →</button>
        </form>
    </div>
</body>
</html>