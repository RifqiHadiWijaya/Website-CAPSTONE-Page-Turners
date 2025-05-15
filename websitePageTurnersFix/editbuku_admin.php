<?php
include 'koneksi.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// PROSES UPDATE SAAT FORM DIKIRIM
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id_buku'];
  $judul = $_POST['judul'];
  $penulis = $_POST['penulis'];
  $penerbit = $_POST['penerbit'];
  $tahun = $_POST['tahun_terbit'];
  $isbn = $_POST['isbn'];
  $kategori = $_POST['kategori'];
  $halaman = $_POST['jumlah_halaman'];
  $jumlah = $_POST['jumlah_buku'];
  $deskripsi = $_POST['deskripsi'];

  if (!empty($_FILES['foto']['name'])) {
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    move_uploaded_file($tmp, "img/$foto");

    $query = "UPDATE buku SET judul='$judul', penulis='$penulis', penerbit='$penerbit', tahun_terbit='$tahun', isbn='$isbn', kategori='$kategori', jumlah_halaman='$halaman', jumlah_buku='$jumlah', deskripsi='$deskripsi', foto='$foto' WHERE id_buku='$id'";
  } else {
    $query = "UPDATE buku SET judul='$judul', penulis='$penulis', penerbit='$penerbit', tahun_terbit='$tahun', isbn='$isbn', kategori='$kategori', jumlah_halaman='$halaman', jumlah_buku='$jumlah', deskripsi='$deskripsi' WHERE id_buku='$id'";
  }

  if (mysqli_query($conn, $query)) {
    echo "<script>alert('Data buku berhasil diperbarui!'); window.location.href='editbuku_admin.php';</script>";
    exit;
  } else {
    echo "Gagal memperbarui: " . mysqli_error($conn);
  }
}

// AMBIL DATA BUKU YANG MAU DIEDIT
$edit_id = $_GET['edit_id'] ?? '';
$buku = [];

if ($edit_id != '') {
  $result = mysqli_query($conn, "SELECT * FROM buku WHERE id_buku='$edit_id'");
  if ($result && mysqli_num_rows($result) > 0) {
    $buku = mysqli_fetch_assoc($result);
  } else {
    echo "<script>alert('Buku tidak ditemukan!'); window.location.href='editbuku_admin.php';</script>";
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
    📚 Buku
  </div>

  <div class="main-section">
    <div class="sidebar">
      <a href="tambahbuku_admin.php"><button class="active">📚 Tambahkan Buku</button></a>
      <a href="editbuku_admin.php"><button>✏️ Edit Buku</button></a>
      <a href="hapusbuku_admin.php"><button>🗑️ Hapus Buku</button></a>
    </div>

    <div class="form-container">
      <h2>📋 Daftar Buku</h2>

      <!-- Form pencarian -->
      <form class="search-form" action="editbuku_admin.php" method="GET">
        <input type="text" name="cari" class="search-bar" placeholder="Cari buku..." value="<?= isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : '' ?>">
        <button type="submit" class="search-btn-admin">🔍</button>
      </form>


      <div class="table-section">
        <table border="1" cellpadding="10" style="width: 100%;">
          <tr>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Tahun Terbit</th>
            <th>ISBN</th>
            <th>Jumlah</th>
            <th>Deskripsi</th>
            <th>Foto</th>
            <th>Aksi</th>
          </tr>
          <?php
          $cari = $_GET['cari'] ?? '';
          if ($cari != '') {
            $data_buku = mysqli_query($conn, "SELECT * FROM buku WHERE judul LIKE '%$cari%' OR penulis LIKE '%$cari%' OR penerbit LIKE '%$cari%'");
          } else {
            $data_buku = mysqli_query($conn, "SELECT * FROM buku");
          }
          while ($row = mysqli_fetch_assoc($data_buku)) {
          ?>
            <tr>
              <td><?= $row['judul'] ?></td>
              <td><?= $row['penulis'] ?></td>
              <td><?= $row['penerbit'] ?></td>
              <td><?= $row['tahun_terbit'] ?></td>
              <td><?= $row['isbn'] ?></td>
              <td><?= $row['jumlah_buku'] ?></td>
              <td><?= $row['deskripsi'] ?></td>
              <td><img src="img/<?= $row['foto'] ?>" width="80"></td>
              <td><a href="editbuku_admin.php?edit_id=<?= $row['id_buku'] ?>">Edit</a></td>
            </tr>
          <?php } ?>
        </table>
      </div>

      <h2>✏️ Form Edit Buku</h2>
      <p>Perbarui informasi buku berikut sesuai kebutuhan.</p>

      <form action="editbuku_admin.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_buku" value="<?= $buku['id_buku'] ?? '' ?>">

        <div class="form-group">
          <label>Judul Buku*</label>
          <input type="text" name="judul" required value="<?= $buku['judul'] ?? '' ?>">
        </div>

        <div class="form-group">
          <label>Penulis*</label>
          <input type="text" name="penulis" required value="<?= $buku['penulis'] ?? '' ?>">
        </div>

        <div class="form-group">
          <label>Penerbit*</label>
          <input type="text" name="penerbit" required value="<?= $buku['penerbit'] ?? '' ?>">
        </div>

        <div class="form-group">
          <label>Tahun Terbit*</label>
          <input type="number" name="tahun_terbit" required value="<?= $buku['tahun_terbit'] ?? '' ?>">
        </div>

        <div class="form-group">
          <label>ISBN</label>
          <input type="text" name="isbn" value="<?= $buku['isbn'] ?? '' ?>">
        </div>

        <div class="form-group">
          <label>Kategori</label>
          <input type="text" name="kategori" value="<?= $buku['kategori'] ?? '' ?>">
        </div>

        <div class="form-group">
          <label>Jumlah Halaman</label>
          <input type="number" name="jumlah_halaman" value="<?= $buku['jumlah_halaman'] ?? '' ?>">
        </div>

        <div class="form-group">
          <label>Jumlah Buku</label>
          <input type="number" name="jumlah_buku" value="<?= $buku['jumlah_buku'] ?? '' ?>">
        </div>

        <div class="form-group">
          <label>Deskripsi</label>
          <input type="text" name="deskripsi" value="<?= $buku['deskripsi'] ?? '' ?>">
        </div>

        <div class="form-group">
          <label for="foto">Upload Foto:</label>
          <input type="file" id="foto" name="foto" accept="image/*">
        </div>

        <div class="submit-container">
          <a href="konten_admin.php" class="btn-kembali">Kembali</a>
          <button type="submit" class="btn-kembali">Simpan Perubahan</button>
        </div>
      </form>

</body>

</html>