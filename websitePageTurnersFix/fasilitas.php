<?php
include 'koneksi.php';

// Ambil data dari tabel fasilitas
$sql = "SELECT * FROM fasilitas";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Fasilitas Perpustakaan</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <?php include 'navbar.php'; ?>
    </header>
    <main>
        <section class="main-section">
            <div class="image-container">
                <img src="img/images-2.jpeg" alt="Perpustakaan" />
            </div>
            <div class="description-box">
                <h2>Fasilitas</h2>
                <p>Perpustakaan Kota Samarinda menyediakan fasilitas ruang baca nyaman, koleksi buku lengkap, ruang anak, akses Wi-Fi gratis, komputer multimedia, serta layanan peminjaman buku. Tersedia juga ruang diskusi, loker penyimpanan, dan akses untuk penyandang disabilitas.</p>
            </div>
        </section>

        <section class="grid-fasilitas">
            <div class="grid-header">
                <h3>Fasilitas</h3>
                <span class="arrow">➜</span>
            </div>
            <div class="grid">
                <?php
                $sql = "SELECT * FROM fasilitas";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) :
                    $ikonPath = "img/" . htmlspecialchars($row['foto']);
                ?>
                    <div class="box">
                        <img src="<?= $ikonPath ?>" alt="<?= htmlspecialchars($row['foto']) ?>">
                        <p class="facility-name"><?= htmlspecialchars($row['nama_fasilitas']) ?></p>
                    </div>
                <?php endwhile; ?>
            </div>
        </section>
    </main>

</body>

</html>