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
        <?php include 'navbar_admin.php'; ?>
    </header>

    <!-- Hero Section -->
    <section class="hero-admin">
        <div class="hero-text-admin">
            <h1>Dinas Perpustakaan dan <br>Kearsipan Kota Samarinda</h1>
        </div>
        <div class="info-box-admin">
            <div>
                <strong>📍 Alamat</strong>
                <span>Jl. Kesuma Bangsa No.1, Kel. Bugis, Kec. Samarinda Kota</span>
            </div>
            <div>
                <strong>📅 Hari</strong>
                <span>Senin - Sabtu</span>
            </div>
            <div>
                <strong>⏰ Waktu</strong>
                <span>08.00 - 15.00</span>
            </div>
            <div>
                <strong>📧 Kontak</strong>
                <span>dispursip_smr@gmail.com</span>
            </div>
        </div>
    </section>

    <!-- Statistik Chart Section -->
    <section class="statistik-chart">
        <div class="pola-box">
            <h2>Pola Pengunjung</h2>
            <div class="statistik-wrapper">
                <div class="jumlah-buku-group">
                    <div class="jumlah-item">
                        <div class="jumlah-angka">23.203</div>
                        <div class="jumlah-label">Total Judul Buku</div>
                    </div>
                    <div class="jumlah-item">
                        <div class="jumlah-angka">43.228</div>
                        <div class="jumlah-label">Jumlah Examplar</div>
                    </div>
                    <div class="jumlah-item">
                        <div class="jumlah-angka">3</div>
                        <div class="jumlah-label">Mobil Perpustakaan Keliling</div>
                    </div>
                </div>
                <div class="looker-iframe">
                    <iframe src="https://lookerstudio.google.com/embed/reporting/37c00e58-1de6-49d9-9f7d-714166750d3e/page/p_rb3vzgkasd"
                        frameborder="0"
                        style="border:0"
                        allowfullscreen sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox">
                    </iframe>
                </div>
            </div>
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