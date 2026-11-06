<h3>Belanja</h3>
<p>Daftar Kategori:</p>
<form method="POST" action="">
    <p>Makanan dan Minuman: <br />
        <select name="makanan_minuman">
            <option value="">-- Pilih Makanan/Minuman --</option>
            <option value="pop mie">Pop Mie</option>
            <option value="air mineral">Air Mineral</option>
        </select>
    </p>
    <p>Alat Tulis: <br />
        <select name="alat_tulis">
            <option value="">-- Pilih Alat Tulis --</option>
            <option value="pulpen">Pulpen</option>
            <option value="tipe-x">Tipe-x</option>
        </select>
    </p>
    <button type="submit">Kirim</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $makanan_minuman = $_POST['makanan_minuman'] ?? '';
    $alat_tulis = $_POST['alat_tulis'] ?? '';
    $message = array();

    if (empty($makanan_minuman) || empty($alat_tulis)) {
        $message[] = "Harap pilih produk makanan/minuman dan alat tulis.";
    }

    if (!empty($message)) {
        foreach ($message as $msg) {
            echo "<p style='color:red;'> " . htmlspecialchars($msg) . " !!</p>";
        }
    } else {
        $harga_makanan = 0;
        if ($makanan_minuman == 'pop mie') {
            $harga_makanan = 5000;
        } elseif ($makanan_minuman == 'air mineral') {
            $harga_makanan = 4000;
        }

        $harga_alat = 0;
        if ($alat_tulis == 'pulpen') {
            $harga_alat = 2000;
        } elseif ($alat_tulis == 'tipe-x') {
            $harga_alat = 8000;
        }

        $totalBayar = $harga_makanan + $harga_alat;

        function dapatDiskon($totalBayar) {
            if ($totalBayar >= 10000) {
                return 0.05;
            } else {
                return 0;
            }
        }

        function totalHarga($diskon, $totalBayar) {
            return $totalBayar - ($totalBayar * $diskon);
        }

        $diskon = dapatDiskon($totalBayar);
        $jumlahTotalHarga = totalHarga($diskon, $totalBayar);

        echo "<h2>Informasi Belanja</h2>";
        echo "<p><strong>Makanan dan Minuman: </strong>" . htmlspecialchars($makanan_minuman) . " (Rp " . htmlspecialchars($harga_makanan) . ")</p>";
        echo "<p><strong>Alat Tulis: </strong>" . htmlspecialchars($alat_tulis) . " (Rp " . htmlspecialchars($harga_alat) . ")</p>";
        echo "<p><strong>Total Harga: </strong> Rp " . htmlspecialchars($jumlahTotalHarga) . "</p>";
        echo "<p><strong>Diskon: </strong> " . htmlspecialchars($diskon * 100) . "%</p>";

        if ($diskon == 0) {
            echo "<p>Maaf tidak ada diskon yang diberikan.</p>";
        } else {
            echo "<p>Selamat! Anda mendapatkan diskon " . htmlspecialchars($diskon * 100) . "%.</p>";
        }
    }
} else {
    echo "<p>Silahkan pilih produk yang ingin dibeli.</p>";
}
?>