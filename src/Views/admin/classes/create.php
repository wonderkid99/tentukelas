<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Tambah Kelas Baru</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; }
        .container { max-width: 800px; margin: 2rem auto; padding: 0 1rem; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; margin-bottom: 0.5rem; }
        input[type="text"], input[type="number"], input[type="datetime-local"], textarea {
            width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;
        }
        .btn { padding: 0.75rem 1.5rem; background-color: #28a745; color: white; text-decoration: none; border: none; border-radius: 0.25rem; cursor: pointer; }
        .btn-secondary { background-color: #6c757d; }
    </style>
</head>
<body>

<div class="container">
    <h1>Tambah Kelas Baru</h1>
    
    <form action="index.php?page=admin-classes-store" method="POST">
        <div class="form-group">
            <label for="class_name">Nama Kelas</label>
            <input type="text" id="class_name" name="class_name" required>
        </div>
        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea id="description" name="description" rows="4"></textarea>
        </div>
        <div class="form-group">
            <label for="quota">Kuota</label>
            <input type="number" id="quota" name="quota" required>
        </div>
        <div class="form-group">
            <label for="start_date">Jadwal Mulai</label>
            <input type="datetime-local" id="start_date" name="start_date" required>
        </div>
        <div class="form-group">
            <label for="end_date">Jadwal Selesai</label>
            <input type="datetime-local" id="end_date" name="end_date" required>
        </div>
        
        <button type="submit" class="btn">Simpan Kelas</button>
        <a href="index.php?page=admin-classes" class="btn btn-secondary">Batal</a>
    </form>
</div>

</body>
</html>