<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di TENTUKELAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <?php require_once __DIR__ . '/layouts/navbar.php'; ?>

    <header class="bg-blue-600 text-white">
        <div class="container mx-auto text-center py-20 px-6">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Temukan Kelas Impianmu di Sini!</h1>
            <p class="text-lg md:text-xl mb-8 max-w-2xl mx-auto">TENTUKELAS menyediakan platform pendaftaran kelas yang mudah, cepat, dengan kuota yang selalu update secara real-time.</p>
            <div class="space-x-4">
                <a href="index.php?page=student-dashboard" class="bg-white text-blue-600 font-semibold py-3 px-6 rounded-lg shadow-lg hover:bg-gray-100 transition duration-300">Lihat Semua Kelas</a>
                <a href="index.php?page=register" class="bg-yellow-400 text-gray-800 font-semibold py-3 px-6 rounded-lg shadow-lg hover:bg-yellow-300 transition duration-300">Daftar Sekarang</a>
            </div>
        </div>
    </header>

    <main class="container mx-auto py-16 px-6">
        <section>
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-2">Kelas Unggulan</h2>
            <p class="text-center text-gray-500 mb-12">Daftarkan dirimu di kelas populer yang akan segera dimulai.</p>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php if (!empty($featuredClasses)): ?>
                    <?php foreach ($featuredClasses as $class): ?>
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-2 transition duration-300">
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-2"><?= htmlspecialchars($class['class_name']) ?></h3>
                                <p class="text-gray-600 mb-4 h-24 overflow-hidden"><?= htmlspecialchars(substr($class['description'], 0, 100)) ?>...</p>
                                <div class="text-sm text-gray-500">
                                    <p><strong>Mulai:</strong> <?= date('d M Y', strtotime($class['start_date'])) ?></p>
                                </div>
                            </div>
                            <div class="bg-gray-50 p-4">
                                <a href="index.php?page=student-dashboard" class="text-blue-600 font-semibold hover:underline">Lihat Detail & Daftar</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center text-gray-500 col-span-3">Saat ini belum ada kelas unggulan yang tersedia.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <footer class="bg-gray-800 text-white text-center py-6 mt-16">
        <p>&copy; <?= date('Y') ?> TENTUKELAS. Semua Hak Cipta Dilindungi.</p>
    </footer>

</body>
</html>