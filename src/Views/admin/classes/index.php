<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - Kelola Kelas</title>
    <style>
      body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
          "Helvetica Neue", Arial, sans-serif;
      }
      .container {
        max-width: 1100px;
        margin: 2rem auto;
        padding: 0 1rem;
      }
      table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
      }
      th,
      td {
        border: 1px solid #e2e8f0;
        padding: 0.75rem 1rem;
        text-align: left;
      }
      th {
        background-color: #f7fafc;
      }
      .btn {
        display: inline-block;
        padding: 0.5rem 1rem;
        background-color: #4299e1;
        color: white;
        text-decoration: none;
        border-radius: 0.25rem;
      }
      .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="header">
        <h1>Manajemen Kelas</h1>
        <a href="#" class="btn">+ Tambah Kelas Baru</a>
      </div>

      <table>
        <thead>
          <tr>
            <th>Nama Kelas</th>
            <th>Kuota</th>
            <th>Jadwal Mulai</th>
            <th>Jadwal Selesai</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($classes)): ?>
          <?php foreach ($classes as $class): ?>
          <tr>
            <td><?= htmlspecialchars($class['class_name']) ?></td>
            <td>
              <?= htmlspecialchars($class['quota']) ?>
            </td>
            <td>
              <?= date('d M Y, H:i', strtotime($class['start_date'])) ?>
              WIB
            </td>
            <td>
              <?= date('d M Y, H:i', strtotime($class['end_date'])) ?>
              WIB
            </td>
            <td>
              <a href="#">Edit</a> |
              <a href="#">Hapus</a>
            </td>
          </tr>
          <?php endforeach; ?>
          <?php else: ?>
          <tr>
            <td colspan="5" style="text-align: center">
              Belum ada kelas yang dibuat.
            </td>
          </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </body>
</html>
