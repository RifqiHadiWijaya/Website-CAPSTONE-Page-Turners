<?php
include 'koneksi.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();


if (!isset($_SESSION['admin']['nip'])) {
  echo "<script>alert('Anda harus login terlebih dahulu'); window.location.href='login.php';</script>";
  exit;
}

$admin_nip = $_SESSION['admin']['nip'];

// Proses simpan data saat form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $judul = $_POST['judul'];
  $penulis = $_POST['penulis'];
  $penerbit = $_POST['penerbit'];
  $tahun = $_POST['tahun_terbit'];
  $isbn = $_POST['isbn'];
  $kategori = $_POST['kategori'];
  $halaman = $_POST['jumlah_halaman'];
  $jumlah = $_POST['jumlah_buku'];
  $deskripsi = $_POST['deskripsi'];

  // Upload file foto
  $foto_name = $_FILES['foto']['name'];
  $foto_tmp = $_FILES['foto']['tmp_name'];
  $foto_path = "" . $foto_name;

  if (!empty($foto_name)) {
    move_uploaded_file($foto_tmp, $foto_path);
  } else {
    $foto_path = null;
  }

  $sql = "INSERT INTO buku (judul, penulis, penerbit, tahun_terbit, isbn, kategori, jumlah_halaman, jumlah_buku, deskripsi, foto, ADMIN_nip)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";


  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssissiisss", $judul, $penulis, $penerbit, $tahun, $isbn, $kategori, $halaman, $jumlah, $deskripsi, $foto_path, $admin_nip);

  if ($stmt->execute()) {
    echo "<script>alert('Buku berhasil ditambahkan'); window.location.href='kontenbuku_admin.php';</script>";
  } else {
    echo "<script>alert('Gagal menambahkan buku');</script>";
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
  <title>Tambah Buku</title>
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
      <a href="kontenbuku_admin.php"><button>📚 Buku</button></a>
      <a href="kontenartikel_admin.php"><button>📄 Artikel</button></a>
      <a href="kontenfasilitas_admin.php"><button>🏢 Fasilitas</button></a>
    </div>
  </div>

  <div class="section-title">
    📚 Buku
  </div>

  <div class="main-section">
    <div class="sidebar">
      <a href="tambahbuku_admin.php"><button class="active">📚 Tambahkan Buku</button></a>
      <a href="editbuku_admin.php"><button>✏️ Edit Buku</button></a>
      <a href="hapusbuku_admin.php"><button>🗑️ Hapus Buku</button></a>
    </div>

    <div class="form-container">
      <h2>📄 Form Tambahkan Buku</h2>
      <p>Isi form ini dengan lengkap sesuai dengan identitas buku.</p>
      <form action="tambahbuku_admin.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label>Judul Buku*</label>
          <input type="text" name="judul" required>
        </div>
        <div class="form-group">
          <label>Penulis*</label>
          <input type="text" name="penulis" required>
        </div>
        <div class="form-group">
          <label>Penerbit*</label>
          <input type="text" name="penerbit" required>
        </div>
        <div class="form-group">
          <label>Tahun Terbit*</label>
          <input type="number" name="tahun_terbit" required>
        </div>
        <div class="form-group">
          <label>ISBN</label>
          <input type="text" name="isbn">
        </div>
        <div class="form-group">
          <label>Kategori Buku*</label>
          <input type="text" name="kategori" required>
        </div>
        <div class="form-group">
          <label>Jumlah Halaman*</label>
          <input type="number" name="jumlah_halaman" required>
        </div>
        <div class="form-group">
          <label>Jumlah Buku*</label>
          <input type="number" name="jumlah_buku" required>
        </div>
        <div class="form-group">
          <label>Deskripsi*</label>
          <input type="text" name="deskripsi" required>
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