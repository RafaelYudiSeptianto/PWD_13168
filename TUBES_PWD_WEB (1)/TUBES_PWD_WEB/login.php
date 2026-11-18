<?php
session_start();
include 'config/koneksi.php';

$error = "";
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        if ($password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['role'] = $user['role'];
            header("Location: admin.php");
            exit;
        }
    }
    $error = "Email atau password salah!";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Atma Futsal</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="login-wrapper">
        <div class="login-left">
            <h2>Login Akun</h2>
            <p>Masuk ke sistem manajemen reservasi Atma Futsal</p>
            
            <?php if ($error): ?>
                <div style="background: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                    <?= $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="admin@atmafutsal.com" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Masukkan password" required>
                </div>
                <button type="submit" name="login" class="btn-primary">LOGIN</button>
            </form>
            <a href="index.php" style="margin-top: 20px; display: inline-block; color: #64748b; text-decoration: none; font-size: 0.9rem;">&larr; Kembali ke Beranda</a>
        </div>

        <div class="login-right">
            <p style="font-size: 1.1rem; color: #facc15; margin-bottom: 8px;">Aplikasi Pemesanan Lapangan</p>
            <h1 style="font-size: 2.5rem;">Atma Futsal Arena</h1>
        </div>
    </div>
</body>
</html>