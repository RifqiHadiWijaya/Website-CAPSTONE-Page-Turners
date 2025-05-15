<?php
include 'koneksi.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Proses simpan data saat form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $fasilitas = $_POST['nama_fasilitas'];

  // Upload file foto
  $foto_name = $_FILES['foto']['name'];
  $foto_tmp = $_FILES['foto']['tmp_name'];
  $foto_path = "" . $foto_name;

  if (!empty($foto_name)) {
    move_uploaded_file($foto_tmp, $foto_path);
  } else {
    $foto_path = null;
  }

  $query = "INSERT INTO fasilitas (nama_fasilitas, foto) VALUES (?, ?)";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('ss', $fasilitas, $foto_path);


  if ($stmt->execute()) {
    echo "<script>alert('Fasilitas berhasil ditambahkan'); window.location.href='kontenbuku_admin.php';</script>";
  } else {
    echo "<script>alert('Gagal menambahkan Fasilitas');</script>";
  }

  $stmt->close();
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Artikel</title>
  <link rel="stylesheet" href="kontenadmin_style.css" />
</head>

<body>

  <header>
    <?php include 'navbar_admin.php'; ?>
  </header>

  <div class="hero">
    <img src="img/donasi.jpg" alt="Hero Image" />
    <div class="hero-text">
      <h2>Konten Perpustakaan</h2>
      <h3>Bersama Kita Kembangkan Ilmu dan Akses Pengetahuan</h3>
      <p>
        Perpustakaan Kota Samarinda menyediakan berbagai konten edukatif yang dapat dikelola dan dibagikan kepada masyarakat.
        Mari turut berkontribusi dalam memperkaya koleksi buku, artikel, dan informasi fasilitas guna mendukung literasi dan layanan perpustakaan yang inklusif.
      </p>
    </div>
  </div>

  <div class="tabs-container">
    <div class="tabs">
      <a href="kontenbuku_admin.php"><button>📘 Buku</button></a>
      <a href="kontenartikel_admin.php"><button>📄 Artikel</button></a>
      <a href="kontenfasilitas_admin.php"><button>🏢 Fasilitas</button></a>
    </div>
  </div>

  <div class="section-title">
    🏢 Fasilitas
  </div>

  <div class="main-section">
    <div class="sidebar">
      <a href="tambahfasilitas_admin.php"><button class="active">🏢 Tambahkan Fasilitas</button></a>
      <a href="editfasilitas_admin.php"><button>✏️ Edit Fasilitas</button></a>
      <a href="hapusfasilitas_admin.php"><button>🗑️ Hapus Fasilitas</button></a>
    </div>

    <div class="form-container">
      <h2>🏢 Form Tambahkan Fasilitas</h2>
      <p>Isi form ini dengan lengkap sesuai dengan keterangan fasilitas.</p>
      <form action="tambahfasilitas_admin.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label>Nama Fasilitas*</label>
          <input type="text" name="nama_fasilitas" required>
        </div>
        <div class="form-group">
          <label for="foto">Upload Foto:</label>
          <input type="file" id="foto" name="foto" required>
        </div>
        <div class="submit-container">
          <a href="konten_admin.php" class="btn-kembali">Kembali</a>
          <button type="submit" class="btn-simpan">Simpan</button>
        </div>
      </form>
    </div>
  </div>
  </div>

</body>

</html>