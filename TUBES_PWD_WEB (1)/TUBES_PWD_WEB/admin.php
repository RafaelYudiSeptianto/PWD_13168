<?php
session_start();
include 'config/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['tambah_lapangan'])) {
    $nama  = mysqli_real_escape_string($conn, $_POST['nama_lapangan']);
    $jenis = mysqli_real_escape_string($conn, $_POST['jenis_rumput']);
    $harga = $_POST['harga_per_jam'];
    $desk  = mysqli_real_escape_string($conn, $_POST['deskripsi']);

    mysqli_query($conn, "INSERT INTO lapangan (nama_lapangan, jenis_rumput, harga_per_jam, deskripsi) VALUES ('$nama', '$jenis', '$harga', '$desk')");
    header("Location: admin.php");
    exit;
}

if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    mysqli_query($conn, "DELETE FROM lapangan WHERE id = $id");
    header("Location: admin.php");
    exit;
}

$lapangan = mysqli_query($conn, "SELECT * FROM lapangan");
$reservasi = mysqli_query($conn, "SELECT r.*, u.nama AS pemesan, l.nama_lapangan FROM reservasi r JOIN users u ON r.user_id = u.id JOIN lapangan l ON r.lapangan_id = l.id");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin - Atma Futsal</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="admin-layout">
        <aside class="sidebar">
            <h3>ATMA FUTSAL</h3>
            <a href="admin.php" class="active">Dashboard & Lapangan</a>
            <a href="index.php" target="_blank">Lihat Website</a>
            <a href="logout.php" style="color: #fca5a5;">Logout</a>
        </aside>

        <main class="admin-content">
            <h2 style="margin-bottom: 20px;">Panel Admin Atma Futsal</h2>

            <div class="admin-card">
                <h3 style="margin-bottom: 15px;">Tambah Data Lapangan</h3>
                <form method="POST" style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label>Nama Lapangan</label>
                        <input type="text" name="nama_lapangan" placeholder="Contoh: Lapangan A (VIP)" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Rumput / Lantai</label>
                        <select name="jenis_rumput">
                            <option value="Sintetis">Rumput Sintetis</option>
                            <option value="Vinyl">Vinyl</option>
                            <option value="Interlock">Interlock</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Harga Per Jam (Rp)</label>
                        <input type="number" name="harga_per_jam" placeholder="120000" required>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Singkat</label>
                        <input type="text" name="deskripsi" placeholder="Standar nasional, pencahayaan LED">
                    </div>
                    <div style="grid-column: 1/-1;">
                        <button type="submit" name="tambah_lapangan" class="btn-primary" style="width: auto; padding: 10px 25px;">Simpan Lapangan</button>
                    </div>
                </form>
            </div>

            <div class="admin-card">
                <h3>Data Lapangan</h3>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lapangan</th>
                            <th>Jenis</th>
                            <th>Harga per Jam</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; while ($row = mysqli_fetch_assoc($lapangan)): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['nama_lapangan']); ?></td>
                            <td><?= htmlspecialchars($row['jenis_rumput']); ?></td>
                            <td>Rp <?= number_format($row['harga_per_jam'], 0, ',', '.'); ?></td>
                            <td>
                                <a href="admin.php?hapus=<?= $row['id']; ?>" class="btn-danger" onclick="return confirm('Hapus lapangan ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <div class="admin-card">
                <h3>Daftar Booking Lapangan</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Pemesan</th>
                            <th>Lapangan</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($res = mysqli_fetch_assoc($reservasi)): ?>
                        <tr>
                            <td><?= htmlspecialchars($res['pemesan']); ?></td>
                            <td><?= htmlspecialchars($res['nama_lapangan']); ?></td>
                            <td><?= $res['tanggal_play']; ?></td>
                            <td><?= $res['jam_mulai'] . ' - ' . $res['jam_selesai']; ?></td>
                            <td>Rp <?= number_format($res['total_harga'], 0, ',', '.'); ?></td>
                            <td><?= strtoupper($res['status_reservasi']); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>