<?php
require_once 'koneksi.php'; // Gantikan koneksi manual

// Ambil data dari POST
$id = $_POST['id_donasi'] ?? null;
$status = $_POST['status'] ?? null;

// Cek validasi input
if (!$id || !$status) {
  echo "
  <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
  <script>
    Swal.fire({
      icon: 'error',
      title: 'Gagal!',
      text: 'ID atau status tidak ditemukan.',
      confirmButtonText: 'Kembali'
    }).then(() => {
      window.history.back();
    });
  </script>
  ";
  exit();
}

// Sanitasi input
$id = (int) $id;
$status = mysqli_real_escape_string($conn, $status); // pakai $conn dari koneksi.php

// Update status
$query = "UPDATE donasi SET status=? WHERE id_donasi=?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "si", $status, $id);
$success = mysqli_stmt_execute($stmt);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Update Status</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <script>
    <?php if ($success): ?>
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: 'Status donasi berhasil diperbarui.',
        confirmButtonText: 'OK'
      }).then(() => {
        window.location.href = 'admin_donasi.php';
      });
    <?php else: ?>
      Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: 'Terjadi kesalahan saat memperbarui status.',
        confirmButtonText: 'Coba Lagi'
      }).then(() => {
        window.history.back();
      });
    <?php endif; ?>
  </script>
</body>
</html>
