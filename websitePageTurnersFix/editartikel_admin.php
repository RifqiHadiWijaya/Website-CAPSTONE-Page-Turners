<?php
include 'koneksi.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
// PROSES SAAT FORM DIKIRIM
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id_artikel'];
  $judul = $_POST['judul'];
  $penulis = $_POST['penulis'];
  $tanggal = $_POST['tanggal'];
  $deskripsi = $_POST['deskripsi'];

  if (!empty($_FILES['foto']['name'])) {
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    move_uploaded_file($tmp, "img/$foto");

    $query = "UPDATE artikel SET judul='$judul', penulis='$penulis', tanggal='$tanggal', deskripsi='$deskripsi', foto='$foto' WHERE id_artikel='$id'";
  } else {
    $query = "UPDATE artikel SET judul='$judul', penulis='$penulis', tanggal='$tanggal', deskripsi='$deskripsi' WHERE id_artikel='$id'";
  }

  if (mysqli_query($conn, $query)) {
    echo "<script>alert('Artikel berhasil diperbarui!'); window.location.href='editartikel_admin.php?edit_id=$id';</script>";
    exit;
  }
}

// AMBIL DATA ARTIKEL YANG MAU DIEDIT
$edit_id = $_GET['edit_id'] ?? '';
$artikel = [];

if ($edit_id != '') {
  $result = mysqli_query($conn, "SELECT * FROM artikel WHERE id_artikel='$edit_id'");
  if ($result && mysqli_num_rows($result) > 0) {
    $artikel = mysqli_fetch_assoc($result);
  } else {
    echo "<script>alert('Artikel dengan ID tersebut tidak ditemukan');</script>";
  }
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
    📄 Artikel
  </div>

  <div class="main-section">
    <div class="sidebar">
      <a href="tambahartikel_admin.php"><button class="active">📄 Tambahkan Artikel</button></a>
      <a href="editartikel_admin.php"><button>✏️ Edit Artikel</button></a>
      <a href="hapusartikel_admin.php"><button>🗑️ Hapus Artikel</button></a>
    </div>

    <div class="form-container">
      <h2>📋 Daftar Artikel</h2>
      <form class="search-form" action="editartikel_admin.php" method="GET">
        <input type="text" name="cari" class="search-bar" placeholder="Cari buku..." value="<?= isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : '' ?>">
        <button type="submit" class="search-btn-admin">🔍</button>
      </form>

      <!-- Bagian TABEL DATA -->
      <div class="table-section">
        <table border="1" cellpadding="10" style="width: 100%;">
          <tr>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Tanggal</th>
            <th>Deskripsi</th>
            <th>Foto</th>
            <th>Aksi</th>
          </tr>
          <?php
          $data_artikel = mysqli_query($conn, "SELECT * FROM artikel");
          while ($row = mysqli_fetch_assoc($data_artikel)) {
          ?>
            <tr>
              <td><?= $row['judul'] ?></td>
              <td><?= $row['penulis'] ?></td>
              <td><?= $row['tanggal'] ?></td>
              <td><?= $row['deskripsi'] ?></td>
              <td><img src="img/<?= $row['foto'] ?>" width="80"></td>
              <td><a href="editartikel_admin.php?edit_id=<?= $row['id_artikel'] ?>">Edit</a></td>
            </tr>
          <?php } ?>
        </table>
      </div>

      <!-- FORM EDIT ARTIKEL -->

      <h2>✏️ Form Edit Artikel</h2>

      <p>Perbarui informasi artikel berikut sesuai kebutuhan.</p>
      <form action="editartikel_admin.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_artikel" value="<?= $artikel['id_artikel'] ?? '' ?>">
        <div class="form-group">
          <label>Judul Artikel*</label>
          <input type="text" name="judul" required value="<?= $artikel['judul'] ?? '' ?>">
        </div>
        <div class="form-group">
          <label>Penulis*</label>
          <input type="text" name="penulis" required value="<?= $artikel['penulis'] ?? '' ?>">
        </div>
        <div class="form-group">
          <label>Tanggal*</label>
          <input type="date" name="tanggal" required value="<?= $artikel['tanggal'] ?? '' ?>">
        </div>
        <div class="form-group">
          <label>Deskripsi</label>
          <input type="text" name="deskripsi" value="<?= $artikel['deskripsi'] ?? '' ?>">
        </div>
        <div class="form-group">
          <label for="foto">Upload Foto:</label>
          <input type="file" id_artikel="foto" name="foto" accept="image/*">
        </div>

        <div class="submit-container">
          <a href="konten_admin.php" class="btn-kembali">Kembali</a>
          <button type="submit" class="btn-simpan">Simpan Perubahan</button>
        </div>
      </form>

</body>

</html>