<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - TENTUKELAS</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; background-color: #f4f4f9; }
        .container { max-width: 1100px; margin: 1rem auto; padding: 0 1rem; }
        .header { display: flex; justify-content: space-between; align-items: center; background: #fff; padding: 1rem 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .header h1 { margin: 0; font-size: 1.5rem; }
        .header nav a { margin-left: 1.5rem; color: #007bff; text-decoration: none; font-weight: 600; }
        .header nav a.active { color: #333; }
        .header .logout { color: #dc3545; text-decoration: none; font-weight: 600; margin-left: 1.5rem; }
        .class-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem; margin-top: 2rem; }
        .class-card { background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); overflow: hidden; display: flex; flex-direction: column; }
        .class-card-content { padding: 1.5rem; flex-grow: 1; }
        .class-card h3 { margin-top: 0; }
        .class-card-footer { background: #f7fafc; padding: 1rem 1.5rem; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; }
        .quota { font-weight: bold; }
        .quota-full { color: #dc3545; }
        .btn { display: inline-block; padding: 0.5rem 1rem; color: white; text-decoration: none; border-radius: 0.25rem; border: none; cursor: pointer; font-weight: 600; }
        .btn-green { background-color: #28a745; }
        .btn-grey { background-color: #6c757d; cursor: not-allowed; }
        .message { padding: 1rem; margin-bottom: 1rem; border-radius: 4px; text-align: center; }
        .success { background-color: #d4edda; color: #155724; }
        .error { background-color: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>
<div class="container">

    <?php if(isset($_GET['status']) && $_GET['status'] == 'reg_success'): ?>
        <p class="message success">Selamat! Anda berhasil mendaftar kelas.</p>
    <?php endif; ?>
    <?php if(isset($_GET['error'])): ?>
        <p class="message error"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>

    <h2>Kelas yang Tersedia</h2>
    <div class="class-grid">
        <?php if (!empty($classes)): ?>
            <?php foreach ($classes as $class): ?>
                <div class="class-card">
                    <div class="class-card-content">
                        <h3><?= htmlspecialchars($class['class_name']) ?></h3>
                        <p><?= nl2br(htmlspecialchars($class['description'])) ?></p>
                        <small>Jadwal: <?= date('d M Y', strtotime($class['start_date'])) ?> - <?= date('d M Y', strtotime($class['end_date'])) ?></small>
                    </div>
                    <div class="class-card-footer">
                        <span class="quota <?= $class['remaining_quota'] <= 0 ? 'quota-full' : '' ?>">
                            Sisa Kuota: <?= $class['remaining_quota'] ?>
                        </span>
                        
                        <?php if (in_array($class['id'], $myClassIds)): ?>
                            <button class="btn btn-grey" disabled>Sudah Terdaftar</button>
                        <?php elseif ($class['remaining_quota'] <= 0): ?>
                            <button class="btn btn-grey" disabled>Penuh</button>
                        <?php else: ?>
                            <form action="index.php?page=register-class" method="POST" style="margin:0;">
                                <input type="hidden" name="class_id" value="<?= $class['id'] ?>">
                                <button type="submit" class="btn btn-green">Daftar</button>
                            </form>
                        <?php endif; ?>

                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Saat ini belum ada kelas yang tersedia.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>