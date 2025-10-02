<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TENTUKELAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 -mt-16">
        <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-xl shadow-lg">
            <div>
                <h2 class="mt-6 text-center text-3xl font-bold text-gray-900">
                    Login ke Akun Anda
                </h2>
            </div>
            
            <?php if(isset($_GET['status']) && $_GET['status'] == 'reg_success'): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Registrasi berhasil!</strong>
                    <span class="block sm:inline">Silakan login dengan akun baru Anda.</span>
                </div>
            <?php endif; ?>
            <?php if(isset($_GET['error']) && $_GET['error'] == 'invalid_credentials'): ?>
                 <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Login Gagal!</strong>
                    <span class="block sm:inline">Email atau password yang Anda masukkan salah.</span>
                </div>
            <?php endif; ?>
             <?php if(isset($_GET['status']) && $_GET['status'] == 'logout_success'): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">Anda telah berhasil logout.</span>
                </div>
            <?php endif; ?>

            <form class="mt-8 space-y-6" action="index.php?page=login" method="POST">
                <input type="hidden" name="remember" value="true">
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="email" class="sr-only">Email</label>
                        <input id="email" name="email" type="email" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" placeholder="Alamat email">
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" placeholder="Password">
                    </div>
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Login
                    </button>
                </div>
            </form>
            <div class="text-sm text-center">
                <a href="index.php?page=register" class="font-medium text-blue-600 hover:text-blue-500">
                    Belum punya akun? Daftar di sini
                </a>
            </div>
        </div>
    </div>
</body>
</html>