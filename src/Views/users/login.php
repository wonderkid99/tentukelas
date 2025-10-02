<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TENTUKELAS</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; background-color: #f4f4f9; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background-color: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        h1 { text-align: center; color: #333; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; margin-bottom: 0.5rem; color: #555; }
        input[type="email"], input[type="password"] { width: 100%; padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn { width: 100%; padding: 0.75rem; background-color: #007bff; color: white; text-decoration: none; border: none; border-radius: 4px; cursor: pointer; font-size: 1rem; }
        .register-link { text-align: center; margin-top: 1rem; }
        .register-link a { color: #007bff; text-decoration: none; }
        .message { padding: 1rem; margin-bottom: 1rem; border-radius: 4px; text-align: center; }
        .success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Login</h1>

        <?php if(isset($_GET['status']) && $_GET['status'] == 'reg_success'): ?>
            <p class="message success">Registrasi berhasil! Silakan login.</p>
        <?php endif; ?>
        <?php if(isset($_GET['error']) && $_GET['error'] == 'invalid_credentials'): ?>
            <p class="message error">Email atau password salah.</p>
        <?php endif; ?>
         <?php if(isset($_GET['status']) && $_GET['status'] == 'logout_success'): ?>
            <p class="message success">Anda telah berhasil logout.</p>
        <?php endif; ?>

        <form action="index.php?page=login" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
        <div class="register-link">
            <p>Belum punya akun? <a href="index.php?page=register">Daftar di sini</a></p>
        </div>
    </div>
</body>
</html>