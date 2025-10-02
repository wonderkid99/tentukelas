<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelas Saya - TENTUKELAS</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; background-color: #f4f4f9; }
        .container { max-width: 1100px; margin: 1rem auto; padding: 0 1rem; }
        .header { display: flex; justify-content: space-between; align-items: center; background: #fff; padding: 1rem 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .header h1 { margin: 0; font-size: 1.5rem; }
        .header nav a { margin-left: 1.5rem; color: #007bff; text-decoration: none; font-weight: 600; }
        .header nav a.active { color: #333; }
        .header .logout { color: #dc3545; text-decoration: none; font-weight: 600; margin-left: 1.5rem; }
        .class-list { margin-top: 2rem; }
        .class-item { background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 1.5rem; display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; }
        .class-item h3 { margin: 0; }
    </style>
</head>
<body>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<div class="container">

    <h2>Kelas yang Anda Ikuti</h2>
    <div class="class-list">
        <?php if (!empty($myClasses)): ?>
            <?php foreach ($myClasses as $class): ?>
                <div class="class-item">
                    <div>
                        <h3><?= htmlspecialchars($class['class_name']) ?></h3>
                        <p>Jadwal: <?= date('d M Y', strtotime($class['start_date'])) ?></p>
                    </div>
                    <div>
                        Terdaftar pada: <?= date('d M Y', strtotime($class['registration_date'])) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Anda belum mendaftar di kelas manapun.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>