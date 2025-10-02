<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - TENTUKELAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">
    <aside class="w-64 bg-gray-800 text-white flex flex-col">
        <div class="h-16 flex items-center justify-center bg-gray-900">
            <h1 class="text-xl font-bold">TENTUKELAS</h1>
        </div>
        <nav class="flex-grow">
            <a href="index.php?page=admin-dashboard" class="block py-2.5 px-4 bg-gray-700 text-white font-semibold">Dashboard</a>
            <a href="index.php?page=admin-classes" class="block py-2.5 px-4 hover:bg-gray-700 hover:text-white transition duration-200">Kelola Kelas</a>
            <a href="index.php?page=logout" class="block py-2.5 px-4 hover:bg-gray-700 hover:text-white transition duration-200">Logout</a>
        </nav>
    </aside>

    <main class="flex-1 p-8">
        <h2 class="text-3xl font-bold mb-8">Dashboard Admin</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-gray-500 font-semibold">Total Siswa</h3>
                <p class="text-3xl font-bold mt-2"><?= $stats['total_students'] ?></p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-gray-500 font-semibold">Kelas Aktif</h3>
                <p class="text-3xl font-bold mt-2"><?= $stats['active_classes'] ?></p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-gray-500 font-semibold">Total Pendaftaran</h3>
                <p class="text-3xl font-bold mt-2"><?= $stats['total_registrations'] ?></p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 mb-8">
            <div class="lg:col-span-3 bg-white p-6 rounded-lg shadow-md">
                <h3 class="font-semibold mb-4">Tren Pendaftaran Harian</h3>
                <div class="relative h-96">
                    <canvas id="registrationTrendChart"></canvas>
                </div>
            </div>
            <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md">
                <h3 class="font-semibold mb-4">Popularitas Kelas</h3>
                <div class="relative h-96">
                    <canvas id="classPopularityChart"></canvas>
                </div>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow-md">
             <h3 class="font-semibold mb-4">Pendaftaran Terbaru</h3>
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-3">Tanggal</th>
                        <th class="p-3">Nama Siswa</th>
                        <th class="p-3">Kelas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($latestRegistrations)): ?>
                        <?php foreach ($latestRegistrations as $reg): ?>
                            <tr class="border-b">
                                <td class="p-3"><?= date('d M Y H:i', strtotime($reg['registration_date'])) ?></td>
                                <td class="p-3"><?= htmlspecialchars($reg['user_name']) ?></td>
                                <td class="p-3"><?= htmlspecialchars($reg['class_name']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="3" class="p-3 text-center">Belum ada pendaftaran.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>

<script>
    // Mengambil data JSON yang dikirim dari DashboardController
    const chartData = JSON.parse('<?= $chartDataJSON ?>');

    // --- Grafik 1: Popularitas Kelas (Bar Chart) ---
    const popCtx = document.getElementById('classPopularityChart').getContext('2d');
    const classLabels = chartData.classPopularity.map(item => item.class_name);
    const classData = chartData.classPopularity.map(item => item.registration_count);
    
    new Chart(popCtx, {
        type: 'bar',
        data: {
            labels: classLabels,
            datasets: [{
                label: 'Jumlah Pendaftar',
                data: classData,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y', // Membuat bar menjadi horizontal agar nama kelas mudah dibaca
            scales: {
                x: { beginAtZero: true }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // --- Grafik 2: Tren Pendaftaran (Line Chart) ---
    const trendCtx = document.getElementById('registrationTrendChart').getContext('2d');
    const trendLabels = chartData.registrationTrend.map(item => item.registration_day);
    const trendData = chartData.registrationTrend.map(item => item.count);

    new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: trendLabels,
            datasets: [{
                label: 'Jumlah Pendaftaran per Hari',
                data: trendData,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>

</body>
</html>