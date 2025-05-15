<?php
session_start();

// Cek apakah pengunjung sudah login
if (!isset($_SESSION['pengunjung'])) {
    header("Location: login.php");
    exit;
}

// Ambil data pengunjung dari session
$pengunjung = $_SESSION['pengunjung'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Profil Pengunjung</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Navbar -->
    <header>
        <?php include 'navbar.php'; ?>
    </header>

    <!-- Konten Pengunjung -->
    <div class="profil">
        <main class="profil-main">
            <h2 class="profil-salam">Hallo, <?= htmlspecialchars($pengunjung['nama_lengkap']) ?>!</h2>
            <p class="profil-pesan">Selamat datang di halaman profil Anda. Sebagai pengunjung, Anda dapat mengeksplorasi berbagai konten, berpartisipasi dalam kegiatan, dan memberikan saran atau donasi buku. Pastikan untuk memeriksa informasi profil Anda secara berkala.</p>

            <div class="profil-biodata">
                <div class="profil-foto">
                    <img src="img/<?= htmlspecialchars($pengunjung['foto']); ?>" alt="Foto Pengunjung">
                </div>

                <div class="profil-info">
                    <h3>📋 Biodata</h3>

                    <div class="form-group">
                        <div class="label-box">NIK</div>
                        <div class="value-box"><?= htmlspecialchars($pengunjung['nik']); ?></div>
                    </div>

                    <div class="form-group">
                        <div class="label-box">Email</div>
                        <div class="value-box"><?= htmlspecialchars($pengunjung['email']); ?></div>
                    </div>

                    <div class="form-group">
                        <div class="label-box">Nama</div>
                        <div class="value-box"><?= htmlspecialchars($pengunjung['nama_lengkap']); ?></div>
                    </div>

                    <div class="form-group">
                        <div class="label-box">Pendidikan Terakhir</div>
                        <div class="value-box"><?= htmlspecialchars($pengunjung['pendidikan_terakhir']); ?></div>
                    </div>

                    <div class="form-group">
                        <div class="label-box">Pekerjaan</div>
                        <div class="value-box"><?= htmlspecialchars($pengunjung['pekerjaan']); ?></div>
                    </div>

                    <div class="form-group">
                        <div class="label-box">Alamat</div>
                        <div class="value-box"><?= htmlspecialchars($pengunjung['alamat']); ?></div>
                    </div>
                </div>
            </div>
            <div class="profil-aksi">
                <a href="donasi_ku.php" class="donasi-ku">📚 Donasi Buku</a>
                <a href="logout.php" class="keluar">Keluar</a>
            </div>
        </main>
    </div>
</body>

</html>