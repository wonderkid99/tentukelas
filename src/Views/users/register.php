<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun - TENTUKELAS</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; background-color: #f4f4f9; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background-color: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        h1 { text-align: center; color: #333; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; margin-bottom: 0.5rem; color: #555; }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%; padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;
        }
        .btn { width: 100%; padding: 0.75rem; background-color: #4299e1; color: white; text-decoration: none; border: none; border-radius: 4px; cursor: pointer; font-size: 1rem; }
        .login-link { text-align: center; margin-top: 1rem; }
        .login-link a { color: #4299e1; text-decoration: none; }
    </style>
</head>
<body>

<div class="card">
    <h1>Buat Akun Baru</h1>
    <form action="index.php?page=register" method="POST">
        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Konfirmasi Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn">Daftar</button>
    </form>
    <div class="login-link">
        <p>Sudah punya akun? <a href="index.php?page=login">Login di sini</a></p>
    </div>
</div>

</body>
</html>