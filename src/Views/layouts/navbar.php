<?php
// Pastikan session sudah dimulai di index.php, jadi kita bisa langsung pakai
$isLoggedIn = Auth::isLoggedIn();
$isAdmin = Auth::isAdmin();
$userName = $_SESSION['user_name'] ?? '';
?>

<style>
    .main-navbar {
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        padding: 0 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 60px;
    }
    .main-navbar .logo {
        font-weight: bold;
        font-size: 1.5rem;
        color: #333;
        text-decoration: none;
    }
    .main-navbar .nav-links {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }
    .main-navbar .nav-links a {
        text-decoration: none;
        color: #555;
        font-weight: 500;
        padding: 5px 0;
        border-bottom: 2px solid transparent;
        transition: color 0.3s, border-bottom-color 0.3s;
    }
    .main-navbar .nav-links a:hover,
    .main-navbar .nav-links a.active {
        color: #007bff;
        border-bottom-color: #007bff;
    }
    .main-navbar .user-info {
        color: #777;
    }
    .main-navbar .btn-logout {
        background-color: #dc3545;
        color: #fff;
        padding: 8px 15px;
        border-radius: 5px;
        text-decoration: none;
    }
     .main-navbar .btn-logout:hover {
        background-color: #c82333;
        border-bottom-color: transparent;
    }
</style>

<nav class="main-navbar">
    <a href="index.php?page=home" class="logo">TENTUKELAS</a>

    <div class="nav-links">
        <?php if (!$isLoggedIn): ?>
            <a href="index.php?page=login">Login</a>
            <a href="index.php?page=register">Register</a>
        <?php else: ?>
            <?php if ($isAdmin): ?>
                <a href="index.php?page=admin-dashboard">Dashboard Admin</a>
                <a href="index.php?page=admin-classes">Kelola Kelas</a>
            <?php else: ?>
                <a href="index.php?page=student-dashboard">Semua Kelas</a>
                <a href="index.php?page=my-classes">Kelas Saya</a>
            <?php endif; ?>

            <span class="user-info">Halo, <?= htmlspecialchars($userName) ?>!</span>
            <a href="index.php?page=logout" class="btn-logout">Logout</a>
        <?php endif; ?>
    </div>
</nav>