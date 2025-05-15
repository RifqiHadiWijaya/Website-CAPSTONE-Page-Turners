<?php
include 'koneksi.php'; // Panggil koneksi

// Ambil data dari tabel donasi dan pengunjung
$sql = "SELECT d.*, p.nama_lengkap, p.email, p.alamat 
        FROM donasi d 
        JOIN pengunjung p ON d.nik = p.nik";
$result = $conn->query($sql);

if (!$result) {
    die("Query error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donasi Buku Perpustakaan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navbar -->
    <header>
        <?php include 'navbar_admin.php'; ?>
    </header>

    <!-- Hero Donasi Section -->
    <section class="hero-donasi-admin">
        <div class="hero-donasi-overlay">
            <div class="hero-donasi-text">
                <h1>Donasi Buku Perpustakaan</h1>
                <p>
                    <strong>Bersama Kita Tebarkan Ilmu Lewat Buku</strong><br>
                    Perpustakaan Kota Samarinda mengajak masyarakat untuk berpartisipasi dalam program Donasi Buku,
                    demi mendukung literasi dan memperluas akses bacaan untuk seluruh lapisan masyarakat.
                </p>
            </div>
        </div>
    </section>

    <section class="donasi-info-box">
        <h3>Apa yang Bisa Didonasikan?</h3>
        <ul>
            <li>Buku pelajaran (SD, SMP, SMA)</li>
            <li>Buku anak-anak</li>
            <li>Novel dan fiksi</li>
            <li>Ensiklopedia, biografi, dan buku referensi</li>
            <li>Buku motivasi, keterampilan, dan ilmu pengetahuan umum</li>
        </ul>
        <p style="color: red;">❌ Tidak menerima: Buku rusak berat, sobek, berjamur, atau bajakan.</p>
        <p style="color: red;">❌ Tidak menerima: Buku yang mengandung unsur SARA, kekerasan, pornografi, atau ujaran kebencian.</p>
        <div style="text-align: center; padding: 20px">
            <strong style="color: #d97706;">Donasi Anda, Harapan Mereka</strong>
        </div>
    </section>

    <div class="section">
        <h2>📘 Data Donasi Buku</h2>

        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="donor-info">
                <p><strong>Nama Donatur:</strong> <?= $row['nama_lengkap']; ?></p>
                <p><strong>Email:</strong> <?= $row['email']; ?></p>
                <p><strong>Alamat:</strong> <?= $row['alamat']; ?></p>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Gambar</th>
                        <th>Catatan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $row['judul_buku']; ?></td>
                        <td><?= $row['penulis']; ?></td>
                        <td><?= $row['kategori']; ?></td>
                        <td><?= $row['jumlah_buku']; ?></td>
                        <td><img src="<?= $row['foto']; ?>" alt="Buku" width="100"></td>
                        <td><?= $row['catatan_tambahan']; ?></td>
                        <td>
                            <form class="form-container" action="update_status_donasi.php" method="POST">
                                <input type="hidden" name="id_donasi" value="<?= $row['id_donasi']; ?>">
                                <select name="status">
                                    <option value="">-- Pilih --</option>
                                    <option value="Diterima" <?= $row['status'] == 'Diterima' ? 'selected' : '' ?>>Diterima</option>
                                    <option value="Ditolak" <?= $row['status'] == 'Ditolak' ? 'selected' : '' ?>>Ditolak</option>
                                </select>
                                <button type="submit" class="submit-button">Simpan</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
            <br>
        <?php endwhile; ?>
    </div>
</body>
</html>
