<?php
include 'koneksi.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// PROSES UPDATE SAAT FORM DIKIRIM
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id_fasilitas'];
  $fasilitas = $_POST['nama_fasilitas'];

  if (!empty($_FILES['foto']['name'])) {
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    move_uploaded_file($tmp, "img/$foto");

    $query = "UPDATE fasilitas SET nama_fasilitas='$fasilitas', foto='$foto' WHERE id_fasilitas='$id'";
  } else {
    $query = "UPDATE fasilitas SET nama_fasilitas='$fasilitas' WHERE id_fasilitas='$id'";
  }


  if (mysqli_query($conn, $query)) {
    echo "<script>alert('Data Fasilitas berhasil diperbarui!'); window.location.href='editfasilitas_admin.php';</script>";
    exit;
  } else {
    echo "Gagal memperbarui: " . mysqli_error($conn);
  }
}

// AMBIL DATA BUKU YANG MAU DIEDIT
$edit_id = $_GET['edit_id'] ?? '';
$buku = [];

if ($edit_id != '') {
  $result = mysqli_query($conn, "SELECT * FROM fasilitas WHERE id_fasilitas='$edit_id'");
  if ($result && mysqli_num_rows($result) > 0) {
    $buku = mysqli_fetch_assoc($result);
  } else {
    echo "<script>alert('Buku tidak ditemukan!'); window.location.href='editfasilitas_admin.php';</script>";
    exit;
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
      <a href="kontenbuku_admin.php"><button>📚 Buku</button></a>
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
      <h2>🏢 Daftar fasilitas</h2>

      <form class="search-form" action="editfasilitas_admin.php" method="GET">
        <input type="text" name="cari" class="search-bar" placeholder="Cari buku..." value="<?= isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : '' ?>">
        <button type="submit" class="search-btn-admin">🔍</button>
      </form>

      <div class="table-section">
        <table border="1" cellpadding="10" style="width: 100%;">
          <tr>
            <th>fasilitas</th>
            <th>Foto</th>
            <th>Aksi</th>
          </tr>
          <?php
          $data_buku = mysqli_query($conn, "SELECT * FROM fasilitas");
          while ($row = mysqli_fetch_assoc($data_buku)) {
          ?>
            <tr>
              <td><?= $row['nama_fasilitas'] ?></td>
              <td><img src="img/<?= $row['foto'] ?>" width="80"></td>
              <td><a href="editfasilitas_admin.php?edit_id=<?= $row['id_fasilitas'] ?>">Edit</a></td>
            </tr>
          <?php } ?>
        </table>
      </div>

      <h2>✏️ Form Edit fasilitas</h2>
      <p>Perbarui informasi fasilitas berikut sesuai kebutuhan.</p>
      <form action="editfasilitas_admin.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_fasilitas" value="<?= $buku['id_fasilitas'] ?? '' ?>">

        <div class="form-group">
          <label>Fasilitas*</label>
          <input type="text" name="nama_fasilitas" required value="<?= $buku['nama_fasilitas'] ?? '' ?>">
        </div>

        <div class="form-group">
          <label for="foto">Upload Foto:</label>
          <input type="file" id_fasilitas="foto" name="foto" accept="image/*">
        </div>

        <div class="submit-container">
          <a href="konten_admin.php" class="btn-kembali">Kembali</a>
          <button type="submit" class="btn-kembali">Simpan Perubahan</button>
        </div>
      </form>

</body>

</html>