<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Kota Samarinda</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Header -->
    <header>
        <?php include 'navbar.php'; ?>
    </header>


    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-text">
            <h1>Dinas Perpustakaan dan Kearsipan Kota Samarinda</h1>
            <div class="statistik">
                <div>23.203 <span>Jumlah Judul</span></div>
                <div>3 <span>Mobil Perpustakaan Keliling</span></div>
                <div>43.228 <span>Jumlah Eksemplar</span></div>
            </div>
        </div>
        <div class="info-box">
            <div><strong>📍 Alamat:</strong><br>Jl. Kesuma Bangsa No.1, Kel. Bugis, Kec. Samarinda Kota</div>
            <div><strong>📅 Hari:</strong><br>Senin - Sabtu</div>
            <div><strong>⏰ Waktu:</strong><br>08.00 - 15.00</div>
            <div><strong>📧 Kontak:</strong><br>dispursip_smr@gmail.com</div>
        </div>
    </section>

    <!-- Galeri Kegiatan -->
    <section class="section">
        <h2>💼 Layanan Publik</h2>
        <div class="layanan-container">
            <div class="layanan-item">
                <img src="img/infografis1.jpg" alt="Layanan 1">
                <p>Layanan Kartu Anggota</p>
            </div>
            <div class="layanan-item">
                <img src="img/infografis2.jpg" alt="Layanan 2">
                <p>Layanan Peminjaman Buku</p>
            </div>
            <div class="layanan-item">
                <img src="img/infografis3.jpg" alt="Layanan 2">
                <p>Layanan Donasi Buku</p>
            </div>
            <div class="layanan-item">
                <img src="img/infografis4.jpg" alt="Layanan 2">
                <p>Layanan Internet</p>
            </div>
        </div>
    </section>

    <!-- Artikel -->
    <section class="section">
        <h2>📰 Artikel</h2>
        <div class="articles">
            <?php
            include 'koneksi.php';

            $sql = "SELECT * FROM artikel"; // pastikan field sesuai
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="article">';
                    echo '<img src="img/' . htmlspecialchars($row['foto']) . '" alt="' . htmlspecialchars($row['judul']) . '" style="width:100%; max-width:300px;">';
                    echo '<h3>' . htmlspecialchars($row['judul']) . '</h3>';
                    echo '</div>';
                }
            } else {
                echo '<p>Tidak ada artikel yang tersedia.</p>';
            }

            $conn->close();
            ?>
        </div>
    </section>



    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="left">
                <img src="https://perpustakaankearsipan.samarindakota.go.id/storage/Template/logo.png" alt="Logo">
                <p>Selamat Datang di Website Resmi<br>Dinas Perpustakaan dan Kearsipan Kota Samarinda</p>
            </div>
            <div class="right">
                <h4>KONTAK INFO</h4>
                <p>Jl. Kesuma Bangsa No.1, Kel. Bugis, Kec. Samarinda Kota,<br>Kota Samarinda, Kalimantan Timur 75121</p>
                <p>Telepon/Fax: 0541-736833</p>
                <p>Email: dispursip_smr@gmail.com</p>
                <p>Website: <a href="https://perpustakaankearsipan.samarindakota.go.id">perpustakaankearsipan.samarindakota.go.id</a></p>
            </div>
        </div>
    </footer>
</body>

</html>