<h3>Pendaftaran Staff</h3>
<form method="POST" action="">
    <p>Nama: <br /><input type="text" name="nama" /></p>
    <p>NPM: <br /><input type="text" name="npm" /></p>
    <p>Pilihan Staff: <br />
        <select name="loker">
            <option value="">-- Pilih Staff --</option>
            <option value="kasir">Kasir</option>
            <option value="merchandiser">Merchandiser</option>
        </select>
    </p>
    <button type="submit">Kirim</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? '';
    $npm = $_POST['npm'] ?? '';
    $loker = $_POST['loker'] ?? '';
    $message = array();

    if (empty($nama) || empty($npm) || empty($loker)) {
        $message[] = "Harap lengkapi semua data.";
    }

    if (!preg_match("/^[a-zA-Z\s]*$/", $nama)) {
        $message[] = "Nama hanya boleh mengandung huruf dan spasi.";
    }

    if (!preg_match("/^[0-9]*$/", $npm)) {
        $message[] = "NPM hanya boleh mengandung angka.";
    }

    if (!empty($message)) {
        foreach ($message as $msg) {
            echo "<p style='color:red;'> " . htmlspecialchars($msg) . " !!</p>";
        }
    } else {
        if ($loker == 'kasir') {
            $jadwalWawancara = "besok pukul 10.00 WIB di market";
        } elseif ($loker == 'merchandiser') {
            $jadwalWawancara = "lusa pukul 12.00 WIB di market";
        } else {
            $jadwalWawancara = "jadwal belum ditentukan";
        }

        echo "<h2>Informasi Pendaftaran</h2>";
        echo "<p><strong>Nama: </strong>" . htmlspecialchars($nama) . "</p>";
        echo "<p><strong>NPM: </strong>" . htmlspecialchars($npm) . "</p>";
        echo "<p><strong>Pilihan Staff: </strong>" . htmlspecialchars($loker) . "</p>";
        echo "<p><strong>Jadwal Wawancara: </strong>" . htmlspecialchars($jadwalWawancara) . "</p>";
        echo "<p>Anda mendaftar sebagai " . htmlspecialchars($loker) . ". Selanjutnya, Anda dapat hadir " . htmlspecialchars($jadwalWawancara) . " untuk wawancara.</p>";
    }
} else {
    echo "<p>Silahkan lengkapi formulir di atas.</p>";
}
?>