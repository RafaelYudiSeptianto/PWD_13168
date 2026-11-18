<?php
include 'config/koneksi.php';
$query = mysqli_query($conn, "SELECT * FROM lapangan");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atma Futsal - Website Katalog Lapangan</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

    <nav class="navbar">
        <a href="index.php" class="logo-box">ATMA FUTSAL</a>
        <div class="nav-links">
            <a href="#home">HOME</a>
            <a href="#lapangan">LAPANGAN</a>
            <a href="#contact">CONTACT</a>
            <a href="login.php" class="btn-login-nav">LOGIN</a>
        </div>
    </nav>

    <header id="home" class="hero">
        <p>Website Katalog Lapangan</p>
        <h1>ATMA FUTSAL ARENA</h1>
    </header>

    <section class="section-container">
        <h2>Selamat datang di Atma Futsal</h2>
        <p class="subtitle">Anda bisa melihat daftar lapangan yang ada, jadwal penggunaan lapangan, dan booking lapangan secara langsung.</p>
        
        <img src="https://images.unsplash.com/photo-1575361204480-aadea25e6e68?auto=format&fit=crop&w=900&q=80" alt="Lapangan Atma Futsal" class="featured-img">

        <div id="lapangan" style="margin-top: 30px;">
            <h2>Daftar Lapangan Tersedia</h2>
            <p class="subtitle">Pilih jenis lapangan terbaik sesuai kebutuhan tim Anda</p>

            <div class="lapangan-grid">
                <?php if (mysqli_num_rows($query) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($query)): ?>
                        <div class="card">
                            <img src="https://images.unsplash.com/photo-1575361204480-aadea25e6e68?auto=format&fit=crop&w=600&q=80" alt="<?= htmlspecialchars($row['nama_lapangan']); ?>">
                            <div class="card-body">
                                <h3><?= htmlspecialchars($row['nama_lapangan']); ?></h3>
                                <p>Jenis Lantai: <strong><?= htmlspecialchars($row['jenis_rumput']); ?></strong></p>
                                <p style="font-size: 0.9rem; color: #64748b; margin-top: 5px;"><?= htmlspecialchars($row['deskripsi']); ?></p>
                                <div class="price">Rp <?= number_format($row['harga_per_jam'], 0, ',', '.'); ?> / Jam</div>
                                <a href="https://wa.me/6281234567890?text=Halo%20Atma%20Futsal,%20saya%20ingin%20booking%20<?= urlencode($row['nama_lapangan']); ?>" target="_blank" class="btn-wa">Booking via WhatsApp</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p style="grid-column: 1/-1; text-align: center; color: #64748b;">Belum ada data lapangan. Silakan login sebagai admin untuk menambahkan data lapangan.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <footer id="contact" style="background-color: #0a2540; color: white; text-align: center; padding: 35px 20px; margin-top: 60px;">
        <h3>ATMA FUTSAL ARENA</h3>
        <p style="margin: 10px 0; color: #cbd5e1;">Jl. Babarsari No. 11, Yogyakarta | WhatsApp: 082152730812</p>
        <p style="font-size: 0.85rem; color: #94a3b8;">&copy; 2026 Sistem Informasi Reservasi Lapangan Futsal - Atma Futsal</p>
    </footer>

</body>
</html>