<?php
include 'koneksi.php';

$buku = null;
$pesan_error = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM buku WHERE id_buku = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id); // pakai "s" karena id_buku bertipe VARCHAR
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $buku = $result->fetch_assoc();
    } else {
        $pesan_error = "ID buku tidak ditemukan.";
    }
} else {
    $pesan_error = "ID buku tidak ditemukan.";
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Buku</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <?php include 'navbar.php'; ?>
    </header>


    <div class="layout">

        <aside class="sidebar">
            <ul>
                <li><a href="buku.php?kategori=Terpopuler">📈 Terpopuler</a></li>
                <li><a href="buku.php?kategori=Terbaru">🆕 Terbaru</a></li>
                <hr>
                <li><a href="buku.php?kategori=Agama">Agama</a></li>
                <li><a href="buku.php?kategori=Anak-Anak">Anak-Anak</a></li>
                <li><a href="buku.php?kategori=Sejarah">Sejarah</a></li>
                <li><a href="buku.php?kategori=Puisi">Puisi</a></li>
                <li><a href="buku.php?kategori=Novel">Novel</a></li>
                <li><a href="buku.php?kategori=Motivasi">Motivasi</a></li>
            </ul>
        </aside>

        <div class="konten-buku">
            <div class="header-buku">
                <h2>Detail Buku</h2> <!-- Teks Daftar Buku -->

                <a href="buku.php" class="btn-kembali">➜</a> <!-- Tombol Kembali -->
            </div>

            <?php if ($buku): ?>
                <div class="detail-buku">
                    <img src="img/<?php echo htmlspecialchars($buku['foto'] ?? 'default.jpg'); ?>" alt="Gambar Buku">
                    <div class="info-buku">
                        <h3><?php echo htmlspecialchars($buku['judul'] ?? '-'); ?></h3>
                        <p><strong>Penulis:</strong> <?php echo htmlspecialchars($buku['penulis'] ?? '-'); ?></p>
                        <p><strong>Penerbit:</strong> <?php echo htmlspecialchars($buku['penerbit'] ?? '-'); ?></p>
                        <p><strong>Tahun Terbit:</strong> <?php echo htmlspecialchars($buku['tahun_terbit'] ?? '-'); ?></p>
                        <p><strong>ISBN:</strong> <?php echo htmlspecialchars($buku['isbn'] ?? '-'); ?></p>
                        <p><strong>Kategori:</strong> <?php echo htmlspecialchars($buku['kategori'] ?? '-'); ?></p>
                        <p><strong>Jumlah Halaman:</strong> <?php echo htmlspecialchars($buku['jumlah_halaman'] ?? '-'); ?></p>
                        <p><strong>Jumlah Buku:</strong> <?php echo htmlspecialchars($buku['jumlah_buku'] ?? '-'); ?></p>
                        <p><strong>Deskripsi:</strong> <?php echo nl2br(htmlspecialchars($buku['deskripsi'] ?? '-')); ?></p>
                    </div>
                </div>

            <?php else: ?>
                <p style="color: red;"><?php echo $pesan_error; ?></p>
            <?php endif; ?>

        </div>
    </div>
    </div>
</body>

</html>