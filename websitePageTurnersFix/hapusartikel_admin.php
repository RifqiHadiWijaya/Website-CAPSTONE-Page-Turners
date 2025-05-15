<?php
include 'koneksi.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['hapus_id'])) {
  $id = $_GET['hapus_id'];
  $query = mysqli_query($conn, "SELECT * FROM artikel WHERE id_artikel='$id'");
  $row = mysqli_fetch_assoc($query);

  $hapus = mysqli_query($conn, "DELETE FROM artikel WHERE id_artikel='$id'");
  if ($hapus) {
    echo "<script>alert('Data berhasil dihapus!'); window.location='hapusartikel_admin.php';</script>";
    exit;
  } else {
    echo "Gagal menghapus dari database: " . mysqli_error($conn);
  }
}

// Ambil semua data buku
$result = mysqli_query($conn, "SELECT * FROM artikel");
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
      <a href="kontenbuku_admin.php"><button>📚 Buku</button></a>
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

      <form class="search-form" action="hapusartikel_admin.php" method="GET">
        <input type="text" name="cari" class="search-bar" placeholder="Cari buku..." value="<?= isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : '' ?>">
        <button type="submit" class="search-btn-admin">🔍</button>
      </form>

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
              <td><a href="hapusartikel_admin.php?hapus_id=<?= $row['id_artikel'] ?>">hapus</a></td>
            </tr>
          <?php } ?>

        </table>
        <div class="submit-container">
          <a href="konten_admin.php" class="btn-kembali">Kembali</a>
        </div>
      </div>
</body>

</html>