<?php
session_start();
include 'koneksi.php';

// Cek login
if (!isset($_SESSION['pengunjung'])) {
    header("Location: login.php");
    exit;
}

// Ambil data session pengunjung
$pengunjung = $_SESSION['pengunjung'];
$nik_pengunjung = $pengunjung['nik'];  // Mengambil email dari session

// Ambil data donasi berdasarkan email pengunjung
$query = mysqli_query($conn, "SELECT * FROM donasi WHERE nik = '$nik_pengunjung'");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Donasi Saya</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <?php include 'navbar.php'; ?>
    </header>

    <div class="donasi-container">
        <h2>📚 Donasi Buku Saya</h2>

        <table class="donasi-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                    <th>Kondisi</th>
                    <th>Catatan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if (mysqli_num_rows($query) > 0) {
                    while ($data = mysqli_fetch_assoc($query)) {
                        echo "<tr>
                        <td>{$no}</td>
                        <td>{$data['judul_buku']}</td>
                        <td>{$data['penulis']}</td>
                        <td>{$data['kategori']}</td>
                        <td>{$data['jumlah_buku']}</td>
                        <td>{$data['kondisi_buku']}</td>
                        <td>{$data['catatan_tambahan']}</td>
                        <td>";

                        // Tampilkan status dengan warna
                        if ($data['status'] == 'Diterima') {
                            echo "<span class='status-diterima'>Diterima</span>";
                        } elseif ($data['status'] == 'Ditolak') {
                            echo "<span class='status-ditolak'>Ditolak</span>";
                        } else {
                            echo "<span class='status-menunggu'>Menunggu</span>";
                        }

                        echo "</td>
                    </tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='8'>Belum ada donasi yang kamu kirimkan.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <a href="profil_pengunjung.php" class="kembali-btn">← Kembali ke Profil</a>
    </div>

</body>

</html>