<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - TENTUKELAS</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; background-color: #f8f9fa; margin: 0; }
        .admin-wrapper { display: flex; }
        .sidebar { width: 250px; background: #343a40; color: #fff; min-height: 100vh; }
        .sidebar h2 { text-align: center; padding: 1.5rem 0; margin: 0; background: #495057; }
        .sidebar-nav { list-style: none; padding: 0; margin: 0; }
        .sidebar-nav li a { display: block; padding: 1rem 1.5rem; color: #adb5bd; text-decoration: none; border-left: 3px solid transparent; }
        .sidebar-nav li a.active, .sidebar-nav li a:hover { color: #fff; background: #495057; border-left-color: #007bff; }
        .main-content { flex-grow: 1; padding: 2rem; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
        .stat-cards { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 1.5rem; }
        .card { background: #fff; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .card h3 { margin-top: 0; color: #6c757d; }
        .card .stat-number { font-size: 2.5rem; font-weight: bold; color: #343a40; }
        .charts-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem; margin-top: 3rem; }
        .recent-registrations { margin-top: 3rem; }
        table { width: 100%; border-collapse: collapse; background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        th, td { padding: 1rem; border-bottom: 1px solid #dee2e6; text-align: left; }
        th { background-color: #e9ecef; }
        @media (max-width: 992px) {
            .charts-grid { grid-template-columns: 1fr; }
        }
        .charts-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem; margin-top: 3rem; }

        /* CSS BARU UNTUK WADAH GRAFIK */
        .chart-container {
            position: relative;
            height: 400px; /* Memberikan tinggi yang pasti untuk grafik */
            width: 100%;
        }
    </style>
</head>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<body>
<div class="admin-wrapper">
    <aside class="sidebar"></aside>
    <main class="main-content">
        <div class="header"></div>
        <div class="stat-cards"></div>

        <div class="charts-grid">
            <div class="card">
                <h3>Tren Pendaftaran Harian</h3>
                <div class="chart-container">
                    <canvas id="registrationTrendChart"></canvas>
                </div>
            </div>
            <div class="card">
                <h3>Popularitas Kelas</h3>
                <div class="chart-container">
                    <canvas id="classPopularityChart"></canvas>
                </div>
            </div>
        </div>

        <div class="recent-registrations"></div>
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