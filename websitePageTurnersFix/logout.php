<?php
// Memulai sesi
session_start();

// Menghapus semua variabel sesi
session_unset();

// Menghancurkan sesi
session_destroy();

// Mengarahkan pengguna ke halaman login
header("Location: index.php");
exit();
?>
