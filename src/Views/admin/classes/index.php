<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kelas - Admin TENTUKELAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">
    <aside class="w-64 bg-gray-800 text-white flex flex-col">
        <div class="h-16 flex items-center justify-center bg-gray-900">
            <h1 class="text-xl font-bold">TENTUKELAS</h1>
        </div>
        <nav class="flex-grow">
            <a href="index.php?page=admin-dashboard" class="block py-2.5 px-4 hover:bg-gray-700 hover:text-white transition duration-200">Dashboard</a>
            <a href="index.php?page=admin-classes" class="block py-2.5 px-4 bg-gray-700 text-white font-semibold">Kelola Kelas</a>
            <a href="index.php?page=logout" class="block py-2.5 px-4 hover:bg-gray-700 hover:text-white transition duration-200">Logout</a>
        </nav>
    </aside>

    <main class="flex-1 p-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold">Manajemen Kelas</h2>
            <a href="index.php?page=admin-classes-create" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">+ Tambah Kelas Baru</a>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-4 font-semibold">Nama Kelas</th>
                        <th class="p-4 font-semibold">Kuota</th>
                        <th class="p-4 font-semibold">Jadwal Mulai</th>
                        <th class="p-4 font-semibold">Jadwal Selesai</th>
                        <th class="p-4 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($classes)): ?>
                        <?php foreach ($classes as $class): ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-4"><?= htmlspecialchars($class['class_name']) ?></td>
                                <td class="p-4"><?= htmlspecialchars($class['quota']) ?></td>
                                <td class="p-4"><?= date('d M Y, H:i', strtotime($class['start_date'])) ?></td>
                                <td class="p-4"><?= date('d M Y, H:i', strtotime($class['end_date'])) ?></td>
                                <td class="p-4 flex gap-2">
                                    <a href="index.php?page=admin-classes-edit&id=<?= $class['id'] ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-bold py-1 px-3 rounded">Edit</a>
                                    <a href="index.php?page=admin-classes-delete&id=<?= $class['id'] ?>" onclick="return confirm('Apakah Anda yakin?')" class="bg-red-600 hover:bg-red-700 text-white text-sm font-bold py-1 px-3 rounded">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5" class="p-4 text-center">Belum ada kelas yang dibuat.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>

</body>
</html>